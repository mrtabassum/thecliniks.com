@extends('fronts.layouts.app')
@section('front-title')
    {{ __('messages.web.medical_nijjat') }}
@endsection
@section('front-content')
    @php
        $styleCss = 'style';
    @endphp
    <div class="page-content bg-white">
        <!-- Inner Banner -->
        <div class="banner-wraper">
            <div class="page-banner" {{$styleCss}}="background-image:url({{'assets/front/images/banner/nijjat-banner.png'}});">
            <div class="container">
                <div class="page-banner-entry text-center">
                    <h1>{{ __('messages.web.medical_nijjat') }}</h1>
                    <!-- Breadcrumb row -->
                    <nav aria-label="breadcrumb" class="breadcrumb-row">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('medical') }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24"
                                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                         stroke-linejoin="round" class="feather feather-home">
                                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                        <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                    </svg> {{ __('messages.web.home') }}</a></li>
                            <li class="breadcrumb-item active"
                                aria-current="page">{{ __('messages.web.medical_nijjat') }}</li>
                        </ul>
                    </nav>
                </div>
            </div>
            <img class="pt-img1 animate-wave" src="{{asset('assets/front/images/shap/wave-blue.png')}}" alt="">
            <img class="pt-img2 animate2" src="{{asset('assets/front/images/shap/circle-dots.png')}}" alt="">
            <img class="pt-img3 animate-rotate" src="{{asset('assets/front/images/shap/plus-blue.png')}}" alt="">
        </div>
        <!-- Breadcrumb row END -->
    </div>
    <!-- Inner Banner end -->

    <!-- About us -->
    <section class="section-sp1 about-area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-30">
                  
                   <img class="about-thumb1" src="{{ asset('assets/front/images/nijjat/complaint.jpeg') }}" alt="">
                 
                </div>
                <div class="col-lg-6 mb-30">
                   
                   
                <img class="about-thumb1" src="{{ asset('assets/front/images/nijjat/fees.jpeg') }}" alt="">
                    
                </div>
            </div>

        </div>
        <div class="container">
      
          <img  src="{{ asset('assets/front/images/nijjat/article.jpeg') }}" alt="">

        </div>
        <img class="pt-img1 animate-wave" src="{{asset('assets/front/images/shap/wave-orange.png')}}" alt="">
        <img class="pt-img2 animate2" src="{{asset('assets/front/images/shap/circle-small-blue.png')}}" alt="">
        <img class="pt-img3 animate-rotate" src="{{asset('assets/front/images/shap/line-circle-blue.png')}}" alt="">
        <img class="pt-img4 animate-wave" src="{{asset('assets/front/images/shap/square-dots-orange.png')}}" alt="">
        <img class="pt-img5 animate2" src="{{asset('assets/front/images/shap/square-blue.png')}}" alt="">
    </section>



    <!-- Team -->
    <section class="section-area section-sp3 team-wraper">
        <div class="container">
            <div class="heading-bx text-center">
                <h6 class="title-ext text-secondary">{{__('messages.web.our_doctor')}}</h6>
                <h2 class="title">{{__('messages.web.Meet_best_doctors')}}</h2>
            </div>
            <div class="row justify-content-center">
                @foreach($doctors as $doctor)
                    <div class="col-lg-4 col-sm-6 mb-30">
                        <div class="team-member h-100 d-flex flex-column">
                            <div class="team-media">
                                <img src="{{ $doctor->user->profile_image }}" class="object-cover" alt="">
                            </div>
                            <div class="team-info">
                                <div class="team-info-comntent">
                                <h4 class="title">{{ $doctor->user->full_name }}</h4>
                                <span class="text-secondary">{{ $doctor->specializations->first()->name }}</span>
                            </div>
                            <ul class="social-media mb-3">
                                @if(!empty($doctor->twitter_url))
                                    <li>
                                        <a target="_blank" href="{{ $doctor->twitter_url }}"><i
                                                    class="fab fa-twitter"></i></a>
                                    </li>
                                @endif
                                @if(!empty($doctor->linkedin_url))
                                    <li>
                                        <a target="_blank" href="{{ $doctor->linkedin_url }}"><i
                                                    class="fab fa-linkedin"></i></a>
                                    </li>
                                @endif
                                @if(!empty($doctor->instagram_url))
                                    <li>
                                        <a target="_blank" href="{{ $doctor->instagram_url }}"><i
                                                    class="fab fa-instagram"></i></a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                        <div class="mt-auto">
                            <a href="{{ route('doctorBookAppointment',$doctor->id) }}"
                               class="about-appointment-btn btn btn-primary shadow d-xl-inline-block d-sm-flex d-inline-block align-items-center justify-content-between ps-sm-3 ps-2 py-1 pe-1">
                                <span>{{ __('messages.web.book_an_appointment') }}</span>
                                <i class="btn-icon-bx fas fa-chevron-right my-0 ms-1 me-0"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <img class="pt-img1 animate1" src="{{asset('assets/front/images/shap/trangle-orange.png')}}" alt="">
        <img class="pt-img2 animate2" src="{{asset('assets/front/images/shap/square-dots-orange.png')}}" alt="">
        <img class="pt-img3 animate-rotate" src="{{asset('assets/front/images/shap/line-circle-blue.png')}}" alt="">
        <img class="pt-img4 animate-wave" src="{{asset('assets/front/images/shap/wave-blue.png')}}" alt="">
        <img class="pt-img5 animate-wave" src="{{asset('assets/front/images/shap/circle-dots.png')}}" alt="">
    </section>

</div>
@endsection
@section('front-js')
    <script src="{{ asset('assets/front/vendor/counter/counterup.min.js') }}"></script>
    <script src="{{ asset('assets/front/vendor/counter/waypoints-min.js') }}"></script>
@endsection
