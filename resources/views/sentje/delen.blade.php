@extends('sentje.base')

@section('form')
    <div class="row justify-content-center">
        <div class="col-8 text-center">
            <h4>{{__('sentje.share_title')}}</h4>
            <p>{{__('sentje.copy_link')}}</p>
            <input type="text" value="{{ env('APP_URL') }}/sentje/betalen/{{$sentje->id}}" disabled
                   class="form-control">
            <p class="mt-2 mb-2">{{__('general.or')}}</p>
            @if($sentje->fixed_amount)
                <a class="btn btn-success"
                   href="https://wa.me/?text={{urlencode(__('sentje.share_text', ['amount' => money_format('%(#1n', $sentje->amount), 'title' => $sentje->title, 'id' => $sentje->id, 'url' => env('APP_URL')]))}}">
                    {{__('sentje.whatsapp_sharing')}}
                </a>
            @else
                <a class="btn btn-success"
                   href="https://wa.me/?text={{urlencode(__('sentje.share_text_custom', ['title' => $sentje->title, 'id' => $sentje->id, 'url' => env('APP_URL')]))}}">
                    {{__('sentje.whatsapp_sharing')}}
                </a>
            @endif
        </div>
    </div>

@endsection
