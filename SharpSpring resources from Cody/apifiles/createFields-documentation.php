<?php
 
   $method = 'createFields';                                                                 
   $params = array(
                   'objects' => array(
                       array(
                           'relationship' => 'lead', // lead, opportunity, account
                           'systemName' => 'Lead Field',
                           'label' => 'Lead Label',
                           'source' => 'sharpspring', // this value MUST be sharpspring
                           'dataType' => 'picklist', // string, textarea, hidden, picklist, country, state, boolean, checkbox, radio, phone, date, datetime, url, bit, upload,   attachment
                           'dataLength' => '500',
                           'isRequired' => '1',
                           'isCustom' => '1',
                           'isActive' => '1',
                           'isAvailableInContactManager' => '1',
                           'isEditableInContactManager' => '1',
                           'isAvailableInForms' => '1'
                       ), array(
                           'relationship' => 'opportunity',
                           'systemName' => 'Opportunity Field 1',
                           'label' => 'Opportunity Label',
                           'source' => 'sharpspring',
                           'dataType' => 'textarea', // string, textarea, picklist, checkbox, phone, upload
                           'dataLength' => '500',
                           'isRequired' => '0',
                           'isCustom' => '1',
                           'isActive' => '1',
                           'isAvailableInContactManager' => '0',
                           'isEditableInContactManager' => '0',
                           'isAvailableInForms' => '0',
                       ), array(
                           'relationship' => 'account',
                           'systemName' => 'Account Field',
                           'label' => 'Account Label',
                           'source' => 'sharpspring',
                           'dataType' => 'checkbox', // string, picklist, checkbox, phone, upload
                           'dataLength' => '500',
                           'isRequired' => '0',
                           'isCustom' => '1',
                           'isActive' => '1',
                           'isAvailableInContactManager' => '0',
                           'isEditableInContactManager' => '0',
                           'isAvailableInForms' => '0'
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
{"result":{"creates":[{"success":true,"error":null,"id":500232194},{"success":true,"error":null,"id":500233218},{"success":true,"error":null,"id":500234242}]},"error":[],"id":""}
*/                                                                               
  
?>

