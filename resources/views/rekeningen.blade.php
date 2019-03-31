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
            <tr>
                <td><a href="/rekening/{{$rekening->id}}">{{ $rekening->name }}</a></td>
                <td>{{ $rekening->nummer }}</td>
                <td>€{{ money_format("%i", $rekening->saldo) }}</td>

                <td>
                    <a href="{{env('APP_URL')}}/rekening/verwijder/{{$rekening->id}}" class="btn btn-danger {{$rekening->saldo > 0 ? "disabled" : ""}}">{{__('general.delete')}}</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
