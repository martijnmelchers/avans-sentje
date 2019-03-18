@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Rekening aanmaken</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method='post' action="{{ route('rekening.store') }}">
                        <div class="form-group">
                            @csrf

                            <label for="name">Rekening naam:</label>
                            <input type="text" class="form-control" name="name" >
                            <br>
                            
                            <label for="name">Rekening houder:</label>
                            <br>
                            <input type="text" disabled class="form-control" value="{{ Auth::user()->name }}">
                            <br>

                            <input type="submit" class="form-control" value="Aanmaken">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
