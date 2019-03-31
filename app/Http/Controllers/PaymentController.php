<?php

namespace App\Http\Controllers;

use App\Rekening;
use App\RekeningTransactie;
use App\Sentje;
use App\SentjeTransaction;
use App\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Mollie\Api\Exceptions\ApiException;
use Mollie\Laravel\Facades\Mollie;
use Symfony\Component\Intl\Intl;

class PaymentController extends Controller
{
    function toMollie(string $sentjeId, Request $request)
    {
        $sentje = Sentje::find($sentjeId);
        $user = User::find($sentje->user_id);


        if ($sentje == null)
            return redirect("/");

        $rates = $this->getExchangeRates();
        $selectedCurrency = $request->input('currency');
        $amount = $sentje->fixed_amount ? $sentje->amount : doubleval($request->input('amount'));

        $currencies = [];
        foreach ($rates['rates'] as $key => $rate)
            $currencies[] = $key;


        if ($selectedCurrency != 'EUR') {
            if (!in_array($selectedCurrency, $currencies))
                return redirect("/sentje/betalen/$sentjeId?error=invalid_currency");

            if ($sentje->fixed_amount) {
                $amount = $sentje->amount * $rates['rates'][$selectedCurrency];
            }
        }

        try {
            $transaction = new SentjeTransaction;
            $transaction->sentje_id = $sentjeId;
            $transaction->currency = $selectedCurrency;
            $transaction->amount = $amount;
            $transaction->converted_amount = $selectedCurrency != 'EUR' ? $amount / $rates['rates'][$selectedCurrency] : $amount;
            $transaction->name = $request->input('name');
            $transaction->message = $request->input('message');
            $transaction->location = $request->input('location') ? $request->input('location') : "";
            $transaction->paid = false;
            $transaction->save();

            $payment = Mollie::api()->payments()->create([
                'amount' => [
                    'currency' => $selectedCurrency,
                    'value' => number_format($amount, 2, '.', '')
                ],
                'description' => __('sentje.payment_description', ['name' => $user->name, 'title' => $sentje->title]),
                'redirectUrl' => env('APP_URL') . '/sentje/bevestiging/' . $sentje->id,
                'webhookUrl' => env('APP_URL') . '/sentje/callback',
                'metadata' => [
                    'sentjeId' => $sentje->id,
                    'transactionId' => $transaction->id
                ]
            ]);

            $payment = Mollie::api()->payments()->get($payment->id);

            return redirect($payment->getCheckoutUrl(), 303);
        } catch (ApiException $e) {
            return redirect("/sentje/betalen/$sentjeId?error=mollie_error");
        }
    }

    private function getExchangeRates()
    {
        $supportedCurrencies = [
            "USD", "AUD", "BRL", "GBP", "BGN", "CAD", "DKK", "PHP", "HUF", "HKD", "ISK", "ILS", "JPY", "HRK", "MYR", "MXN", "NZD", "NOK", "PLN", "RON", "RUB", "SGD", "TWD", "CZK", "SEK", "CHF"
        ];
        $client = new Client();
        $response = $client->get('http://data.fixer.io/api/latest?access_key=e3304decc6f70a19dc70eddf45b176ae&symbols=' . implode(",", $supportedCurrencies))->getBody()->getContents();
        return json_decode($response, true);
    }

    function callback(Request $request)
    {
        if (!$request->has('id')) {
            return abort(305);
        }

        try {
            $payment = Mollie::api()->payments()->get($request->input('id'));

            $sentje = Sentje::find($payment->metadata->sentjeId);

            if ($sentje == null) return abort(500, "No Sentje found with that Id");

            $transaction = SentjeTransaction::find($payment->metadata->transactionId);

            if ($transaction == null) return abort(500, "No transaction found with that Id");

            if($transaction->paid)
                return abort(401, "Transaction has already been marked as paid!");

            $transaction->paid = $payment->isPaid();
            $transaction->save();

            $rekening = Rekening::find($sentje->rekening_id);

            if($rekening == null) return abort(500, "No rekening found with that id!");

            $rekening->saldo += $transaction->converted_amount;
            $rekening->save();

            //TODO: Transactie rekening zooi
            /*$bankTransaction = new RekeningTransactie;
            $bankTransaction->from = */


        } catch (ApiException $e) {
            return abort(401, "Unauthorized!");
        }

    }

    function info(string $sentjeId)
    {
        $sentje = Sentje::find($sentjeId);
        $user = User::find($sentje->user_id);

        if ($sentje == null)
            return redirect('/');

        $rates = $this->getExchangeRates()['rates'];
        $advancedRates = [];

        foreach ($rates as $key => $rate) {
            $advancedRates[] = (object)[
                'currency' => $key,
                'symbol' => Intl::getCurrencyBundle()->getCurrencySymbol($key),
                'rate' => $rate
            ];
        }

        return view('sentje.info', ['sentje' => $sentje, 'user' => $user, 'rates' => $advancedRates]);
    }
}
