@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">{{__('sentje.card_title')}}</div>
                    <div class="card-body">
                        <ul class="step d-flex flex-nowrap">
                            <li class="step-item {{Request::is('sentje/maken') ? 'active' : ''}}">
                                <a href="{{Request::is('sentje/maken/titel') ? '../maken' : '#'}}" class="">{{__('sentje.amount')}}</a>
                            </li>
                            <li class="step-item  {{Request::is('sentje/maken/titel') ? 'active' : ''}}">
                                <a href="#" class="">{{__('sentje.title')}}</a>
                            </li>
                            <li class="step-item  {{Request::is('sentje/maken/delen') ? 'active' : ''}}">
                                <a href="#" class="">{{__('sentje.share')}}</a>
                            </li>
                        </ul>
                        @yield('form')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
