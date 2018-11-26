var request = require('request');
var accountID = "614DF4BF4FEE0CE729F3484D40A0BA10";
var secretKey = "F21D9298D9DD0FCE331D5863D25F9B65";


var field1 = {
  relationship: "lead",
  label: "field1",
  dataType: "text",
  dataLength: "255",
  isRequired: "0",
  isCustom: "1",
  isActive: "1",
  isAvailableInContactManager: "1",
  isEditableInContactManager: "1",
  isAvailableInForms: "1"
};

var field2 = {
  relationship: "lead",
  label: "field3",
  dataType: "text",
  dataLength: "255",
  isRequired: "0",
  isCustom: "1",
  isActive: "1",
  isAvailableInContactManager: "1",
  isEditableInContactManager: "1",
  isAvailableInForms: "1"
};

var body = JSON.stringify({
  "method" : "createFields",
  "params": {
    "objects":[
      {
        relationship: "lead",
        label: "fromJS3",
        dataType: "text",
        dataLength: "255",
        isRequired: "0",
        isCustom: "1",
        isActive: "1",
        isAvailableInContactManager: "1",
        isEditableInContactManager: "1",
        isAvailableInForms: "1"
      },
      {
        relationship: "lead",
        label: "field7",
        dataType: "text",
        dataLength: "255",
        isRequired: "0",
        isCustom: "1",
        isActive: "1",
        isAvailableInContactManager: "1",
        isEditableInContactManager: "1",
        isAvailableInForms: "1"
      }
    ]
  },
  "id": "1005"
  }
);

var fieldsArray = [field1, field2];

var postheaders = {
  headers: {
    'Content-Type': "application/json"
    }
}
//console.log(fieldsArray[1]);

// var testy = fieldsArray.forEach(key => {
//   console.log(JSON.stringify(key));
//   }
// );

request.post(`https://api.sharpspring.com/pubapi/v1/?accountID=${accountID}&secretKey=${secretKey}`,{
  postheaders,
  body
},
  function (error, response, body) {
  if (!error && response.statusCode == 200) {
    console.log(body);
  }
}
);
