@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{__('accounts.create_label')}}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method='post' action="{{ route('rekeningen.store') }}">
                        <div class="form-group">
                            @csrf

                            <label for="name">{{__('accounts.name_label')}}:</label>
                            <input type="text" class="form-control" name="name" >
                            <br>
                            
                            <label for="name">{{__('accounts.holder_label')}}:</label>
                            <br>
                            <input type="text" disabled class="form-control" value="{{ Auth::user()->name }}">
                            <br>

                            <input type="submit" class="form-control" value="{{__('accounts.create_button') }}">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
