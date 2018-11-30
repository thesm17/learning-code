<?php
 
   $method = 'getEmailEvents';                                                                 
   $params = array(
                   'emailJobID' => '25146047491',
                   'eventType' => 'opens' //  clicks, opens, bounces, sends, unsubscribes
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
{"leadID":"96093177859","emailID":"57046019","emailJobID":"25146047491","createDate":"2016\/11\/01 16:37","emailAddress":"testemail1@gmail.com"},{"leadID":"97626198019","emailID":"57046019","emailJobID":"25146047491","createDate":"2016\/11\/01 16:37","emailAddress":"testemail2@gmail.com"},{"leadID":"97949194243","emailID":"57046019","emailJobID":"25146047491","createDate":"2016\/11\/01 16:21","emailAddress":"testemail3@gmail.com"}]},"error":null,"id":""}
*/                                                                                
  
?>

