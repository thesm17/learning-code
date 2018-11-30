<?php
 
   $method = 'getCampaigns';                                                                 
   $params = array(
                   'where' => array(
                      'id' => '358784002'
                    ), 
                   
                   'limit' => '1', 
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
{"result":{"campaign":[{"id":"358784002","campaignName":"Test Campaign API Two","campaignType":"Email","campaignAlias":"Clever Nickname","campaignOrigin":"SharpSpring","qty":"2","price":"1000.00","goal":"5000.00","otherCosts":"100.00","startDate":"2016-09-23","endDate":"2016-10-21","isActive":"0"}]},"error":null,"id":""}
*/                                                                                 
  
?>

