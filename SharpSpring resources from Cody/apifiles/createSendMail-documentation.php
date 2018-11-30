<?php
 
   $method = 'createSendMail';                                                                 
   $params = array(
                  'objects' => array(
                      array( 
                        'emailID' => '1516020738', 
                        'listID' => '427083778', 
                         // 'listTagID' => 'Social',
                         // 'immediate' => '0', 
                         'date' => '11/26/2016', // mm/dd/yyyy
                         'hours' => '12', // 1-12
                         'minutes' => '50', // 0-59
                         'meridiem' => 'PM', // AM / PM
                         'sendDuplicate' => '1'
                        )
                    )
                );
   $requestID = session_id();     
   $accountID = '2_7C4DA9AAFAF0EDB9894DD62B4BD791FE';
   $secretKey = '317E92DA5D324979D752947768D52313';                                                     
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
{"result":{"actions":[{"success":true,"error":null,"jobID":55837443074}]},"error":[],"id":""}
*/                                                                                 
  
?>

