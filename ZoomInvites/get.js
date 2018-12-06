//goals:
// 1. automatically register new account to the appropriate week's webinar
//      "appropriate" being the correct monday
// 2. input an email address (of a new client) and see which classes they've attended and how long
//
//

var jwt = require('jsonwebtoken');
var request = require('request');
var data;  
var token = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJPVWJlZERLYVRzbXpHanB3Mi1VODN3IiwiZXhwIjoiMTU0NjI4OTYxOCJ9.HyygVT5QIM1dp4TcmLGiCnnNXSS3STVu17P95uILud0';
// const generateJWT = () => {
//   let key = "my api key from zoom";
//   let secret = "zoom api secret";

//   var payload = {
//     iss: api_key,
//     exp:((new Date()).getTime()+5000)
//   }

//   var payload = {
//     iss: key,
//     exp:((new Date()).getTime()+5000)
//   }
//   return token = jwt.sign(payload, api_secret);

// }

const getRecentWebinars = () => {
  var data;
  return new Promise((resolve,reject) => {
    request.get('https://api.zoom.us/v2/users/qr3FSl74TEuOzC4jqlo36g/webinars?page_size=30&page_number=1', 
  {
    headers: { 'Authorization': 'Bearer '+token}},

    function(error, response, body){
    if (!error && response.statusCode == 200) {
      console.log(body)      
      resolve(body);
    } else reject(new DOMException("problem connecting to API"));
  })})

}


getRecentWebinars();