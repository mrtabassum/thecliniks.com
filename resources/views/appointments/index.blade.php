@extends('layouts.app')
@section('title')
    {{__('messages.appointment.appointments')}}
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
                    <div class="card-toolbar ms-sm-auto ms-0">
                        <div class="d-flex justify-content-start justify-content-sm-end flex-sm-row flex-column" data-kt-user-table-toolbar="base">
                            @role('patient')
                            <div class="d-flex align-items-center my-sm-0 my-1 align-self-sm-center">
                                <a href="{{ route('patients.appointments.calendar') }}"
                                   class="btn btn-icon btn-light me-2"><i
                                            class="fas fa-calendar-alt fs-2"></i></a>
                                <div class="me-4 dropdown">
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
                                                           placeholder="Pick date rage" id="patientAppointmentDate"/>
                                                </div>
                                            </div>
                                            <div class="mb-10">
                                                <label class="form-label fw-bold">{{__('messages.appointment.payment')}}</label>
                                                <div>
                                                    {{ Form::select('payment_type', \App\Models\Appointment::PAYMENT_TYPE_ALL, \App\Models\Appointment::ALL_PAYMENT,['class' => 'form-control form-control-solid form-select', 'data-control'=>"select2", 'id' => 'patientPaymentStatus']) }}
                                                </div>
                                            </div>
                                            <div class="mb-10">
                                                <label class="form-label fw-bold">{{__('messages.doctor.status')}}</label>
                                                <div>
                                                    {{ Form::select('status', $appointmentStatus, \App\Models\Appointment::BOOKED,['class' => 'form-control form-control-solid form-select', 'data-control'=>"select2", 'id' => 'patientAppointmentStatus']) }}
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
                            <div class="d-flex align-items-center my-sm-0 my-1 align-self-sm-center">
                                <a type="button" class="btn btn-primary"
                                   href="{{ route('patients.appointments.create')}}">
                                <span class="svg-icon svg-icon-2">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                         height="24px" viewBox="0 0 24 24" version="1.1">
                                        <rect fill="#000000" x="4" y="11" width="16" height="2" rx="1"/>
                                        <rect fill="#000000" opacity="0.5"
                                              transform="translate(12.000000, 12.000000) rotate(-270.000000) translate(-12.000000, -12.000000)"
                                              x="4" y="11" width="16" height="2" rx="1"/>
                                    </svg>
                                </span>{{ __('messages.appointment.add_new_appointment') }}</a>
                            </div>
                            @else
                                <div class="d-flex align-items-center my-sm-0 my-1 align-self-sm-center">
                                    <a href="{{ route('appointments.calendar') }}"
                                       class="btn btn-icon btn-light me-2">
                                        <i class="fas fa-calendar-alt fs-3"></i>
                                    </a>
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
                                                <label class="form-label fw-bold">Payment</label>
                                                <div>
                                                    {{ Form::select('payment_type', \App\Models\Appointment::PAYMENT_TYPE_ALL, \App\Models\Appointment::ALL_PAYMENT,['class' => 'form-control form-control-solid form-select', 'data-control'=>"select2", 'id' => 'paymentStatus']) }}
                                                </div>
                                            </div>
                                            <div class="mb-10">
                                                <label class="form-label fw-bold">{{__('messages.doctor.status')}}</label>
                                                <div>
                                                    {{ Form::select('status', $appointmentStatus, \App\Models\Appointment::BOOKED,['class' => 'form-control form-control-solid form-select', 'data-control'=>"select2", 'id' => 'appointmentStatus']) }}
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
                                <div class="d-flex align-items-center my-sm-0 my-1 align-self-sm-center">
                                    <a type="button" class="btn btn-primary" href="{{ route('appointments.create')}}">
                                    <span class="svg-icon svg-icon-2">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                             height="24px" viewBox="0 0 24 24" version="1.1">
                                            <rect fill="#000000" x="4" y="11" width="16" height="2" rx="1"/>
                                            <rect fill="#000000" opacity="0.5"
                                                  transform="translate(12.000000, 12.000000) rotate(-270.000000) translate(-12.000000, -12.000000)"
                                                  x="4" y="11" width="16" height="2" rx="1"/>
                                        </svg>
                                    </span>{{ __('messages.appointment.add_new_appointment') }}</a>
                                </div>
                            @endrole
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0">
                    @include('appointments.table')
                    @include('layouts.templates.actions')
                    @include('appointments.templates.templates')
                    @include('appointments.models.patient-payment-model')
                </div>
            </div>
        </div>
    </div>
    @include('appointments.models.change-payment-status-model')
@endsection
@section('page_js')
    <script src="{{asset('assets/js/plugins/daterangepicker.js')}}"></script>

    <script>
        let userRole = '{{getLogInUser()->hasRole('patient')}}';
    </script>
    <script src="{{ mix('assets/js/custom/custom-datatable.js') }}"></script>
    @if(getLogInUser()->hasRole('patient'))
        <script src="//js.stripe.com/v3/"></script>
        <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
        <script>
            let book = "{{ \App\Models\Appointment::BOOKED }}";
            let statusArray = JSON.parse('@json(\App\Models\Appointment::STATUS)');
            let appointmentStripePaymentUrl = '{{ url('appointment-stripe-charge') }}';
            let stripe = Stripe('{{ config('services.stripe.key') }}');
            let pending = "{{\App\Models\Appointment::PAYMENT_TYPE[1]}}";
            let paid = "{{\App\Models\Appointment::PAYMENT_TYPE[2]}}";
            let stripeMethod = "{{\App\Models\Appointment::STRIPE}}";
            let paystackMethod = "{{\App\Models\Appointment::PAYSTACK}}";
            let paypalMethod = "{{\App\Models\Appointment::PAYPAL}}";
            let allPaymentCount = "{{\App\Models\Appointment::ALL_PAYMENT}}";
            let razorpayMethod = "{{ \App\Models\Appointment::RAZORPAY }}";
            let authorizeMethod = "{{ \App\Models\Appointment::AUTHORIZE }}";
            let paytmMethod = "{{ \App\Models\Appointment::PAYTM }}";
            let options = {
                'key': "{{ config('payments.razorpay.key') }}",
                'amount': 0, //  100 refers to 1 
                'currency': 'INR',
                'name': "{{getAppName()}}",
                'order_id': '',
                'description': '',
                'image': '{{ asset(getAppLogo()) }}', // logo here
                'callback_url': "{{ route('razorpay.success') }}",
                'prefill': {
                    'email': '', // recipient email here
                    'name': '', // recipient name here
                    'contact': '', // recipient phone here
                    'appointmentID': '', // appointmentID here
                },
                'readonly': {
                    'name': 'true',
                    'email': 'true',
                    'contact': 'true',
                },
                'theme': {
                    'color': '#4FB281',
                },
                'modal': {
                    'ondismiss': function () {
                        $('#paymentGatewayModal').modal('hide');
                        displayErrorMessage('Payment not completed.');
                        setTimeout(function () {
                            location.reload();
                        }, 1000);
                    },
                },
            }
        </script>
        <script src="{{mix('assets/js/appointments/patient-appointments.js')}}"></script>
    @else
        <script>
            let book = "{{ \App\Models\Appointment::BOOKED }}";
            let allPaymentCount = "{{\App\Models\Appointment::ALL_PAYMENT}}";
            let checkIn = "{{ \App\Models\Appointment::CHECK_IN }}";
            let checkOut = "{{ \App\Models\Appointment::CHECK_OUT }}";
            let cancel = "{{ \App\Models\Appointment::CANCELLED }}";
            let adminRole = true;
            let pending = "{{\App\Models\Appointment::PENDING}}";
            let paid = "{{\App\Models\Appointment::PAID}}";
        </script>
        <script src="{{mix('assets/js/appointments/appointments.js')}}"></script>
    @endif
@endsection
