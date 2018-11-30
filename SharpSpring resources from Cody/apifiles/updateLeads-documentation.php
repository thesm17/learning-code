<?php
 
   $method = 'updateLeads';                                                                 
   $params = array(
                   'objects' => array(
                       array(
                           'id' => '500232194',
                           'accountID' => '2023607298', 
                           'ownerID' => '313370204',
                           'campaignID' => '357630978',
                           'leadStatus' => 'open', // open, unqualified, qualified, contact
                           'leadScore' => '20',
                           'leadScoreWeighted' => '10',
                           'active' => '1',
                           'firstName' => 'Lead',
                           'lastName' => 'One',
                           'emailAddress' => 'lead.one@gmail.com',
                           'companyName' => 'Company One',
                           'title' => 'VPOP',
                           'street' => '555 SW 5th St',
                           'city' => 'Gainesville', 
                           'country' => 'United States',
                           'state' => 'FL', // Two letter state abbreviation
                           'zipcode' => '32601',
                           'website' => 'www.leadone.com',
                           'phoneNumber' => '5555555555',
                           'officePhoneNumber' => '0987654321',
                           'phoneNumberExtension' => '55',
                           'mobilePhoneNumber' => '3333333333',
                           'faxNumber' => '8888888888',
                           'description' => 'This is Lead One description text',
                           'industry' => 'Finance',
                           'isUnsubscribed' => '0'
                        //   'api_big_text_area_57f6638adc5b8' => 'Custom Field Text' // Custom field syntax
                       ), array(
                           'id' => '500232194',
                           'accountID' => '2023608322', 
                           'ownerID' => '313361052',
                           'campaignID' => '358784002',
                           'leadStatus' => 'unqualified',
                           'leadScore' => '100',
                           'leadScoreWeighted' => '50',
                           'active' => '1',
                           'firstName' => 'Lead',
                           'lastName' => 'Two',
                           'emailAddress' => 'lead.two@gmail.com',
                           'companyName' => 'Company Two',
                           'title' => 'CEO',
                           'street' => '777 NE 7th Ave',
                           'city' => 'Orlando', 
                           'country' => 'United States',
                           'state' => 'FL',
                           'zipcode' => '32807',
                           'website' => 'www.leadtwo.com',
                           'phoneNumber' => '7777777777',
                           'officePhoneNumber' => '1234567890',
                           'phoneNumberExtension' => '77',
                           'mobilePhoneNumber' => '2222222222',
                           'faxNumber' => '9999999999',
                           'description' => 'This is Lead Two description text',
                           'industry' => 'Marketing',
                           'isUnsubscribed' => '1'
                        //   'api_big_text_area_57f6638adc5b8' => 'Custom Field Text' // Custom field syntax
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

