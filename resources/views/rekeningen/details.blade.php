@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <a href="{{route('rekeningen.index')}}">{{__('accounts.my_accounts')}}</a> > {{$rekening->name}}
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    

                    <div>
                    <h2>{{__('accounts.balance')}}: </h2>
                        <h3>{{$rekening->saldo}}</h2>
                    </div>

                    <hr>
                    <h2>{{__('accounts.transactions.title')}}: </h2>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <td>{{__('accounts.transactions.amount')}}</td>
                                <td>{{__('accounts.transactions.type')}}</td>
                                <td>{{__('accounts.transactions.from')}}</td>
                                <td>{{__('accounts.transactions.to')}}</td>
                            </tr>
                        </thead>


                        <tbody>
                            @foreach($transacties as $transactie)
                                <tr>
                                    <td>{{ $transactie->amount }}</td>
                                    <td>+</td>
                                    <td>{{ $transactie->from }}</td>
                                    <td>{{ $transactie->to }}</td>
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
