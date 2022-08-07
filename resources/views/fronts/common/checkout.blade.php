   <!-- TEST UPDATED -->
   <!-- TEST UPDATED -->
   
    <script                                                                                                                                                                                           
     src="https://code.jquery.com/jquery-1.12.4.min.js"                                                                                                                                              
     integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="                                                                                                                                 
     crossorigin="anonymous"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.2/rollups/aes.js"></script>                                                                  
                                                                                                                                                                                                     
   <input id="Key1" name="Key1" type="hidden" value="VaMq3CyVjQw27xvY">                                                                                                                              
   <input id="Key2" name="Key2" type="hidden" value="2416340772155132">                                                                                                                                                                                                          
                                                                                                                                                                                                       
     <h3>Please Fill Following Details</h3>                                                                                                                                                                 
     <form action="https://payments.bankalfalah.com/SSO/SSO/SSO" id="PageRedirectionForm" method="post" novalidate="novalidate">                                                              
      @csrf
        <input id="AuthToken" name="AuthToken" type="hidden" value="{{$AuthToken}}">                                                                                                                                
       <input id="RequestHash" name="RequestHash" type="hidden" value="">                                                                                                                            
       <input id="ChannelId" name="ChannelId" type="hidden" value="1001">                                                                                                                            
       <input id="Currency" name="Currency" type="hidden" value="PKR">                                                                                                                               
       <input id="IsBIN" name="IsBIN" type="hidden" value="0">                                                                                     
       <input id="ReturnURL" name="ReturnURL" type="hidden" value="https://thecliniks.com">                                                                            
       <input id="MerchantId" name="MerchantId" type="hidden" value="18714">                                                                                                                           
       <input id="StoreId" name="StoreId" type="hidden" value="024124">                                                                                                                     
       <input id="MerchantHash" name="MerchantHash" type="hidden" value="LkqC6nt+PxowqA3IOdQFaMulkwAkUt0uK3rmHktpP0GhVY3FnUDy5r14dAFEjD/BLAvgGPcPSRY=">                                  
       <input id="MerchantUsername" name="MerchantUsername" type="hidden" value="ojygab">                                                                                                            
       <input id="MerchantPassword" name="MerchantPassword" type="hidden" value="q9HM1kX1gjZvFzk4yqF7CA==">        
         <div class="book-appointment-message"></div>
            <!-- Here Start INPU form  -->
        <div class="row">    
            <div class="col-md-6 form-group name-details text-start">
                    <label for="template-medical-first_name">TransactionID#:</label><span
                            class="required text-danger">*</span>
            <input class="form-control" autocomplete="off" id="TransactionReferenceNumber" name="TransactionReferenceNumber" placeholder="Order ID" type="text" readonly value="{{$HS_TransactionReferenceNumber}}">                                  
            </div>

            <div class="col-md-6 form-group name-details text-start">
                        <label for="template-medical-first_name">{{ __('messages.patient.first_name') }}:</label><span
                                class="required text-danger">*</span>
                    <input type="text" id="template-medical-first_name" name="first_name"
                class="form-control" value="{{ isset(session()->get('data')['first_name']) ? session()->get('data')['first_name'] : '' }}" placeholder="First Name">
                                                                     
            </div>
        </div>

        <div class="row">

            <div class="col-md-6 form-group name-details text-start">
                <label for="template-medical-last_name">{{ __('messages.patient.last_name') }}:</label><span
                        class="required text-danger">*</span>
                <input type="text" id="template-medical-last_name" name="last_name"
                        class="form-control" value="{{ isset(session()->get('data')['last_name']) ? session()->get('data')['last_name'] : '' }}" placeholder="Last Name">
            </div>

            
            <div class="col-md-6 form-group text-start">
                        {{ Form::label('Payment Type',__('Payment Method').':') }}<span
                                class="required text-danger">*</span>
                    <select  class="form-control" autocomplete="off" id="TransactionTypeId" name="TransactionTypeId">                                                                                                                   
                        <option value="">Select Transaction Type</option>                                                                                                                                         
                        <option value="1">Alfa Wallet</option>                                                                                                                                                    
                        <option value="2">Alfalah Bank Account</option>                                                                                                                                                
                        <option value="3">Credit/Debit Card</option>                                                                                                                                              
                    </select> 
            </div>
           

        </div>

        <div class="row">


            <div class="col-md-6 form-group text-start">
                    {{ Form::label('Service',__('messages.appointment.service').':') }}<span
                            class="required text-danger">* (Monthly)</span>
                    {{ Form::select('service_id', isset(session()->get('data')['service']) ? session()->get('data')['service'] : [] , isset(session()->get('data')['service_id']) ? session()->get('data')['service_id'] : '',['class' => 'form-select', 'data-control'=>"select2", 'id'=> 'serviceId','placeholder' => 'Select Service']) }}
            </div>

           
                <div class="col-md-3 form-group text-start">
                            {{__('messages.appointment.payable_amount')}} <span
                                class="required text-danger">*</span>
                    <input class="form-control" autocomplete="off"  id="TransactionAmount" name="TransactionAmount" placeholder="Transaction Amount" type="text" readonly value="">   

                </div>
                <div class="col-md-3 form-group text-start">
                           
                </div>
           

        </div>

        
                                                                                                                                                                                               
     	
        <div class="col-12 form-group text-center">
          <button   class="form-control" type="submit" class="btn btn-secondary btn-lg booking-button" id="run">Proceed</button>     
        </div>                                                                                                       
     </form>                                                                                                                                                                                           
                                                                                                                                                                                                       
</div>                                                                                                                                                                                    
       

        @section('front-js')
         
        <!-- Get Services Details HEre With Charges -->
        
        <script>
            $(document).ready(function () {
              
                $.ajax({
                url: route('get-service'),
                type: 'GET',
                data: {
                    
                },
                success: function success(result) {
                    if (result.success) {

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
                
                $("#TransactionAmount").val(result.data.charges);
                $('#payableAmountText').removeClass('d-none');
                $('#payableAmount').text(currencyIcon + ' ' + getFormattedPrice(result.data.charges));
                payableAmount = result.data.charges;
                charge = result.data.charges;
                }
            }
            });
        });

</script> 


        <script type="text/javascript">    
        
       
         $(function () {                                                                                                                                                                                        
                                                                                                                                                                                             
            

            $("#run").click(function (e) {                                                                                                                                                                             
                e.preventDefault();          
                
                
                var firstName = $('#template-medical-first_name').val();
                var lastName = $('#template-medical-last_name').val();
                var email = $('#template-medical-email').val();
                var services = $('#serviceId').val();
                var amount = $('#TransactionAmount').val();
                var paymentType = $('#TransactionTypeId').val(); 
                var _token = $('#csrf').val(); 
                $('.book-appointment-message').css('display', 'block');
                
                    if (firstName == '') {
                    response = '<div class="gen alert alert-danger">First name field is required. </div>';
                    $(window).scrollTop($('.appointment-form').offset().top);
                    $('.book-appointment-message').html(response).delay(5000).hide('slow');
                    return false;
                }
                
                if (lastName == '') {
                    response = '<div class="gen alert alert-danger">Last name field is required. </div>';
                    $(window).scrollTop($('.appointment-form').offset().top);
                    $('.book-appointment-message').html(response).delay(5000).hide('slow');
                    return false;
                }

                if (services == '') {
                    response = '<div class="gen alert alert-danger">Please Slecte Service for donation </div>';
                    $(window).scrollTop($('.appointment-form').offset().top);
                    $('.book-appointment-message').html(response).delay(5000).hide('slow');
                    return false;
                }


                if (paymentType == '') {
                    response = '<div class="gen alert alert-danger">Please Select Payment Type </div>';
                    $(window).scrollTop($('.appointment-form').offset().top);
                    $('.book-appointment-message').html(response).delay(5000).hide('slow');
                    return false;
                }

                if (amount == '') {
                    response = '<div class="gen alert alert-danger">Erorr in Amount </div>';
                    $(window).scrollTop($('.appointment-form').offset().top);
                    $('.book-appointment-message').html(response).delay(5000).hide('slow');
                    return false;
                }

               
                $.ajax({
                        url: '{{route('front.service.buy')}}',
                        type: 'POST',
                        data: $("#PageRedirectionForm").serialize(),
                      
                        success: function success(result) {
                        if (result.success) {
                            // var name =result.data.response;
                            // alert(name);
                            submitRequest("PageRedirectionForm");                                                                                                                                                                  
                            document.getElementById("PageRedirectionForm").submit();    

                            // if (result.data.payment_type == paytmMethod) {
                            // window.location.replace(route('paytm.init', {
                            //     'appointmentId': appointmentID
                            // }));
                            // }   

                           
                        }
                        },
                        error: function error(result) {
                        $('.book-appointment-message').css('display', 'block');
                        response = '<div class="gen alert alert-danger">' + result.responseJSON.message + '</div>';
                        $(window).scrollTop($('.appointment-form').offset().top);
                        $('.book-appointment-message').html(response).delay(5000).hide('slow');
                        },
                        complete: function complete() {
                      
                        }
                    });



                                                                                                                                                           
                });   
                
                
                



            });                                                                                                                                                                                                            
                                                                                                                                                                                                                    
                    function submitRequest(formName) {                                                                                                                                                                             
                                                                                                                                                                                                                            
                    var mapString = '', hashName = 'RequestHash';                                                                                                                                                              
                    if (formName == "HandshakeForm") {                                                                                                                                                                         
                        hashName = 'HS_' + hashName;                                                                                                                                                                           
                    }                                                                                                                                                                                                          
                                                                                                                                                                                                                            
                    $("#" + formName+" :input").each(function () {                                                                                                                                                             
                        if ($(this).attr('id') != '') {                                                                                                                                                                        
                            mapString += $(this).attr('id') + '=' + $(this).val() + '&';                                                                                                                                       
                        }                                                                                                                                                                                                      
                    });                                                                                                                                                                                                        
                                                                                                                                                                                                                            
                    $("#" + hashName).val(CryptoJS.AES.encrypt(CryptoJS.enc.Utf8.parse(mapString.substr(0, mapString.length - 1)), CryptoJS.enc.Utf8.parse($("#Key1").val()),                                                  
                        {                                                                                                                                                                                                      
                            keySize: 128 / 8,                                                                                                                                                                                  
                            iv: CryptoJS.enc.Utf8.parse($("#Key2").val()),                                                                                                                                                     
                            mode: CryptoJS.mode.CBC,                                                                                                                                                                           
                            padding: CryptoJS.pad.Pkcs7                                                                                                                                                                        
                        }));                                                                                                                                                                                                   
                    }                                                                                                                                                                                                              
                                                                                                                                                                                                                            
     </script>     
    

     
    <script src="{{ mix('assets/js/custom/input_price_format.js') }}"></script>
    
   @endsection
