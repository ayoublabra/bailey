@extends('forms.toile_layout')
@section('title','Toile de com')
@section('content')

<div class="container-fluid col-md-7 mt-4 ">
    <div class="row rounded">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header d-flex justify-content-between">

                </div>
                <div class="card-title  text-center">
                    <h1 class="card-title ">Espace <b><i>Toile de Com</i></b>
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M160 368c26.5 0 48 21.5 48 48v16l72.5-54.4c8.3-6.2 18.4-9.6 28.8-9.6H448c8.8 0 16-7.2 16-16V64c0-8.8-7.2-16-16-16H64c-8.8 0-16 7.2-16 16V352c0 8.8 7.2 16 16 16h96zm48 124l-.2 .2-5.1 3.8-17.1 12.8c-4.8 3.6-11.3 4.2-16.8 1.5s-8.8-8.2-8.8-14.3V474.7v-6.4V468v-4V416H112 64c-35.3 0-64-28.7-64-64V64C0 28.7 28.7 0 64 0H448c35.3 0 64 28.7 64 64V352c0 35.3-28.7 64-64 64H309.3L208 492z"/></svg>                        </h1>
                    </div>
                    <hr class="mt-2">
                        <div class="card-body ">
                            <div class="mb-3 text-left">
                                <h4 class="alert alert-info">Informations:</h4>
                                <i>- Lors de l'ajout d'un contrat, assurez-vous que l'IBAN saisi est valide et que le client n'a pas eu le même type de contrat  auparavant.</i><br/>
                                <i> - En cas de non-conformité ou de doublon d'IBAN, vous resterez sur le formulaire, empêchant la soumission.</i>  
                            </div>
                       
                        </div>
                     

            </div>

        </div>

    </div>
    

<form  id ="ajaxForm" class="formData" action="{{ route('toile.store') }}" method="post">
    @csrf
        <!-- Identification du créateur (référent commercial) -->
        <div class="row mt-4">
            <div class="d-flex flex-row-reverse mb-4">
                <a href="{{ route('toile.list') }}" class="btn btn-outline-success">Liste des enregistrements</a>
              </div>

            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">
                                <svg width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"> <path fill-rule="evenodd" clip-rule="evenodd" d="M11.9849 15.3462C8.11731 15.3462 4.81445 15.931 4.81445 18.2729C4.81445 20.6148 8.09636 21.2205 11.9849 21.2205C15.8525 21.2205 19.1545 20.6348 19.1545 18.2938C19.1545 15.9529 15.8735 15.3462 11.9849 15.3462Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M11.9849 12.0059C14.523 12.0059 16.5801 9.94779 16.5801 7.40969C16.5801 4.8716 14.523 2.81445 11.9849 2.81445C9.44679 2.81445 7.3887 4.8716 7.3887 7.40969C7.38013 9.93922 9.42394 11.9973 11.9525 12.0059H11.9849Z" stroke="currentColor" stroke-width="1.42857" stroke-linecap="round" stroke-linejoin="round"></path>                                </svg>
                                Identification du créateur (référent commercial)</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="nom">Nom <span style="color: red;">*</span></label>
                            <input type="text" class="form-control" id="last_name" name="last_name"  placeholder="Entrez votre nom" required>
                            <span class="error-message" id="error-last_name" style="color: red;"></span>
                        </div>
                        <div class="mb-3">
                            <label for="prenom">Prénom <span style="color: red;">*</span></label>
                            <input type="text" class="form-control" id="first_name" name="first_name"  placeholder="Entrez votre prénom" required>
                            <span class="error-message" id="error-first_name" style="color: red;"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>


<!-- Assurances -->
<div class="row mt-4">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div class="header-title">
                    <h3 class="card-title">Assurances <span style="color: red;">*</span></h3>
                </div>
            </div>
            <div class="card-body">
                <div class="error-message alert alert-danger " id="error-insurance" style="display: none">
                  
                </div>
                <div class="mb-3">
                    <div class="form-check form-switch">
                        <input class="form-check-input insurance" type="checkbox" id="afElec" name="insurance[]" value=101>
                        <label class="form-check-label" for="afElec">
                            AF ELEC
                        </label>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-check form-switch">
                        <input class="form-check-input insurance" type="checkbox" id="afGaz" name="insurance[]" value=102>
                        <label class="form-check-label" for="afGaz">
                            AF Gaz
                        </label>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-check form-switch">
                        <input class="form-check-input insurance" type="checkbox" id="asPge" name="insurance[]" value=104>
                        <label class="form-check-label" for="asPge">
                            Mon assurance PGE
                        </label>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-check form-switch">
                        <input class="form-check-input insurance" type="checkbox" id="asGFO" name="insurance[]" value=105>
                        <label class="form-check-label" for="asGFO">
                            Mon assurance GFO
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



        <!-- Informations Client -->
        <div class="row mt-4">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Informations client</h4>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="mb-3">
                            <label for="civilite">Civilité <span style="color: red;">*</span></label><br/>
                            <div class="form-check form-check-inline">
                                <label class="form-check-label" for="M">M</label>
                                <input class="form-check-input" type="radio" name="civility" id="M" value=1 required>

                            </div>
                            <div class="form-check form-check-inline">
                                <label class="form-check-label" for="Mme">Mme</label>
                                <input class="form-check-input" type="radio" name="civility" id="Mme" value=2  required>

                            </div>
                        </div>
                        <div class="mb-3 d-flex justify-content-between">
                            <div class="col-md-5 ">
                            <label for="last_name_client">Nom <span style="color: red;">*</span></label>
                            <input type="text" class="form-control" id="last_name_client" name="last_name_client" placeholder="Entrez le nom du client" value="" required>
                            <span class="error-message" id="error-last_name_client" style="color: red;"></span>
                            </div>
                            <div class="col-md-5">
                                <label for="first_name_client">Prénom <span style="color: red;">*</span></label>
                                <input type="text" class="form-control" id="first_name_client" name="first_name_client" placeholder="Entrez le prénom du client" value="" required>
                                <span class="error-message" id="error-first_name_client" style="color: red;"></span>
                            </div>

                        </div>
                        <div class="mb-3">
                            <label for="address_client">Adresse <span style="color: red;">*</span></label>
                            <input type="text" class="form-control" id="address_client" name="address_client" placeholder="Entrez votre adresse" value="" required>
                            <span class="error-message" id="error-address_client" style="color: red;"></span>
                        </div>
                        <div class="mb-3">
                            <label for="postal_code_client">Code Postal <span style="color: red;">*</span></label>
                            <input type="number" class="form-control" id="postal_code_client" name="postal_code_client" placeholder="Entrez le code postal du client" value="" required>
                            <span class="error-message" id="error-postal_code_client" style="color: red;"></span>
                        </div>
                        <div class="mb-3">
                            <label for="city_client">Ville <span style="color: red;">*</span></label>
                            <input type="text" class="form-control" id="city_client" name="city_client" placeholder="Entrez la ville du client" value="" required>
                            <span class="error-message" id="error-city_client" style="color: red;"></span>
                        </div>
                        <div class="mb-3">
                            <label for="email_client">Email <span style="color: red;">*</span></label>
                            <input type="email" class="form-control" id="email_client" name="email_client" placeholder="Entrez l'email du client" value="" required>
                            <span class="error-message" id="error-email_client" style="color: red;"></span>
                        </div>
                        <div class="mb-3">
                            <label for="landline_phone_client">Téléphone Fixe <i style="color:gray;">(Facultatif)</i></label>
                            <input type="tel" class="form-control" id="landline_phone_client" name="landline_phone_client" placeholder="Entrez le téléphone fixe du client" value="" maxlength="20">

                        </div>
                        <div class="mb-3">
                            <label for="mobile_phone_client">Téléphone Mobile <span style="color: red;">*</span></label>
                            <input type="tel" class="form-control" id="mobile_phone_client" name="mobile_phone_client" placeholder="Entrez le votre téléphone du mobile" value="">
                            <span class="error-message" id="error-mobile_phone_client" style="color: red;"></span>
                        </div>
                        <div class="mb-3">
                            <label for="iban_client">IBAN <span style="color: red;">*</span></label>
                            <input type="text" class="form-control" id="iban_client" name="iban_client" placeholder="XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX"  maxlength="37"  value="">
                            <span class="error-message" id="error-iban_client" style="color: red;"></span>
                        </div>
                        <div class="mb-3">
                            <label for="bic_swift_client">BIC<i style="color:gray;"> (Facultatif)</i></label>
                            <input type="text" class="form-control" id="bic_swift_client" name="bic_swift_client" placeholder="XXXXXXXXXXX" value=""maxlength="11" >

                        </div>
                    </div>
                </div>
            </div>
        </div>



           <!-- Dates et Statut du Contrat -->
           <div class="row mt-4">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between ">
                        <div class="header-title">
                            <h4 class="card-title ">Dates et Statut du Contrat</h4>
                        </div>
                    </div>
                    <div class="card-body">

                        <div class="mb-3">
                            <label for="date_creation">Date de saisie/création du contrat <span style="color: red;">*</span></label>
                            <input type="date" class="form-control" id="date_creation"  name="date_creation" required>
                            <span class="error-message" id="error-date_creation" style="color: red;"></span>
                        </div>
                        <div class="mb-3">
                            <label for="date_signature">Date de signature numérique <i style="color:gray;">(Facultatif)</i></label>
                            <input type="date" class="form-control" id="date_signature" name="date_signature" required>
                            <span class="error-message" id="error-date_signature" style="color: red;"></span>
                        </div>
                        <div class="mb-3">
                            <label for="date_validation">Date de validation définitive <i style="color:gray;">(Facultatif)</i></label>
                            <input type="date" class="form-control" id="date_validation" name = "date_validation" required>
                            <span class="error-message" id="error-date_validation" style="color: red;"></span>
                        </div>

                        <div class="mb-3">
                            <label for="status">Statut du contrat <span style="color: red;">*</span></label>
                            <select class="form-control" id="status"  name="status"  required>
                                <option value=1>Inactif</option>
                                <option value=0>Actif</option>
                                <option value=2>En attente</option>



                            </select>
                        </div>




                          <div class="d-flex flex-row-reverse"> <button type="submit" class="btn btn-outline-success" id="submit">Envoyer</button></div>

                    </div>
                </div>
            </div>
        </div>
    </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>


@endsection
