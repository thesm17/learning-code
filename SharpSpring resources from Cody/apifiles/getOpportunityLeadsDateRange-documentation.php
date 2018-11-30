<?php
 
   $method = 'getOpportunityLeadsDateRange';                                                                 
   $params = array(

                  'startDate' => '2016-11-02 00:00:00', 
                   'endDate' => '2016-11-25 23:59:59', 
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
{"result":{"opportunityLead":[{"id":"3942702082","opportunityID":"905270274","leadID":"88038561794"},{"id":"3943015426","opportunityID":"905578498","leadID":"86738422786"},{"id":"3943024642","opportunityID":"905591810","leadID":"86827343874"},{"id":"3943044098","opportunityID":"905609218","leadID":"86827937794"},{"id":"3944875010","opportunityID":"907459586","leadID":"482357715970"},{"id":"3945026562","opportunityID":"905287682","leadID":"88038561794"}]},"error":null,"id":""}
*/                                                                               
  
?>