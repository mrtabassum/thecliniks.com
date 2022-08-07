<script                                                                                                                                                                                           
       src="https://code.jquery.com/jquery-1.12.4.min.js"                                                                                                                                              
       integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="                                                                                                                                 
       crossorigin="anonymous"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.2/rollups/aes.js"></script>                                                                                                                                                                              
                                                                     
                                                                                                                                                                                                   
        <input id="Key1" name="Key1" type="hidden" value="3qzgs6cqNsu3vTyf">                                                                                                                              
        <input id="Key2" name="Key2" type="hidden" value="3754274121289454">                                                                                                                               
                                                                                                                                                                                                                                                    
                                                                                                                                                                                                       
     <h3>Please Fill Following Details</h3>                                                                                                                                                                 
     <form action="https://sandbox.bankalfalah.com/SSO/SSO/SSO" id="PageRedirectionForm" method="post" novalidate="novalidate">                                                             
     	<input id="AuthToken" name="AuthToken" type="hidden" value="{{$authToken}}">                                                                                                                                
     	<input id="RequestHash" name="RequestHash" type="hidden" value="">                                                                                                                            
     	<input id="ChannelId" name="ChannelId" type="hidden" value="1001">                                                                                                                            
     	<input id="Currency" name="Currency" type="hidden" value="PKR">                                                                                                                               
         <input id="IsBIN" name="IsBIN" type="hidden" value="0">                                                                                     
     	<input id="ReturnURL" name="ReturnURL" type="hidden" value="http://thecliniks.com/">                                                                            
         <input id="MerchantId" name="MerchantId" type="hidden" value="18714">                                                                                                                           
         <input id="StoreId" name="StoreId" type="hidden" value="024124">                                                                                                                     
         <input id="MerchantHash" name="MerchantHash" type="hidden" value="OUU362MB1urWnBZMvWpf3LPkEegp8TtQEf1CYJwnFqM=">                                  
        <input id="MerchantUsername" name="MerchantUsername" type="hidden" value="luwaca">                                                                                                            
        <input id="MerchantPassword" name="MerchantPassword" type="hidden" value="fmnanR7F0gNvFzk4yqF7CA==">  
         <div class="book-appointment-message"></div>
            <!-- Here Start INPU form  -->
        <div class="row">    
            <div class="col-md-6 form-group name-details text-start">
                    <label for="template-medical-first_name">TransactionID#:</label><span
                            class="required text-danger">*</span>
            <input class="form-control" autocomplete="off" id="TransactionReferenceNumber" name="TransactionReferenceNumber" placeholder="Order ID" type="text"  value="{{$orderNo}}">                                  
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

           
                <div class="col-md-3 form-group text-start">
                            {{__('messages.appointment.payable_amount')}} <span
                                class="required text-danger">*</span>
                    <input class="form-control" autocomplete="off"  id="TransactionAmount" name="TransactionAmount" placeholder="Transaction Amount" type="text"  value="">   

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
        
        

        <script type="text/javascript">    
        
       
         $(function () {                                                                                                                                                                                        
                                                                                                                                                                                             
            

            $("#run").click(function (e) {                                                                                                                                                                             
                e.preventDefault();          
                submitRequest("PageRedirectionForm");                                                                                                                                                                  
                document.getElementById("PageRedirectionForm").submit();    
                                                                                                                                                          
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
    

     
    
   @endsection
