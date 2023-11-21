<x-guest-layout>
<div class="container-fluid p-0">
    <div class="iq-maintenance text-center"> 
        <img src="{{asset('images/error/01.png')}}" class="img-fluid mb-4" alt="">            
        <div class="maintenance-bottom text-white pb-0">
            <div class="bg-primary" style="background: transparent; height: 320px;">
                <div class="gradient-bottom">
                    <div class="bottom-text general-zindex">
                        <h1 class="mb-2 text-white">Hang on! We are under maintenance</h1>
                        <p>It will not take a long time till we get the error fiked. We wii live again in</p>
                        <ul class="countdown d-flex justify-content-center align-items-center list-inline" data-date="Feb 02 2022 20:20:22">
                            <li>
                                <span data-days>0</span>Days
                            </li>
                            <li>
                                <span data-hours>0</span>Hours
                            </li>
                            <li>
                                <span data-minutes>0</span>Minutes
                            </li>
                            <li>
                                <span data-seconds>0</span>Seconds
                            </li>
                        </ul>
                        <div class="w-50 mx-auto mt-2">
                            <div class="input-group search-input search-input">
                                <input type="text" class="form-control" placeholder="Enter your mail">
                                <a href="#" class="btn bg-white text-primary ms-2 rounded">Notify Me</a>
                            </div>
                        </div>
                    </div>
                    <div class="c xl-circle">
                        <div class="c lg-circle">
                            <div class="c md-circle">
                            <div class="c sm-circle">
                                <div class="c xs-circle"></div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        </div>            
    </div>
    <div class="sign-bg">
        <a href="{{route('dashboard')}}" class="navbar-brand d-flex align-items-center mb-3">
            <img src="{{ asset('images/pages/bailey.png') }}" alt="logo" class="logo"  width="240">
        </a>
    </div>
</div>
</x-guest-layout>


<script src="{{asset('js/countdown.js')}}"></script>