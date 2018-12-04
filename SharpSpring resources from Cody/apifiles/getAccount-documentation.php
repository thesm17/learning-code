<?php
 
   $method = 'getAccount';                                                                 
   $params = array(
                'id' => '2036273154'
               );
   $requestID = session_id();     
   $accountID = 'XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX';
   $secretKey = 'XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX';                                                     
   $data = array(                                                                               
       'method' => $method,                                                                      
       'params' => $params,                                                                      
       'id' => $requestID,
       'header' => array(
          'accountID' => $accountID,
          'secretKey' => $secretKey,
          )                                                                       
   );                                                                                            
                                                                                                 
   $queryString = http_build_query(array('accountID' => $accountID, 'secretKey' => $secretKey)); 
   $url = "http://api.sharpspring.com/pubapi/v1/?$queryString";                               
                                                                                                 
   $data = json_encode($data);                                                                   
   $ch = curl_init($url);                                                                        
   curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                              
   curl_setopt($ch, CURLOPT_POSTFIELDS, $data);                                                  
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                               
   curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                   
       'Content-Type: application/json',                                                         
       'Content-Length: ' . strlen($data),
       'Expect: '
   ));                                                                                           
                                                                                                 
   $result = curl_exec($ch);                                                                     
   curl_close($ch);                                                                              
                                                                                                 
   echo $result;

// Sample Response
/* 
{"result":{"account":[{"id":"2036273154","ownerID":"313370204","accountName":"Test Account API 2","industry":"Medical","phone":null,"annualRevenue":"500","numberOfEmployees":"0","website":null,"yearStarted":null,"fax":null,"billingCity":null,"billingCountry":null,"billingPostalCode":null,"billingState":"Georgia","billingStreetAddress":null,"shippingCity":null,"shippingCountry":null,"shippingPostalCode":null,"shippingState":null,"shippingStreetAddress":null}]},"error":null,"id":""}
*/                                                                                 
  
?>

