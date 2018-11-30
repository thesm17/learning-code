<?php
 
   $method = 'addListMember';                                                                 
   $params = array(
                   
                'listID' => '428231682',
                'memberID' => '482377109506'
                   
               );
   $requestID = session_id();     
   $accountID = 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx';
   $secretKey = 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx';                                                     
   $data = array(                                           x                                    
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
{"result":{"creates":[{"success":true,"error":null,"id":718897186818}]},"error":[],"id":""}
*/                                                                             
  
?>

