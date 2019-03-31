@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card text-center">
                    <form method="post">
                        {{csrf_field()}}
                        <div class="card-header">{{__('sentje.pay_sentje')}}</div>
                        <div class="card-body">
                            <div class="row justify-content-center">
                                <div class="col-8">
                                    <p>
                                        {{ __('sentje.pay_info', ['name' => $user->name, 'title' => $sentje->title]) }}
                                    </p>

                                    <div class="mb-3">
                                        <div class="text-left">
                                            <label for="currency">{{__('sentje.select_currency')}}</label>
                                        </div>
                                        <select id="currency" name="currency" class="form-control">
                                            <option selected value="EUR" data-rate="1" data-symbol="€">EUR (€)</option>
                                            @foreach($rates as $rate)
                                                <option value="{{$rate->currency}}" data-rate="{{$rate->rate}}"
                                                        data-symbol="{{$rate->symbol}}">{{$rate->currency}}
                                                    ({{$rate->symbol}})
                                                </option>
                                            @endforeach
                                        </select>
                                        <small>{{__('sentje.exchange_rate_1')}} <span
                                                id="selected_currency">EUR (€)</span> {{__('sentje.exchange_rate_2')}}
                                            <span id="selected_currency_rate">1</span>x
                                        </small>
                                    </div>
                                    @if($sentje->fixed_amount)
                                        <h4 id="amount"></h4>
                                    @else
                                        <label for="amount">{{__('sentje.enter_custom_amount')}}</label>
                                        <div class="input-group mb-1">
                                            <input type="number" class="form-control" id="amount" min="0.01" step="0.01" name="amount"
                                                   placeholder="10,00">
                                        </div>
                                        <div id="different_currency" class="text-left mb-3" hidden>
                                            <b>Bedrag in EUR: <span id="amount_in_euro"></span></b>
                                        </div>
                                    @endif

                                    <div class="text-left">
                                        <label for="name">Van wie is het?</label>
                                    </div>
                                    <input id="name" type="text" name="name" class="form-control mb-3" required>

                                    <div class="text-left">
                                        <label for="message">Voeg een bericht bij</label>
                                    </div>
                                    <textarea class="form-control mb-3" id="message" name="message" required></textarea>

                                    <div class="text-left">
                                        <label for="location">Locatie</label>
                                    </div>
                                    <input id="location" type="text" name="location" class="form-control mb-3">

                                    <button class="btn btn-success btn-block" type="submit">Betalen</button>
                                </div>
                            </div>
                        </div>

                    </form>


                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    var isFixed = {{ $sentje->fixed_amount }};
    var basePrice = {{ $sentje->amount }};
    document.addEventListener('DOMContentLoaded', () => {
        document.getElementById("amount").innerHTML = new Intl.NumberFormat('nl-NL', {
            style: 'currency',
            currency: 'EUR'
        }).format(basePrice);
        var select = document.getElementById("currency");
        select.addEventListener("change", () => {
            var option = select.options[select.selectedIndex];
            var rate = option.dataset.rate;
            var currency = option.value;
            var symbol = option.dataset.symbol;

            if (isFixed) {
                document.getElementById("amount").innerHTML = new Intl.NumberFormat('nl-NL', {
                    style: 'currency',
                    currency: currency
                }).format(basePrice * rate);

            } else {
                document.getElementById("different_currency").hidden = currency === "EUR";
                document.getElementById("amount_in_euro").innerText = new Intl.NumberFormat('nl-NL', {
                    style: 'currency',
                    currency: 'EUR'
                }).format(document.getElementById("amount").value / rate);
            }

            document.getElementById("selected_currency").innerText = `${currency} (${symbol})`;
            document.getElementById("selected_currency_rate").innerText = rate;
        });

        if (!isFixed) {
            var input = document.getElementById("amount");
            input.addEventListener("change", () => {
                var option = select.options[select.selectedIndex];
                var rate = option.dataset.rate;
                var currency = option.value;

                document.getElementById("amount_in_euro").innerText = new Intl.NumberFormat('nl-NL', {
                    style: 'currency',
                    currency: 'EUR'
                }).format(document.getElementById("amount").value / rate);
            })
        }
    }, false);


</script>
