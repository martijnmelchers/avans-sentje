@extends('sentje.base')

@section('form')
    <form action="/sentje/maken/titel" method="post">
        {{ csrf_field() }}
        <div class="form-group text-center">
            <h4>{{__('sentje.enter_amount')}}</h4>
            <div class="row justify-content-center">
                <div class="col-8">
                    <div class="input-group mb-3 mt-4">
                        <div class="input-group-prepend">
                            <div class="input-group-text">€</div>
                        </div>
                        <input type="number" class="form-control" id="amount" name="amount"
                               placeholder="{{__('sentje.enter_amount_placeholder')}}" step="0.01" min="0.01" required>
                    </div>
                    @if($rekening == "")
                        <h4>{{__('sentje.which_account')}}</h4>
                        <select id="rekening" class="form-control mb-3" required name="rekening">
                            <option hidden selected value="">{{__('sentje.select_account')}}</option>
                            @foreach($rekeningen as $rek)
                                <optgroup label="{{$rek->name}}">
                                    <option value="{{$rek->id}}">{{$rek->nummer}}</option>
                                </optgroup>
                            @endforeach
                        </select>
                    @else
                        <input type="hidden" value="{{$rekening}}" name="rekening">
                    @endif
                    <div class="form-check float-right mb-2 mt-2">
                        <label for="custom">
                            {{__('sentje.custom_amount')}}
                        </label>
                        <input type="checkbox" id="custom" name="custom" onclick="checkCheckbox()">
                    </div>
                    <button type="submit"
                            class="btn btn-primary float-right">{{__('general.next')}}</button>
                </div>
            </div>
        </div>
    </form>
@endsection

<script>
    function toNextStep() {
        event.preventDefault();
        const amount = document.getElementById('amount').value;
        const custom = document.getElementById('custom').checked;

        if ((amount == null || amount <= 0) && !custom) {
            alert('{{__('sentje.minimum_amount_error')}}');
            return;
        }
        const data = {
            amount: amount * 100,
            custom: custom
        };

        localStorage.setItem('data', JSON.stringify(data));
        window.location.href = '/sentje/maken/titel';
    }

    function checkCheckbox() {
        const checked = document.getElementById('custom').checked;
        if (checked) {
            document.getElementById('amount').value = null;
            document.getElementById('amount').placeholder = "-";
            document.getElementById('amount').disabled = true;
        } else {
            document.getElementById('amount').placeholder = "{{__('sentje.enter_amount_placeholder')}}";
            document.getElementById('amount').disabled = false;
        }
    }
</script>
