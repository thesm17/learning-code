<?php
 
   $method = 'getEmailListing';                                                                 
   $params = array(
                   
                'where' => array(
                   // 'id' => '371761154'
                  ),
                
                'limit' => '5',
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
{"hasMore":true,"result":{"getAllemailListings":[{"id":"371761154","createTimestamp":"2016-10-06 09:45:47","title":"Example Email 1","subject":"Example Subject 1","thumbnail":"basic.png"},{"id":"372310018","createTimestamp":"2016-10-10 13:37:38","title":"Example Email 2","subject":"Example Subject 2","thumbnail":null},{"id":"372311042","createTimestamp":"2016-10-10 13:37:49","title":"Example Email 3","subject":"Example Subject 3","thumbnail":null},{"id":"372320258","createTimestamp":"2016-10-10 13:48:36","title":"Example Email 4","subject":"Example Subject 4","thumbnail":null},{"id":"372322306","createTimestamp":"2016-10-10 13:50:30","title":"Example Email 5","subject":"Email Subject 5","thumbnail":null}],"hasMore":true},"error":[],"id":""}
*/                                                                                 
  
?>

