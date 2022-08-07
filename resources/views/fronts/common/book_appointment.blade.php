        <div class="form-widget p-sm-4 p-3" data-loader="button">
            <div class="form-result"></div>
            <form class="row mb-0" id="frontAppointmentBook" action="{{ route('front.appointment.book') }}" method="post">
                @csrf
                <div class="book-appointment-message"></div>
                <div class="container">
                    @include('flash::message')
                </div>
                <div class="col-md-12 form-group text-start">
                    <div class="form-check">
                        <input type="checkbox" id="isPatientAccount" class="form-check-input" name="is_patient_account"
                               value="1">
                        <label class="form-check-label mb-0" for="isPatientAccount">
                            {{__('messages.web.already_have_patient_account')}}
                        </label>
                    </div>
                </div>
                <div class="col-md-6 form-group name-details text-start">
                    <label for="template-medical-first_name">{{ __('messages.patient.first_name') }}:</label><span
                            class="required text-danger">*</span>
                    <input type="text" id="template-medical-first_name" name="first_name"
                           class="form-control" value="{{ isset(session()->get('data')['first_name']) ? session()->get('data')['first_name'] : '' }}" placeholder="First Name">
                </div>
                <div class="col-md-6 form-group name-details text-start">
                    <label for="template-medical-last_name">{{ __('messages.patient.last_name') }}:</label><span
                            class="required text-danger">*</span>
                    <input type="text" id="template-medical-last_name" name="last_name"
                           class="form-control" value="{{ isset(session()->get('data')['last_name']) ? session()->get('data')['last_name'] : '' }}" placeholder="Last Name">
                </div>
                <div class="col-md-6 form-group text-start">
                    <label for="template-medical-email">{{ __('messages.patient.email') }}:</label><span
                            class="required text-danger">*</span>
                    <input type="email" id="template-medical-email" name="email"
                           class="form-control" value="{{ isset(session()->get('data')['email']) ? session()->get('data')['email'] : '' }}" placeholder="Email">
                </div>
                <div class="col-md-6 form-group d-none registered-patient text-start">
                    <label for="template-medical-first_name">{{ __('messages.web.patient_name') }}:</label>
                    <input type="text" id="patientName" readonly
                           class="form-control" value="" placeholder="Patient Name">
                </div>
                <div class="col-md-6 form-group text-start">
                    {{ Form::label('Doctor',__('messages.doctor.doctor').':') }}<span
                            class="required text-danger">*</span>
                    {{ Form::select('doctor_id', $appointmentDoctors, isset(session()->get('data')['doctor_id']) ? session()->get('data')['doctor_id'] : '',['class' => 'form-select', 'id' => 'doctorId', 'data-control'=>"select2",'placeholder' => 'Select Doctor']) }}
                </div>
                <div class="col-md-6 form-group text-start">
                    {{ Form::label('Service',__('messages.appointment.service').':') }}<span
                            class="required text-danger">*</span>
                    {{ Form::select('service_id', isset(session()->get('data')['service']) ? session()->get('data')['service'] : [] , isset(session()->get('data')['service_id']) ? session()->get('data')['service_id'] : '',['class' => 'form-select', 'data-control'=>"select2", 'id'=> 'serviceId','placeholder' => 'Select Service']) }}
                </div>
                <div class="col-md-6 form-group text-start">
                    <label for="templateAppointmentDate">{{ __('messages.appointment.appointment_date')}}: </label><span
                            class="required text-danger">*</span>
                    <input type="text" id="templateAppointmentDate" name="date" class="form-control"
                           value="{{  isset(session()->get('data')['date']) ? session()->get('data')['date'] : '' }}" placeholder="Select Date"
                           autocomplete="true" disabled readonly>
                </div>
                <div class="col-md-6 form-group text-start">
                    {{ Form::label('Payment Type',__('Payment Method').':') }}<span
                            class="required text-danger">*</span>
                    {{ Form::select('payment_type', getAllPaymentStatus(), null,['class' => 'form-select', 'id'=>'paymentMethod', 'data-control'=>"select2",'placeholder' => 'Select Payment Method']) }}
                </div>

        @php
            $styleCss = 'style';
        @endphp
        <div class="col-12 form-group text-start">
            {{ Form::label('Available Slots',__('messages.appointment.available_slot').':' ,['class' => 'form-label text-gray-700 mb-3 required']) }}
            <span class="required text-danger">*</span>
            <div class="mb-0 d-inline-flex align-items-center ms-2 appointment-container">
                <div class="d-flex align-items-center appointment-booked">
                    <div {{ $styleCss }}="height: 10px;width: 10px;background-color: #DF4F4E"></div>
                    <span class="ms-2">{{__('messages.appointment.booked')}}</span>
                </div>
                <div class="d-flex align-items-center appointment-available">
                    <div class="ms-2" {{ $styleCss }}="height: 10px;width: 10px;background-color: #5659CF !important"></div>
                    <span class="ms-2">{{__('messages.appointment.available')}}</span>
                </div>
</div>
<div class="fc-timegrid-slot  not-dark form-control form-control-solid h-300px overflow-auto">
    {{ Form::hidden('from_time', null,['id'=>'timeSlot',]) }}
    {{ Form::hidden('to_time', null,['id'=>'toTime',]) }}
    <div class="text-center d-flex flex-wrap justify-content-center px-3 max-height-235px front-slot-data"
         id="slotData"></div>
    <span class="justify-content-center d-flex p-20 no-time-slot">{{__('messages.appointment.no_slot_found')}}</span>
</div>
</div>
<div class="text-center form-group">
    <p class="text-uppercase mb-sm-4 mb-0 d-none"
       id="payableAmountText">{{__('messages.appointment.payable_amount')}} : <span class="fw-bold"
                                                                                    id="payableAmount">{{__('messages.common.n/a')}}</span>
    </p>
</div>
<div class="col-12 form-group text-center">
    <button class="btn btn-secondary btn-lg booking-button" type="submit" id="saveBtn"
            value="submit">{{__('messages.web.confirm_booking')}}
    </button>
</div>
        </form>
        </div>

        @section('front-js')
            <script src="//js.stripe.com/v3/"></script>
            <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
            <script>
                let appointmentStripePaymentUrl = '{{ url('appointment-stripe-charge') }}';
                let stripe = Stripe('{{ config('services.stripe.key') }}');
                let manually = "{{\App\Models\Appointment::MANUALLY}}";
                let paystack = "{{ \App\Models\Appointment::PAYSTACK }}";
                let paypal = "{{ \App\Models\Appointment::PAYPAL }}";
                let stripeMethod = "{{ \App\Models\Appointment::STRIPE }}";
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
                            $('.book-appointment-message').css('display', 'block');
                            let response = '<div class="gen alert alert-danger">Appointment created successfully and payment not completed.</div>';
                            $('.book-appointment-message').
                                html(response).
                                delay(5000).
                                hide('slow');
                            setTimeout(function () {
                                location.reload();
                            }, 1500);
                        },
                    },
                }
            </script>
            <script src="{{ asset('assets/js/bootstrap-datepicker/bootstrap-datepicker.js') }}"></script>
            <script src="{{ mix('assets/js/custom/input_price_format.js') }}"></script>
            <script src="{{mix('assets/js/fronts/appointments/book_appointment.js')}}"></script>
        @endsection
