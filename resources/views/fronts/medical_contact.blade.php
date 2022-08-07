@extends('fronts.layouts.app')
@section('front-title')
    {{ __('messages.web.medical_contact') }}
@endsection
@section('front-css')
    <link rel="stylesheet" href="{{asset('assets/css/plugins/flatpickr.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/intl/css/intlTelInput.css') }}">
@endsection
@section('front-content')
    @php
        $styleCss = 'style';
    @endphp
    <div class="page-content bg-white">

        <!-- Inner Banner -->
        <div class="banner-wraper">
            <div class="page-banner banner-lg contact-banner" {{$styleCss}}="
            background-image:url({{'assets/front/images/banner/img1.jpg'}});">
            <div class="container">
                <div class="page-banner-entry text-center">
                    <h1>{{ __('messages.web.contact_us') }}</h1>
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
                                aria-current="page">{{ __('messages.web.contact_us') }}</li>
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
    <section class="">
        <div class="container">
            <div class="contact-wraper">
                <div class="row">
                    <div class="col-lg-6 mb-30">
                        <form id="enquiryForm" action="{{ route('enquiries.store') }}" class="form-wraper contact-form ajax-form">
                            @csrf
                            <div class="ajax-message"></div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    {{ Form::text('name',old('name'), ['class' => 'form-control','id'=>'name', 'placeholder' => 'Your Name','required']) }}
                                </div>
                                <div class="form-group col-md-6">
                                    {{ Form::email('email', old('email'), ['class' => 'form-control', 'id' => 'email','placeholder' => 'Email','required']) }}
                                </div>
                                <div class="form-group col-md-12 phone-number">
                                    {{ Form::tel('phone', null,['class' => 'form-control','placeholder' => 'Phone Number','onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")', 'id' => 'phoneNumber']) }}
                                    {{ Form::hidden('region_code',null,['id'=>'prefix_code']) }}
                                    <span id="valid-msg" class="hide">✓ &nbsp; Valid</span>
                                    <span id="error-msg" class="hide"></span>
                                </div>
                                <div class="form-group col-md-12">
                                    {{ Form::text('subject', null, ['class' => 'form-control', 'id' => 'subject','placeholder' => 'Subject','required','maxlength'=>'121']) }}
                                </div>
                                <div class="form-group col-md-12">
                                    {{ Form::textarea('message', null, ['class' => 'form-control', 'id' => 'message','placeholder' => 'Type Message','required']) }}
                                </div>
                                <div class="form-group col-md-12">
                                    <div class="input-group">
                                        <div class="g-recaptcha"
                                             data-sitekey="{{ config('app.google_recaptcha_site_key') }}"
                                             data-callback="verifyRecaptchaCallback"
                                             data-expired-callback="expiredRecaptchaCallback"></div>
                                        <input class="form-control d-none" {{$styleCss}}="display:none;" name="
                                        gre_captcha" data-recaptcha="true" data-error="Please complete the Captcha">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    {{ Form::button(__('messages.web.send_message'),['type'=>'submit','class' => 'btn w-100 btn-secondary btn-lg','id'=>'submitBtn']) }}
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-6 mb-30">
                        <div class="contact-info ovpr-dark" {{$styleCss}}="
                        background-image: url({{'assets/front/images/about/pic-1.jpg'}});">
                        <div class="info-inner">
                            <h4 class="title mb-30">{{__('messages.web.contact_us_for_any_information')}}</h4>
                            <div class="icon-box">
                                <h6 class="title"><i class="ti-map-alt"></i>{{__('messages.web.location')}}</h6>
                                <p>{{ getSettingValue('address_one') }}</p>
                            </div>
                            <div class="icon-box">
                                <h6 class="title"><i class="ti-id-badge"></i>{{__('messages.web.email')}}
                                    &amp; {{__('messages.web.phone')}}</h6>
                                <a href="mailto:{{getSettingValue('email')}}"
                                   class="text-white">{{ getSettingValue('email') }}</a><br>
                                <a href="tel:+{{ getSettingValue('region_code') }} {{ getSettingValue('contact_no') }}"
                                   class="text-white">+{{ getSettingValue('region_code') }} {{ getSettingValue('contact_no') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
    <!-- About us -->
    <section class="section-area section-sp1">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-30">
                    <div class="feature-container feature-bx4 feature4 h-100">
                        <div class="icon-md feature-icon">
                            <img src="{{asset('assets/front/images/icon/icon1.png')}}" alt="">
                        </div>
                        <div class="icon-content">
                            <h5 class="ttr-title">{{__('messages.user.contact_number')}}</h5>
                            <a href="tel:+{{ getSettingValue('region_code') }} {{ getSettingValue('contact_no') }}"
                            {{ $styleCss }}="color: #444444">
                            +{{ getSettingValue('region_code') }} {{ getSettingValue('contact_no') }}</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-30">
                    <div class="feature-container feature-bx4 feature3 h-100">
                        <div class="icon-md feature-icon">
                            <img src="{{asset('assets/front/images/icon/icon3.png')}}" alt="">
                        </div>
                        <div class="icon-content">
                            <h5 class="ttr-title">{{__('messages.web.email_address')}}</h5>
                            <a href="mailto:{{getSettingValue('email')}}"
                            {{ $styleCss }}="color: #444444">{{ getSettingValue('email') }}</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-30">
                    <div class="feature-container feature-bx4 feature2 h-100">
                        <div class="icon-md feature-icon">
                            <img src="{{asset('assets/front/images/icon/icon2.png')}}" alt="">
                        </div>
                        <div class="icon-content">
                            <h5 class="ttr-title">{{__('messages.setting.address')}}</h5>
                            <p>{{ getSettingValue('address_one') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    </div>
@endsection
@section('front-js')
    <script src="{{ asset('assets/js/intl/js/intlTelInput.min.js') }}"></script>
    <script src="{{ asset('assets/js/intl/js/utils.min.js') }}"></script>
    <script>
        let utilsScript = "{{asset('assets/js/intl/js/utils.min.js')}}";
        let phoneNo = "{{ old('region_code').old('phone') }}";
        let isEdit = false;
    </script>
    <script src="{{ asset('assets/js/custom/phone-number-country-code.js') }}"></script>
    <script src="{{ asset('web/js/google-recaptcha/api.js') }}"></script>
@endsection
