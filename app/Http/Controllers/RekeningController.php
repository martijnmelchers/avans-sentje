<?php

namespace App\Http\Controllers;

use App\Rekening;
use App\RekeningTransactie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RekeningController extends Controller
{
    const LAND_CODE = "NL83SENTJE";

    public function index()
    {
        $rekeningen = Auth::User()->rekeningen;
        return view('rekeningen.index', compact('rekeningen'));
    }

    public function create()
    {
        return view('rekeningen.create');
    }

    public function details($nummer){
        $rekening = Rekening::find($nummer);

        if(!$rekening)
        abort(404);

        if(!Auth::User()->rekeningen->contains($rekening))
        abort(403);

        $transacties = $rekening->to->merge($rekening->from);
        return view('rekeningen.details', compact('rekening', 'transacties'));
    }

    public function edit()
    {

    }

    public function remove()
    {

    }

    // Create a rekening and add it to the current user.
    public function store(Request $request)
    {
        $rekening = new Rekening;
        $rekening->name = $request->name;
        $IBAN = $this->generateIBAN();

        $rekening->nummer = $IBAN;
        $rekening->saldo = 0;
        $rekening->user_id = Auth::id();

        $rekening->save();

        return redirect('rekeningen');
    }


    public function createTransaction($from, $to, $amount){
        $transactie = new RekeningTransactie;    
        $transactie->from = $from;
        $transactie->to = $to;
        $transactie->amount= $amount;
        return $transactie->save();
    }


    // Generates a 'sentje' IBAN with a set of random characters.
    private function generateIBAN()
    {
        // Available alpha caracters
        $characters = '1234567890';
        // shuffle the result
        $string = str_shuffle($characters);
        $rekeningNummer = "NL83SENTJE" . $string;

        return $rekeningNummer;
    }

    // Generates an IBAN number with our bank signature and a random set of numbers.
    public function update()
    {

    }
}
