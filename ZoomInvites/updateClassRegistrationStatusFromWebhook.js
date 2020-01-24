/*** 
 
This program receives a webhook from Zoom when a user registers for any webinar. Based on the time they chose to register for,
update three corresponding fields in ShSP: @param training_status_5cab6e1e43119 @param registered_start_date_5cab70b61e271 
and @param registered_session_5cab711e8889d 


* todo GET https://api.zoom.us/v2/report/webinars/{webinarId}/participants
* ! example webinarId is nJ3yHuSsRTWlTYx7hBK8TQ==
/
*/

var request = require("request-promise");
require('dotenv').config();

const getLead = async (email) => {
  var options = { method: 'POST',
  url: 'https://api.sharpspring.com/pubapi/v1/',
  qs: 
   { accountID: process.env.AccID,
     secretKey: process.env.SecKey },
  headers: 
   { 'cache-control': 'no-cache',
     'Content-Type': 'application/json' },
  body: 
   { method: 'getLeads',
     params: { where: { emailAddress: email } },
     id: `${Math.floor(Math.random*10000)}` },
  json: true };

  var lead = await request(options);
  return lead.result.lead[0];

}

const postLeadsToSharpSpring = async (leads) => { 
  //Prep leads with formatting
  var preformattedLeads = await prepareLeadRecords(leads);
  var allLeads = formatForPost(preformattedLeads);

  var newLeadReponse = "No new leads", updateLeadResponse = "No leads to update.";
  
  if (allLeads.newLeads.length>0){
    // [Start postLeads]
    // -- Post leads, new and updates, to ShSp.
    // -- Handle connection errors and leads not existing
    newLeadReponse = await postLeads(allLeads.newLeads, "createLeads"); }
  if (allLeads.updateLeads.length>0){
    updateLeadResponse = await postLeads(allLeads.updateLeads, "updateLeads"); }
  // [End postLeads]
  return {newLeadReponse: newLeadReponse, 
          updateLeadResponse: updateLeadResponse}
  
}

const formatForPost = (participants) => {
  var newLeads = participants.filter((lead) => {
    if (lead.method.includes("createLeads")) {return JSON.stringify(lead);}
  });

  var updateLeads = participants.filter((lead) => {
    if (lead.method.includes("updateLeads")) {return JSON.stringify(lead);}
  })

  var newLeadsArray = newLeads.map((lead) => {
    return lead.person;
  })

  var updateLeadsArray = updateLeads.map((lead) => {
    return lead.person;
  })

return {newLeads: (newLeadsArray),
        updateLeads: (updateLeadsArray)}
}

const postLeads = async (leads, method) => {
  
  var options = { method: 'POST',
  url: 'https://api.sharpspring.com/pubapi/v1/',
  qs: 
   { accountID: process.env.AccID,
     secretKey: process.env.SecKey },
  headers: 
   { 'cache-control': 'no-cache',
     'Content-Type': 'application/json' },
  body: 
   { method: method,
     params: {
       objects: leads,
      },
     id: "1001" },
  json: true };
try {
  var lead = await request(options);
  return lead;
} catch (err) {return err}
  
}

const isEssential = (topic) => {
  return (topic.toString().includes("Essential"));
}

const isSpanish = (topic) => {
  return topic.toString().includes("Curriculum Básico");
}

const getWebinar = async (webID) => {
  var options = { 
    method: 'GET',
    url: `https://api.zoom.us/v2/webinars/${webID}`,
    headers: 
    {'cache-control': 'no-cache',
      Authorization: `${process.env.ZoomToken}`,
      'Content-Type': 'application/json' } };
  try {
    var result = await (request(options));
    return JSON.parse(result);
  } catch (err) {
    console.log(err); 
    throw new Error(err)}
}

const getWebinarTime = (webinar) => {
  if (isSpanish(webinar.topic)) return "Spanish";
  else {
    var datetime = webinar.occurrences[0].start_time;
    var hour = (new Date(datetime)).getHours();
    console.log(`The webinar starts at ${hour} local time`);
    var regTime = ((hour<15) ? "Morning" : "Afternoon");
    console.log(`So the corresponding webinar will be ${regTime}`);
    return regTime;
  }
}

const getWebinarDate = (web) => {
  var dt = web.occurrences[0].start_time;
  var webDate = new Date(dt).toString();
  console.log(`The webinar starts on ${webDate}`);
  return webDate;
}

const prepareLeadRecords = async (_leads) => {
  var preparedLeads = await Promise.all([_leads].map(async(person) => {
    var data;
    var lead = await getLead(person.emailAddress);
    if (lead) {
      data = {
          person,
          method: "updateLeads"
      }
    }
    // If lead doesn't yet exist in ShSp
    else {
      person.leadStatus= "contact";
      data = {
        person,
        method: "createLeads"
      }
    }
    return data   
    }))
  return preparedLeads;
}

const displayResults = (result) => {
  console.log(`New Lead Response: ${JSON.stringify(result.newLeadReponse)}\nUpdated Lead Response: ${JSON.stringify(result.updateLeadResponse)}`);
}

const inputValidation = (input) => {
  //If webhook comes from zoom, this'll return the pared down JSON
  if (input.body.payload.object) {return input.body.payload.object}
  else {
    console.error("That type of input cannot be parsed. Check the input data and verify it follow rules from inputValidation()");
    throw new Error("Invalid data input. Cannot parse that JSON data.")
  }
}

exports.gCloudHandler = async (req, res) => {
  try {
    var response = catchAndPostNewRegistant(req);
    var message = req.query.message || req.body.message || 
      (`Response from Smitty's code: \n ${JSON.stringify(response)}`
      );

      //Send response to CGF
      res.status(200).send(message);  
  } catch (err) {
    console.error(err);
    var message = req.query.message || req.body.message || `There was an issue during the process:\n ${err}`;
    res.status(200).send(message);
    return err
  }

}

const catchAndPostNewRegistant = async (input) => {
  try{
  var data = inputValidation(input);
  var person = data.registrant, webinarID = data.id, webinarTopic = data.topic;
  console.log(`Payload information: `);
  console.table(data)
  if (isEssential(webinarTopic)||isSpanish(webinarTopic)){
      var webinar = await getWebinar(webinarID);  
      var webinarStartDate = getWebinarDate(webinar);
      var webinarStartTime = getWebinarTime(webinar);

      var lead = {
        firstName: person.first_name,
        lastName: person.last_name,
        emailAddress: person.email,
        training_status_5cab6e1e43119: "Registered",
        registered_start_date_5cab70b61e271: webinarStartDate,
        registered_session_5cab711e8889d: webinarStartTime,
        vc_referral_source_5cc9a93adf534: person.custom_questions[0].value
      }
   	console.log("Registrant data: "); 
    console.table(lead);
    var result = await postLeadsToSharpSpring(lead);
    return result;
  
    } 
  else {
    var message = `Registrant is ${person.email}. They are trying to register for ${webinarTopic}, which this code doesn't care about. ✌️`;
    console.log(message);
    return message;
    }
  } catch (err) {
    console.error(err);
    return err;
  }
}

/* For debugging: */
var fakeData = {
  body: {
    payload:{
      object: {
        id: "920125375",
        topic: "SharpSpring Virtual Classroom Essential Curriculum",
        registrant: {
          first_name: "Smitty",
          last_name: "Penman - training",
          email: `smitty+${Math.floor(Math.random()*10000)}@sharpspring.com`
        }
      }
    }}};

    //catchAndPostNewRegistant(fakeData);

  