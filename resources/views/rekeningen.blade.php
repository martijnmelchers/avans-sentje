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
                <td><a href="/rekening/{{$rekening->nummer}}">{{ $rekening->name }}</a></td>
                <td>{{ $rekening->nummer }}</td>
                <td>{{ $rekening->saldo }}</td>
                <td>
                    <select class="form-control" name="" id="">
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