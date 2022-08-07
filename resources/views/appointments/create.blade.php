@extends('layouts.app')
@section('title')
    {{__('messages.appointment.add_new_appointment')}}
@endsection
@section('page_css')
    <link rel="stylesheet" href="{{asset('assets/css/plugins/flatpickr.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
@endsection
@section('header_toolbar')
    <div class="toolbar" id="kt_toolbar">
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <div>
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">@yield('title')</h1>
            </div>
            <div class="d-flex align-items-center py-1 ms-auto">
                @role('patient')
                <a href="{{ route('patients.appointments.index') }}"
                   class="btn btn-sm btn-primary">{{ __('messages.common.back') }}</a>
                @else
                    <a href="{{ route('appointments.index') }}"
                       class="btn btn-sm btn-primary">{{ __('messages.common.back') }}</a>
                    @endrole
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <div id="kt_content_container" class="container">
            <div class="d-flex flex-column flex-lg-row">
                <div class="flex-lg-row-fluid mb-10 mb-lg-0 me-lg-7 me-xl-10">
                    <div class="card">
                        <div class="card-body p-12">
                            @role('patient')
                            {{ Form::open(['route' => 'patients.appointments.store','id' => 'addAppointmentForm']) }}
                            @else
                                {{ Form::open(['route' => 'appointments.store', 'id' => 'addAppointmentForm']) }}
                                @endrole
                                <div class="card-body p-9">
                                    @include('appointments.fields')
                                    {{ Form::close() }}
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('page_js')
    <script src="//js.stripe.com/v3/"></script>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script src="{{asset('assets/js/plugins/flatpickr.js')}}"></script>
    <script>
        let manually = "{{ \App\Models\Appointment::MANUALLY }}";
        let isEdit = false;
        let userRole = '{{getLogInUser()->hasRole('patient')}}';
        let appointmentStripePaymentUrl = '{{ url('appointment-stripe-charge') }}';
        let stripe = Stripe('{{ config('services.stripe.key') }}');
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
                    displayErrorMessage('Appointment created successfully and payment not completed.');
                    setTimeout(function () {
                        location.reload();
                    }, 1500);
                },
            },
        }
    </script>
    <script src="{{mix('assets/js/appointments/create-edit.js')}}"></script>
@endsection

