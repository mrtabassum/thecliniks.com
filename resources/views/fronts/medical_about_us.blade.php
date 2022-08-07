@extends('fronts.layouts.app')
@section('front-title')
    {{ __('messages.web.medical_about_us') }}
@endsection
@section('front-content')
    @php
        $styleCss = 'style';
    @endphp
    <div class="page-content bg-white">
        <!-- Inner Banner -->
        <div class="banner-wraper">
            <div class="page-banner" {{$styleCss}}="background-image:url({{'assets/front/images/banner/img1.jpg'}});">
            <div class="container">
                <div class="page-banner-entry text-center">
                    <h1>{{ __('messages.web.about_us') }}</h1>
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
                                aria-current="page">{{ __('messages.web.about_us') }}</li>
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
                    <div class="about-thumb-area">
                        <ul>
                            <li><img class="about-thumb1" src="{{ getSettingValue('about_image_2') }}" alt=""></li>
                            <li><img class="about-thumb2" src="{{ getSettingValue('about_image_1') }}" alt=""></li>
                            <li><img class="about-thumb3" src="{{ getSettingValue('about_image_3') }}" alt=""></li>
                            <li>
                                <div class="exp-bx">{{ getSettingValue('about_experience') }}
                                    <span>{{ __('messages.web.year_experience') }}</span></div>
                            </li>
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
        <img class="pt-img1 animate-wave" src="{{asset('assets/front/images/shap/wave-orange.png')}}" alt="">
        <img class="pt-img2 animate2" src="{{asset('assets/front/images/shap/circle-small-blue.png')}}" alt="">
        <img class="pt-img3 animate-rotate" src="{{asset('assets/front/images/shap/line-circle-blue.png')}}" alt="">
        <img class="pt-img4 animate-wave" src="{{asset('assets/front/images/shap/square-dots-orange.png')}}" alt="">
        <img class="pt-img5 animate2" src="{{asset('assets/front/images/shap/square-blue.png')}}" alt="">
    </section>

    <!-- About us -->
    <section class="section-sp1 service-wraper2">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-sm-6 mb-30">
                    <div class="feature-container feature-bx3">
                        <h2 class="counter text-secondary">{{ $data['specializationsCount'] }}</h2>
                        <h5 class="ttr-title text-primary">{{ __('messages.specializations') }}</h5>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-30">
                    <div class="feature-container feature-bx3">
                        <h2 class="counter text-secondary">{{ $data['servicesCount'] }}</h2>
                        <h5 class="ttr-title text-primary">{{ __('messages.web.services') }}</h5>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-30">
                    <div class="feature-container feature-bx3">
                        <h2 class="counter text-secondary">{{ $data['doctorsCount'] }}</h2>
                        <h5 class="ttr-title text-primary">{{ __('messages.doctors') }}</h5>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-30">
                    <div class="feature-container feature-bx3">
                        <h2 class="counter text-secondary">{{ $data['patientsCount'] }}</h2>
                        <h5 class="ttr-title text-primary">{{ __('messages.web.satisfied_patient') }}</h5>
                    </div>
                </div>
            </div>
        </div>
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

    @include('fronts.patient_testimonial')

</div>
@endsection
@section('front-js')
    <script src="{{ asset('assets/front/vendor/counter/counterup.min.js') }}"></script>
    <script src="{{ asset('assets/front/vendor/counter/waypoints-min.js') }}"></script>
@endsection
