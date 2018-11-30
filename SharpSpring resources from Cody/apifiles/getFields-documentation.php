<?php
 
   $method = 'getFields';                                                                 
   $params = array(

                   'where' => array(
                   // 'id' => '489210882',
                   // 'label' => 'API Big Text Area',
                   // 'systemName' => 'api_big_text_area_57f6638adc5b8',
                    'isCustom' => '1'
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
{"result":{"field":[{"id":"489210882","relationship":"lead","systemName":"api_big_text_area_57f6638adc5b8","label":"API Big Text Area","source":"sharpspring","dataType":"textarea","dataLength":"10000","isRequired":"0","isCustom":"1","isAvailableInContactManager":"1","isEditableInContactManager":"1","isAvailableInForms":"0","isActive":"1"},{"id":"490936322","relationship":"lead","systemName":"youcanbookme_57fd3be859a53","label":"Youcanbookme","source":"sharpspring","dataType":"country","dataLength":"255","isRequired":"0","isCustom":"1","isAvailableInContactManager":"1","isEditableInContactManager":"1","isAvailableInForms":"0","isActive":"1"},{"id":"496961538","relationship":"account","systemName":"test_account_custom_field_581398ff1c52c","label":"Test Account Custom Field","source":"sharpspring","dataType":"string","dataLength":"255","isRequired":"0","isCustom":"1","isAvailableInContactManager":"0","isEditableInContactManager":"0","isAvailableInForms":"0","isActive":"1"}]},"error":null,"id":""}
*/                                                                                 
  
?>

