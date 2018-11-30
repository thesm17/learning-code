<?php
 
   $method = 'createOpportunities';                                                                 
   $params = array(
                   'objects' => array(
                       array(
                           'ownerID' => '313370204',
                           'dealStageID' => '318774274',
                           'accountID' => '2037788674', 
                           'campaignID' => '357630978',
                           'opportunityName' => 'API Opportunity 1', 
                           'probability' => '20',
                           'amount' => '10000',
                           'isClosed' => '0',
                           'isWon' => '0',
                           'isActive' => '1',
                           'closeDate' => '2016-11-26',
                           'primaryLeadID' => '88703007746',
                         //  'custom_opp_field_5825f404aac8a' => 'Example Opp String' // Custom Opportunity Field
                       ), array(
                           'ownerID' => '313361052',
                           'dealStageID' => '318774274',
                           'accountID' => '2037788674', 
                           'campaignID' => '351586306',
                           'opportunityName' => 'API Opportunity 2',
                           'probability' => '20',
                           'amount' => '10000',
                           'isClosed' => '0',
                           'isWon' => '0',
                           'isActive' => '1',
                           'closeDate' => '2016-11-26',
                           'primaryLeadID' => '88703007746',
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
{"result":{"creates":[{"success":true,"error":null,"id":902873090},{"success":true,"error":null,"id":902873781}]},"error":[],"id":""}
*/                                                                                 
  
?>

