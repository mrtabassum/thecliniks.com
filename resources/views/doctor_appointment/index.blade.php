@extends('layouts.app')
@section('title')
    {{ __('messages.appointments') }}
@endsection
@section('page_css')
    <link rel="stylesheet" href="{{asset('assets/css/plugins/daterangepicker.css')}}">
    <link href="{{ mix('assets/css/app.css') }}" rel="stylesheet" type="text/css"/>
@endsection
@section('content')
    <div class="container">
        @include('flash::message')
    </div>
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <div id="kt_content_container" class="container">
            <div class="row mb-5">
                <div class="col-md-12">
                    <div class="d-flex justify-content-end">
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
            </div>
            <div class="card">
                <div class="card-header d-flex border-0 pt-6">
                    @include('layouts.search-component')
                    <div class="card-toolbar ms-auto">
                        <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                            <a href="{{ route('doctors.appointments.calendar') }}"
                               class="btn btn-icon btn-light me-2"><i
                                        class="fas fa-calendar-alt fs-2"></i></a>
                            <div class="me-4">
                                <a href="javascript:void(0)" class="btn btn-flex btn-light fw-bolder" id="filterBtn"
                                   data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end"
                                   data-kt-menu-flip="top-end">
                                    <span class="svg-icon svg-icon-5 svg-icon-gray-500 me-1">
											<svg xmlns="http://www.w3.org/2000/svg"
                                                 xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                                 viewBox="0 0 24 24" version="1.1">
												<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
													<rect x="0" y="0" width="24" height="24"/>
													<path d="M5,4 L19,4 C19.2761424,4 19.5,4.22385763 19.5,4.5 C19.5,4.60818511 19.4649111,4.71345191 19.4,4.8 L14,12 L14,20.190983 C14,20.4671254 13.7761424,20.690983 13.5,20.690983 C13.4223775,20.690983 13.3458209,20.6729105 13.2763932,20.6381966 L10,19 L10,12 L4.6,4.8 C4.43431458,4.5790861 4.4790861,4.26568542 4.7,4.1 C4.78654809,4.03508894 4.89181489,4 5,4 Z"
                                                          fill="#000000"/>
												</g>
											</svg>
										</span>{{__('messages.common.filter')}}</a>
                                <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true"
                                     id="filter">
                                    <div class="px-7 py-5">
                                        <div class="fs-5 text-dark fw-bolder">{{__('messages.common.filter_option')}}</div>
                                    </div>
                                    <div class="separator border-gray-200"></div>
                                    <div class="px-7 py-5">
                                        <div class="mb-10">
                                            <label class="form-label fw-bold">{{__('messages.appointment.date')}}</label>
                                            <div>
                                                <input class="form-control form-control-solid"
                                                       placeholder="Pick date rage" id="appointmentDate"/>
                                            </div>
                                        </div>
                                        <div class="mb-10">
                                            <label class="form-label fw-bold">{{__('messages.appointment.payment')}}</label>
                                            <div>
                                                {{ Form::select('payment_type', \App\Models\Appointment::PAYMENT_TYPE_ALL, \App\Models\Appointment::ALL_PAYMENT,['class' => 'form-control form-control-solid form-select', 'data-control'=>"select2", 'id' => 'doctorPaymentStatus']) }}
                                            </div>
                                        </div>
                                        <div class="mb-10">
                                            <label class="form-label fw-bold">{{__('messages.doctor.status')}}</label>
                                            <div>
                                                {{ Form::select('status', $appointmentStatus, \App\Models\Appointment::BOOKED,['class' => 'form-control form-control-solid form-select', 'data-control'=>"select2", 'id' => 'doctorAppointmentStatus']) }}
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-end">
                                            <button type="reset" id="resetFilter"
                                                    class="btn btn-sm btn-light btn-active-light-primary me-2"
                                                    data-kt-menu-dismiss="true">{{__('messages.common.reset')}}</button>
                                            <button type="submit" class="btn btn-sm btn-primary"
                                                    data-kt-menu-dismiss="true">{{__('messages.common.apply')}}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card pt-3">
                <div class="card-body pt-0">
                    @include('doctor_appointment.table')
                    @include('layouts.templates.actions')
                    @include('doctor_appointment.templates.templates')
                </div>
            </div>
        </div>
    </div>
    @include('appointments.models.change-payment-status-model')
@endsection
@section('page_js')
    <script>
        let book = "{{ \App\Models\Appointment::BOOKED }}";
        let checkIn = "{{ \App\Models\Appointment::CHECK_IN }}";
        let checkOut = "{{ \App\Models\Appointment::CHECK_OUT }}";
        let cancel = "{{ \App\Models\Appointment::CANCELLED }}";
        let pending = "{{\App\Models\Appointment::PENDING}}";
        let paid = "{{\App\Models\Appointment::PAID}}";
        let manually = "{{\App\Models\Appointment::MANUALLY}}";
        let allPaymentCount = "{{\App\Models\Appointment::ALL_PAYMENT}}";
    </script>
    <script src="{{asset('assets/js/plugins/daterangepicker.js')}}"></script>
    <script src="{{ mix('assets/js/custom/custom-datatable.js') }}"></script>
    <script src="{{mix('assets/js/doctor_appointments/doctor_appointments.js')}}"></script>
@endsection 
