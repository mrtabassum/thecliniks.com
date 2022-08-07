@extends('fronts.layouts.app')
@section('front-title')
    {{ __('messages.faqs') }}
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
                    <h1>{{ __('messages.web.faqs') }}</h1>
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
                                aria-current="page">{{ __('messages.web.faqs') }}</li>
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
        <section class="section-sp3">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="accordion ttr-accordion1" id="accordionRow1">
                            @foreach($faqs as $key => $faq)
                                @if($loop->odd)
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="heading{{$loop->index +1 }}">
                                            <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse"
                                                    data-bs-target="#collapse{{$loop->index +1 }}" aria-expanded="false"
                                                    aria-controls="collapse{{$loop->index +1 }}">{{ $faq->question }}</button>
                                        </h2>
                                        <div id="collapse{{$loop->index +1 }}" class="accordion-collapse collapse"
                                             aria-labelledby="heading{{$loop->index +1 }}"
                                             data-bs-parent="#accordionRow1">
                                            <div class="accordion-body">
                                                <p class="mb-0">{{ $faq->answer }}.</p>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="accordion ttr-accordion1" id="accordionRow2">
                            @foreach($faqs as $key => $faq)
                                @if($loop->even)
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="heading{{$loop->index +1 }}">
                                            <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse"
                                                    data-bs-target="#collapse{{$loop->index +1 }}" aria-expanded="false"
                                                    aria-controls="collapse{{$loop->index +1 }}">{{ $faq->question }}</button>
                                        </h2>
                                        <div id="collapse{{$loop->index +1 }}" class="accordion-collapse collapse"
                                             aria-labelledby="heading{{$loop->index +1 }}"
                                             data-bs-parent="#accordionRow2">
                                            <div class="accordion-body">
                                                <p class="mb-0">{{ $faq->answer }}.</p>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <!-- Blog -->
    <section class="section-area section-sp1 blog-area"
    {{$styleCss}}="background-image: url({{'assets/front/images/background/line-bg2.png'}}); background-position: center; background-size: cover;">
    <img class="pt-img1 animate1" src="{{asset('assets/front/images/shap/trangle-orange.png')}}" alt="">
    <img class="pt-img2 animate2" src="{{asset('assets/front/images/shap/square-dots-orange.png')}}" alt="">
    <img class="pt-img3 animate-rotate" src="{{asset('assets/front/images/shap/line-circle-blue.png')}}" alt="">
    <img class="pt-img4 animate-wave" src="{{asset('assets/front/images/shap/wave-blue.png')}}" alt="">
    </section>
    </div>
@endsection
