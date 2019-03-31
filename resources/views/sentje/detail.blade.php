@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{__('sentje.detail')}}</div>


                    <div class="card-body">
                        <h3>{{__('sentje.detail_header')}}</h3>
                        <p>
                            {{__('sentje.created_on')}} {{$sentje->created_at}}<br>
                            {{__('sentje.title')}}: {{$sentje->title}}<br>
                            {{__('sentje.table.amount')}}: {{ $sentje->fixed_amount ?  "€" . money_format('%i', $sentje->amount) : __('sentje.self_determine') }}
                        </p>

                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <td>{{__('sentje.detail_table.currency')}}</td>
                                <td>{{__('sentje.detail_table.amount')}}</td>
                                <td>{{__('sentje.detail_table.in_euro')}}</td>
                                <td>{{__('sentje.detail_table.sender')}}</td>
                                <td>{{__('sentje.detail_table.note')}}</td>
                                <td>{{__('sentje.detail_table.location')}}</td>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($sentje->transactions as $transaction)
                                <tr>
                                    <td>
                                        {{$transaction->currency}}
                                    </td>
                                    <td>
                                        {{\App\Http\Controllers\SentjeController::getSymbol($transaction->currency)}}{{money_format('%i', $transaction->amount)}}
                                    </td>
                                    <td>
                                        €{{money_format('%i', $transaction->converted_amount)}}
                                    </td>
                                    <td>
                                        {{$transaction->name}}
                                    </td>
                                    <td>
                                        {{$transaction->message}}
                                    </td>
                                    <td>
                                        {{$transaction->location == null ? __('sentje.empty_location') : $transaction->location}}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
