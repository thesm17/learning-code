<?php
   /* userID, leadID, direction, createTimestamp are required */
   date_default_timezone_set('America/New_York');
   $currentDatetime = new DateTime();
   $stringDate = $currentDatetime->format('Y-m-d H:i:s');
   $method = 'logCalls';                                                                 
   $params = array(
            'objects' => array(
                array(
                    'userID' => '313396237',
                    'leadID' => '591348970499',
                    'callResult' => 'noAnswerNoMessage',
                    'direction' => 'incoming',
                    'callNotes' => 'Some notes about the call' . $stringDate,
                    'createTimestamp' => $stringDate,
                ),
            ),
        );
   $requestID = session_id();     
   $accountID = '8665EE45CF0AE7D5F8DF723093190E3C';
   $secretKey = '26E0859E8231CAE21D1D24B4B86CBE1B';                                                     
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
       'Content-Length: ' . strlen($data)                                                        
   ));                                                                                           
                                                                                                 
   $result = curl_exec($ch);                                                                     
   curl_close($ch);                                                                              
                                                                                                 
   echo $result;  

// Sample Response
/*
{"result":{"creates":[{"success":true,"error":null,"id":346743252994}]},"error":[],"id":""}
*/                                                                                
  
?>