@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Mijn rekeningen > {{$rekening->name}}
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    

                    <div>
                    <h2>Saldo: </h2>
                        <h3>{{$rekening->saldo}}</h2>
                    </div>

                    <hr>
                    <h2>Transacties: </h2>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <td>Bedrag</td>
                                <td>Soort</td>
                                <td>van</td>
                                <td>naar</td>

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
