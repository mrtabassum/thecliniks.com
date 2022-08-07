@php $styleCss = 'style'; @endphp
<div class="position-relative mb-5 mx-3 mt-2 sidebar-search-box">
    <span class="svg-icon svg-icon-1 svg-icon-primary position-absolute top-50 translate-middle ms-9">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                 height="24" viewBox="0 0 24 24" fill="none">
                                                                <rect opacity="0.5" x="17.0365" y="15.1223"
                                                                      width="8.15546" height="2" rx="1"
                                                                      transform="rotate(45 17.0365 15.1223)"
                                                                      fill="black"></rect>
                                                                <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                                                      fill="black"></path>
                                                            </svg>
                                                        </span>
    <input type="text" class="form-control form-control-lg form-control-solid ps-15" id="menuSearch" name="search"
           placeholder="Search" {{ $styleCss }}="background-color: #2A2B3A;border: none;color: #FFFFFF"
    autocomplete="off">
</div>
<div class="no-record text-white text-center d-none">{{ __('messages.no_matching_records_found') }}</div>
@can('manage_admin_dashboard')
    <div class="menu-item menu-search sidebar-dropdown">
        <a class="menu-link {{ Request::is('admin/dashboard*') ? 'active' : '' }}"
           href="{{ route('admin.dashboard') }}">
        <span class="menu-icon">
            <i class="fas fa fa-digital-tachograph fs-3"></i>
        </span>
            <span class="menu-title">{{ __('messages.dashboard') }}</span>
        </a>
        <ul class="ps-md-0 hoverable-dropdown list-unstyled shadow">
            <li class="{{ Request::is('admin/dashboard*') ? 'menu-li-hover-color' : '' }}">
                <a class="menu-link py-3" href="{{ route('admin.dashboard') }}">
                    <span class="menu-title {{ Request::is('admin/dashboard*') ? 'text-primary' : '' }}">{{ __('messages.dashboard') }}</span>
                </a>
            </li>
        </ul>
    </div>
@endcan
@can('manage_staff')
    <div class="menu-item menu-search sidebar-dropdown">
        <a class="menu-link {{ Request::is('admin/staff*') ? 'active' : '' }}" href="{{ route('staff.index') }}">
        <span class="menu-icon">
            <i class="fas fa-users fs-3"></i>
        </span>
            <span class="menu-title">{{__('messages.staffs')}}</span>
        </a>
        <ul class="ps-md-0 hoverable-dropdown list-unstyled shadow">
            <li class="{{ Request::is('admin/staff*') ? 'menu-li-hover-color' : '' }}">
                <a class="menu-link py-3" href="{{ route('staff.index') }}">
                    <span class="menu-title {{ Request::is('admin/staff*') ? 'text-primary' : '' }}">{{ __('messages.staffs') }}</span>
                </a>
            </li>
        </ul>
    </div>
@endcan
@role('doctor')
<div class="menu-item menu-search">
    <a class="menu-link {{ Request::is('doctors/dashboard*') ? 'active' : '' }}" href="{{route('doctors.dashboard')}}">
        <span class="menu-icon">
            <i class="fas fa fa-digital-tachograph fs-3"></i>
        </span>
        <span class="menu-title">{{ __('messages.dashboard') }}</span>
    </a>
</div>
<div class="menu-item menu-search">
    <a class="menu-link {{ (Request::is('doctors/appointments*') || Request::is('doctors/patient*')) ? 'active' : '' }}"
       href="{{route('doctors.appointments')}}">
        <span class="menu-icon">
            <i class="fas fa-calendar-alt fs-3" aria-hidden="true"></i>
        </span>
        <span class="menu-title">{{__('messages.appointment.appointments')}}</span>
    </a>
</div>
<div class="menu-item menu-search">
    <a class="menu-link {{ (Request::is(doctorSessionActiveUrl())) ? 'active' : null }}"
       href="{{getLoginDoctorSessionUrl()}}">
        <span class="menu-icon"><i class="fa fa-calendar fs-3"></i></span>
        <span class="menu-title">{{ __('messages.doctor_session.my_schedule') }}</span>
    </a>
</div>
<div class="menu-item menu-search">
    <a class="menu-link {{ Request::is('doctors/visits*') ? 'active' : '' }}"
       href="{{ route('doctors.visits.index') }}">
    <span class="menu-icon">
        <i class="fas fa-procedures fs-3"></i>
    </span>
        <span class="menu-title">{{__('messages.visits')}}</span>
    </a>
</div>
<div class="menu-item menu-search">
    <a class="menu-link {{ Request::is('doctors/live-consultation*') ? 'active' : '' }}"
       href="{{ route('doctors.live-consultation.index') }}">
    <span class="menu-icon">
        <i class="fas fa-video fs-3"></i>
    </span>
        <span class="menu-title">{{__('messages.live_consultations')}}</span>
    </a>
</div>
<div class="menu-item menu-search">
    <a class="menu-link {{ Request::is('doctors/connect-google-calendar*') ? 'active' : '' }}"
       href="{{ route('doctors.googleCalendar.index') }}">
    <span class="menu-icon">
        <i class="fas fa-calendar-day fs-3"></i>
    </span>
        <span class="menu-title">{{__('messages.setting.connect_google_calendar')}}</span>
    </a>
</div>
@endrole
@role('patient')
<div class="menu-item menu-search">
    <a class="menu-link {{ Request::is('patients/dashboard*') ? 'active' : '' }}"
       href="{{ route('patients.dashboard') }}">
        <span class="menu-icon">
            <i class="fas fa fa-digital-tachograph fs-3"></i>
        </span>
        <span class="menu-title">{{ __('messages.dashboard') }}</span>
    </a>
</div>
<div class="menu-item menu-search">
    <a class="menu-link {{ (Request::is('patients/appointments*') || Request::is('patients/patient-appointments-calendar*')||Request::is('patients/doctors*')) ? 'active' : '' }}"
       href="{{ route('patients.appointments.index') }}">
        <span class="menu-icon"><i class="fas fa-calendar-alt fs-3" aria-hidden="true"></i></span>
        <span class="menu-title">{{__('messages.appointment.appointments')}}</span>
    </a>
</div>
<div class="menu-item menu-search">
    <a class="menu-link {{ (Request::is('patients/transactions*')) ? 'active' : '' }}"
       href="{{ route('patients.transactions') }}">
        <span class="menu-icon">
            <i class="fas fa-money-bill-wave"></i>
        </span>
        <span class="menu-title">{{ __('messages.transactions') }}</span>
    </a>
</div>
<div class="menu-item menu-search">
    <a class="menu-link {{ (Request::is('patients/reviews*')) ? 'active' : '' }}"
       href="{{ route('patients.reviews.index') }}">
        <span class="menu-icon">
            <i class="fas fa-star"></i>
        </span>
        <span class="menu-title">{{ __('messages.reviews') }}</span>
    </a>
</div>
<div class="menu-item menu-search">
    <a class="menu-link {{ (Request::is('patients/patient-visits*')) ? 'active' : '' }}"
       href="{{ route('patients.patient.visits.index') }}">
        <span class="menu-icon"><i class="fas fa-procedures fs-3" aria-hidden="true"></i></span>
        <span class="menu-title">{{__('messages.visits')}}</span>
    </a>
</div>
<div class="menu-item menu-search">
    <a class="menu-link {{ Request::is('patients/live-consultation*') ? 'active' : '' }}"
       href="{{ route('patients.live-consultation.index') }}">
    <span class="menu-icon">
        <i class="fas fa-video fs-3"></i>
    </span>
        <span class="menu-title">{{__('messages.live_consultations')}}</span>
    </a>
</div>
<div class="menu-item menu-search">
    <a class="menu-link {{ Request::is('patients/connect-google-calendar*') ? 'active' : '' }}"
       href="{{ route('patients.googleCalendar.index') }}">
    <span class="menu-icon">
        <i class="fas fa-calendar-day fs-3"></i>
    </span>
        <span class="menu-title">{{__('messages.setting.connect_google_calendar')}}</span>
    </a>
</div>
@endrole
@can('manage_doctors')
    <div class="menu-item menu-search sidebar-dropdown">
        <a class="menu-link {{
    (Request::is('admin/doctors*')||Request::is('admin/doctor-sessions*')||Request::is('doctors/doctor-sessions*')) ? 'active' : '' }}"
           href="{{ route('doctors.index') }}">
        <span class="menu-icon">
            <i class="fas fa-user-md fs-3"></i>
        </span>
            <span class="menu-title">{{ __('messages.doctors') }}<span
                        class="d-none">{{ __('messages.doctor_sessions') }}</span></span>
        </a>
        <ul class="ps-md-0 hoverable-dropdown list-unstyled shadow">
            <li class="{{ Request::is('admin/doctors*') ? 'menu-li-hover-color' : '' }}">
                <a class="menu-link py-3" href="{{ route('doctors.index') }}">
                    <span class="menu-title {{ Request::is('admin/doctors*') ? 'text-primary' : '' }}">{{ __('messages.doctors') }}</span>
                </a>
            </li>
            <li class="{{ Request::is('admin/doctor-sessions*') ? 'menu-li-hover-color' : '' }}">
                <a class="menu-link py-3" href="{{ route('doctor-sessions.index') }}">
                    <span class="menu-title {{ Request::is('admin/doctor-sessions*') ? 'text-primary' : '' }}">{{ __('messages.doctor_sessions') }}</span>
                </a>
            </li>
        </ul>
    </div>
@endcan
@can('manage_patients')
    <div class="menu-item menu-search sidebar-dropdown">
        <a class="menu-link {{ Request::is('admin/patients*') ? 'active' : '' }}"
           href="{{ route('patients.index') }}">
        <span class="menu-icon">
            <i class="fas fa-hospital-user fs-3"></i>
        </span>
            <span class="menu-title">{{ __('messages.patients') }}</span>
        </a>
        <ul class="ps-md-0 hoverable-dropdown list-unstyled shadow">
            <li class="{{ Request::is('admin/patients*') ? 'menu-li-hover-color' : '' }}">
                <a class="menu-link py-3" href="{{ route('patients.index') }}">
                    <span class="menu-title {{ Request::is('admin/patients*') ? 'text-primary' : '' }}">{{ __('messages.patients') }}</span>
                </a>
            </li>
        </ul>
    </div>
@endcan
@can('manage_appointments')
    <div class="menu-item menu-search sidebar-dropdown">
        <a class="menu-link {{ (Request::is('admin/appointments*') || Request::is('admin/admin-appointments-calendar*')) ? 'active' : '' }}"
           href="{{ route('appointments.index') }}">
        <span class="menu-icon">
            <i class="fas fa-calendar-alt fs-3"></i>
        </span>
            <span class="menu-title">{{ __('messages.appointments') }}</span>
        </a>
        <ul class="ps-md-0 hoverable-dropdown list-unstyled shadow">
            <li class="{{ (Request::is('admin/appointments*') || Request::is('admin/admin-appointments-calendar*')) ? 'menu-li-hover-color' : '' }}">
                <a class="menu-link py-3" href="{{ route('appointments.index') }}">
                    <span class="menu-title {{ (Request::is('admin/appointments*') || Request::is('admin/admin-appointments-calendar*')) ? 'text-primary' : '' }}">{{ __('messages.appointments') }}</span>
                </a>
            </li>
        </ul>
    </div>
@endcan
@can('manage_transactions')
    <div class="menu-item menu-search sidebar-dropdown">
        <a class="menu-link {{ (Request::is('admin/transactions*')) ? 'active' : '' }}"
           href="{{ route('transactions') }}">
        <span class="menu-icon">
            <i class="fas fa-money-bill-wave"></i>
        </span>
            <span class="menu-title">{{ __('messages.transactions') }}</span>
        </a>
        <ul class="ps-md-0 hoverable-dropdown list-unstyled shadow">
            <li class="{{ Request::is('admin/transactions*') ? 'menu-li-hover-color' : '' }}">
                <a class="menu-link py-3" href="{{ route('transactions') }}">
                    <span class="menu-title {{ Request::is('admin/transactions*') ? 'text-primary' : '' }}">{{ __('messages.transactions') }}</span>
                </a>
            </li>
        </ul>
    </div>
@endcan
@if(!getLogInUser()->hasRole('doctor'))
    @can('manage_patient_visits')
        <div class="menu-item menu-search sidebar-dropdown">
            <a class="menu-link {{ Request::is('admin/visits*') ? 'active' : '' }}"
               href="{{ route('visits.index') }}">
        <span class="menu-icon">
            <i class="fas fa-procedures fs-3"></i>
        </span>
                <span class="menu-title">{{__('messages.visits')}}</span>
            </a>
            <ul class="ps-md-0 hoverable-dropdown list-unstyled shadow">
                <li class="{{ Request::is('admin/visits*') ? 'menu-li-hover-color' : '' }}">
                    <a class="menu-link py-3" href="{{ route('visits.index') }}">
                        <span class="menu-title {{ Request::is('admin/visits*') ? 'text-primary' : '' }}">{{ __('messages.visits') }}</span>
                    </a>
                </li>
            </ul>
        </div>
    @endcan
@endif
@can('manage_services')
    <div class="menu-item menu-search sidebar-dropdown">
        <a class="menu-link {{ (Request::is('admin/services*') || Request::is('admin/service-categories*')) ? 'active' : '' }}"
           href="{{ route('services.index') }}">
        <span class="menu-icon">
            <i class="fas fa-user-cog fs-3"></i>
        </span>
            <span class="menu-title">{{__('messages.services')}}<span
                        class="d-none">{{ __('messages.service_categories') }}</span></span>
        </a>
        <ul class="ps-md-0 hoverable-dropdown list-unstyled shadow">
            <li class="{{ Request::is('admin/services*') ? 'menu-li-hover-color' : '' }}">
                <a class="menu-link py-3" href="{{ route('services.index') }}">
                    <span class="menu-title {{ Request::is('admin/services*') ? 'text-primary' : '' }}">{{ __('messages.services') }}</span>
                </a>
            </li>
            <li class="{{ Request::is('admin/service-categories*') ? 'menu-li-hover-color' : '' }}">
                <a class="menu-link py-3" href="{{ route('service-categories.index') }}">
                    <span class="menu-title {{ Request::is('admin/service-categories*') ? 'text-primary' : '' }}">{{ __('messages.service_categories') }}</span>
                </a>
            </li>
        </ul>
    </div>
@endcan
@can('manage_specialities')
    <div class="menu-item menu-search sidebar-dropdown">
        <a class="menu-link {{ Request::is('admin/specializations*') ? 'active' : '' }}"
           href="{{ route('specializations.index') }}">
        <span class="menu-icon">
            <i class="fas fa-user-shield fs-3"></i>
        </span>
            <span class="menu-title">{{__('messages.specializations')}}</span>
        </a>
        <ul class="ps-md-0 hoverable-dropdown list-unstyled shadow">
            <li class="{{ Request::is('admin/specializations*') ? 'menu-li-hover-color' : '' }}">
                <a class="menu-link py-3" href="{{ route('specializations.index') }}">
                    <span class="menu-title {{ Request::is('admin/specializations*') ? 'text-primary' : '' }}">{{ __('messages.specializations') }}</span>
                </a>
            </li>
        </ul>
    </div>
@endcan
@can('manage_front_cms')
    <div class="menu-item menu-search sidebar-dropdown">
        <a class="menu-link {{ (Request::is('admin/enquiries*') ? 'active' : '') }}"
           href="{{ route('enquiries.index') }}">
        <span class="menu-icon">
            <i class="fas fa-question-circle fs-3"></i>
        </span>
            <span class="menu-title">{{ __('messages.enquiries') }}</span>
        </a>
        <ul class="ps-md-0 hoverable-dropdown list-unstyled shadow">
            <li class="{{ Request::is('admin/enquiries*') ? 'menu-li-hover-color' : '' }}">
                <a class="menu-link py-3" href="{{ route('enquiries.index') }}">
                    <span class="menu-title {{ Request::is('admin/enquiries*') ? 'text-primary' : '' }}">{{ __('messages.enquiries') }}</span>
                </a>
            </li>
        </ul>
    </div>
    <div class="menu-item menu-search sidebar-dropdown">
        <a class="menu-link {{ (Request::is('admin/subscribers*') ? 'active' : '') }}"
           href="{{ route('subscribers.index') }}">
        <span class="menu-icon">
            <i class="fab fa-stripe-s fs-3"></i>
        </span>
            <span class="menu-title">{{ __('messages.subscribers') }}</span>
        </a>
        <ul class="ps-md-0 hoverable-dropdown list-unstyled shadow">
            <li class="{{ Request::is('admin/subscribers*') ? 'menu-li-hover-color' : '' }}">
                <a class="menu-link py-3" href="{{ route('subscribers.index') }}">
                    <span class="menu-title {{ Request::is('admin/subscribers*') ? 'text-primary' : '' }}">{{ __('messages.subscribers') }}</span>
                </a>
            </li>
        </ul>
    </div>
    <div class="menu-item menu-search sidebar-dropdown">
        <a class="menu-link {{ (Request::is('admin/sliders*') || Request::is('admin/faqs*') || Request::is('admin/front-medical-services*') || Request::is('admin/front-patient-testimonials*') || Request::is('admin/cms*') ? 'active' : '') }}"
           href="{{ route('cms.index') }}">
        <span class="menu-icon">
            <i class="fas fa-tasks fs-3"></i>
        </span>
            <span class="menu-title">{{ __('messages.front_cms') }}
                <span class="d-none">{{ __('messages.sliders') }} {{ __('messages.faqs') }} {{ __('messages.front_patient_testimonials') }}</span>
            </span>
        </a>
        <ul class="ps-md-0 hoverable-dropdown list-unstyled shadow">
            <li class="{{ Request::is('admin/cms*') ? 'menu-li-hover-color' : '' }}">
                <a class="menu-link py-3" href="{{ route('cms.index') }}">
                    <span class="menu-title {{ Request::is('admin/cms*') ? 'text-primary' : '' }}">{{ __('messages.cms.cms') }}</span>
                </a>
            </li>
            <li class="{{ Request::is('admin/sliders*') ? 'menu-li-hover-color' : '' }}">
                <a class="menu-link py-3" href="{{ route('sliders.index') }}">
                    <span class="menu-title {{ Request::is('admin/sliders*') ? 'text-primary' : '' }}">{{ __('messages.sliders') }}</span>
                </a>
            </li>
            <li class="{{ Request::is('admin/faqs*') ? 'menu-li-hover-color' : '' }}">
                <a class="menu-link py-3" href="{{ route('faqs.index') }}">
                    <span class="menu-title {{ Request::is('admin/faqs*') ? 'text-primary' : '' }}">{{ __('messages.faqs') }}</span>
                </a>
            </li>
            <li class="{{ Request::is('admin/front-patient-testimonials*') ? 'menu-li-hover-color' : '' }}">
                <a class="menu-link py-3" href="{{ route('front-patient-testimonials.index') }}">
                    <span class="menu-title {{ Request::is('admin/front-patient-testimonials*') ? 'text-primary' : '' }}">{{ __('messages.front_patient_testimonials') }}</span>
                </a>
            </li>
        </ul>
    </div>
@endcan
@can('manage_settings')
    <div class="menu-item menu-search sidebar-dropdown">
        <a class="menu-link {{ (Request::is('admin/settings*') || Request::is('admin/roles*') || Request::is('admin/currencies*') || Request::is('admin/clinic-schedules*') || Request::is('admin/countries*') || Request::is('admin/states*') ||Request::is('admin/cities*')) ? 'active' : '' }}"
           href="{{ route('setting.index') }}">
        <span class="menu-icon">
            <i class="fas fa-cogs fs-3"></i>
        </span>
            <span class="menu-title">{{__('messages.settings')}}<span
                        class="d-none">{{ __('messages.roles') }} {{ __('messages.countries') }} {{ __('messages.clinic_schedules') }} {{ __('messages.currencies') }} {{ __('messages.states') }} {{ __('messages.cities') }}</span></span>
        </a>
        <ul class="ps-md-0 hoverable-dropdown list-unstyled shadow">
            <li class="{{ Request::is('admin/settings*') ? 'menu-li-hover-color' : '' }}">
                <a class="menu-link py-3" href="{{ route('setting.index') }}">
                    <span class="menu-title {{ Request::is('admin/settings*') ? 'text-primary' : '' }}">{{ __('messages.settings') }}</span>
                </a>
            </li>
            <li class="{{ Request::is('admin/clinic-schedules*') ? 'menu-li-hover-color' : '' }}">
                <a class="menu-link py-3" href="{{ route('clinic-schedules.index') }}">
                    <span class="menu-title {{ Request::is('admin/clinic-schedules*') ? 'text-primary' : '' }}">{{ __('messages.clinic_schedules') }}</span>
                </a>
            </li>
            <li class="{{ Request::is('admin/roles*') ? 'menu-li-hover-color' : '' }}">
                <a class="menu-link py-3" href="{{ route('roles.index') }}">
                    <span class="menu-title {{ Request::is('admin/roles*') ? 'text-primary' : '' }}">{{ __('messages.roles') }}</span>
                </a>
            </li>
            <li class="{{ Request::is('admin/currencies*') ? 'menu-li-hover-color' : '' }}">
                <a class="menu-link py-3" href="{{ route('currencies.index') }}">
                    <span class="menu-title {{ Request::is('admin/currencies*') ? 'text-primary' : '' }}">{{__('messages.currencies')}}</span>
                </a>
            </li>
            <li class="{{ Request::is('admin/countries*') ? 'menu-li-hover-color' : '' }}">
                <a class="menu-link py-3" href="{{ route('countries.index') }}">
                    <span class="menu-title {{ Request::is('admin/countries*') ? 'text-primary' : '' }}">{{__('messages.countries')}}</span>
                </a>
            </li>
            <li class="{{ Request::is('admin/states*') ? 'menu-li-hover-color' : '' }}">
                <a class="menu-link py-3" href="{{ route('states.index') }}">
                    <span class="menu-title {{ Request::is('admin/states*') ? 'text-primary' : '' }}">{{__('messages.states')}}</span>
                </a>
            </li>
            <li class="{{ Request::is('admin/cities*') ? 'menu-li-hover-color' : '' }}">
                <a class="menu-link py-3" href="{{ route('cities.index') }}">
                    <span class="menu-title {{ Request::is('admin/cities*') ? 'text-primary' : '' }}">{{__('messages.cities')}}</span>
                </a>
            </li>
        </ul>
    </div>
@endcan
