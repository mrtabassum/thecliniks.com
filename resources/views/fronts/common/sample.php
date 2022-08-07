<div class="form-widget p-sm-4 p-3" data-loader="button">
            <div class="form-result"></div>
         <form class="row mb-0" id="#" action="{{ route('front.service.buy')}}" method="POST">
           @csrf

            <input type="hidden" value="{{$authToken}}" name="authToken" >
            <input type="text" readonly value="{{$orderNo}}" name="orderNo" >
            
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

            <div class="col-md-6 form-group text-start">
                    <label for="template-medical-mobile">Mobile:</label><span
                       class="required text-danger">*</span>
                    <input type="text" id="template-medical-mobile" class="form-control" name="mobile" 
                         placeholder="xxx">
            </div>

            <div class="col-md-6 form-group text-start">
                    <label for="template-medical-accountNo">Account NO:</label><span
                       class="required text-danger">*</span>
                    <input type="text" id="template-medical-accountNo" class="form-control" name="accountNo"
                         placeholder="xxx">
            </div>

            <div class="col-md-6 form-group text-start">
                    {{ Form::label('Service',__('messages.appointment.service').':') }}<span
                            class="required text-danger">*</span>
                    {{ Form::select('service_id', isset(session()->get('data')['service']) ? session()->get('data')['service'] : [] , isset(session()->get('data')['service_id']) ? session()->get('data')['service_id'] : '',['class' => 'form-select', 'data-control'=>"select2", 'id'=> 'serviceId','placeholder' => 'Select Service']) }}
            </div>


            <div class="col-md-6 form-group text-start">
                    {{ Form::label('Payment Type',__('Payment Method').':') }}<span
                            class="required text-danger">*</span>
                    {{ Form::select('payment_type', getAllPaymentStatus(), null,['class' => 'form-select', 'id'=>'paymentMethod', 'data-control'=>"select2",'placeholder' => 'Select Payment Method']) }}
             </div>

             <div class="text-center form-group">
                <p class="text-uppercase mb-sm-4 mb-0 d-none"
                id="payableAmountText" > {{__('messages.appointment.payable_amount')}} : <span class="fw-bold"
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
           

        <script>
               $(document).ready(function () {
                    $(dateEle).removeAttr('disabled');
                    $.ajax({
                    url: route('get-service'),
                    type: 'GET',
                    data: {
                        // 'doctorId': $('#doctorId').val()
                    },
                    success: function success(result) {
                        if (result.success) {
                        $(dateEle).removeAttr('disabled');
                        $('#serviceId').empty();
                        $('#serviceId').append($('<option value=""></option>').text('Select Service'));
                        $.each(result.data, function (i, v) {
                            $('#serviceId').append($('<option></option>').attr('value', v.id).text(v.name));
                        });
                        $("#serviceId").selectpicker("refresh");
                        }
                    }
                    });
                

                var payableAmount = '';
                var charge = '';

                if (!($('#serviceId').val() == '')) {
                    $.ajax({
                    url: route('get-charge'),
                    type: 'GET',
                    data: {
                        'chargeId': $('#serviceId').val()
                    },
                    success: function success(result) {
                        if (result.success) {
                        $('#payableAmountText').removeClass('d-none');
                        $('#payableAmount').text(currencyIcon + ' ' + getFormattedPrice(result.data.charges));
                        payableAmount = result.data.charges;
                        charge = result.data.charges;
                        }
                    }
                    });
                }

                if (!selectedDate) {
                    return false;
                }
            });

            var payableAmount = '';
            $(document).on('change', '#serviceId', function () {
                if ($(this).val() == '') {
                $('#payableAmountText').addClass('d-none');
                return;
                }

                $.ajax({
                url: route('get-charge'),
                type: 'GET',
                data: {
                    'chargeId': $(this).val()
                },
                success: function success(result) {
                    if (result.success) {
                    $('#payableAmountText').removeClass('d-none');
                    $('#payableAmount').text(currencyIcon + ' ' + getFormattedPrice(result.data.charges));
                    payableAmount = result.data.charges;
                    charge = result.data.charges;
                    }
                }
                });
            });

    </script> 
    
    
    <script src="{{ mix('assets/js/custom/input_price_format.js') }}"></script>
    
   @endsection
