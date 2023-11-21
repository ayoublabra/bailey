<div class="ajax">
    <div class="table-responsive mb-4 ">
        <table class="table table-striped ">

        <thead>
            <tr>
                {{-- <th>#</th> --}}
                <th>Nom Commercial</th>
                <th>Prénom Commercial</th>
                <th>Type Contract</th>
                <th>Civilité</th>
                <th>Nom Client</th>
                <th>Prénom Client</th>
                <th>Addresse Client</th>
                <th>Code Postal</th>
                <th>Ville</th>
                <th>Email Client</th>
                <th>Téléphone Fixe Client</th>
                <th>Téléphone Mobile Client</th>
                <th>IBAN Client</th>
                <th>BIC/Swift Client</th>
                <th>Date Création</th>
                <th>Date Signature</th>
                <th>Date Validation</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $key=>$item)
            <tr>
                {{-- <td>{{$key+1}}</td> --}}
                <td>{{ $item->first_name_commercial }}</td>
                <td>{{ $item->last_name_commercial }}</td>
                <td>{{ $item->type_contract }}</td>
                <td>{{ $item->civility }}</td>
                <td>{{ $item->last_name_client }}</td>
                <td>{{ $item->first_name_client }}</td>
                <td>{{ $item->address_client }}</td>
                <td>{{ $item->postal_code_client }}</td>
                <td>{{ $item->city_client }}</td>
                <td>{{ $item->email_client }}</td>
                <td>{{ $item->landline_phone_client }}</td>
                <td>{{ $item->mobile_phone_client }}</td>
                <td>{{ $item->iban_client }}</td>
                <td>{{ $item->bic_swift_client }}</td>
                <td>{{ $item->date_creation }}</td>
                <td>{{ $item->date_signature }}</td>
                <td>{{ $item->date_validation }}</td>
                <td>{{ $item->status }}</td>
            </tr>
            @endforeach
        </tbody>
        
    </table>
   
    </div>
    <div class="d-flex flex-row-reverse ">
        {{ $items->links() }} 
    </div>
    </div>
  