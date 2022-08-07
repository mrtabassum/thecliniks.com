@extends('fronts.layouts.app')
@section('front-title')
    {{ __('messages.web.medical_appointment') }}
@endsection
@section('front-css')
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-datepicker/bootstrap-datepicker.css') }}">
@endsection
@section('front-content')
    @php
        $styleCss = 'style';
    @endphp
    <div class="page-content bg-white">

        <!-- Inner Banner -->
        <div class="banner-wraper">
            <div class="page-banner"
            {{$styleCss}}="background-image:url('{{ asset('assets/front/images/banner/img1.jpg') }}');">
            <div class="container">
                <div class="page-banner-entry text-center">
                    <h1 class="medical-heading">{{ __('messages.web.book_appointment') }}</h1>
                    <!-- Breadcrumb row -->
                    <nav aria-label="breadcrumb" class="breadcrumb-row">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                                         viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                         stroke-linecap="round" stroke-linejoin="round"
                                         class="feather feather-home">
                                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                        <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                    </svg>
                                    {{ __('messages.web.home') }}</a></li>
                                <li class="breadcrumb-item active"
                                    aria-current="page">{{ __('messages.web.book_appointment') }}</li>
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
        <!-- Appointment -->
        <section class="section-area section-sp2 appointment-wraper">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="appointment-form form-wraper">
                            <h3 class="title m-0">{{ __('messages.web.book_appointment') }}</h3>
                            @include('fronts.common.book_appointment')
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
