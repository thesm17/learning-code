<?php
 
   $method = 'getDealStagesDateRange';                                                                 
   $params = array(
                   'startDate' => '2016-11-02 00:00:00', 
                   'endDate' => '2016-11-05 23:59:59', 
                   'timestamp' => 'create' // create or update
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
{"result":{"dealStage":[{"id":"321368066","dealStageName":"Test Deal Stage API","description":" This is an editable Deal Stage created through the API ","defaultProbability":"10","weight":"2","isEditable":"1"},{"id":"321369090","dealStageName":"Test Deal Stage API 2","description":" This is a non-editable Deal Stage created through the API","defaultProbability":"20","weight":"3","isEditable":"1"}]},"error":null,"id":""}
*/                                                                                
  
?>

