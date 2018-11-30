<?php
 
   $method = 'getLeadTimeline';                                                                 
   $params = array(

                   'where' => array(
                      'whoID' => '482487539714', 
                  //   'eventName' => "The shopping cart was abandoned", // Lead's Owner was Changed, The shopping cart was abandoned,
                  //   'eventSource' => 'emailOpened', // changeLeadStatus, emailOpened, emailVisit, formSubmit, importantPageVisit, leadOwnerChange, mailboxRecv, oppCreate, outgoingCall, shoppingCartAbandoned
                  //   'whatType' => 'pageVisit', // email, mbox, opportunity, pageVisit, shoppingCartSession, sitePages
                  //   'createTimestamp' => '2015-06-09 12:00:55'
                  ),

                   'limit' => '10',
                   'offset' => '0'

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

*/                                                                                 
  
?>