<?php
   /* userID, leadID, direction, createTimestamp are required */
   date_default_timezone_set('UTC');
   $currentDatetime = new DateTime();
   $stringDate = $currentDatetime->format('Y-m-d H:i:s'); 
   $method = 'logCalls';                                                                 
   $params = array(
            'objects' => array(
                array(
                    'userID' => '313418861',
                    'leadID' => '591080979459',
                    'callResult' => 'noAnswerNoMessage',
                    'direction' => 'incoming',
                    'callNotes' => 'Some notes about the call received',
                    'createTimestamp' => '2018-06-07', 
                ),
            ),
        );
   $requestID = session_id();     
   $accountID = '7BE94B148656BA0FF0134A9B9BB42DAB';
   $secretKey = 'AEC77F9057910BE1DF6B2F319ACAF521';                                                     
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