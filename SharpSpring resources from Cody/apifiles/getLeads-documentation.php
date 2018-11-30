<?php
 
   $method = 'getLeads';                                                                 
   $params = array(

                   'where' => array(
                   //   'id' => '488139403266'
                   //   'emailAddress' => 'unique500@gmail.com'
                  ),

                  'limit' => '500',
                  'offset' => '0'
                   
                 /*  'fields' => array(
                    'firstName', 
                    'lastName', 
                    'title'
                    ) */

               );
   $requestID = session_id();     
   $accountID = 'ECCBC87E4B5CE2FE28308FD9F2A7BAF3';
   $secretKey = '58177D3CDCF0D69B52081F633A337132';                                                     
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
{"result":{"lead":[{"id":"88038560770","accountID":"2023607298","ownerID":"313370204","companyName":"Company One","title":"VPOP", "street":"555 SW 5th St","city":"Gainesville","country":"United States","state":"FL","zipcode":"32601", "website":"www.leadone.com","phoneNumber":"5555555555","officePhoneNumber":"0987654321","phoneNumberExtension":"55","mobilePhoneNumber":"3333333333","faxNumber":"8888888888","description":"This is Lead One description text","campaignID":"357630978","leadScore":"20","industry":"Finance","active":"1","isUnsubscribed":"0","updateTimestamp":"2016-11-09 17:18:22","leadScoreWeighted":"20","leadStatus":"qualified","api_big_text_area_57f6638adc5b8":""}]},"error":null,"id":""}
*/                                                                               
  
?>

