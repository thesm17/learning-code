<?php
 
   $method = 'getScheduleSendStatus';                                                                 
   $params = array(
                   'jobID' => '57202198530',
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
{"result":{"automationEventQueue":[{"id":"57202198530","taskID":"0","workflowID":null,"timeProcessed":"0000-00-00 00:00:00","processed":"0","workflowEventData":"{\"sendDuplicate\":true,\"email\":{\"id\":\"1516020738\",\"companyID\":\"308452689\",\"fromEmail\":\"scott.lavery@example.com\",\"fromName\":\"Scott's Tots\",\"subject\":\"deleteScheduleSend Email\",\"title\":\"deleteScheduleSend Email\"}}","whoID":"427083778","whoType":"list","whatID":"1516020738","whatType":"email","createTimestamp":"2016-11-22 06:39:33"}]},"error":null,"id":""}
*/                                                                               
  
?>

