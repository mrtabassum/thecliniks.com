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
                    <a href="{{ route('patients.appointments.index') }}"
                       class="card bg-primary hoverable card-xl-stretch mb-xl-8">
                        <div class="card-body">
                            <span><i class="fas fa-calendar-alt card-icon display-4 text-white"></i></span>
                            <div class="text-inverse-primary card-count fw-bolder fs-2 mb-2 mt-5">{{$data['todayAppointmentCount']}}</div>
                            <div class="fw-bold text-inverse-primary fs-7">{{__('messages.patient_dashboard.today_appointments')}}</div>
                        </div>
                    </a>
                </div>
                <div class="col-xl-4 col-md-6">
                    <a href="{{ route('patients.appointments.index') }}"
                       class="card bg-dark hoverable card-xl-stretch mb-xl-8">
                        <div class="card-body">
                            <span><i class="fas fa-book-medical card-icon display-4 text-white hospital-user-dark-mode"></i></span>
                            <div class="text-inverse-dark card-count fw-bolder fs-2 mb-2 mt-5">{{$data['upcomingAppointmentCount']}}</div>
                            <div class="fw-bold text-inverse-dark fs-7">{{__('messages.patient_dashboard.next_appointment')}}</div>
                        </div>
                    </a>
                </div>
                <div class="col-xl-4 col-md-6">
                    <a href="{{ route('patients.appointments.index') }}"
                       class="card bg-warning hoverable card-xl-stretch mb-xl-8">
                        <div class="card-body">
                            <span><i class="fas fa-calendar-check card-icon display-4 text-white"></i></span>
                            <div class="text-inverse-warning card-count fw-bolder fs-2 mb-2 mt-5">{{$data['completedAppointmentCount']}}</div>
                            <div class="fw-bold text-inverse-warning fs-7">{{__('messages.patient_dashboard.completed_appointments')}}</div>
                        </div>
                    </a>
                </div>
                <div class="col-xxl-6">
                    <div class="card card-xxl-stretch mb-5 mb-xxl-8">
                        <div class="card-header border-0 pt-5">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bolder fs-3 mb-1">{{__('messages.patient_dashboard.today_appointments')}}</span>
                            </h3>
                        </div>
                        <div class="card-body py-3">
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="month">
                                    <div class="table-responsive">
                                        <table class="table table-row-dashed table-row-gray-200 align-middle gs-0 gy-4">
                                            <thead>
                                            <tr class="border-0 text-uppercase">
                                                <th class="text-muted mt-1 fw-bold fs-7">{{__('messages.doctor.doctor')}}</th>
                                                <th class="text-muted mt-1 fw-bold"></th>
                                                <th class="text-muted mt-1 fw-bold fs-7 text-center">{{__('messages.appointment.time')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody id="monthlyReport">
                                            @forelse($data['todayAppointment'] as $appointment)
                                                <tr>
                                                    <td class="w-50px">
                                                        <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                            <div class="symbol-label">
                                                                <img src="{{$appointment->doctor->user->profile_image}}"
                                                                     class="w-100 object-cover"
                                                                     alt=""/>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="ps-0">
                                                        <a href="{{route('patients.doctor.detail', $appointment->doctor_id)}}"
                                                           class="text-primary-800 mb-1 fs-6">
                                                            {{$appointment->doctor->user->fullname}}</a>
                                                        <span class="text-muted fw-bold d-block">{{$appointment->doctor->user->email}}</span>
                                                    </td>
                                                    <td class="mb-1 fs-6 text-muted fw-bold text-center">
                                                        <span class="badge badge-light-info">
                                                        {{$appointment->from_time}} {{$appointment->from_time_type}}
                                                        - {{$appointment->to_time}} {{$appointment->to_time_type}}
                                                        </span>
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
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-6">
                    <div class="card card-xxl-stretch mb-5 mb-xxl-8">
                        <div class="card-header border-0 pt-5">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bolder fs-3 mb-1">{{__('messages.patient_dashboard.upcoming_appointments')}}</span>
                            </h3>
                        </div>
                        <div class="card-body py-3">
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="month">
                                    <div class="table-responsive">
                                        <table class="table table-row-dashed table-row-gray-200 align-middle gs-0 gy-4">
                                            <thead>
                                            <tr class="border-0 text-uppercase">
                                                <th class="text-muted mt-1 fw-bold fs-7">{{__('messages.doctor.doctor')}}</th>
                                                <th class="text-muted mt-1 fw-bold fs-7"></th>
                                                <th class="text-muted mt-1 fw-bold fs-7 text-center">{{__('messages.appointment.date')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody id="monthlyReport">
                                            @forelse($data['upcomingAppointment'] as $appointment)
                                                <tr>
                                                    <td class="w-50px">
                                                        <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                            <div class="symbol-label">
                                                                <img src="{{$appointment->doctor->user->profile_image}}"
                                                                     class="w-100 object-cover"
                                                                     alt=""/>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="ps-0">
                                                        <a href="{{route('patients.doctor.detail', $appointment->doctor_id)}}"
                                                           class="text-primary-800 mb-1 fs-6">
                                                            {{$appointment->doctor->user->fullname}}</a>
                                                        <span class="text-muted fw-bold d-block">{{$appointment->doctor->user->email}}</span>
                                                    </td>
                                                    <td class="mb-1 fs-6 text-muted fw-bold text-center">
                                                        <span class="badge badge-light-info">
                                                        {{ \Carbon\Carbon::parse($appointment->date)->format('jS M, Y')}} {{$appointment->from_time}} {{$appointment->from_time_type}}
                                                        - {{$appointment->to_time}} {{$appointment->to_time_type}}
                                                        </span>
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
