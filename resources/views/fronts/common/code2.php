
@php 


$url = "https://payments.bankalfalah.com/HS/HS/HS";
    
     // echo $order_ids;
     $bankorderId   =  $bankorderId ; //change order id
    
    
    
      $Key1= "VaMq3CyVjQw27xvY"; //change Key1
    $Key2= "2416340772155132"; //change Key2
    $HS_ChannelId="1001"; //change Channel ID
    $HS_MerchantId="18714" ; //change Merchant ID
    $HS_StoreId="024124" ; //change Store ID
    $HS_IsRedirectionRequest  = 0;
    $HS_ReturnURL="https://thecliniks.com/"; ////change Return URL
    $HS_MerchantHash="LkqC6nt+PxowqA3IOdQFaMulkwAkUt0uK3rmHktpP0GhVY3FnUDy5r14dAFEjD/BLAvgGPcPSRY="; //change Merchat Hash
    $HS_MerchantUsername="ojygab" ; //change Merchant Username
    $HS_MerchantPassword="q9HM1kX1gjZvFzk4yqF7CA=="; //Merchant Password
    
    $HS_TransactionReferenceNumber= $bankorderId;
     $transactionTypeId = "3";
    $TransactionAmount =  0;   //change Amount
    
       $cipher="aes-128-cbc";
    
    
    $mapString = 
      "HS_ChannelId=$HS_ChannelId" 
    . "&HS_IsRedirectionRequest=$HS_IsRedirectionRequest" 
    . "&HS_MerchantId=$HS_MerchantId" 
    . "&HS_StoreId=$HS_StoreId" 
    . "&HS_ReturnURL=$HS_ReturnURL"
    . "&HS_MerchantHash=$HS_MerchantHash"
    . "&HS_MerchantUsername=$HS_MerchantUsername"
    . "&HS_MerchantPassword=$HS_MerchantPassword"
    . "&HS_TransactionReferenceNumber=$HS_TransactionReferenceNumber";
    
 
    $cipher_text = openssl_encrypt($mapString, $cipher, $Key1,   OPENSSL_RAW_DATA , $Key2);
    $hashRequest = base64_encode($cipher_text);

    
    
    //The data you want to send via POST
    $fields = [
        "HS_ChannelId"=>$HS_ChannelId,
        "HS_IsRedirectionRequest"=>$HS_IsRedirectionRequest,
        "HS_MerchantId"=> $HS_MerchantId,
        "HS_StoreId"=> $HS_StoreId,
        "HS_ReturnURL"=> $HS_ReturnURL,
        "HS_MerchantHash"=> $HS_MerchantHash,
        "HS_MerchantUsername"=> $HS_MerchantUsername,
        "HS_MerchantPassword"=> $HS_MerchantPassword,
        "HS_TransactionReferenceNumber"=> $HS_TransactionReferenceNumber,
        "HS_RequestHash"=> $hashRequest
    ];
    
    $fields_string = http_build_query($fields);
    
    //open connection
    $ch = curl_init();
    //set the url, number of POST vars, POST data
    curl_setopt($ch,CURLOPT_URL, $url);
    curl_setopt($ch,CURLOPT_POST, true);
    curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
    //So that curl_exec returns the contents of the cURL; rather than echoing it
    curl_setopt($ch,CURLOPT_RETURNTRANSFER, true); 
    //execute post
    $result = curl_exec($ch);
    
   $handshake =  json_decode($result);
   
    $AuthToken = $handshake->AuthToken;
    
    
   // echo $result ."<br>";
    //echo $AuthToken ."<br>";
  
  
  /* ==============SSO CALL ================*/
  
  // you need Auth Token & Amount Here before Hashing
  
  
  

$RequestHash1 = NULL;
$Currency = "PKR";
$IsBIN =0;

$mapStringSSo = 
"AuthToken=$AuthToken" 
. "&RequestHash=$RequestHash1" 
. "&ChannelId=$HS_ChannelId"
. "&Currency=$Currency"
. "&IsBIN=$IsBIN"
. "&ReturnURL=$HS_ReturnURL"
. "&MerchantId=$HS_MerchantId"
. "&StoreId=$HS_StoreId" 
. "&MerchantHash=$HS_MerchantHash"
. "&MerchantUsername=$HS_MerchantUsername"
. "&MerchantPassword=$HS_MerchantPassword"
. "&TransactionTypeId=3"
. "&TransactionReferenceNumber=$HS_TransactionReferenceNumber"
. "&TransactionAmount=$TransactionAmount";



//	echo $mapStringSSo."<br>";
    
     
$cipher_text = openssl_encrypt($mapStringSSo, $cipher, $Key1,   OPENSSL_RAW_DATA , $Key2);
$hashRequest1 = base64_encode($cipher_text);

//echo $hashRequest1;

//https://www.sandbox.specter.pk/?dispatch%3FRC=00&RD=PS&TS=P&O=727


?>
<h4>connecting to Alfalah...</h4>



    
    
    <form action="https://payments.bankalfalah.com/SSO/SSO/SSO" id="PageRedirectionForm" method="post" novalidate="novalidate">                                                              
     <input id="AuthToken" name="AuthToken" type="hidden" value="<?php echo $AuthToken; ?>">                                                                                                                                
     <input id="RequestHash" name="RequestHash" type="hidden" value="<?php echo $hashRequest1; ?>">                                                                                                                            
     <input id="ChannelId" name="ChannelId" type="hidden" value="<?php echo $HS_ChannelId; ?>">                                                                                                                            
     <input id="Currency" name="Currency" type="hidden" value="PKR">                                                                                                                               
     <input id="IsBIN" name="IsBIN" type="hidden" value="0">                                                                                     
     <input id="ReturnURL" name="ReturnURL" type="hidden" value="<?php echo $HS_ReturnURL; ?>">                                                                            
     <input id="MerchantId" name="MerchantId" type="hidden" value="<?php echo $HS_MerchantId;?>">                                                                                                                           
     <input id="StoreId" name="StoreId" type="hidden" value="<?php echo $HS_StoreId;?>">                                                                                                                     
     <input id="MerchantHash" name="MerchantHash" type="hidden" value="<?php echo $HS_MerchantHash;?>">                                  
     <input id="MerchantUsername" name="MerchantUsername" type="hidden" value="<?php echo $HS_MerchantUsername;?>">                                                                                                            
     <input id="MerchantPassword" name="MerchantPassword" type="hidden" value="<?php echo $HS_MerchantPassword;?>">  
    <input id="TransactionTypeId" name="TransactionTypeId" type="hidden" value="3"> 
  
       <label>Transaction  ID </label>                                                                                                                                                                   
     <input autocomplete="off" id="TransactionReferenceNumber" name="TransactionReferenceNumber" placeholder="Order ID" type="text"  value="<?php echo $HS_TransactionReferenceNumber;?>">                                  
     <label> AMOUNT </label>  
     <input autocomplete="off"  id="TransactionAmount" name="TransactionAmount" placeholder="Transaction Amount" type="text" value="" >  
      
 
             <br>
 <center>	<button type="submit" class="btn btn-custon-four btn-danger" id="pay">Pay Online</button>              </center>                                                                                                    
 </form> 
            
    
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
    <script type="text/javascript">


        $(document).ready(function () {
        $( "#run" ).click(function() {
            
        });
        $("#pay").click(function (e) {                                                                                                                                                                             
                // e.preventDefault();                                                                                                                                                                                    
                submitRequest("PageRedirectionForm");                                                                                                                                                                  
                document.getElementById("PageRedirectionForm").submit();                                                                                                                                               
                });                                                                                                                                                                                                        
            });   
            </script>

@endphp