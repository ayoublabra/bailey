<meta name="csrf-token" content="{{ csrf_token() }}">
<style>
   .sign-bg {
      width: 100% !important;
      max-width: 300px !important; /* adjust this value as needed */
      margin: 0 auto !important;
      text-align: center !important;
   }
</style>
<x-guest-layout>
   <section class="login-content">
      <div class="row m-0 align-items-center bg-white vh-100">
         <div class="col-md-6">
            <div class="row justify-content-center">
               <div class="col-md-10">
                  <div class="card card-transparent shadow-none d-flex justify-content-center mb-0 auth-card">
                     <div class="card-body">
                        <a href="#" class="navbar-brand d-flex align-items-center mb-3">

                           <!-- <h4 class="logo-title ms-3">Plateforme de digitalisation Bailey Assurances</h4> -->
                        </a>
                        <!-- <h2 class="mb-2 text-center">Se connecter</h2> -->
                        <p class="text-center logo-title ms-3 text-uppercase text-dark" style="margin-top: 33px;"><strong>Espace - toile de com</strong></p>
                        <p class="text-center mb-5">Se connecter</p>
                        <x-auth-session-status class="mb-4" :status="session('status')" />

                        <!-- Validation Errors -->
                        <x-auth-validation-errors class="mb-4" :errors="$errors" />
                        <form method="POST" action="{{ route('auth.doLogin') }}">
								   @csrf
                           <div class="row">
                              <div class="col-lg-12">
                                 <div class="form-group">
                                    <label for="password" class="form-label">Veuillez renseigner votre Code</label>
                                    <input class="form-control" type="password" placeholder="_ _ _ _ _ _ _ _ _ _"  name="password"  required >
                                 </div> 
                              </div>
                            
                           </div>
                           <br>
                           <div class="d-flex justify-content-center">
                              <button type="submit" class="btn btn-primary">Connexion</button>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-md-6 d-md-block d-none bg-primary p-0 mt-n1 vh-100 overflow-hidden">
            <img src="{{asset('images/auth/01.png')}}" class="img-fluid gradient-main animated-scaleX" alt="images">
         </div>
      </div>

      
   </section>
</x-guest-layout>
