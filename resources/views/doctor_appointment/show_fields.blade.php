<div class="col-12">
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="poverview" role="tabpanel">
            <div class="card mb-5 mb-xl-10">
                <div>
                    <div class="card-body  border-top p-9">
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-bold text-muted">{{ __('messages.appointment.appointment_unique_id') }}</label>
                            <div class="col-lg-8 fv-row">
                                <span class="badge badge-light-success">{{$appointment['data']->appointment_unique_id}}</span>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-bold text-muted">{{ __('messages.appointment.appointment_at') }}</label>
                            <div class="col-lg-8 fv-row ps-2">
                                <span class="badge badge-light-info">
                                    {{ \Carbon\Carbon::parse($appointment['data']->date)->format('jS M, Y')}} {{$appointment['data']->from_time}} {{$appointment['data']->from_time_type}} - {{$appointment['data']->to_time}} {{$appointment['data']->to_time_type}}
                                </span>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-bold text-muted">{{ __('messages.doctor.status') }}</label>
                            <div class="col-lg-8 fv-row">
                                <span class="badge badge-light-{{ getStatusBadgeColor($appointment['data']->status)}}">{{\App\Models\Appointment::STATUS[$appointment['data']->status]}}</span>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-bold text-muted">{{ __('messages.appointment.patient') }}</label>
                            <div class="col-lg-8 fv-row">
                                <a href="#"
                                   class="col-lg-8 fv-row">
                                    <span class="fw-bolder fs-6 text-gray-800 text-hover-primary">{{$appointment['data']->patient->user->full_name}}</span>
                                </a>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-bold text-muted">{{ __('messages.appointment.service') }}</label>
                            <div class="col-lg-8 fv-row">
                                <span class="fw-bolder fs-6 text-gray-800">{{$appointment['data']->services->name}}</span>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-bold text-muted">{{ __('messages.doctor_appointment.amount') }}</label>
                            <div class="col-lg-8 fv-row">
                                <span class="fw-bolder fs-6 bold"><i class="fas fa-dollar-sign text-dark"></i> {{$appointment['data']->payable_amount}}</span>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-bold text-muted">{{ __('messages.patient.registered_on') }}</label>
                            <div class="col-lg-8">
                                <span class="fw-bolder fs-6 text-gray-800 me-2 " data-bs-toggle="tooltip"
                                      data-bs-placement="right"
                                      title="{{\Carbon\Carbon::parse($appointment['data']->created_at)->format('jS M Y')}}">{{$appointment['data']->created_at->diffForHumans()}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="pappointments" role="tabpanel">
            <div class="card mb-5 mb-xl-10">
                <div class="card-header border-0 cursor-pointer" role="button">
                    <div class="card-title m-0">
                        <h3 class="fw-bolder m-0">{{ __('messages.appointments') }}</h3>
                    </div>
                </div>
                <div>
                    <div class="card-body  border-top p-9">
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-bold text-muted">{{ __('messages.appointment.patient')  }}</label>
                            <div class="col-lg-8">
                                <span class="fw-bolder fs-6 text-gray-800"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


{{--<div class="flex-column flex-lg-row-auto w-100 w-xl-400px mb-10">--}}
{{--    <div class="card mb-5 mb-xl-8">--}}
{{--        <div class="card-body pt-0 pt-lg-1">--}}
{{--            <div class="card">--}}
{{--                <div class="card-body d-flex flex-center flex-column pt-12 p-9 px-0">--}}
{{--                    <div class="symbol symbol-100px symbol-circle mb-7">--}}
{{--                        <img src="{{$appointment['profile']}}" alt="image"/>--}}
{{--                    </div>--}}
{{--                    <a href="#"--}}
{{--                       class="fs-3 text-gray-800 text-hover-primary fw-bolder mb-3">{{$appointment['name']}}</a>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="d-flex flex-stack fs-4 py-3">--}}
{{--                <div class="fw-bolder rotate collapsible" data-bs-toggle="collapse" href="#kt_user_view_details"--}}
{{--                     role="button" aria-expanded="false"--}}
{{--                     aria-controls="kt_user_view_details">{{__('messages.common.details')}}--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="separator"></div>--}}
{{--            <div id="kt_user_view_details" class="collapse show">--}}
{{--                <div class="pb-5 fs-6">--}}
{{--                    <div class="fw-bolder mt-5">{{__('messages.patient.patient_unique_id')}}</div>--}}
{{--                    <div class="text-gray-600">{{$appointment['Id']}}</div>--}}
{{--                    <div class="fw-bolder mt-5">{{__('messages.user.email')}}</div>--}}
{{--                    <div class="text-gray-600">{{$appointment['email']}}</div>--}}
{{--                    <div class="fw-bolder mt-5">{{__('messages.setting.address')}}</div>--}}
{{--                    <div class="text-gray-600">{{!empty($appointment['address_one']) ? $appointment['address_one'] : 'N/A'}}--}}
{{--                        <br/>{{!empty($appointment['address_two']) ? $appointment['address_two'] : 'N/A'}}--}}
{{--                    </div>--}}
{{--                    <div class="fw-bolder mt-5">{{__('messages.common.service')}}</div>--}}
{{--                    <div class="text-gray-600">{{$appointment['service']}}</div>--}}
{{--                    <div class="fw-bolder mt-5">{{__('messages.appointment.time')}}</div>--}}
{{--                    <div class="text-gray-600">{{$appointment['from_time']}} To {{$appointment['to_time']}}</div>--}}
{{--                    <div class="fw-bolder mt-5">{{__('messages.appointment.date')}}</div>--}}
{{--                    <div class="text-gray-600">{{$appointment['dob']}}</div>--}}
{{--                    <div class="fw-bolder mt-5">{{__('messages.appointment.description')}}</div>--}}
{{--                    <div class="text-gray-600">--}}
{{--                        {{!empty($appointment['description']) ? $appointment['description'] : 'N/A'}}--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
{{--<div class="flex-lg-row-fluid ms-lg-15">--}}
{{--    <ul class="nav nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-bold mb-8">--}}
{{--        <li class="nav-item">--}}
{{--            <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab" href="#kt_user_view_overview_tab">Overview</a>--}}
{{--        </li>--}}
{{--        <li class="nav-item">--}}
{{--            <a class="nav-link text-active-primary pb-4" data-kt-countup-tabs="true" data-bs-toggle="tab"--}}
{{--               href="#kt_user_view_overview_security">Security</a>--}}
{{--        </li>--}}
{{--        <li class="nav-item">--}}
{{--            <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab"--}}
{{--               href="#kt_user_view_overview_events_and_logs_tab">Events &amp; Logs</a>--}}
{{--        </li>--}}
{{--        <li class="nav-item ms-auto">--}}
{{--            @role('doctor')--}}
{{--            <a href="{{route('doctors.appointments')}}" class="btn btn-primary ps-7" data-kt-menu-trigger="click"--}}
{{--               data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end"--}}
{{--               data-kt-menu-flip="bottom">{{__('messages.common.back')}}</a>--}}
{{--            @else--}}
{{--                <a href="{{route('appointments.index')}}" class="btn btn-primary ps-7" data-kt-menu-trigger="click"--}}
{{--                   data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end"--}}
{{--                   data-kt-menu-flip="bottom">{{__('messages.common.back')}}</a>--}}
{{--                @endrole--}}
{{--        </li>--}}
{{--    </ul>--}}
{{--    <div class="tab-content" id="myTabContent">--}}
{{--        <div class="tab-pane fade show active" id="kt_user_view_overview_tab" role="tabpanel">--}}
{{--            <div class="card card-flush mb-6 mb-xl-9">--}}
{{--                <div class="card-header mt-6">--}}
{{--                    <div class="card-title flex-column">--}}
{{--                        <h2 class="mb-1">{{__('messages.appointment.appointments_schedule')}}</h2>--}}
{{--                        <div class="fs-6 fw-bold text-gray-400">{{$appointment['count']}}{{__('messages.appointment.upcoming_meetings')}}</div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="card-body p-9 pt-4">--}}
{{--                    <ul class="nav nav-pills d-flex flex-nowrap hover-scroll-x py-2">--}}
{{--                        <li class="nav-item me-1">--}}
{{--                            <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-40px me-2 py-4 btn-active-primary"--}}
{{--                               data-bs-toggle="tab">--}}
{{--                                <span class="opacity-50 fs-7 fw-bold">{{\Carbon\Carbon::parse($appointment['date'])->format('l')}}</span>--}}
{{--                                <span class="fs-6 fw-boldest">{{\Carbon\Carbon::parse($appointment['date'])->format('d')}}</span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                    <div class="tab-content">--}}
{{--                        <div id="kt_schedule_day_0" class="tab-pane fade show">--}}
{{--                        </div>--}}
{{--                        <div class="d-flex flex-stack position-relative mt-6">--}}
{{--                            <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>--}}
{{--                            <div class="fw-bold ms-5">--}}
{{--                                <div class="fs-7 mb-1">{{$appointment['from_time'].' - '.$appointment['to_time']}}--}}
{{--                                    <span class="fs-7 text-gray-400 text-uppercase">--}}
{{--                                        {{\Carbon\Carbon::parse($appointment['from_time'])->format('A')}}</span>--}}
{{--                                </div>--}}
{{--                                <a href="#"--}}
{{--                                   class="fs-5 fw-bolder text-dark text-hover-primary mb-2">{{$appointment['service']}}</a>--}}
{{--                                <div class="fs-7 text-gray-400">{{__('messages.doctor.doctor').':'}}--}}
{{--                                    <a class="text-primary">{{$appointment['doctor']}}</a></div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
