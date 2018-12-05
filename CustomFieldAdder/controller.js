//var poster = require("./poster");
//var reader = require("./reader");
var fileContents, fieldPayload = [];
var fields = {}

//When they click the upload button it will upload the file, parse it and clean it, then present it in JSON. 
//the JSON will then be displayed to the view, which will be able to change: 
//1. the name of the field, 2. the type of field, 3. whether to create the field or not.


const handleUpload = async (files, opts) => {
    const file = files[0];
    var cleanArray = new Promise((resolve, reject) => {
      try {return resolve(parseData(file)); console.log("made it past the parseData")
      } catch (e){ 
        console.warn(e.message);
        reject ( new DOMException(e));
      }}
    );
    cleanArray.then(function(cleaned){
      arrayToJSON(cleaned);
    })
  }

var arrayToJSON = (cleanArray) => {
  cleanArray.forEach(element => {
    fieldPayload.push(matrixRowToJSON(element));
  });
  console.log(JSON.stringify(fieldPayload));
  return fieldPayload;
}

var matrixRowToJSON  = (row) => {
//our ideal json object would have an extra field than ShSp for whether to create it or not, and then that'll determine whether it gets pushed to ShSp or not. 
//updating 4 things: import or not, name, type, and options
var upload, label, dataType, options={}, ops={};
let newField = {  
  upload, 
  relationship: "lead", 
  label, dataType, 
  dataLength: "255", 
  isRequired: "1", 
  isCustom: "1", 
  isActive: "1", 
  isAvailableInContactManager: "1", 
  isEditableInContactManager: "1", 
  isAvailableInForms: "1", 
  options};

  if (row[0]==="doNotImport") {
    newField.upload=0; newField.dataType="text"} 
    else {
      newField.upload=1; newField.dataType=row[0];
  newField.label = row[1]}
  if (row[2]) {
    for (i=2; i<row.length-1;i++){
      ops += `option: ${row[i]},`
    }
    
  }
  console.log(ops)
  newField.options= (ops);
  return newField
} 
  
