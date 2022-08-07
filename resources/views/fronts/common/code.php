                    

                                                                   
                                                                                                                                                                                                       
      <!-- <input id="Key1" name="Key1" type="hidden" value="VaMq3CyVjQw27xvY">                                                                                                                              
      <input id="Key2" name="Key2" type="hidden" value="2416340772155132">                                                                                                                              
                                                                                                                                                                                                 -->
        
       <!-- <input id="Key1" name="Key1" type="hidden" value="a8Rau3m8y45EeGKS">                                                                                                                              
      <input id="Key2" name="Key2" type="hidden" value="1940639605607945"> -->
                                                                                                                                                                  
      <form action="https://sandbox.bankalfalah.com/SSO/SSO/SSO" id="PageRedirectionForm" method="post" novalidate="novalidate">                                                              
          <input id="AuthToken" name="AuthToken" type="hidden" value="{{$authToken}}">                                                                                                                                
          <input id="RequestHash" name="RequestHash" type="hidden" value="">                                                                                                                            
          <input id="ChannelId" name="ChannelId" type="hidden" value="1001">                                                                                                                            
          <input id="Currency" name="Currency" type="hidden" value="PKR">                                                                                                                               
          <input id="IsBIN" name="IsBIN" type="hidden" value="0">                                                                                     
          <input id="ReturnURL" name="ReturnURL" type="hidden" value="https://thecliniks.com/">                                                                            
          <input id="MerchantId" name="MerchantId" type="hidden" value="18714">                                                                                                                           
          <input id="StoreId" name="StoreId" type="hidden" value="024124">                                                                                                                     
          <input id="MerchantHash" name="MerchantHash" type="hidden" value="OUU362MB1urWnBZMvWpf3M7IUYWergfgAKesg0sPt/8=">                                  
          <input id="MerchantUsername" name="MerchantUsername" type="hidden" value="funula">                                                                                                            
          <input id="MerchantPassword" name="MerchantPassword" type="hidden" value="0alJUxQ2v0NvFzk4yqF7CA==">                                                                                         
        
         <input autocomplete="off" id="TransactionTypeId" name="TransactionTypeId" type="hidden" value="3">                                                                                          
         
                                                                                                                                                                                           
          <input autocomplete="off" id="TransactionReferenceNumber" name="TransactionReferenceNumber" placeholder="Order ID" type="text" value="{{$orderNo}}">                                  
          <input autocomplete="off"  id="TransactionAmount" name="TransactionAmount" placeholder="Transaction Amount" type="text" value="1">                                                             
          <button type="submit" class="btn btn-custon-four btn-danger" id="run">RUN</button>                                                                                                            
                                                                                                                
      
     </form>                                                                                                                                                                                                                                                             
      <script type="text/javascript">                                                                                                                                                                   
                   
             $('#TransactionAmount').on('input',function(e){
 
                 AuthToken = $("#AuthToken").val(); 
                 Currency  = $("#Currency").val();   
                 TransactionTypeId = $("#TransactionTypeId").val();                                                                                                                                          
                 TransactionReferenceNumber = $("#TransactionReferenceNumber").val();                                                                                                                      
                 TransactionAmount = $("#TransactionAmount").val();                                                                                                                  
             
                     $.ajax({
                         type: 'POST',
                         url: route('get.mapString'),
                         data: {
 
                             AuthToken : AuthToken,                                                                                                                                             
                             Currency  : Currency,       
                             TransactionTypeId : TransactionTypeId,                                                                                                                                   
                             TransactionReferenceNumber : TransactionReferenceNumber,                                                                                                                      
                             TransactionAmount :    TransactionAmount
                          
                             
                         },
                         success: function success(result) {
                         if (result.success) {
                            requestHash = result.data;
                            $("#RequestHash").val(requestHash);
                             console.log(requestHash);
                         }
                         },
                         error: function error() {}
                     });            
           });                                                                                                                                                                                      
                                  
           
         $("#run").click(function (e) {                                                                                                                                                                             
              // e.preventDefault();                                                                                                                                                                                                      
                 document.getElementById("PageRedirectionForm").submit();                                                                                                                                               
          });                                                                                                                                                                                                        
                                                                                                                                                                                                              
                                                                                                                                                                                                                
     //  $("#getHash").click(function (e) {                                                                                                                                                                              
     //     e.preventDefault();
 
                 // AuthToken = $("#AuthToken").val(); 
                 // Currency  = $("#Currency").val();   
                 // TransactionTypeId = $("#TransactionTypeId").val();                                                                                                                                          
                 // TransactionReferenceNumber = $("#TransactionReferenceNumber").val();                                                                                                                      
                 // TransactionAmount = $("#TransactionAmount").val();                                                                                                                  
               
 
             
                 //     $.ajax({
                 //         type: 'POST',
                 //         url: route('get.mapString'),
                 //         data: {
 
                 //             AuthToken :     AuthToken,                                                                                                                                             
                 //             Currency  : Currency,       
                 //             TransactionTypeId : TransactionTypeId,                                                                                                                                   
                 //             TransactionReferenceNumber : TransactionReferenceNumber,                                                                                                                      
                 //             TransactionAmount :    TransactionAmount
                          
                             
                 //         },
                 //         success: function success(result) {
                 //         if (result.success) {
                 //            requestHash = result.data;
                 //            $("#RequestHash").val(requestHash);
                 //             console.log(requestHash);
                 //         }
                 //         },
                 //         error: function error() {}
                 //     });
                                                                                                                                                                                                 
                 
       
                                                                                                                                                                                   
 
                                                                                                                                                                                                                
      </script>                                                                                                                                                                                         
 
 
                 