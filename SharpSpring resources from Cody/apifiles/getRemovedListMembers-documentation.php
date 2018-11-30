<?php
 
   $method = 'getRemovedListMembers';                                                                 
   $params = array(

                   'where' => array(

                      'id' => '428235778',
                  ),

                   'limit' => '5',
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
{"hasMore":false,"result":{"getWherelistLeadMembers":[{"listMemberID":"1247296645122","listID":"428235778","isRemoved":"1","isUnsubscribed":"0","hardBounced":"0","leadID":"88038560770","firstname":"Lead","lastname":"One","emailaddress":"lead.one@gmail.com"},{"listMemberID":"1247296646146","listID":"428235778","isRemoved":"1","isUnsubscribed":"1","hardBounced":"0","leadID":"88038561794","firstname":"Lead","lastname":"Two","emailaddress":"lead.two@gmail.com"},"error":[],"id":""}
*/                                                                                  
  
?>