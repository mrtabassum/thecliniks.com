<!--begin::Header-->
<div id="kt_header" class="header align-items-stretch">
    <!--begin::Container-->
    <div class="container-fluid d-flex align-items-stretch justify-content-between">
        <!--begin::Aside mobile toggle-->
        <div class="d-flex align-items-center d-lg-none ms-n3 me-1" title="Show aside menu">
            <div class="btn btn-icon btn-active-color-white" id="kt_aside_mobile_toggle">
                <i class="bi bi-list fs-1"></i>
            </div>
        </div>
        <!--end::Aside mobile toggle-->
        <!--begin::Mobile logo-->
        <div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0">
            <a href="{{ url('/') }}" class="d-lg-none">
                <img alt="Logo" src="{{ asset(getAppLogo()) }}" class="h-25px"/>
            </a>
        </div>
        <!--end::Mobile logo-->
        <!--begin::Wrapper-->
        <div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1">
            <!--begin::Navbar-->
            <div class="d-flex align-items-stretch" id="kt_header_nav">
                <!--begin::Menu wrapper-->
                <div class="header-menu align-items-stretch" data-kt-drawer="true"
                     data-kt-drawer-name="header-menu" data-kt-drawer-activate="{default: true, lg: false}"
                     data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}"
                     data-kt-drawer-direction="end" data-kt-drawer-toggle="#kt_header_menu_mobile_toggle"
                     data-kt-swapper="true" data-kt-swapper-mode="prepend"
                     data-kt-swapper-parent="{default: '#kt_body', lg: '#kt_header_nav'}">
                    @include('layouts.sub_menu')
                </div>
                <!--end::Menu wrapper-->
            </div>
            <!--end::Navbar-->
            <!--begin::Topbar-->
            <div class="d-flex align-items-stretch flex-shrink-0">
                <div class="topbar-item position-relative p-8 d-flex align-items-center hoverable">
                    @if(Auth::user()->dark_mode)
                        <a href="javascript:void(0)" title="Switch to Light mode"><i
                                    class="far fa-moon fs-3 apply-dark-mode"></i></a>
                    @else
                        <a href="javascript:void(0)" title="Switch to Dark mode"><i
                                    class="fas fa-sun fs-3 apply-dark-mode"></i></a>
                    @endif
                </div>
                <!--begin::Toolbar wrapper-->
                <div class="d-flex align-items-stretch flex-shrink-0">

                @if(getLogInUser()->hasRole('doctor') || getLogInUser()->hasRole('patient'))
                    <!--begin::Notifications-->
                        @php
                            $notifications = getNotification();
                        @endphp
                        <div class="d-flex align-items-center ms-1 me-lg-3 notification-dropdown">
                            <!--begin::Menu wrapper-->
                        <div class="btn btn-icon btn-active-light-primary w-30px h-30px w-md-40px h-md-40px notification-icon position-relative" title="Notifications" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
                            <i class="far fa-bell"></i>
                            @if(count($notifications) != 0)
                                <span class="badge navbar-badge bg-primary notification-count notification-message-counter rounded-circle position-absolute translate-middle d-flex justify-content-center align-items-center"
                                      id="counter">{{ count($notifications) }}</span> 
                            @endif
                        </div>
                        <!--begin::Menu-->
                        <div class="menu menu-sub menu-sub-dropdown menu-column w-250px  h-375px w-lg-350px" data-kt-menu="true" style="">
                            <div class="dropdown-header rounded-top">
                                <div class="row justify-content-between">
                                    <h3 class="px-3 col-5 notification-header">Notifications</h3>
                                    <div class="px-3 col-7 text-end {{ count($notifications) > 0 ? '' : 'd-none' }} align-self-center" id="readAllNotification">
                                        <a href="" class="text-decoration-none">Mark All As Read</a>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="dropdown-list-content dropdown-list-icons force-scroll"> 
                                @if(count($notifications) > 0)
                                    @foreach($notifications as $notification)
                                        <a href="#" data-id="{{ $notification->id }}"
                                           class="notification text-hover-primary readNotification"
                                           id="readNotification">
                                            <div class="scroll-y mh-325px my-5 px-5">
                                                <div class="d-flex flex-stack">
                                                    <div class="d-flex">
                                                        <div class="symbol symbol-35px me-4"><span
                                                                    class="symbol-label bg-light-primary"> <i
                                                                        class="{{ getNotificationIcon($notification->type) }}"></i> </span>
                                                        </div>
                                                        <div class="mb-0 me-2 text-hover-primary">
                                                            <span class="fs-7 text-gray-800 fw-bold text-hover-primary">{{ $notification->title }}</span>
                                                            <span class="badge float-end badge-light fs-8 mt-3">{{ \Carbon\Carbon::parse($notification->created_at)->diffForHumans(null, true)}}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    @endforeach
                                @else
                                    <div class="empty-state fs-6 text-gray-800 fw-bold text-center mt-5"
                                         data-height="400">
                                        <p>{{ __('messages.notification.you_don`t_have_any_new_notification') }}</p>
                                    </div> 
                                @endif
                                    <div class="empty-state fs-6 text-gray-800 fw-bold text-center mt-5 d-none" data-height="400">
                                        <p>{{ __('messages.notification.you_don`t_have_any_new_notification') }}</p>
                                    </div>
                            </div>
                        </div>
                        <!--end::Menu-->
                        <!--end::Menu wrapper-->
                    </div>
                    <!--end::Notifications-->
                    @endif
                    
                    <!--begin::User-->
                    @php $styleCss = 'style'; @endphp
                    <div class="d-flex align-items-center ms-1 ms-lg-3" id="kt_header_user_menu_toggle">
                        @if(empty(getLogInUser()->email_verified_at))
                            <span data-bs-toggle="tooltip" data-bs-custom-class="tooltip-dark"
                                  data-bs-placement="bottom" title="Email is not verified"><i
                                        class="fas fa-envelope mr-5 fs-2"
                                        {{ $styleCss }}="margin-right: 20px; color: red"></i></span>
                    @endif
                    <!--begin::Menu wrapper-->
                        <div class="cursor-pointer symbol symbol-30px symbol-md-40px"
                             data-kt-menu-trigger="click" data-kt-menu-attach="parent"
                             data-kt-menu-placement="bottom-end" data-kt-menu-flip="bottom">
                            @if(getLogInUser()->hasRole('patient'))
                                <img class="object-cover" src="{{ getLogInUser()->patient->profile }}" alt="metronic"/>
                            @elseif(getLogInUser()->hasRole('doctor'))
                                <img class="object-cover" src="{{ getLogInUser()->profile_image }}" alt="metronic"/>
                            @else
                                <img class="object-cover" src="{{ getLogInUser()->profile_image }}" alt="metronic"/>
                            @endif
                        </div>
                        <!--begin::Menu-->
                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg menu-state-primary fw-bold py-4 fs-6 w-275px"
                             data-kt-menu="true">
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <div class="menu-content d-flex align-items-center px-3">
                                    <!--begin::Avatar-->
                                    <div class="symbol symbol-50px me-5">
                                        @if(getLogInUser()->hasRole('patient'))
                                            <img class="object-cover" alt="Logo"
                                                 src="{{ getLogInUser()->patient->profile }}"/>
                                        @elseif(getLogInUser()->hasRole('doctor'))
                                            <img class="object-cover" alt="Logo"
                                                 src="{{ getLogInUser()->profile_image }}"/>
                                        @else
                                            <img class="object-cover" alt="Logo"
                                                 src="{{ getLogInUser()->profile_image }}"/>
                                        @endif
                                    </div>
                                    <!--end::Avatar-->
                                    <!--begin::Username-->
                                    <div class="d-flex flex-column">
                                        <div class="fw-bolder d-flex align-items-center fs-5">{{getLogInUser()->full_name}}
                                        </div>
                                        <a href="javascript:void(0)"
                                           class="fw-bold text-muted text-hover-primary fs-7">{{getLogInUser()->email}}</a>
                                    </div>
                                    <!--end::Username-->
                                </div>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu separator-->
                            <div class="separator my-2"></div>
                            <!--end::Menu separator-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-5 my-1">
                                <a href="{{ route('profile.setting') }}"
                                   class="menu-link px-5">{{ __('messages.user.edit_profile') }}</a>
                            </div>
                            <!--end::Menu item-->
                            <div class="menu-item px-5">
                                <a class="menu-link px-5 "
                                   id="changePassword">{{ __('messages.user.change_password') }}</a>
                            </div>

                            @if(getLogInUser()->hasRole('doctor') || getLogInUser()->hasRole('patient'))
                            <div class="menu-item px-5">
                                <a class="menu-link px-5 "
                                   id="emailNotification">{{ __('messages.user.email_notification') }}</a>
                            </div>
                            @endif
                            <!--end::Menu item-->
                            @if(session('impersonated_by'))
                                    <div class="menu-item px-5">
                                        <a class="menu-link px-5"
                                           href="{{ route('impersonate.leave') }}">{{ __('messages.user.return_to_admin') }}</a>
                                    </div>
                            @endif
                            <!--end::Menu item-->
                            <!--begin::Menu separator-->
                            <div class="separator my-2"></div>
                            <!--end::Menu separator-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-5" data-kt-menu-trigger="hover"
                                 data-kt-menu-placement="left-start" data-kt-menu-flip="bottom">
                                <a href="#" class="menu-link px-5">
                                    <span class="menu-title position-relative">{{__('messages.user.language')}}
                                </a>
                                <!--begin::Menu sub-->
                                <div class="menu-sub menu-sub-dropdown w-175px py-4">
                                    @foreach(getUserLanguages() as $key => $value)
                                        <div class="menu-item px-3">
                                            <a href="#"
                                               class="menu-link d-flex px-5 changeLanguage {{ getLogInUser()->language == $key ? 'active' : ''}}"
                                               data-prefix-value="{{ $key }}">
                                                @foreach(\App\Models\User::LANGUAGES_IMAGE as $imageKey=> $imageValue)
                                                    @if($imageKey == $key)
                                                        <img class="w-15px h-15px rounded-1 ms-2" src="{{asset($imageValue)}}" />
                                                    @endif
                                                @endforeach
                                                <span class="symbol symbol-20px me-4 ">
                                                </span>{{ $value }}</a>
                                        </div>
                                @endforeach
                                <!--end::Menu item-->
                                </div>
                                <!--end::Menu sub-->
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            @if(!session('impersonated_by'))
                            <div class="menu-item px-5">
                                <form id="logout-form" action="{{url('/logout')}}" method="post">
                                    @csrf
                                </form>
                                <a href="{{url('logout')}}"
                                   onclick="event.preventDefault(); localStorage.clear();  document.getElementById('logout-form').submit();"
                                   class="menu-link px-5">{{__('messages.user.sign_out')}}</a>
                            </div>
                        @endif
                            <!--end::Menu item-->
                        </div>
                        <!--end::Menu-->
                        <!--end::Menu wrapper-->
                    </div>
                    <!--end::User -->
                    <!--begin::Heaeder menu toggle-->
                    <div class="d-flex align-items-center d-lg-none ms-2 me-n3" title="Show header menu">
                        <div class="btn btn-icon btn-active-light-primary w-30px h-30px w-md-40px h-md-40px"
                             id="kt_header_menu_mobile_toggle">
                            <i class="bi bi-text-left fs-1"></i>
                        </div>
                    </div>
                    <!--end::Heaeder menu toggle-->
                </div>
                <!--end::Toolbar wrapper-->
            </div>
            <!--end::Topbar-->
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Container-->
</div>
<!--end::Header-->
