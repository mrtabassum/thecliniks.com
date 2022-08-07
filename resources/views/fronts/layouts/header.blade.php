<header class="header header-transparent rs-nav">
    <!-- main header -->
    <div class="sticky-header navbar-expand-lg">
        <div class="menu-bar clearfix">
            <div class="container-fluid clearfix">
                <!-- website logo -->
                <div class="menu-logo logo-dark w-auto">
                    <a href="{{ url('/')  }}"><img src="{{ getAppLogo() }}" alt=""></a>
                </div>
                <!-- nav toggle button -->
                <button class="navbar-toggler collapsed menuicon justify-content-end" type="button"
                        data-bs-toggle="collapse" data-bs-target="#menuDropdown" aria-controls="menuDropdown"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
                <!-- extra nav -->
                <div class="secondary-menu d-lg-flex d-none">
                    <ul>
                        <li class="btn-area m-r15">
                            @if(getLogInUser())
                                @if(getLogInUser()->hasRole('doctor'))
                                    <a href="{{ route('doctors.dashboard') }}"
                                       class="btn btn-warning shadow text-white dashboard-button">{{ __('messages.dashboard') }}</a>
                                @elseif(getLogInUser()->hasRole('patient'))
                                    <a href="{{ route('patients.dashboard') }}"
                                       class="btn btn-warning shadow text-white dashboard-button">{{ __('messages.dashboard') }}</a>
                                @else
                                    <a href="{{ route('admin.dashboard') }}"
                                       class="btn btn-warning shadow text-white dashboard-button">{{ __('messages.dashboard') }}</a>
                                @endif
                            @else
                                <a href="{{ route('login') }}"
                                   class="btn btn-warning shadow text-white">{{ __('messages.login') }}</a>
                            @endif
                        </li>
                        <li class="btn-area">
                            <a href="{{ route('medicalDonate') }}"
                               class="btn btn-primary shadow appointment-header-btn">Donate Now
                                <i class="btn-icon-bx fas fa-chevron-right"></i>
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- Search Box ==== -->
                <div class="nav-search-bar">
                    <form action="#">
                        <input name="search" value="" type="text" class="form-control" placeholder="Type to search">
                        <span><i class="ti-search"></i></span>
                    </form>
                    <span id="searchRemove"><i class="ti-close"></i></span>
                </div>
                <div class="menu-links navbar-collapse collapse justify-content-end" id="menuDropdown">
                    <div class="menu-logo">
                        <a href="{{ url('/')  }}"><img src="{{ getAppLogo() }}" alt="logo" class="mobile-logo"></a>
                    </div>
                    <ul class="nav navbar-nav">
                        <li class="{{ Request::is('/*') ? 'active' : '' }}">
                            <a href="{{ url('/') }}">{{ __('messages.web.home') }}</a>
                        </li>
                        
                        <li class="{{ Request::is('medical-lab*') ? 'active' : '' }}">
                            <a href="{{ route('medicalLabc') }}">{{ __('messages.web.lab_c') }}</a>
                        </li>

                        <li class="{{ Request::is('medical-nijjat*') ? 'active' : '' }}">
                            <a href="{{ route('medicalNijjat') }}">{{ __('messages.web.nijjat_c') }}</a>
                        </li>


                        <li class="{{ Request::is('medical-blood*') ? 'active' : '' }}">
                            <a href="{{ route('medicalBlood') }}">{{ __('messages.web.blood_club') }}</a>
                        </li>

                        <li class="{{ Request::is('medical-doctors*') ? 'active' : '' }}">
                            <a href="{{ route('medicalDoctors') }}">{{ __('messages.web.our_team') }}</a>
                        </li>
                        <li class="{{ Request::is('medical-services*') ? 'active' : '' }}">
                            <a href="{{ route('medicalServices') }}">{{ __('messages.web.services') }}</a>
                        </li>
                        <li class="{{ Request::is('medical-about-us*') ? 'active' : '' }}">
                            <a href="{{ route('medicalAboutUs') }}">{{ __('messages.web.about_us') }}</a>
                        </li>
                        <li class="{{ Request::is('medical-contact*') ? 'active' : '' }}">
                            <a href="{{ route('medicalContact') }}">{{ __('messages.web.contact_us') }}</a>
                        </li>
                        <!-- <li class="">
                            <a href="javascript:void(0)">
                                <i class="fas fa-language fs-6 me-1"></i>{{getCurrentLanguageName()}}</a>
                            <ul class="sub-menu">
                                <li class="add-menu-left">
                                    <ul>
                                        @foreach(getUserLanguages() as $key => $value)
                                            @foreach(\App\Models\User::LANGUAGES_IMAGE as $imageKey=> $imageValue)
                                                @if($imageKey == $key)
                                                    <li class="d-flex languageSelection" data-prefix-value="{{ $key }}">
                                                        <a href="javascript:void(0)" class="ps-0">
                                                            <img class="rounded-1 ms-2 me-2 w-20px"
                                                                 src="{{asset($imageValue)}}"/>
                                                            <span class="">{{ $value }}</span>
                                                        </a>
                                                    </li>
                                                @endif
                                            @endforeach
                                        @endforeach
                                    </ul>
                                </li>
                            </ul>
                        </li> -->
                    </ul>
                    <div class="secondary-menu ps-0 mt-sm-0 mt-4">
                        <ul class="flex-sm-row flex-column-reverse">
                            <li class="btn-area me-sm-3 me-0 mt-sm-0 mt-3 d-lg-none d-block">
                                @if(getLogInUser())
                                    @if(getLogInUser()->hasRole('doctor'))
                                        <a href="{{ route('doctors.dashboard') }}"
                                           class="btn btn-warning shadow text-white">{{ __('messages.dashboard') }}</a>
                                    @elseif(getLogInUser()->hasRole('patient'))
                                        <a href="{{ route('patients.dashboard') }}"
                                           class="btn btn-warning shadow text-white">{{ __('messages.dashboard') }}</a>
                                    @else
                                        <a href="{{ route('admin.dashboard') }}"
                                           class="btn btn-warning shadow text-white">{{ __('messages.dashboard') }}</a>
                                    @endif
                                @else
                                    <a href="{{ route('login') }}"
                                       class="btn btn-warning shadow text-white">{{ __('messages.login') }}</a>
                                @endif
                            </li>
                            <li class="btn-area d-lg-none d-block appointment-button"><a href="{{ route('medicalAppointment') }}"
                                                    class="btn btn-primary shadow">{{ __('messages.web.book_an_appointment') }}
                                    <i class="btn-icon-bx fas fa-chevron-right ms-0"></i></a></li>
                        </ul>
                    </div>
                    <div class="menu-close">
                        <i class="ti-close"></i>
                    </div>
                </div>
                <!-- Navigation Menu END ==== -->
            </div>
        </div>
    </div>
    <!-- main header END -->
</header>
<!-- header END -->
