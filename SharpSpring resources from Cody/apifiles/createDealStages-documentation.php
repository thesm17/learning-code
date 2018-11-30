<?php
 
   $method = 'createDealStages';                                                                 
   $params = array(
                   'objects' => array(
                       array(
                           'dealStageName' => 'Test Deal Stage API 1',
                           'description' => 'This is an editable Deal Stage created through the API',
                           'defaultProbability' => '10',
                           'weight' => '0', // Position in the pipeline. 0 is the first stage, n is the last
                           'isEditable' => '1'
                       ), array(
                           'dealStageName' => 'Test Deal Stage API 2',
                           'description' => 'This is a non-editable Deal Stage created through the API',
                           'defaultProbability' => '20',
                           'weight' => '10',
                           'isEditable' => '0'
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
{"result":{"creates":[{"success":true,"error":null,"id":321368066},{"success":true,"error":null,"id":321369090}]},"error":[],"id":""}
*/                                                                                 
  
?>

