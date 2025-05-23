<nav class="nav navbar navbar-expand-lg navbar-light iq-navbar">
  <div class="container-fluid navbar-inner">
    <a href="{{route('dashboard')}}" class="navbar-brand">
      <img src="{{ asset('images/pages/bailey.png') }}" alt="logo" class="logo" width="200">
    </a>
    <div class="sidebar-toggle" data-toggle="sidebar" data-active="true">
      <i class="icon">
        <svg width="20px" height="20px" viewBox="0 0 24 24">
          <path fill="currentColor" d="M4,11V13H16L10.5,18.5L11.92,19.92L19.84,12L11.92,4.08L10.5,5.5L16,11H4Z" />
      </svg>
      </i>
    </div>
    <div class="input-group search-input">
      <span class="input-group-text" id="search-input">
        <svg width="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <circle cx="11.7669" cy="11.7666" r="8.98856" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></circle>
          <path d="M18.0186 18.4851L21.5426 22" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
        </svg>
      </span>
      <input type="search" class="form-control" placeholder="Search...">
    </div>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
      <span class="navbar-toggler-icon">
        <span class="navbar-toggler-bar bar1 mt-2"></span>
        <span class="navbar-toggler-bar bar2"></span>
        <span class="navbar-toggler-bar bar3"></span>
      </span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto  navbar-list mb-2 mb-lg-0">  
        <li class="nav-item dropdown">
          <a class="nav-link py-0 d-flex align-items-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            @auth
              <?php
              $username = auth()->user()->username;
              $firstLetter = strtoupper(substr($username, 0, 1));
              ?>
              <div class="theme-color-default-img avatar avatar-50 avatar-rounded" style="background-color: #eaeaea; text-align: center; line-height: 50px; font-size: 20px;">
                  {{ $firstLetter }}
              </div>
            @endauth
          <!-- <img src="{{asset('images/avatars/01.png')}}" alt="User-Profile" class="theme-color-default-img img-fluid avatar avatar-50 avatar-rounded">
          <img src="{{asset('images/avatars/avtar_1.png')}}" alt="User-Profile" class="theme-color-purple-img img-fluid avatar avatar-50 avatar-rounded">
          <img src="{{asset('images/avatars/avtar_2.png')}}" alt="User-Profile" class="theme-color-blue-img img-fluid avatar avatar-50 avatar-rounded">
          <img src="{{asset('images/avatars/avtar_4.png')}}" alt="User-Profile" class="theme-color-green-img img-fluid avatar avatar-50 avatar-rounded">
          <img src="{{asset('images/avatars/avtar_5.png')}}" alt="User-Profile" class="theme-color-yellow-img img-fluid avatar avatar-50 avatar-rounded">
          <img src="{{asset('images/avatars/avtar_3.png')}}" alt="User-Profile" class="theme-color-pink-img img-fluid avatar avatar-50 avatar-rounded"> -->
            <div class="caption ms-3 d-none d-md-block ">
              <h6 class="mb-0 caption-title">{{ auth()->user()->username ?? ''  }}</h6>
            </div>
          </a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
            <li><hr class="dropdown-divider"></li>
            <li>
              <form method="POST" action="{{route('logout')}}">
                @csrf
                <a href="javascript:void(0)" class="dropdown-item"
                  onclick="event.preventDefault();
                this.closest('form').submit();">
                    {{ __('Se déconnecter') }}
                </a>
              </form>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>


