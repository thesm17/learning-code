var request = require('request');
var accountID = "614DF4BF4FEE0CE729F3484D40A0BA10";
var secretKey = "F21D9298D9DD0FCE331D5863D25F9B65";


var field1 = ({
  relationship: "lead",
  label: "fromJS5",
  dataType: "text",
  dataLength: "255",
  isRequired: "0",
  isCustom: "1",
  isActive: "1",
  isAvailableInContactManager: "1",
  isEditableInContactManager: "1",
  isAvailableInForms: "1"
});

function fieldToMethod (field) {
  return  workingBody = JSON.stringify({
    "method" : "createFields",
    "params": {
      "objects":[      
          field
      ]
    },
    "id": "1005"
    }
  ); 
}

//this function is working great.
function postToShSpFirst( accountID, secretKey, body) {  
  request.post(`https://api.sharpspring.com/pubapi/v1/?accountID=${accountID}&secretKey=${secretKey}`,{
    headers: {'Content-Type': "application/json"},    
    body
  },
  function (error, response, body) {
  if (!error && response.statusCode == 200) {
    console.log(body);
    }}
  )
}

var formattedField = fieldToMethod(field1);
//this post works perfectly, passing the workingBody to ShSp and pushes
postToShSpFirst(accountID, secretKey, formattedField);




//testing this one right now
//postToShSp(accountID, secretKey, workingBody);

/* 
uploadCsv(file f) {
  ...
  return bigOlUglyArray
}

parseCsvInto2dArray(bigUglyArray) {
  loop through and sort columns and rows so it looks like a spreadsheet. this might need to be async so it doesn't jam up on big ol rows
  ...
  return prettyArray
}

shouldColumnBeDropdown( prettyArray ) {
  first create a new 2d array dropdownValues with the same number of columns at prettyArray
  then go through each prettyArray column and see if there are more than 15 different values. If there are, the column is not supposed to be a dropdown.
    Then for these columns, push an empty 1d array to signify no dropdown values
  If there are less than 15, denote that this column might want to be a dropdown 
    Then for these columns, grab those <=15 values and add them to a corresponding array with just the dropdown values
  return  dropdownValues 
}

display


*/
