@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card text-center">
                    <div class="card-body">
                        <h3>{{__('sentje.error')}}</h3>
                        <p>{{__('sentje.error_text')}}</p>
                        <a href="{{env('APP_URL')}}/sentje/betalen/{{$sentje->id}}" class="btn btn-success">{{__('general.try_again')}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
