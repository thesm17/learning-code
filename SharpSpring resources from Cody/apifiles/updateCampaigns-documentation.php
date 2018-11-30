<?php
 
   $method = 'updateCampaigns';                                                                 
   $params = array(
                   'objects' => array(
                       array(
                           'id' => '358782978',
                           'campaignName' => 'Test Campaign API New Name',
                           'campaignType' => 'Social',
                           'campaignAlias' => 'Campaign Alias',
                           'campaignOrigin' => 'Salesforce', // What is this?
                           'qty' => '1',
                           'price' => '500',
                           'goal' => '4000',
                           'otherCosts' => '50',
                           'startDate' => '2016-10-23 10:00:00',
                           'endDate' => '2016-10-29 00:00:00',
                           'isActive' => '1'
                       ), array(
                           'id' => '358784002',
                           'campaignName' => 'Test Campaign API 2',
                           'campaignType' => 'Social',
                           'campaignAlias' => 'Campaign Alias',
                           'campaignOrigin' => 'Salesforce',
                           'qty' => '1',
                           'price' => '500',
                           'goal' => '10000',
                           'otherCosts' => '50',
                           'startDate' => '2016-10-23 10:00:00',
                           'endDate' => '2016-10-29 00:00:00',
                           'isActive' => '1'
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
{"result":{"updates":[{"success":true,"error":null},{"success":true,"error":null}]},"error":[],"id":""}
*/                                                                                
  
?>

