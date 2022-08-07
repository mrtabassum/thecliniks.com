@extends('fronts.layouts.app')
@section('front-title')
    {{ __('messages.web.medical') }}
@endsection
@section('front-css')
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-datepicker/bootstrap-datepicker.css') }}">
@endsection
@section('front-content')
    @php
        $styleCss = 'style';
    @endphp
    <div class="page-content bg-white">
        <!-- Main Banner -->
        <div class="main-banner" {{$styleCss}}="background-image:url({{'assets/front/images/main-banner/bg2.png'}});">
        <div class="container inner-content">
            <div class="row align-items-center">
                <div class="col-lg-7 col-md-6 col-sm-7">
                    <h6 class="title-ext text-primary">{{ $sliders->title }}</h6>
                    <h1>{{ $sliders->short_description }}</h1>
                    <p>Powerd by Gurkani Group | APLS | Laals.org</p>
                    <!-- @if(!getLogInUser())
                        <a href="{{ route('register') }}"
                           class="btn btn-secondary btn-lg shadow">{{ __('messages.web.sign_up') }}</a>
                    @endif -->
                </div>
                
                <div class="col-lg-7 col-md-6 col-sm-7">
                
                <a href="http://182.184.69.232/lims/Security/AdminLogin.aspx?" class="btn btn-secondary btn-lg booking-home-button">Online Report </a>

                <a href="http://182.184.69.232/lims/Security/AdminLogin.aspx?" class="btn btn-secondary btn-lg booking-home-button">Franchies </a>



                </div>
            
                 
                
                <div class="col-lg-5 col-md-6 col-sm-5">
                    <div class="banner-img">
                        <img src="{{ $sliders->slider_image }}" alt="">
                    </div>
                </div>
            </div>
        </div>
        <img class="pt-img1 animate1" src="{{ asset('assets/front/images/shap/trangle-orange.png') }}" alt="">
            <img class="pt-img2 animate2" src="{{ asset('assets/front/images/shap/square-blue.png') }}" alt="">
            <img class="pt-img3 animate3" src="{{ asset('assets/front/images/shap/chicle-blue-2.png') }}" alt="">
            <img class="pt-img4 animate4" src="{{ asset('assets/front/images/shap/plus-orange.png') }}" alt="">
            <img class="pt-img5 animate-wave" src="{{ asset('assets/front/images/shap/wave-orange.png') }}" alt="">
        </div>

        <!-- About us -->
    <section class="section-sp1 about-area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-30">
                    <div class="about-thumb-area">
                        <ul>
                            <li><img class="about-thumb1" src="{{ asset('assets/front/images/about/1.png') }}" alt=""></li>
                            <li><img class="about-thumb2" src="{{ asset('assets/front/images/about/2.png') }}" alt=""></li>
                            <li><img class="about-thumb3" src="{{ asset('assets/front/images/about/3.png') }}" alt=""></li>
                            <!-- <li>
                                <div class="exp-bx">{{ $aboutExperience->value }}
                                    <span>{{ __('messages.web.year_experience') }}</span></div>
                            </li> -->
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 mb-30">
                    <div class="heading-bx">
                        <h6 class="title-ext text-secondary">{{ __('messages.web.about_us') }}</h6>
                        <h2 class="title">{{ getSettingValue('about_title') }}</h2>
                        <p>{{ getSettingValue('about_short_description') }}</p>
                    </div>
                        <div class="row">
                            <div class="col-lg-6 col-sm-6 mb-30 mb-sm-20">
                                <div class="feature-container feature-bx1 feature1">
                                    <div class="icon-md">
										<span class="icon-cell">
											<svg enable-background="new 0 0 512 512" height="85" viewBox="0 0 512 512"
                                                 width="85" xmlns="http://www.w3.org/2000/svg">
												<path d="m509.82 327.343-21.991-27.599c-1.896-2.381-4.775-3.768-7.82-3.768h-7.712l-74.353-93.385c-1.897-2.383-4.777-3.771-7.823-3.771h-22.862v-22.765c0-19.014-15.43-34.483-34.396-34.483h-97.678v-4.552c0-28.428-23.127-51.555-51.555-51.555s-51.555 23.127-51.555 51.555v4.552h-97.678c-18.966 0-34.397 15.47-34.397 34.484v251.241c0 5.523 4.478 10 10 10h22.279c4.628 22.794 24.758 39.999 48.815 39.999s44.186-17.205 48.814-39.999h250.37c4.628 22.794 24.757 39.999 48.814 39.999s44.187-17.205 48.815-39.999h24.093c5.522 0 10-4.477 10-10v-93.722c0-2.264-.769-4.461-2.18-6.232zm-124.52-108.523 61.432 77.156h-79.474v-77.156zm-233.226-81.799c0-17.399 14.155-31.555 31.555-31.555s31.555 14.156 31.555 31.555v4.552h-63.109v-4.552zm-132.074 39.035c0-7.986 6.459-14.483 14.397-14.483h298.464c7.938 0 14.396 6.497 14.396 14.483v241.241h-217.35c-4.628-22.794-24.757-39.999-48.814-39.999s-44.187 17.205-48.815 39.999h-12.278zm61.094 281.24c-16.44 0-29.816-13.458-29.816-29.999s13.376-29.999 29.816-29.999 29.815 13.458 29.815 29.999-13.375 29.999-29.815 29.999zm347.998 0c-16.44 0-29.815-13.458-29.815-29.999s13.375-29.999 29.815-29.999 29.816 13.458 29.816 29.999-13.376 29.999-29.816 29.999zm62.908-39.999h-14.093c-4.628-22.794-24.758-39.999-48.815-39.999s-44.186 17.205-48.814 39.999h-13.02v-101.321h107.932l16.81 21.096z"/>
												<path d="m183.629 66.808c5.522 0 10-4.477 10-10v-12.104c0-5.523-4.478-10-10-10s-10 4.477-10 10v12.104c0 5.523 4.477 10 10 10z"/>
												<path d="m236.764 94.969c1.934 1.829 4.404 2.736 6.871 2.736 2.652 0 5.299-1.048 7.266-3.127l10.626-11.229c3.796-4.011 3.621-10.341-.391-14.137s-10.341-3.621-14.137.391l-10.626 11.229c-3.796 4.012-3.621 10.341.391 14.137z"/>
												<path d="m116.358 94.579c1.967 2.078 4.613 3.126 7.266 3.126 2.467 0 4.938-.907 6.871-2.737 4.012-3.796 4.187-10.125.391-14.137l-10.627-11.229c-3.796-4.011-10.126-4.187-14.137-.39-4.012 3.796-4.187 10.125-.391 14.137z"/>
												<path d="m90.896 216.592h184.372v113.287h-184.372z" fill="#b2f0fb"/>
											</svg>
										</span>
                                    </div>
                                    <div class="icon-content">
                                        <h4 class="ttr-title">{{__('messages.web.emergency_help')}}</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-6 mb-30 mb-sm-20">
                                <div class="feature-container feature-bx1 feature2">
                                    <div class="icon-md">
										<span class="icon-cell">
											<svg enable-background="new 0 0 512 512" height="85" viewBox="0 0 512 512"
                                                 width="85" xmlns="http://www.w3.org/2000/svg">
												<path d="m351.524 124.49h-37.907v-37.907h-44.657v37.907h-37.906v44.657h37.906v37.907h44.657v-37.907h37.907z"
                                                      fill="#a4fcc4"/>
												<path d="m291.289 279.415c73.114 0 132.597-59.482 132.597-132.597s-59.483-132.596-132.597-132.596-132.598 59.482-132.598 132.596 59.484 132.597 132.598 132.597zm0-245.193c62.086 0 112.597 50.511 112.597 112.597s-50.511 112.597-112.597 112.597c-62.087 0-112.598-50.511-112.598-112.597s50.511-112.597 112.598-112.597z"/>
												<path d="m502 267.736c-32.668 0-59.245 26.577-59.245 59.245v13.605h-240.266v-19.048c0-23.625-19.221-42.846-42.846-42.846h-90.398v-17.584c0-32.668-26.577-59.245-59.245-59.245-5.522 0-10 4.478-10 10v275.914c0 5.522 4.478 10 10 10h49.245c5.522 0 10-4.478 10-10v-39.327h373.51v39.327c0 5.522 4.478 10 10 10h49.245c5.522 0 10-4.478 10-10v-210.041c0-5.522-4.478-10-10-10zm-342.356 30.957c12.598 0 22.846 10.249 22.846 22.846v19.048h-113.245v-41.894zm-110.399 179.085h-29.245v-254.623c16.812 4.434 29.245 19.77 29.245 37.954zm20-49.327v-67.864h373.51v67.864zm422.755 49.327h-29.245v-150.797c0-18.185 12.434-33.521 29.245-37.954z"/>
											</svg>
										</span>
                                    </div>
                                    <div class="icon-content">
                                        <h4 class="ttr-title">{{__('messages.web.qualified_doctors')}}</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-6 mb-30 mb-sm-20">
                                <div class="feature-container feature-bx1 feature3">
                                    <div class="icon-md">
										<span class="icon-cell">
											<svg enable-background="new 0 0 512 512" height="85" viewBox="0 0 512 512"
                                                 width="85" xmlns="http://www.w3.org/2000/svg">
												<path d="m397.886 191.161c-3.545-4.235-9.852-4.797-14.087-1.252-4.235 3.544-4.797 9.851-1.253 14.086 26.684 31.893 41.165 72.339 40.775 113.888-.886 94.681-79.215 172.782-174.608 174.1-48.125.666-93.326-17.479-127.401-51.087-33.708-33.246-52.272-77.526-52.272-124.685 0-59.98 30.361-115.236 81.216-147.809 51.27-32.838 79.187-66.186 93.348-111.507l2.581-8.26 2.58 8.257c9.333 29.869 25.53 55.364 49.516 77.939 4.02 3.786 10.35 3.593 14.136-.428 3.785-4.021 3.594-10.351-.429-14.136-21.713-20.438-35.736-42.471-44.133-69.341l-12.125-38.802c-1.305-4.175-5.171-7.018-9.545-7.018s-8.24 2.843-9.545 7.018l-12.126 38.807c-12.639 40.45-38.072 70.545-85.045 100.63-56.624 36.268-90.429 97.819-90.429 164.65 0 52.553 20.679 101.891 58.228 138.924 37.248 36.736 86.47 56.867 138.888 56.865.941 0 1.891-.006 2.833-.02 51.527-.712 100.087-21.236 136.733-57.792 36.664-36.573 57.12-84.914 57.6-136.118.432-46.301-15.704-91.371-45.436-126.909z"/>
												<path d="m279.576 280.012v-29.712c0-5.523-4.478-10-10-10h-46.783c-5.522 0-10 4.477-10 10v29.712h-29.711c-5.522 0-10 4.477-10 10v46.783c0 5.523 4.478 10 10 10h29.711v29.711c0 5.523 4.478 10 10 10h46.783c5.522 0 10-4.477 10-10v-29.711h29.712c5.522 0 10-4.477 10-10v-46.783c0-5.523-4.478-10-10-10zm19.712 46.783h-29.712c-5.522 0-10 4.477-10 10v29.711h-26.783v-29.711c0-5.523-4.478-10-10-10h-29.711v-26.783h29.711c5.522 0 10-4.477 10-10v-29.712h26.783v29.712c0 5.523 4.478 10 10 10h29.712z"/>
												<path d="m369.497 246.666c51.239-.708 92.983-42.352 93.459-93.223.313-33.486-16.989-62.983-43.266-79.911-21.598-13.914-37.772-29.46-45.4-53.873l-6.143-19.659-6.143 19.661c-7.603 24.331-23.627 39.927-45.19 53.738-26.16 16.756-43.48 45.945-43.48 79.151 0 52.43 43.18 94.848 96.163 94.116z"
                                                      fill="#ffbdbc"/>
											</svg>
										</span>
                                    </div>
                                    <div class="icon-content">
                                        <h4 class="ttr-title">{{__('messages.web.best_professionals')}}</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-6 mb-30 mb-sm-20">
                                <div class="feature-container feature-bx1 feature4">
                                    <div class="icon-md">
										<span class="icon-cell">
											<svg enable-background="new 0 0 512 512" height="85" viewBox="0 0 512 512"
                                                 width="85" xmlns="http://www.w3.org/2000/svg">
												<path d="m181.049 229.112-76.87 76.971c-14.045 14.07-14.045 36.883 0 50.953l50.881 50.974c14.045 14.07 36.815 14.07 50.86 0l178.611-178.899h-203.482z"
                                                      fill="#e2c4ff"/>
												<path d="m495.277 81.339c-10.57-10.578-24.625-16.403-39.574-16.403-3.325 0-6.605.288-9.813.853 3.065-17.397-2.103-35.975-15.505-49.387-10.57-10.577-24.624-16.402-39.574-16.402s-29.003 5.825-39.573 16.402c-21.816 21.83-21.816 57.352 0 79.182 2.71 2.712 5.648 5.111 8.772 7.18l-18.689 18.716-52.105-52.184c-3.902-3.907-10.233-3.912-14.142-.012-3.908 3.902-3.914 10.234-.011 14.143l18.64 18.67-196.602 196.922c-17.56 17.593-17.902 46.002-1.029 64.017l-16.422 16.452c-3.896 3.903-3.896 10.226 0 14.129l12.383 12.406-88.75 88.913c-3.901 3.909-3.896 10.24.013 14.142 1.953 1.948 4.509 2.922 7.065 2.922 2.562 0 5.125-.979 7.078-2.936l88.724-88.887 12.357 12.38c1.876 1.88 4.422 2.936 7.078 2.936s5.202-1.056 7.078-2.936l16.396-16.426c8.547 8.028 19.644 12.432 31.418 12.432 12.28 0 23.825-4.79 32.506-13.487l196.588-196.91 18.617 18.648c1.953 1.956 4.515 2.935 7.077 2.935 2.557 0 5.113-.975 7.065-2.923 3.908-3.902 3.914-10.234.011-14.143l-52.155-52.24 18.732-18.758c2.054 3.126 4.453 6.09 7.198 8.836 10.57 10.577 24.624 16.402 39.573 16.402s29.003-5.825 39.574-16.402c21.817-21.831 21.817-57.352.001-79.182zm-129.892-50.8c6.792-6.796 15.822-10.539 25.426-10.539s18.635 3.743 25.427 10.539c13.407 13.416 13.997 34.875 1.773 49.001-.638.583-1.266 1.183-1.881 1.799-.616.617-1.214 1.245-1.795 1.882-6.533 5.671-14.791 8.766-23.524 8.766-9.604 0-18.634-3.743-25.427-10.54-14.025-14.035-14.025-36.873.001-50.908zm-239.787 380.799-24.74-24.786 9.327-9.344 14.287 14.313 10.454 10.473zm73.244-10.392c-4.903 4.912-11.42 7.617-18.352 7.617s-13.449-2.705-18.353-7.617l-50.881-50.975c-10.134-10.152-10.134-26.672-.001-36.823l196.578-196.898 87.616 87.767zm177.227-244.657-20.619-20.654 24.634-24.669c3.498.676 7.086 1.021 10.727 1.021 3.325 0 6.606-.288 9.813-.853-1.189 6.75-1.139 13.678.151 20.413zm105.062-9.905c-6.792 6.796-15.823 10.539-25.427 10.539s-18.635-3.743-25.427-10.539c-13.407-13.416-13.998-34.875-1.773-49.001.638-.583 1.266-1.183 1.881-1.799.617-.617 1.215-1.246 1.797-1.884 6.532-5.67 14.789-8.764 23.521-8.764 9.604 0 18.635 3.743 25.427 10.54 14.026 14.035 14.026 36.873.001 50.908z"
                                                      fill="#020288"/>
											</svg>
										</span>
                                    </div>
                                    <div class="icon-content">
                                        <h4 class="ttr-title">{{__('messages.web.medical_treatment')}}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <a href="{{ route('medicalContact') }}"
                       class="btn btn-primary shadow">{{__('messages.web.contact_us')}}</a>
                </div>
            </div>
        </div>
        <img class="pt-img1 animate-wave" src="{{ asset('assets/front/images/shap/wave-orange.png') }}" alt="">
        <img class="pt-img2 animate2" src="{{ asset('assets/front/images/shap/circle-small-blue.png') }}" alt="">
        <img class="pt-img3 animate-rotate" src="{{ asset('assets/front/images/shap/line-circle-blue.png') }}"
             alt="">
        <img class="pt-img4 animate-wave" src="{{ asset('assets/front/images/shap/square-dots-orange.png') }}"
             alt="">
        <img class="pt-img5 animate2" src="{{ asset('assets/front/images/shap/square-blue.png') }}" alt="">
    </section>

    <!-- Our Progress -->
    <section
            class="section-area section-sp5 work-area" {{$styleCss}}="background-image: url({{'assets/front/images/background/line-bg1.png'}}); background-repeat: no-repeat; background-position: center; background-size: 100%;">
    <div class="container-sm">
        <div class="heading-bx text-center">
            <h6 class="title-ext text-secondary">{{__('messages.web.working_process')}}</h6>
            <h2 class="title">{{__('messages.web.how_we_works')}}?</h2>
        </div>
        <div class="row justify-content-center">

            <div class="col-lg-4 col-sm-6 mb-30">
                <div class="work-bx">
                    <div class="work-num-bx">01</div>
                    <div class="work-content">
                        <h5 class="title text-secondary mb-10">{{__('messages.web.registration')}}</h5>
                        <p>{{__('messages.web.patient_can_do_registration___')}}</p>
                    </div>
                    <a href="{{ route('register') }}" class="btn btn-primary light">{{__('messages.web.view_more')}}
                        <i class="btn-icon-bx fas fa-chevron-right"></i></a>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6 mb-30">
                <div class="work-bx active">
                    <div class="work-num-bx">02</div>
                    <div class="work-content">
                        <h5 class="title text-secondary mb-10">{{__('messages.web.make_appointment')}}</h5>
                        <p>{{__('messages.web.patient_can_book_an_appointment___')}}</p>
                    </div>
                    <a href="{{ route('medicalAppointment') }}"
                       class="btn btn-primary light">{{__('messages.web.view_more')}}
                        <i class="btn-icon-bx fas fa-chevron-right"></i></a>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6 mb-30">
                <div class="work-bx">
                    <div class="work-num-bx">03</div>
                    <div class="work-content">
                        <h5 class="title text-secondary mb-10">{{__('messages.web.take_treatment')}}</h5>
                        <p>{{__('messages.web.doctors_can_interact___')}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <img class="pt-img1 animate1" src="{{asset('assets/front/images/shap/circle-orange.png')}}" alt="">
    <img class="pt-img2 animate2" src="{{asset('assets/front/images/shap/plus-orange.png')}}" alt="">
    <img class="pt-img3 animate3" src="{{asset('assets/front/images/shap/circle-dots.png')}}" alt="">
    </section>

    <!-- Appointment -->
    <section class="section-area account-wraper1">
        <div class="container-fluid">
            <div class="appointment-inner section-sp2" {{$styleCss}}="
            background-image: url({{'assets/front/images/appointment/line-bg.png'}}
            ); background-repeat: no-repeat; background-position: 20px 140px;">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-5 col-lg-6 col-md-6">
                        <div class="appointment-form form-wraper">
                            <h3 class="title">{{__('messages.web.book_an_appointment')}}</h3>
                            <form action="{{ route('front.home.appointment.book')}}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <input type="text" name="first_name" class="form-control required"
                                           placeholder="First Name" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="last_name" class="form-control required"
                                           placeholder="Last Name" required>
                                </div>
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control required"
                                           placeholder="Email" required>
                                </div>
                                <div class="form-group">
                                    {{ Form::select('doctor_id', $appointmentDoctors, null,['class' => 'form-select required', 'data-control'=>"select2", 'required','placeholder' => 'Select Doctor']) }}
                                </div>
                                <div class="form-group">
                                    <input type="text" name="date" id="frontAppointmentDate"
                                           class="form-control appointment-calendar" placeholder="Select Date"
                                           autocomplete="true" required readonly>
                                </div>
                                <button type="submit"
                                        class="btn btn-secondary btn-lg booking-home-button">{{__('messages.web.appointment_now')}}</button>
                            </form>
                        </div>
                    </div>
                    <div class="col-xl-7 col-lg-6 col-md-6">
                        <div class="appointment-thumb">
                            <img src="{{asset('assets/front/images/appointment/mobile.png')}}" alt="">
                            <div class="images-group">
                                <img class="img1" src="{{ asset('assets/front/images/appointment/women.png')}}" alt="">
                                <img class="img2" src="{{ asset('assets/front/images/appointment/map-pin.png')}}"
                                     alt="">
                                <img class="img3" src="{{ asset('assets/front/images/appointment/setting.png')}}"
                                     alt="">
                                    <img class="img4" src="{{ asset('assets/front/images/appointment/check.png')}}" alt="">
                                    <img class="img5" src="{{ asset('assets/front/images/appointment/chat.png')}}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <img class="pt-img1 animate1" src="{{ asset('/assets/front/images/shap/trangle-orange.png')}}" alt="">
                <img class="pt-img2 animate-wave" src="{{ asset('/assets/front/images/shap/wave-orange.png')}}" alt="">
                <img class="pt-img3 animate-wave" src="{{ asset('/assets/front/images/shap/wave-blue.png')}}" alt="">
            <img class="pt-img4 animate2" src="{{ asset('/assets/front/images/shap/circle-orange.png')}}" alt="">
        </div>
        </div>
    </section>

    <!-- service -->
    <section class="section-area section-sp1 service-wraper">
        <div class="row align-items-center">
            <div class="col-xl-4 col-lg-7 mb-30">
                <div class="heading-bx">
                    <h6 class="title-ext text-secondary">{{__('messages.web.services')}}</h6>
                    <h2 class="title">{{__('messages.web.we_cover_a_big___')}}</h2>
                    <p>{{__('messages.web.we_provide_the_special_tips___')}}</p>
                </div>
                <a href="{{ route('medicalServices') }}"
                   class="btn btn-secondary btn-lg shadow">{{__('messages.web.all_services')}}</a>
            </div>
            <div class="col-xl-8 mb-15">
                <div class="swiper-container service-slide">
                    <div class="swiper-wrapper">
                        @foreach($frontMedicalServices as $frontMedicalService)
                            <div class="swiper-slide">
                                <div class="feature-container feature-bx2 feature1">
                                    <div class="feature-box-xl mb-30">
										<span class="icon-cell">
											<img src="{{ $frontMedicalService->icon }}" alt="">
										</span>
                                        </div>
                                        <div class="icon-content">
                                            <h3 class="ttr-title">{{ $frontMedicalService->name }}</h3>
                                            <p>{{ $frontMedicalService->short_description }}</p>
                                            <p>{{number_format($frontMedicalService->charges,2)}} PKR /month</p>
                                            
                                            <a href="{{ route('serviceBookAppointment',$frontMedicalService->id) }}"
                                                class="btn btn-primary shadow d-xl-inline-block d-md-flex d-inline-block align-items-center justify-content-between ps-2 py-1 pe-1">
                                                    <span>Buy Now</span>
                                                    <i class="btn-icon-bx fas fa-chevron-right my-0 ms-1 me-0"></i>
                                                </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <img class="pt-img1 animate-rotate" src="{{ asset('assets/front/images/shap/line-circle-blue.png')}}"
                 alt="">
            <img class="pt-img2 animate2" src="{{ asset('assets/front/images/shap/square-dots-orange.png')}}" alt="">
            <img class="pt-img3 animate-wave" src="{{ asset('assets/front/images/shap/wave-blue.png')}}" alt="">
            <img class="pt-img4 animate1" src="{{ asset('assets/front/images/shap/square-rotate.png')}}" alt="">
        </section>

       @include('fronts.patient_testimonial')

    </div>
@endsection
@section('front-js')
    <script src="{{ asset('assets/js/bootstrap-datepicker/bootstrap-datepicker.js') }}"></script>
    <script src="{{ mix('assets/js/fronts/front_home/front-home.js') }}"></script>
@endsection
