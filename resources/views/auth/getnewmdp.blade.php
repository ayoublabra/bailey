<!-- @if(session()->has('message'))
    <div class="alert alert-success" style="z-index:10;">
        {{ session()->get('message') }}
    </div>
@endif -->
<?php
   $success = session()->get('success');
   $msg = session()->get('message');
?>
<meta name="csrf-token" content="{{ csrf_token() }}">
<x-guest-layout>
   <section class="login-content">
      <div class="row m-0 align-items-center bg-white vh-100">
         <div class="sign-bg sign-bg-right">
            <a href="{{route('dashboard')}}" class="navbar-brand d-flex align-items-center mb-3">
               <img src="{{ asset('images/pages/bailey.png') }}" alt="logo" class="logo"  width="240">
            </a>
         </div>
         <div class="col-md-6 p-0">               
            <div class="card card-transparent auth-card shadow-none d-flex justify-content-center mb-0">
               <div class="card-body">
                  <!-- <a href="{{route('dashboard')}}" class="navbar-brand d-flex align-items-center mb-3">

                     <h4 class="logo-title ms-3">{{env('APP_NAME')}}</h4>
                  </a> -->
                  <h2 class="mb-2">Récupérer le mot de passe</h2>
                  <x-auth-validation-errors class="mb-4" :errors="$errors" />
                  <form method="POST" action="{{ route('generatepass') }}" enctype="multipart/form-data"> 
                     @csrf
                     <div class="row">
                        <div class="col-lg-12">
                           <div class="floating-label form-group">
                              <label for="email" class="form-label">Email</label>
                              <!-- <input type="hidden" class="form-control" id="email" name="email" aria-describedby="email" placeholder=" "> -->
                              <input type="email" class="form-control" id="email" name="email" aria-describedby="email" placeholder=" ">
                           </div>
                        </div>
                     </div>

                     <div class="row">
                        <div class="col-lg-12">
                           <div class="floating-label form-group">
                              <label for="mdp" class="form-label">Nouveau mot de passe</label>
                              <!-- <input type="hidden" class="form-control" id="email" name="email" aria-describedby="newpass" placeholder=" "> -->
                              <input type="text" class="form-control" id="mdp" name="mdp" aria-describedby="mdp" placeholder=" ">
                           </div>
                        </div>
                     </div>

                     <div class="row">
                        <div class="col-lg-12">
                           <div class="floating-label form-group">
                              <label for="confirmpass" class="form-label">Vérifier le mot de passe</label>
                              <!-- <input type="hidden" class="form-control" id="email" name="email" aria-describedby="confirmpass" placeholder=" "> -->
                              <input type="text" class="form-control" id="confirmpass" name="confirmpass" aria-describedby="confirmpass" placeholder=" ">
                           </div>
                        </div>
                     </div>
                     <button type="submit" class="btn btn-primary btn-block">  {{ __('Sauvegarder') }}</button>
                  </form>
               </div>
            </div>               

         </div>

         <div class="col-md-6 d-md-block d-none bg-primary p-0 mt-n1 vh-100 overflow-hidden">
            <img src="{{asset('images/auth/02.png')}}" class="img-fluid gradient-main animated-scaleX" alt="images">
         </div>
      </div>
   </section>
</x-guest-layout>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script> 
   var success=message="";

   var success = <?php echo json_encode($success); ?>;
   var message = <?php echo json_encode($msg); ?>;

   if(success!=null){
      if(success){
         Swal.fire({
            title: 'success!',
            text: message,
            icon: 'success',
            confirmButtonText: 'Ok'
         }).then(function() {
            window.location.href="/login";
         });
         
      }else{
         Swal.fire({
            title: 'Error!',
            text: message,
            icon: 'error',
            confirmButtonText: 'Ok'
         });
      }
   }
   
</script>