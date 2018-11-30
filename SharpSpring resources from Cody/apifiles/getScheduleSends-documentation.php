<?php
 
   $method = 'getScheduleSends';                                                                 
   $params = array(
                   
                'where' => array(
                    'id' => '1516020738', // jobID
                 // 'campaignName' => 'Test Campaign'
                  ),
             
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
{"sends":[{"id":"55057261570","active":"1","fromemail":"scott.lavery@example.com","fromname":"Jon Doe","senddate":"2016-10-25 00:50:02","startdate":"2016-10-25 00:50:02","subject":"Example Email 1"},{"id":"55073277954","active":"1","fromemail":"scott.lavery@gmail.com","fromname":"Jane Smith","senddate":"2016-10-25 14:40:02","startdate":"2016-10-25 14:40:02","subject":"Example Email 2"}]}
*/                                                                               
  
?>

