var request = require('request');
var data; 

const getRecentWebinars = () => {
  var data;
  return new Promise((resolve,reject) => {
    request.get('https://api.zoom.us/v2/users/qr3FSl74TEuOzC4jqlo36g/webinars?page_size=30&page_number=1', 
  {
    headers: { 'Authorization': 'Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJPVWJlZERLYVRzbXpHanB3Mi1VODN3IiwiZXhwIjoxNjA5NDc3MTk5fQ.roNQ37Ode0xp59CTOQ-WhhfcAVcTsLfPadpmVON_1Uc'}},

    function(error, response, body){
    if (!error && response.statusCode == 200) {
      console.log(body)      
      resolve(body);
    } else reject(new DOMException("problem connecting to API"));
  })})

}


// fetch('https://api.zoom.us/v2/users/qr3FSl74TEuOzC4jqlo36g/webinars?page_size=30&page_number=1', {
//   method: 'GET',
//   headers: {
//     'Authorization': 'Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJPVWJlZERLYVRzbXpHanB3Mi1VODN3IiwiZXhwIjoxNjA5NDc3MTk5fQ.roNQ37Ode0xp59CTOQ-WhhfcAVcTsLfPadpmVON_1Uc'
//   }
// })
//     .then(function(res) {
//     return res.json();
//     })
//     .then(function(body) {
//         var output = {json: body};
//         callback(null, output);
//     })
//     .catch(callback);


// var fetch = require('fetch');
// var data; 

// const getRecentWebinars = () => {
//   fetch('https://api.zoom.us/v2/users/qr3FSl74TEuOzC4jqlo36g/webinars?page_size=30&page_number=1', {
//   method: 'GET',
//   headers: {
//     'Authorization': 'Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJPVWJlZERLYVRzbXpHanB3Mi1VODN3IiwiZXhwIjoxNjA5NDc3MTk5fQ.roNQ37Ode0xp59CTOQ-WhhfcAVcTsLfPadpmVON_1Uc'
//   }
// })
//     .then(function(res) {
//     return res.json();
//     })
//     .then(function(body) {
//         var output = {json: body};
//         callback(null, output);
//     })
//     .catch(callback);
// }


getRecentWebinars();