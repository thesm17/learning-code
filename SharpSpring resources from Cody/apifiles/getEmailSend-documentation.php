<?php
 
   $method = 'getEmailSend';                                                                 
   $params = array(
                   
                'sendID' => '25714386946'
                   
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
{"id":null,"emailID":null,"workflowID":null,"sendCount":null,"statistics":{"numDeliveries":"11","numSends":"11","numUnopens":"11","numHardBounces":"0","numSoftBounces":"0","numBounces":"0","numClicks":"0","numOpens":"0","numUnsubscribes":"218","numSpamComplaints":"0","numDomains":0,"domains":[],"numUnsubscribeReasons":[218,0,0,0,0,0,0],"uniqueOpens":"0","uniqueClicks":"0"}}
/*                                                                               
  
?>

