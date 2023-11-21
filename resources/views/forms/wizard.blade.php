

<html>
  <head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/9.8.2/sweetalert2.min.css" rel="stylesheet" />
   <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
   <link rel="stylesheet" href="{{ asset('css/wizard.css') }}">
  </head>
  <style>
   .nbr-perss {
      
      border: 1px solid#6c757d;;
      color: #6c757d;;
   }

 /* Style au survol */
 .nbr-perss:active {
   border-color: #564caf; /* Changement de couleur de bordure au survol */
 }

  </style>
  <body>
      <x-app-layout :assets="$assets ?? []">
         <div>
            <div class="row">
                  <div class="col-sm-12 col-lg-12">
                     <div class="card">
                        <div class="card-body">
                        <form id="form-wizard1" class="text-center mt-3 msform" autocomplete="off">
                           @csrf
                              <ul id="progressbar">
                                 <li class="active" id="account"><strong>1</strong></li>
                                 <li id="personal"><strong>2</strong></li>
                                 <li id="payment"><strong>3</strong></li>
                                 <li id="confirm"><strong>4</strong></li>
                                 <li id="confirm"><strong>5</strong></li>
                                 <li id="confirm"><strong>6</strong></li>
                                 <li id="confirm"><strong>7</strong></li>
                                 <li id="confirm"><strong>8</strong></li>
                              </ul>
                              <div class="progress">
                                 <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                              <br><br>
                              <!-- Images -->
                              @if($choice == [101, 104])
                                 <div class="row row-cols-1">
                                    <div class="col">
                                       <div class="card iq-product-custom-card animate:hover-media assfacture">
                                          <div class="iq-product-hover-img position-relative animate:hover-media-wrap">
                                             <img src="{{ asset('images/pages/assurance.jpg') }}" alt="product-details" class="img-fluid iq-product-img hover-media logo-check" loading="lazy">
                                          </div>
                                       </div>                        
                                    </div>
                                    <div class="col">
                                       <div class="card iq-product-custom-card animate:hover-media ">
                                          <div class="iq-product-hover-img position-relative animate:hover-media-wrap">
                                             <img src="{{ asset('images/pages/pge.jpg') }}" alt="product-details" class="img-fluid iq-product-img hover-media logo-check" loading="lazy">
                                          </div>
                                       </div>                        
                                    </div>
                                 </div>
                              @elseif($choice == [101, 102])
                                 <div class="row row-cols-1">
                                    <div class="col">
                                       <div class="card iq-product-custom-card animate:hover-media assfacture">
                                          <div class="iq-product-hover-img position-relative animate:hover-media-wrap">
                                             <img src="{{ asset('images/pages/assurance.jpg') }}" alt="product-details" class="img-fluid iq-product-img hover-media logo-check" loading="lazy">
                                          </div>
                                       </div>                        
                                    </div>
                                 </div>
                              @elseif($choice == [101] || $choice == [102])
                                 <div class="row row-cols-1">
                                    <div class="col">
                                       <div class="card iq-product-custom-card animate:hover-media assfacture">
                                          <div class="iq-product-hover-img position-relative animate:hover-media-wrap">
                                             <img src="{{ asset('images/pages/assurance.jpg') }}" alt="product-details" class="img-fluid iq-product-img hover-media logo-check" loading="lazy">
                                          </div>
                                       </div>                        
                                    </div>
                                 </div>
                              @elseif($choice == [104])
                                 <div class="row row-cols-1">
                                    <div class="col">
                                       <div class="card iq-product-custom-card animate:hover-media assfacture">
                                          <div class="iq-product-hover-img position-relative animate:hover-media-wrap">
                                             <img src="{{ asset('images/pages/pge.jpg') }}" alt="product-details" class="img-fluid iq-product-img hover-media logo-check" loading="lazy">
                                          </div>
                                       </div>                        
                                    </div>
                                 </div>
                                 @elseif($choice == [105])
                                 <div class="row row-cols-1">
                                    <div class="col">
                                       <div class="card iq-product-custom-card animate:hover-media assfacture">
                                          <div class="iq-product-hover-img position-relative animate:hover-media-wrap">
                                             <img src="{{ asset('images/pages/gfo2.jpg') }}" alt="product-details" class="img-fluid iq-product-img hover-media logo-check" loading="lazy">
                                          </div>
                                       </div>                        
                                    </div>
                                 </div>
                              @endif
                              <!-- fieldsets -->
                              
                              <fieldset>
                                 <div class="d-flex justify-content-between">
                                    <div class="header-title">
                                          <h4 class="card-title">Nouveau Contrat : Données FIC</h4>
                                    </div>
                                 </div>
                                 <div class="form-card text-start">
                                    <div class="row">
                                       <div class="col-md-6">
                                          <div class="form-group">
                                             <label class="form-label">Civilité: <span class="text-danger">*<span></label>

                                             <div class="bd-example">
                                                <div class="form-check form-check-inline">
                                                   <input type="radio" class="form-check-input" name="civilite" id="civilite" value=1>
                                                   <label for="radio1" class="pl-2 form-check-label">Homme</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                   <input type="radio" class="form-check-input" name="civilite" id="civilite" value=2>
                                                   <label for="radio2" class="pl-2 form-check-label">Femme</label>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group">
                                             <label class="form-label">Prénom: <span class="text-danger">*<span></label>
                                             <input type="text" class="form-control" name="lname" id="lname" required="required" placeholder="Prénom"/>
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group">
                                             <label class="form-label">Nom: <span class="text-danger">*<span></label>
                                             <input type="text" class="form-control" name="fname" id="fname" required="required" placeholder="Nom"/>
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group">
                                             <label class="form-label">Date de naissance: <span class="text-danger">*<span></label>
                                             <input type="date" class="form-control" name="datebirth" id="datebirth" required="required" placeholder="Date de naissance"/>
                                          </div>
                                       </div>
                                       
                                       <div class="col-md-6">
                                          <div class="form-group">
                                             <label class="form-label">Mobile: <span class="text-danger">*<span></label>
                                             <input type="text" class="form-control" name="mobile" id="mobile" required="required" placeholder="Mobile" maxlength="10"/>
                                          </div>
                                       </div>
                                       @if($choice == [105])
                                          <div class="col-md-6">
                                             <div class="form-group">
                                                <label class="form-label">Age:</label>
                                                <input type="text" class="form-control" name="age" id="age" placeholder="Age" disabled/>
                                             </div>
                                          </div>
                                       @endif
                                       <div class="col-md-6">
                                          <div class="form-group">
                                             <label class="form-label">Tel Fixe: </label>
                                             <input type="text" class="form-control" name="fixe" id="fixe" required="required" placeholder="Tel Fixe" maxlength="10"/>
                                          </div>
                                       </div>
                                       @if($choice == [105])
                                          <div class="col-md-6">
                                             <div class="form-group">
                                                <label class="form-label">Nom de naissance:<span class="text-danger">*<span> </label>
                                                <input type="text" class="form-control" name="nom_naissance" id="nom_naissance" required="required" placeholder="Nom de naissance"/>
                                             </div>
                                          </div>
                                       @endif
                                       <div class="col-md-6">
                                             <div class="form-group">
                                                <label class="form-label">Email: <span class="text-danger">*<span></label>
                                                <input type="email" class="form-control" name="email" id="email" required="required" placeholder="Email"/>
                                             </div>
                                          </div>
                                       
                                       @if($choice == [105])
                                          <div class="col-md-6">
                                             <div class="form-group">
                                                <label class="form-label">Département de naissance:<span class="text-danger">*<span> </label>
                                                <input type="text" class="form-control" name="departement_naissance" id="departement_naissance" required="required" placeholder="Département de naissance"/>
                                             </div>
                                          </div>
                                       @endif
                                       
                                        <div class="col-md-6">
                                          <div class="form-group">
                                             <label class="form-label">Confirmer Email: <span class="text-danger">*<span></label>
                                             <input type="email" class="form-control" name="confirmedemail" id="confirmedemail" required="required" placeholder="Confirmer Email"/>
                                          </div>
                                       </div>  
                                       @if($choice == [105])
                                          <div class="col-md-6">
                                             <div class="form-group">
                                                <label class="form-label">Commune de naissance:<span class="text-danger">*<span> </label>
                                                <input type="text" class="form-control" name="commune_naissance" id="commune_naissance" required="required" placeholder="Commune de naissance" />
                                             </div>
                                          </div>
                                       @endif
                                     
                                       
                                       {{-- @if($choice == [105]) --}}
                                       <div class="col-md-6">
                                       </div>
                                    {{-- @endif --}}
                                       
                                       @if($choice == [105])
                                          <div class="col-md-6">
                                             <div class="form-group">
                                                <label class="form-label">Pays de naissance:<span class="text-danger">*<span> </label>
                                                <input type="text" class="form-control" name="pays_naissance" id="pays_naissance" required="required" placeholder="Pays de naissance" />
                                             </div>
                                          </div>
                                       @endif
                                       @if($choice == [105])
                                          <div  class="form-group">
                                                <label class="form-label">Situation professionnelle : <span class="text-danger">*<span></label>
                                                   <div style="margin-left: 22%;margin-top: -4%">
                                                      <br>
                                                      <div class="form-check form-check-inline">
                                                         <input type="radio" class="form-check-input" name="situation_pro" id="radio7" value="activite" checked>
                                                         <label for="radio7" class="pl-2 form-check-label">En activité </label>
                                                      </div>
                                                      <br>
                                                      <div class="form-check form-check-inline">
                                                         <input type="radio" class="form-check-input" name="situation_pro" id="radio8" value="recherche">
                                                         <label for="radio8" class="pl-2 form-check-label">En recherche d’emploi </label>
                                                      </div>
                                                      <br>
                                                      <div class="form-check form-check-inline">
                                                         <input type="radio" class="form-check-input" name="situation_pro" id="radio9" value="sans_activite" >
                                                         <label for="radio9" class="pl-2 form-check-label">Sans activité </label>
                                                      </div>
                                                      <br>
                                                      <div class="form-check form-check-inline">
                                                         <input type="radio" class="form-check-input" name="situation_pro" id="radio10" value="retaite">
                                                         <label for="radio10" class="pl-2 form-check-label">Retraité</label>
                                                      </div>
                                                   </div>
                                          </div>
                                          <div class="form-group">
                                             <label class="form-label">Statut de la famille : <span class="text-danger">*<span></label>
                                             <div class="form-check form-check-inline">
                                                <input type="radio" class="form-check-input" name="statu_famille" id="radio3" value="Célibataire" checked>
                                                <label for="radio3" class="pl-2 form-check-label">Célibataire</label>
                                             </div>
                                             <div class="form-check form-check-inline">
                                                <input type="radio" class="form-check-input" name="statu_famille" id="radio4" value="Couple">
                                                <label for="radio4" class="pl-2 form-check-label">Couple</label>
                                             </div>
                                          </div>
                                       
                                          <div class="form-group">
                                             <label class="form-label">Avec enfant(s): <span class="text-danger">*<span></label>

                                             
                                                   <div class="form-check form-check-inline">
                                                      <input type="radio" class="form-check-input" name="enfant" id="radio5" value="Oui" >
                                                      <label for="radio5" class="pl-2 form-check-label">Oui</label>
                                                   </div>
                                                   <div class="form-check form-check-inline">
                                                      <input type="radio" class="form-check-input" name="enfant" id="radio6" value="Non">
                                                      <label for="radio6" class="pl-2 form-check-label">Non</label>
                                                   </div>
                                          </div>
                                          <div id="div_nbr" class="col-md-6" style="display: none">
                                             <div class="">
                                                <label class="form-label">Nombre de personne à charge: <span class="text-danger">*<span></label>
                                                      <input type="number" style="width: 98%;color:#8A92A6;font-size: 20px" class="nbr-perss" name="nbr_per" id="nbr_per" required="" placeholder="Nombre de personne à charge">
                                             </div>
                                          </div>
                                          
                                       
                                       @endif
                                    </div>
                                 </div>
                                 <button type="button" name="next" class="btn btn-primary  action-button float-end" value="Next" id="nxt1">Confirmer l’identité</button>
                              </fieldset>
                              <fieldset>
                                 <div class="d-flex justify-content-between">
                                    <div class="header-title">
                                          <h4 class="card-title">Nouveau Contrat : Données FIC</h4>
                                    </div>
                                 </div>
                                 <div class="form-card text-start">
                                    <div class="row">
                                    <div class="col-md-6">
                                          <div class="form-group">
                                             <label class="form-label">Prénom: </label>
                                             <label class="form-label step1lname" id="step1lname" style="color:#6c757d;"></label>
                                          </div>
                                    </div>
                                    <div class="col-md-6">
                                          <div class="form-group">
                                             <label class="form-label">Nom: </label>
                                             <label class="form-label step1fname" id="step1fname" style="color:#6c757d;"> </label>
                                          </div>
                                    </div>
                                    <div class="col-md-6">
                                          <div class="form-group">
                                             <label class="form-label">Adresse: <span class="text-danger">*<span></label>
                                             <input type="text" class="form-control" name="add1" id="add1" placeholder="adresse 1" />
                                          </div>
                                    </div>
                                    <div class="col-md-6">
                                          <div class="form-group">
                                          <label class="form-label"> &emsp;&emsp; </label>
                                             <input type="text" class="form-control" name="add2" id="add2" placeholder="adresse 2" />
                                          </div>
                                    </div>
                                    <div class="col-md-6">
                                          <div class="form-group">
                                          <label class="form-label">&emsp;&emsp; </label>
                                             <input type="text" class="form-control" name="add3" id="add3" placeholder="adresse 3" />
                                          </div>
                                    </div>
                                    <div class="col-md-6">
                                         
                                    </div>
                                   
                                    <div class="col-md-6">
                                       <div class="form-group">
                                           <label class="form-label">Entrez le code postal: <span class="text-danger">*</span></label>
                                           <input type="text" class="form-control" name="cp" id="cp" placeholder="CP" maxlength="5"/>
                                       </div>
                                   </div>
                                   
                                   <div class="col-md-6">
                                       <label class="form-label">Choisissez la ville:</label>
                                       <div class="form-group">
                                           <select class="form-select form-select-sm" id="citys">
                                               <option selected="" value="">----------------------------Sélectionner une ville--------------------------</option>
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
                                   {{-- <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Commune:</label>
                                        <input type="text" class="form-control" name="commune" id="commune" placeholder="Département" disabled/>
                                    </div>
                                </div> --}}
                                   
                                  
                                    
                                    </div>
                                 </div>
                                 <button type="button" name="next" class="btn btn-primary action-button float-end" value="Next" id="nxt2">Confirmer Coordonnées</button>
                                 <button type="button" name="previous" class="btn btn-dark previous action-button-previous float-end me-1" value="Previous" >Retour</button>
                              </fieldset>
                              <fieldset id="beforepdf">
                                 <div class="d-flex justify-content-between">
                                    <div class="header-title">
                                          <h4 class="card-title">Nouveau Contrat : Données FIC</h4>
                                    </div>
                                 </div>
                                 <div class="form-card text-start">
                                    <div class="row">
                                       <div class="col-md-6">
                                             <div class="form-group">
                                                <label class="form-label">Prénom: </label>
                                                <label class="form-label step1lname" id="step1lname" style="color:#6c757d;"></label>
                                             </div>
                                       </div>
                                       <div class="col-md-6">
                                             <div class="form-group">
                                                <label class="form-label">Nom: </label>
                                                <label class="form-label step1fname" id="step1fname" style="color:#6c757d;"></label>
                                             </div>
                                       </div>
                                    </div>
                                    <div class="form-group">
                                       <div class="form-check">
                                         
                                          @if($choice == [101, 102])
                                          <input class="form-check-input" type="checkbox" name="confirmcheck" id="confirmcheck"/>
                                             <label class="form-check-label maf" for="confirmcheck">
                                                Souhaitez-vous vous prémunir financièrement en cas de de licenciement économique, cessation d’activité suite à un dépôt de bilan, affectation longue durée
                                                (ALD 30 ou ALD 32) ou hospitalisation ?
                                             </label>
                                          @elseif($choice == [101] || $choice == [102])
                                          <input class="form-check-input" type="checkbox" name="confirmcheck" id="confirmcheck"/>
                                             <label class="form-check-label maf" for="confirmcheck">
                                                Souhaitez-vous vous prémunir financièrement en cas de de licenciement économique, cessation d’activité suite à un dépôt de bilan, affectation longue durée
                                                (ALD 30 ou ALD 32) ou hospitalisation ?
                                             </label>
                                          @elseif($choice == [104])
                                          <input class="form-check-input" type="checkbox" name="confirmcheck" id="confirmcheck"/>
                                             <label class="form-check-label map" for="confirmcheck">
                                                Souhaitez-vous vous prémunir financièrement en cas d’une fuite d’eau intérieure ou extérieure, d’une panne de votre installation électrique et / ou de
                                                disfonctionnement de votre chaudière, chauffe-eau ou chauffe-bain ?
                                             </label>
                                          @elseif ($choice == [105])
                                             <div class="form-card text-start">
                                                <div class="row">
                                                   <div class="col-md-6">
                                                      <div class="form-group">
                                                            <label class="form-label">Lors de notre conversation vous nous avez indiqué posséder les produit(s) d’assurance(s) suivant(s) : (Plusieurs choix possible parmi la liste):<span class="text-danger">*<span></label>
                                                               <div style="margin-left: 10%" class="col-md-6">
                                                                        <div class="form-check form-switch">
                                                                           <input class="form-check-input" type="checkbox" id="mutuelle"name="mutuelle" >
                                                                           <label class="form-check-label" for="mutuelle">Mutuelle</label>
                                                                        </div>
                                                                        <div class="form-check form-switch">
                                                                           <input class="form-check-input" type="checkbox" id="assurance_dece"name="assurance_dece" >
                                                                           <label class="form-check-label" for="assurance_dece">Assurance Décès</label>
                                                                        </div>
                                                                        <div class="form-check form-switch">
                                                                           <input class="form-check-input" type="checkbox" id="hospitalisation"name="hospitalisation">
                                                                           <label class="form-check-label" for="hospitalisation">Hospitalisation</label>
                                                                        </div>

                                                                        <div class="form-check form-switch">

                                                                           <input class="form-check-input" type="checkbox" id="protection"name="protection">

                                                                           <label class="form-check-label" for="protection">Protection factures /maintien de revenus</label>

                                                                        </div>

                                                                        <div class="form-check form-switch">

                                                                           <input class="form-check-input" type="checkbox" id="garantie"name="garantie">

                                                                           <label class="form-check-label" for="garantie">Garantie accident de la vie</label>

                                                                        </div>

                                                                        <div class="form-check form-switch">

                                                                           <input class="form-check-input" type="checkbox" id="dependance"name="dependance">

                                                                           <label class="form-check-label" for="dependance">Dépendance</label>

                                                                        </div>

                                                                        <div class="form-check form-switch">

                                                                           <input class="form-check-input" type="checkbox" id="assurance_vie"name="assurance_vie">

                                                                           <label class="form-check-label" for="assurance_vie">Assurance Vie</label>

                                                                        </div>

                                                                        <div class="form-check form-switch">

                                                                           <input class="form-check-input" type="checkbox" id="autre"name="autre">

                                                                           <label class="form-check-label" for="autre">Autre</label>

                                                                        </div>

                                                                        <div class="form-check form-switch">

                                                                           <input class="form-check-input" type="checkbox" id="aucun"name="aucun">

                                                                           <label class="form-check-label" for="aucun">Je n’ai pas de produit d’assurance </label>

                                                                        </div>

                                                                  

                                                            

                  

                                                               </div>

                                                      </div>

                                                   </div>

                                                   <div class="col-md-6">

                                                      <div class="form-group">

                                                         <label class="form-label">Choisissez le capital:<span class="text-danger">*<span></label>

                                                            <select style="width: 100%;text-align: center;height: 42px;border-color: #6c757d" class="form-select form-select-sm"  name="etre_couvert" id="etre_couvert">

                                                               <option selected>Selectionnez le capital</option>

                                                               <option value="4000">4000 euros</option>

                                                               <option value="5000">5000 euros</option>  
                                                            </select>    
                                                      </div>
                                                   </div>
                                                   <div class="col-md-6">
                                                      <div class="form-group">
                                                         <div class="form-group">
                                                            <label class="form-label"> Par ailleurs durant notre échange, vous nous avez notifié vouloir un produit permettant de : (plusieurs choix possible parmi la liste):<span class="text-danger">*<span></label>
                                                               <div style="margin-left: 10%" class="col-md-6">
                                                                  <div class="form-check form-switch">
                                                                     <input class="form-check-input" type="checkbox" id="proteger"name="proteger">
                                                                     <label class="form-check-label" for="proteger">Protéger votre famille/proche en cas de décès</label>
                                                                  </div>
                                                                  <div class="form-check form-switch">
                                                                     <input class="form-check-input" type="checkbox" id="assure_dece"name="assure_dece">
                                                                     <label class="form-check-label" for="assure_dece">Être assuré(e) en cas de décès</label>
                                                                  </div>
                                                                  <div class="form-check form-switch">
                                                                     <input class="form-check-input" type="checkbox" id="finance_org"name="finance_org">
                                                                     <label class="form-check-label" for="finance_org">Prévoir le financement et l’organisation de vos obsèques</label>
                                                                  </div>
                                                                  <div class="form-check form-switch">
                                                                     <input class="form-check-input" type="checkbox" id="capital"name="capital">
                                                                     <label class="form-check-label" for="capital">Compléter le capital prévu pour le financement et l’organisation de vos obsèques. </label>
                                                                  </div>
                                                               </div>
                                                         </div>
                                                      </div>
                                                   </div>
                                                   <div class="col-md-6">
                                                      <div class="form-group">
                                                         <label class="form-label">Montant de cotisation: <span class="text-danger">*<span></label>
                                                         <input type="text" class="form-control" name="montant_de_cotisation" id="montant_de_cotisation" required="required" placeholder="Montant de cotisation" disabled/>
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
                                          <label class="form-check-label" for="risque">Etes-vous assurés contre ce type de risques ?</label>
                                       </div>
                                       <div class="form-check form-switch">
                                          <input class="form-check-input" type="checkbox" id="product">
                                          <label class="form-check-label" for="product">Dans l’affirmative, souhaitez-vous changer de produit et d’assureur ?</label>
                                       </div>
                                    </div>

                                    <div class="form-group div-comment">
                                       <label class="form-label" for="exampleFormControlTextarea1">Commentaire</label>
                                       <textarea class="form-control" id="comment" rows="5" ></textarea>
                                    </div>
                                 </div>
                                 <button type="button" name="next" class="btn btn-primary action-button float-end" value="Submit" id="nxt3">Confirmer Votre besoin</button>
                                 <button type="button" name="previous" class="btn btn-dark previous action-button-previous float-end me-1" value="Previous" >Retour</button>
                              </fieldset>
                              <fieldset id="afterpdf">
                                 <div class="d-flex justify-content-between">
                                    <div class="header-title">
                                          <h4 class="card-title">Nouveau Contrat : Données FIC</h4>
                                    </div>
                                 </div>
                           
                                 <div class="form-card text-start">
                                    <div class="row">
                                       <div class="col-md-6">
                                             <div class="form-group">
                                                <label class="form-label">Prénom: </label>
                                                <label class="form-label step1lname" style="color:#6c757d;"></label>
                                             </div>
                                       </div>
                                       <div class="col-md-6">
                                             <div class="form-group">
                                                <label class="form-label">Nom: </label>
                                                <label class="form-label step1fname" style="color:#6c757d;"></label>
                                             </div>
                                       </div>
                                    </div>
                                    <div class="row">
                                       <div class="col-md-6">
                                             <div class="form-group">
                                                <label class="form-label">Mobile: </label>
                                                <label class="form-label mobile" style="color:#6c757d;"></label>
                                             </div>
                                       </div>
                                       <div class="col-md-6">
                                             <div class="form-group">
                                                <label class="form-label">Email: </label>
                                                <label class="form-label email" style="color:#6c757d;"></label>
                                             </div>
                                       </div>
                                    </div>
                                    <div class="row">
                                       <div class="col-md-6">
                                             <div class="form-group">
                                                <label class="form-label">Adresse: </label>
                                                <label class="form-label fulladress" style="color:#6c757d;"></label>
                                             </div>
                                       </div>

                                       <div class="col-md-6">
                                             <div class="form-group">
                                                <label class="form-label">Code postal: </label>
                                                <label class="form-label cp" style="color:#6c757d;"></label>
                                             </div>
                                       </div>
                                    </div>

                                    <div class="row">
                                       <div class="col-md-6">
                                             <div class="form-group">
                                                <label class="form-label">Ville: </label>
                                                <label class="form-label city" style="color:#6c757d;"></label>
                                             </div>
                                       </div>

                                       <div hidden id="pdf_div" class="col-md-6">
                                          <a data-title="PDF" class="navi-link showpdf" title="Récapitulatif de vos données">
                                             <div class="p-3 d-flex justify-content-center align-items-center iq-document rounded bg-body">
                                                <img src="{{ asset('images/pages/pdf.svg') }}" class="img-fluid" alt="pdf.svg" style="height: 84px;" loading="lazy">
                                             </div>
                                          </a>
                                       </div>
                                    </div>
                                    @if ($choice != [105])
                                    <div class="form-group choose1">
                                       <div class="form-check">                
                                          <label class="form-check-label" for="invalidCheck2" >
                                          - Vous avez besoin de vous prémunir financièrement
                                          </label>
                                       </div>
                                    </div>

                                    <div class="form-group choose2">
                                       <div class="form-check">
                                          <label class="form-check-label" for="invalidCheck2" >
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
                                                <label class="form-label comment" style="color:#6c757d;"></label>
                                             </div>
                                       </div>
                                    </div>                 
                                 </div>
                                 <button type="button" name="next" class="btn btn-primary action-button float-end" value="Submit" id="nxt4">Confirmer les données</button>
                                 <button type="button" name="previous" class="btn btn-dark previous action-button-previous float-end me-1" value="Previous" >Retour</button>
                              </fieldset> 
                              <fieldset>
                                 <div class="d-flex justify-content-between">
                                    <div class="header-title">
                                          <h4 class="card-title">Nouveau Contrat : Données FIC</h4>
                                    </div>
                                 </div>
                                 <div class="form-card text-start">
                                    <div class="form-group">
                                       <label class="form-label">Un SMS a été envoyé au <span class="mobile"></span> contenant un lien pour accéder au FIC.</label>
                                    </div>
                                    <div class="form-group">
                                       <label class="form-label">Le fichier contient un code d’authentification dont la durée est de 5 min.</label>
                                    </div>
                                    <div class="form-group">
                                       <label class="form-label">Veuillez demander au client de saisir ce code ici :</label>
                                    </div>
                                 </div>

                                 <div class="otc" name="one-time-code">
                                       <label for="otc-1">Number 1</label>
                                       <label for="otc-2">Number 2</label>
                                       <label for="otc-3">Number 3</label>
                                       <label for="otc-4">Number 4</label>
                                       <label for="otc-5">Number 5</label>
                                       <label for="otc-6">Number 6</label>

                                       <!-- https://developer.apple.com/documentation/security/password_autofill/enabling_password_autofill_on_an_html_input_element -->
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
                                 <button type="button" name="next" class="btn btn-primary action-button float-end" value="Submit" id="nxt5">Valider le code</button>
                                 <button type="button" name="previous" class="btn btn-dark previous action-button-previous float-end me-1" value="Previous" >Retour</button>
                              </fieldset>
                              <fieldset>
                                 <div class="d-flex justify-content-between">
                                    <div class="header-title">
                                          <h4 class="card-title">Nouveau Contrat : Données de Demande d’adhésion</h4>
                                    </div>
                                 </div>              

                                 <div class="tab-content maftab">
                                    <div class="tab-pane bd-heading-1 fade show active" id="content-accordion-prv" role="tabpanel">
                                       <div class="bd-example">
                                          <div class="accordion maf" id="accordionExample">
                                             <div class="accordion-item">
                                                <h5 class="accordion-header" id="headingOne">
                                                   <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                                      GARANTIES
                                                   </button>
                                                </h5>
                                                <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample" style="">
                                                   <div class="accordion-body">
                                                      <input class="form-check-input" type="checkbox" name="garantiechx" id="garantiechx1">
                                                      LES GARANTIES SOUSCRITES : L’assuré, à jour de ses cotisations, béneficie d’une prise en charge du paiement des factures* suite à la
                                                      réalisation de l’un des risques suivants, mentionnés dans la notice d’information du contrat N° LPASPH 001 :</br>
                                                      - Licenciement économique,</br>
                                                      - Cessation d’activité suite à dépôt de bilan,</br>
                                                      - Affections longues durées (ALD-30) et/ou Polypathologies (ALD-32)</br>
                                                      * L’assureur prends en charge 12 mois de factures de téléphonie, internet, assurance et énergétique (éléctricité et/ou gaz, bois, fuel, etc), dans la
                                                      limite de 1.000,00 €uros par sinistre et par année d’assurance (comprenant la part « abonnement » et la part « consommation »), sur la base de
                                                      l’offre souscrite par l’assuré auprès de son fournisseur.</br>
                                                      L’assuré, à jour de ses cotisations, bénéficie également d’une prise en charge des frais médicaux d’hospitalisation, égale ou supérieur à 3 jours dans
                                                      la limite de 200 € par événement et par année (factures de téléphonie, internet, assurance et énergétique, ménage, jardinage, transport etc...)</br>

                                                      <input class="form-check-input" type="checkbox" name="garantiechx" id="garantiechx2">
                                                      Je reconnais avoir reçu lors de l’adhésion la fiche IPID, la notice d’information valant condition générale et avoir répondu en toute sincérité à la
                                                      fiche d’information et de conseil.
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="accordion-item">
                                                <h5 class="accordion-header" id="headingTwo">
                                                   <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                      CONDITION
                                                   </button>
                                                </h5>
                                                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample" style="">
                                                   <div class="accordion-body">
                                                   <input class="form-check-input" type="checkbox" name="garantiechx" id="garantiechx3">
                                                   <strong>En signant ce bulletin d’adhesion:</strong></br>J’atteste disposer de la capacité nécessaire à la conclusion et à l’exécution du présent contrat.</br>
                                                   Je reconnais avoir reçu et pris connaissance des principales dispositions du contrat collectif n° LPASPH001 et je demande à adhérer à ce contrat.</br>
                                                   J’accepte les conditions générales de vente, dont l’article 2 alinéa 2 de la notice d’information du contrat n° LPASPH001 relatif à la durée du présent
                                                   bulletin d’adhesion et des conditions de résiliation.</br>
                                                   Je confirme ma souscription aux garanties de prise en charge du paiement des factures* moyennant un abonnement. 
                                                   <strong>de 7,90 € TTC par mois par option d’énergie, avec un engagement de 12 mois, renouvelable par tacite reconduction.</strong>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>    
                                 </div>

                                 <div class="tab-content pgetab">
                                    <div class="tab-pane bd-heading-1 fade show active" id="content-accordion-prv" role="tabpanel">
                                       <div class="bd-example">
                                          <div class="accordion maf" id="accordionExample">
                                             <div class="accordion-item">
                                                <h5 class="accordion-header" id="headingOne">
                                                   <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                                      GARANTIES
                                                   </button>
                                                </h5>
                                                <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample" style="">
                                                   <div class="accordion-body">
                                                      <input class="form-check-input" type="checkbox" name="garantiechx" id="garantiechx1">
                                                      LES GARANTIES SOUSCRITES : L’assuré, à jour de ses cotisations, béneficie d’une prise en charge du paiement des factures en cas de
                                                      réparation* suite à la réalisation de l’un des risques suivants, mentionnés dans la notice d’information du contrat N°01049859 :</br>
                                                      - fuite d’eau intérieure ou extérieure,</br>
                                                      - panne de l’installation électrique,</br>
                                                      - disfonctionnement de votre chaudière, chauffe-eau,</br>
                                                      * L’assureur prend en charge, dans la limite des montants ci-dessous, vos frais de réparation en cas de :</br>
                                                      1. fuite d’eau intérieure ou extérieure (Intérieure : fuite ou engorgement sur circuit d’évacuation, de chauffage, ballon, sanitaires et
                                                      raccordement des appareils avec prise en charge des réparations : 600 € par sinistre et par année d’assurance); Extérieure : fuite ou engorgement
                                                      sur circuit d’alimentation en eau ou sur circuit d’évacuation avec prise en charge des réparations : 1 000 € par sinistre et par année d’assurance).</br>
                                                      2. panne de l’installation électrique (Panne électrique sur câblage, tableau électrique, prises, interrupteurs, plafonniers et appliques avec prise
                                                      en charge des réparations : 600 € par sinistre et par année d’assurance).</br>
                                                      3. disfonctionnement de votre chaudière (Panne accidentelle provoquant l’interruption ou le dysfonctionnement de la chaudière ou du
                                                      chauffe-eau avec prise en charge des réparations : 600 € par sinistre et par année d’assurance).</br>
                                                      L’ensemble des sinistres pris en charge est limité à deux (2) par année d’assurance.</br>
                                                      <input class="form-check-input" type="checkbox" name="garantiechx" id="garantiechx2">
                                                      Je reconnais avoir reçu lors de l’adhésion la fiche IPID, la notice d’information valant conditions générales et avoir répondu en toute sincérité à
                                                      la fiche d’information et de conseil.
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="accordion-item">
                                                <h5 class="accordion-header" id="headingTwo">
                                                   <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                      CONDITION
                                                   </button>
                                                </h5>
                                                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample" style="">
                                                   <div class="accordion-body">
                                                   <input class="form-check-input" type="checkbox" name="garantiechx" id="garantiechx3">
                                                   <strong>En signant ce bulletin d’adhesion:</strong></br>J’atteste disposer de la capacité nécessaire à la conclusion et à l’exécution du présent contrat.
                                                   Je reconnais avoir reçu et pris connaissance des principales dispositions du contrat collectif n° 01048959 et je demande à adhérer à ce contrat.
                                                   J’accepte les conditions générales d’assurance, dont l’article 3 de la notice d’information du contrat n° 01048959 relatif à la durée du présent
                                                   bulletin d’adhesion et des conditions de résiliation.</br>
                                                   Je confirme ma souscription aux garanties de prise en charge du paiement des factures en cas de réparation* moyennant un abonnement 
                                                   <strong>de 13,90 € TTC (11.90 € de prime d’assurance TAC + 2 € de frais de dossier) par mois , avec un engagement de 12 mois, ensuite résiliable à tout moment et
                                                   renouvelable par tacite reconduction.</strong>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>    
                                 </div>
                                 <div class="tab-content gfotab">
                                    <div class="tab-pane bd-heading-1 fade show active" id="content-accordion-prv" role="tabpanel">
                                       <div class="bd-example">
                                          <div class="accordion maf" id="accordionExample">
                                             <div class="accordion-item">
                                                <h5 class="accordion-header" id="headingOne">
                                                   <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                                      GARANTIES
                                                   </button>
                                                </h5>
                                                <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample" style="">
                                                   <div class="accordion-body">
                                                      <input class="form-check-input" type="checkbox" name="garantiechx" id="garantiechx1">
                                                      Le contrat Garantie Frais d’Obsèques prévoit, en cas de décès :</br>
                                                      - Le <strong> versement d'un capital au(x) bénéficiaire(s) de votre choix</strong> (personne physique ou entreprise funéraire) <strong> destiné au financement des obsèques. Vous choisissez le montant du capital souhaité (de 4 000 à 5 000 euros);</strong></br>
                                                      -Des <strong> prestations d'assistance </strong>permettant d'anticiper l'organisation des obsèques et d'accompagner vos proches dans ces moments difficiles.</br>
                                                      Le détail des prestations d’assurance et d’assistance est reporté à l'article 3 des Conditions Générales, ci-jointes, valant note d'information.</br>
                                                      La durée du contrat s’étend à votre vie entière sous réserve du paiement des cotisations.</br>
                                                     <strong> Nous attirons votre attention sur le fait que le capital décès ne peut être utilisé </strong>, à concurrence de leur coût <strong>à des fins étrangères au financement des obsèques . Selon le montant choisi </strong>, le capital <strong>peut être insuffisant pour couvrir l’ensemble des frais d’obsèques.</strong> </br>
                                                     Par ailleurs, la<strong> rédaction de la clause bénéficiaire </strong>est <strong>importante</strong> notamment en termes d’identité lors de l’indication du ou des bénéficiaire(s) et il est opportun de désigner un/des bénéficiaire(s) subséquent(s) en cas de disparition anticipée de la personne ou opérateur funéraire désigné(e).
                                                    <strong> Vous pourrez modifier les bénéficiaires de ce contrat à tout moment. Il est possible que ces derniers doivent avancer les fonds dans l’attente de règlement du capital.</strong></br>

                                                   <strong>N’oubliez pas d’informer vos proches de l’existence du contrat d’assurance.</strong></br>
                                                      <strong>En cas de sinistre</strong> , la déclaration doit être faite à l’assureur dans les 30 jours suivant sa survenance. Le paiement du capital garanti se fait dans les 15 jours suivants la réception du dossier complet. Vous pouvez retrouver le détail des conditions de prise en charge et la liste des pièces à fournir dans les Conditions Générales (article 10 – Que faire en cas de sinistre   ?)</br>
                                                      <input class="form-check-input" type="checkbox" name="garantiechx" id="garantiechx2">
                                                      La notice d’information valant conditions générales et avoir lu et répondu en toute sincérité à la fiche d’information et de conseil.
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="accordion-item">
                                                <h5 class="accordion-header" id="headingTwo">
                                                   <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                      CONDITIONS
                                                   </button>
                                                </h5>
                                                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample" style="">
                                                   <div class="accordion-body">
                                                   <input class="form-check-input" type="checkbox" name="garantiechx" id="garantiechx3">
                                                   Nous attirons votre attention sur les limites de couverture du contrat et vous invitons à prendre connaissance, notamment, des exclusions à l'article 4 des Conditions Générales valant note d’information. Sont exclus par exemple le décès résultant d’un accident antérieur à la prise d’effet des garanties   ; le suicide au cours de la première année, etc… Par ailleurs, <strong>en cas de décès survenant dans les deux premières années d'assurance du fait d'un événement non accidentel (maladie), la garantie sera limitée au remboursement des cotisations versées hors cotisations d’assistance.</strong></br>



                                                   -Les conséquences d’accidents survenus avant la prise d’effet des garanties.</br>
                                                   -Le suicide ou la tentative de suicide survenant moins d’un an après la prise d’effet du contrat. En cas d’augmentation des garanties en cours de contrat, le risque de suicide est également exclu, pour les majorations, au cours de la première année qui suit la prise d’effet de cette augmentation.</br>
                                                   -Le fait de guerre civile ou étrangère.</br>
                                                   -Le décès survenant sous l’emprise d’état consécutif à l’utilisation de stupéfiants, substances analogues, médicaments ou traitements à doses non prescrites médicalement, ou de l’état alcoolique de l’assure, caractérise par la présence, dans le sang, d’un taux d’alcool pur égal ou supérieur à celui fixe par la loi régissant la circulation automobile au moment du sinistre.</br>
                                                   Nous n’aurons pas à apporter la preuve de l’existence d’un lien de causalité entre le décès et l’état de l’assuré. Voir le détail des garanties, conditions, limites et exclusions applicables dans la notice d’information.</br>

                                                   
                                                   
                                                  
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>    
                                 </div>
                              
                                 <button type="button" style="margin-top: 10px" name="next" class="btn btn-primary action-button float-end" value="Submit" id="nxt6">Valider le code</button>
                                 <button type="button" style="margin-top: 10px" name="previous" class="btn btn-dark previous action-button-previous float-end me-1" value="Previous" >Retour</button>
                              </fieldset>
                              <fieldset>
                                 <div class="d-flex justify-content-between">
                                    <div class="header-title">
                                          <h4 class="card-title">Nouveau Contrat : Données de Demande d’adhésion</h4>
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
                                                <label class="form-label step1lname" id="step1lname" style="color:#6c757d;"></label>
                                             </div>
                                       </div>  
                                       <div class="col-md-6">
                                             <div class="form-group">
                                                <label class="form-label">Nom: </label>
                                                <label class="form-label step1fname" id="step1fname" style="color:#6c757d;"></label>
                                             </div>
                                       </div>
                                    </div>

                                    <div class="form-group">
                                       <input class="form-check-input" type="checkbox" name="confirmcertif" id="confirmcertif"/>
                                       <label class="form-check-label" for="confirmcertif">Je certifie être le titulaire de l'Iban/Bic suivant</label>
                                    </div>

                                    <div class="form-group">
                                       <label class="form-label">IBAN:</label>
                                       <input type="text" class="form-control" id="iban" placeholder="IBAN" />
                                    </div>

                                    <div class="form-group">
                                       <label class="form-label">BIC:</label>
                                       <input type="text" class="form-control" id="bic" placeholder="BIC" />
                                    </div>
                                    @if($choice != [105])
                                       <div class="form-group">
                                          <label class="form-label">Choix du jour de prélévement</label>
                                          <select class="form-select1" id="days_normal">
                                             <option selected="" value="">---------Sélectionner votre choix--------</option>
                                          </select>
                                       </div>
                                    @endif
                                    
                                   
                                    
                                 </div>

                                 <button type="button" name="next" class="btn btn-primary action-button float-end" value="Submit" id="nxt7">Confirmer</button>
                                 <button type="button" name="previous" class="btn btn-dark previous action-button-previous float-end me-1" value="Previous" >Retour</button>
                              </fieldset>
                              {{-- @if($choice != [105]) --}}

                              <fieldset hidden id="id_pdl">
                                 <div class="d-flex justify-content-between">
                                    <div class="header-title1">
                                          <h4 class="card-title">Nouveau Contrat : Données de Demande d’adhésion</h4>
                                    </div>
                                 </div>
                                 <div class="form-card text-start oldsectionpdl">
                                    <div class="form-group partelec">
                                       <label class="form-label">PDL Elec:</label>
                                       <input type="text" class="form-control" id="pdlElec" placeholder="PDL Elec" maxlength="14"/>
                                    </div>
                                    <div class="form-group partelec">
                                       <label class="form-label">Fournisseur Elec:</label>
                                       <select class="form-select" id="f-elec" disabled>
                                          <option selected="" disabled="" value="">Sélectionner un fournisseur</option>
                                       </select>
                                    </div>
                                    <div class="form-group partgaz">
                                       <label class="form-label">PDL Gaz:</label>
                                       <input type="text" class="form-control" id="pdlGaz" placeholder="PDL Gaz" maxlength="14"/>
                                    </div>
                                    <div class="form-group partgaz">
                                       <label class="form-label">Fournisseur Gaz:</label>
                                       <select class="form-select" id="f-gaz" disabled>
                                          <option selected="" disabled="" value="">Sélectionner un fournisseur</option>
                                       </select>
                                    </div>
                                   
                                    <div hidden class="form-group partgfo">
                                       <label class="form-label">PDL Gfo:</label>
                                       <input type="text" class="form-control" id="pdlGfo" placeholder="PDL Gfo" maxlength="14"/>
                                    </div>
                                    <div hidden class="form-group partgfo">
                                       <label class="form-label">Fournisseur Gfo:</label>
                                       <select class="form-select" id="f-gfo" disabled>
                                          <option selected="" disabled="" value="">Sélectionner un fournisseur</option>
                                       </select>
                                    </div>
                                 </div>
                                 <button type="button" name="next" class="btn btn-primary action-button float-end oldsectionpdl" value="Submit" id="nxt8">Valider les informations</button>
                                 <button type="button" name="previous" class="btn btn-dark previous action-button-previous float-end me-1 oldsectionpdl" value="Previous" >Retour</button>
                              </fieldset>
                              {{-- @endif --}}
                              <fieldset id="finalisation">
                                 <div class="d-flex justify-content-between">
                                    <div class="header-title">
                                          <h4 class="card-title">Nouveau Contrat : Données de Demande d’adhésion</h4>
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

                                    <div class="row">
                                       <div class="col-md-6">
                                             <div class="form-group">
                                                <label class="form-label">Prénom: </label>
                                                <label class="form-label step1lname" style="color:#6c757d;"></label>
                                             </div>
                                       </div>
                                       <div class="col-md-6">
                                             <div class="form-group">
                                                <label class="form-label">Nom: </label>
                                                <label class="form-label step1fname" style="color:#6c757d;"></label>
                                             </div>
                                       </div>
                                    </div>

                                    <div class="row">
                                       <div class="col-md-6">
                                             <div class="form-group">
                                                <label class="form-label">Email: </label>
                                                <label class="form-label email" style="color:#6c757d;"></label>
                                             </div>
                                       </div>
                                       <div class="col-md-6">
                                             <div class="form-group">
                                                <label class="form-label">IBAN: </label>
                                                <label class="form-label iban" style="color:#6c757d;"></label>
                                             </div>
                                       </div>
                                    </div>


                                    <div class="card" style="box-shadow: 0 10px 30px 0 rgba(0, 0, 0, 0.31);">
                                       <div class="card-body">
                                          <p>En confirmant, vous allez recevoir un email à l’adresse <a><u class="email"></u></a> avec le lien de signature électronique</p>         
                                       </div>
                                    </div>

                                    <button type="button" name="next" class="btn btn-primary action-button float-end" value="Submit" id="nxt9">Confirmer la demande de signature</button>

                                 </div>
                              </fieldset>
                              <fieldset id="succes">
                                 <svg class="svgok" version="1.1" x="0" y="0" width="150px" height="150px" viewBox="-10 -10 120 120" enable-background="new 0 0 200 200" xml:space="preserve">
                                    <path 
                                          class="circle"
                                          d="M0,50 A50,50,0 1 1 100,50 A50,50,0 1 1 0,50"
                                    />
                                 </svg>
                                    <h2 class="text-success text-center"><strong>SUCCESS !</strong></h2>
                                    <br>
                                    <br><br>
                                    <!-- <div class="row justify-content-center">
                                    <div class="col-7 text-center">
                                          <h5 class="purple-text text-center">Vous avez reçu par email votre bulletin d'adhésion à signer par Docusign</h5>
                                    </div>
                                    </div> -->
                              </fieldset>
                        </form>
                        </div>
                     </div>
                  </div>
            </div>
         </div>
      </x-app-layout>

      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/9.8.2/sweetalert2.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

      <script type="text/javascript">
            data_Client=[];
               //function onPageLoad() {
               
               //$("#fname").val(sessionStorage.getItem("firstname"));
              // $("#lname").val(sessionStorage.getItem("lastname"));
              // $("#datebirth").val(sessionStorage.getItem("datebirth"));
               //$("#email").val(sessionStorage.getItem("email"));
              // $("#fixe").val(sessionStorage.getItem("fixe"));
              // $("#mobile").val(sessionStorage.getItem("mobile"));
              // $("#confirmedemail").val(sessionStorage.getItem("confirmedemail"));
              // $("#add1").val(sessionStorage.getItem("adresse1"));
              // $("#add2").val(sessionStorage.getItem("adresse2"));
              // $("#add3").val(sessionStorage.getItem("adresse3"));
              // $("#cp").val(sessionStorage.getItem("code_postal"));
              // $("#city").val(sessionStorage.getItem("city"));
              // $("#nbr_per").val(sessionStorage.getItem("nbr_pers_a_charger"));
              // $("#iban").val(sessionStorage.getItem("iban"));
              // $("#bic").val(sessionStorage.getItem("bic"));

               
         //}
      
        
               $(document).ready(function(){
                  //data
                  var data_Client=[];
                  var type = [];
                  var data = []; 
                  var yes_pgo='<img src="./images/pages/checked.png" style="margin-bottom:-4px;" width="10px" height="10px">';
                  var no_pgo='<img src="./images/pages/unchecked.png" style="margin-bottom:-4px;" width="10px" height="10px">';
                  var yes='<img src="./images/pages/checked.png" style="margin-bottom:-4px;" width="15px" height="15px">';
                  var no='<img src="./images/pages/unchecked.png" style="margin-bottom:-4px;" width="15px" height="15px">';
                  var checkfinancementsymbol="√ Oui";
                  var checkrisquesymbol="Non";
                  var checkproductsymbol="Non";

                  var checkfinancement="Oui";
                  var checkrisque="Non";
                  var checkproduct="Non";

                  var checkfinancementicon=yes;
                  var checkrisqueicon=no;
                  var checkproducticon=no;
                  var checkMutuelle="Non";
                  var checkAssuranceDece="Non";
                  var checkHospitalisation="Non";
                  var checkProtection="Non";
                  var checkGarentie="Non";
                  var checkDependance="Non";
                  var checkAutre="Non";
                  var checkAucun="Non";
                  var checkAssuranceVie="Non";
                  var checkProtegerFamille="Non";
                  var checkEtreAssurer="Non";
                  var checkPrevoirFinance="Non";
                  var checkCompleteCap="Non";


                  var checkMutuelleIcon=no_pgo;
                  var checkAssuranceDeceIcon=no_pgo;
                  var checkHospitalisationIcon=no_pgo;
                  var checkProtectionIcon=no_pgo;
                  var checkGarentieIcon=no_pgo;
                  var checkDependanceIcon=no_pgo;
                  var checkAutreIcon=no_pgo;
                  var checkAucunIcon=no_pgo;
                  var checkAssuranceVieIcon=no_pgo;
                  var checkProtegerFamilleIcon=no_pgo;
                  var checkEtreAssurerIcon=no_pgo;
                  var checkPrevoirFinanceIcon=no_pgo;
                  var checkCompleteCapIcon=no_pgo;



                  var checkAssuranceVieSymbol="Non";
                  var checkMutuelleSymbol="Non";
                  var checkAssuranceDeceSymbol="Non";
                  var checkHospitalisationSymbol="Non";
                  var checkProtectionSymbol="Non";
                  var checkGarentieSymbol="Non";
                  var checkDependanceSymbol="Non";
                  var checkproductSymbol="Non";
                  var checkAutreSymbol="Non";
                  var checkAucunSymbol="Non";
                  var checkProtegerFamilleSymbol="Non";
                  var checkEtreAssurerSymbol="Non";
                  var checkPrevoirFinanceSymbol="Non";
                  var checkCompleteCapSymbol="Non";

                  //step 1
                  var fname='';
                  var lname='';
                  var datebirth='';
                  var mobile='';
                  var fixe='';
                  var email='';
                  var confirmeldemail='';
                  var age ='';
                  var nbr_pers_a_charger='';
                  var clientExist=false;
                  var departement_naissance='';
                  var pays_naissance='';
                  var commune_naissance='';
              var nom_naissance='';
 
                  //step 2
                  var add1='';
                  var add2='';
                  var add3='';
                  var fulladresse='';
                  var cp='';
                  var city='';

                  //step 3
                  var mutuelle=0;
                  var assurance_Dece=0;
                  var assurance_vie=0;
                  var hospitalisation=0;
                  var protection =0;
                  var garantie =0;
                  var dependance=0;
                  var autre=0;
                  var aucun=0;
                  var proteger_famille=0;
                  var etre_assurer=0;
                  var prevoir_finace=0;
                  var complete_cap=0;
                  var etre_couvert=0;
                  var montant_de_cotisation=0;
                  var risque=0;
                  var product=0;
                  var comment='';

                  //step 4
                  var random=0;
                  var date ='';
                  var datenow ='';

                  //step 6
                  var iban='';
                  var splitedIban='';
                  var bic='';
                  var api_bic="";

                  //step 7
                  var pdlElec='';
                  var pdlGaz='';
                  var fElec='';
                  var fGaz='';
                  var idfElec='';
                  var idfGaz='';
                  var xvalue=[];

                  //step 8
                  var numvalidation='';
                  var dayid='';

                  //for pdf : 
                  var bgtxt1='';
                  var bgtxt2='';
                  var option1='';
                  var option2='';

                  //contract
                  var id_contract=[];
                  var date = new Date();
                  var sendSMSresponde=[];
                  var dateenvoi="";
                  var minutes=0;
                  var sweet_loader = '<div class="sweet_loader"><svg viewBox="0 0 140 140" width="140" height="140"><g class="outline"><path d="m 70 28 a 1 1 0 0 0 0 84 a 1 1 0 0 0 0 -84" stroke="rgba(0,0,0,0.1)" stroke-width="4" fill="none" stroke-linecap="round" stroke-linejoin="round"></path></g><g class="circle"><path d="m 70 28 a 1 1 0 0 0 0 84 a 1 1 0 0 0 0 -84" stroke="#71BBFF" stroke-width="4" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-dashoffset="200" stroke-dasharray="300"></path></g></svg></div>';
                  var pdl_number=[];

                  $.ajaxSetup({
                     headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     }
                  });
                  $.ajax({
                        url: '/getAllClient', // L'URL de la route que vous avez définie dans Laravel
                        type: 'GET',
                        dataType: 'json',
                        success: function(response) {
                              // La réponse du serveur est stockée dans le paramètre "response"
                              var dataArray = response; // Accède au tableau de données dans la réponse

                        dataArray.forEach(function(item) {
                           data_Client.push(item);
                           
                           
                        });
                        },
                        error: function(xhr, status, error) {
                              console.error(error); // En cas d'erreur, affiche l'erreur dans la console
                        }
                     });
                     console.log(data_Client);


                  //select 2
                  $('.form-select').select2();

                  $("#first, #second, #third, #fourth, #fifth, #sixth").val('');
                  //type contract

                  var typeselected= <?php echo json_encode($choice)?>;
                  var textselected= [];

                  

                  //upper case
                  let form = document.getElementById("form-wizard1");
                  let inputs = form.getElementsByClassName("form-control");
                  for (let i = 0; i < inputs.length; i++) {
                     inputs[i].addEventListener("input", function() {
                        this.value = this.value.toUpperCase();
                     });
                  }

                  var formData=[];
                  formData = formData.concat([
                     {
                        name: "typeselected",
                        value: typeselected
                     }
                  ]);

                  if (typeselected !=105) {
                     $.ajax({
                        type: 'GET',
                        url: '/getdays',
                        data: formData,
                        dataType: 'JSON',
                        success: function(result) {
                           if (result.total > 0) {
                              for (i in result.data) {
                                 $('#days_normal').append("<option value='"+result.data[i].day_id+"'>" + result.data[i].day_id + "</option>");
                              }
                           }
                        }
                     }); 
                  } 
                  
                     


                  <?php foreach ($choice as $value) : ?>
                     type.push(<?php echo $value?>);
                     var typeselected=<?php echo $value?>;

                     if(typeselected==101)
                     {
                        axios.get(`/getfournisseur/${typeselected}`)
                        .then(response => {
                           if (response.data.total > 0) {
                              for (let i in response.data.service_provider) {
                                    const option = document.createElement("option");
                                    option.value = response.data.service_provider[i].id;
                                    option.text = response.data.service_provider[i].name;
                                    document.querySelector('#f-elec').appendChild(option);
                              }
                           }
                        })
                        .catch(error => {
                           console.error(error);
                        });

                        textselected.push('Option Électricité');    
                     }else if(typeselected==102)
                     { 
                        axios.get(`/getfournisseur/${typeselected}`)
                        .then(response => {
                           if (response.data.total > 0) {
                              for (let i in response.data.service_provider) {
                                    const option = document.createElement("option");
                                    option.value = response.data.service_provider[i].id;
                                    option.text = response.data.service_provider[i].name;
                                    document.querySelector('#f-gaz').appendChild(option);
                              }
                           }
                        })
                        .catch(error => {
                           console.error(error);
                        });

                        textselected.push('Option Gaz');
                     }
                     // else if(typeselected==105)
                     // { 
                     //    axios.get(`/getfournisseur/${typeselected}`)
                     //    .then(response => {
                     //       if (response.data.total > 0) {
                     //          for (let i in response.data.service_provider) {
                     //                const option = document.createElement("option");
                     //                option.value = response.data.service_provider[i].id;
                     //                option.text = response.data.service_provider[i].name;
                     //                document.querySelector('#f-gfo').appendChild(option);
                     //          }
                     //       }
                     //    })
                     //    .catch(error => {
                     //       console.error(error);
                     //    });

                     //    textselected.push('Option GFO');
                     // }
                  <?php endforeach; ?>
                  
                  if(type.includes(101) && type.includes(102)){
                     document.getElementById("f-elec").removeAttribute("disabled");
                     document.getElementById("f-gaz").removeAttribute("disabled");
                     $('.maftab').css("display","block");
                     $('.maftab').addClass('cndt');
                     $('.pgetab').css("display","none");
                     $('.gfotab').css("display","none");
                     xvalue.push("E","G");
                     option1="√ Option Électricité";
                     option2="√ Option Gaz";
                  }else if(type.includes(101)){   
                     document.getElementById("f-elec").removeAttribute("disabled");
                     document.getElementById("f-gaz").setAttribute("disabled", "disabled");
                     $('.maftab').css("display","block");
                     $('.maftab').addClass('cndt');
                     $('.pgetab').css("display","none");
                     $('.gfotab').css("display","none");
                     xvalue.push("E");
                     option1="√ Option Électricité";
                     option2="";
                  }else if(type.includes(102)){
                     document.getElementById("f-gaz").removeAttribute("disabled");
                     document.getElementById("f-elec").setAttribute("disabled", "disabled");
                     $('.maftab').css("display","block");
                     $('.maftab').addClass('cndt');
                     $('.pgetab').css("display","none");
                     $('.gfotab').css("display","none");
                     xvalue.push("G");
                     option2="√ Option Gaz";
                     option1="";
                  }else if(type.includes(104)){
                     document.getElementById("f-gaz").setAttribute("disabled", "disabled");
                     document.getElementById("f-elec").setAttribute("disabled", "disabled");
                     xvalue.push("M");
                     $('.pgetab').css("display","block");
                     $('.pgetab').addClass('cndt');
                     $('.maftab').css("display","none");
                     $('.gfotab').css("display","none");
                  }else if(type.includes(105)){
                     // document.getElementById("f-gfo").removeAttribute("disabled");
                     document.getElementById("f-gaz").setAttribute("disabled", "disabled");
                     document.getElementById("f-elec").setAttribute("disabled", "disabled");
                     xvalue.push("O");
                     // $('.gfotab').css("display","block");
                     $('.gfotab').addClass('cndt');
                     $('.pgetab').css("display","none");
                     $('.maftab').css("display","none");

                  }

                  //Validation
                  const validateEmail = (email) => {
                     return email.match(
                        /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
                     );
                  };

                  const validatePhone = (phone) => {
                     return phone.match(
                        /^[0-9]{10}$/
                        // /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/
                     );
                  };

                  const validateEmail2 = (email,email2) => {
                     if(email===email2)
                        return true;

                     return false;
                  };

                  const validateAge = (age) => {
                     var dob = new Date(age);
                     var month_diff = Date.now() - dob.getTime();
                     var age_dt = new Date(month_diff); 
                     var year = age_dt.getUTCFullYear();
                     var age = Math.abs(year - 1970);
               
                     if(age>18 && age<76 )
                     {
                        return true;
                     }
                     else
                     {
                        return false;
                     }
                  };
                  const validateAgeGfo = (age) => {
                     var dob = new Date(age);
                     var month_diff = Date.now() - dob.getTime();
                     var age_dt = new Date(month_diff); 
                     var year = age_dt.getUTCFullYear();
                     var age = Math.abs(year - 1970);
               
                     if(age>44 && age<76 )
                     {
                        return true;
                     }
                     else
                     {
                        return false;
                     }
                  };

                  const dateInput = document.getElementById("datebirth");

                  dateInput.addEventListener("input", (event) => {
                     const inputValue = event.target.value;
                     const dateArr = inputValue.split("-");
                     if (dateArr[0].length > 4) {
                        dateArr[0] = dateArr[0].substring(0, 4);
                        event.target.value = dateArr.join("-");
                     }
                  });


                  //checking type
                  //cp 
                  const cpInput = document.getElementById("cp");
                  cpInput.addEventListener("input", (event) => {
                     let value = event.target.value;
                     if(/\D/.test(value)) {
                        event.target.value = value.replace(/\D/g, "");
                     }
                  });
                  //phone
                  const phoneIt = document.getElementById("mobile");
                  phoneIt.addEventListener("input", (event) => {
                     let value = event.target.value;
                     if(/\D/.test(value)) {
                        event.target.value = value.replace(/\D/g, "");
                     }
                  });
                  //fix
                  const fixeIt = document.getElementById("fixe");
                  fixeIt.addEventListener("input", (event) => {
                     let value = event.target.value;
                     if(/\D/.test(value)) {
                        event.target.value = value.replace(/\D/g, "");
                     }
                  });

                  //pdlElec
                  const pdlIt = document.getElementById("pdlElec");
                  pdlIt.addEventListener("input", (event) => {
                     let value = event.target.value;
                     if(/\D/.test(value)) {
                        event.target.value = value.replace(/\D/g, "");
                     }
                  });

                  //pdlGaz
                  const gazIt = document.getElementById("pdlGaz");
                  gazIt.addEventListener("input", (event) => {
                     let value = event.target.value;
                     if(/\D/.test(value)) {
                        event.target.value = value.replace(/\D/g, "");
                     }
                  });
                  // const gfoIt = document.getElementById("pdlGfo");
                  // gfoIt.addEventListener("input", (event) => {
                  //    let value = event.target.value;
                  //    if(/\D/.test(value)) {
                  //       event.target.value = value.replace(/\D/g, "");
                  //    }
                  // });

                  //Elements show hide
                  $("#lines").hide();
                  $(".div-comment").hide();
                  $('.text-success').hide();

                  $('#confirmcheck').change(function() {
                     var $check = $(this);

                     checkfinancement="";
                     checkfinancementsymbol="";
                     checkfinancementsyicon="";

                     if ($check.prop('checked')) {
                        $("#lines").show();
                        $(".choose1, .choose2, .line-comment, .en-comment").show();
                        checkfinancement="Oui";
                        checkfinancementsymbol="√ Oui";
                        checkfinancementsyicon=yes;
                     } else {
                        $("#lines").hide();
                        $(".choose1, .choose2, .line-comment, .en-comment, .div-comment").hide();
                        checkfinancement="Non";
                        checkfinancementsymbol="Non";
                        checkfinancementsyicon=no;
                     }
                  });

                  $('#risque').change(function() {
                     var $check = $(this);

                     checkrisque="";
                     checkrisquesymbol="";
                     checkrisqueicon="";

                     if ($check.prop('checked')) {
                        risque=1;
                        checkrisque="Oui";
                        checkrisquesymbol="√ Oui";
                        checkrisqueicon=yes;
                     } else {
                        risque=0;
                        checkrisque="Non";
                        checkrisquesymbol="Non";
                        checkrisqueicon=no;

                     }
                  });

                  $('#product').change(function() {
                     var $check = $(this);

                     checkproduct="";
                     checkproductsymbol="";
                     checkproducticon="";

                     if ($check.prop('checked')) {
                        $(".div-comment").show();
                        $("#comment").show();
                        product=1;
                        checkproduct="Oui";
                        checkproductsymbol="√ Oui";
                        checkproducticon=yes;
                     } else {
                        $(".div-comment").hide();
                        $("#comment").hide();
                        product=0;
                        checkproduct="Non";
                        checkproductsymbol="Non";
                        checkproducticon=no;
                     }
                  });
                  $('#mutuelle').change(function() {
                     var $check = $(this);

                     checkMutuelle="";
                     checkMutuelleSymbol="";
                     checkMutuelleIcon="";

                     if ($check.prop('checked')) {
                        mutuelle=1;
                        checkMutuelle="Oui";
                        checkMutuelleSymbol="√ Oui";
                        checkMutuelleIcon=yes_pgo;
                     } else {
                        mutuelle=0;
                        checkMutuelle="Non";
                        checkMutuelleSymbol="Non";
                        checkMutuelleIcon=no_pgo;

                     }
                  });
                  $('#assurance_dece').change(function() {
                     var $check = $(this);

                     checkAssuranceDece="";
                     checkAssuranceDeceSymbol="";
                     checkAssuranceDeceIcon="";

                     if ($check.prop('checked')) {
                        assurance_dece=1;
                        checkAssuranceDece="Oui";
                        checkAssuranceDeceSymbol="√ Oui";
                        checkAssuranceDeceIcon=yes_pgo;
                     } else {
                        assurance_dece=0;
                        checkAssuranceDece="Non";
                        checkAssuranceDeceSymbol="Non";
                        checkAssuranceDeceIcon=no_pgo;

                     }
                  });
                  $('#hospitalisation').change(function() {
                     var $check = $(this);

                     checkHospitalisation="";
                     checkHospitalisationSymbol="";
                     checkHospitalisationIcon="";

                     if ($check.prop('checked')) {
                        hospitalisation=1;
                        checkHospitalisation="Oui";
                        checkHospitalisationSymbol="√ Oui";
                        checkHospitalisationIcon=yes_pgo;
                     } else {
                        hospitalisation=0;
                        checkHospitalisation="Non";
                        checkHospitalisationSymbol="Non";
                        checkHospitalisationIcon=no_pgo;

                     }
                  });
                  $('#protection').change(function() {
                     var $check = $(this);

                     checkProtection="";
                     checkProtectionSymbol="";
                     checkProtectionIcon="";

                     if ($check.prop('checked')) {
                        protection=1;
                        checkProtection="Oui";
                        checkProtectionSymbol="√ Oui";
                        checkProtectionIcon=yes_pgo;
                     } else {
                        protection=0;
                        checkProtection="Non";
                        checkProtectionSymbol="Non";
                        checkProtectionIcon=no_pgo;

                     }
                  });
                  $('#garantie').change(function() {
                     var $check = $(this);

                     checkGarentie="";
                     checkGarentieSymbol="";
                     checkGarentieIcon="";

                     if ($check.prop('checked')) {
                        garantie=1;
                        checkGarentie="Oui";
                        checkGarentieSymbol="√ Oui";
                        checkGarentieIcon=yes_pgo;
                     } else {
                        garantie=0;
                        checkGarentie="Non";
                        checkGarentieSymbol="Non";
                        checkGarentieIcon=no_pgo;

                     }
                  });
                  $('#dependance').change(function() {
                     var $check = $(this);

                     checkDependance="";
                     checkDependanceSymbol="";
                     checkDependanceIcon="";

                     if ($check.prop('checked')) {
                        dependance=1;
                        checkDependance="Oui";
                        checkDependanceSymbol="√ Oui";
                        checkDependanceIcon=yes_pgo;
                     } else {
                        dependance=0;
                        checkDependance="Non";
                        checkDependanceSymbol="Non";
                        checkDependanceIcon=no_pgo;

                     }
                  });
               
                  $('#assurance_vie').change(function() {
                     var $check = $(this);

                     checkAssuranceVie="";
                     checkAssuranceVieSymbol="";
                     checkAssuranceVieIcon="";

                     if ($check.prop('checked')) {
                        assurance_vie=1;
                        checkAssuranceVie="Oui";
                        checkAssuranceVieSymbol="√ Oui";
                        checkAssuranceVieIcon=yes_pgo;
                     } else {
                        assurance_vie=0;
                        checkAssuranceVie="Non";
                        checkAssuranceVieSymbol="Non";
                        checkAssuranceVieIcon=no_pgo;

                     }
                  });
                  $('#autre').change(function() {
                     var $check = $(this);

                     checkAutre="";
                     checkAutreSymbol="";
                     checkAutreIcon="";

                     if ($check.prop('checked')) {
                        autre=1;
                        checkAutre="Oui";
                        checkAutreSymbol="√ Oui";
                        checkAutreIcon=yes_pgo;
                     } else {
                        autre=0;
                        checkAutre="Non";
                        checkAutreSymbol="Non";
                        checkAutreIcon=no_pgo;

                     }
                  });
                  $('#aucun').change(function() {
                     var $check = $(this);

                     checkAucun="";
                     checkAucunSymbol="";
                     checkAucunIcon="";

                     if ($check.prop('checked')) {
                        aucun=1;
                        checkAucun="Oui";
                        checkAucunSymbol="√ Oui";
                        checkAucunIcon=yes_pgo;
                     } else {
                        aucun=0;
                        checkAucun="Non";
                        checkAucunSymbol="Non";
                        checkAucunIcon=no_pgo;

                     }
                  });
                  

                  
                  $('#proteger').change(function() {
                     var $check = $(this);

                     checkProtegerFamille="";
                     checkProtegerFamilleSymbol="";
                     checkProtegerFamilleIcon="";

                     if ($check.prop('checked')) {
                        proteger_famille=1;
                        checkProtegerFamille="Oui";
                        checkProtegerFamilleSymbol="√ Oui";
                        checkProtegerFamilleIcon=yes_pgo;
                     } else {
                        proteger_famille=0;
                        checkProtegerFamille="Non";
                        checkProtegerFamilleSymbol="Non";
                        checkProtegerFamilleIcon=no_pgo;

                     }
                  });
                  $('#assure_dece').change(function() {
                     var $check = $(this);

                     checkEtreAssurer="";
                     checkEtreAssurerSymbol="";
                     checkEtreAssurerIcon="";

                     if ($check.prop('checked')) {
                        etre_assurer=1;
                        checkEtreAssurer="Oui";
                        checkEtreAssurerSymbol="√ Oui";
                        checkEtreAssurerIcon=yes_pgo;
                     } else {
                        etre_assurer=0;
                        checkEtreAssurer="Non";
                        checkEtreAssurerSymbol="Non";
                        checkEtreAssurerIcon=no_pgo;

                     }
                  });
                  $('#finance_org').change(function() {
                     var $check = $(this);

                     checkPrevoirFinance="";
                     checkPrevoirFinanceSymbol="";
                     checkPrevoirFinanceIcon="";

                     if ($check.prop('checked')) {
                        prevoir_finace=1;
                        checkPrevoirFinance="Oui";
                        checkPrevoirFinanceSymbol="√ Oui";
                        checkPrevoirFinanceIcon=yes_pgo;
                     } else {
                        prevoir_finace=0;
                        checkPrevoirFinance="Non";
                        checkPrevoirFinanceSymbol="Non";
                        checkPrevoirFinanceIcon=no_pgo;

                     }
                  });
                  $('#capital').change(function() {
                     var $check = $(this);

                     checkCompleteCap="";
                     checkCompleteCapSymbol="";
                     checkCompleteCapIcon="";

                     if ($check.prop('checked')) {
                        prevoir_finace=1;
                        checkCompleteCap="Oui";
                        checkCompleteCapSymbol="√ Oui";
                        checkCompleteCapIcon=yes_pgo;
                     } else {
                        prevoir_finace=0;
                        checkCompleteCap="Non";
                        checkCompleteCapSymbol="Non";
                        checkCompleteCapIcon=no_pgo;


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

                  //checking viewd pdf
                  let click =false;
                  var uname= <?php echo json_encode(auth()->user()->username)?>;
                  var uid= <?php echo json_encode(auth()->user()->id)?>;

                  $(document).on("click", "a.showpdf", function() {
                        click=true;
                        window.open('/getDocumentNoCode/user='+uname+'-'+uid, '_blank', 'location=yes,height=600,width=900,top=400,left=400,scrollbars=yes,status=yes');
                  });
                  var roles =[];
                  $.ajax({ // get Role 
                     url: '/getRole/'+uid,
                     method: 'GET',
                     success: function(response) {
                        for (let index = 0; index < response.length; index++) {
                           const role = response[index];
                           roles.push(role);
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
            
                  
                  //resend sms
                  let link = document.getElementById("resendcode");

                  link.addEventListener("click", (event) => {
                     event.preventDefault();

                     //generate random
                     random = Math.floor(100000 + Math.random() * 900000);
                     console.log(random);
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
                        type: 'POST',
                        url: '/sendSMS',
                        data: formData,
                        dataType: 'JSON',
                        success: function(result) {
                           sendSMSresponde=[];
                           sendSMSresponde.push({'success' : result, 'dateEnvoi' : datenow1,'code' :random});
                        }
                     }); 

                     //PDF API 
                     var formData0 = [];

                     formData0 = formData0.concat([
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
                           value: datebirth
                        },
                        {
                           name: "adresse",
                           value: fulladresse
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
                           name: "typeselected",
                           value: <?php echo json_encode($choice)?>
                        },
                        {
                           name: "textselected",
                           value: textselected
                        },
                        {
                           name: "comment",
                           value: comment
                        }
                     ]);

                     $.ajax({
                        type: 'GET',
                        url: '/createPdfFile',
                        data: formData0,
                        dataType: 'JSON',
                        success: function(result) {
                           if(result.success){
                              Swal.close();

                              // Get the current fieldset
                              var currentFieldset = $("#beforepdf");

                              // Get the next fieldset
                              var nextFieldset = $("#afterpdf");

                              $("#progressbar li").eq($("fieldset").index(nextFieldset)).addClass("active");

                              //show the next fieldset
                              nextFieldset.show(); 
                              //hide the current fieldset with style
                              currentFieldset.animate({opacity: 0}, {
                                    step: function(now) {
                                       // for making fielset appear animation
                                       opacity = 1 - now;

                                       currentFieldset.css({
                                          'display': 'none',
                                          'position': 'relative'
                                       });
                                       nextFieldset.css({'opacity': opacity});

                                    }, 
                                    duration: 500
                              });
                              setProgressBar(++current);
                           }
                        }
                     });

                     var m = new Date();
                     var dateString = m.getUTCFullYear() + "/" + ("0" + (m.getUTCMonth()+1)).slice(-2) + "/" + ("0" + m.getUTCDate()).slice(-2) + " " + ("0" + m.getUTCHours()).slice(-2) + ":" + ("0" + m.getUTCMinutes()).slice(-2) + ":" + ("0" + m.getUTCSeconds()).slice(-2);
                     var date1=sendSMSresponde[0].dateEnvoi;

                     var diff = Math.abs(new Date(dateString) - new Date(date1));
                     minutes = Math.floor((diff/1000)/60);
                  
                  });


                  //contract_number
                  var dt = new Date();
                  var year=dt.getFullYear();
                  var month=String(dt.getMonth() + 1).padStart(2, '0');
                  var nuum=Math.floor(1000 + Math.random() * 9000);
                  var fullvalue=[];

                  xvalue.forEach(element => {
                     fullvalue.push('D/'+year+'/'+month+'/'+element+'/'+nuum);
                  });

                  //  Progress Bar
                  var current_fs, next_fs, previous_fs; //fieldsets
                  var opacity;
                  var current = 1;
                  var steps = $("fieldset").length;

                  setProgressBar(current);
                  
               


                  if (typeselected==105) {
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
                           nbr_pers_a_charger=0;
                        }
                     });
                  } 
                  const dateOfBirthInput = document.getElementById('datebirth');

                  const ageInput = document.getElementById('age');
                  dateOfBirthInput.addEventListener('change', function() {
                     datebirth=$("#datebirth").val();

                     const dateNaissance = new Date(datebirth);
                     const dateActuelle = new Date();

                     const ageInMilliseconds = dateActuelle - dateNaissance;
                     const ageInYears = Math.floor(ageInMilliseconds / 31536000000); // 1 an = 31536000000 millisecondes
                     const ageInMonths = Math.floor((ageInMilliseconds % 31536000000) / 2628000000); // 1 mois = 2628000000 millisecondes
                     const ageInDays = Math.floor((ageInMilliseconds % 2628000000) / 86400000); // 1 jour = 86400000 millisecondes

                     // Mettez à jour la valeur du champ d'âge
                     ageInput.value = ageInYears + " ans, " + ageInMonths + " mois, " + ageInDays + " jours";
               });
               $("#nxt1").click(function(){  
                  //step 1
                  if (typeselected != 105) {
                     gender=document.querySelector('input[name="civilite"]:checked').value;
                     civility=document.getElementById("civilite").checked;
                     fname=$("#fname").val();
                     lname=$("#lname").val();
                     datebirth=$("#datebirth").val();
                     mobile=$("#mobile").val();
                     fixe=$("#fixe").val();
                     email=$("#email").val();
                     confirmedemail=$("#confirmedemail").val();
                     if(!gender || !fname || !lname || !datebirth || !mobile || !email || !confirmedemail){
                     
                        Swal.fire({
                           title: 'Error!',
                           text: "Merci de saisir les champs obligatoires",
                           icon: 'error',
                           confirmButtonText: 'Ok'
                        });
                     }else{
                        if (!validateEmail(email)) {
                           Swal.fire({
                              title: 'Error!',
                              text: "Invalid Email",
                              icon: 'error',
                              confirmButtonText: 'Ok'
                           });
                        }else if(!validatePhone(mobile)){
                           Swal.fire({
                              title: 'Error!',
                              text: "Le numéro de mobile ne doit comporter que 10 chiffres",
                              icon: 'error',
                              confirmButtonText: 'Ok'
                           });
                        }else if(!validateAge(datebirth)){
                           Swal.fire({
                              title: 'Error!',
                              text: "Invalid age",
                              icon: 'error',
                              confirmButtonText: 'Ok'
                           });
                        }else if(!validateEmail2(email,confirmedemail)){
                           Swal.fire({
                              title: 'Error!',
                              text: "Merci d'utiliser la même adresse mail",
                              icon: 'error',
                              confirmButtonText: 'Ok'
                           });
                        }else{ 
                           if(fixe.length !== 0 && fixe.length !== 10 ){
                              Swal.fire({
                                 title: 'Error!',
                                 text: "Le numéro de fix ne doit comporter que 10 chiffres",
                                 icon: 'error',
                                 confirmButtonText: 'Ok'
                              });
                           }else{
                              axios.post('/infoCheck', {
                                 mail: email,
                                 phone: mobile,
                                 first_name:fname,
                                 last_name:lname,
                                 company_id: <?php echo json_encode($choice)?>,
                                 id_contract: id_contract
                              }).then((response) => {
                                 console.log(response)
                                 if(response.data.success){
                                    Swal.fire({
                                       title: 'Error!',
                                       text: response.data.msg,
                                       icon: 'error',
                                       confirmButtonText: 'Ok'
                                    });
                                 }else{
                                    //define value for step 2
                                    $(".step1fname").text(fname);
                                    $(".step1lname").text(lname);

                                    //progress
                                    current_fs = $(this).parent();
                                    next_fs = $(this).parent().next();
                                    
                                    //Add Class Active
                                    $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
                                    
                                    //show the next fieldset
                                    next_fs.show(); 
                                    //hide the current fieldset with style
                                    current_fs.animate({opacity: 0}, {
                                          step: function(now) {
                                             // for making fielset appear animation
                                             opacity = 1 - now;
                                 
                                             current_fs.css({
                                                'display': 'none',
                                                'position': 'relative'
                                             });
                                             next_fs.css({'opacity': opacity});
                                          }, 
                                          duration: 500
                                    });
                                    setProgressBar(++current);
                                 }
                              });
                           }  
                        }
                     }
                  } else if(typeselected==105) {
                     gender=document.querySelector('input[name="civilite"]:checked').value;
                     statu_famille=document.querySelector('input[name="statu_famille"]:checked').value;
                     avec_enfant=document.querySelector('input[name="enfant"]:checked').value;
                     situation_pro=document.querySelector('input[name="situation_pro"]:checked').value;
                     civility=document.getElementById("civilite").checked;
                     console.log(gender);

                     nbr_pers_a_charger=$("#nbr_per").val();
                     fname=$("#fname").val();
                     lname=$("#lname").val();
                     datebirth=$("#datebirth").val();
                     mobile=$("#mobile").val();
                     fixe=$("#fixe").val();
                     email=$("#email").val();
                     confirmedemail=$("#confirmedemail").val();
                     departement_naissance=$("#departement_naissance").val();
                     pays_naissance=$("#pays_naissance").val();
                     commune_naissance=$("#commune_naissance").val();
                nom_naissance=$("#nom_naissance").val();

                     data_Client.forEach(function(item) {
                        // console.log(item);
                           if (fname.toLowerCase() ==item.first_name.toLowerCase() && lname.toLowerCase()==item.last_name.toLowerCase()) {
                              clientExist=true;
                           }                  
                           
                        });
                        // console.log(fname.toLowerCase());
                     if (clientExist==true) {
                        Swal.fire({
                           title: 'Error!',
                           text: "Client déja existe | Cliquez sur rénitiliser pour rénitiliser les données ",
                           icon: 'error',
                           // showCancelButton: true,
                           confirmButtonText: 'Rénitialiser',
                           // cancelButtonText: 'Annuler'
                        }).then((result) => {
                           console.log(result.value);
                           if (result.value==true) {
                                 // Recharge la page
                                 location.reload();
                           }
                        });
                     }else if (clientExist==false) {
                        const dateNaissance = new Date(datebirth);
                        const dateActuelle = new Date();

                        // Calcul de l'âge
                        const differenceAnnees = dateActuelle.getFullYear() - dateNaissance.getFullYear();
                        const moisActuels = dateActuelle.getMonth();
                        const moisNaissance = dateNaissance.getMonth();

                        // Vérification si l'anniversaire de cette année n'est pas encore arrivé
                        if (moisActuels < moisNaissance || (moisActuels === moisNaissance && dateActuelle.getDate() < dateNaissance.getDate())) {
                           age = differenceAnnees - 1;
                        } else {
                           age = differenceAnnees;
                        }

                        //sessionStorage.setItem('firstname', fname);
                        //sessionStorage.setItem('lastname', lname);              
                        //sessionStorage.setItem('datebirth', datebirth);
                        //sessionStorage.setItem('mobile', mobile);
                        //sessionStorage.setItem('fixe', fixe);
                        //sessionStorage.setItem('email', email);
                        //sessionStorage.setItem('confirmedemail', confirmedemail);
                        //sessionStorage.setItem('nbr_pers_a_charger', nbr_pers_a_charger);    
                        if(!fname || !lname || !datebirth || !mobile || !email || !confirmedemail || !statu_famille ){
                           Swal.fire({
                              title: 'Error!',
                              text: "Merci de saisir les champs obligatoires",
                              icon: 'error',
                              confirmButtonText: 'Ok'
                           });
                        }else if(!departement_naissance){
                           Swal.fire({
                              title: 'Error!',
                              text: "Merci de saisir département de naissance",
                              icon: 'error',
                              confirmButtonText: 'Ok'
                           });

                        }else if(!pays_naissance){
                           Swal.fire({
                              title: 'Error!',
                              text: "Merci de saisir pays de naissance",
                              icon: 'error',
                              confirmButtonText: 'Ok'
                           });

                        }else if (!commune_naissance) {
                           Swal.fire({
                              title: 'Error!',
                              text: "Merci de saisir commune de naissance",
                              icon: 'error',
                              confirmButtonText: 'Ok'
                           });
                           
                        }else if (!nom_naissance) {
                           Swal.fire({
                              title: 'Error!',
                              text: "Merci de saisir nom de naissance",
                              icon: 'error',
                              confirmButtonText: 'Ok'
                           });
                        }else{
                           if (!validateEmail(email)) {
                              Swal.fire({
                                 title: 'Error!',
                                 text: "Invalid Email",
                                 icon: 'error',
                                 confirmButtonText: 'Ok'
                              });
                           }else if(!validatePhone(mobile)){
                              Swal.fire({
                                 title: 'Error!',
                                 text: "Le numéro de mobile ne doit comporter que 10 chiffres",
                                 icon: 'error',
                                 confirmButtonText: 'Ok'
                              });
                           }else if(!validateAgeGfo(datebirth)){
                              Swal.fire({
                                 title: 'Error!',
                                 text: "Age doit être entre 45 ans et 75 ans",
                                 icon: 'error',
                                 confirmButtonText: 'Ok'
                              });
                           }else if(!validateEmail2(email,confirmedemail)){
                              Swal.fire({
                                 title: 'Error!',
                                 text: "Merci d'utiliser la même adresse mail",
                                 icon: 'error',
                                 confirmButtonText: 'Ok'
                              });
                           }else{ 
                              if(fixe.length !== 0 && fixe.length !== 10 ){
                                 Swal.fire({
                                    title: 'Error!',
                                    text: "Le numéro de fix ne doit comporter que 10 chiffres",
                                    icon: 'error',
                                    confirmButtonText: 'Ok'
                                 });
                              }else{
                                 axios.post('/infoCheck', {
                                    mail: email,
                                    phone: mobile,
                                    first_name:fname,
                                    last_name:lname,
                                    company_id: <?php echo json_encode($choice)?>,
                                    id_contract: id_contract
                                 }).then((response) => {
                                    // console.log(response)
                                    if(response.data.success){
                                       Swal.fire({
                                          title: 'Error!',
                                          text: response.data.msg,
                                          icon: 'error',
                                          confirmButtonText: 'Ok'
                                       });
                                    }else{
                                       //define value for step 2
                                       $(".step1fname").text(fname);
                                       $(".step1lname").text(lname);

                                       //progress
                                       current_fs = $(this).parent();
                                       next_fs = $(this).parent().next();
                                       
                                       //Add Class Active
                                       $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
                                       
                                       //show the next fieldset
                                       next_fs.show(); 
                                       //hide the current fieldset with style
                                       current_fs.animate({opacity: 0}, {
                                             step: function(now) {
                                                // for making fielset appear animation
                                                opacity = 1 - now;
                                    
                                                current_fs.css({
                                                   'display': 'none',
                                                   'position': 'relative'
                                                });
                                                next_fs.css({'opacity': opacity});
                                             }, 
                                             duration: 500
                                       });
                                       setProgressBar(++current);
                                    }
                                 });
                              }  
                           }
                        }
                     }
                  }
               });
               
               $("#nxt2").click(function(){       
                  //step 2
                  add1=$("#add1").val();
                  add2=$("#add2").val();
                  add3=$("#add3").val();
                  cp=$("#cp").val();
                  city=$("#citys option:selected").val();
                  //sessionStorage.setItem('adresse1', add1);
                  //sessionStorage.setItem('adresse2', add2);              
                  //sessionStorage.setItem('adresse3', add3);
                  //sessionStorage.setItem('code_postal', cp);
                 // sessionStorage.setItem('city', city);
                  
                  if(!add1 || !cp || !city ){
                     Swal.fire({
                        title: 'Error!',
                        text: "Merci de saisir les champs obligatoires",
                        icon: 'error',
                        confirmButtonText: 'Ok'
                     });
                  }else{
                     if (cp.toString().length == 5 || cp.toString().length == 4) {
                        $(".step1fname").text(fname);
                        $(".step1lname").text(lname);

                        current_fs = $(this).parent();
                        next_fs = $(this).parent().next();
                        
                        //Add Class Active
                        $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
                        
                        //show the next fieldset
                        next_fs.show(); 
                        //hide the current fieldset with style
                        current_fs.animate({opacity: 0}, {
                              step: function(now) {
                                 // for making fielset appear animation
                                 opacity = 1 - now;
                     
                                 current_fs.css({
                                    'display': 'none',
                                    'position': 'relative'
                                 });
                                 next_fs.css({'opacity': opacity});
                              }, 
                              duration: 500
                        });
                        setProgressBar(++current);
                     } else {
                        Swal.fire({
                           title: 'Error!',
                           text: "Le code postal ne doit pas dépasser 5 chiffres",
                           icon: 'error',
                           confirmButtonText: 'Ok'
                        });
                     }
                  }

               });
               $('#etre_couvert').on('change', function() {
                  var montantCapitalField = $('#etre_couvert').val();
                  switch (montantCapitalField) {
                     case '4000':
                        switch (true) {
                              case age >= 45 && age <= 59:
                                 montantCapitalField = 15.91;
                                 break;
                              case age >= 60 && age <= 64:
                                 montantCapitalField = 23.09;
                                 break;
                              case age >= 65 && age <= 69:
                                 montantCapitalField = 29.32;
                                 break;
                              case age >= 70 && age <= 74:
                                 montantCapitalField = 38.28;
                                 break;
                        }
                        break;
                     case '5000':
                        switch (true) {
                              case age >= 45 && age <= 59:
                                 montantCapitalField = 19.89;
                                 break;
                              case age >= 60 && age <= 64:
                                 montantCapitalField = 28.86;
                                 break;
                              case age >= 65 && age <= 69:
                                 montantCapitalField = 36.65;
                                 break;
                              case age >= 70 && age <= 74:
                                 montantCapitalField = 47.85;
                                 break;
                        }
                        break;
                  }
                  $('#montant_de_cotisation').val(montantCapitalField);
               });

               $("#nxt3").click(function(){
                  //step 3
                  comment=$("#comment").val();
                  fulladresse=add1+" "+add2+" "+add3;

                  $(".step1fname").text(fname);
                  $(".step1lname").text(lname);
                  $(".mobile").text(mobile);
                  $(".email").text(email);
                  $(".fulladress").text(fulladresse);
                  $(".cp").text(cp);
                  $(".city").text(city);
                  $(".comment").text(comment);  
                  etre_couvert=$( "#etre_couvert option:selected" ).val();
                  montant_de_cotisation=$("#montant_de_cotisation").val();
                  // console.log(montant_de_cotisation);


                  if ($('#product').is(':checked')) {
                     $(".en-comment").show();
                  }else{
                     $(".en-comment").hide();
                  }
                  
                  
                  switch(typeselected) {
                        case 105:
                           if(!document.getElementById('mutuelle').checked && !document.getElementById('assurance_dece').checked && !document.getElementById('hospitalisation').checked && !document.getElementById('protection').checked && !document.getElementById('garantie').checked && !document.getElementById('dependance').checked   && !document.getElementById('assurance_vie').checked && !document.getElementById('assurance_vie').checked && !document.getElementById('autre').checked && !document.getElementById('aucun').checked) 
                           {
                                 Swal.fire({
                                    title: 'Error!',
                                    text: "Merci de Sélectionner minimum un pour les produits d'assurance",
                                    icon: 'error',
                                    confirmButtonText: 'Ok'
                                 });
                              } else if(!document.getElementById('proteger').checked && !document.getElementById('assure_dece').checked && !document.getElementById('finance_org').checked && !document.getElementById('capital').checked ) 
                              {
                                 Swal.fire({
                                    title: 'Error!',
                                    text: "Merci de Sélectionner minimum un pour ces produits notifiés",
                                    icon: 'error',
                                    confirmButtonText: 'Ok'
                                 });
                              }
                              else{
                                 Swal.fire({
                                    html: '<h4>En cours...</h4>',
                                    // timer: 2000,
                                    timerProgressBar: true,
                                    onBeforeOpen: () => {
                                          Swal.showLoading()
                                    }
                                 })
                                 var formData0 = [];
                                 formData0 = formData0.concat([
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
                                       value: fulladresse
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
                                       name: "typeselected",
                                       value: <?php echo json_encode($choice)?>
                                    },
                                    {
                                       name: "textselected",
                                       value: textselected
                                    }
                                 ]);
                                 $.ajax({
                                    type: 'GET',
                                    url: '/createPdfFileNoCode',
                                    data: formData0,
                                    dataType: 'JSON',
                                    success: function(result) {
                                       if(result.success){
                                          Swal.close();

                                          // Get the current fieldset
                                          var currentFieldset = $("#beforepdf");

                                          // Get the next fieldset
                                          var nextFieldset = $("#afterpdf");

                                          $("#progressbar li").eq($("fieldset").index(nextFieldset)).addClass("active");

                                          //show the next fieldset
                                          nextFieldset.show(); 
                                          //hide the current fieldset with style
                                          currentFieldset.animate({opacity: 0}, {
                                                step: function(now) {
                                                   // for making fielset appear animation
                                                   opacity = 1 - now;

                                                   currentFieldset.css({
                                                      'display': 'none',
                                                      'position': 'relative'
                                                   });
                                                   nextFieldset.css({'opacity': opacity});

                                                }, 
                                                duration: 500
                                          });
                                          setProgressBar(++current);
                                       }
                                    }
                                 });
                              }
                                 


                        
                           break;
                        
                        default:
                              if(!document.getElementById('confirmcheck').checked){
                                 Swal.fire({
                                    title: 'Error!',
                                    text: "Merci de cliquer sur la checkbox en bas",
                                    icon: 'error',
                                    confirmButtonText: 'Ok'
                                 });
                              }
                              else if((document.getElementById('risque').checked && !document.getElementById('product').checked) || (document.getElementById('product').checked && !document.getElementById('risque').checked)){
                                 Swal.fire({
                                    title: 'Error!',
                                    text: "Merci de Sélectionner les deux choix en même temps",
                                    icon: 'error',
                                    confirmButtonText: 'Ok'
                                 });
                              }
                              else{     
                                 if(risque){
                                    $(".choose2").show();
                                 }else{
                                    $(".choose2").hide();
                                 }

                                 if(product){
                                    $(".choose1").show();
                                 }else{
                                    $(".choose1").hide();
                                 }

                                 Swal.fire({
                                    html: '<h4>En cours...</h4>',
                                    // timer: 2000,
                                    timerProgressBar: true,
                                    onBeforeOpen: () => {
                                          Swal.showLoading()
                                    }
                                 })

                                 var formData0 = [];

                                 formData0 = formData0.concat([
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
                                       value: datebirth
                                    },
                                    {
                                       name: "adresse",
                                       value: fulladresse
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
                                       name: "typeselected",
                                       value: <?php echo json_encode($choice)?>
                                    },
                                    {
                                       name: "textselected",
                                       value: textselected
                                    },
                                    {
                                       name: "comment",
                                       value: comment
                                    }
                                 ]);

                                 $.ajax({
                                    type: 'GET',
                                    url: '/createPdfFileNoCode',
                                    data: formData0,
                                    dataType: 'JSON',
                                    success: function(result) {
                                       if(result.success){
                                          Swal.close();

                                          // Get the current fieldset
                                          var currentFieldset = $("#beforepdf");

                                          // Get the next fieldset
                                          var nextFieldset = $("#afterpdf");

                                          $("#progressbar li").eq($("fieldset").index(nextFieldset)).addClass("active");

                                          //show the next fieldset
                                          nextFieldset.show(); 
                                          //hide the current fieldset with style
                                          currentFieldset.animate({opacity: 0}, {
                                                step: function(now) {
                                                   // for making fielset appear animation
                                                   opacity = 1 - now;

                                                   currentFieldset.css({
                                                      'display': 'none',
                                                      'position': 'relative'
                                                   });
                                                   nextFieldset.css({'opacity': opacity});

                                                }, 
                                                duration: 500
                                          });
                                          setProgressBar(++current);
                                       }
                                    }
                                 });

                              }
                  }

                  
               });

               $("#nxt4").click(function(){
                  // console.log(roles);

                  if(click){
                     //SMS API//radhhha
                     var formData = [];

                     // //generate random
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
                        }
                     ]);

                     // // call API
                     $.ajax({
                        type: 'POST',
                        url: '/sendSMS',
                        data: formData,
                        dataType: 'JSON',
                        success: function(result) {
                           sendSMSresponde=[];
                           sendSMSresponde.push({'success' : result, 'dateEnvoi' : datenow1,'code' :random});
                           console.log(sendSMSresponde);
                        }
                     }); 
                     switch(typeselected) {
                        case 105:
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
                                       name: "montant_de_cotisation",
                                       value: montant_de_cotisation
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
                                       value: datebirth
                                    },
                                    {
                                       name: "age",
                                       value: age
                                    },
                                    {
                                       name: "adresse",
                                       value: fulladresse
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
                                       name: "typeselected",
                                       value: <?php echo json_encode($choice)?>
                                    },
                                    {
                                       name: "textselected",
                                       value: textselected
                                    }
                                 ]);
                                 $.ajax({
                                    type: 'GET',
                                    url: '/createPdfFile',
                                    data: formData_gfo,
                                    dataType: 'JSON',
                                    success: function(result) {
                                    }
                                 });
                                 // sessionStorage.clear();

                                 //step 4
                                 current_fs = $(this).parent();
                                 next_fs = $(this).parent().next();

                                 $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

                                 //show the next fieldset
                                 next_fs.show(); 
                                 //hide the current fieldset with style
                                 current_fs.animate({opacity: 0}, {
                                    step: function(now) {
                                       // for making fielset appear animation
                                       opacity = 1 - now;

                                       current_fs.css({
                                          'display': 'none',
                                          'position': 'relative'
                                       });
                                       next_fs.css({'opacity': opacity});

                                    }, 
                                    duration: 500
                                 });
                                 setProgressBar(++current);


                        
                           break;
                        
                        default:
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
                                 value: datebirth
                              },
                              {
                                 name: "adresse",
                                 value: fulladresse
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
                                 name: "typeselected",
                                 value: <?php echo json_encode($choice)?>
                              },
                              {
                                 name: "textselected",
                                 value: textselected
                              }
                           ]);
                           //call API
                           $.ajax({
                              type: 'GET',
                              url: '/createPdfFile',
                              data: formData_for_normal,
                              dataType: 'JSON',
                              success: function(result) {
                              }
                           });  
                              // sessionStorage.clear();

                              //step 4
                           current_fs = $(this).parent();
                           next_fs = $(this).parent().next();

                           $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

                           //show the next fieldset
                           next_fs.show(); 
                           //hide the current fieldset with style
                           current_fs.animate({opacity: 0}, {
                                 step: function(now) {
                                    // for making fielset appear animation
                                    opacity = 1 - now;

                                    current_fs.css({
                                       'display': 'none',
                                       'position': 'relative'
                                    });
                                    next_fs.css({'opacity': opacity});

                                 }, 
                                 duration: 500
                           });
                           setProgressBar(++current);
                                                      

                           
                     }


                  
               
                  }else{
                     Swal.fire({
                        title: 'Error!',
                        text: "Merci de voir le pdf avant de confirmer les données",
                        icon: 'error',
                        confirmButtonText: 'Ok'
                     });
                  }
               });

               $("#nxt5").click(function(){
                  var codeCreated = $("#first, #second, #third, #fourth, #fifth, #sixth").map(function(){
                     return this.value;
                  }).get().join("");

                  var codeGenerated = random;

                  var sendstatus= sendSMSresponde[0].success;

                  if (sendstatus!= undefined){//radhhha
                     if(sendstatus==1){//radhhha

                           var m = new Date();
                           var dateString = m.getUTCFullYear() + "/" + ("0" + (m.getUTCMonth()+1)).slice(-2) + "/" + ("0" + m.getUTCDate()).slice(-2) + " " + ("0" + m.getUTCHours()).slice(-2) + ":" + ("0" + m.getUTCMinutes()).slice(-2) + ":" + ("0" + m.getUTCSeconds()).slice(-2);

                           var date1=sendSMSresponde[0].dateEnvoi;//radhhha

                           var diff = Math.abs(new Date(dateString) - new Date(date1));//radhhha
                           minutes = Math.floor((diff/1000)/60);//radhhha

                        if(minutes<=5){//radhhha
                           if(codeGenerated==codeCreated){//radhhha
                           //step 5 (SMS)
                        
                           var formData1=[];

                           switch (typeselected) {
                              case 105:
                                 formData1 = formData1.concat([
                                       {
                                          name: "gender",
                                          value: gender
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
                                          name: "contract_number",
                                          value: fullvalue
                                       },
                                       {
                                          name: "company_id",
                                          value: <?php echo json_encode($choice)?>
                                       },       
                                       {
                                          name: "status",
                                          value: 2
                                       },
                                       {
                                          name: "step",
                                          value: 2
                                       },
                                       {
                                          name: "landline_phone",
                                          value: fixe
                                       },
                                       {
                                          name: "mobile_phone",
                                          value: mobile
                                       },
                                       {
                                          name: "type_of_building",
                                          value: 2
                                       },
                                       {
                                          name: "address",
                                          value: fulladresse
                                       },
                                       {
                                          name: "postal_code",
                                          value: cp
                                       },
                                       {
                                          name: "city_name",
                                          value: city
                                       },
                                       {
                                          name: "city_id",
                                          value: ''
                                       },
                                       {
                                          name: "sage_number",
                                          value: ''
                                       },
                                       {
                                          name: "status_updated_at",
                                          value: ''
                                       },
                                       {
                                          name: "excel_row",
                                          value: ''
                                       },
                                       {
                                          name: "created_by",
                                          value: 1
                                       },
                                       {
                                          name: "updated_by",
                                          value: 1
                                       },
                                       {
                                          name: "signed",
                                          value: 0
                                       },
                                       {
                                          name: "is_saved",
                                          value: 0
                                       },
                                       
                                       {
                                          name: "signed_date",
                                          value: ''
                                       },
                                       {
                                          name: "email",
                                          value: email
                                       },
                                       {
                                          name: "group",
                                          value: ''
                                       },
                                       {
                                          name: "data",
                                          value: ''
                                       },
                                       {
                                          name: "datebirth",
                                          value: datebirth
                                       },
                                       {
                                          name: "state",
                                          value: "SMS envoyé"
                                       },
                                       {
                                          name: "departement_naissance",
                                          value: departement_naissance
                                       },
                                       {
                                          name: "pays_naissance",
                                          value: pays_naissance
                                       },
                                       {
                                          name: "commune_naissance",
                                          value: commune_naissance
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
                                          name: "nom_naissance",
                                          value: nom_naissance
                                       } 
                                 ]);
                                 
                                 break;
                           
                              default:
                                 formData1 = formData1.concat([
                                       {
                                          name: "gender",
                                          value: gender
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
                                          name: "contract_number",
                                          value: fullvalue
                                       },
                                       {
                                          name: "company_id",
                                          value: <?php echo json_encode($choice)?>
                                       },       
                                       {
                                          name: "status",
                                          value: 2
                                       },
                                       {
                                          name: "step",
                                          value: 2
                                       },
                                       {
                                          name: "landline_phone",
                                          value: fixe
                                       },
                                       {
                                          name: "mobile_phone",
                                          value: mobile
                                       },
                                       {
                                          name: "type_of_building",
                                          value: 2
                                       },
                                       {
                                          name: "address",
                                          value: fulladresse
                                       },
                                       {
                                          name: "postal_code",
                                          value: cp
                                       },
                                       {
                                          name: "city_name",
                                          value: city
                                       },
                                       {
                                          name: "city_id",
                                          value: ''
                                       },
                                       {
                                          name: "sage_number",
                                          value: ''
                                       },
                                       {
                                          name: "status_updated_at",
                                          value: ''
                                       },
                                       {
                                          name: "excel_row",
                                          value: ''
                                       },
                                       {
                                          name: "created_by",
                                          value: 1
                                       },
                                       {
                                          name: "updated_by",
                                          value: 1
                                       },
                                       {
                                          name: "signed",
                                          value: 0
                                       },
                                       {
                                          name: "is_saved",
                                          value: 0
                                       },
                                       
                                       {
                                          name: "signed_date",
                                          value: ''
                                       },
                                       {
                                          name: "email",
                                          value: email
                                       },
                                       {
                                          name: "group",
                                          value: ''
                                       },
                                       {
                                          name: "data",
                                          value: ''
                                       },
                                       {
                                          name: "datebirth",
                                          value: datebirth
                                       },
                                       {
                                          name: "state",
                                          value: "SMS envoyé"
                                       }    
                                 ]);
                                 break;
                           }

                           $.ajax({
                              type: 'POST',
                              url: '/saveContrat',
                              data: formData1,
                              dataType: 'JSON',
                              success: function(result) {
                                 id_contract=result.savedIds;
                              }
                           });

                           current_fs = $(this).parent();
                           next_fs = $(this).parent().next();

                           //Add Class Active
                           $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

                           //show the next fieldset
                           next_fs.show(); 
                           //hide the current fieldset with style
                           current_fs.animate({opacity: 0}, {
                                 step: function(now) {
                                    // for making fielset appear animation
                                    opacity = 1 - now;

                                    current_fs.css({
                                       'display': 'none',
                                       'position': 'relative'
                                    });
                                    next_fs.css({'opacity': opacity});
                                 }, 
                                 duration: 500
                           });
                           setProgressBar(++current);
                           }else{
                              Swal.fire({
                                 title: 'Error!',
                                 text: "Le code que vous avez taper est incorrect ! merci de le vérifier",
                                 icon: 'error',
                                 confirmButtonText: 'Ok'
                              });
                           }
                        }else{
                           Swal.fire({
                              title: 'Error!',
                              text: "Vous avez dépasser la durée de 5min ! cliquer sur le lien de code non reçu !",
                              icon: 'error',
                              confirmButtonText: 'Ok'
                           });
                        }
                     }
                  }
               });

               $("#nxt6").click(function(){
                  

                  var array = []

                  $('.cndt input[type=checkbox]').each(function () {
                     array.push(this.checked)
                  });

                  //get all elements checked
                  var equalarray=!!array.reduce(function(a, b){ return (a === b) ? a : NaN; });

                  if(equalarray){
                     current_fs = $(this).parent();
                     next_fs = $(this).parent().next();
                     
                     //Add Class Active
                     $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
                     
                     //show the next fieldset
                     next_fs.show(); 
                     //hide the current fieldset with style
                     current_fs.animate({opacity: 0}, {
                           step: function(now) {
                              // for making fielset appear animation
                              opacity = 1 - now;
                  
                              current_fs.css({
                                 'display': 'none',
                                 'position': 'relative'
                              });
                              next_fs.css({'opacity': opacity});
                           }, 
                           duration: 500
                     });
                     setProgressBar(++current);
                  }else{
                     Swal.fire({
                        title: 'Error!',
                        text: "Merci de cliquer sur les deux sections garanties et condition pour cliquer les checkbox",
                        icon: 'error',
                        confirmButtonText: 'Ok'
                     });
                  }
               });

               $("#nxt7").click(function(){  
                  var ibanExiste='';
                  var x='';
                  
                  iban=$("#iban").val();
                  bic=$("#bic").val();
                  //sessionStorage.setItem('iban', iban);
                  //sessionStorage.setItem('bic', bic);
               

                  if(!iban){
                     Swal.fire({
                        title: 'Error!',
                        text: "Merci de saisir les champs obligatoires",
                        icon: 'error',
                        confirmButtonText: 'Ok'
                     });
                  }else if(!document.getElementById('confirmcertif').checked){
                     Swal.fire({
                        title: 'Error!',
                        text: "Merci de cliquer sur la checkbox en bas",
                        icon: 'error',
                        confirmButtonText: 'Ok'
                     });
                  }else if($("#days_normal option:selected").val()==""){
                     Swal.fire({
                        title: 'Error!',
                        text: "Merci de sélectionner un jour de prélévement",
                        icon: 'error',
                        confirmButtonText: 'Ok'
                     });
                  }else{
                     console.log('GENDER:'+gender);
                     splitedIban=iban.replace(/ /g, "");
                     axios.post('/ibanCheck', {
                        iban: splitedIban,
                        gender:gender,
                        company_id: <?php echo json_encode($choice)?>,
                        id_contract: id_contract
                     }).then((response) => {
                        // console.log(response);
                        // ibanExiste=response.result
                        ibanExiste=response.data.ibanExiste;
                        // x=ibanExiste
                        if(response.data.success==false){
                           Swal.fire({
                              title: 'Error!',
                              text: response.data.msg,
                              icon: 'error',
                              confirmButtonText: 'Ok'
                           }).then((result) => {
                              if (result.value) {
                                 if(response.data.status==1){

                                    if (typeselected != 105) {
                                       var  formData0=[];

                                       formData0 = formData0.concat([
                                             {
                                                name: "first_name",
                                                value: fname
                                             },
                                             {
                                                name: "last_name",
                                                value: lname
                                             },
                                             {
                                                name: "contract_number",
                                                value: fullvalue
                                             },
                                             {
                                                name: "company_id",
                                                value: <?php echo json_encode($choice)?>
                                             },
                                             {
                                                name: "iban",
                                                value: null
                                             },
                                             {
                                                name: "bic_swift",
                                                value: null
                                             },
                                             {
                                                name: "status",
                                                value: 2
                                             },
                                             {
                                                name: "step",
                                                value: 2
                                             },       
                                             {
                                                name: "landline_phone",
                                                value: fixe
                                             },
                                             {
                                                name: "mobile_phone",
                                                value: mobile
                                             },
                                             {
                                                name: "type_of_building",
                                                value: 2
                                             },
                                             {
                                                name: "address",
                                                value: fulladresse
                                             },
                                             {
                                                name: "postal_code",
                                                value: cp
                                             },
                                             {
                                                name: "city_name",
                                                value: city
                                             },
                                             {
                                                name: "city_id",
                                                value: ''
                                             },
                                             {
                                                name: "day_id",
                                                value: $("#days_normal option:selected").val()
                                             },
                                             {
                                                name: "sage_number",
                                                value: ''
                                             },
                                             {
                                                name: "status_updated_at",
                                                value: ''
                                             },
                                             {
                                                name: "excel_row",
                                                value: ''
                                             },
                                             {
                                                name: "created_by",
                                                value: 1
                                             },
                                             {
                                                name: "updated_by",
                                                value: 1
                                             },
                                             {
                                                name: "signed",
                                                value: 0
                                             },
                                             {
                                                name: "is_saved",
                                                value: 0
                                             },
                                             
                                             {
                                                name: "signed_date",
                                                value: ''
                                             },
                                             {
                                                name: "email",
                                                value: email
                                             },
                                             {
                                                name: "group",
                                                value: ''
                                             },
                                             {
                                                name: "data",
                                                value: ''
                                             },
                                             {
                                                name: "datebirth",
                                                value: datebirth
                                             },
                                             {
                                                name: "state",
                                                value: "IBAN/PRESTATION déjà existant"
                                             },
                                             {
                                                name: "id_contract",
                                                value: id_contract
                                             } 
                                          ]);

                                       $.ajax({
                                          type: 'POST',
                                          url: '/saveContrat',
                                          data: formData0,
                                          dataType: 'JSON',
                                          success: function(result) {
                                             id_contract=result.savedIds;
                                          }
                                       });
                                    } else {
                                       var  formData0=[];

                                       formData0 = formData0.concat([
                                             {
                                                name: "first_name",
                                                value: fname
                                             },
                                             {
                                                name: "last_name",
                                                value: lname
                                             },
                                             {
                                                name: "contract_number",
                                                value: fullvalue
                                             },
                                             {
                                                name: "company_id",
                                                value: <?php echo json_encode($choice)?>
                                             },
                                             {
                                                name: "iban",
                                                value: null
                                             },
                                             {
                                                name: "bic_swift",
                                                value: null
                                             },
                                             {
                                                name: "status",
                                                value: 2
                                             },
                                             {
                                                name: "step",
                                                value: 2
                                             },       
                                             {
                                                name: "landline_phone",
                                                value: fixe
                                             },
                                             {
                                                name: "mobile_phone",
                                                value: mobile
                                             },
                                             {
                                                name: "type_of_building",
                                                value: 2
                                             },
                                             {
                                                name: "address",
                                                value: fulladresse
                                             },
                                             {
                                                name: "postal_code",
                                                value: cp
                                             },
                                             {
                                                name: "city_name",
                                                value: city
                                             },
                                             {
                                                name: "city_id",
                                                value: ''
                                             },
                                             {
                                                name: "day_id",
                                                value: 30,
                                             },
                                             {
                                                name: "sage_number",
                                                value: ''
                                             },
                                             {
                                                name: "status_updated_at",
                                                value: ''
                                             },
                                             {
                                                name: "excel_row",
                                                value: ''
                                             },
                                             {
                                                name: "created_by",
                                                value: 1
                                             },
                                             {
                                                name: "updated_by",
                                                value: 1
                                             },
                                             {
                                                name: "signed",
                                                value: 0
                                             },
                                             {
                                                name: "is_saved",
                                                value: 0
                                             },
                                             
                                             {
                                                name: "signed_date",
                                                value: ''
                                             },
                                             {
                                                name: "email",
                                                value: email
                                             },
                                             {
                                                name: "group",
                                                value: ''
                                             },
                                             {
                                                name: "data",
                                                value: ''
                                             },
                                             {
                                                name: "datebirth",
                                                value: datebirth
                                             },
                                             {
                                                name: "state",
                                                value: "IBAN/PRESTATION déjà existant"
                                             },
                                             {
                                                name: "id_contract",
                                                value: id_contract
                                             } 
                                          ]);

                                       $.ajax({
                                          type: 'POST',
                                          url: '/saveContrat',
                                          data: formData0,
                                          dataType: 'JSON',
                                          success: function(result) {
                                             id_contract=result.savedIds;
                                          }
                                       });
                                    }
                                    
                                 }
                              }
                           });
                        }else{

                           // api_bic=response.data.bic;
                           // if(bic.slice(0,8)!=api_bic){
                           //    Swal.fire({
                           //       title: 'Error!',
                           //       text: "Votre code Bic est invalide",
                           //       icon: 'error',
                           //       confirmButtonText: 'Ok'
                           //    });
                           // }else{
                              $(".iban").text(iban);  
                              $(".felec").text(fElec);  
                              $(".fgaz").text(fGaz);  

                              var formData1=[];

                              formData1 = formData1.concat([
                                 {
                                    name: "first_name",
                                    value: fname
                                 },
                                 {
                                    name: "last_name",
                                    value: lname
                                 },
                                 {
                                    name: "contract_number",
                                    value: fullvalue
                                 },
                                 {
                                    name: "company_id",
                                    value: <?php echo json_encode($choice)?>
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
                                    name: "status",
                                    value: 2
                                 },
                                 {
                                    name: "step",
                                    value: 2
                                 },
                                 {
                                    name: "landline_phone",
                                    value: fixe
                                 },
                                 {
                                    name: "mobile_phone",
                                    value: mobile
                                 },
                                 {
                                    name: "type_of_building",
                                    value: 2
                                 },
                                 {
                                    name: "address",
                                    value: fulladresse
                                 },
                                 {
                                    name: "postal_code",
                                    value: cp
                                 },
                                 {
                                    name: "city_name",
                                    value: city
                                 },
                                 {
                                    name: "city_id",
                                    value: ''
                                 },
                                 {
                                    name: "day_id",
                                    value: $("#days_normal option:selected").val()
                                 },
                                 {
                                    name: "sage_number",
                                    value: ''
                                 },
                                 {
                                    name: "status_updated_at",
                                    value: ''
                                 },
                                 {
                                    name: "excel_row",
                                    value: ''
                                 },
                                 {
                                    name: "created_by",
                                    value: 1
                                 },
                                 {
                                    name: "updated_by",
                                    value: 1
                                 },
                                 {
                                    name: "signed",
                                    value: 0
                                 },
                                 {
                                    name: "is_saved",
                                    value: 0
                                 },
                                 {
                                    name: "signed_date",
                                    value: ''
                                 },
                                 {
                                    name: "email",
                                    value: email
                                 },
                                 {
                                    name: "group",
                                    value: ''
                                 },
                                 {
                                    name: "data",
                                    value: ''
                                 },
                                 {
                                    name: "datebirth",
                                    value: datebirth
                                 },
                                 {
                                    name: "state",
                                    value: "IBAN validé"
                                 },
                                 {
                                    name: "id_contract",
                                    value: id_contract
                                 }
                              ]);

                              $.ajax({
                                 type: 'POST',
                                 url: '/saveContrat',
                                 data: formData1,
                                 dataType: 'JSON',
                                 success: function(result) {
                                    id_contract=result.savedIds;
                                 }
                              });
                              var element = document.getElementById("id_pdl");
                              if(type.includes(101) && type.includes(102) ){
                                    console.log(response.data.ibanExiste);
                                    if (ibanExiste==false) {
                                       console.log(ibanExiste );

                                    console.log("101 & 102");
                                    element.removeAttribute("hidden");
                                    $(".partgaz").show();
                                    $(".partelec").show();
                                    }

                                    
                              }else if(type.includes(101)){
                                 if (ibanExiste==false) {
                                    element.removeAttribute("hidden");
                                    console.log("101 ");
                                    $(".partelec").show();
                                    $(".partgaz").hide();
                                    $(".partgfo").hide();
                                 }
                              }else if(type.includes(102)){
                                 if (ibanExiste==false) {
                                    console.log("102");
                                    element.removeAttribute("hidden");
                                    $(".partgaz").show();
                                    $(".partelec").hide();
                                    $(".partgfo").hide();
                                 }
                              }else if(type.includes(104)){
                                 console.log(ibanExiste);
                                 if (ibanExiste==false) {
                                    element.removeAttribute("hidden");
                                    console.log("104");
                                    $(".oldsectionpdl").hide();
                                    $(".header-title1").hide();
                                    setTimeout(function(){
                                       $("#nxt8").click();
                                       $(".nxtsectionpdl").show();
                                    }, 1000);
                                 }
                              
                              }else if (type.includes(105)) {
                                 if (ibanExiste==false) {

                                    if (iban) {
                                       element.setAttribute("hidden", "hidden");
                                          console.log("105");
                                          setTimeout(function(){ 
                                             $("#nxt8").click();
                                             $("#finalisation").show();
                                          console.log("Hello World!");
                                       }, 1000);
                                    }
                                 }
                                 

                                 
                                 // current=current+1
                              }else{
                                 $(".partgaz").show();
                                 $(".partelec").show();
                              } 
                              
                              current_fs = $(this).parent();
                              next_fs = $(this).parent().next();
                              
                              //Add Class Active
                              $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
                              
                              //show the next fieldset
                              next_fs.show(); 
                              //hide the current fieldset with style
                              current_fs.animate({opacity: 0}, {
                                    step: function(now) {
                                       // for making fielset appear animation
                                       opacity = 1 - now;
                           
                                       current_fs.css({
                                          'display': 'none',
                                          'position': 'relative'
                                       });
                                       next_fs.css({'opacity': opacity});
                                    }, 
                                    duration: 500
                              });
                              setProgressBar(++current);
            
                           

                           // }

                        }
                        
                              
                        
                     });
                  }
                  
                           
                  
               });
               $("#nxt8").click(function(){  
                  console.log(id_contract);
                                 //step 7 
                                 
                              

                                 pdlElec=$("#pdlElec").val();
                                 pdlGaz=$("#pdlGaz").val();
                                 // console.log('pdl elec'+pdlElec);
                                 // console.log('pdl gaz'+pdlGaz);


                                 // isElecGaz=false;
                                 // isGaz=false;
                                 // isElec=false;

                                 pdl_number.push(pdlElec,pdlGaz);
                                 if((pdlElec && pdlElec.length!=14) || (pdlGaz && pdlGaz.length!=14)){
                                    Swal.fire({
                                       title: 'Error!',
                                       text: "Merci de vérifier Le pdl, il doit contenir exactement 14 chiffres",
                                       icon: 'error',
                                       confirmButtonText: 'Ok'
                                    });
                                 }else if (pdlElec.trim() !== '' && pdlGaz.trim() !== '' && pdlElec == pdlGaz){
                                    Swal.fire({
                                       title: 'Error!',
                                       text: "Gaz et elec ne doit pas avoir les mêmes valeurs",
                                       icon: 'error',
                                       confirmButtonText: 'Ok'
                                    });
                                 }else if(type.includes(101) && type.includes(102) && ($("#f-elec option:selected").val()=="" || $("#f-gaz option:selected").val()=="" || !pdlElec  || !pdlGaz)){
                                    Swal.fire({
                                       title: 'Error!',
                                       text: "Merci de remplir tous les champs",
                                       icon: 'error',
                                       confirmButtonText: 'Ok'
                                    });
                                 }else if(type.includes(101) && ($("#f-elec option:selected").val()=="" || !pdlElec )){
                                    Swal.fire({
                                       title: 'Error!',
                                       text: "Merci de remplir tous les champs",
                                       icon: 'error',
                                       confirmButtonText: 'Ok'
                                    });
                                 }else if(type.includes(102) && ($("#f-gaz option:selected").val()=="" || !pdlGaz )){
                                    Swal.fire({
                                       title: 'Error!',
                                       text: "Merci de remplir tous les champs",
                                       icon: 'error',
                                       confirmButtonText: 'Ok'
                                    });
                                 }else{
                                    if($("#f-elec option:selected").val()!=""){
                                       fElec=$("#f-elec option:selected").text();
                                       idfElec=$("#f-elec option:selected").val();
                                    }else{
                                       fElec='---';
                                    }

                                    if($("#f-gaz option:selected").val()!=""){
                                       fGaz=$("#f-gaz option:selected").text();
                                       idfGaz=$("#f-gaz option:selected").val();
                                    }else{
                                       fGaz='---';
                                    }
                                    if (type.includes(101) && type.includes(102)|| (type.includes(101) || type.includes(102))) {
                                       var formData1 =[];
                                       formData1 = formData1.concat([
                                          {
                                             name: "id_contract",
                                             value: id_contract
                                          },
                                          {
                                             name: "pdl_Gaz",
                                             value: pdlGaz
                                          },
                                          {
                                             name: "pdl_Elec",
                                             value: pdlElec
                                          },
                                          {
                                             name: "service_provider_idElec",
                                             value: idfElec
                                          },
                                          {
                                             name: "service_provider_idGaz",
                                             value: idfGaz
                                          }  
                                       ]);

                                       $.ajax({
                                          type: 'POST',
                                          url: '/updatePdlContract',
                                          data: formData1,
                                          dataType: 'JSON',
                                          success: function(result) {
                                          }
                                       });   
                                    }
                                   
                                     
                                    
                                    $(".pdlElec").text(pdlElec);  
                                    $(".pdlGaz").text(pdlGaz);  
                                    $(".felec").text(fElec);  
                                    $(".fgaz").text(fGaz);  
                                             
                                    current_fs = $(this).parent();
                                    next_fs = $(this).parent().next();

                                    //Add Class Active
                                    $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

                                    //show the next fieldset
                                    next_fs.show(); 
                                    //hide the current fieldset with style
                                    current_fs.animate({opacity: 0}, {
                                          step: function(now) {
                                             // for making fielset appear animation
                                             opacity = 1 - now;

                                             current_fs.css({
                                                'display': 'none',
                                                'position': 'relative'
                                             });
                                             next_fs.css({'opacity': opacity});
                                          }, 
                                          duration: 500
                                    });
                                    setProgressBar(++current);
                                 }

                              });



               $("#nxt9").click(function(){
                  // console.log('id_contract ='+id_contract);
                  //call mailing api
                  
                  var serviceProvider=[];

                  if(type.includes(101) && type.includes(102)){
                     bgtxt1="√ Option ÉLECTRICITÉ : PDL "+pdlElec+ " Fournisseur : "+fElec;
                     bgtxt2="√ Option GAZ : PCE "+pdlGaz+ " Fournisseur : "+fGaz;
                     serviceProvider.push(idfElec);
                     serviceProvider.push(idfGaz);
                  }else if(type.includes(101)){   
                     bgtxt1="√ Option ÉLECTRICITÉ : PDL "+pdlElec+ " Fournisseur : "+fElec;
                     bgtxt2="";
                     serviceProvider.push(idfElec);
                  }else if(type.includes(102)){
                     bgtxt2="√ Option GAZ : PCE "+pdlGaz+ " Fournisseur : "+fGaz;
                     bgtxt1="";
                     serviceProvider.push(idfGaz);
                  }
                  // console.log(serviceProvider);
               
                  var formData1 = [];

                  // fullvalue='D/'+year+'/'+month+'/'+xvalue+'/'+nuum;

                  //sign document
                  var formData0 = [];
                  var codeGenerated = random;
                  var civiliteValue = $("input[name='civilite']").val()
                  if (typeselected != 105) {
                     formData0 = formData0.concat([
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
                           value: datebirth
                        },
                        {
                           name: "adresse",
                           value: fulladresse
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
                        }
                        ,
                        {
                           name: "code",
                           value: random
                        }
                        ,
                        {
                           name: "typeselected",
                           value: <?php echo json_encode($choice)?>
                        },
                        {
                           name: "textselected",
                           value: textselected
                        },
                        {
                           name: "iban",
                           value: iban
                        },
                        {
                           name: "bic",
                           value: bic
                        },
                        {
                           name: "xvalue",
                           value: fullvalue
                        },
                        {
                           name: "pdl",
                           value: pdlElec
                        },
                        {
                           name: "pce",
                           value: pdlGaz
                        },
                        {
                           name: "fournisseurpdl",
                           value: fElec
                        },
                        {
                           name: "fournisseurpce",
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
                        },
                        {
                           name: "reccurent",
                           value: $("#days_normal option:selected").val()
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
                     formData0 = formData0.concat([
                        {
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
                           name: "age",
                           value: age
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
                           name: "datebird",
                           value: datebirth
                        },
                        {
                           name: "adresse",
                           value: fulladresse
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
                           name:"etre_couvert",
                           value:etre_couvert
                        },
                        {
                           name:"montant_de_cotisation",
                           value:montant_de_cotisation
                        }
                        ,
                        {
                           name: "code",
                           value: random
                        }
                        ,
                        {
                           name: "typeselected",
                           value: <?php echo json_encode($choice)?>
                        },
                        {
                           name: "textselected",
                           value: textselected
                        },
                        {
                           name: "iban",
                           value: iban
                        },
                        {
                           name: "bic",
                           value: bic
                        },
                        {
                           name: "xvalue",
                           value: fullvalue
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
                        }, // rja3 commentaire
                        {
                           name: "reccurent",
                           value: $("#days_normal option:selected").val()
                        },
                        {
                           name: "dateenvoie",
                           value: sendSMSresponde[0]['dateEnvoi']
                        },
                        {
                           name: "departement_naissance",
                           value:  departement_naissance
                  
                        },
                        {
                           name: "pays_naissance",
                           value:  pays_naissance
                  
                        },
                        {
                           name: "commune_naissance",
                           value:  commune_naissance
                  
                        },
                        {
                           name: "nom_naissance",
                           value:  nom_naissance
                  
                        }
                     
                     ]);
         
                     
                  
                     console.log(formData0);
                  }
                 

               
               
                  $.ajax({
                     type: 'POST',
                     url: '/sign-document',
                     data: formData0,
                     dataType: 'JSON',
                     success: function(result) {
                        //save contract
                        if(result.success){
                           $(".svgok").hide();
                           $(".text-success").show();
                           
                           Swal.fire({
                              icon: 'success',
                              title: 'Contrat reçu',
                              text: result.message,
                              confirmButtonColor: "#3a57e8",
                              onClose: () => {
                                 window.location.replace("/dashboard")
                              }
                           });

                           formData1 = formData1.concat([
                              {
                                 name: "id_contract",
                                 value: id_contract
                              },
                              {
                                 name: "envelopeId",
                                 value: result.result.envelopeId
                              },
                              {
                                 name: "state",
                                 value: "Bulletin Envoyé"
                              }
                           ]);

                           $.ajax({
                              type: 'POST',
                              url: '/updatestate',
                              data: formData1,
                              dataType: 'JSON',
                              success: function(result) {
                              }
                           });   

                        }
                     }
                  });  

                  //step 8
                  current_fs = $(this).parent();
                  next_fs = $(this).parent().next();

                  //Add Class Active
               $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

                  next_fs.show(); 
                  current_fs.animate({opacity: 0}, {
                        step: function(now) {
                           opacity = 1 - now;

                           current_fs.css({
                              'display': 'none',
                              'position': 'relative'
                           });
                           next_fs.css({'opacity': opacity});
                        }, 
                        duration: 500
                  }); 
                  setProgressBar(++current);
                  $("#succes").show();
                 // sessionStorage.clear();
               });

               $(".previous").click(function(){
                  
                  current_fs = $(this).parent();
                  previous_fs = $(this).parent().prev();
                  
                  //Remove class active
                  $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
                  
                  previous_fs.show();
               
                  current_fs.animate({opacity: 0}, {
                        step: function(now) {
                           opacity = 1 - now;
               
                           current_fs.css({
                              'display': 'none',
                              'position': 'relative'
                           });
                           previous_fs.css({'opacity': opacity});
                        }, 
                        duration: 500
                  });
                  setProgressBar(--current);
               });
               
               function setProgressBar(curStep){
                  var percent = parseFloat(100 / steps) * curStep;
                  percent = percent.toFixed();
                  $(".progress-bar")
                     .css("width",percent+"%")   
               }
               
               $(".submit").click(function(){
                  return false;
               })

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

               // ins.forEach(function(input) {
               //    input.addEventListener('keyup', function(e){
               //       if (e.keyCode === 16 || e.keyCode == 9 || e.keyCode == 224 || e.keyCode == 18 || e.keyCode == 17) {
               //          return;
               //       }
                     
               //       if ( (e.keyCode === 8 || e.keyCode === 37) && this.previousElementSibling && this.previousElementSibling.tagName === "INPUT" ) {
               //          this.previousElementSibling.select();
               //       } else if (e.keyCode !== 8 && this.nextElementSibling) {
               //          this.nextElementSibling.select();
               //       }
                     
               //       if ( e.target.value.length > 1 ) {
               //          splitNumber(e);
               //       }
               //    });
                  
               //    input.addEventListener('focus', function(e) {
               //       if ( this === in1 ) return;
               //          if ( in1.value == '' ) {
               //             in1.focus();
               //          }
                     
               //       if ( this.previousElementSibling.value == '' ) {
               //          this.previousElementSibling.focus();
               //       }
               //    });
               // });

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

               // in1.addEventListener('input', splitNumber);
               if (in1) {
                  in1.addEventListener("input", splitNumber);
               }


            });

      </script>
   </body>
</html>