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
                        <p class="text-center logo-title ms-3 text-uppercase text-dark" style="margin-top: 33px;"><strong>Plateforme de digitalisation Bailey Assurances</strong></p>
                        <p class="text-center">Se connecter</p>
                        <x-auth-session-status class="mb-4" :status="session('status')" />

                        <!-- Validation Errors -->
                        <x-auth-validation-errors class="mb-4" :errors="$errors" />
                        <form method="POST" action="{{ route('login') }}" data-toggle="validator">
								   @csrf
                           <div class="row">
                              <div class="col-lg-12">
                                 <div class="form-group">
                                    <label for="username" class="form-label">Login</label>
                                    <input id="username" type="text" name="username"  value="{{env('IS_DEMO') ? 'login' : old('username')}}"   class="form-control"  placeholder="nom" required autofocus>
                                 </div>
                              </div>
                              <div class="col-lg-12">
                                 <div class="form-group">
                                    <label for="password" class="form-label">Mot de passe</label>
                                    <input class="form-control" type="password" placeholder="********"  name="password" value="{{ env('IS_DEMO') ? 'password' : '' }}" required autocomplete="current-password">
                                 </div>
                              </div>
                              <div class="col-lg-6">
                                 <div class="form-check mb-3">
                                    <input type="checkbox" class="form-check-input" id="customCheck1">
                                    <!-- <input type="checkbox" class="custom-control-input" id="customCheck1"> -->
                                    <label class="form-check-label" for="customCheck1">Se souvenir de moi</label>
                                 </div>
                              </div>
                              <div class="col-lg-6">
                                 <a href="{{route('auth.recoverpw')}}"  class="float-end">Mot de passe oublié?</a>
                              </div>
                           </div>
                           <br>
                           <div class="d-flex justify-content-center">
                              <button type="submit" class="btn btn-primary">{{ __('Connexion') }}</button>
                           </div>
               
                           <!-- <p class="mt-3 text-center">
                              Don’t have an account? <a href="{{route('auth.signup')}}" class="text-underline">Click here to sign up.</a>
                           </p> -->
                        </form>
                     </div>
                  </div>
               </div>
            </div>
            <!-- <div class="sign-bg">
               <a href="{{route('dashboard')}}" class="navbar-brand d-flex align-items-center mb-3">
                  <img src="{{ asset('images/pages/bailey.png') }}" alt="logo" class="logo" style="width: 60%;">
               </a>
            </div> -->
         </div>
         <div class="col-md-6 d-md-block d-none bg-primary p-0 mt-n1 vh-100 overflow-hidden">
            <img src="{{asset('images/auth/01.png')}}" class="img-fluid gradient-main animated-scaleX" alt="images">
         </div>
      </div>

      {{-- <div class="row m-0 align-items-center bg-white vh-100">
         <div class="sign-bg">
            <a href="{{route('dashboard')}}" class="navbar-brand d-flex align-items-center mb-3">
               <!-- <img src="{{ asset('images/pages/bailey.png') }}" alt="logo" class="logo" width="240" style="padding: 20px;"> -->
               <img src="{{ asset('images/pages/bailey.png') }}" alt="logo" class="logo" style="width: 70%;margin: 10px;">
            </a>
         </div>
      </div> --}}
   </section>
</x-guest-layout>
