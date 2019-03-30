@extends('sentje.base')

@section('form')
    <div class="row justify-content-center">
        <div class="col-8 text-center">
            <h4>{{__('sentje.share_title')}}</h4>
            {{--<img
                src="https://api.qrserver.com/v1/create-qr-code/?size=250x250&data=http://homestead.test/sentje/betalen/{{$sentje->id}}"
                alt="QR Code" class="mb-3 mt-3"/>--}}
            <p>Kopieer deze link</p>
            <input type="text" value="http://homestead.test/sentje/betalen/{{$sentje->id}}" disabled
                   class="form-control">
            <p class="mt-2 mb-2">of</p>
            @if($sentje->fixed_amount)
                <a class="btn btn-success"
                   href="https://wa.me/?text={{urlencode(__('sentje.share_text', ['amount' => money_format('%(#1n', $sentje->amount), 'title' => $sentje->title, 'id' => $sentje->id]))}}">Delen
                    via Whatsapp</a>
            @else
                <a class="btn btn-success"
                   href="https://wa.me/?text={{urlencode(__('sentje.share_text_custom', ['title' => $sentje->title, 'id' => $sentje->id]))}}">Delen
                    via Whatsapp</a>
            @endif
        </div>
    </div>

@endsection
