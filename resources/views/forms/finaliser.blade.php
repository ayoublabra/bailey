<style>
    #brandingLogo {
        display: none;
    }

    .accordion-body {
        padding: 1rem 1.5rem;
    }
/*  ajouter ce commentaire  */
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.5.1/sweetalert2.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.5.1/sweetalert2.all.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
    integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
{{-- <link rel="stylesheet" href="{{ asset('css/state.css') }}"> --}}
<link rel="stylesheet" href="{{ asset('css/state.css') }}">
<x-app-layout :assets="$assets ?? []">

    <div class="progress">
        <div class="progress-bar" role="progressbar" style="width: 10%;" aria-valuenow="25" aria-valuemin="0"
            aria-valuemax="100">Phase 1</div>
    </div>
    @if ($contract->company_id == [101, 104])
        <div class="row row-cols-1">
            <div class="col">
                <div class="card iq-product-custom-card animate:hover-media assfacture">
                    <div style="display: block;width: 40%;margin: auto;">
                        <img src="{{ asset('images/pages/assurance.jpg') }}" alt="product-details"
                            class="img-fluid iq-product-img hover-media logo-check" loading="lazy">
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card iq-product-custom-card animate:hover-media ">
                    <div style="display: block;width: 40%;margin: auto;">
                        <img src="{{ asset('images/pages/pge.jpg') }}" alt="product-details"
                            class="img-fluid iq-product-img hover-media logo-check" loading="lazy">
                    </div>
                </div>
            </div>
        </div>
    @elseif($contract->company_id == [101, 102])
        <div class="row row-cols-1">
            <div class="col">
                <div class="card iq-product-custom-card animate:hover-media assfacture">
                    <div class="display: block;width: 40%;margin: auto;">
                        <img src="{{ asset('images/pages/assurance.jpg') }}" alt="product-details"
                            class="img-fluid iq-product-img hover-media logo-check" loading="lazy">
                    </div>
                </div>
            </div>
        </div>
    @elseif($contract->company_id == 101 || $contract->company_id == 102)
        <div class="row row-cols-1">
            <div class="col">
                <div class="card iq-product-custom-card animate:hover-media assfacture">
                    <div style="display: block;width: 40%;margin: auto;">
                        <img src="{{ asset('images/pages/assurance.jpg') }}" alt="product-details"
                            class="img-fluid iq-product-img hover-media logo-check" loading="lazy">
                    </div>
                </div>
            </div>
        </div>
    @elseif($contract->company_id == 104)
        <div class="row row-cols-1">
            <div class="col">
                <div class="card iq-product-custom-card animate:hover-media assfacture">
                    <div style="display: block;width: 40%;margin: auto;">
                        <img src="{{ asset('images/pages/pge.jpg') }}" alt="product-details"
                            class="img-fluid iq-product-img hover-media logo-check" loading="lazy">
                    </div>
                </div>
            </div>
        </div>
    @elseif($contract->company_id == 105)
        <div class="row row-cols-1">
            <div class="col">
                <div class="card iq-product-custom-card animate:hover-media assfacture">
                    <div style="display: block;width: 40%;margin: auto;">
                        <img src="{{ asset('images/pages/gfo2.jpg') }}" alt="product-details"
                            class="img-fluid iq-product-img hover-media logo-check" loading="lazy">
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="row mt-4">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between ">
                    <div class="header-title">
                    </div>
                </div>
                <div class="card-body">
                    <!-- Champset 1 -->
                    <div id="champset1">
                        <div hidden class="form-group">
                            <label class="form-label">ID: <span class="text-danger">*<span></label>
                            <input type="text" class="form-control" name="contract_id" id="contract_id"
                                value="{{ $contract->id }}" />
                        </div>
                        <div hidden class="form-group">
                            <label class="form-label">ID client: <span class="text-danger">*<span></label>
                            <input type="text" class="form-control" name="client_id" id="client_id"
                                value="{{ $contract->client_id }}" />
                        </div>
                        <div class="d-flex justify-content-between">
                            <div class="header-title">
                                <h4 class="card-title">Mise à jour du Contrat : Données de Demande d’adhésion</h4>
                            </div>
                        </div>

                        <div class="form-card text-start">
                            <div class="row">
                                {{-- clivilte --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Civilité: <span class="text-danger">*<span></label>

                                        <div class="bd-example">
                                            <div class="form-check form-check-inline">
                                                <input type="radio" class="form-check-input" name="civilite"
                                                    id="civilite" value="1"
                                                    @if ($client->civility == 1) checked @endif>
                                                <label for="radio1" class="pl-2 form-check-label">Homme</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input type="radio" class="form-check-input" name="civilite"
                                                    id="civilite" value="2"
                                                    @if ($client->civility == 2) checked @endif>
                                                <label for="radio2" class="pl-2 form-check-label">Femme</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Prénom: <span class="text-danger">*<span></label>
                                        <input type="text" class="form-control" name="lname" id="lname"
                                            required="required" oninput="this.value = this.value.toUpperCase()" value="{{ $client->last_name }}" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Nom: <span class="text-danger">*<span></label>
                                        <input type="text" class="form-control" name="lname" id="fname"
                                            required="required" oninput="this.value = this.value.toUpperCase()" value="{{ $client->first_name }}" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Date de naissance: <span
                                                class="text-danger">*<span></label>
                                        <input type="date" class="form-control" name="datebirth" id="datebirth"
                                            required="required" oninput="this.value = this.value.toUpperCase()" value="{{ $client->date_of_birth }}" />
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Mobile: <span class="text-danger">*<span></label>
                                        <input type="text" class="form-control" name="mobile" id="mobile"
                                            required="required" value="{{ $contract->mobile_phone }}"
                                            maxlength="10" />
                                    </div>
                                </div>
                                @if ($contract->company_id == 105)
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Age:</label>
                                            <input type="text" class="form-control" name="age" id="age"
                                                placeholder="Age" disabled />
                                        </div>
                                    </div>
                                @endif
                                <div class="col-md-6">
                                    <div class="form-group">
                                       <label class="form-label">Tel Fixe: </label>
                                       <input type="text" class="form-control" name="fixe" id="fixe" required="required" placeholder="Tel Fixe" maxlength="10"/>
                                    </div>
                                 </div>
                                 @if($contract->company_id == 105)
                                 <div class="col-md-6">
                                    <div class="form-group">
                                       <label class="form-label">Département de naissance:<span class="text-danger">*<span> </label>
                                       <input type="text" class="form-control" name="departement_naissance" id="departement_naissance" oninput="this.value = this.value.toUpperCase()" value="{{ $contract->departement }}"/>
                                    </div>
                                 </div>
                              @endif

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Email: <span class="text-danger">*<span></label>
                                        <input type="email" class="form-control" name="email" id="email"
                                            required="required" oninput="this.value = this.value.toUpperCase()" value="{{ $contract->email }}" />
                                    </div>
                                </div>
                                @if($contract->company_id == 105)
                                <div class="col-md-6">
                                   <div class="form-group">
                                      <label class="form-label">Commune de naissance:<span class="text-danger">*<span> </label>
                                      <input type="text" class="form-control" name="commune_naissance" id="commune_naissance" oninput="this.value = this.value.toUpperCase()" value="{{ $contract->commune }}" />
                                   </div>
                                </div>
                             @endif
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Confirmer Email: <span
                                                class="text-danger">*<span></label>
                                        <input type="email" class="form-control" name="confirmedemail"
                                            id="confirmedemail" oninput="this.value = this.value.toUpperCase()" required="required"
                                            value="{{ $contract->email }}" />
                                    </div>
                                </div>
                                @if($contract->company_id == 105)
                                <div class="col-md-6">
                                   <div class="form-group">
                                      <label class="form-label">Pays de naissance:<span class="text-danger">*<span> </label>
                                      <input type="text" class="form-control" name="pays_naissance" id="pays_naissance" oninput="this.value = this.value.toUpperCase()" value="{{  $contract->pays }}" />
                                   </div>
                                </div>
                                @endif
                                
                                @if ($contract->company_id == 105)
                                    {{-- <div class="col-md-6"> --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Situation professionnelle : <span
                                                    class="text-danger">*<span></label>
                                            <div style="margin-left: 22%;margin-top: -4%">
                                                <br>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" class="form-check-input"
                                                        name="situation_pro" id="radio7" value="activite" checked>
                                                    <label for="radio7" class="pl-2 form-check-label">En activité
                                                    </label>
                                                </div>
                                                <br>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" class="form-check-input"
                                                        name="situation_pro" id="radio8" value="recherche">
                                                    <label for="radio8" class="pl-2 form-check-label">En recherche
                                                        d’emploi </label>
                                                </div>
                                                <br>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" class="form-check-input"
                                                        name="situation_pro" id="radio9" value="sans_activite">
                                                    <label for="radio9" class="pl-2 form-check-label">Sans activité
                                                    </label>
                                                </div>
                                                <br>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" class="form-check-input"
                                                        name="situation_pro" id="radio10" value="retaite">
                                                    <label for="radio10"
                                                        class="pl-2 form-check-label">Retraité</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Statut de la famille : <span
                                                class="text-danger">*<span></label>



                                        <div class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" name="statu_famille"
                                                id="radio3" value="Célibataire" checked>
                                            <label for="radio3" class="pl-2 form-check-label">Célibataire</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" name="statu_famille"
                                                id="radio4" value="Couple">
                                            <label for="radio4" class="pl-2 form-check-label">Couple</label>
                                        </div>


                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Avec enfant(s): <span
                                                class="text-danger">*<span></label>


                                        <div class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" name="enfant"
                                                id="radio5" value="Oui">
                                            <label for="radio5" class="pl-2 form-check-label">Oui</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" name="enfant"
                                                id="radio6" value="Non">
                                            <label for="radio6" class="pl-2 form-check-label">Non</label>
                                        </div>
                                    </div>
                                    <div id="div_nbr" class="col-md-6" style="display: none">
                                        <div class="">
                                            <label class="form-label">Nombre de personne à charge: <span
                                                    class="text-danger">*<span></label>
                                            <input type="number" style="width: 98%;color:#8A92A6;font-size: 20px"
                                                class="nbr-perss" name="nbr_per" id="nbr_per" required=""
                                                placeholder="Nombre de personne à charge">
                                        </div>
                                    </div>


                                    {{-- </div> --}}
                                @endif
                            </div>
                        </div>
                        {{-- phaseCondition({{$contract->id}}) --}}
                        <button type="button" name="next" class="btn btn-primary action-button float-end"
                            onclick="phaseClient({{ $contract->id }})" id="nxt">Suivant</button>

                    </div>
                    <div id="champset2" style="display: none;">
                        <div class="d-flex justify-content-between">
                            <div class="header-title">
                                <h4 class="card-title">Mise à jour du contrat: Données FIC</h4>
                            </div>
                        </div>
                        <div class="form-card text-start">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Prénom: </label>
                                        <label class="form-label step1lname" id="step1lname"
                                            style="color:#6c757d;">{{ $contract->last_name }}</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Nom: </label>
                                        <label class="form-label step1fname" id="step1fname"
                                            style="color:#6c757d;">{{ $contract->first_name }} </label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Adresse: <span class="text-danger">*<span></label>
                                        <input type="text" class="form-control" name="add1" id="add1"
                                        oninput="this.value = this.value.toUpperCase()" value="{{ $contract->address }}" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">CP <span class="text-danger">*<span></label>
                                        <input type="text" class="form-control" name="cp" id="cp"
                                        oninput="this.value = this.value.toUpperCase()"   value="{{ $contract->postal_code }}" maxlength="5" />
                                    </div>
                                </div>
                                <div id="cyty" class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Ville <span class="text-danger">*<span></label>
                                        <input type="text" class="form-control" name="city" id="city"
                                        oninput="this.value = this.value.toUpperCase()"  value="{{ $contract->city_name }}" disabled/>
                                    </div>
                                    
                                </div>
                                <div style="display: none;" class="col-md-6" id="div_citys">
                                    <label class="form-label">Choisissez la ville:</label>
                                    <div class="form-group">
                                        <select class="form-select form-select-sm" id="citys">
                                            <option selected value="">----------------------------Sélectionner une ville--------------------------</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Département:</label>
                                        <input type="text" class="form-control" name="department_name" id="department_name" placeholder="Département" disabled/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                       <label class="form-label">Région:</label>
                                       <input type="text" class="form-control" name="region_name" id="region_name" placeholder="Région" disabled/>
                                    </div>
                                 </div>

                                


                            </div>
                        </div>

                        <button class="btn btn-danger" onclick="prevPhase(1)">Précédent</button>
                        {{-- onclick="phaseIban({{$contract->id}})" --}}
                        <button type="button" name="next" class="btn btn-primary action-button float-end"
                            onclick="phaseAdresse({{ $contract->id }})" id="nxt">Suivant</button>
                    </div>
                    <!-- Champset 3 -->
                    <div id="champset3" style="display: none; ">
                        {{-- <div class="container mb-4"> --}}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Prénom: </label>
                                        <label class="form-label step1lname" id="step2lname"
                                            style="color:#6c757d;">{{ $client->last_name }}</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Nom: </label>
                                        <label class="form-label step1fname" id="step2fname"
                                            style="color:#6c757d;">{{ $client->first_name }}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-check">

                                    @if ($contract->company_id == 101 || $contract->company_id == 102)
                                        <input class="form-check-input" type="checkbox" name="confirmcheck"
                                            id="confirmcheck" />
                                        <label class="form-check-label maf" for="confirmcheck">
                                            Souhaitez-vous vous prémunir financièrement en cas de de licenciement
                                            économique, cessation d’activité suite à un dépôt de bilan,  affectation
                                            longue durée
                                            (ALD 30 ou ALD 32) ou hospitalisation ?
                                        </label>
                                    @elseif($contract->company_id == 104)
                                        <input class="form-check-input" type="checkbox" name="confirmcheck"
                                            id="confirmcheck" />
                                        <label class="form-check-label map" for="confirmcheck">
                                            Souhaitez-vous vous prémunir financièrement en cas d’une fuite d’eau
                                            intérieure ou extérieure, d’une panne de votre installation électrique 
                                            et / ou de
                                            disfonctionnement de votre chaudière, chauffe-eau ou chauffe-bain ?
                                        </label>
                                    @elseif ($contract->company_id == 105)
                                        <div class="form-card text-start">

                                            <div class="row">



                                                <div class="col-md-6">

                                                    <div class="form-group">

                                                        <label class="form-label">Lors de notre conversation vous nous
                                                            avez indiqué posséder les produit(s) d’assurance(s)
                                                            suivant(s) : <br> (Plusieurs choix possible parmi la
                                                            liste):<span class="text-danger">*<span></label>

                                                        <div class="col-md-6">
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox"
                                                                    id="mutuelle"name="mutuelle">
                                                                <label class="form-check-label"for="mutuelle">Mutuelle</label>
                                                            </div>

                                                            <div class="form-check form-switch">

                                                                <input class="form-check-input" type="checkbox"
                                                                    id="assurance_dece"name="assurance_dece">

                                                                <label class="form-check-label" for="assurance_dece">Assurance Décès</label>

                                                            </div>

                                                            <div class="form-check form-switch">

                                                                <input class="form-check-input" type="checkbox"
                                                                    id="hospitalisation"name="hospitalisation">

                                                                <label class="form-check-label"
                                                                    for="hospitalisation">Hospitalisation</label>

                                                            </div>

                                                            <div class="form-check form-switch">

                                                                <input class="form-check-input" type="checkbox"
                                                                    id="protection"name="protection">

                                                                <label class="form-check-label"
                                                                    for="protection">Protection factures /maintien de
                                                                    revenus</label>

                                                            </div>

                                                            <div class="form-check form-switch">

                                                                <input class="form-check-input" type="checkbox"
                                                                    id="garantie"name="garantie">

                                                                <label class="form-check-label"
                                                                    for="garantie">Garantie accident de la vie</label>

                                                            </div>

                                                            <div class="form-check form-switch">

                                                                <input class="form-check-input" type="checkbox"
                                                                    id="dependance"name="dependance">

                                                                <label class="form-check-label"
                                                                    for="dependance">Dépendance</label>

                                                            </div>

                                                            <div class="form-check form-switch">

                                                                <input class="form-check-input" type="checkbox"
                                                                    id="assurance_vie"name="assurance_vie">

                                                                <label class="form-check-label"
                                                                    for="assurance_vie">Assurance Vie</label>

                                                            </div>

                                                            <div class="form-check form-switch">

                                                                <input class="form-check-input" type="checkbox"
                                                                    id="autre"name="autre">

                                                                <label class="form-check-label"
                                                                    for="autre">Autre</label>

                                                            </div>

                                                            <div class="form-check form-switch">

                                                                <input class="form-check-input" type="checkbox"
                                                                    id="aucun"name="aucun">

                                                                <label class="form-check-label" for="aucun">Je n’ai
                                                                    pas de produit d’assurance </label>

                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6" style="margin-top: 50px;">
                                                    <div class="form-group">
                                                        <label class="form-label">Choisissez le capital:<span
                                                                class="text-danger">*<span></label>
                                                        <select
                                                            style="width: 100%;text-align: center;height: 42px;border-color: #6c757d"
                                                            class="form-select form-select-sm" name="etre_couvert"
                                                            id="etre_couvert">
                                                            <option selected>Selectionnez le capital</option>
                                                            <option value="4000 euros">4000 euros</option>
                                                            <option value="5000 euros">5000 euros</option>
                                                        </select>
                                                    </div>
                                                    <div style="margin-top: 15px">
                                                        <div class="form-group">
                                                            <label class="form-label">Montant de cotisation: <span
                                                                    class="text-danger">*<span></label>
                                                            <input type="text" class="form-control"
                                                                name="montant_de_cotisation"
                                                                id="montant_de_cotisation" required="required"
                                                                placeholder="Montant de cotisation" disabled />
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <div class="form-group">
                                                            <label class="form-label"> Lors de notre conversation vous
                                                                nous avez indiqué posséder les produit(s) d’assurance(s)
                                                                suivant(s) : <br> (Plusieurs choix possible parmi la
                                                                liste):<span class="text-danger">*<span></label>

                                                            <div class="col-md-6">

                                                                <div class="form-check form-switch">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        id="proteger"name="proteger">
                                                                    <label class="form-check-label"
                                                                        for="proteger">Protéger votre famille/proche en
                                                                        cas de décès</label>
                                                                </div>
                                                                <div class="form-check form-switch">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        id="assure_dece"name="assure_dece">
                                                                    <label class="form-check-label"
                                                                        for="assure_dece">Être assuré(e) en cas de
                                                                        décès</label>
                                                                </div>
                                                                <div class="form-check form-switch">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        id="finance_org"name="finance_org">
                                                                    <label class="form-check-label"
                                                                        for="finance_org">Prévoir le financement et
                                                                        l’organisation de vos obsèques</label>
                                                                </div>
                                                                <div class="form-check form-switch">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        id="capital"name="capital">
                                                                    <label class="form-check-label"
                                                                        for="capital">Compléter le capital prévu pour
                                                                        le financement et l’organisation de vos
                                                                        obsèques. </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group" id="lines">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="risque">
                                    <label class="form-check-label" for="risque">Etes-vous assurés contre ce type de
                                        risques ?</label>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="product">
                                    <label class="form-check-label" for="product">Dans l’affirmative, souhaitez-vous
                                        changer de produit et d’assureur ?</label>
                                </div>
                            </div>

                            <div class="form-group div-comment">
                                <label class="form-label" for="exampleFormControlTextarea1">Commentaire</label>
                                <textarea class="form-control" id="comment" rows="5"></textarea>
                            </div>

                            <button class="btn btn-danger" onclick="prevPhase(2)">Précédent</button>
                            {{-- onclick="phaseIban({{$contract->id}})" --}}
                            <button type="button" name="next" class="btn btn-primary action-button float-end"
                                onclick="phaseCommentaire({{ $contract->id }})" id="nxt">Suivant</button>



                        {{-- </div> --}}


                    </div>
                    <!-- Champset 4 -->
                    <div id="champset4" style="display: none;">
                        {{-- <div class="container mb-4"> --}}
                            <div class="d-flex justify-content-between">
                                <div class="header-title">
                                    <h4 class="card-title">Mise à jour du contrat: Données FIC</h4>
                                </div>
                            </div>

                            <div class="form-card text-start">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Prénom: </label>
                                            <label class="form-label step1lname" id="step3lname"
                                                style="color:#6c757d;">{{ $client->last_name }}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Nom: </label>
                                            <label class="form-label step1fname" id="step3fname"
                                                style="color:#6c757d;">{{ $client->first_name }}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Mobile: </label>
                                            <label class="form-label mobile" id="mobile2"
                                                style="color:#6c757d;">{{ $contract->mobile_phone }}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Email: </label>
                                            <label class="form-label email" id="email2"
                                                style="color:#6c757d;">{{ $contract->email }}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Adresse: </label>
                                            <label class="form-label fulladress" id="address2"
                                                style="color:#6c757d;">{{ $contract->address }}</label>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Code postal: </label>
                                            <label class="form-label cp" id="postal_code2"
                                                style="color:#6c757d;">{{ $contract->postal_code }}</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Ville: </label>
                                            <label class="form-label city" id="city2"
                                                style="color:#6c757d;">{{ $contract->city_name }}</label>
                                        </div>
                                    </div>

                                    <div hidden id="pdf_div" class="col-md-6">
                                        <a data-title="PDF" class="navi-link showpdf"
                                            title="Récapitulatif de vos données">
                                            <div
                                                class="p-3 d-flex justify-content-center align-items-center iq-document rounded bg-body">
                                                <img src="{{ asset('images/pages/pdf.svg') }}" class="img-fluid"
                                                    alt="pdf.svg" style="height: 84px;" loading="lazy">
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                @if ($contract->company_id != 105)
                                    <div class="form-group choose1">
                                        <div class="form-check">
                                            <label class="form-check-label" for="invalidCheck2">
                                                - Vous avez besoin de vous prémunir financièrement
                                            </label>
                                        </div>
                                    </div>

                                    <div class="form-group choose2">
                                        <div class="form-check">
                                            <label class="form-check-label" for="invalidCheck2">
                                                - Vous êtes déjà assuré contre ce type de risque et souhaitez changer
                                            </label>
                                        </div>
                                    </div>
                                @endif

                                <br>
                                <div class="row en-comment">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Commentaire: </label>
                                            <label class="form-label comment" id="comment2"
                                                style="color:#6c757d;"></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Contenu de la phase 4 -->
                            <!-- Vous pouvez ajouter ici vos champs et éléments HTML pour la quatrième phase -->
                            <button class="btn btn-danger" onclick="prevPhase(3)">Précédent</button>
                            <button type="button" name="next" class="btn btn-primary action-button float-end"
                                onclick="phaseSms()" id="nxt">Suivant</button>

                        {{-- </div> --}}


                    </div>

                    <!-- Champset 5 -->
                    <div id="champset5" style="display: none;">
                        {{-- <div class="container mb-4"> --}}

                            <div class="d-flex justify-content-between">
                                <div class="header-title">
                                    <h4 class="card-title">Mise à jour du contrat: Données FIC</h4>
                                </div>
                            </div>
                            <div class="form-card text-start">
                                <div class="form-group">
                                    <label class="form-label">Un SMS a été envoyé au <span class="mobile"></span>
                                        contenant un lien pour accéder au FIC.</label>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Le fichier contient un code d’authentification dont la
                                        durée est de 5 min.</label>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Veuillez demander au client de saisir ce code ici
                                        :</label>
                                </div>
                            </div>

                            <div class="otc" name="one-time-code">
                                <div>
                                    <input type="number" pattern="[0-9]*" id="first"  value="" inputtype="numeric" autocomplete="one-time-code" id="otc-1" required>

                                    <!-- Autocomplete not to put on other input -->
                                    <input type="number" pattern="[0-9]*" min="0" max="9" maxlength="1" id="second" value="" inputtype="numeric" id="otc-2" required>
                                    <input type="number" pattern="[0-9]*" min="0" max="9" maxlength="1" id="third" value="" inputtype="numeric" id="otc-3" required>
                                    <input type="number" pattern="[0-9]*" min="0" max="9" maxlength="1" id="fourth" value="" inputtype="numeric" id="otc-4" required>
                                    <input type="number" pattern="[0-9]*" min="0" max="9" maxlength="1" id="fifth" value="" inputtype="numeric" id="otc-5" required>
                                    <input type="number" pattern="[0-9]*" min="0" max="9" maxlength="1" id="sixth" value="" inputtype="numeric" id="otc-6" required>
                                    </div>
                          </div>
                            <div class="row otc1">

                                <a id="resendcode" style="float:right;" href="#"><u>Code non reçu ?</u></a>
                            </div>

                            <!-- Contenu de la phase 4 -->
                            <!-- Vous pouvez ajouter ici vos champs et éléments HTML pour la quatrième phase -->
                            <button class="btn btn-danger" onclick="prevPhase(4)">Précédent</button>
                            <button type="button" name="next" class="btn btn-primary action-button float-end"
                                onclick="phaseCode({{ $contract->id }})" id="nxt">Suivant</button>

                        {{-- </div> --}}


                    </div>
                    <!-- Champset 6 -->
                    <div id="champset6" style="display: none;">
                        {{-- <h2>Phase 4</h2> --}}
                        {{-- <div class="container mb-4"> --}}
                            <div class="d-flex justify-content-between">
                                <div class="header-title">
                                    <h4 class="card-title">Mise à jour du contrat: Données FIC</h4>
                                </div>
                            </div>

                            <div class="form-card text-start">
                                @if ($contract->company_id == 101 || $contract->company_id == 102)
                                    <div class="tab-content maftab">
                                        <div class="tab-pane bd-heading-1 fade show active" id="content-accordion-prv"
                                            role="tabpanel">
                                            <div class="bd-example">
                                                <div class="accordion maf" id="accordionExample">
                                                    <div class="accordion-item">
                                                        <h5 class="accordion-header" id="headingOne">
                                                            <button class="accordion-button collapsed" type="button"
                                                                data-bs-toggle="collapse"
                                                                data-bs-target="#collapseOne" aria-expanded="false"
                                                                aria-controls="collapseOne">
                                                                GARANTIES
                                                            </button>
                                                        </h5>
                                                        <div id="collapseOne" class="accordion-collapse collapse"
                                                            aria-labelledby="headingOne"
                                                            data-bs-parent="#accordionExample" style="">
                                                            <div class="accordion-body">
                                                                <input class="form-check-input" type="checkbox"
                                                                    name="garantiechx"
                                                                    id="garantiechx1{{ $contract->id }}">
                                                                LES GARANTIES SOUSCRITES : 
                                                                L’assuré, à jour de ses cotisations, béneficie d’une
                                                                prise en charge du paiement des factures* suite à la
                                                                réalisation de l’un des risques suivants, mentionnés
                                                                dans la notice d’information du contrat N° LPASPH 001
                                                                :</br>
                                                                - Licenciement économique,</br>
                                                                - Cessation d’activité suite à dépôt de bilan,</br>
                                                                - Affections longues durées (ALD-30) et/ou
                                                                Polypathologies (ALD-32)</br>
                                                                * L’assureur prends en charge 12 mois de factures de
                                                                téléphonie, internet, assurance et énergétique
                                                                (éléctricité et/ou gaz, bois, fuel, etc), dans la
                                                                limite de 1.000,00 €uros par sinistre et par année
                                                                d’assurance (comprenant la part « abonnement » et la
                                                                part « consommation »), sur la base de
                                                                l’offre souscrite par l’assuré auprès de son
                                                                fournisseur.</br>
                                                                L’assuré, à jour de ses cotisations, bénéficie également
                                                                d’une prise en charge des frais médicaux
                                                                d’hospitalisation, égale ou supérieur à 3 jours 
                                                                dans
                                                                la limite de 200 € par événement et par année (factures
                                                                de téléphonie, internet, assurance et énergétique,
                                                                ménage, jardinage etc...)</br>

                                                                <input class="form-check-input" type="checkbox"
                                                                    name="garantiechx"
                                                                    id="garantiechx2{{ $contract->id }}">
                                                                Je reconnais avoir reçu lors de l’adhésion la fiche
                                                                IPID, la notice d’information valant condition générale
                                                                et avoir répondu en toute sincérité  à la
                                                                fiche d’information et de conseil.
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="accordion-item">
                                                        <h5 class="accordion-header" id="headingTwo">
                                                            <button class="accordion-button collapsed" type="button"
                                                                data-bs-toggle="collapse"
                                                                data-bs-target="#collapseTwo" aria-expanded="false"
                                                                aria-controls="collapseTwo">
                                                                CONDITION
                                                            </button>
                                                        </h5>
                                                        <div id="collapseTwo" class="accordion-collapse collapse"
                                                            aria-labelledby="headingTwo"
                                                            data-bs-parent="#accordionExample" style="">
                                                            <div class="accordion-body">
                                                                <input class="form-check-input" type="checkbox"
                                                                    name="garantiechx"
                                                                    id="garantiechx3{{ $contract->id }}">
                                                                <strong>En signant ce bulletin
                                                                    d’adhesion:</strong></br>J’atteste disposer de la
                                                                capacité nécessaire à la conclusion et à l’exécution du
                                                                présent contrat.</br>
                                                                Je reconnais avoir reçu et pris connaissance des
                                                                principales dispositions du contrat collectif n°
                                                                LPASPH001 et je demande à adhérer  à ce
                                                                contrat.</br>
                                                                J’accepte les conditions générales de vente, dont
                                                                l’article 2 alinéa 2 de la notice d’information du
                                                                contrat n° LPASPH001 relatif à la durée  du présent
                                                                bulletin d’adhesion et des conditions de
                                                                résiliation.</br>
                                                                Je confirme ma souscription aux garanties de prise en
                                                                charge du paiement des factures* moyennant un
                                                                abonnement.
                                                                <strong>de 7,90 € TTC par mois  par option
                                                                    d’énergie, avec un engagement de 12 mois,
                                                                    renouvelable par tacite reconduction.</strong>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @elseif($contract->company_id == 104)
                                    <div class="tab-content pgetab">
                                        <div class="tab-pane bd-heading-1 fade show active" id="content-accordion-prv"
                                            role="tabpanel">
                                            <div class="bd-example">
                                                <div class="accordion maf" id="accordionExample">
                                                    <div class="accordion-item">
                                                        <h5 class="accordion-header" id="headingOne">
                                                            <button class="accordion-button collapsed" type="button"
                                                                data-bs-toggle="collapse"
                                                                data-bs-target="#collapseOne" aria-expanded="false"
                                                                aria-controls="collapseOne">
                                                                GARANTIES
                                                            </button>
                                                        </h5>
                                                        <div id="collapseOne" class="accordion-collapse collapse"
                                                            aria-labelledby="headingOne"
                                                            data-bs-parent="#accordionExample" style="">
                                                            <div class="accordion-body">
                                                                <input class="form-check-input" type="checkbox"
                                                                    name="garantiechx"
                                                                    id="garantiechx1{{ $contract->id }}">
                                                                LES GARANTIES SOUSCRITES : 
                                                                L’assuré, à jour de ses cotisations, béneficie d’une
                                                                prise en charge du paiement des factures en cas de
                                                                réparation* suite à la réalisation de  l’un des
                                                                risques suivants, mentionnés dans la notice
                                                                d’information du contrat N°01049859 :</br>
                                                                - fuite d’eau intérieure ou extérieure,</br>
                                                                - panne de l’installation électrique,</br>
                                                                - disfonctionnement de votre chaudière,
                                                                chauffe-eau,</br>
                                                                * L’assureur prend en charge, dans la limite des
                                                                montants ci-dessous, vos frais de réparation en cas de
                                                                :</br>
                                                                1. fuite d’eau intérieure ou extérieure (Intérieure :
                                                                fuite ou engorgement sur circuit d’évacuation, de
                                                                chauffage, ballon, sanitaires et 
                                                                raccordement des appareils avec prise en charge des
                                                                réparations : 600 € par sinistre et par année
                                                                d’assurance); Extérieure : fuite ou  engorgement
                                                                sur circuit d’alimentation en eau ou sur circuit
                                                                d’évacuation avec prise en charge des réparations : 
                                                                1 000 € par sinistre et par année d’assurance).</br>
                                                                2. panne de l’installation électrique (Panne électrique
                                                                sur câblage, tableau électrique, prises, interrupteurs,
                                                                plafonniers et appliques avec  prise
                                                                en charge des réparations : 600 € par sinistre et par
                                                                année d’assurance).</br>
                                                                3. disfonctionnement de votre chaudière (Panne
                                                                accidentelle provoquant l’interruption ou le
                                                                dysfonctionnement de la chaudière ou du 
                                                                chauffe-eau avec prise en charge des réparations : 600 €
                                                                par sinistre et par année d’assurance).</br>
                                                                L’ensemble des sinistres pris en charge est limité à
                                                                deux (2) par année d’assurance.</br>
                                                                <input class="form-check-input" type="checkbox"
                                                                    name="garantiechx"
                                                                    id="garantiechx2{{ $contract->id }}">
                                                                Je reconnais avoir reçu lors de l’adhésion la fiche
                                                                IPID, la notice d’information valant conditions
                                                                générales et avoir répondu en toute sincérité  à
                                                                la fiche d’information et de conseil.
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="accordion-item">
                                                        <h5 class="accordion-header" id="headingTwo">
                                                            <button class="accordion-button collapsed" type="button"
                                                                data-bs-toggle="collapse"
                                                                data-bs-target="#collapseTwo" aria-expanded="false"
                                                                aria-controls="collapseTwo">
                                                                CONDITION
                                                            </button>
                                                        </h5>
                                                        <div id="collapseTwo" class="accordion-collapse collapse"
                                                            aria-labelledby="headingTwo"
                                                            data-bs-parent="#accordionExample" style="">
                                                            <div class="accordion-body">
                                                                <input class="form-check-input" type="checkbox"
                                                                    name="garantiechx"
                                                                    id="garantiechx3{{ $contract->id }}">
                                                                <strong>En signant ce bulletin
                                                                    d’adhesion:</strong></br>J’atteste disposer de la
                                                                capacité nécessaire à la conclusion et à l’exécution du
                                                                présent contrat.
                                                                Je reconnais avoir reçu et pris connaissance <br> des
                                                                principales dispositions du contrat collectif n°
                                                                01048959 et je demande à adhérer à ce contrat. <br>
                                                                J’accepte les conditions générales d’assurance, dont
                                                                l’article 3 de la notice d’information du contrat n°
                                                                01048959 relatif à l <br>
                                                                bulletin d’adhesion et des conditions de
                                                                résiliation.</br>
                                                                Je confirme ma souscription aux garanties de prise en
                                                                charge du paiement des factures en cas de réparation*
                                                                moyennant un abonnement <br>
                                                                <strong>de 13,90 € TTC (11.90 € de prime d’assurance TAC
                                                                    + 2 € de frais de dossier) par mois , avec un
                                                                    engagement de 12 mois, ensuite résiliable <br>à tout
                                                                    moment et
                                                                    renouvelable par tacite reconduction.</strong>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @elseif($contract->company_id == 105)
                                    <div class="tab-content gfotab">
                                        <div class="tab-pane bd-heading-1 fade show active" id="content-accordion-prv"
                                            role="tabpanel">
                                            <div class="bd-example">
                                                <div class="accordion maf" id="accordionExample">
                                                    <div class="accordion-item">
                                                        <h5 class="accordion-header" id="headingOne">
                                                            <button class="accordion-button collapsed" type="button"
                                                                data-bs-toggle="collapse"
                                                                data-bs-target="#collapseOne" aria-expanded="false"
                                                                aria-controls="collapseOne">
                                                                GARANTIES
                                                            </button>
                                                        </h5>
                                                        <div id="collapseOne" class="accordion-collapse collapse"
                                                            aria-labelledby="headingOne"
                                                            data-bs-parent="#accordionExample" style="">
                                                            <div class="accordion-body">
                                                                <input class="form-check-input" type="checkbox"
                                                                    name="garantiechx"
                                                                    id="garantiechx1{{ $contract->id }}">
                                                                Le contrat Garantie Frais d’Obsèques prévoit, en cas de
                                                                décès :</br>
                                                                - Le <strong> versement d'un capital au(x)
                                                                    bénéficiaire(s) de votre choix</strong> (personne
                                                                physique ou entreprise funéraire) <strong> destiné au
                                                                    financement des <br> obsèques. Vous choisissez le
                                                                    montant du capital souhaité (de 4 000 à 5 000
                                                                    euros);</strong></br>
                                                                -Des <strong> prestations d'assistance
                                                                </strong>permettant d'anticiper l'organisation des
                                                                obsèques et d'accompagner vos proches dans ces moments
                                                                difficiles.</br>
                                                                Le détail des prestations d’assurance et d’assistance
                                                                est reporté à l'article 3 des Conditions Générales,
                                                                ci-jointes, valant note d'information.</br>
                                                                La durée du contrat s’étend à votre vie entière sous
                                                                réserve du paiement des cotisations.</br>
                                                                <strong> Nous attirons votre attention sur le fait que
                                                                    le capital décès ne peut être utilisé </strong>, à
                                                                concurrence de leur coût <strong>à des fins étrangères
                                                                    au <br> financement des obsèques . Selon le montant
                                                                    choisi </strong>, le capital <strong>peut être
                                                                    insuffisant pour couvrir l’ensemble des frais
                                                                    d’obsèques.</strong> </br>
                                                                Par ailleurs, la<strong> rédaction de la clause
                                                                    bénéficiaire </strong>est
                                                                <strong>importante</strong> notamment en termes
                                                                d’identité lors de l’indication du ou des
                                                                bénéficiaire(s) <br> et il est opportun de désigner
                                                                un/des bénéficiaire(s) subséquent(s) en cas de
                                                                disparition anticipée de la personne ou opérateur
                                                                funéraire <br> désigné(e). <br>
                                                                <strong> Vous pourrez modifier les bénéficiaires de ce
                                                                    contrat à tout moment. Il est possible que ces
                                                                    derniers doivent avancer les fonds dans <br>
                                                                    l’attente de règlement du capital.</strong></br>

                                                                <strong>N’oubliez pas d’informer vos proches de
                                                                    l’existence du contrat d’assurance.</strong></br>
                                                                <strong>En cas de sinistre</strong> , la déclaration
                                                                doit être faite à l’assureur dans les 30 jours suivant
                                                                sa survenance. Le paiement du capital garanti se fait
                                                                <br> dans les 15 jours suivants la réception du dossier
                                                                complet. Vous pouvez retrouver le détail des conditions
                                                                de prise en charge et la liste <br> des pièces à fournir
                                                                dans les Conditions Générales (article 10 – Que faire en
                                                                cas de sinistre ?)</br>
                                                                <input class="form-check-input" type="checkbox"
                                                                    name="garantiechx"
                                                                    id="garantiechx2{{ $contract->id }}">
                                                                La notice d’information valant conditions générales et
                                                                avoir lu et répondu en toute sincérité à la fiche
                                                                d’information et de conseil.
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="accordion-item">
                                                        <h5 class="accordion-header" id="headingTwo">
                                                            <button class="accordion-button collapsed" type="button"
                                                                data-bs-toggle="collapse"
                                                                data-bs-target="#collapseTwo" aria-expanded="false"
                                                                aria-controls="collapseTwo">
                                                                CONDITIONS
                                                            </button>
                                                        </h5>
                                                        <div id="collapseTwo" class="accordion-collapse collapse"
                                                            aria-labelledby="headingTwo"
                                                            data-bs-parent="#accordionExample" style="">
                                                            <div class="accordion-body">
                                                                <input class="form-check-input" type="checkbox"
                                                                    name="garantiechx"
                                                                    id="garantiechx3{{ $contract->id }}">
                                                                Nous attirons votre attention sur les limites de
                                                                couverture du contrat et vous invitons à prendre
                                                                connaissance, notamment, des exclusions <br> à l'article
                                                                4 des Conditions Générales valant note d’information.
                                                                Sont exclus par exemple le décès résultant d’un accident
                                                                antérieur à la prise <br> d’effet des garanties ; le
                                                                suicide au cours de la première année, etc… Par
                                                                ailleurs, <strong>en cas de décès survenant dans les
                                                                    deux premières années <br> d'assurance du fait d'un
                                                                    événement non accidentel (maladie), la garantie sera
                                                                    limitée au remboursement des cotisations versées
                                                                    hors <br> cotisations d’assistance.</strong></br>



                                                                -Les conséquences d’accidents survenus avant la prise
                                                                d’effet des garanties.</br>
                                                                -Le suicide ou la tentative de suicide survenant moins
                                                                d’un an après la prise d’effet du contrat. En cas
                                                                d’augmentation des garanties en cours <br> de contrat,
                                                                le risque de suicide est également exclu, pour les
                                                                majorations, au cours de la première année qui suit la
                                                                prise d’effet <br> de cette augmentation.</br>
                                                                -Le fait de guerre civile ou étrangère,</br>
                                                                -Le décès survenant sous l’emprise d’état consécutif à
                                                                l’utilisation de stupéfiants, substances analogues,
                                                                médicaments ou traitements à doses <br> non prescrites
                                                                médicalement, ou de l’état alcoolique de l’assure,
                                                                caractérise par la présence, dans le sang, d’un taux
                                                                d’alcool pur égal ou <br> supérieur à celui fixe par la
                                                                loi régissant la circulation automobile au moment du
                                                                sinistre.</br>
                                                                Nous n’aurons pas à apporter la preuve de l’existence
                                                                d’un lien de causalité entre le décès et l’état de
                                                                l’assuré. Voir le détail des garanties, <br> conditions,
                                                                limites et exclusions applicables dans la notice
                                                                d’information.</br>




                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <!-- Contenu de la phase 4 -->
                            <!-- Vous pouvez ajouter ici vos champs et éléments HTML pour la quatrième phase -->
                            <br>
                            <br>
                            <button class="btn btn-danger" onclick="prevPhase(5)">Précédent</button>
                            <button type="button" name="next" class="btn btn-primary action-button float-end"
                                onclick="phaseGarantie({{ $contract->id }})" id="nxt">Suivant</button>

                        {{-- </div> --}}


                    </div>
                    <!-- Champset 7 -->
                    <div id="champset7" style="display: none;">
                        {{-- <h2>Phase 4</h2> --}}
                        {{-- <div class="container mb-4"> --}}


                            <div class="form-card text-start">
                                <div class="d-flex justify-content-between">
                                    <div class="header-title">
                                        <h4 class="card-title">Mise à jour du contrat: Données de Demande d’adhésion
                                        </h4>
                                    </div>
                                    
                                </div>
                                <div class="form-card text-start">
                                    <div class="row">
                                        <div class="col-7">
                                            <h4 class="mb-4">Données CONTRAT - Banque:</h4>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Prénom: </label>
                                                <label class="form-label step1lname" id="step4lname"
                                                    style="color:#6c757d;">{{ $contract->last_name }}</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Nom: </label>
                                                <label class="form-label step1fname" id="step4fname"
                                                    style="color:#6c757d;">{{ $contract->first_name }}</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <input class="form-check-input" type="checkbox" name="confirmcertif"
                                            id="confirmcertif" />
                                        <label class="form-check-label" for="confirmcertif">Je certifie être le
                                            titulaire de l'Iban/Bic suivant</label>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">IBAN:</label>
                                        <input type="text" class="form-control" id="iban"
                                        oninput="this.value = this.value.toUpperCase()" value="{{ $contract->iban }}" />
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">BIC:</label>
                                        <input type="text" class="form-control" id="bic"
                                        oninput="this.value = this.value.toUpperCase()"  value="{{ $contract->bic_swift }}" />
                                    </div>
                                    @if ($contract->company_id != 105)
                                        <div class="form-group">
                                            <label class="form-label">Choix du jour de prélévement</label>
                                            <select style="background-repeat: no-repeat;
                                            background-position: right 1rem center;
                                            background-size: 16px 12px;
                                            border: 1px solid #eee;
                                            border-radius: 0.5rem;
                                            -moz-appearance: none;
                                            background-color: white;padding: 0.5rem 3rem 0.5rem 1rem;color: #8A92A6;  -moz-padding-start: calc(1rem - 3px);
                                            " id="days_normal">
                                                <option selected="" value="">---------Sélectionner votre
                                                    choix--------</option>
                                            </select>
                                        </div>
                                    @endif



                                </div>
                            </div>
                            <!-- Contenu de la phase 4 -->
                            <!-- Vous pouvez ajouter ici vos champs et éléments HTML pour la quatrième phase -->
                            <button class="btn btn-danger" onclick="removeDays()">Précédent</button>
                            <button type="button" name="next" class="btn btn-primary action-button float-end"
                                onclick="phaseDays({{ $contract->id }})" id="nxt">Suivant</button>

                        {{-- </div> --}}


                    </div>
                    <!-- Champset 8 -->
                    <div id="champset8" style="display: none;">
                        {{-- <h2>Phase 4</h2> --}}
                        {{-- <div class="container mb-4"> --}}
                            <div class="d-flex justify-content-between">
                                <div class="header-title1">
                                    <h4 class="card-title">Mise à jour du contrat: Données de Demande d’adhésion</h4>
                                </div>
                            </div>
                            <div class="form-card text-start oldsectionpdl">
                                @if ($contract->company_id == 101)
                                    <div class="form-group partelec">
                                        <label class="form-label">PDL Elec:</label>
                                        <input type="text" class="form-control" id="pdlElec"
                                            placeholder="PDL Elec" maxlength="14" />
                                    </div>
                                    <div class="form-group partelec">
                                        <label class="form-label">Fournisseur Elec:</label>
                                        <select class="form-select" id="f-elec" disabled>
                                            <option selected="" disabled="" value="">Sélectionner un
                                                fournisseur</option>
                                        </select>
                                    </div>
                                @elseif($contract->company_id == 102)
                                    <div class="form-group partgaz">
                                        <label class="form-label">PDL Gaz:</label>
                                        <input type="text" class="form-control" id="pdlGaz"
                                            placeholder="PDL Gaz" maxlength="14" />
                                    </div>
                                    <div class="form-group partgaz">
                                        <label class="form-label">Fournisseur Gaz:</label>
                                        <select class="form-select" id="f-gaz" disabled>
                                            <option selected="" disabled="" value="">Sélectionner un
                                                fournisseur</option>
                                        </select>
                                    </div>
                                @endif



                            </div>
                            <button class="btn btn-primary" onclick="resetFournisseur()">Précédent</button>
                            <button type="button" name="next" class="btn btn-primary action-button float-end"
                                onclick="phaseFournisseur()" id="nxt">Suivant</button>
                        {{-- </div> --}}
                    </div>
                    <!-- Champset 9 -->
                    <div id="champset9" style="display: none;">
                        {{-- <h2>Phase 4</h2> --}}
                        {{-- <div class="container mb-4"> --}}
                            <div class="d-flex justify-content-between">
                                <div class="header-title">
                                    <h4 class="card-title">Mise à jour du contrat: Données de Demande d’adhésion</h4>
                                </div>
                                
                            </div>
                            <div class="form-card nxtsectionpdl">
                                <div class="row">
                                    <div class="col-7">
                                        <h4 class="mb-4 text-left">Finalisation:</h4>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Prénom: </label>
                                            <label class="form-label step1lname" id="step5lname"
                                                style="color:#6c757d;">{{ $contract->last_name }}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Nom: </label>
                                            <label class="form-label step1fname" id="step5fname"
                                                style="color:#6c757d;">{{ $contract->last_name }}</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Email: </label>
                                            <label class="form-label email" id="email3"
                                                style="color:#6c757d;">{{ $contract->email }}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">IBAN: </label>
                                            <label class="form-label iban" id="iban2"
                                                style="color:#6c757d;">{{ $contract->iban }}</label>
                                        </div>
                                    </div>
                                </div>


                                <div class="card" style="box-shadow: 0 10px 30px 0 rgba(0, 0, 0, 0.31);">
                                    <div class="card-body">
                                        <p>En confirmant, vous allez recevoir un email à l’adresse <a> <u><span
                                                        class="form-label email" id="email4"
                                                        style="color:#6c757d;">{{ $contract->email }}</span></u>
                                                </u></a> avec le lien de signature électronique</p>
                                    </div>
                                </div>
                                <button class="btn btn-danger" onclick="retourArriere()">Précédent</button>
                                <button type="button" name="next" class="btn btn-primary action-button float-end"
                                    onclick="phaseDocusign()">Suivant</button>
                            </div>
                        {{-- </div> --}}
                    <div id="champset10" style="display: none;">
                        {{-- <h2>Phase 4</h2> --}}
                        {{-- <div class="container mb-4"> --}}
                            <div class="d-flex justify-content-between">
                                <div class="header-title">
                                    <h4 class="card-title">Mise à jour du contrat: Données de Demande d’adhésion
                                    </h4>
                                </div>
                            </div>
                            <div class="form-card nxtsectionpdl">
                                <div class="row">
                                    <div class="col-7">
                                        <h4 class="mb-4 text-left">Finalisation:</h4>
                                    </div>
                                    <div class="col-5">
                                    </div>
                                </div>

                                <svg class="svgok" version="1.1" x="0" y="0"
                                    width="150px" height="150px" viewBox="-10 -10 120 120"
                                    enable-background="new 0 0 200 200" xml:space="preserve">
                                    <path class="circle" d="M0,50 A50,50,0 1 1 100,50 A50,50,0 1 1 0,50" />
                                </svg>
                                <h2 class="text-success text-center"><strong>SUCCESS !</strong></h2>

                                <br>
                                <br><br>




                            </div>
                        {{-- </div> --}}


                    </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
    </div>
    </div>
    </div>



</x-app-layout>


<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script src="https://code.jscharting.com/latest/jscharting.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script type="text/javascript">
    var gender = '';
    var fname = '';
    var lname = '';
    var mobile = '';
    var date_naissance = '';
    var email = '';
    var iban = '';
    var bic = '';
    var age = '';
    var departement_naissance='';
    var commune_naissance='';
    var pays_naissance='';
    var x = '';
    var company_id = '';
    var contract_id = '';
    var city = '';
    var address = '';
    var postal_code = '';
    var postal_code2 = '';
    var comment = '';
    var comment2 = '';
    var product = 0;
    var risque = 0;
    var code = '';
    var garantiechx1 = '';
    var garantiechx2 = '';
    var garantiechx3 = '';
    var confirmcertif = '';
    var days = '';
    var checkfinancementsymbol = "√ Oui";
    var checkrisquesymbol = "Non";
    var checkproductsymbol = "Non";
    var checkfinancement = "Oui";
    var checkrisque = "Non";
    var checkproduct = "Non";
    var checkfinancementicon = yes;
    var checkrisqueicon = no;
    var checkproducticon = no;
    var yes = '<img src="./images/pages/checked.png" style="margin-bottom:-4px;" width="15px" height="15px">';
    var no = '<img src="./images/pages/unchecked.png" style="margin-bottom:-4px;" width="15px" height="15px">';
    var yes_pgo = '<img src="./images/pages/checked.png" style="margin-bottom:-4px;" width="10px" height="10px">';
    var no_pgo = '<img src="./images/pages/unchecked.png" style="margin-bottom:-4px;" width="10px" height="10px">';
    var checkMutuelle = "Non";
    var checkAssuranceDece = "Non";
    var checkHospitalisation = "Non";
    var checkProtection = "Non";
    var checkGarentie = "Non";
    var checkDependance = "Non";
    var checkAutre = "Non";
    var checkAucun = "Non";
    var checkAssuranceVie = "Non";
    var checkProtegerFamille = "Non";
    var checkEtreAssurer = "Non";
    var checkPrevoirFinance = "Non";
    var checkCompleteCap = "Non";
    var mutuelle = 0;
    var assurance_Dece = 0;
    var assurance_vie = 0;
    var hospitalisation = 0;
    var protection = 0;
    var garantie = 0;
    var dependance = 0;
    var autre = 0;
    var aucun = 0;
    var proteger_famille = 0;
    var etre_assurer = 0;
    var prevoir_finace = 0;
    var complete_cap = 0;
    var nbr_pers_a_charger = '';
    var pdl_number = [];
    var pdlElec = '';
    var pdlGaz = '';
    var fElec = '';
    var fGaz = '';
    var idfElec = '';
    var idfGaz = '';
    var date = new Date();
    var sendSMSresponde=[];
    var dateenvoi="";
    var minutes=0;
    //step 4
    var random=0;
    var date ='';
    var datenow ='';




    var checkMutuelleIcon = no_pgo;
    var checkAssuranceDeceIcon = no_pgo;
    var checkHospitalisationIcon = no_pgo;
    var checkProtectionIcon = no_pgo;
    var checkGarentieIcon = no_pgo;
    var checkDependanceIcon = no_pgo;
    var checkAutreIcon = no_pgo;
    var checkAucunIcon = no_pgo;
    var checkAssuranceVieIcon = no_pgo;
    var checkProtegerFamilleIcon = no_pgo;
    var checkEtreAssurerIcon = no_pgo;
    var checkPrevoirFinanceIcon = no_pgo;
    var checkCompleteCapIcon = no_pgo;
    var currentPhase = 1;


    var checkAssuranceVieSymbol = "Non";
    var checkMutuelleSymbol = "Non";
    var checkAssuranceDeceSymbol = "Non";
    var checkHospitalisationSymbol = "Non";
    var checkProtectionSymbol = "Non";
    var checkGarentieSymbol = "Non";
    var checkDependanceSymbol = "Non";
    var checkproductSymbol = "Non";
    var checkAutreSymbol = "Non";
    var checkAucunSymbol = "Non";
    var checkProtegerFamilleSymbol = "Non";
    var checkEtreAssurerSymbol = "Non";
    var checkPrevoirFinanceSymbol = "Non";
    var checkCompleteCapSymbol = "Non";
    var etre_couvert = '';
    var bgtxt1 = '';
    var bgtxt2 = '';
    var option1 = '';
    var option2 = '';
    var montant_de_cotisation = '';






    function _ResuptionOfContract(id) {
        window.location.href = '/forms/wizard';
    }

    //    let currentPhase = 1;

    document.addEventListener('DOMContentLoaded', function() {
        const progressBar = document.querySelector('.progress-bar');
        progressBar.style.width = '10%';
        progressBar.textContent = 'Phase 1';
    });
    var uname = <?php echo json_encode(auth()->user()->username); ?>;
    var uid = <?php echo json_encode(auth()->user()->id); ?>;
    $(document).on("click", "a.showpdf", function() {
        click = true;
        window.open('/getDocumentNoCodeFinalisation/user=' + uname + '-' + uid, '_blank',
            'location=yes,height=600,width=900,top=400,left=400,scrollbars=yes,status=yes');
    });
    $.ajax({ // get Role 
        url: '/getRole/'+uid,
        method: 'GET',
        success: function(response) {
        for (let index = 0; index < response.length; index++) {
            const role = response[index];
            // console.log(role.item_name);
            if (role.item_name ==='conseiller'|| role.item_name ==='superadmin' ) {
                var element = document.getElementById("pdf_div");
                element.removeAttribute("hidden"); // no effect

            }
            
        }
        },
        error: function(xhr, status, error) {
        alert('no role for this user'+<?php echo json_encode(auth()->user()->username)?>);
        }
    });

    function nextPhase(next) {
        // console.log("success");
        // console.log(next);
        // console.log(currentPhase);
        document.getElementById(`champset${(currentPhase)}`).style.display = "none";
        document.getElementById(`champset${next}`).style.display = "block";
        currentPhase = next;

        const progressBar = document.querySelector('.progress-bar');
        progressBar.style.width = `${(currentPhase - 1) * 10 + 10}%`; // Augmente de 10% à chaque phase
        progressBar.textContent = `Phase ${currentPhase}`;



    }
    $("#first, #second, #third, #fourth, #fifth, #sixth").val('');

    $("#lines").hide();
    $(".div-comment").hide();
    // $('.text-success').hide();

    $('#confirmcheck').change(function() {
        var $check = $(this);

        checkfinancement = "";
        checkfinancementsymbol = "";
        checkfinancementsyicon = "";

        if ($check.prop('checked')) {
            $("#lines").show();
            $(".choose1, .choose2, .line-comment, .en-comment").show();
            checkfinancement = "Oui";
            checkfinancementsymbol = "√ Oui";
            checkfinancementsyicon = yes;
        } else {
            $("#lines").hide();
            $(".choose1, .choose2, .line-comment, .en-comment, .div-comment").hide();
            checkfinancement = "Non";
            checkfinancementsymbol = "Non";
            checkfinancementsyicon = no;
        }
    });

    $('#risque').change(function() {
        var $check = $(this);

        checkrisque = "";
        checkrisquesymbol = "";
        checkrisqueicon = "";

        if ($check.prop('checked')) {
            risque = 1;
            checkrisque = "Oui";
            checkrisquesymbol = "√ Oui";
            checkrisqueicon = yes;
        } else {
            risque = 0;
            checkrisque = "Non";
            checkrisquesymbol = "Non";
            checkrisqueicon = no;

        }
    });

    $('#product').change(function() {
        var $check = $(this);

        checkproduct = "";
        checkproductsymbol = "";
        checkproducticon = "";

        if ($check.prop('checked')) {
            $(".div-comment").show();
            $("#comment").show();
            product = 1;
            checkproduct = "Oui";
            checkproductsymbol = "√ Oui";
            checkproducticon = yes;
        } else {
            $(".div-comment").hide();
            $("#comment").hide();
            product = 0;
            checkproduct = "Non";
            checkproductsymbol = "Non";
            checkproducticon = no;
        }
    });
    $('#mutuelle').change(function() {
        var $check = $(this);

        checkMutuelle = "";
        checkMutuelleSymbol = "";
        checkMutuelleIcon = "";

        if ($check.prop('checked')) {
            mutuelle = 1;
            checkMutuelle = "Oui";
            checkMutuelleSymbol = "√ Oui";
            checkMutuelleIcon = yes_pgo;
        } else {
            mutuelle = 0;
            checkMutuelle = "Non";
            checkMutuelleSymbol = "Non";
            checkMutuelleIcon = no_pgo;

        }
    });
    $('#assurance_dece').change(function() {
        var $check = $(this);

        checkAssuranceDece = "";
        checkAssuranceDeceSymbol = "";
        checkAssuranceDeceIcon = "";

        if ($check.prop('checked')) {
            assurance_dece = 1;
            checkAssuranceDece = "Oui";
            checkAssuranceDeceSymbol = "√ Oui";
            checkAssuranceDeceIcon = yes_pgo;
        } else {
            assurance_dece = 0;
            checkAssuranceDece = "Non";
            checkAssuranceDeceSymbol = "Non";
            checkAssuranceDeceIcon = no_pgo;

        }
    });
    $('#hospitalisation').change(function() {
        var $check = $(this);

        checkHospitalisation = "";
        checkHospitalisationSymbol = "";
        checkHospitalisationIcon = "";

        if ($check.prop('checked')) {
            hospitalisation = 1;
            checkHospitalisation = "Oui";
            checkHospitalisationSymbol = "√ Oui";
            checkHospitalisationIcon = yes_pgo;
        } else {
            hospitalisation = 0;
            checkHospitalisation = "Non";
            checkHospitalisationSymbol = "Non";
            checkHospitalisationIcon = no_pgo;

        }
    });
    $('#protection').change(function() {
        var $check = $(this);

        checkProtection = "";
        checkProtectionSymbol = "";
        checkProtectionIcon = "";

        if ($check.prop('checked')) {
            protection = 1;
            checkProtection = "Oui";
            checkProtectionSymbol = "√ Oui";
            checkProtectionIcon = yes_pgo;
        } else {
            protection = 0;
            checkProtection = "Non";
            checkProtectionSymbol = "Non";
            checkProtectionIcon = no_pgo;

        }
    });
    $('#garantie').change(function() {
        var $check = $(this);

        checkGarentie = "";
        checkGarentieSymbol = "";
        checkGarentieIcon = "";

        if ($check.prop('checked')) {
            garantie = 1;
            checkGarentie = "Oui";
            checkGarentieSymbol = "√ Oui";
            checkGarentieIcon = yes_pgo;
        } else {
            garantie = 0;
            checkGarentie = "Non";
            checkGarentieSymbol = "Non";
            checkGarentieIcon = no_pgo;

        }
    });
    $('#dependance').change(function() {
        var $check = $(this);

        checkDependance = "";
        checkDependanceSymbol = "";
        checkDependanceIcon = "";

        if ($check.prop('checked')) {
            dependance = 1;
            checkDependance = "Oui";
            checkDependanceSymbol = "√ Oui";
            checkDependanceIcon = yes_pgo;
        } else {
            dependance = 0;
            checkDependance = "Non";
            checkDependanceSymbol = "Non";
            checkDependanceIcon = no_pgo;

        }
    });

    $('#assurance_vie').change(function() {
        var $check = $(this);

        checkAssuranceVie = "";
        checkAssuranceVieSymbol = "";
        checkAssuranceVieIcon = "";

        if ($check.prop('checked')) {
            assurance_vie = 1;
            checkAssuranceVie = "Oui";
            checkAssuranceVieSymbol = "√ Oui";
            checkAssuranceVieIcon = yes_pgo;
        } else {
            assurance_vie = 0;
            checkAssuranceVie = "Non";
            checkAssuranceVieSymbol = "Non";
            checkAssuranceVieIcon = no_pgo;

        }
    });
    $('#autre').change(function() {
        var $check = $(this);

        checkAutre = "";
        checkAutreSymbol = "";
        checkAutreIcon = "";

        if ($check.prop('checked')) {
            autre = 1;
            checkAutre = "Oui";
            checkAutreSymbol = "√ Oui";
            checkAutreIcon = yes_pgo;
        } else {
            autre = 0;
            checkAutre = "Non";
            checkAutreSymbol = "Non";
            checkAutreIcon = no_pgo;

        }
    });
    $('#aucun').change(function() {
        var $check = $(this);

        checkAucun = "";
        checkAucunSymbol = "";
        checkAucunIcon = "";

        if ($check.prop('checked')) {
            aucun = 1;
            checkAucun = "Oui";
            checkAucunSymbol = "√ Oui";
            checkAucunIcon = yes_pgo;
        } else {
            aucun = 0;
            checkAucun = "Non";
            checkAucunSymbol = "Non";
            checkAucunIcon = no_pgo;

        }
    });

    $('#proteger').change(function() {
        var $check = $(this);

        checkProtegerFamille = "";
        checkProtegerFamilleSymbol = "";
        checkProtegerFamilleIcon = "";

        if ($check.prop('checked')) {
            proteger_famille = 1;
            checkProtegerFamille = "Oui";
            checkProtegerFamilleSymbol = "√ Oui";
            checkProtegerFamilleIcon = yes_pgo;
        } else {
            proteger_famille = 0;
            checkProtegerFamille = "Non";
            checkProtegerFamilleSymbol = "Non";
            checkProtegerFamilleIcon = no_pgo;

        }
    });
    $('#assure_dece').change(function() {
        var $check = $(this);

        checkEtreAssurer = "";
        checkEtreAssurerSymbol = "";
        checkEtreAssurerIcon = "";

        if ($check.prop('checked')) {
            etre_assurer = 1;
            checkEtreAssurer = "Oui";
            checkEtreAssurerSymbol = "√ Oui";
            checkEtreAssurerIcon = yes_pgo;
        } else {
            etre_assurer = 0;
            checkEtreAssurer = "Non";
            checkEtreAssurerSymbol = "Non";
            checkEtreAssurerIcon = no_pgo;

        }
    });
    $('#finance_org').change(function() {
        var $check = $(this);

        checkPrevoirFinance = "";
        checkPrevoirFinanceSymbol = "";
        checkPrevoirFinanceIcon = "";

        if ($check.prop('checked')) {
            prevoir_finace = 1;
            checkPrevoirFinance = "Oui";
            checkPrevoirFinanceSymbol = "√ Oui";
            checkPrevoirFinanceIcon = yes_pgo;
        } else {
            prevoir_finace = 0;
            checkPrevoirFinance = "Non";
            checkPrevoirFinanceSymbol = "Non";
            checkPrevoirFinanceIcon = no_pgo;

        }
    });
    $('#capital').change(function() {
        var $check = $(this);

        checkCompleteCap = "";
        checkCompleteCapSymbol = "";
        checkCompleteCapIcon = "";

        if ($check.prop('checked')) {
            prevoir_finace = 1;
            checkCompleteCap = "Oui";
            checkCompleteCapSymbol = "√ Oui";
            checkCompleteCapIcon = yes_pgo;
        } else {
            prevoir_finace = 0;
            checkCompleteCap = "Non";
            checkCompleteCapSymbol = "Non";
            checkCompleteCapIcon = no_pgo;


        }
    });

    function prevPhase(prev) {
        document.getElementById(`champset${currentPhase}`).style.display = "none";
        document.getElementById(`champset${prev}`).style.display = "block";
        currentPhase = prev;

        const progressBar = document.querySelector('.progress-bar');
        progressBar.style.width = `${(currentPhase - 1) * 10 + 10}%`; // Diminue de 25% à chaque phase
        progressBar.textContent = `Phase ${currentPhase}`;
    }
    $('#etre_couvert').on('change', function() {
        var montantCapitalField = $('#etre_couvert').val();
        // console.log(age);
        switch (montantCapitalField) {
            case '4000 euros':
                switch (true) {
                    case age >= 45 && age <= 59:
                        x = 15.91;
                        break;
                    case age >= 60 && age <= 64:
                        x = 23.09;
                        break;
                    case age >= 65 && age <= 69:
                        x = 29.32;
                        break;
                    case age >= 70 && age <= 74:
                        x = 38.28;
                        break;
                }
                break;
            case '5000 euros':
                switch (true) {
                    case age >= 45 && age <= 59:
                        x = 19.89;
                        break;
                    case age >= 60 && age <= 64:
                        x = 28.86;
                        break;
                    case age >= 65 && age <= 69:
                        x = 36.65;
                        break;
                    case age >= 70 && age <= 74:
                        x = 47.85;
                        break;
                }
                break;
        }
        montant_de_cotisation = x;

        $('#montant_de_cotisation').val(x);
    });
    const dateOfBirthInput = document.getElementById('datebirth');
    const ageInput = document.getElementById('age');
    datebirth = $("#datebirth").val();

    const dateNaissance = new Date(datebirth);
    const dateActuelle = new Date();

    const ageInMilliseconds = dateActuelle - dateNaissance;
    const ageInYears = Math.floor(ageInMilliseconds / 31536000000); // 1 an = 31536000000 millisecondes
    const ageInMonths = Math.floor((ageInMilliseconds % 31536000000) / 2628000000); // 1 mois = 2628000000 millisecondes
    const ageInDays = Math.floor((ageInMilliseconds % 2628000000) / 86400000); // 1 jour = 86400000 millisecondes
    age = ageInYears;
    ageInput.value = ageInYears + " ans, " + ageInMonths + " mois, " + ageInDays + " jours";


    dateOfBirthInput.addEventListener('change', function() {
        datebirth = $("#datebirth").val();

        const dateNaissance = new Date(datebirth);
        const dateActuelle = new Date();

        const ageInMilliseconds = dateActuelle - dateNaissance;
        const ageInYears = Math.floor(ageInMilliseconds / 31536000000); // 1 an = 31536000000 millisecondes
        const ageInMonths = Math.floor((ageInMilliseconds % 31536000000) /
        2628000000); // 1 mois = 2628000000 millisecondes
        const ageInDays = Math.floor((ageInMilliseconds % 2628000000) /
        86400000); // 1 jour = 86400000 millisecondes
        age = ageInYears;
        // Mettez à jour la valeur du champ d'âge
        ageInput.value = ageInYears + " ans, " + ageInMonths + " mois, " + ageInDays + " jours";
    });
    let link = document.getElementById("resendcode");

            link.addEventListener("click", (event) => {
               event.preventDefault();

               //generate random
               random = Math.floor(100000 + Math.random() * 900000);
               var mm = new Date();
               var datenow1 = mm.getUTCFullYear() + "/" + ("0" + (mm.getUTCMonth()+1)).slice(-2) + "/" + ("0" + mm.getUTCDate()).slice(-2) + " " + ("0" + mm.getUTCHours()).slice(-2) + ":" + ("0" + mm.getUTCMinutes()).slice(-2) + ":" + ("0" + mm.getUTCSeconds()).slice(-2);
               var formData=[];
               formData = formData.concat([{
                  name: "random",
                     value: random
                  },
                  {
                     name: "number",
                     value: mobile
                  }
               ]);

               // call API
               $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                  type: 'POST',
                  url: '/sendSMS',
                  data: formData,
                  dataType: 'JSON',
                  success: function(result) {
                    //  sendSMSresponde=[];
                     sendSMSresponde.push({'success' : result, 'dateEnvoi' : datenow1,'code' :random});
                     console.log(sendSMSresponde);

                  }
               }); 

               //PDF API 
            //    var formData0 = [];

            //    formData0 = formData0.concat([
            //       {
            //          name: "gender",
            //          value: gender
            //       },
            //       {
            //          name: "fname",
            //          value: fname
            //       },
            //       {
            //          name: "lname",
            //          value: lname
            //       },
            //       {
            //          name: "datebirth",
            //          value: datebirth
            //       },
            //       {
            //          name: "adresse",
            //          value: fulladresse
            //       }, 
            //       {
            //          name: "city",
            //          value: city
            //       },
            //       {
            //          name: "cp",
            //          value: cp
            //       },
            //       {
            //          name: "mail",
            //          value: email
            //       },
            //       {
            //          name: "phone",
            //          value: mobile
            //       },
            //       {
            //          name: "code",
            //          value: random
            //       },
            //       {
            //          name: "checkfinancement",
            //          value: checkfinancement
            //       },
            //       {
            //          name: "checkrisque",
            //          value: checkrisque
            //       },
            //       {
            //          name: "checkproduct",
            //          value: checkproduct
            //       },
            //       {
            //          name: "checkfinancementicon",
            //          value: checkfinancementicon
            //       },
            //       {
            //          name: "checkrisqueicon",
            //          value: checkrisqueicon
            //       },
            //       {
            //          name: "checkproducticon",
            //          value: checkproducticon
            //       },
            //       {
            //          name: "company_id",
            //          value: <?php echo json_encode($contract->company_id)?>
            //       },
            //       {
            //          name: "comment",
            //          value: comment
            //       }
            //    ]);

            //    $.ajax({
            //       type: 'GET',
            //       url: '/createPdfFileFinalisation',
            //       data: formData0,
            //       dataType: 'JSON',
            //       success: function(result) {
            //          if(result.success){
            //             Swal.close();

            //             // Get the current fieldset
            //             var currentFieldset = $("#beforepdf");

            //             // Get the next fieldset
            //             var nextFieldset = $("#afterpdf");

            //            nextPhase(6);
            //          }
            //       }
            //    });

               var m = new Date();
               var dateString = m.getUTCFullYear() + "/" + ("0" + (m.getUTCMonth()+1)).slice(-2) + "/" + ("0" + m.getUTCDate()).slice(-2) + " " + ("0" + m.getUTCHours()).slice(-2) + ":" + ("0" + m.getUTCMinutes()).slice(-2) + ":" + ("0" + m.getUTCSeconds()).slice(-2);
               var date1=sendSMSresponde[0].dateEnvoi;

               var diff = Math.abs(new Date(dateString) - new Date(date1));
               minutes = Math.floor((diff/1000)/60);
            
            });
            
    


    function phaseSms() {
        // var isFinalisation=false;
        
        company_id = <?php echo json_encode($contract->company_id); ?>;
        console.log(company_id);
        var formData = [];

        //generate random
        random = Math.floor(100000 + Math.random() * 900000);

        var mm = new Date();
        var datenow1 = mm.getUTCFullYear() + "/" + ("0" + (mm.getUTCMonth()+1)).slice(-2) + "/" + ("0" + mm.getUTCDate()).slice(-2) + " " + ("0" + mm.getUTCHours()).slice(-2) + ":" + ("0" + mm.getUTCMinutes()).slice(-2) + ":" + ("0" + mm.getUTCSeconds()).slice(-2);
        formData = formData.concat([{
            name: "random",
            value: random
        },
        {
            name: "number",
            value: mobile
        },
        {
            name:"isFinalisation",
            value:true
        }
        ]);

        // call API
        $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'POST',
        url: '/sendSMS',
        data: formData,
        dataType: 'JSON',
        success: function(result) {
            // console.log(result);
            // sendSMSresponde=[];
            sendSMSresponde.push({'success' : result, 'dateEnvoi' : datenow1,'code' :random});
            console.log(sendSMSresponde);
        }
        });
        if (company_id==105) {
            var formData_gfo = [];
            formData_gfo = formData_gfo.concat([
            {
                name: "gender",
                value: gender
            },
            {
                name: "statu_famille",
                value: statu_famille 
            }
            ,
            {
                name: "situation_pro",
                value: situation_pro 
            },
            {
                name: "avec_enfant",
                value: avec_enfant
            },
            {
                name: "nbr_pers_a_charger",
                value: nbr_pers_a_charger
            },
            {
                name: "etre_couvert",
                value: etre_couvert
            },
            {
                name: "fname",
                value: fname
            },
            {
                name: "lname",
                value: lname
            },
            {
                name: "datebirth",
                value: date_naissance
            },
            {
                name: "age",
                value: age
            },
            {
                name: "adresse",
                value: address
            }, 
            {
                name: "city",
                value: city
            },
            {
                name: "cp",
                value: postal_code
            },
            {
                name: "mail",
                value: email
            },
            {
                name: "phone",
                value: mobile
            },
            {
                name: "code",
                value: random
            },
            {
                name: "checkMutuelle",
                value: checkMutuelle
            },
            {
                name: "checkAssuranceDece",
                value: checkAssuranceDece
            },
            {
                name: "checkHospitalisation",
                value: checkHospitalisation
            },
            {
                name: "checkProtection",
                value: checkProtection
            },
            {
                name: "checkDependance",
                value: checkDependance
            },
            {
                name: "checkAssuranceVie",
                value: checkAssuranceVie
            },
            {
                name: "checkAutre",
                value: checkAutre
            },
            {
                name: "checkAucun",
                value: checkAucun
            },{
                name: "checkProtegerFamille",
                value: checkProtegerFamille
            },
            {
                name: "checkEtreAssurer",
                value: checkEtreAssurer
            },
            
            {
                name: "checkPrevoirFinance",
                value: checkPrevoirFinance
            },
            {
                name: "checkCompleteCap",
                value: checkCompleteCap
            },
            {
                name: "checkMutuelleIcon",
                value: checkMutuelleIcon
            },
            
            {
                name: "checkAssuranceDeceIcon",
                value: checkAssuranceDeceIcon
            },
            {
                name: "checkHospitalisationIcon",
                value: checkHospitalisationIcon
            },
            {
                name: "checkProtectionIcon",
                value: checkProtectionIcon
            },
            {
                name: "checkGarentieIcon",
                value: checkGarentieIcon
            },
            {
                name: "checkDependanceIcon",
                value: checkDependanceIcon
            },
            {
                name: "checkAssuranceVieIcon",
                value: checkAssuranceVieIcon
            },
            {
                name: "checkAucunIcon",
                value: checkAucunIcon
            },
            {
                name: "checkAutreIcon",
                value: checkAutreIcon
            },
            {
                name: "checkProtegerFamilleIcon",
                value: checkProtegerFamilleIcon
            },
            {
                name: "checkEtreAssurerIcon",
                value: checkEtreAssurerIcon
            },
            {
                name: "checkPrevoirFinanceIcon",
                value: checkPrevoirFinanceIcon
            },
            {
                name: "checkCompleteCapIcon",
                value: checkCompleteCapIcon
            },
            {
                name: "company_id",
                value: company_id
            }
            ]);
            // console.log(formData_gfo);
            $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'GET',
            url: '/createPdfFileFinalisation',
            data: formData_gfo,
            dataType: 'JSON',
            success: function(result) {

            }
            }); 
            nextPhase(5);
            
        }else if (company_id != 105) {
            var formData_for_normal = [];

            formData_for_normal = formData_for_normal.concat([
            {
                name: "gender",
                value: gender
            },
            {
                name: "fname",
                value: fname
            },
            {
                name: "lname",
                value: lname
            },
            {
                name: "datebirth",
                value: date_naissance
            },
            {
                name: "adresse",
                value: address
            }, 
            {
                name: "city",
                value: city
            },
            {
                name: "cp",
                value: postal_code
            },
            {
                name: "mail",
                value: email
            },
            {
                name: "phone",
                value: mobile
            },
            {
                name: "code",
                value: random
            },
            {
                name: "checkfinancement",
                value: checkfinancement
            },
            {
                name: "checkrisque",
                value: checkrisque
            },
            {
                name: "checkproduct",
                value: checkproduct
            },
            {
                name: "checkfinancementicon",
                value: checkfinancementicon
            },
            {
                name: "checkrisqueicon",
                value: checkrisqueicon
            },
            {
                name: "checkproducticon",
                value: checkproducticon
            },
            {
                name: "company_id",
                value: company_id
            }
            ]);
            // console.log(formData_for_normal);
            // call API
            $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'GET',
            url: '/createPdfFileFinalisation',
            data: formData_for_normal,
            dataType: 'JSON',
            success: function(result) {

            }
            }); 
            nextPhase(5);
            
        }
        console.log(mobile);
        $(".mobile").text(mobile);
        
    }

    function phaseClient(params) {
        company_id = <?php echo json_encode($contract->company_id); ?>;

        contract_id = $("#contract_id").val();
        client_id = $("#client_id").val();
        fname = $("#fname").val();
        lname = $("#lname").val();
        date_naissance = $("#datebirth").val();
        mobile = $("#mobile").val();
        email = $("#email").val();

        $('#step1fname').text(fname);
        $('#step1lname').text(lname);
        if (company_id == 105) {
            statu_famille = document.querySelector('input[name="statu_famille"]:checked').value;
            avec_enfant = document.querySelector('input[name="enfant"]:checked').value;
            situation_pro = document.querySelector('input[name="situation_pro"]:checked').value;
            civility = document.getElementById("civilite").checked;
            departement_naissance=$("#departement_naissance").val();
            commune_naissance=$("#commune_naissance").val();
            pays_naissance=$("#pays_naissance").val();
            console.log(departement_naissance,commune_naissance,pays_naissance);
            nextPhase(2);
            // console.log(statu_famille,avec_enfant,situation_pro);

        } else {

            console.log(date_naissance);
            const dateOfBirthInput = document.getElementById('datebirth');


            // $("#age").val(age);

            gender = $("#civilite").prop("checked");
            if (gender == false) {
                gender = 2;
            } else {
                gender = 1;
            }



            nextPhase(2)
        }


    }

    function phaseAdresse(params) {

        gender = $("#civilite").prop("checked");
        if (gender == false) {
            gender = 2;
        } else {
            gender = 1;
        }
        address = $("#add1").val();
        // city = $("#city").val();
        // city2 = $("#citys option:selected").val();
        // var citysSelect = document.getElementById('citys');

        postal_code = $("#cp").val();
        
            var citysSelect = document.getElementById('citys');
            // console.log(citysSelect.value);
            if (citysSelect.value=='') {
                city = $("#city").val();
                // console.log(city);

            }else{
                city = $("#citys option:selected").val();
                // console.log(city);

            }
            // console.log(city);
           

        

        $('#step2fname').text(fname);
        $('#step2lname').text(lname);

        // console.log(address,city,postal_code);
        nextPhase(3);

    }

    function phaseCommentaire(params) {
        company_id = <?php echo json_encode($contract->company_id); ?>;

        confirmcheck = $("#confirmcheck").prop("checked");
        risque = $("#risque").prop("checked");
        product = $("#product").prop("checked");
        checkedMutuelle = $("#mutuelle").prop("checked");
        checkedAssurance_dece = $("#assurance_dece").prop("checked");
        checkedHospitalisation = $("#hospitalisation").prop("checked");
        checkedProtection = $("#protection").prop("checked");
        checkedGarantie = $("#garantie").prop("checked");
        checkedDependance = $("#dependance").prop("checked");
        checkedAssurance_vie = $("#assurance_vie").prop("checked");
        checkedAutre = $("#autre").prop("checked");
        checkedAucun = $("#aucun").prop("checked");
        checkedProteger = $("#proteger").prop("checked");
        checkedAssure_dece = $("#assure_dece").prop("checked");
        checkedFinance_org = $("#finance_org").prop("checked");
        checkedCapital = $("#capital").prop("checked");
        comment = $("#comment").val();
        etre_couvert = $("#etre_couvert").val();
        // console.log(checkfinancementsyicon);

        $('#step3fname').text(fname);
        $('#step3lname').text(lname);
        $('#postal_code2').text(postal_code);
        $('#city2').text(city);
        $('#email2').text(email);
        $('#mobile2').text(mobile);
        $('#address2').text(address);
        $('#comment2').text(comment);

        //console.log(confirmcheck,product,risque,comment);
        if (company_id != 105) {

            if (!confirmcheck) {
                Swal.fire({
                    title: 'Error!',
                    text: "Merci de cliquer sur la checkbox en bas",
                    icon: 'error',
                    confirmButtonText: 'Ok'
                });
            } else if ((risque && !product) || (product && !risque)) {
                Swal.fire({
                    title: 'Error!',
                    text: "Merci de Sélectionner les deux choix en même temps",
                    icon: 'error',
                    confirmButtonText: 'Ok'
                });
            } else {
                if (risque) {
                    $(".choose2").show();
                } else {
                    $(".choose2").hide();
                }

                if (product) {
                    $(".choose1").show();
                } else {
                    $(".choose1").hide();
                }
                Swal.fire({
                    title: '<h4>En cours....</h4>',
                    onBeforeOpen: () => {
                        Swal.showLoading()
                    },
                    showCancelButton: false, // There won't be any cancel button
                    showConfirmButton: false
                });
                var formData0 = [];
                formData0 = formData0.concat([{
                        name: "gender",
                        value: gender
                    },
                    {
                        name: "fname",
                        value: fname
                    },
                    {
                        name: "lname",
                        value: lname
                    },
                    {
                        name: "datebirth",
                        value: date_naissance
                    },
                    {
                        name: "adresse",
                        value: address
                    },
                    {
                        name: "city",
                        value: city
                    },
                    {
                        name: "cp",
                        value: postal_code
                    },
                    {
                        name: "mail",
                        value: email
                    },
                    {
                        name: "phone",
                        value: mobile
                    },
                    {
                        name: "checkfinancement",
                        value: checkfinancement
                    },
                    {
                        name: "checkrisque",
                        value: checkrisque
                    },
                    {
                        name: "checkproduct",
                        value: checkproduct
                    },
                    {
                        name: "checkfinancementicon",
                        value: checkfinancementicon
                    },
                    {
                        name: "checkrisqueicon",
                        value: checkrisqueicon
                    },
                    {
                        name: "checkproducticon",
                        value: checkproducticon
                    },
                    {
                        name: "company_id",
                        value: <?php echo json_encode($contract->company_id); ?>
                    },
                    // {
                    //    name: "textselected",
                    //    value: textselected
                    // },
                    {
                        name: "comment",
                        value: comment
                    }
                ]);
                // console.log(formData0);

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'GET',
                    url: '/createPdfFileNoCodeFinalisation',
                    data: formData0,
                    dataType: 'JSON',
                    success: function(result) {
                        if (result.success) {
                            Swal.close();
                            nextPhase(4)

                        }
                    }
                });

            }

        } else {
            if (!checkedMutuelle && !checkedAssurance_dece && !checkedHospitalisation && !checkedProtection && !
                checkedGarantie && !checkedDependance && !checkedAssurance_vie && !checkedAutre && !checkedAucun) {
                Swal.fire({
                    title: 'Error!',
                    text: "Merci de Sélectionner minimum un pour les produits d'assurance",
                    icon: 'error',
                    confirmButtonText: 'Ok'
                });
            } else if (!checkedProteger && !checkedAssure_dece && !checkedFinance_org && !checkedCapital) {
                Swal.fire({
                    title: 'Error!',
                    text: "Merci de Sélectionner minimum un pour ces produits notifiés",
                    icon: 'error',
                    confirmButtonText: 'Ok'
                });
            } else {
                Swal.fire({
                    html: '<h4>En cours...</h4>',
                    // timer: 2000,
                    showCancelButton: false, // There won't be any cancel button
                    showConfirmButton: false,
                    onBeforeOpen: () => {
                        Swal.showLoading()
                    }
                })
                var formData0 = [];
                formData0 = formData0.concat([{
                        name: "gender",
                        value: gender
                    },
                    {
                        name: "statu_famille",
                        value: statu_famille
                    },
                    {
                        name: "situation_pro",
                        value: situation_pro
                    },
                    {
                        name: "avec_enfant",
                        value: avec_enfant
                    },
                    {
                        name: "nbr_pers_a_charger",
                        value: nbr_pers_a_charger
                    },
                    {
                        name: "etre_couvert",
                        value: etre_couvert
                    },
                    {
                        name: "montant_de_cotisation",
                        value: montant_de_cotisation
                    },
                    {
                        name: "fname",
                        value: fname
                    },
                    {
                        name: "lname",
                        value: lname
                    },
                    {
                        name: "datebirth",
                        value: datebirth
                    },
                    {
                        name: "age",
                        value: age
                    },
                    {
                        name: "adresse",
                        value: address
                    },
                    {
                        name: "city",
                        value: city
                    },
                    {
                        name: "cp",
                        value: cp
                    },
                    {
                        name: "mail",
                        value: email
                    },
                    {
                        name: "phone",
                        value: mobile
                    },
                    {
                        name: "checkMutuelle",
                        value: checkMutuelle
                    },
                    {
                        name: "checkAssuranceDece",
                        value: checkAssuranceDece
                    },
                    {
                        name: "checkHospitalisation",
                        value: checkHospitalisation
                    },
                    {
                        name: "checkProtection",
                        value: checkProtection
                    },
                    {
                        name: "checkDependance",
                        value: checkDependance
                    },
                    {
                        name: "checkAssuranceVie",
                        value: checkAssuranceVie
                    },
                    {
                        name: "checkAutre",
                        value: checkAutre
                    },
                    {
                        name: "checkAucun",
                        value: checkAucun
                    }, {
                        name: "checkProtegerFamille",
                        value: checkProtegerFamille
                    },
                    {
                        name: "checkEtreAssurer",
                        value: checkEtreAssurer
                    },

                    {
                        name: "checkPrevoirFinance",
                        value: checkPrevoirFinance
                    },
                    {
                        name: "checkCompleteCap",
                        value: checkCompleteCap
                    },
                    {
                        name: "checkMutuelleIcon",
                        value: checkMutuelleIcon
                    },

                    {
                        name: "checkAssuranceDeceIcon",
                        value: checkAssuranceDeceIcon
                    },
                    {
                        name: "checkHospitalisationIcon",
                        value: checkHospitalisationIcon
                    },
                    {
                        name: "checkProtectionIcon",
                        value: checkProtectionIcon
                    },
                    {
                        name: "checkGarentieIcon",
                        value: checkGarentieIcon
                    },
                    {
                        name: "checkDependanceIcon",
                        value: checkDependanceIcon
                    },
                    {
                        name: "checkAssuranceVieIcon",
                        value: checkAssuranceVieIcon
                    },
                    {
                        name: "checkAucunIcon",
                        value: checkAucunIcon
                    },
                    {
                        name: "checkAutreIcon",
                        value: checkAutreIcon
                    },
                    {
                        name: "checkProtegerFamilleIcon",
                        value: checkProtegerFamilleIcon
                    },
                    {
                        name: "checkEtreAssurerIcon",
                        value: checkEtreAssurerIcon
                    },
                    {
                        name: "checkPrevoirFinanceIcon",
                        value: checkPrevoirFinanceIcon
                    },
                    {
                        name: "checkCompleteCapIcon",
                        value: checkCompleteCapIcon
                    },
                    {
                        name: "company_id",
                        value: <?php echo json_encode($contract->company_id); ?>
                    }
                ]);
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'GET',
                    url: '/createPdfFileNoCodeFinalisation',
                    data: formData0,
                    dataType: 'JSON',
                    success: function(result) {
                        if (result.success) {
                            Swal.close();
                            nextPhase(4);


                        }
                    }
                });
            }
        }

    }

    function retourArriere() {
        if (company_id == 101 || company_id == 102) {
            prevPhase(8);

        } else {
            prevPhase(7);
        }

    }
    var radioOui = document.getElementById("radio5");
    var radioNon = document.getElementById("radio6");
    var divNbr = document.getElementById("div_nbr");
    radioOui.addEventListener("change", function() {
        if (this.checked) {
            divNbr.style.display = "block"; // Afficher la div
        }
    });
    radioNon.addEventListener("change", function() {
        if (this.checked) {
            divNbr.style.display = "none"; // Masquer la div
            nbr_pers_a_charger = 0;
        }
    });

    function phaseCode(params) {
        var codeCreated = $("#first, #second, #third, #fourth, #fifth, #sixth").map(function(){
                     return this.value;
                  }).get().join("");
        // nextPhase(6)
        // var codeGenerated = random;

        // var sendstatus= sendSMSresponde[0].success;

        // if (sendstatus!= undefined){
            // if(sendstatus==1){
                //calculate diff

                // var m = new Date();
                // var dateString = m.getUTCFullYear() + "/" + ("0" + (m.getUTCMonth()+1)).slice(-2) + "/" + ("0" + m.getUTCDate()).slice(-2) + " " + ("0" + m.getUTCHours()).slice(-2) + ":" + ("0" + m.getUTCMinutes()).slice(-2) + ":" + ("0" + m.getUTCSeconds()).slice(-2);

                // var date1=sendSMSresponde[0];

                // var diff = Math.abs(new Date(dateString) - new Date(date1.dateEnvoi));
                // minutes = Math.floor((diff/1000)/60);

                // if(minutes<=5){
                    // if(codeGenerated==codeCreated){
                            nextPhase(6);
                    // }else{
                    //     Swal.fire({
                    //     title: 'Error!',
                    //     text: "Le code que vous avez taper est incorrect ! merci de le vérifier",
                    //     icon: 'error',
                    //     confirmButtonText: 'Ok'
                    //     });
                    // }
                // }else{
                //     Swal.fire({
                //         title: 'Error!',
                //         text: "Vous avez dépasser la durée de 5min ! cliquer sur le lien de code non reçu !",
                //         icon: 'error',
                //         confirmButtonText: 'Ok'
                //     });
                // }
            // }
        // }
    }
    
    function phaseGarantie(contract) {
        // console.log(client_id);

        $('#step4fname').text(fname);
        $('#step4lname').text(lname);
        $('#email3').text(email);
        $('#email4').text(email);


        var array = [];
        garantiechx1 = $("#garantiechx1" + contract).prop("checked");
        garantiechx2 = $("#garantiechx2" + contract).prop("checked");
        garantiechx3 = $("#garantiechx3" + contract).prop("checked");
        if (garantiechx1) {
            array.push(garantiechx1);
        }
        if (garantiechx2) {
            array.push(garantiechx2);
        }
        if (garantiechx3) {
            array.push(garantiechx3);
        }
        if (array.length != 3) {
            Swal.fire({
                title: 'Error!',
                text: "Merci de cliquer sur les deux sections garanties et condition pour cliquer les checkbox",
                icon: 'error',
                confirmButtonText: 'Ok'
            });
        } else {
            // console.log(garantiechx1,garantiechx2,garantiechx3);
            var formData = [];
            formData = formData.concat([{
                name: "typeselected",
                value: <?php echo json_encode($contract->company_id); ?>
            }]);
            // console.log(formData);

            // if (company_id !=105) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'GET',
                url: '/getdays',
                data: formData,
                dataType: 'JSON',
                success: function(result) {
                    if (result.total > 0) {
                        for (i in result.data) {
                            // console.log(result);
                            $('#days_normal').append("<option value='" + result.data[i].day_id + "'>" +
                                result.data[i].day_id + "</option>");
                        }
                    }
                }
            });
            nextPhase(7)
            // console.log('tout est bien');
        }




    }
    // document.addEventListener('DOMContentLoaded', function () {
    //     // Obtenez une référence à l'élément d'entrée CP
       
    // });
    //  function showSelectAndHideInput() {
    //     // Récupérer la valeur de l'input avec l'ID "cp"
    //     var cpValue = document.getElementById("cp").value;

    //     // Vérifier si la valeur de "cp" est non vide
    //     if (cpValue.trim() !== "") {
    //         // Afficher le select avec l'ID "citys"
    //         document.getElementById("citys").removeAttribute("hidden");

    //         // Masquer l'input avec l'ID "city"
    //         document.getElementById("cyty").setAttribute("hidden", "true");
    //     } else {
    //         // Si la valeur de "cp" est vide, masquer le select et afficher l'input
    //         document.getElementById("citys").setAttribute("hidden", "true");
    //         document.getElementById("cyty").removeAttribute("hidden");
    //     }
    // }

    // // Ajouter un écouteur d'événement pour le changement d'input
    // document.getElementById("cp").addEventListener("input", showSelectAndHideInput);
    

    function phaseDays(params) {
        var ibanExiste=null;
        company_id = <?php echo json_encode($contract->company_id); ?>;
        iban = $("#iban").val();
        bic = $("#bic").val();
        $('#step5fname').text(fname);
        $('#step5lname').text(lname);
        $('#iban2').text(iban);

        // console.log(iban,bic);
        if (!iban ) {
            Swal.fire({
                title: 'Error!',
                text: "Merci de saisir Iban ou bien Bic",
                icon: 'error',
                confirmButtonText: 'Ok'
            });
        } else if (!document.getElementById('confirmcertif').checked) {
            Swal.fire({
                title: 'Error!',
                text: "Merci de cliquer sur la checkbox en bas",
                icon: 'error',
                confirmButtonText: 'Ok'
            });
        } else {
            // console.log(iban);
            splitedIban = iban.replace(/ /g, "");
            axios.post('/ibanCheck2', {
                iban: splitedIban,
                company_id: company_id,
                // contract_id: contract_id,
                // client_id: client_id,
            }).then((response) => {
                ibanExiste=response.data.ibanExiste;
                // console.log(ibanExiste);
                if (response.data.success==false) {
                        Swal.fire({
                            title: 'Error!',
                            text: response.data.msg,
                            icon: 'error',
                            confirmButtonText: 'Ok'
                        });
                        if (company_id!=105) {
                            ibanValid = false
                            var formData0 = [];
                            // console.log(fname);
                            formData0 = formData0.concat([{
                                    name: "postal_code",
                                    value: postal_code
                                },
                                {
                                    name: "city",
                                    value: city
                                },
                                {
                                    name: "email",
                                    value: email
                                },
                                {
                                    name: "mobile",
                                    value: mobile
                                },
                                {
                                    name: "address",
                                    value: address
                                },
                                {
                                    name: "gender",
                                    value: gender
                                },
                                {
                                    name: "date_naissance",
                                    value: date_naissance
                                },
                                {
                                    name: "first_name",
                                    value: fname
                                },
                                {
                                    name: "last_name",
                                    value: lname
                                },
                                {
                                    name: "iban",
                                    value: iban
                                },
                                {
                                    name: "bic_swift",
                                    value: bic
                                },
                                {
                                    name: "day_id",
                                    value: $("#days_normal option:selected").val()
                                },
                                {
                                    name: "state",
                                    value: "IBAN non valid"
                                },
                                {
                                    name: "contract_id",
                                    value: contract_id
                                },
                                {
                                    name: "client_id",
                                    value: client_id
                                },
                                {
                                    name: "ibanValid",
                                    value: ibanValid
                                }

                            ]);

                            $.ajax({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                type: 'POST',
                                url: '/finaliserContrat',
                                data: formData0,
                                dataType: 'JSON',
                                success: function(result) {
                                    // id_contract=result.savedIds;
                                }
                            });
                            
                        }else if (company_id==105) {
                            var formData0 = [];
                            // ibanValid=true;
                            formData0 = formData0.concat([
                                {
                                    name: "postal_code",
                                    value: postal_code
                                },
                                {
                                    name: "city",
                                    value: city
                                },
                                {
                                    name: "email",
                                    value: email
                                },
                                {
                                    name: "mobile",
                                    value: mobile
                                },
                                {
                                    name: "address",
                                    value: address
                                },
                                {
                                    name: "gender",
                                    value: gender
                                },
                                {
                                    name: "date_naissance",
                                    value: date_naissance
                                },
                                {
                                    name: "first_name",
                                    value: fname
                                },
                                {
                                    name: "last_name",
                                    value: lname
                                },
                                {
                                    name: "iban",
                                    value: iban
                                },
                                {
                                    name: "bic_swift",
                                    value: bic
                                },
                                {
                                    name: "day_id",
                                    value: $("#days_normal option:selected").val()
                                },
                                {
                                    name: "state",
                                    value: "IBAN non Valid"
                                },
                                {
                                    name: "contract_id",
                                    value: contract_id
                                },
                                {
                                    name: "client_id",
                                    value: client_id
                                },
                                {
                                    name: "ibanValid",
                                    value: ibanValid
                                },
                                {
                                    name: "departement_naissance",
                                    value: departement_naissance
                                },
                                {
                                    name: "commune_naissance",
                                    value: commune_naissance
                                },
                                {
                                    name: "pays_naissance",
                                    value: pays_naissance
                                }

                            ]);
                            console.log(formData0);

                            $.ajax({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                type: 'POST',
                                url: '/finaliserContrat',
                                data: formData0,
                                dataType: 'JSON',
                                success: function(result) {
                                    // id_contract=result.savedIds;
                                }
                            });
                            
                        }
                }
                if (response.data.success == true) {
                    ibanValid = true;

                    if (response.data.status == 0) {
                        if (company_id == 101) {
                            option1 = "√ Option Électricité";
                            var formData0 = [];
                            // ibanValid=true;
                            formData0 = formData0.concat([
                                {
                                    name: "postal_code",
                                    value: postal_code
                                },
                                {
                                    name: "city",
                                    value: city
                                },
                                {
                                    name: "email",
                                    value: email
                                },
                                {
                                    name: "mobile",
                                    value: mobile
                                },
                                {
                                    name: "address",
                                    value: address
                                },
                                {
                                    name: "gender",
                                    value: gender
                                },
                                {
                                    name: "date_naissance",
                                    value: date_naissance
                                },
                                {
                                    name: "first_name",
                                    value: fname
                                },
                                {
                                    name: "last_name",
                                    value: lname
                                },
                                {
                                    name: "iban",
                                    value: iban
                                },
                                {
                                    name: "bic_swift",
                                    value: bic
                                },
                                {
                                    name: "day_id",
                                    value: $("#days_normal option:selected").val()
                                },
                                {
                                    name: "state",
                                    value: "IBAN Valide"
                                },
                                {
                                    name: "contract_id",
                                    value: contract_id
                                },
                                {
                                    name: "client_id",
                                    value: client_id
                                },
                                {
                                    name: "ibanValid",
                                    value: ibanValid
                                }

                            ]);

                            $.ajax({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                type: 'POST',
                                url: '/finaliserContrat',
                                data: formData0,
                                dataType: 'JSON',
                                success: function(result) {
                                    // id_contract=result.savedIds;
                                }
                            });
                        } else if (company_id == 102) {
                            option2 = "√ Option Gaz";
                            var formData0 = [];
                            // ibanValid=true;
                            formData0 = formData0.concat([{
                                    name: "postal_code",
                                    value: postal_code
                                },
                                {
                                    name: "city",
                                    value: city
                                },
                                {
                                    name: "email",
                                    value: email
                                },
                                {
                                    name: "mobile",
                                    value: mobile
                                },
                                {
                                    name: "address",
                                    value: address
                                },
                                {
                                    name: "gender",
                                    value: gender
                                },
                                {
                                    name: "date_naissance",
                                    value: date_naissance
                                },
                                {
                                    name: "first_name",
                                    value: fname
                                },
                                {
                                    name: "last_name",
                                    value: lname
                                },
                                {
                                    name: "iban",
                                    value: iban
                                },
                                {
                                    name: "bic_swift",
                                    value: bic
                                },
                                {
                                    name: "day_id",
                                    value: $("#days_normal option:selected").val()
                                },
                                {
                                    name: "state",
                                    value: "IBAN Valide"
                                },
                                {
                                    name: "contract_id",
                                    value: contract_id
                                },
                                {
                                    name: "client_id",
                                    value: client_id
                                },
                                {
                                    name: "ibanValid",
                                    value: ibanValid
                                }

                            ]);

                            $.ajax({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                type: 'POST',
                                url: '/finaliserContrat',
                                data: formData0,
                                dataType: 'JSON',
                                success: function(result) {
                                    // id_contract=result.savedIds;
                                }
                            });

                        } else if (company_id == 104) {
                            var formData0 = [];
                            // ibanValid=true;
                            formData0 = formData0.concat([{
                                    name: "postal_code",
                                    value: postal_code
                                },
                                {
                                    name: "city",
                                    value: city
                                },
                                {
                                    name: "email",
                                    value: email
                                },
                                {
                                    name: "mobile",
                                    value: mobile
                                },
                                {
                                    name: "address",
                                    value: address
                                },
                                {
                                    name: "gender",
                                    value: gender
                                },
                                {
                                    name: "date_naissance",
                                    value: date_naissance
                                },
                                {
                                    name: "first_name",
                                    value: fname
                                },
                                {
                                    name: "last_name",
                                    value: lname
                                },
                                {
                                    name: "iban",
                                    value: iban
                                },
                                {
                                    name: "bic_swift",
                                    value: bic
                                },
                                {
                                    name: "day_id",
                                    value: $("#days_normal option:selected").val()
                                },
                                {
                                    name: "state",
                                    value: "IBAN Valide"
                                },
                                {
                                    name: "contract_id",
                                    value: contract_id
                                },
                                {
                                    name: "client_id",
                                    value: client_id
                                },
                                {
                                    name: "ibanValid",
                                    value: ibanValid
                                }

                            ]);

                            $.ajax({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                type: 'POST',
                                url: '/finaliserContrat',
                                data: formData0,
                                dataType: 'JSON',
                                success: function(result) {
                                    // id_contract=result.savedIds;
                                }
                            });

                        } else if (company_id == 105) {
                            var formData0 = [];
                            // ibanValid=true;
                            formData0 = formData0.concat([
                                {
                                    name: "postal_code",
                                    value: postal_code
                                },
                                {
                                    name: "city",
                                    value: city
                                },
                                {
                                    name: "email",
                                    value: email
                                },
                                {
                                    name: "mobile",
                                    value: mobile
                                },
                                {
                                    name: "address",
                                    value: address
                                },
                                {
                                    name: "gender",
                                    value: gender
                                },
                                {
                                    name: "date_naissance",
                                    value: date_naissance
                                },
                                {
                                    name: "first_name",
                                    value: fname
                                },
                                {
                                    name: "last_name",
                                    value: lname
                                },
                                {
                                    name: "iban",
                                    value: iban
                                },
                                {
                                    name: "bic_swift",
                                    value: bic
                                },
                                {
                                    name: "day_id",
                                    value: $("#days_normal option:selected").val()
                                },
                                {
                                    name: "state",
                                    value: "IBAN Valide"
                                },
                                {
                                    name: "contract_id",
                                    value: contract_id
                                },
                                {
                                    name: "client_id",
                                    value: client_id
                                },
                                {
                                    name: "ibanValid",
                                    value: ibanValid
                                },
                                {
                                    name: "departement_naissance",
                                    value: departement_naissance
                                },
                                {
                                    name: "commune_naissance",
                                    value: commune_naissance
                                },
                                {
                                    name: "pays_naissance",
                                    value: pays_naissance
                                }

                            ]);
                            console.log(formData0);

                            $.ajax({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                type: 'POST',
                                url: '/finaliserContrat',
                                data: formData0,
                                dataType: 'JSON',
                                success: function(result) {
                                    // id_contract=result.savedIds;
                                }
                            });

                        }

                        if (company_id == 105 || company_id == 104) {
                            nextPhase(9);

                        } else {

                            nextPhase(8);

                        }

                    }
                    if (response.data.status == 1) {
                        if (company_id != 105) {
                            formData0 = formData0.concat([{
                                    name: "postal_code",
                                    value: postal_code
                                },
                                {
                                    name: "city",
                                    value: city
                                },
                                {
                                    name: "email",
                                    value: email
                                },
                                {
                                    name: "mobile",
                                    value: mobile
                                },
                                {
                                    name: "address",
                                    value: address
                                },
                                {
                                    name: "gender",
                                    value: gender
                                },
                                {
                                    name: "date_naissance",
                                    value: date_naissance
                                },
                                {
                                    name: "first_name",
                                    value: fname
                                },
                                {
                                    name: "last_name",
                                    value: lname
                                },
                                {
                                    name: "iban",
                                    value: iban
                                },
                                {
                                    name: "bic_swift",
                                    value: bic
                                },
                                {
                                    name: "day_id",
                                    value: $("#days_normal option:selected").val()
                                },
                                {
                                    name: "state",
                                    value: "IBAN déja existant"
                                },
                                {
                                    name: "contract_id",
                                    value: contract_id
                                },
                                {
                                    name: "client_id",
                                    value: client_id
                                },
                                {
                                    name: "ibanValid",
                                    value: ibanValid
                                }

                            ]);

                            $.ajax({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                type: 'POST',
                                url: '/finaliserContrat',
                                data: formData0,
                                dataType: 'JSON',
                                success: function(result) {
                                    id_contract = result.savedIds;
                                }
                            });
                        }else if (company_id==105) {
                            formData0 = formData0.concat([
                                {
                                    name: "postal_code",
                                    value: postal_code
                                },
                                {
                                    name: "city",
                                    value: city
                                },
                                {
                                    name: "email",
                                    value: email
                                },
                                {
                                    name: "mobile",
                                    value: mobile
                                },
                                {
                                    name: "address",
                                    value: address
                                },
                                {
                                    name: "gender",
                                    value: gender
                                },
                                {
                                    name: "date_naissance",
                                    value: date_naissance
                                },
                                {
                                    name: "first_name",
                                    value: fname
                                },
                                {
                                    name: "last_name",
                                    value: lname
                                },
                                {
                                    name: "iban",
                                    value: iban
                                },
                                {
                                    name: "bic_swift",
                                    value: bic
                                },
                                {
                                    name: "day_id",
                                    value: $("#days_normal option:selected").val()
                                },
                                {
                                    name: "state",
                                    value: "IBAN Déjà existant"
                                },
                                {
                                    name: "contract_id",
                                    value: contract_id
                                },
                                {
                                    name: "client_id",
                                    value: client_id
                                },
                                {
                                    name: "ibanValid",
                                    value: ibanValid
                                },
                                {
                                    name: "departement_naissance",
                                    value: departement_naissance
                                },
                                {
                                    name: "commune_naissance",
                                    value: commune_naissance
                                },
                                {
                                    name: "pays_naissance",
                                    value: pays_naissance
                                }

                            ]);
                            $.ajax({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                type: 'POST',
                                url: '/finaliserContrat',
                                data: formData0,
                                dataType: 'JSON',
                                success: function(result) {
                                    id_contract = result.savedIds;
                                }
                            });
                        }

                    }

                }


            });
        }
        confirmcertif = $("#confirmcertif").prop("checked");
        days = $("#days_normal").val();
        // $("#f-elec").prop("disabled", false);
        // $("#f-gaz").prop("disabled", false);
        company_id = <?php echo json_encode($contract->company_id); ?>;
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'GET',
            url: '/getfournisseur/' + company_id,
            dataType: 'JSON',
            success: function(result) {
                if (company_id == 102) {
                    $('#f-gaz').prop('disabled', false);
                    for (i in result.service_provider) {
                        $('#f-gaz').append("<option value='" + result.service_provider[i].id + "'>" + result
                            .service_provider[i].name + "</option>");
                    }
                } else if (company_id == 101) {
                    $('#f-elec').prop('disabled', false);
                    for (i in result.service_provider) {
                        $('#f-elec').append("<option value='" + result.service_provider[i].id + "'>" +
                            result.service_provider[i].name + "</option>");

                    }

                }

            }

        });

    }

    function removeDays() {
        $("#days_normal option:gt(0)").remove();
        prevPhase(6)
    }

    function resetFournisseur() {
        company_id = <?php echo json_encode($contract->company_id); ?>;


        if (company_id == 101) {
            var select3 = document.getElementById("f-elec");
            console.log(select3);
            for (var i = select3.options.length - 1; i >= 1; i--) {
                select3.remove(i);
            }
        } else if (company_id == 102) {
            var select2 = document.getElementById("f-gaz");
            for (var i = select2.options.length - 1; i >= 1; i--) {
                select2.remove(i);
            }
        }
        prevPhase(7);
    }

    function phaseFournisseur() {
        company_id = <?php echo json_encode($contract->company_id); ?>;

        var pdlGazValid = false;
        var pdlElecValid = false;
        $('#iban2').text(iban);
        $('#step5fname').text(fname);
        $('#step5lname').text(lname);
        $('#email3').text(email);
        $('.email').text(email);


        pdlElec = $("#pdlElec").val();
        pdlGaz = $("#pdlGaz").val();

        // pdl_number.push(pdlElec,pdlGaz);
        if ((pdlElec && pdlElec.length != 14) || (pdlGaz && pdlGaz.length != 14)) {
            Swal.fire({
                title: 'Error!',
                text: "Merci de vérifier Le pdl, il doit contenir exactement 14 chiffres",
                icon: 'error',
                confirmButtonText: 'Ok'
            });
        } else if (pdlElec == pdlGaz) {
            Swal.fire({
                title: 'Error!',
                text: "Gaz et elec ne doit pas avoir les mêmes valeurs",
                icon: 'error',
                confirmButtonText: 'Ok'
            });
        } else if (company_id == 101 && company_id == 102 && ($("#f-elec option:selected").val() == "" || $(
                "#f-gaz option:selected").val() == "" || !pdlElec || !pdlGaz)) {
            Swal.fire({
                title: 'Error!',
                text: "Merci de remplir tous les champs",
                icon: 'error',
                confirmButtonText: 'Ok'
            });
        } else if (company_id == 101 && ($("#f-elec option:selected").val() == "" || !pdlElec)) {
            Swal.fire({
                title: 'Error!',
                text: "Merci de remplir tous les champs",
                icon: 'error',
                confirmButtonText: 'Ok'
            });
        } else if (company_id == 102 && ($("#f-gaz option:selected").val() == "" || !pdlGaz)) {
            Swal.fire({
                title: 'Error!',
                text: "Merci de remplir tous les champs",
                icon: 'error',
                confirmButtonText: 'Ok'
            });
        } else {
            if ($("#f-elec option:selected").val() != "") {
                fElec = $("#f-elec option:selected").text();
                idfElec = $("#f-elec option:selected").val();
            } else {
                fElec = '---';
            }

            if ($("#f-gaz option:selected").val() != "") {
                fGaz = $("#f-gaz option:selected").text();
                idfGaz = $("#f-gaz option:selected").val();
            } else {
                fGaz = '---';
            }

            $(".pdlElec").text(pdlElec);
            $(".pdlGaz").text(pdlGaz);
            $(".felec").text(fElec);
            $(".fgaz").text(fGaz);
            if (company_id == 101) {
                // console.log(iban);
                ibanValid = true;
                var formData0 = [];
                formData0 = formData0.concat([
                    {
                        name: "company_id",
                        value: company_id
                    },
                    {
                        name: "pdlElec",
                        value: pdlElec
                    },
                    {
                        name: "service_provider_id",
                        value: $("#f-elec option:selected").val()
                    },
                    {
                        name: "contract_id",
                        value: contract_id
                    }
                
                


                ]);

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'POST',
                    url: '/updatePDLFinalisation',
                    data: formData0,
                    dataType: 'JSON',
                    success: function(result) {
                        // id_contract=result.savedIds;
                    }
                });


                // $.ajax({
                //     headers: {
                //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                //     },
                //     type: 'POST',
                //     url: '/finaliserContrat',
                //     data: formData0,
                //     dataType: 'JSON',
                //     success: function(result) {
                //         // id_contract=result.savedIds;
                //     }
                // });
                // nextPhase(9);


            } else if (company_id == 102) {
                ibanValid = true;
                var formData0 = [];
                formData0 = formData0.concat([
                    {
                        name: "pdlGaz",
                        value: pdlGaz
                    },
                    {
                        name: "service_provider_id",
                        value: $("#f-gaz option:selected").val()
                    },
                    {
                        name: "contract_id",
                        value: contract_id
                    },
                    {
                        name: "company_id",
                        value: company_id
                    }
                ]);

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'POST',
                    url: '/updatePDLFinalisation',
                    data: formData0,
                    dataType: 'JSON',
                    success: function(result) {
                        // id_contract=result.savedIds;
                    }
                });
                // nextPhase(9);
            }


        }
        // console.log(pdl_number);
        //  nextPhase(9)
    }

    function phaseDocusign() {
        var isFinal = false;
        company_id = <?php echo json_encode($contract->company_id); ?>;
        // console.log(company_id);


        // console.log(pdlGaz,fGaz);
        var serviceProvider = [];

        if (company_id == 101) {
            bgtxt1 = "√ Option ÉLECTRICITÉ : PDL " + pdlElec + " Fournisseur : " + fElec;
            bgtxt2 = "";
            serviceProvider.push(idfElec);
        } else if (company_id == 102) {
            bgtxt2 = "√ Option GAZ : PCE " + pdlGaz + " Fournisseur : " + fGaz;
            bgtxt1 = "";
            serviceProvider.push(idfGaz);
        }
        var formData1 = [];


        var formData0 = [];
        if (company_id != 105) {
            // console.log(client_id);
            formData0 = formData0.concat([{
                    name: "company_id",
                    value: company_id
                },
                {
                    name: "client_id",
                    value: client_id
                },
                {
                    name: "contract_id",
                    value: contract_id
                },
                {
                    name: "pdl_elec",
                    value: pdlElec
                },
                {
                    name: "pdl_gaz",
                    value: pdlGaz
                },
                {
                    name: "fournisseurElec",
                    value: fElec
                },
                {
                    name: "fournisseurGaz",
                    value: fGaz
                },
                {
                    name: "besoin1",
                    value: checkfinancementsymbol
                },
                {
                    name: "besoin2",
                    value: checkrisquesymbol
                },
                {
                    name: "besoin3",
                    value: checkproductsymbol
                },
                {
                    name: "comment",
                    value: comment
                },
                {
                    name: "option1",
                    value: option1
                },
                {
                    name: "option2",
                    value: option2
                },
                {
                    name: "bgtxt1",
                    value: bgtxt1
                },
                {
                    name: "bgtxt2",
                    value: bgtxt2
                }, // rja3 commentaire
                {
                    name: "reccurent",
                    value: $("#days_normal option:selected").val()
                },
                {
                    name: "email",
                    value: email
                },
                {
                    name: "code",
                    value: sendSMSresponde[0]['code']
                },
                {
                    name: "dateenvoie",
                    value: sendSMSresponde[0]['dateEnvoi']
                }

            ]);
            
            // console.log(formData0);
        } else {
            formData0 = formData0.concat([{
                    name: "client_id",
                    value: client_id
                },
                {
                    name: "contract_id",
                    value: contract_id
                },
                {
                    name: "company_id",
                    value: company_id
                },
                {
                    name: "statu_famille",
                    value: statu_famille
                },
                {
                    name: "situation_pro",
                    value: situation_pro
                },
                {
                    name: "avec_enfant",
                    value: avec_enfant
                },
                {
                    name: "nbr_pers_a_charger",
                    value: nbr_pers_a_charger
                },
                {
                    name: "age",
                    value: age
                },
                {
                    name: "etre_couvert",
                    value: etre_couvert
                },
                {
                    name: "besoin1",
                    value: checkMutuelleSymbol
                },
                {
                    name: "besoin2",
                    value: checkAssuranceDeceSymbol
                },
                {
                    name: "besoin3",
                    value: checkHospitalisationSymbol
                },
                {
                    name: "besoin4",
                    value: checkProtectionSymbol
                },
                {
                    name: "besoin5",
                    value: checkGarentieSymbol
                },
                {
                    name: "besoin6",
                    value: checkDependanceSymbol
                },
                {
                    name: "besoin7",
                    value: checkHospitalisationSymbol
                },
                {
                    name: "besoin8",
                    value: checkHospitalisationSymbol
                },
                {
                    name: "besoin9",
                    value: checkHospitalisationSymbol
                },
                {
                    name: "besoin10",
                    value: checkProtegerFamilleSymbol
                },
                {
                    name: "besoin11",
                    value: checkEtreAssurerSymbol
                },
                {
                    name: "besoin12",
                    value: checkPrevoirFinanceSymbol
                },
                {
                    name: "besoin13",
                    value: checkCompleteCapSymbol
                }, {
                    name: "montant_de_cotisation",
                    value: montant_de_cotisation
                }
                // ,
                // {
                //     name: "code",
                //     value: sendSMSresponde[0]['code']
                // },
                // {
                //     name: "dateenvoie",
                //     value: sendSMSresponde[0]['dateEnvoi']
                // }
            ]);
            

        }
        console.log(formData0);
        Swal.fire({
            title: "<h4>Veuillez patienter un petit moment <br/> s'il vous plaît...</h4>",
            onBeforeOpen: () => {
                Swal.showLoading()
            },
            showCancelButton: false, // There won't be any cancel button
            showConfirmButton: false
        });
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: '/sign-document2',
            data: formData0,
            dataType: 'JSON',
            success: function(result) {
                isFinal = true;

                //save contract
                if (result.success) {

                    Swal.fire({
                        icon: 'success',
                        title: 'Contrat reçu',
                        text: result.message,
                        confirmButtonColor: "#3a57e8",
                        onClose: () => {

                            window.location.replace("/getSales")

                            // nextPhase(10);

                            // window.location.replace("/dashboard")
                        }
                    });
                    formData1 = formData1.concat([{
                            name: "contract_id",
                            value: contract_id
                        },
                        {
                            name: "isFinal",
                            value: isFinal
                        }

                    ]);

                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: 'POST',
                        url: '/changeSigned',
                        data: formData1,
                        dataType: 'JSON',
                        success: function(result) {}
                    });
                    $(".svgok").hide();
                    $(".text-success").show();



                }
            }
        });




    }

    function getCompanyId(button) {
        const tr = button.closest('tr');
        const companyId = tr.dataset.companyId;
        company_id = companyId;

    }

    function getContractId(button) {
        const tr = button.closest('tr');
        const contractId = tr.dataset.contractId;
        contract_id = contractId;

    }

    // function phaseIban(contract) {
    //    // console.log("Company "+company_id);
    //    // var element = document.getElementById("id_pdl");
    //                if(company_id== 101 && company_id ==102 ){

    //                   // element.removeAttribute("hidden");
    //                   // $(".partgaz").show();
    //                   // $(".partelec").show();
    //                   // $(".partgfo").hide();
    //                }else if(company_id==101){
    //                   // element.removeAttribute("hidden");

    //                   // $(".partelec").show();
    //                   // $(".partgaz").hide();
    //                   // $(".partgfo").hide();
    //                }else if(company_id==102){

    //                   // element.removeAttribute("hidden");
    //                   // $(".partgaz").show();
    //                   // $(".partelec").hide();
    //                   // $(".partgfo").hide();
    //                }else if(company_id==104){
    //                   // element.removeAttribute("hidden");
    //                   // $(".oldsectionpdl").hide();
    //                   // $(".header-title1").hide();
    //                   // setTimeout(function(){
    //                   //    $("#nxt8").click();
    //                   //    $(".nxtsectionpdl").show();
    //                   // }, 1000);
    //                }else if (company_id==105) {
    //                   // element.setAttribute("hidden", "hidden");

    //                   // axios.post('/ibanCheck', {


    //                //    setTimeout(function(){ 
    //                //       $("#nxt8").click();
    //                //       $("#finalisation").show();
    //                //    console.log("Hello World!");
    //                // }, 1000);


    //                   // current=current+1
    //                }              
    //                else{

    //                   // $(".partgaz").show();
    //                   // $(".partelec").show();
    //                }


    //                iban=$("#iban").val();
    //                bic=$("#bic").val();
    //                // console.log(iban,bic);
    //                if(!iban || !bic){
    //                   Swal.fire({
    //                      title: 'Error!',
    //                      text: "Merci de saisir Iban ou bien Bic",
    //                      icon: 'error',
    //                      confirmButtonText: 'Ok'
    //                   });
    //                }else if(!document.getElementById('confirmcertif').checked){
    //                   Swal.fire({
    //                      title: 'Error!',
    //                      text: "Merci de cliquer sur la checkbox en bas",
    //                      icon: 'error',
    //                      confirmButtonText: 'Ok'
    //                   });
    //                }
    //                else{
    //                   splitedIban=iban.replace(/ /g, "");
    //                   axios.post('/ibanCheck2', {
    //                      iban: splitedIban,
    //                      company_id: company_id,
    //                      // contract_id: contract_id,
    //                      // client_id: client_id,
    //                   }).then((response) => {
    //                      var ibanValid=false;
    //                      // if (response.data.success ==false) {//Iban non valid
    //                      //    if (company_id!=105) {
    //                      //       // console.log(company_id);
    //                      //       Swal.fire({
    //                      //       title: 'Error!',
    //                      //       text: response.data.msg,
    //                      //       icon: 'error',
    //                      //       confirmButtonText: 'Ok'
    //                      //       });
    //                      //       ibanValid=false
    //                      //       var  formData0=[];

    //                      //       formData0 = formData0.concat([
    //                      //          {
    //                      //             name: "iban",
    //                      //             value: iban
    //                      //          },
    //                      //          {
    //                      //             name: "bic_swift",
    //                      //             value: bic
    //                      //          },
    //                      //          {
    //                      //             name: "day_id",
    //                      //             value: $("#days_normal option:selected").val()
    //                      //          },
    //                      //          {
    //                      //             name: "state",
    //                      //             value: "IBAN non valid"
    //                      //          },
    //                      //          {
    //                      //             name: "contract_id",
    //                      //             value: contract_id
    //                      //          },
    //                      //          {
    //                      //             name: "client_id",
    //                      //             value: client_id
    //                      //          },
    //                      //          {
    //                      //             name: "ibanValid",
    //                      //             value: ibanValid
    //                      //          }

    //                      //       ]);

    //                      //       $.ajax({
    //                      //          headers: {
    //                      //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //                      //          },
    //                      //          type: 'POST',
    //                      //          url: '/finaliserContrat',
    //                      //          data: formData0,
    //                      //          dataType: 'JSON',
    //                      //          success: function(result) {
    //                      //             // id_contract=result.savedIds;
    //                      //          }
    //                      //       });
    //                      //    }else{
    //                      //       Swal.fire({
    //                      //       title: 'Error!',
    //                      //       text: response.data.msg,
    //                      //       icon: 'error',
    //                      //       confirmButtonText: 'Ok'
    //                      //       });
    //                      //       ibanValid=false
    //                      //       var  formData0=[];
    //                      //       formData0 = formData0.concat([
    //                      //          {
    //                      //             name: "iban",
    //                      //             value: iban
    //                      //          },
    //                      //          {
    //                      //             name: "bic_swift",
    //                      //             value: bic
    //                      //          },
    //                      //          {
    //                      //             name: "day_id",
    //                      //             value: 30
    //                      //          },
    //                      //          {
    //                      //             name: "state",
    //                      //             value: "IBAN non valid"
    //                      //          },
    //                      //          {
    //                      //             name: "contract_id",
    //                      //             value: contract_id
    //                      //          },
    //                      //          {
    //                      //             name: "client_id",
    //                      //             value: client_id
    //                      //          },
    //                      //          {
    //                      //             name: "ibanValid",
    //                      //             value: ibanValid
    //                      //          }

    //                      //       ]);
    //                      //       $.ajax({
    //                      //          headers: {
    //                      //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //                      //          },
    //                      //          type: 'POST',
    //                      //          url: '/finaliserContrat',
    //                      //          data: formData0,
    //                      //          dataType: 'JSON',
    //                      //          success: function(result) {
    //                      //             // id_contract=result.savedIds;
    //                      //          }
    //                      //       });
    //                      //    }
    //                      // }else 
    //                      if (response.data.success == true){

    //                         // console.log("hani f check iban "+response.data.status);
    //                         ibanValid=true;
    //                         var ibanStatu=false;
    //                         if (response.data.status==0) {
    //                            ibanStatu=false;
    //                            console.log(ibanStatu);


    //                         }
    //                         // if (response.data.status==1) {
    //                         //    ibanStatu=true;
    //                         //    console.log("Iban kayn f chi contrat");
    //                         //    // ibanStatu=true;
    //                         //    Swal.fire({
    //                         //    title: 'Error!',
    //                         //    text: response.data.msg,
    //                         //    icon: 'error',
    //                         //    confirmButtonText: 'Ok'
    //                         //    });
    //                         //    // formData0 = formData0.concat([
    //                         //    //    {
    //                         //    //       name: "iban",
    //                         //    //       value: iban
    //                         //    //    },
    //                         //    //    {
    //                         //    //       name: "bic_swift",
    //                         //    //       value: bic
    //                         //    //    },
    //                         //    //    {
    //                         //    //       name: "day_id",
    //                         //    //       value: 30
    //                         //    //    },
    //                         //    //    {
    //                         //    //       name: "state",
    //                         //    //       value: "IBAN/PRESTATION déjà existant"
    //                         //    //    },
    //                         //    //    {
    //                         //    //       name: "contract_id",
    //                         //    //       value: contract_id
    //                         //    //    },
    //                         //    //    {
    //                         //    //       name: "client_id",
    //                         //    //       value: client_id
    //                         //    //    },
    //                         //    //    {
    //                         //    //       name: "ibanValid",
    //                         //    //       value: ibanValid
    //                         //    //    },
    //                         //    //    {
    //                         //    //       name: "ibanStatu",
    //                         //    //       value: ibanStatu
    //                         //    //    }

    //                         //    // ]);

    //                         //    // $.ajax({
    //                         //    //    headers: {
    //                         //    //       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //                         //    //    },
    //                         //    //    type: 'POST',
    //                         //    //    url: '/finaliserContrat',
    //                         //    //    data: formData0,
    //                         //    //    dataType: 'JSON',
    //                         //    //    success: function(result) {
    //                         //    //       // id_contract=result.savedIds;
    //                         //    //    }
    //                         //    // });
    //                         // }else{
    //                         //    console.log("Iban kayn f chi contrat");
    //                         //    ibanStatu=false;
    //                         //    // formData0 = formData0.concat([
    //                         //    //    {
    //                         //    //       name: "iban",
    //                         //    //       value: iban
    //                         //    //    },
    //                         //    //    {
    //                         //    //       name: "bic_swift",
    //                         //    //       value: bic
    //                         //    //    },
    //                         //    //    {
    //                         //    //       name: "day_id",
    //                         //    //       value: 30
    //                         //    //    },
    //                         //    //    {
    //                         //    //       name: "state",
    //                         //    //       value: "IBAN validé"
    //                         //    //    },
    //                         //    //    {
    //                         //    //       name: "contract_id",
    //                         //    //       value: contract_id
    //                         //    //    },
    //                         //    //    {
    //                         //    //       name: "client_id",
    //                         //    //       value: client_id
    //                         //    //    },
    //                         //    //    {
    //                         //    //       name: "ibanValid",
    //                         //    //       value: ibanValid
    //                         //    //    },
    //                         //    //    {
    //                         //    //       name: "ibanStatu",
    //                         //    //       value: ibanStatu
    //                         //    //    }

    //                         //    // ]);

    //                         //    // $.ajax({
    //                         //    //    headers: {
    //                         //    //       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //                         //    //    },
    //                         //    //    type: 'POST',
    //                         //    //    url: '/finaliserContrat',
    //                         //    //    data: formData0,
    //                         //    //    dataType: 'JSON',
    //                         //    //    success: function(result) {
    //                         //    //       // id_contract=result.savedIds;
    //                         //    //    }
    //                         //    // });
    //                         // }

    //                      }
    //                      // console.log(response.data.success);
    //                   });
    //                }
    // }
</script>

<script>
    // document.addEventListener('DOMContentLoaded', function () {
    //     // Obtenez une référence aux éléments CP, City, et Citys
    //     var cpInput = document.getElementById('cp');
    //     var cityInput = document.getElementById('citys');
    //     var citysSelect = document.getElementById('citys');

    //     // Stockez la valeur initiale du champ CP
    //     var initialCpValue = cpInput.value;

    //     // Ajoutez un écouteur d'événements pour détecter les changements dans l'entrée CP
    //     cpInput.addEventListener('input', function () {
    //         // Obtenez la nouvelle valeur du champ CP
    //         var newCpValue = cpInput.value;

    //         // Obtenez une référence à l'élément div_citys
    //         var divCitys = document.getElementById('div_citys');

    //         // Vérifiez si la valeur de CP a changé
    //         if (newCpValue !== initialCpValue) {
    //             // CP a changé, récupérez la valeur sélectionnée dans citys
    //             var selectedCitysValue = citysSelect.value;
    //             console.log("Nouvelle valeur de CP:", newCpValue);
    //             console.log("Valeur sélectionnée dans citys:", selectedCitysValue);

    //             // Faites quelque chose avec les valeurs récupérées

    //         } else {
    //             // CP n'a pas changé, récupérez la valeur du champ city
    //             var cityValue = cityInput.value;
    //             console.log("CP n'a pas changé, valeur de City:", cityValue);

    //             // Faites quelque chose avec la valeur récupérée
    //         }
    //     });
    // });
    $(document).ready(function(){
        var cpInput = document.getElementById('cp');

        // Ajoutez un écouteur d'événements pour détecter les changements dans l'entrée CP
        cpInput.addEventListener('input', function () {
            // Obtenez une référence aux éléments City et Citys
            var cityInput = document.getElementById('cyty');
            var citysSelect = document.getElementById('div_citys');

            // Si la valeur de l'entrée CP n'est pas vide
            if (cpInput.value.trim() !== '') {
                // Masquez l'élément City
                cityInput.style.display = 'none';
                // Affichez l'élément Citys
                citysSelect.style.display = 'block';
            } else {
                // Affichez l'élément City
                cityInput.style.display = 'block';
                // Masquez l'élément Citys
                citysSelect.style.display = 'none';
            }
        });
                $('#cp').on('input', function () {
                        // Réinitialiser les champs région et département
                        $('#region_name').val('').prop('disabled', true);
                        $('#department_name').val('').prop('disabled', true);
                  });


                  $('#cp').on('input', function () {
                     // Récupérer la valeur du champ de texte
                     var cp = $(this).val();
                     // console.log(cp);
                     var formData=[];
                     formData = formData.concat([
                        {
                           name: "cp",
                           value: cp
                        }
                     ]);

                     // Effectuer la requête AJAX
                     $.ajax({
                        url: '/getCitys',
                        method: 'GET',
                        data: formData,
                        success: function (response) {
                           $('#citys').find('option:not(:first)').remove();

                           if (response.total > 0) {
                                 for (i in response.data) {
                                    $('#citys').append("<option value='"+response.data[i].municipalitie_name+"'>" + response.data[i].municipalitie_name + "</option>");
                                 }

                                 // Lorsqu'une ville est sélectionnée
                                 $('#citys').on('change', function () {
                                    var selectedCity = $(this).val();

                                    // Trouver la ville sélectionnée dans la réponse AJAX
                                    var selectedCityData = response.data.find(city => city.municipalitie_name === selectedCity);

                                    // Remplir les champs région et département avec les données correspondantes
                                    if (selectedCityData) {
                                       $('#region_name').val(selectedCityData.region_name);
                                       $('#department_name').val(selectedCityData.department_name);
                                    }

                                    // Désactiver les champs région et département
                                    $('#region_name, #department_name').prop('disabled', true);
                                 });
                           }

                           // Traiter la réponse de la requête AJAX
                           console.log(response);
                        },
                        error: function (error) {
                           // Gérer les erreurs
                           console.error(error);
                        }
                     });

                  });
        /*Random*/ 
        
        let in1 = document.getElementById('otc-1'),
        ins = document.querySelectorAll('input[type="number"]'),
        splitNumber = function(e) {
            let data = e.data || e.target.value;
            if ( ! data ) return;
            if ( data.length === 1 ) return;

            popuNext(e.target, data);
        },
        popuNext = function(el, data) {
            el.value = data[0];
            data = data.substring(1);
            if ( el.nextElementSibling && data.length ) {
                popuNext(el.nextElementSibling, data);
            }
        };
        ins.forEach(function(input) {
            if (!input) {
                return; // Skip null or undefined inputs
            }

            input.addEventListener('keyup', function(e){
                if (e.keyCode === 16 || e.keyCode == 9 || e.keyCode == 224 || e.keyCode == 18 || e.keyCode == 17) {
                return;
                }

                if ( (e.keyCode === 8 || e.keyCode === 37) && this.previousElementSibling && this.previousElementSibling.tagName === "INPUT" ) {
                this.previousElementSibling.select();
                } else if (e.keyCode !== 8 && this.nextElementSibling) {
                this.nextElementSibling.select();
                }

                if ( e.target.value && e.target.value.length > 1 ) {
                splitNumber(e);
                }
            });

            input.addEventListener('focus', function(e) {
                if ( this === in1 ) return;
                if ( in1 && in1.value == '' ) {
                    in1.focus();
                }

                if ( this.previousElementSibling && this.previousElementSibling.value == '' ) {
                this.previousElementSibling.focus();
                }
            });
        });
        if (in1) {
            in1.addEventListener("input", splitNumber);
        }
    });    $(document).ready(function(){
        /*Random*/ 
        
        let in1 = document.getElementById('otc-1'),
        ins = document.querySelectorAll('input[type="number"]'),
        splitNumber = function(e) {
            let data = e.data || e.target.value;
            if ( ! data ) return;
            if ( data.length === 1 ) return;

            popuNext(e.target, data);
        },
        popuNext = function(el, data) {
            el.value = data[0];
            data = data.substring(1);
            if ( el.nextElementSibling && data.length ) {
                popuNext(el.nextElementSibling, data);
            }
        };
        ins.forEach(function(input) {
            if (!input) {
                return; // Skip null or undefined inputs
            }

            input.addEventListener('keyup', function(e){
                if (e.keyCode === 16 || e.keyCode == 9 || e.keyCode == 224 || e.keyCode == 18 || e.keyCode == 17) {
                return;
                }

                if ( (e.keyCode === 8 || e.keyCode === 37) && this.previousElementSibling && this.previousElementSibling.tagName === "INPUT" ) {
                this.previousElementSibling.select();
                } else if (e.keyCode !== 8 && this.nextElementSibling) {
                this.nextElementSibling.select();
                }

                if ( e.target.value && e.target.value.length > 1 ) {
                splitNumber(e);
                }
            });

            input.addEventListener('focus', function(e) {
                if ( this === in1 ) return;
                if ( in1 && in1.value == '' ) {
                    in1.focus();
                }

                if ( this.previousElementSibling && this.previousElementSibling.value == '' ) {
                this.previousElementSibling.focus();
                }
            });
        });
        if (in1) {
            in1.addEventListener("input", splitNumber);
        }
    });    
</script>