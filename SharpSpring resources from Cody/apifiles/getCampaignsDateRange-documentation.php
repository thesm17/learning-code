<?php
 
   $method = 'getCampaignsDateRange';                                                                 
   $params = array(
                   'startDate' => '2016-10-18 00:00:00', 
                   'endDate' => '2016-10-28 23:59:59', 
                   'timestamp' => 'create'
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
{"result":{"campaign":[{"id":"358725634","campaignName":"Test Campaign","campaignType":null,"campaignAlias":null,"campaignOrigin":"SharpSpring","qty":"0","price":"0.00","goal":"0.00","otherCosts":"0.00","startDate":null,"endDate":null,"isActive":"1"},{"id":"358726658","campaignName":"Test Campaign Yo","campaignType":null,"campaignAlias":null,"campaignOrigin":"SharpSpring","qty":"0","price":"0.00","goal":"0.00","otherCosts":"0.00","startDate":null,"endDate":null,"isActive":"1"},{"id":"358727682","campaignName":"Test Campaign Again","campaignType":null,"campaignAlias":null,"campaignOrigin":"SharpSpring","qty":"0","price":"0.00","goal":"0.00","otherCosts":"0.00","startDate":null,"endDate":null,"isActive":"1"},{"id":"358782978","campaignName":"Test Campaign API","campaignType":"Social","campaignAlias":"Campaign Alias","campaignOrigin":"Salesforce","qty":"1","price":"500.00","goal":"3000.00","otherCosts":"50.00","startDate":"2016-10-23","endDate":"2016-10-29","isActive":"1"},{"id":"358784002","campaignName":"Test Campaign API Two","campaignType":"Email","campaignAlias":"Clever Nickname","campaignOrigin":"SharpSpring","qty":"2","price":"1000.00","goal":"5000.00","otherCosts":"100.00","startDate":"2016-09-23","endDate":"2016-10-21","isActive":"0"}]},"error":null,"id":""}
*/                                                                                 
  
?>

