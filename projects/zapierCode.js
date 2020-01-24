var fetch = require("node-fetch");
var inputData = {emailAddress: "smitty@sharpspring.com"}


const getLead =  () => {
  var shspOutput;
  var url = 'https://api.sharpspring.com/pubapi/v1/?accountID=ECCBC87E4B5CE2FE28308FD9F2A7BAF3&secretKey=FAE8649B15526F4349498C51D8552452';
  
  var data = { 
    method: 'getLeads',
    params: { where: { emailAddress: inputData.emailAddress } },
    id: '1000' };
  
  fetch(url, {
    method: 'POST',
    body: JSON.stringify(data),
    headers: {
      'cache-control': 'no-cache',
       'Content-Type': 'application/json' 
    },
    json: true
  })
      .then(res => res.json())
      .then(body => {
      callback(null, {shspOutput: body});
      })
      .catch(err => console.log(err));
    
  }
  
  
  getLead();