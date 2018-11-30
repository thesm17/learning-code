<?php
 
   $method = 'createCampaigns';                                                                 
   $params = array(
                   'objects' => array(
                       array(
                           'campaignName' => 'Test Campaign API',
                           'campaignType' => 'Social',
                           'campaignAlias' => 'Campaign Alias',
                           'campaignOrigin' => 'Salesforce',
                           'qty' => '1',
                           'price' => '500',
                           'goal' => '3000',
                           'otherCosts' => '50',
                           'startDate' => '2016-10-23 00:00:00',
                           'endDate' => '2016-10-29 00:00:00',
                           'isActive' => '1'
                       ), array(
                           'campaignName' => 'Test Campaign API Two',
                           'campaignType' => 'Email',
                           'campaignAlias' => 'Clever Nickname',
                           'campaignOrigin' => 'SharpSpring',
                           'qty' => '2',
                           'price' => '1000',
                           'goal' => '5000',
                           'otherCosts' => '100',
                           'startDate' => '2016-09-23 00:00:00',
                           'endDate' => '2016-10-21 11:59:59',
                           'isActive' => '0'
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
{"result":{"creates":[{"success":true,"error":null,"id":358782978},{"success":true,"error":null,"id":358784002}]},"error":[],"id":""}
*/                                                                                 
  
?>

