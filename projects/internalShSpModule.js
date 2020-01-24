/*
Project goals:

-make something internal for me for my future projects having to do with interacting with ShSp's animationPlayState: 

sharpie.init("31234234","234234234")
sharpie.init({id: "31234234",secKey: "234234234"})

sharpie.go("getLeads",{emailAddress: "smitty@sharpspring.com"}, true);
sharpie.go("updateLeads",[{emailAddress:"smitty@sharpspring.com",},{},{}],true);

Sometimes we need to have the @param "where": {}, "objects": [], or strictly "id": "234324"
*/

var Sharpie = (function() {
  var configured = {keys: "false", method: "false", word: "false"},
  word="where", createNew=true;
  var myConfig = {
    method: 'POST',
    url: 'https://api.sharpspring.com/pubapi/v1/',
    qs: 
    { accountID: "",
      secretKey: "" },
    headers: { 
      'cache-control': 'no-cache',
      'Content-Type': 'application/json' },
    body: { 
      method,
      params,
      id: `${Math.floor(Math.random(100000))}` },
  json: true 
};
  

  init = function (accountID, secretKey) {
    myConfig.qs.accountID=accountID;
    myConfig.qs.secretKey=secretKey;
    configured.keys=true;
  }

  go = function (shspMethod, vals, createIfNotPreexisting) {
    try {
      var methodType = setMethod(shspMethod);
      var body = formatBody (vals, methodType);
      validate();




    } catch (err) {
      throw new Error(err, err.stack)};
  }

  const setMethod = (shspMethod) => {
    myConfig.body.method = shspMethod;
    configured.method = true;
    var type = parseMethodForWordType(shspMethod);
    return type;
  }

  const formatBody = (vals, methodType) => {

  }

  function validate() {
    if (Object.keys(myConfig.configured).every((k) => obj[k])){

    } else {
      let e ="No accountID and secretKey are not configured. Run init() with your accountID and securityKey before moving forward.";
      console.error(e);
      throw new Error(e)};
  }

  const parseMethodForWordType = (meth) => {
    
  }
})