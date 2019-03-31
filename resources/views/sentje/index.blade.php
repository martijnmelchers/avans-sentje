@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{__('sentje.table.card_title')}}</div>

                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <td>{{__('sentje.table.title')}}</td>
                                <td>{{__('sentje.table.amount')}}</td>
                                <td>{{__('sentje.table.account')}}</td>
                                <td>{{__('sentje.table.total_paid')}}</td>
                                <td>{{__('sentje.table.options')}}</td>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($sentjes as $sentje)
                                <tr>
                                    <td>{{ $sentje->title }}</td>

                                    <td>{{ $sentje->fixed_amount ?  "€" . money_format('%i', $sentje->amount) : __('sentje.self_determine') }}</td>

                                    <td>
                                        <a href="/rekening/{{$sentje->rekening->id}}">{{ $sentje->rekening->nummer }}</a>
                                    </td>

                                    <td>
                                        @php
                                            $total = 0;
                                            foreach($sentje->transactions as $transaction)
                                                $total += $transaction->converted_amount;
                                        @endphp
                                        {{"€" . money_format('%i', $total)}}
                                    </td>
                                    <td>
                                        <a href="{{env('APP_URL')}}/sentje/verwijder/{{$sentje->id}}"
                                           class="btn btn-danger {{sizeof($sentje->transactions) > 0 ? "disabled" : ""}}">{{__('general.cancel')}}</a>
                                        <a href="{{env('APP_URL')}}/sentje/details/{{$sentje->id}}" class="btn btn-primary">{{__('general.info')}}</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <a href="{{env('APP_URL')}}/sentje/maken" class="btn btn-primary">{{__('sentje.create')}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
