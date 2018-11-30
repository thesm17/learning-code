<?php
 
   $method = 'getEvents';                                                                 
   $params = array(

                'where' => array(
                    'leadID' => '98206572547',
                //  'createTimestamp' => '2016-11-01 00:00:00', // yyyy-mm-dd hh:mm:ss
                  ),
                
                'limit' => '3',
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
{"id":"6257358850","leadID":"49057634306","eventName":"Lead unsubscribed from email.","whatID":"372514818","whatType":"email","eventData":null,"createTimestamp":"2016-11-08 13:50:40"},{"id":"3547351042","leadID":"87910733826","eventName":"Manually added by User 1","whatID":null,"whatType":null,"eventData":null,"createTimestamp":"2016-11-07 16:00:19"},{"id":"348146690","leadID":"84355278850","eventName":"Lead opened media.","whatID":"6022146","whatType":"media","eventData":null,"createTimestamp":"2016-11-08 14:56:31"}]},"error":null,"id":""}
*/                                                                               
  
?>

