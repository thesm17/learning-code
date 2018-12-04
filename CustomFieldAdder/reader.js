//var poster = require('./poster');
var fileUploaded = false;
var fileContents;
const dontImportSize=3, radioLimit = 5, picklistLimit = 12;
//var Papa = require('papaparse');

//poster.postIt("614DF4BF4FEE0CE729F3484D40A0BA10","F21D9298D9DD0FCE331D5863D25F9B65",[{1:3}]);

const readUploadedFileAsText = (inputFile) => {
  const temporaryFileReader = new FileReader();

  return new Promise((resolve, reject) => {
    temporaryFileReader.onerror = () => {
      temporaryFileReader.abort;
      reject(new DOMException("Problem parsing input file"));
    };

    temporaryFileReader.onload = () => {
      csv = Papa.parse(temporaryFileReader.result);
      resolve(csv);
    };
    temporaryFileReader.readAsText(inputFile);
  });
};

const handleFiles = async (files) => {
  const file = files[0];
  var uniqueVals=[], typeArray = [], cleanVals = [], finalArray = [];
  try {
    fileContents = await readUploadedFileAsText(file);
    rows = fileContents.data.length,  cols = fileContents.data[0].length;  //vals = [];

    //loop through all columns doing the following: count unique, determinine default, push that to array
    for (i=0; i<cols;i++){
      //uniqueVals stores the Set of unique values for one column in each cell
      uniqueVals.push(countUniqueVals(i));
      let fieldName =Array.from(uniqueVals[i])[0], fieldSize = uniqueVals[i].size-1 
     
      //typeArray stores recommended type in a column
      typeArray.push(determineDefaultFieldType(uniqueVals[i])); 
      
      //   cleanVals has one column per row
      //   with the first value being the recommended type: "text", "radio", "picklist", or "doNotImport"
      //        the second value being the CSV column title: "Account ID", "email", "First Name", etc.
      //        with all starting at 3 being the options. 
      cleanVals.push(cleanData(typeArray[i],uniqueVals[i]));
    }

    console.log(cleanVals);

    var headers="";
    for (i = 0; i<fileContents.data[i].length; i++) {
      headers+=fileContents.data[i][0]+"<br>";
    }
    
    
  } catch (e) {
    console.warn(e.message);
  }
};

const displayElement = (e) => {
document.getElementById("my-row").innerHTML += e;
};

function errorHandler(evt) {
  if(evt.target.error.name == "NotReadableError") {
      alert("Cannot read file!");
  }
}

//first returned argument is a #, second is an array
const countUniqueVals = (i) => {
  numberUnique = new Set(fileContents.data.map(function(value, index) {return value[i];}))
  if (numberUnique.has("")){numberUnique.delete("")};
  return numberUnique 
  } 

const determineDate = (possibleDateField) => {
  if (Date.parse(possibleDateField) && possibleDateField.length>5){return true} else {return false};
}

const determineDefaultFieldType = (numUnique) => {
  let size = numUnique.size-1;
  let data = Array.from(numUnique);
  if (determineDate(data[2])){return "date";}
  else if (size<=dontImportSize) {return "doNotImport";}
  else if (size <= radioLimit) {return 'radio';}
  else if (size <=picklistLimit) {return 'picklist';}
  else {return 'text';}
};

const cleanData = (type, valArray) => {
  if (type == "text" || type == "doNotImport" || type == "date"){return [type, Array.from(valArray)[0]]} 
  else {
    let returner = [type]
    Array.from(valArray).forEach(function(element){
      returner.push(element);
    })
    return returner;
  }
}