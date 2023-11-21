@extends('forms.toile_layout')
    @section('title', 'Toile de com - Liste des enregistrements') 

    @section('content') 


    <div class="container-fluid col-md-12 mt-4 ">
        <div class="row rounded col-md-12">
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title"> <!-- Texte centré -->
                            
                        </div>
                    </div>
                    <div class="card-body  text-center"> 
                        <h1 class="card-title ">Espace <b><i>Toile de Com</i></b>
                            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M160 368c26.5 0 48 21.5 48 48v16l72.5-54.4c8.3-6.2 18.4-9.6 28.8-9.6H448c8.8 0 16-7.2 16-16V64c0-8.8-7.2-16-16-16H64c-8.8 0-16 7.2-16 16V352c0 8.8 7.2 16 16 16h96zm48 124l-.2 .2-5.1 3.8-17.1 12.8c-4.8 3.6-11.3 4.2-16.8 1.5s-8.8-8.2-8.8-14.3V474.7v-6.4V468v-4V416H112 64c-35.3 0-64-28.7-64-64V64C0 28.7 28.7 0 64 0H448c35.3 0 64 28.7 64 64V352c0 35.3-28.7 64-64 64H309.3L208 492z"/></svg>                        </h1>
                        
                    </div>

                </div>

            </div>
            <div class="d-flex flex-row-reverse mb-4 mt-2">
                <a href="{{ route('auth.logout') }}" class="btn btn-warning" style="color: white;">Déconnexion</a>
              </div>
        </div>

    <div class=" mb-4 mt-4">
        <a href="{{ route('toile.index') }}" class="btn btn-outline-primary">Ajouter un nouveau contrat</a>
        <a href="{{ route('export.csv') }}" class="btn btn-success">Export CSV</a>
        <a href="{{ route('export.xml') }}" class="btn btn-danger">Export XML</a>

      </div>
     
      <div class="ajax">
    <div class="table-responsive mb-4">
        <table class="table table-striped">

        <thead>
            <tr>
                {{-- <th>#</th> --}}
                <th>Nom Commercial</th>
                <th>Prénom Commercial</th>
                <th>Type Contrat</th>
                <th>Civilité Client</th>
                <th>Nom Client</th>
                <th>Prénom Client</th>
                <th>Adresse Client</th>
                <th>Code Postal</th>
                <th>Ville</th>
                <th>Email Client</th>
                <th>Fixe Client</th>
                <th>Mobile Client</th>
                <th>IBAN Client</th>
                <th>BIC/Swift Client</th>
                <th>Date Création</th>
                <th>Date Signature</th>
                <th>Date Validation</th>
                <th>Statut</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $key=>$item)
            <tr>
                {{-- <td>{{$key+1}}</td> --}}
                <td>{{ $item->first_name_commercial }}</td>
                <td>{{ $item->last_name_commercial }}</td>
                <td>{{ $item->type_contract }}</td>
                <td>
                    @if ($item->civility  == 1)
                    M
                    @elseif ($item->civility  == 2)
                    Mme
                    @endif
                </td>
                <td>{{ $item->last_name_client }}</td>
                <td>{{ $item->first_name_client }}</td>
                <td>{{ $item->address_client }}</td>
                <td>{{ $item->postal_code_client }}</td>
                <td>{{$item->city_client}}</td>
             
                <td>{{ $item->email_client }}</td>
                <td>{{ $item->landline_phone_client }}</td>
                <td>{{ $item->mobile_phone_client }}</td>
                <td>{{ $item->iban_client }}</td>
                <td>{{ $item->bic_swift_client }}</td>
                <td>{{ date('d-m-Y',$item->date_creation) }}</td>
                <td>{{ date('d-m-Y',$item->date_signature) }}</td>
                <td>{{date('d-m-Y',$item->date_validation)  }}</td>
                <td>@if ($item->status == 0)
                    Actif
                    @elseif ($item->status == 1)
                    Inactif
                    @elseif ($item->status == 2)
                    En attente
                    @endif</td>
            </tr>
            @endforeach
        </tbody>
        
    </table>
   
    </div>
    <div class="d-flex flex-row-reverse ">
        {{ $items->links() }} 
    </div>
    </div>
  

</div>

@endsection