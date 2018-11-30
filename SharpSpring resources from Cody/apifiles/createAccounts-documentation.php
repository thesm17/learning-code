<?php
 
   $method = 'createAccounts';                                                                 
   $params = array(
                   'objects' => array(
                       array(
                           'ownerID' => '313361052',
                           'accountName' => 'Test Account API 1',
                           'industry' => 'Finance',
                           'phone' => '3528675377',
                           'annualRevenue' => '100000',
                           'numberOfEmployees' => '50',
                           'website' => 'www.testaccount123.com',
                           'yearStarted' => '2005',
                           'fax' => '3525555678',
                           'billingCity' => 'Gainesville',
                           'billingCountry' => 'USA',
                           'billingPostalCode' => '32601',
                           'billingState' => 'FL',
                           'billingStreetAddress' => '555 SW 5th Ave',
                           'shippingCity' => 'Gainesville',
                           'shippingCountry' => 'USA',
                           'shippingPostalCode' => '32601',
                           'shippingState' => 'FL',
                           'shippingStreetAddress' => '555 SW 5th Cir',
                        //  'account_field_58260b2c42cee' => 'Example Account Field Text' // Custom field
                       ), array(
                           'ownerID' => '313361052',
                           'accountName' => 'Test Account API 2',
                           'industry' => 'Finance',
                           'phone' => '3528675366',
                           'annualRevenue' => '100000',
                           'numberOfEmployees' => '50',
                           'website' => 'www.testaccount123.com',
                           'yearStarted' => '2005',
                           'fax' => '3525555678',
                           'billingCity' => 'Gainesville',
                           'billingCountry' => 'USA',
                           'billingPostalCode' => '32601',
                           'billingState' => 'FL',
                           'billingStreetAddress' => '555 SW 5th St',
                           'shippingCity' => 'Gainesville',
                           'shippingCountry' => 'USA',
                           'shippingPostalCode' => '32601',
                           'shippingState' => 'FL',
                           'shippingStreetAddress' => '555 SW 5th Lane'
                       )
                   )
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
{"result":{"creates":[{"success":true,"error":null,"id":2036272130},{"success":true,"error":null,"id":2036273154}]},"error":[],"id":""}
*/                                                                                 
  
?>


