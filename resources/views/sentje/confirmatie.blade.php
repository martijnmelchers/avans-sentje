@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card text-center">
                    <div class="card-body">
                        <h3>{{__('sentje.thanks')}}</h3>
                        <p>{{$user->name}} {{__('sentje.thanks_you')}}</p>
                        <a href="{{env('APP_URL')}}" class="btn btn-success">{{__('general.close')}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
