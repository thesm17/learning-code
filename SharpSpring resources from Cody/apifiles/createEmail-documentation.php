<?php
 
   $method = 'createEmail';                                                                 
   $params = array(
                   'objects' => array(
                       array(
                           'html' => 'This is an example email made from the API',
                           'emailName' => 'Test Email API 1',
                           'subject' => 'This email was made through the API',
                           'fromName' => 'Scott Lavery1',
                           'fromEmail' => 'scott.lavery1@sharpspring.com',
                           'replyTo' => 'scott.lavery1@sharpspring.com',
                           'unsubCategory' => '844802',
                           'contactManager' => '0',
                           'repeatable' => '0',
                           'fromLeadOwner' => '1'
                       ), array(
                           'html' => 'This is another example email made from the API',
                           'emailName' => 'Test Email API 2',
                           'subject' => 'This email was made through the API',
                           'fromName' => 'Scott Lavery1',
                           'fromEmail' => 'scott.lavery1@sharpspring.com',
                           'replyTo' => 'scott.lavery1@sharpspring.com',
                           'unsubCategory' => '844802',
                           'contactManager' => '0',
                           'repeatable' => '0',
                           'fromLeadOwner' => '1'
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
{"result":{"creates":[{"success":true,"error":null,"id":373985282}]},"error":[],"id":""}
*/                                                                                 
  
?>



