//This code will take a field array input, post them to ShSp, then return the state of the post.
module.exports = {
  postIt: postIt
};

var request = require('request');
var accountID = "614DF4BF4FEE0CE729F3484D40A0BA10";
var secretKey = "F21D9298D9DD0FCE331D5863D25F9B65";
var pushID = Math.floor(Math.random()*100000);

var accountID, secreyKey;

var field1 = ({
  relationship: "lead",
  label: "third test picklist",
  systemName: "second test picklist",
  dataType: "picklist",
  dataLength: "255",
  isRequired: "0",
  isCustom: "1",
  isActive: "1",
  isAvailableInContactManager: "1",
  isEditableInContactManager: "1",
  isAvailableInForms: "1",
  // options: [
  //   {
  //     label: "first option",
  //     value: "first option",
  //     displayOrder: "0"
  //   },
  //   {
  //     label: "second option",
  //     value: "second option",
  //     displayOrder: "1"
  //   }
  // ]
});

var field2 = ({
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

var fields=[field1,field2];

function fieldArrayToMethod (fieldArray) {
  return  workingBody = JSON.stringify({
    "method" : "createFields",
    "params": {
      "objects": [fieldArray]      
    },
    "id": `${pushID}`
    }
  ); 
}

function postToShSp( accountID, secretKey, body) {  
  var returner = "";  
  request.post(`https://api.sharpspring.com/pubapi/v1/?accountID=${accountID}&secretKey=${secretKey}`,{
    headers: {'Content-Type': "application/json"},    
    body
  },
  function (error, response, body) {
    if (!error && response.statusCode == 200) {
    console.log(body);
    returner = body;
    }
  }
  )
  return returner;
}

function postIt (accID, secKey, fieldArray) {
  var formattedArray = fieldArrayToMethod(fieldArray);
  console.log(formattedArray);
  return postToShSp(accID, secKey, formattedArray);
}

postIt(accountID,secretKey, field1);






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
