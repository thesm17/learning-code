<?php
 
   $method = 'getLeadsDateRange';                                                                 
   $params = array(

                   'startDate' => '2016-11-02 00:00:00', 
                   'endDate' => '2016-11-10 23:59:59', 
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
{"result":{"lead":[{"id":"88038561794","accountID":"2023608322","ownerID":"313361052","companyName":"Company Two","title":"CEO","firstName":"Lead","lastName":"Two","street":"777 NE 7th Ave","city":"Orlando","country":"United States","state":"FL","zipcode":"32807","emailAddress":"lead.two@gmail.com","website":"www.leadtwo.com","phoneNumber":"7777777777","officePhoneNumber":"1234567890","phoneNumberExtension":"77","mobilePhoneNumber":"2222222222","faxNumber":"9999999999","description":"This is Lead Two descriptiontext","campaignID":"358784002","leadScore":"18","industry":"Marketing","active":"1","isUnsubscribed":"1","updateTimestamp":"2016-11-09 22:18:22","leadStatus":"contact","api_big_text_area_57f6638adc5b8":"","youcanbookme_57fd3be859a53":""}]},"error":null,"id":""}
*/                                                                             
  
?>

