<?php
 
   $method = 'getOpportunities';                                                                 
   $params = array(

                   'where' => array(
                   //   'id' => '905287682',
                   //   'ownerID' => '313370204',
                   //   'dealStageID' => '318774274',
                   //   'accountID' => '2037788674',
                      'campaignID' => '357630978' 
                  ),

                   'limit' => '5',
                   'offset' => '0'

               );
   $requestID = session_id();     
   $accountID = 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx';
   $secretKey = 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx';                                                     
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
{"result":{"opportunity":[{"id":"905270274","ownerID":"313361052","dealStageID":"321368066","accountID":"2023608322","campaignID":"357630978","opportunityName":"Company Two Opportunity","probability":"10","amount":"1000","isClosed":"0","isWon":"0","closeDate":"2016-11-26 00:00:00","isActive":"1","primaryLeadID":null},{"id":"905283586","ownerID":"313371126","dealStageID":"28626","accountID":"2044170242","campaignID":357630978,"opportunityName":"API Opportunity 7","probability":"20","amount":"10000","isClosed":"0","isWon":"0","closeDate":"2016-11-26 00:00:00","isActive":"1","primaryLeadID":"88703007746"}]},"error":null,"id":""}
*/                                                                               
  
?>