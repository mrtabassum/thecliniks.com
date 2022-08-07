@extends('layouts.app')
@section('title')
    {{ __('messages.appointments') }}
@endsection
@section('css_before')
    <link href="{{ asset('assets/css/plugins/fullcalendar.bundle.css') }}" rel="stylesheet" type="text/css"/>
@endsection
@section('header_toolbar')
    <div class="toolbar" id="kt_toolbar">
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <div>
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">@yield('title')</h1>
            </div>
            <div class="d-flex align-items-center py-1 ms-auto">
                <a href="{{ route('doctors.appointments') }}"
                   class="btn btn-sm btn-primary">{{ __('messages.common.back') }}</a>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <div id="kt_content_container" class="container">
            <div class="card pt-3">
                <div class="card-header">
                    <h2 class="card-title fw-bolder">{{__('messages.appointment.calendar')}}</h2>
                    <div class="d-flex">
                        <div class="d-flex align-items-center">
                            <span class="w-10px h-10px bg-primary rounded-circle me-1"></span>
                            <span class="me-4">{{\App\Models\Appointment::STATUS[1]}}</span>
                            <span class="w-10px h-10px bg-success rounded-circle me-1"></span>
                            <span class="me-4">{{\App\Models\Appointment::STATUS[2]}}</span>
                            <span class="w-10px h-10px bg-warning rounded-circle me-1"></span>
                            <span class="me-4">{{\App\Models\Appointment::STATUS[3]}}</span>
                            <span class="w-10px h-10px bg-danger rounded-circle me-1"></span>
                            <span class="me-4">{{\App\Models\Appointment::STATUS[4]}}</span>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div id="appointmentCalendar"></div>
                </div>
            </div>
        </div>
    </div>
    @include('doctor_appointment.models.show_appointment')
@endsection
@section('page_js')
    <script>
        let book = "{{ \App\Models\Appointment::BOOKED }}";
        let checkIn = "{{ \App\Models\Appointment::CHECK_IN }}";
        let checkOut = "{{ \App\Models\Appointment::CHECK_OUT }}";
        let cancel = "{{ \App\Models\Appointment::CANCELLED }}";
    </script>
    <script src="{{ asset('assets/js/plugins/fullcalendar.bundle.js') }}"></script>
    <script src="{{mix('assets/js/doctor_appointments/calendar.js')}}"></script>
@endsection 
