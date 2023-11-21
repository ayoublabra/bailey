
<html>
  <head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/1.4.6/tailwind.css" rel="stylesheet" />
   </head>
   <style>
      .checkboxes{
         cursor: pointer;
         z-index: 90;
         text-align: center;
         font-family: "Arial";
         font-weight: bold;
         font-size: 16px;
         color: black;
         width: 270px;
         margin: 5px;
         border-radius: 0px !important;
         border: 1px solid #005cd28c !important;
         padding-bottom: 5px;
      }

      .checkboxes:hover,
      .form-check input[type="checkbox"]:checked + label{
         background: #005cd28c;
         color: black !important;
      }

      .form-check input[type="checkbox"] {
         opacity: 0;
      }

      .box{
         font-size: 0.980em;
         display: block;
         margin-top: 35px;
         width: 100%;
         text-align: center;
         padding: 20px !important;
         border-radius: 9px !important;
      }

      .me-1{
         margin-top: 2rem !important;
         margin-left: 1rem;
      }

      button#nxt1 {
         float: right;    
         margin-right: 46px;  
      }
   </style>
   <body>
      <x-app-layout :assets="$assets ?? []">
         <div>
            <div class="row">
         @foreach ($roles as $role)
            @if($role->nomRole=="superadmin" || $role->nomRole=="manager")
               <div class="card" style="height: 740px;">
                  <div class="card-header d-flex justify-content-between">
                     <div class="header-title">
                        <h4 class="card-title">Nouveau Contrat : Choix</h4>
                     </div>
                  </div>
                 
                  <div class="card-body">
                     <form method="GET" action="{{ route('forms.wizard') }}" enctype="multipart/form-data" class="row g-3 needs-validation">
                        @csrf 
                        <div class="col-md-12 form-check list-inline list-group-horizontal btn-group" role="group" data-toggle="buttons" style="display:inline;">
                              <div class="mrbox" style="display: flex;">
                                 <input id="checkbox-1" type="checkbox" name="ustAcheckBox[]" value="101" class="form-check list-group-item">
                                 <label class="btn btn-default checkboxes box" for="checkbox-1" style="width: 100%;color:black;">
                                    MON ASSURANCE FACTURE ELECTRICITE
                                 </label>
                                 <button class="d-flex align-items-center active" data-bs-toggle="tab" data-bs-target="#content-accordion-prv" type="button" role="tab" aria-selected="true" title="Visualiser le pdf de pub" id="pub1">
                                    <svg width="20" class="me-1" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                       <path d="M22.4541 11.3918C22.7819 11.7385 22.7819 12.2615 22.4541 12.6082C21.0124 14.1335 16.8768 18 12 18C7.12317 18 2.98759 14.1335 1.54586 12.6082C1.21811 12.2615 1.21811 11.7385 1.54586 11.3918C2.98759 9.86647 7.12317 6 12 6C16.8768 6 21.0124 9.86647 22.4541 11.3918Z" stroke="currentColor"></path>
                                       <circle cx="12" cy="12" r="3.5" stroke="currentColor"></circle>
                                       <circle cx="13.5" cy="10.5" r="1.5" fill="currentColor"></circle>
                                    </svg>
                                 </button>
                              </div>
                              <div class="mrbox" style="display: flex;">
                                 <input id="checkbox-2" type="checkbox" name="ustAcheckBox[]" value = "102" class = "form-check list-group-item" id = "checkbox_select1" >
                                 <label class="btn btn-default checkboxes box" for="checkbox-2" style="width: 100%;color:black;">
                                    MON ASSURANCE FACTURE GAZ
                                 </label>
                                 <button class="d-flex align-items-center active" data-bs-toggle="tab" data-bs-target="#content-accordion-prv" type="button" role="tab" aria-selected="true" title="Visualiser le pdf de pub" id="pub2">
                                    <svg width="20" class="me-1" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                       <path d="M22.4541 11.3918C22.7819 11.7385 22.7819 12.2615 22.4541 12.6082C21.0124 14.1335 16.8768 18 12 18C7.12317 18 2.98759 14.1335 1.54586 12.6082C1.21811 12.2615 1.21811 11.7385 1.54586 11.3918C2.98759 9.86647 7.12317 6 12 6C16.8768 6 21.0124 9.86647 22.4541 11.3918Z" stroke="currentColor"></path>
                                       <circle cx="12" cy="12" r="3.5" stroke="currentColor"></circle>
                                       <circle cx="13.5" cy="10.5" r="1.5" fill="currentColor"></circle>
                                    </svg>
                                 </button>
                              </div>
                              <div class="mrbox" style="display: flex;">
                                 <input id="checkbox-3" type="checkbox" name="ustAcheckBox[]" value = "104" class = "form-check list-group-item" id = "checkbox_select2" >
                                 <label class="btn btn-default checkboxes box" for="checkbox-3" style="width: 100%;color:black;">
                                    MON ASSURANCE PGE
                                 </label>
                                 <button class="d-flex align-items-center active" data-bs-toggle="tab" data-bs-target="#content-accordion-prv" type="button" role="tab" aria-selected="true" title="Visualiser le pdf de pub" id="pub3">
                                    <svg width="20" class="me-1" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                       <path d="M22.4541 11.3918C22.7819 11.7385 22.7819 12.2615 22.4541 12.6082C21.0124 14.1335 16.8768 18 12 18C7.12317 18 2.98759 14.1335 1.54586 12.6082C1.21811 12.2615 1.21811 11.7385 1.54586 11.3918C2.98759 9.86647 7.12317 6 12 6C16.8768 6 21.0124 9.86647 22.4541 11.3918Z" stroke="currentColor"></path>
                                       <circle cx="12" cy="12" r="3.5" stroke="currentColor"></circle>
                                       <circle cx="13.5" cy="10.5" r="1.5" fill="currentColor"></circle>
                                    </svg>
                                 </button>
                              </div>
                              <div class="mrbox" style="display: flex;">
                                 <input id="checkbox-4" type="checkbox" name="ustAcheckBox[]" value = "105" class = "form-check list-group-item" id = "checkbox_select4" >
                                 <label class="btn btn-default checkboxes box" for="checkbox-4" style="width: 100%;color:black;">
                                    MON ASSURANCE GFO
                                 </label>
                                 <button class="d-flex align-items-center active" data-bs-toggle="tab" data-bs-target="#content-accordion-prv" type="button" role="tab" aria-selected="true" title="Visualiser le pdf de pub" id="pub4">
                                    <svg width="20" class="me-1" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                       <path d="M22.4541 11.3918C22.7819 11.7385 22.7819 12.2615 22.4541 12.6082C21.0124 14.1335 16.8768 18 12 18C7.12317 18 2.98759 14.1335 1.54586 12.6082C1.21811 12.2615 1.21811 11.7385 1.54586 11.3918C2.98759 9.86647 7.12317 6 12 6C16.8768 6 21.0124 9.86647 22.4541 11.3918Z" stroke="currentColor"></path>
                                       <circle cx="12" cy="12" r="3.5" stroke="currentColor"></circle>
                                       <circle cx="13.5" cy="10.5" r="1.5" fill="currentColor"></circle>
                                    </svg>
                                 </button>
                              </div>
                           <br>
                           <div class="col-12 text-right">
                              <button type="submit" class="btn btn-primary" id="nxt1">  {{ __('Suivant') }}</button>
                           </div>
                        </div>

                     </form>
                  </div>
                </div>
                {{-- {{$role->nomRole}} --}}
                @elseif(!$role->nomRole=="superadmin" ||  $role->nomRole=="conseiller" )
                
                <div class="card" style="height: 740px;">
                  <div class="card-header d-flex justify-content-between">
                     <div class="header-title">
                        <h4 class="card-title">Nouveau Contrat : Choix</h4>
                     </div>
                  </div>
                 
                  <div class="card-body">
                     <form method="GET" action="{{ route('forms.wizard') }}" enctype="multipart/form-data" class="row g-3 needs-validation">
                        @csrf 

                        <div class="col-md-12 form-check list-inline list-group-horizontal btn-group" role="group" data-toggle="buttons" style="display:inline;">
                           @foreach ($operatorAcces as $op_ac)

                              @if($op_ac->company_id =="101")
                              <div class="mrbox" style="display: flex;">
                                 <input id="checkbox-1" type="checkbox" name="ustAcheckBox[]" value="101" class="form-check list-group-item">
                                 <label class="btn btn-default checkboxes box" for="checkbox-1" style="width: 100%;color:black;">
                                    MON ASSURANCE FACTURE ELECTRICITE
                                 </label>
                                 <button class="d-flex align-items-center active" data-bs-toggle="tab" data-bs-target="#content-accordion-prv" type="button" role="tab" aria-selected="true" title="Visualiser le pdf de pub" id="pub1">
                                    <svg width="20" class="me-1" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                       <path d="M22.4541 11.3918C22.7819 11.7385 22.7819 12.2615 22.4541 12.6082C21.0124 14.1335 16.8768 18 12 18C7.12317 18 2.98759 14.1335 1.54586 12.6082C1.21811 12.2615 1.21811 11.7385 1.54586 11.3918C2.98759 9.86647 7.12317 6 12 6C16.8768 6 21.0124 9.86647 22.4541 11.3918Z" stroke="currentColor"></path>
                                       <circle cx="12" cy="12" r="3.5" stroke="currentColor"></circle>
                                       <circle cx="13.5" cy="10.5" r="1.5" fill="currentColor"></circle>
                                    </svg>
                                 </button>
                              </div>
                              @endif
                              @if($op_ac->company_id =="102")
                              <div class="mrbox" style="display: flex;">
                                 <input id="checkbox-2" type="checkbox" name="ustAcheckBox[]" value = "102" class = "form-check list-group-item" id = "checkbox_select1" >
                                 <label class="btn btn-default checkboxes box" for="checkbox-2" style="width: 100%;color:black;">
                                    MON ASSURANCE FACTURE GAZ
                                 </label>
                                 <button class="d-flex align-items-center active" data-bs-toggle="tab" data-bs-target="#content-accordion-prv" type="button" role="tab" aria-selected="true" title="Visualiser le pdf de pub" id="pub2">
                                    <svg width="20" class="me-1" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                       <path d="M22.4541 11.3918C22.7819 11.7385 22.7819 12.2615 22.4541 12.6082C21.0124 14.1335 16.8768 18 12 18C7.12317 18 2.98759 14.1335 1.54586 12.6082C1.21811 12.2615 1.21811 11.7385 1.54586 11.3918C2.98759 9.86647 7.12317 6 12 6C16.8768 6 21.0124 9.86647 22.4541 11.3918Z" stroke="currentColor"></path>
                                       <circle cx="12" cy="12" r="3.5" stroke="currentColor"></circle>
                                       <circle cx="13.5" cy="10.5" r="1.5" fill="currentColor"></circle>
                                    </svg>
                                 </button>
                              </div>
                              @endif
                              @if($op_ac->company_id =="104")
                              <div class="mrbox" style="display: flex;">
                                 <input id="checkbox-3" type="checkbox" name="ustAcheckBox[]" value = "104" class = "form-check list-group-item" id = "checkbox_select2" >
                                 <label class="btn btn-default checkboxes box" for="checkbox-3" style="width: 100%;color:black;">
                                    MON ASSURANCE PGE
                                 </label>
                                 <button class="d-flex align-items-center active" data-bs-toggle="tab" data-bs-target="#content-accordion-prv" type="button" role="tab" aria-selected="true" title="Visualiser le pdf de pub" id="pub3">
                                    <svg width="20" class="me-1" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                       <path d="M22.4541 11.3918C22.7819 11.7385 22.7819 12.2615 22.4541 12.6082C21.0124 14.1335 16.8768 18 12 18C7.12317 18 2.98759 14.1335 1.54586 12.6082C1.21811 12.2615 1.21811 11.7385 1.54586 11.3918C2.98759 9.86647 7.12317 6 12 6C16.8768 6 21.0124 9.86647 22.4541 11.3918Z" stroke="currentColor"></path>
                                       <circle cx="12" cy="12" r="3.5" stroke="currentColor"></circle>
                                       <circle cx="13.5" cy="10.5" r="1.5" fill="currentColor"></circle>
                                    </svg>
                                 </button>
                              </div>
                              @endif
                              @if($op_ac->company_id =="105")
                              <div class="mrbox" style="display: flex;">
                                 <input id="checkbox-4" type="checkbox" name="ustAcheckBox[]" value = "105" class = "form-check list-group-item" id = "checkbox_select4" >
                                 <label class="btn btn-default checkboxes box" for="checkbox-4" style="width: 100%;color:black;">
                                    MON ASSURANCE GFO
                                 </label>
                                 <button class="d-flex align-items-center active" data-bs-toggle="tab" data-bs-target="#content-accordion-prv" type="button" role="tab" aria-selected="true" title="Visualiser le pdf de pub" id="pub4">
                                    <svg width="20" class="me-1" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                       <path d="M22.4541 11.3918C22.7819 11.7385 22.7819 12.2615 22.4541 12.6082C21.0124 14.1335 16.8768 18 12 18C7.12317 18 2.98759 14.1335 1.54586 12.6082C1.21811 12.2615 1.21811 11.7385 1.54586 11.3918C2.98759 9.86647 7.12317 6 12 6C16.8768 6 21.0124 9.86647 22.4541 11.3918Z" stroke="currentColor"></path>
                                       <circle cx="12" cy="12" r="3.5" stroke="currentColor"></circle>
                                       <circle cx="13.5" cy="10.5" r="1.5" fill="currentColor"></circle>
                                    </svg>
                                 </button>
                              </div>
                              @endif
                              @endforeach{{--for_each _for_opecrator acce --}}

                           <br>
                           <div class="col-12 text-right">
                              <button type="submit" class="btn btn-primary" id="nxt1">  {{ __('Suivant') }}</button>
                           </div>

                        </div>

                     </form>
                  </div>
                </div>

                @endif
         @endforeach {{--for_each _for_role --}}
            </div>
         </div>
      </x-app-layout>


      <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.3.5/dist/alpine.min.js"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

      <script type="text/javascript">
         $(document).ready(function(){

            $("#nxt1").click(function(){
               var check= $('#checkbox-1').val();

               if(!$('#checkbox-1').is(':checked') && !$('#checkbox-2').is(':checked') && !$('#checkbox-3').is(':checked')&&!$('#checkbox-4').is(':checked') ){
                  Swal.fire({
                     title: 'Error!',
                     text: "Merci de sélectionner votre choix d'assurance",
                     icon: 'error',
                     confirmButtonText: 'Ok'
                  });
                  return false;
               }else if($('#checkbox-2').is(':checked') && $('#checkbox-3').is(':checked') && $('#checkbox-4').is(':checked')){
                  Swal.fire({
                     title: 'Error!',
                     text: "Merci de ne pas sélectionner les deux choix GAZ et PGE et GFO en même temps",
                     icon: 'error',
                     confirmButtonText: 'Ok'
                  });
                  return false;
               }
               else if($('#checkbox-1').is(':checked') && $('#checkbox-2').is(':checked') && $('#checkbox-3').is(':checked') )
               {
                  Swal.fire({
                     title: 'Error!',
                     text: "Merci de ne pas sélectionner les deux choix ELEC/GAZ et PGE en même temps",
                     icon: 'error',
                     confirmButtonText: 'Ok'
                  });
                  return false;
               }else if($('#checkbox-2').is(':checked') && $('#checkbox-3').is(':checked') ){
                  Swal.fire({
                     title: 'Error!',
                     text: "Merci de ne pas sélectionner les deux choix GAZ et PGE en même temps",
                     icon: 'error',
                     confirmButtonText: 'Ok'
                  });
                  return false;
               }else if($('#checkbox-1').is(':checked') && $('#checkbox-3').is(':checked') ){
                  Swal.fire({
                     title: 'Error!',
                     text: "Merci de ne pas sélectionner les deux choix Elec et PGE en même temps",
                     icon: 'error',
                     confirmButtonText: 'Ok'
                  });
                  return false;
               }else if ($('#checkbox-1').is(':checked') && $('#checkbox-2').is(':checked') && $('#checkbox-4').is(':checked')) {
                  Swal.fire({
                     title: 'Error!',
                     text: "Merci de ne pas sélectionner les deux choix ELEC/GAZ et GFO en même temps",
                     icon: 'error',
                     confirmButtonText: 'Ok'
                  });
                  return false;
               }else if ($('#checkbox-3').is(':checked') && $('#checkbox-4').is(':checked') ) {
                  Swal.fire({
                     title: 'Error!',
                     text: "Merci de ne pas sélectionner les deux choix PGE et GFO en même temps",
                     icon: 'error',
                     confirmButtonText: 'Ok'
                  });
                  return false;
               }else if ($('#checkbox-1').is(':checked') && $('#checkbox-4').is(':checked') ) {
                  Swal.fire({
                     title: 'Error!',
                     text: "Merci de ne pas sélectionner les deux choix ELEC et GFO en même temps",
                     icon: 'error',
                     confirmButtonText: 'Ok'
                  });
                  return false;
               }else if ($('#checkbox-2').is(':checked') && $('#checkbox-4').is(':checked')) {
                  Swal.fire({
                     title: 'Error!',
                     text: "Merci de ne pas sélectionner les deux choix GAZ et GFO en même temps",
                     icon: 'error',
                     confirmButtonText: 'Ok'
                  });
                  return false;
               }
            });

            $("#pub1,#pub2").click(function(){
               window.open('/getpub/1', '_blank', 'location=yes,height=600,width=900,top=400,left=500,scrollbars=yes,status=yes');
            });
            $("#pub3").click(function(){
               window.open('/getpub/2', '_blank', 'location=yes,height=600,width=900,top=400,left=500,scrollbars=yes,status=yes');
            });
            $("#pub4").click(function(){
               window.open('/getpub/3', '_blank', 'location=yes,height=600,width=900,top=400,left=500,scrollbars=yes,status=yes');
            });
         });
      </script>

   </body>
</html>