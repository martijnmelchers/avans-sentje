@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Uw rekeningen</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <td>Naam</td>
                                <td>IBAN</td>
                                <td>Saldo</td>

                                <td>Beheer</td>
                            </tr>
                        </thead>


                        <tbody>
                            @foreach($rekeningen as $rekening)
                            <?php
                                // dd($rekening);
                            ?>
                                <tr>
                                    <td>{{ $rekening->name }}</td>
                                    <td>{{ $rekening->nummer }}</td>
                                    <td>{{ $rekening->saldo }}</td>
                                    <td>
                                        <select name="" id="">
                                            <option value="">
                                                Bewerken
                                            </option>

                                            <option value="">
                                                Verwijderen
                                            </option>
                                        </select>
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
