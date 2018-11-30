<?php
 
   $method = 'getUserProfiles';                                                                 
   $params = array(

                   'where' => array(
                    //  'firstName' => 'Test',
                    //  'lastName' => 'User',
                    //  'displayName' => 'Test User',
                     // 'emailAddress' => 'test.user@example.com',
                    //  'isActive' => '1',
                      'id' => '313361052',
                  ),

                   'limit' => '5',
                   'offset' => '0'

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
{"result":{"userProfile":[{"id":"313361052","firstName":"","lastName":"","displayName":"Test User","emailAddress":"test.user@example.com","isActive":"1","isReseller":"0","userTimezone":null,"phone":null}]},"error":null,"id":""}
*/                                                                               
  
?>