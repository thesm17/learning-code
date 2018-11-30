<?php
 
   $method = 'getDealStages';                                                                 
   $params = array(

    // Returning deal stages with a particular id
/*
                   'where' => array(
                      'id' => '358784002'
                  ), 

                   'limit' => '1', 
                   'offset' => '0' 
*/

    // Returning all deal stages
                   'where' => array(

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
{"result":{"dealStage":[{"id":"318776322","dealStageName":"Demo","description":" The sales rep is presenting the product\/service to the prospect, allowing time for the prospect to review in detail ","defaultProbability":"50","weight":"5","isEditable":"1"},{"id":"318774274","dealStageName":"Initial Contact","description":" The sales rep is currently interacting with the prospect to determine if a sales opportunity exists. ","defaultProbability":"10","weight":"1","isEditable":"1"},{"id":"318775298","dealStageName":"Needs Analysis","description":" The sales rep is now assessing how the prospect can best benifit from using our product\/service. ","defaultProbability":"30","weight":"4","isEditable":"1"},{"id":"318778370","dealStageName":"Price Negotiation","description":" The sales representative reviews and negotiates the proposal with the prospect. ","defaultProbability":"90","weight":"7","isEditable":"1"},{"id":"318777346","dealStageName":"Proposal","description":" The sales representative delivers the proposal, or sometimes called the price quote, to the prospect. ","defaultProbability":"70","weight":"6","isEditable":"1"},{"id":"321368066","dealStageName":"Test Deal Stage API","description":" This is an editable Deal Stage created through the API ","defaultProbability":"10","weight":"2","isEditable":"1"},{"id":"321369090","dealStageName":"Test Deal Stage API 2","description":" This is a non-editable Deal Stage created through the API","defaultProbability":"20","weight":"3","isEditable":"1"}]},"error":null,"id":""}
*/                                                                                
  
?>


