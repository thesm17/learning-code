//var poster = require('./poster');
let fileUploaded = false;
var fileContents;
var radioLimit = 5, picklistLimit = 12;
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
  var suggestArray = [], suggestions = [];
  try {
    fileContents = await readUploadedFileAsText(file);
    rows = fileContents.data.length,  cols = fileContents.data[0].length,  vals = [];

    //loop through all columns doing the following: count unique, determinine default, push that to array
    for (i=0; i<cols;i++){
      //works. pushes the type of field into the last row of matrix; should be changed from push to insert
      suggestArray.push(determineDefaultFieldType(countUniqueVals(i)[0]));
      //works. suggestions[] is full of sets
      suggestions.push(countUniqueVals(i)[1]);
      //trying to figure out how to fill an array iff there are a small number in the set using picklistLimit
      suggestions[1].forEach
      //works
      fileContents.data.push(suggestArray);
    }
      console.log(suggestions);
    //for Debugging
    console.log(`Rows: ${rows}, columns: ${cols}, Column 0: ${vals}`);

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

const countUniqueVals = (i) => {
  var suggestions = new Set(fileContents.data.map(function(value, index) {return value[i];}));
  var uniqueVals = suggestions.size-1;
  return [uniqueVals,suggestions];
  } 

const determineDefaultFieldType = (numUnique) => {
  if (numUnique < 5) return 'radio';
  else if (numUnique >4 && numUnique <12) return 'picklist';
  else return 'text';
};

const pushSuggestedFieldType = (newRow) => {
  return fileContents.data.push(newRow);
};