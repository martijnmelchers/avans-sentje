@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Verzonden sentjes</div>

                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <td>Titel</td>
                                <td>Bedrag</td>
                                <td>Rekening</td>
                                <td>Totaal betaald</td>
                                <td>Opties</td>
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
                                        <a href="#"
                                           class="btn btn-danger {{sizeof($sentje->transactions) > 0 ? "disabled" : ""}}">Annuleren</a>
                                        <a href="details/{{$sentje->id}}" class="btn btn-info {{$sentje->cancelled ? "disabled" : ""}}">Informatie</a>
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
