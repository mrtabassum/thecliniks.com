@extends('layouts.app')
@section('title')
    {{ __('messages.setting.connect_google_calendar') }}
@endsection
@section('content')
    <div class="container">
        @include('flash::message')
    </div>
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <div id="kt_content_container" class="container">
            @if(getLogInUser()->hasRole('doctor'))
                @if(!isset($data['checkTimeZone']->time_zone))
                    <div class="py-5">
                        <div class="d-flex align-items-center rounded py-5 px-5 bg-light-danger">
                        <span class="svg-icon svg-icon-3x svg-icon-danger me-5">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                             viewBox="0 0 24 24" fill="none">
                                                            <rect opacity="0.3" x="2" y="2" width="20" height="20"
                                                                  rx="10" fill="black"></rect>
                                                            <rect x="11" y="14" width="7" height="2" rx="1"
                                                                  transform="rotate(-90 11 14)" fill="black"></rect>
                                                            <rect x="11" y="17" width="2" height="2" rx="1"
                                                                  transform="rotate(-90 11 17)" fill="black"></rect>
                                                        </svg>
                                                    </span>
                            <div class="text-gray-700 text-danger fw-bold fs-6">Note: You must need to set your timezone
                                before integrating Google Calendar.
                            </div>
                        </div>
                    </div>
                @endif
            @endif
            @if(getLogInUser()->hasRole('patient'))
                <div class="py-5">
                    <div class="d-flex align-items-center rounded py-5 px-5 bg-light-danger">
                        <span class="svg-icon svg-icon-3x svg-icon-danger me-5">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                             viewBox="0 0 24 24" fill="none">
                                                            <rect opacity="0.3" x="2" y="2" width="20" height="20"
                                                                  rx="10" fill="black"></rect>
                                                            <rect x="11" y="14" width="7" height="2" rx="1"
                                                                  transform="rotate(-90 11 14)" fill="black"></rect>
                                                            <rect x="11" y="17" width="2" height="2" rx="1"
                                                                  transform="rotate(-90 11 17)" fill="black"></rect>
                                                        </svg>
                                                    </span>
                        <div class="text-gray-700 text-danger fw-bold fs-6">Note: We are taking the timezone of your
                            doctors while creating appointment in calendar. If Doctor have not set the timezone then it
                            will take default UTC timezone.
                        </div>
                    </div>
                </div>
            @endif
            <div class="card mb-5 mb-xl-10">
                @if(!$data['googleCalendarIntegrationExists'])
                    <div class="card-header border-0 justify-content-center cursor-pointer">
                        <div class="card-title m-0">
                            @if(getLogInUser()->hasRole('doctor'))
                                @if(!isset($data['checkTimeZone']->time_zone))
                                    <a href="{{ route('googleAuth') }}"
                                       class="btn btn-primary fw-bolder m-0 disabled">{{ __('messages.setting.connect_your_google_calendar') }}</a>
                                @else
                                    <a href="{{ route('googleAuth') }}"
                                       class="btn btn-primary fw-bolder m-0">{{ __('messages.setting.connect_your_google_calendar') }}</a>
                                @endif
                            @else
                                <a href="{{ route('googleAuth') }}"
                                   class="btn btn-primary fw-bolder m-0">{{ __('messages.setting.connect_your_google_calendar') }}</a>
                            @endif
                        </div>
                    </div>
                @else
                    <div class="card-header border-0">
                        <div class="card-title m-0">
                            <span class="fs-5 fw-bold mt-3">{{ __('messages.setting.select_your_calendars_from_google_calendar_in_which_you_want_to_create_the_appointments') }}.</span>
                        </div>
                        <div>
                            @if(getLogInUser()->hasRole('doctor'))
                                <span class="fs-6">{{ __('messages.setting.when_patient_book_an_appointment_with_you_new_appointment_will_created_on_selected_calendars') }}.</span>
                            @elseif(getLogInUser()->hasRole('patient'))
                                <span class="fs-6">{{ __('messages.setting.when_you_book_an_appointment_new_appointment_will_created_on_selected_calendars') }}.</span>
                            @endif
                        </div>
                    </div>
                
                    <div class="card-body p-sm-12 p-0">
                        {{ Form::open(['id' => 'googleCalendarForm']) }}
                        @foreach($data['googleCalendarLists'] as $googleCalendarList)
                            <div class="form-check form-check-custom form-check-solid">
                                <div class="fv-row d-flex align-items-center">
                                    {{ Form::checkbox('google_calendar[]', $googleCalendarList->id, \App\Models\AppointmentGoogleCalendar::whereGoogleCalendarListId($googleCalendarList->id)->exists(), ['class' => 'form-check-input me-5 google-calendar']) }}
                                </div>
                                <label class="col-form-label fw-bold fs-6">
                                    <span>{{ $googleCalendarList->calendar_name }}</span>
                                </label>
                            </div>
                        @endforeach
                        <div class="pt-5">
                            <div class="d-flex">
                                {{ Form::submit(__('messages.common.save'),['class' => 'btn btn-primary me-2','id'=>'submitBtn']) }}
                                <a id="syncGoogleCalendar" class="me-2 btn btn-primary fw-bolder m-0">
                                    {{ __('messages.setting.sync_your_google_calendar') }}
                                </a>
                                @if(getLogInUser()->hasRole('doctor'))
                                    <a href="{{ route('doctors.disconnectCalendar.destroy') }}" class="btn btn-danger fw-bolder m-0">{{ __('messages.setting.disconnect_your_google_calendar') }}</a>
                                @elseif(getLogInUser()->hasRole('patient'))
                                    <a href="{{ route('patients.disconnectCalendar.destroy') }}" class="btn btn-danger fw-bolder m-0">{{ __('messages.setting.disconnect_your_google_calendar') }}</a>
                                @endif
                            </div>
                        </div>
                        {{ Form::close() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
@section('page_js')
    <script>
        let doctorRole = '{{ getLogInUser()->hasRole('doctor') }}';
        let patientRole = '{{ getLogInUser()->hasRole('patient') }}';
    </script>
    <script src="{{ mix('assets/js/google_calendar/google_calendar.js') }}"></script>
@endsection
