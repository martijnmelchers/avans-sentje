@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Verzonden sentjes</div>

                <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <td>Titel</td>
                            <td>Bedrag</td>
                            <td>Betalingslink</td>
                            <td>Totaal betaald</td>
                            <td>Opties</td>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($sentjes as $sentje)
                            <tr>
                                <td>{{ $sentje->title }}</td>
                                
                                <td>{{ $sentje->amount }}</td>
                                
                                <td><a href="http://homestead.test/sentje/betalen/{{$sentje->id}}">http://homestead.test/sentje/betalen/{{$sentje->id}}</a></td>
                                
                                <td></td>
                                <td>
                                    <a href="" class="btn btn-danger">Annuleren</a>
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
