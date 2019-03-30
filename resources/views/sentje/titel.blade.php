@extends('sentje.base')

@section('form')
    <form method="post" action="/sentje/maken/create">
        {{ csrf_field() }}
        <div class="form-group text-center">
            <h4>{{__('sentje.enter_title')}}</h4>
            <div class="row justify-content-center">
                <div class="col-8">
                    <input type="text" value="" name="title" placeholder="{{__('sentje.enter_title_placeholder')}}" class="form-control mb-3">

                    <button type="submit" class="btn btn-primary float-right">{{__('general.send')}}</button>
                </div>
            </div>
        </div>
    </form>
@endsection

