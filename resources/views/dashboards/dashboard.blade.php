<x-app-layout :assets="$assets ?? []">
   <input type="hidden" name="_token" value="{{ csrf_token() }}">
   <div class="row">
      <div class="col-md-12 col-lg-12">
         <div class="row row-cols-1">
               <ul  class="swiper-wrapper list-inline m-0 p-0 mb-2" style="display:inline;">
				@php
					$role=null;
					$nomRole=null;
					$userId=Auth::user()->id;
						$roles  = DB::table('bailey_role')
					   ->join('bailey_role_user', 'bailey_role_user.role_id', '=', 'bailey_role.id')
					   ->where('bailey_role_user.user_id', '=', $userId)
					   ->get();
					   foreach ($roles as $role) {
						$nomRole = $role->nomRole;
					   }

				   @endphp
               @if($nomRole=="superadmin" || $nomRole=="conseiller" || $nomRole=="manager")
                  <li class="card card-slide" data-aos="fade-up" data-aos-delay="800">
                     <a class="card-body" href="{{ route('getContract') }}">
                        <div class="progress-widget">
                           <div id="circle-progress-02" class="circle-progress-01 circle-progress circle-progress-info text-center" data-min-value="0" data-max-value="100" data-value="80" data-type="percent">
                              <svg class="card-slie-arrow " width="24" height="24" viewBox="0 0 24 24">
                                 <path fill="currentColor" d="M19,6.41L17.59,5L7,15.59V9H5V19H15V17H8.41L19,6.41Z" />
                              </svg>
                           </div>
                           <div class="progress-detail">
                              <h4 class="counter">NOUVEAU CONTRAT</h4>
                           </div>
                        </div>
                     </a>
                  </li>
               @endif      

                  <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="700">
                     <a class="card-body" href="{{ route('getStates') }}">
                        <div class="progress-widget">
                           <div id="circle-progress-01" class="circle-progress-01 circle-progress circle-progress-primary text-center" data-min-value="0" data-max-value="100" data-value="90" data-type="percent">
                              <svg class="card-slie-arrow " width="24" height="24px" viewBox="0 0 24 24">
                                 <path fill="currentColor" d="M5,17.59L15.59,7H9V5H19V15H17V8.41L6.41,19L5,17.59Z" />
                              </svg>
                           </div>
                           <div class="progress-detail">
                              <h4 class="counter" style="visibility: visible;">ADHESIONS NON FINALISÉES</h4>
                           </div>
                        </div>
                     </a>
                  </li>

                  <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="900">
                     <a class="card-body"  href="{{ route('getSales') }}">
                        <div class="progress-widget">
                           <div id="circle-progress-03" class="circle-progress-01 circle-progress circle-progress-primary text-center" data-min-value="0" data-max-value="100" data-value="70" data-type="percent">
                              <svg class="card-slie-arrow " width="24" viewBox="0 0 24 24">
                                 <path fill="currentColor" d="M19,6.41L17.59,5L7,15.59V9H5V19H15V17H8.41L19,6.41Z" />
                              </svg>
                           </div>
                           <div class="progress-detail">
                              <h4 class="counter">ADHESIONS FINALISÉES</h4>
                           </div>
                        </div>
                     </a>
                  </li>
               </ul>
         </div>
      </div>
   </div>
</x-app-layout>
