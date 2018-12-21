var request = require('request');

const demoTimeField = "group_demo_date_time_selected_5bec9213aaa16";
const demoTypeField ="group_appointment_type_5bd8966a8d9dd";
const agencyDemo = "Live group demo for your Agency";
const endUserDemo = "Live group demo for your Business";
var clientData;

var 
  agencyToken,
  agencyEmail="agencydemos@sharpspring.com", 
  endUserToken, 
  endUserEmail="businessdemos@sharpspring.com";

 var jsonTestBody = {
   body: {
    firstName: "Smitty",
    lastName: "Penman",
    email: `smitty.penman+${Math.floor(Math.random(1000))}@sharpspring.com`,
    company: "SharpSpring",
    group_demo_date_time_selected_5bec9213aaa16: "12/27/2018",
    group_appointment_type_5bd8966a8d9dd : "Live group demo for your Business"
   }
 }


//For deployment use the following line:
//exports.processData = (req, res) =>  {

const processData = (req, res) =>  {
  var input = req.body;
  var status = new Promise((res, rej) => {
    clientData = parseWebhookFromDemoForm(input);
    //If agency then
    if (clientData.clientType==="agency") {
      var getRecentWebinars = new Promise((resolve,reject) => {
        request.get(`https://api.zoom.us/v2/users/${agencyEmail}/webinars?page_size=30&page_number=1`, 
        {
          headers: { 'Authorization': 'Bearer '+agencyToken}
        },
          function(error, response, body){
            if (!error && response.statusCode == 200) {
              webinars=JSON.parse(body);
              resolve(webinars);
            } else {      
              reject(new Error("Problem connecting to API"));
            }
          }
        )
      })
    };
    //if End user then
    if (clientData.clientType==="end user") {
      var getRecentWebinars = new Promise((resolve,reject) => {
        request.get(`https://api.zoom.us/v2/users/${endUserEmail}/webinars?page_size=30&page_number=1`, 
        {
          headers: { 'Authorization': 'Bearer '+endUserToken}
        },
          function(error, response, body){
            if (!error && response.statusCode == 200) {
              webinars=JSON.parse(body);
              resolve(webinars);
            } else {      
              reject(("Problem connecting to API."));
            }
          }
        )
      })
    };
    getRecentWebinars.then(function (value) {
      try{
        matchCorrectWebinar(clientData,value);
        registerContact(clientData).
          then(function(values) {
            res(values);
          });} 
      catch(error) {console.error(error); rej(error)}
    })
  });

  status.then(function(values){
    let message = req.query.message || req.body.message || 
      `Response from Zoom:\n
      ${JSON.stringify(clientData)}\n
      ${values}`;
    res.status(200).send(message);  
  })
}

function parseWebhookFromDemoForm(body) {
  /*
  body will be JSON object with field names from ShSp post back of lead data.
  Important keys are: emailAddress, firstName, lastName, organization name, and webinar time. 
  */ 

  var email, company, meetingID, user, clientType;
      
  user = {
    company: body.companyName,
    firstName: body.firstName,
    lastName: body.lastName,
    email: body.emailAddress,
    clientType,
    meetingID,
    requestedDay: body.group_demo_date_time_selected_5bec9213aaa16
  };

  if (body.group_appointment_type_5bd8966a8d9dd===agencyDemo){
    user.clientType = "agency";
  }
  else{
    user.clientType = "end user";
  }
  console.log(JSON.stringify(user));
  return user;
   };

const matchCorrectWebinar = (clientData, webinarList) => {
  let requestedDay = new Date(clientData.requestedDay);

  function sameDay(d1, d2) {
    if (d1.getFullYear() === d2.getFullYear() &&
      d1.getMonth() === d2.getMonth() &&
      d1.getDate() === d2.getDate());
  }

  var correctWebinar = webinarList.webinars.filter((webinar) => {
    let webinarDay = new Date(webinar.start_time);
    console.log(sameDay(requestedDay,webinarDay));
    return (sameDay(requestedDay,webinarDay));
    });

  if (typeof correctWebinar[0]==="undefined"){
    console.error("There is no webinar that day.");
    return new Error("No scheduled webinars next week")
  };

  clientData.meetingID=correctWebinar[0].id;
  console.log("Zoom webinar ID: "+ clientData.meetingID);
  return clientData.meetingID;
  
  }

function registerContact(clientData) {
  var body = ({
    email: clientData.email,
    first_name: clientData.firstName ,
    last_name: clientData.lastName,
    org: clientData.company,
  });

  var jsonBody = JSON.stringify(body);

  return new Promise((resolve,reject) => {
    request.post(`https://api.zoom.us/v2/webinars/${clientData.meetingID}/registrants`, 
      {
        headers: { 
          'Authorization': 'Bearer '+token,
          'Content-Type': 'application/json'
        },
        body: jsonBody
      },
      function(error, response, body){
        if (error) {reject(console.log("Issue posting to zoom: "+error));}
        console.log("Body from zoom:\n "+body+"\n");
        resolve(body); 
        }
      )
    });

}

processData(jsonTestBody,function (values) {
  console.log(values);
} )
