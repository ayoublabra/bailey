{{-- @push('scripts'
@endpush --}}
<link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/9.8.2/sweetalert2.min.css" rel="stylesheet" />
   <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<x-app-layout :assets="$assets ?? []">
   <div>
      <div class="row">
         <div class="col-sm-12">
            <div class="card">
               <div class="card-header d-flex justify-content-between">
                  <div class="header-title">
                     <h4 class="card-title">Listes des utilisateurs</h4>
                  </div>
                  <div class="header-title">
                     <!-- <a  class="btn btn-primary">Add User</a>  -->
                      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                         Ajouter un nouveau Utilisateur
                       </button>              
                   </div>
               </div>
               <div class="modal fade " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                     <form action="{{route('postUser')}}" method="POST">
                        {{ csrf_field() }}
                      <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel" >Nouveau Utilisateur</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <div class="new-user-info">
                           <!-- <div class="header-title">
                              <h4 class="card-title" style="text-align: center"> Information d'utilisateur</h4>
                           </div> -->
                           <div class="form-group col-md-12">
                              <label class="form-label" for="nom_op">Nom: <span class="text-danger">*</span></label>
                              <input type="text" name="nom_op" id="nom_op" class="form-control" placeholder="Entrer le nom">
                           </div>
                           <div class="form-group col-md-12">
                              <label class="form-label" for="prenom_op">Prenom: <span class="text-danger">*</span></label>
                              <input type="text" name="prenom_op" id="prenom_op" class="form-control" placeholder="Entrer le prenom">
                           </div>
                           <div class="form-group col-md-12">
                              <label class="form-label" for="phone_conseiller">Numéro téléphone: <span class="text-danger">*</span></label>
                              <input type="text" name="phone_conseiller" id="phone_conseiller" class="form-control" placeholder="Entrer le numéro de téléphone">
                           </div>
                           <div class="form-group col-md-12">
                              <label class="form-label" for="uname">Nom d'utilisateur: <span class="text-danger">*</span></label>
                              <input type="text" name="username" id="username" class="form-control" placeholder="Entrez le nom d'utilisateur">
                           </div>
                           <div class="form-group col-md-12">
                              <label class="form-label" for="email">Email: <span class="text-danger">*</span></label>
                              <input type="email" name="email" id="email" class="form-control" placeholder="Entrez l'email">
                           </div>
                           <div class="form-group col-md-12">
                              <label class="form-label" for="pass">Mot de passe:</label>
                              <input type="password" name="password" id="password" class="form-control" placeholder="Entrez le mot se passe">
                           </div>
                           <div class="form-group col-md-12">
                              <label class="form-label" for="rpass">Confirmer le mot de passe:</label>
                              <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Confirmer le mot de passe">
                           </div>
                           <label class="form-label" >Choisissez le rôle de cet utilisateur:</label>
                           <div class="form-group col-md-12">
                              <select  class="form-select form-select-sm" aria-label=".form-select-sm example" onchange="s(event)" style="width: 100%;text-align: center;height: 42px;" name="role_user" id="role_user">
                                 <option selected>Selectionner le rôle </option>
                                 @foreach ($roles as $item)
                                 <option  value="{{$item->id}}">{{$item->nomRole}}</option>
                                 @endforeach
                              </select>
                           </div>
                           <div hidden id="div_for_conseiller">
                              <label class="form-label" >Choisissez les type de contrat qui peut saisir:</label>
                              @foreach ($companys as $item)
                                 @if ($item->active===1)
                                    <div  style="margin-left: 25%;" id="conseiller_div" class="form-check form-switch">
                                       <input class="form-check-input" type="checkbox" id="affect[]" name="affect[]" value={{$item->id}} >
                                       <label class="form-check-label" for="{{$item->name}}">{{$item->name}}</label>
                                    </div>
                                 @endif
                              @endforeach
                           </div>
                     </div>
                      </div>
                      <div class="modal-footer">
                        {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> --}}
                         <button type="submit" class="btn btn-primary" id="add_user">Ajouter</button>
                      </div>
                      </form>
                    </div>
                  </div>
               </div>
   
               <div class="card-body px-0">
                  <div class="table-responsive">
                      <table id="user-list-table" class="table table-striped" role="grid" data-toggle="data-table">
                        <thead>
                           <tr class="ligth">
                              <th>ID</th>
                              <th>Nom d'utilisateur</th>
                              <th>Email</th>
                              <th>Roles</th>
                              <th>Type de contrat</th>
                              <!-- <th>Dernière connexion</th> -->
                              <th>Date Creation</th>
                              <th>Date de mise à jour</th>
                              <th style="min-width: 100px">Action</th>
                           </tr>
                        </thead>
                        <tbody>
                           @foreach ($users as $us)
                           <tr>
                              <td>#UTI{{rand(1,99)}}{{$us->id}}</td>
                              <td>{{$us->username}}</td>
                              <td>{{$us->email}}</td>
                              <td>{{$us->getRoleForUser($us->id)}}</td>
                              <td>{{$us->getTypeContrat($us->id)}}</td>
                              <td>{{date("d-m-Y H:i", $us->created_at);}}</td>
                              <td>{{date("d-m-Y H:i", $us->updated_at);}}</td>
                              <td>
                                 <div class="flex align-items-center list-user-action">
                                    {{-- @if ($us->blocked_at != NULL)
                                       <a class="btn btn-sm btn-icon btn-primary" style="" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit" href="#">
                                          <span class="btn-inner">
                                             <button style="background-color: Transparent; background-repeat:no-repeat; border: none; cursor:pointer; overflow: hidden; outline:none; color: white" class="btn btn-primary btn-sm danger_btn" onclick="deblockUser({{$us->id}})" id="deblockButton-{{$us->id}}">
                                                <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                   <path d="M4 12.6111L8.92308 17.5L20 6.5" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                             </button>
                                          </span>
                                       </a>
                                    @endif --}}
                                    @if ($us->blocked_at!= NULL)
                                    <a class="btn btn-sm btn-icon btn-primary" style="" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit" href="#">
                                       {{-- <span class="btn-inner"> --}}
                                          <form action="{{route('deblockUser',$us->id)}}" method="POST">
                                             @csrf
                                             @method('PUT')
                                                <button style=" background-color: Transparent;
                                                background-repeat:no-repeat;
                                                border: none;
                                                cursor:pointer;
                                                overflow: hidden;
                                                outline:none;
                                                color: white" class="btn btn-primary btn-sm danger_btn">
                                                 <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                   <path d="M4 12.6111L8.92308 17.5L20 6.5" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                   </svg>
                                                </button>
                                             </form>
                                       {{-- </span> --}}
                                    </a>
                                    
                                 @endif        

                              @if ($us->blocked_at== NULL)

                                 <a class="btn btn-sm btn-success" style="color: green;width:45px " >
                                       <form action="{{route('blockUser',$us->id)}}" method="POST">
                                          @csrf
                                          @method('PUT')
                                          {{-- <span class="btn-inner"> --}}

                                             <button style="background-color: transparent; background-repeat:no-repeat; border: none;"  type="submit" >
                                                    <svg width="20px" style="margin-left: -7px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                      <path d="M5.63605 5.63603L18.364 18.364M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                      </svg>
                                                </button>
                                             {{-- </span> --}}

                                             </form>

                                 </a>
                                 @endif  
                                       <a class="btn btn-sm btn-icon btn-warning" style="" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit" href="#">
                                          <span class="btn-inner">
                                             <button  style=" background-color: Transparent;
                                             background-repeat:no-repeat;
                                             border: none;
                                             cursor:pointer;
                                             overflow: hidden;
                                             outline:none;
                                             color: white" class="btn btn-warning btn-sm warning_btn" id="btn_edit_user" onclick="getTypeConctrat({{$us->id}})" data-bs-toggle="modal" data-user-id="{{$us->id}}" data-bs-target="#edit_user_modal{{$us->id}}">
                                                <svg width="30" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                   <path d="M11.4925 2.78906H7.75349C4.67849 2.78906 2.75049 4.96606 2.75049 8.04806V16.3621C2.75049 19.4441 4.66949 21.6211 7.75349 21.6211H16.5775C19.6625 21.6211 21.5815 19.4441 21.5815 16.3621V12.3341" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                   <path fill-rule="evenodd" clip-rule="evenodd" d="M8.82812 10.921L16.3011 3.44799C17.2321 2.51799 18.7411 2.51799 19.6721 3.44799L20.8891 4.66499C21.8201 5.59599 21.8201 7.10599 20.8891 8.03599L13.3801 15.545C12.9731 15.952 12.4211 16.181 11.8451 16.181H8.09912L8.19312 12.401C8.20712 11.845 8.43412 11.315 8.82812 10.921Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                   <path d="M15.1655 4.60254L19.7315 9.16854" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                </svg>
                                                </button>
                                          </span>
                                       </a>
                                       <div class="modal fade"  id="edit_user_modal{{$us->id}}"  tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                             <div class="modal-dialog modal-xl">
                                                <div class="modal-content">
                                                   <div class="modal-header">
                                                      <h1 class="modal-title fs-5" id="exampleModalLabel">Mettre à jour d'utilisateur</h1>
                                                         
                                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                   </div>
                                                   <div class="modal-body">
                                                      <form action="{{route('editUser',$us->id)}}" method="POST">
                                                         @csrf
                                                         @method('PUT')
                                                      <div hidden class="form-group col-md-12">
                                                         <label class="form-label" for="uname">ID: <span class="text-danger">*</span></label>
                                                         <input type="text" name="user_id" id="user_id" value="{{$us->id}}" class="form-control" >
                                                      </div>
                                                      <div class="form-group col-md-12">
                                                         <label class="form-label" for="uname">Nom d'utilisateur: <span class="text-danger">*</span></label>
                                                         <input type="text" name="username" id="username" value="{{$us->username}}" class="form-control">
                                                      </div>
                                                      <div class="form-group col-md-12">
                                                         <label class="form-label" for="email">Email: <span class="text-danger">*</span></label>
                                                         <input type="email" name="email" id="email" value="{{$us->email}}" class="form-control">
                                                      </div>
                                                      <div class="form-group col-md-12">
                                                      <label class="form-label" for="pass">Mot de passe:</label>
                                                         <input type="password" name="password" id="password" class="form-control">
                                                      </div>
                                                      <div class="form-group col-md-12">
                                                         <label class="form-label" for="rpass">Répéter le mot de passe: <span class="text-danger">*</span></label>
                                                         <input type="password" name="password_confirmation2" id="password_confirmation2" class="form-control" >
                                                      </div>
                                                      @if(count($us->operators)==0)
                                                            <div class="form-group col-md-12">
                                                               <label class="form-label" for="rpass">Nom: <span class="text-danger">*</span></label>
                                                               <input type="text" name="nom_op_update" id="nom_op_update" class="form-control" >
                                                            </div>
                                                            <div class="form-group col-md-12">
                                                               <label class="form-label" for="rpass">Prenom: <span class="text-danger">*</span></label>
                                                               <input type="text" name="prenom_op_update" id="prenom_op_update" class="form-control" >
                                                            </div>
                                                            <div class="form-group col-md-12">
                                                               <label class="form-label" for="rpass">Téléphone: <span class="text-danger">*</span></label>
                                                               <input type="text" name="phone" id="phone" class="form-control">
                                                            </div>
                                                      @else
                                                         @foreach ($us->operators as $operator)
                                                            <div class="form-group col-md-12">
                                                               <label class="form-label" for="rpass">Nom: <span class="text-danger">*</span></label>
                                                               <input type="text" name="nom_op_update" id="nom_op_update" class="form-control" value="{{$operator->first_name}}">
                                                            </div>
                                                            <div class="form-group col-md-12">
                                                               <label class="form-label" for="rpass">Prenom: <span class="text-danger">*</span></label>
                                                               <input type="text" name="prenom_op_update" id="prenom_op_update" class="form-control" value="{{$operator->last_name}}">
                                                            </div>
                                                            <div class="form-group col-md-12">
                                                               <label class="form-label" for="rpass">Téléphone: <span class="text-danger">*</span></label>
                                                               <input type="text" name="phone" id="phone" class="form-control" value="{{$operator->phone}}">
                                                            </div>

                                                         @endforeach
                                                      @endif
                                                         @foreach ($us->role_users as $role)
                                                            <div class="form-group col-md-12">
                                                               <select class="form-select form-select-sm" aria-label=".form-select-sm example" onchange="onselectRole(event,{{$us->id}})" style="width: 100%;text-align: center;height: 42px;" name="role_user_update" id="role_user_update">
                                                                     <option selected value="{{$role->role->id}}">{{$role->role->nomRole}} </option>
                                                                     @foreach ($roles as $item)
                                                                        @if ($item->id != $role->role_id )
                                                                           <option value="{{$item->id}}">{{$item->nomRole}}</option>
                                                                        @endif
                                                                     @endforeach
                                                               </select>
                                                            </div>
                                                         @endforeach

                                                         <div id="div_for_conseiller_update{{$us->id}}" @if ($us->role_users->contains('role_id', 3)) style="display: block;" @else style="display: none;" @endif>
                                                            <label id="label_che" class="form-label">Choisissez les types de contrat qui peuvent être saisis:</label>
                                                            @foreach ($companys as $item)
                                                               @php
                                                                  $isChecked = false;
                                                                  foreach ($us->operator_access as $acces) {
                                                                        if ($item->id == $acces->company_id ) {
                                                                           $isChecked = true;
                                                                           break;
                                                                        }
                                                                  }
                                                               @endphp
                                                      
                                                               <div class="form-check form-switch">
                                                                  <input class="form-check-input" type="checkbox" id="affect2[]" name="affect2[]" value="{{$item->id}}" {{ $isChecked ? 'checked' : '' }}>
                                                                  <label class="form-check-label" for="{{$item->name}}">{{$item->name}}</label>
                                                               </div>
                                                            @endforeach
                                                      </div>
                                                      <button type="submit" class="btn btn-warning">Valider</button>

                                                      </form>

                                                   </div>
                                                   {{-- <div class="modal-footer">
                                                      <button type="submit" class="btn btn-warning">Valider</button>
                                                   </div> --}}
                                                </div>
                                             </div>
                                       </div>
                                       <a class="btn btn-sm btn-icon btn-danger" style="" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit" href="#">
                                          <span class="btn-inner">
                                             <form action="{{route('deleteUser',$us->id)}}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                   <button style=" background-color: Transparent;
                                                      background-repeat:no-repeat;
                                                      border: none;
                                                      cursor:pointer;
                                                      overflow: hidden;
                                                      outline:none;
                                                      color: white" class="btn btn-danger btn-sm " id="btn_edit_user" >
                                                         <svg width="15" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="currentColor">
                                                            <path d="M19.3248 9.46826C19.3248 9.46826 18.7818 16.2033 18.4668 19.0403C18.3168 20.3953 17.4798 21.1893 16.1088 21.2143C13.4998 21.2613 10.8878 21.2643 8.27979 21.2093C6.96079 21.1823 6.13779 20.3783 5.99079 19.0473C5.67379 16.1853 5.13379 9.46826 5.13379 9.46826" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path d="M20.708 6.23975H3.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path d="M17.4406 6.23973C16.6556 6.23973 15.9796 5.68473 15.8256 4.91573L15.5826 3.69973C15.4326 3.13873 14.9246 2.75073 14.3456 2.75073H10.1126C9.53358 2.75073 9.02558 3.13873 8.87558 3.69973L8.63258 4.91573C8.47858 5.68473 7.80258 6.23973 7.01758 6.23973" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            </svg>
                                                      </button>
                                                   </form>

                                          </span>
                                       </a>
                                 </div>
                              </td>
                           </tr>
                        @endforeach
                        </tbody>
                     </table>
                  </div>
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
   
   <script>
      $(document).ready(function(){
         var nom_op='';
         var prenom_op='';
         var phone_conseiller='';
         var username='';
         var email='';
         var password='';
         var password_confirmation='';

      });
      // $("#days_normal option:selected").val()==""
      $("#add_user").click(function(){  
         nom_op=$("#nom_op").val();
         prenom_op=$("#prenom_op").val();
         phone_conseiller=$("#phone_conseiller").val();
         username=$("#username").val();
         email=$("#email").val();
         password=$("#password").val();

         password_confirmation=$("#password_confirmation").val();
         if(!nom_op || !prenom_op || !phone_conseiller || !username || !password_confirmation || !email || !password){
         
            Swal.fire({
               title: 'Error!',
               text: "Merci de saisir les champs obligatoires",
               icon: 'error',
               confirmButtonText: 'Ok'
            });
            return false;

         }
         if (!validateEmail(email)) {
            Swal.fire({
               title: 'Error!',
               text: "Erreur Email",
               icon: 'error',
               confirmButtonText: 'Ok'
            });
            return false;
            
         }
         if (!validatePhone(phone_conseiller)) {
            Swal.fire({
               title: 'Error!',
               text: "Erreur Téléphone",
               icon: 'error',
               confirmButtonText: 'Ok'
            });
            return false;
         }
         if (!validatePassword(password,password_confirmation)) {
            Swal.fire({
               title: 'Error!',
               text: "Mot de passe non identique",
               icon: 'error',
               confirmButtonText: 'Ok'
            });
            return false;
            
         }

      })

      // function deblockUser(params) {
      //    var formData1=[];
      //    formData1 = formData1.concat([
      //          {
      //             name: "id",
      //             value: params
      //          }   
      //    ]);
      //    console.log(params);
      //    $.ajax({
      //       headers: {
      //          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      //       },
      //       type: 'POST',
      //       url: '/deblock/'+params,
      //       data: formData1,
      //       dataType: 'JSON',
      //       success: function(result) {
      //       }
      //    });
         
      // }



   function s(event) {
      
      idRole=event.target.value;
      
      if (idRole=='3') {
         var element = document.getElementById("div_for_conseiller");
         element.removeAttribute("hidden");   
      }else if (idRole=='1') {
         var element2 = document.getElementById("div_for_conseiller");
         element2.setAttribute("hidden", "hidden");
      } else {
         var element = document.getElementById("div_for_conseiller");
         element.setAttribute("hidden", "hidden");
         var element2 = document.getElementById("div_for_operateur");
         element2.setAttribute("hidden", "hidden");
      }
      
   }

      


   function onselectRole(event, userId) {
        const selectedRoleId = event.target.value;
        const divForConseillerUpdate = document.getElementById(`div_for_conseiller_update${userId}`);
        if (selectedRoleId === '3') {
            divForConseillerUpdate.style.display = 'block';
        } else {
            divForConseillerUpdate.style.display = 'none';
        }
    }
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

   const validatePassword = (password,password2) => {
      if(password===password2)
         return true;

      return false;
   };

</script>