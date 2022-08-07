@can('manage_admin_dashboard')
    <div class="menu menu-lg-rounded menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary fw-bold {{ (!Request::is('admin/dashboard*')) ? 'd-none' : '' }}">
        <div class="menu-item me-lg-1 {{ Request::is('admin/dashboard*') ? 'show' : ''  }}">
            <a class="menu-link py-3" href="{{ route('admin.dashboard') }}">
                <span class="menu-title">{{ __('messages.dashboard') }}</span>
            </a>
        </div>
    </div>
@endcan
@role('doctor')
<div class="menu menu-lg-rounded menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary fw-bold {{ (!Request::is('doctors/dashboard*')) ? 'd-none' : '' }}">
    <div class="menu-item me-lg-1 {{ Request::is('doctors/dashboard*') ? 'show' : ''  }}">
        <a class="menu-link py-3" href="{{ route('doctors.dashboard') }}">
            <span class="menu-title">{{ __('messages.dashboard') }}</span>
        </a>
    </div>
</div>
<div class="menu menu-lg-rounded menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary fw-bold {{ (!Request::is('doctors/appointments*')) ? 'd-none' : '' }}">
    <div class="menu-item me-lg-1 {{ Request::is('doctors/appointments*') ? 'show' : ''  }}">
        <a class="menu-link py-3" href="{{ route('doctors.appointments') }}">
            <span class="menu-title">{{ __('messages.appointments') }}</span>
        </a>
    </div>
</div>
<div class="menu menu-lg-rounded menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary fw-bold {{ (!Request::is('doctors/doctor-schedule-edit*')) && (!Request::is('doctors/doctor-sessions/create*')) ? 'd-none' : '' }}">
    <div class="menu-item me-lg-1 {{ Request::is('doctors/doctor-schedule-edit*') || Request::is('doctors/doctor-sessions/create*') ? 'show' : ''  }}">
        <a class="menu-link py-3" href="{{ getLoginDoctorSessionUrl() }}">
            <span class="menu-title">{{ __('messages.doctor_session.my_schedule') }}</span>
        </a>
    </div>
</div>
<div class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary fw-bold {{ (!Request::is('doctors/visits*')) ? 'd-none' : '' }}">
    <div class="menu-item me-lg-1 {{ Request::is('doctors/visits*') ? 'show' : ''  }}">
        <a class="menu-link py-3" href="{{ route('doctors.visits.index') }}">
            <span class="menu-title">{{ __('messages.visits') }}</span>
        </a>
    </div>
</div>
<div class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary fw-bold {{ (!Request::is('doctors/connect-google-calendar*')) ? 'd-none' : '' }}">
    <div class="menu-item me-lg-1 {{ Request::is('doctors/connect-google-calendar*') ? 'show' : ''  }}">
        <a class="menu-link py-3" href="{{ route('doctors.googleCalendar.index') }}">
            <span class="menu-title">{{__('messages.setting.connect_google_calendar')}}</span>
        </a>
    </div>
</div>
<div class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary fw-bold {{ (!Request::is('doctors/live-consultation*')) ? 'd-none' : '' }}">
    <div class="menu-item me-lg-1 {{ Request::is('doctors/live-consultation*') ? 'show' : ''  }}">
        <a class="menu-link py-3" href="{{ route('doctors.live-consultation.index') }}">
            <span class="menu-title">{{__('messages.live_consultations')}}</span>
        </a>
    </div>
</div>
@endrole
@role('patient')
<div class="menu menu-lg-rounded menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary fw-bold {{ (!Request::is('patients/dashboard*')) ? 'd-none' : '' }}">
    <div class="menu-item me-lg-1 {{ Request::is('patients/dashboard*') ? 'show' : ''  }}">
        <a class="menu-link py-3" href="{{ route('patients.dashboard') }}">
            <span class="menu-title">{{ __('messages.dashboard') }}</span>
        </a>
    </div>
</div>
<div class="menu menu-lg-rounded menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary fw-bold 
{{ !(Request::is('patients/appointments*') || (Request::is('patients/patient-appointments-calendar*'))) ? 'd-none' : '' }}">
    <div class="menu-item me-lg-1 {{ (Request::is('patients/appointments*') || Request::is('patients/patient-appointments-calendar*') || Request::is('admin/admin-appointments-calendar*')) ? 'show' : ''  }}">
        <a class="menu-link py-3" href="{{ route('patients.appointments.index') }}">
            <span class="menu-title">{{ __('messages.appointments') }}</span>
        </a>
    </div>
</div>
<div class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary fw-bold {{ (!Request::is('patients/patient-visits*')) ? 'd-none' : '' }}">
    <div class="menu-item me-lg-1 {{ Request::is('patients/patient-visits*') ? 'show' : ''  }}">
        <a class="menu-link py-3" href="{{ route('patients.patient.visits.index') }}">
            <span class="menu-title">{{ __('messages.visits') }}</span>
        </a>
    </div>
</div>
<div class="menu menu-lg-rounded menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary fw-bold {{ (!Request::is('patients/transactions*')) ? 'd-none' : '' }}"
     data-kt-menu="true">
    <div class="menu-item me-lg-1 {{ Request::is('patients/transactions*') ? 'show' : ''  }}">
        <a class="menu-link py-3" href="{{ route('patients.transactions') }}">
            <span class="menu-title">{{ __('messages.transactions') }}</span>
        </a>
    </div>
</div>
<div class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary fw-bold {{ (!Request::is('patients/connect-google-calendar*')) ? 'd-none' : '' }}">
    <div class="menu-item me-lg-1 {{ Request::is('patients/connect-google-calendar*') ? 'show' : ''  }}">
        <a class="menu-link py-3" href="{{ route('patients.googleCalendar.index') }}">
            <span class="menu-title">{{__('messages.setting.connect_google_calendar')}}</span>
        </a>
    </div>
</div>
<div class="menu menu-lg-rounded menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary fw-bold {{ (!Request::is('patients/reviews*')) ? 'd-none' : '' }}"
     data-kt-menu="true">
    <div class="menu-item me-lg-1 {{ Request::is('patients/reviews*') ? 'show' : ''  }}">
        <a class="menu-link py-3" href="{{ route('patients.reviews.index') }}">
            <span class="menu-title">{{ __('messages.reviews') }}</span>
        </a>
    </div>
</div>
<div class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary fw-bold {{ (!Request::is('patients/live-consultation*')) ? 'd-none' : '' }}">
    <div class="menu-item me-lg-1 {{ Request::is('patients/live-consultation*') ? 'show' : ''  }}">
        <a class="menu-link py-3" href="{{ route('patients.live-consultation.index') }}">
            <span class="menu-title">{{__('messages.live_consultations')}}</span>
        </a>
    </div>
</div>
@endrole
@can('manage_staff')
    <div class="menu menu-lg-rounded menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary fw-bold {{ (!Request::is('admin/staff*')) ? 'd-none' : '' }}"
         data-kt-menu="true">
        <div class="menu-item me-lg-1 {{ Request::is('admin/staff*') ? 'show' : ''  }}">
            <a class="menu-link py-3" href="{{ route('staff.index') }}">
                <span class="menu-title">{{ __('messages.staffs') }}</span>
            </a>
        </div>
    </div>
@endcan
@can('manage_doctors')
    <div class="menu menu-lg-rounded menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary fw-bold 
{{ !(Request::is('admin/doctors*') || Request::is('admin/doctor-sessions*')) ? 'd-none' : '' }}">
        <div class="menu-item me-lg-1 {{ Request::is('admin/doctors*') ? 'show' : ''  }}">
            <a class="menu-link py-3" href="{{ route('doctors.index') }}">
                <span class="menu-title">{{ __('messages.doctors') }}</span>
            </a>
        </div>
    </div>
@endcan
@can('manage_doctor_sessions')
    <div class="menu menu-lg-rounded menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary fw-bold w-0
{{ !(Request::is('admin/doctors*') || Request::is('admin/doctor-sessions*')) ? 'd-none' : '' }}">
        <div class="menu-item me-lg-1 {{ Request::is('admin/doctor-sessions*') ? 'show' : ''  }}">
            <a class="menu-link py-3" href="{{ route('doctor-sessions.index') }}">
                <span class="menu-title">
                    {{ (getLogInUser()->hasRole('doctor')) ? __('messages.doctor_session.my_schedule') : __('messages.doctor_sessions') }}
                </span>
            </a>
        </div>
    </div>
@endcan
@can('manage_patients')
    <div class="menu menu-lg-rounded menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary fw-bold {{ (!Request::is('admin/patients*')) ? 'd-none' : '' }}">
        <div class="menu-item me-lg-1 {{ Request::is('admin/patients*') ? 'show' : ''  }}">
            <a class="menu-link py-3" href="{{ route('patients.index') }}">
                <span class="menu-title">{{ __('messages.patients') }}</span>
            </a>
        </div>
    </div>
@endcan
<div class="menu menu-lg-rounded menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary fw-bold 
{{ !(Request::is('admin/settings*') ||  Request::is('admin/roles*') || Request::is('admin/currencies*') || Request::is('admin/clinic-schedules*') || Request::is('admin/countries*') || Request::is('admin/states*') || Request::is('admin/cities*')) ? 'd-none' : '' }}">
    @can('manage_settings')
        <div class="menu-item me-lg-1 {{ Request::is('admin/settings*') ? 'show' : ''  }}">
            <a class="menu-link py-3" href="{{ route('setting.index') }}">
                <span class="menu-title">{{ __('messages.settings') }}</span>
            </a>
        </div>
        <div class="menu-item me-lg-1 whitespace-nowrap {{ Request::is('admin/clinic-schedules*') ? 'show' : ''  }}">
            <a class="menu-link py-3" href="{{ route('clinic-schedules.index') }}">
                <span class="menu-title">{{ __('messages.clinic_schedules') }}</span>
            </a>
        </div>
    @endcan
    @can('manage_roles')
        <div class="menu-item me-lg-1 {{ Request::is('admin/roles*')  ? 'show' : ''  }}">
            <a class="menu-link py-3" href="{{ route('roles.index') }}">
                <span class="menu-title">{{ __('messages.roles') }}</span>
            </a>
        </div>
    @endcan
    @can('manage_currencies')
        <div class="menu-item me-lg-1 {{ Request::is('admin/currencies*')  ? 'show' : ''  }}">
            <a class="menu-link py-3" href="{{ route('currencies.index') }}">
                <span class="menu-title">{{__('messages.currencies')}}</span>
            </a>
        </div>
    @endcan
    @can('manage_countries')
        <div class="menu-item me-lg-1 {{ Request::is('admin/countries*') ? 'show' : ''  }}">
            <a class="menu-link py-3" href="{{ route('countries.index') }}">
                <span class="menu-title">{{ __('messages.countries') }}</span>
            </a>
        </div>
    @endcan
    @can('manage_states')
        <div class="menu-item me-lg-1 {{ Request::is('admin/states*') ? 'show' : ''  }}">
            <a class="menu-link py-3" href="{{ route('states.index') }}">
                <span class="menu-title">{{ __('messages.states') }}</span>
            </a>
        </div>
    @endcan
    @can('manage_cities')
        <div class="menu-item me-lg-1 {{ Request::is('admin/cities*') ? 'show' : ''  }}">
            <a class="menu-link py-3" href="{{ route('cities.index') }}">
                <span class="menu-title">{{ __('messages.cities') }}</span>
            </a>
        </div>
    @endcan
</div>
@can('manage_specialities')
    <div class="menu menu-lg-rounded menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary fw-bold {{ (!Request::is('admin/specializations*')) ? 'd-none' : '' }}">
        <div class="menu-item me-lg-1 {{ Request::is('admin/specializations*') ? 'show' : ''  }}">
            <a class="menu-link py-3" href="{{ route('specializations.index') }}">
                <span class="menu-title">{{ __('messages.specializations') }}</span>
            </a>
        </div>
    </div>
@endcan
@can('manage_services')
    <div class="menu menu-lg-rounded menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary fw-bold 
{{ !(Request::is('admin/services*') || Request::is('admin/service-categories*')) ? 'd-none' : '' }}">
        <div class="menu-item me-lg-1 {{ (Request::is('admin/services*')) ? 'show' : ''  }}">
            <a class="menu-link py-3" href="{{ route('services.index') }}">
                <span class="menu-title">{{ __('messages.services') }}</span>
            </a>
        </div>
    </div>
    <div class="menu menu-lg-rounded menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary fw-bold 
{{ !(Request::is('admin/services*') || Request::is('admin/service-categories*')) ? 'd-none' : '' }}">
        <div class="menu-item me-lg-1 {{ Request::is('admin/service-categories*') ? 'show' : ''  }}">
            <a class="menu-link py-3" href="{{ route('service-categories.index') }}">
                <span class="menu-title">{{ __('messages.service_categories') }}</span>
            </a>
        </div>
    </div>
@endcan
<div class="menu menu-lg-rounded menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary fw-bold 
{{ !(Request::is('admin/appointments*') || Request::is('admin/admin-appointments-calendar*')) ? 'd-none' : '' }}">
    @can('manage_appointments')
        <div class="menu-item me-lg-1 {{ Request::is('admin/appointments*') ? 'show' : ''  }}">
            <a class="menu-link py-3" href="{{ route('appointments.index') }}">
                <span class="menu-title">{{ __('messages.appointments') }}</span>
            </a>
        </div>
    @endcan
</div>
@can('manage_patient_visits')
    <div class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary fw-bold {{ (!Request::is('admin/visits*')) ? 'd-none' : '' }}">
        <div class="menu-item me-lg-1 {{ Request::is('admin/visits*') ? 'show' : ''  }}">
            <a class="menu-link py-3" href="{{ route('visits.index') }}">
                <span class="menu-title">{{ __('messages.visits') }}</span>
            </a>
        </div>
    </div>
@endcan
<div class="menu menu-lg-rounded menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary fw-bold {{ (!Request::is('profile/edit*')) ? 'd-none' : '' }}">
    <div class="menu-item me-lg-1 {{ Request::is('profile/edit*') ? 'show' : ''  }}">
        <a class="menu-link py-3" href="{{ route('profile.setting') }}">
            <span class="menu-title">{{ __('messages.user.profile_details') }}</span>
        </a>
    </div>
</div>
@can('manage_front_cms')
    <div class="menu menu-lg-rounded menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary fw-bold {{ (!Request::is('admin/sliders*')) && (!Request::is('admin/front-services*')) && (!Request::is('admin/faqs*')) && (!Request::is('admin/front-patient-testimonials*')) && (!Request::is('admin/cms*')) ? 'd-none' : '' }}">
        <div class="menu-item me-lg-1 {{ Request::is('admin/cms*') ? 'show' : ''  }}">
            <a class="menu-link py-3" href="{{ route('cms.index') }}">
                <span class="menu-title">{{ __('messages.cms.cms') }}</span>
            </a>
        </div>
        <div class="menu-item me-lg-1 {{ Request::is('admin/sliders*') ? 'show' : ''  }}">
            <a class="menu-link py-3" href="{{ route('sliders.index') }}">
                <span class="menu-title">{{ __('messages.sliders') }}</span>
            </a>
        </div>
        <div class="menu-item me-lg-1 {{ Request::is('admin/faqs*') ? 'show' : ''  }}">
            <a class="menu-link py-3" href="{{ route('faqs.index') }}">
                <span class="menu-title">{{ __('messages.faqs') }}</span>
            </a>
        </div>
        <div class="menu-item me-lg-1 whitespace-nowrap {{ Request::is('admin/front-patient-testimonials*') ? 'show' : ''  }}">
            <a class="menu-link py-3" href="{{ route('front-patient-testimonials.index') }}">
                <span class="menu-title">{{ __('messages.front_patient_testimonials') }}</span>
            </a>
        </div>
    </div>
    <div class="menu menu-lg-rounded menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary fw-bold {{ (!Request::is('admin/enquiries*'))  ? 'd-none' : '' }}">
        <div class="menu-item me-lg-1 {{ Request::is('admin/enquiries*') ? 'show' : ''  }}">
            <a class="menu-link py-3" href="{{ route('enquiries.index') }}">
                <span class="menu-title">{{ __('messages.enquiries') }}</span>
            </a>
        </div>
    </div>
    <div class="menu menu-lg-rounded menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary fw-bold {{ (!Request::is('admin/subscribers*'))  ? 'd-none' : '' }}">
        <div class="menu-item me-lg-1 {{ Request::is('admin/subscribers*') ? 'show' : ''  }}">
            <a class="menu-link py-3" href="{{ route('subscribers.index') }}">
                <span class="menu-title">{{ __('messages.subscribers') }}</span>
            </a>
        </div>
    </div>
@endcan
@can('manage_transactions')
    <div class="menu menu-lg-rounded menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary fw-bold {{ (!Request::is('admin/transactions*')) ? 'd-none' : '' }}"
         data-kt-menu="true">
        <div class="menu-item me-lg-1 {{ Request::is('admin/transactions*') ? 'show' : ''  }}">
            <a class="menu-link py-3" href="{{ route('transactions') }}">
                <span class="menu-title">{{ __('messages.transactions') }}</span>
            </a>
        </div>
    </div>
@endcan
