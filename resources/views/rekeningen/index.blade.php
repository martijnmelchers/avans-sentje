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
                    
                    
                    @component('rekeningen', ["rekeningen" => $rekeningen])
                    @endcomponent
                    <a href="{{ route('rekeningen.create') }}" class="btn btn-primary">Nieuwe rekening</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
