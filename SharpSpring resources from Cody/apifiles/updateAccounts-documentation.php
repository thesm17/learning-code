<?php
 
   $method = 'updateAccounts';                                                                 
   $params = array(
                   'objects' => array(
                       array(
                           'id' => '2036272130',
                           'ownerID' => '313361052',
                           'accountName' => 'Test Account API 1 Updated',
                           'industry' => 'Finance',
                           'phone' => '3528675309',
                           'annualRevenue' => '100000',
                           'numberOfEmployees' => '50',
                           'website' => 'www.testaccount1.com',
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
                           'shippingStreetAddress' => '555 SW 5th Ave'
                       ), array(
                           'id' => '2036273154',
                           'ownerID' => '313370204',
                           'accountName' => 'Test Account API 2 Updated',
                           'industry' => 'Medical',
                           'phone' => '3528675307',
                           'annualRevenue' => '1000000',
                           'numberOfEmployees' => '100',
                           'website' => 'www.testaccount2.com',
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
                           'shippingStreetAddress' => '555 SW 5th Ave'
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
{"result":{"updates":[{"success":true,"error":null},{"success":true,"error":null}]},"error":[],"id":""}
*/                                                                                 
  
?>

