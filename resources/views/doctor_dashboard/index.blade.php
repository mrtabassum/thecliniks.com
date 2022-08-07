@extends('layouts.app')
@section('title')
    {{__('messages.dashboard')}}
@endsection
@section('page_css')
    <link href="{{ mix('assets/css/app.css') }}" rel="stylesheet" type="text/css"/>
@endsection
@section('content')
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <div id="kt_content_container" class="container">
            <div class="row g-5 gx-xxl-8 justify-content-center">
                <div class="col-xl-4 col-md-6">
                    <a href="{{ url('doctors/appointments') }}"
                       class="card bg-primary hoverable card-xl-stretch mb-xl-8">
                        <div class="card-body">
                            <span><i class="fas fa-file-medical card-icon display-4 text-white"></i></span>
                            <div class="text-inverse-primary card-count fw-bolder fs-2 mb-2 mt-5">{{$appointments['totalAppointmentCount']}}</div>
                            <div class="fw-bold text-inverse-primary fs-7">{{__('messages.doctor_dashboard.total_appointments')}}</div>
                        </div>
                    </a>
                </div>
                <div class="col-xl-4 col-md-6">
                    <a href="{{ url('doctors/appointments') }}" class="card bg-dark hoverable card-xl-stretch mb-xl-8">
                        <div class="card-body">
                            <span><i class="fas fa-calendar-alt card-icon display-4 text-white hospital-user-dark-mode"></i></span>
                            <div class="text-inverse-dark card-count fw-bolder fs-2 mb-2 mt-5">{{$appointments['todayAppointmentCount']}}</div>
                            <div class="fw-bold text-inverse-dark fs-7">{{__('messages.admin_dashboard.today_appointments')}}</div>
                        </div>
                    </a>
                </div>
                <div class="col-xl-4 col-md-6">
                    <a href="{{ url('doctors/appointments') }}"
                       class="card bg-warning hoverable card-xl-stretch mb-xl-8">
                        <div class="card-body">
                            <span><i class="fas fa-book-medical card-icon display-4 text-white"></i></span>
                            <div class="text-inverse-warning card-count fw-bolder fs-2 mb-2 mt-5">{{$appointments['upcomingAppointmentCount']}}</div>
                            <div class="fw-bold text-inverse-warning fs-7">{{__('messages.patient_dashboard.next_appointment')}}</div>
                        </div>
                    </a>
                </div>
                <div class="col-xxl-12">
                    <div class="card card-xxl-stretch mb-5 mb-xxl-8">
                        <div class="card-header border-0 pt-5">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bolder fs-3 mb-1">{{__('messages.doctor_dashboard.recent_appointments')}}</span>
                            </h3>
                            <div class="card-toolbar  ms-auto">
                                <ul class="nav">
                                    <li class="nav-item">
                                        <a class="nav-link btn btn-sm btn-color-muted btn-active btn-active-light-primary fw-bolder px-4 active"
                                           data-bs-toggle="tab" href=""
                                           id="dayData">{{__('messages.admin_dashboard.day')}}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link btn btn-sm btn-color-muted btn-active btn-active-light-primary fw-bolder px-4 me-1"
                                           data-bs-toggle="tab" href=""
                                           id="weekData">{{__('messages.admin_dashboard.week')}}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link btn btn-sm btn-color-muted btn-active btn-active-light-primary fw-bolder px-4 me-1 "
                                           data-bs-toggle="tab" href=""
                                           id="monthData">{{__('messages.admin_dashboard.month')}}</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body py-3">
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="month">
                                    <div class="table-responsive">
                                        <table class="table table-row-dashed table-row-gray-200 align-middle gs-0 gy-4">
                                            <thead>
                                            <tr class="border-0 text-uppercase">
                                                <th class="w-25px text-muted mt-1 fw-bold fs-7">{{__('messages.doctor_appointment.patient')}}</th>
                                                <th class="min-w-150px text-muted mt-1 fw-bold fs-7"></th>
                                                <th class="min-w-150px text-muted mt-1 fw-bold fs-7">{{__('messages.patient.patient_unique_id')}}</th>
                                                <th class="min-w-150px text-muted mt-1 fw-bold fs-7 text-center">{{__('messages.appointment.date')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody id="monthlyReport">
                                            @forelse($appointments['records'] as $appointment)
                                                <tr>
                                                    <td>
                                                        <div class="symbol symbol-45px me-2">
                                                            <img src="{{$appointment->patient->profile}}"
                                                                 class="symbol symbol-circle object-cover align-self-center"
                                                                 alt=""/>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <a href="{{route('doctors.patient.detail',$appointment->patient_id)}}"
                                                           class="text-primary-800 mb-1 fs-6">
                                                            {{$appointment->patient->user->fullname}}</a>
                                                        <span class="text-muted fw-bold d-block">{{$appointment->patient->user->email}}</span>
                                                    </td>
                                                    <td class="text-start">
                                                        <span class="badge badge-light-success">{{$appointment->patient->patient_unique_id}}</span>
                                                    </td>
                                                    <td class="mb-1 fs-6 text-muted fw-bold text-center">
                                                        <div class="badge badge-light-info">
                                                            <div class="mb-2">{{$appointment->from_time}} {{$appointment->from_time_type}}
                                                                - {{$appointment->to_time}} {{$appointment->to_time_type}}</div>
                                                            <div class="">{{ \Carbon\Carbon::parse($appointment->date)->format('jS M, Y')}} </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="4" class="text-center text-muted fw-bold">
                                                        {{ __('messages.common.no_data_available') }}
                                                    </td>
                                                </tr>
                                            @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="week">
                                    <div class="table-responsive">
                                        <table class="table table-row-dashed table-row-gray-200 align-middle gs-0 gy-4">
                                            <thead>
                                            <tr class="border-0 text-uppercase">
                                                <th class="w-25px text-muted mt-1 fw-bold fs-7">{{__('messages.doctor_appointment.patient')}}</th>
                                                <th class="min-w-150px text-muted mt-1 fw-bold fs-7"></th>
                                                <th class="min-w-150px text-muted mt-1 fw-bold fs-7">{{__('messages.patient.patient_unique_id')}}</th>
                                                <th class="min-w-150px text-muted mt-1 fw-bold fs-7 text-center">{{__('messages.appointment.date')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody id="weeklyReport"></tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="day">
                                    <div class="table-responsive">
                                        <table class="table table-row-dashed table-row-gray-200 align-middle gs-0 gy-4">
                                            <thead>
                                            <tr class="border-0 text-uppercase">
                                                <th class="w-25px text-muted mt-1 fw-bold fs-7">{{__('messages.doctor_appointment.patient')}}</th>
                                                <th class="min-w-150px text-muted mt-1 fw-bold fs-7"></th>
                                                <th class="min-w-150px text-muted mt-1 fw-bold fs-7">{{__('messages.patient.patient_unique_id')}}</th>
                                                <th class="min-w-150px text-muted mt-1 fw-bold fs-7 text-center">{{__('messages.appointment.date')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody id="dailyReport">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('doctor_dashboard.templates.templates')
@endsection
@section('page_js')
    <script>
        let noRecord = "{{ __('messages.common.no_data_available') }}";
    </script>
    <script src="{{mix('assets/js/dashboard/doctor-dashboard.js')}}"></script>
@endsection
