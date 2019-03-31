<table class="table table-striped">
    <thead>
        <tr>
            <td>{{__('accounts.name_label')}}</td>
            <td>{{__('accounts.iban_label')}}</td>
            <td>{{__('accounts.saldo_label')}}</td>

            <td>{{__('accounts.management_label')}}</td>
        </tr>
    </thead>


    <tbody>
        @foreach($rekeningen as $rekening)
            <tr>
                <td><a href="/rekening/{{$rekening->id}}">{{ $rekening->name }}</a></td>
                <td>{{ $rekening->nummer }}</td>
                <td>{{ $rekening->saldo }}</td>
                <td>
                    <select class="form-control" name="" id="">
                        <option value="">
                        {{__('accounts.edit')}}   
                        </option>

                        <option value="">
                        {{__('accounts.delete')}}   
                        </option>
                    </select>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>