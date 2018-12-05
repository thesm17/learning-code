//this code will take a (csv export[, radioLimit, picklistLimit] and 
//return an array of that.
//var poster = require('./poster');
var fileContents;
const dontImportSize=3, radioLimit = 5, picklistLimit=12;
//var Papa = require('papaparse');
//poster.postIt("614DF4BF4FEE0CE729F3484D40A0BA10","F21D9298D9DD0FCE331D5863D25F9B65",[{1:3}]);

// module.exports = {
//   parseData: parseData
// }


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

async function parseData(file, opts) {
  //checks for overloaded function: if one extra arg, it's picklistLimit, if two it's radio then picklist
  if (opts) {
    if (opts.length===1){picklistLimit=opts[0]}
    if (opts.length===2){radioLimit=opts[0]; picklistLimit=opts[1];}
  }
    var uniqueVals=[], typeArray = [], cleanVals = [];
    fileContents = await readUploadedFileAsText(file);
    rows = fileContents.data.length,  cols = fileContents.data[0].length;

    //loop through all columns doing the following: count unique, determinine default, clean up into one array
      //uniqueVals stores the Set of unique values for one column in each cell
      //typeArray stores recommended type in a column
      //   cleanVals has at least 2 cols:
      //   with the first value being the recommended type: "text", "radio", "picklist", or "doNotImport"
      //        the second value being the CSV column title: "Account ID", "email", "First Name", etc.
      //        with any starting at 3 being the options. 
    for (i=0; i<cols;i++){
      uniqueVals.push(countUniqueVals(i));
      typeArray.push(determineDefaultFieldType(uniqueVals[i])); 
      cleanVals.push(cleanData(typeArray[i],uniqueVals[i]));
    }

    console.log(cleanVals);
    return cleanVals;
    
  }


const displayElement = (e) => {
    document.getElementById("my-row").innerHTML += e;
  }

const countUniqueVals = (i) => {
//returns a set of unique values for a single column, removing any blanks
  numberUnique = new Set(fileContents.data.map(function(value, index) {return value[i];}))
  if (numberUnique.has("")){numberUnique.delete("")};
  return numberUnique 
  } 

const determineDate = (possibleDateField) => {
  if (Date.parse(possibleDateField) && possibleDateField.length>5){return true} else {return false};
}

const determineDefaultFieldType = (numUniqueSet) => {
  //expects a Set of unique values
  //returns a string of correct field type
  let size = numUniqueSet.size-1;
  let data = Array.from(numUniqueSet);
  if (determineDate(data[2])){return "date";}
  else if (size<=dontImportSize) {return "doNotImport";}
  else if (size <= radioLimit) {return 'radio';}
  else if (size <=picklistLimit) {return 'picklist';}
  else {return 'text';}
};

const cleanData = (type, valArray) => {
  //expects an array of types (from determineDefaultFieldType) and a Set of unique values.
  //    If text column (over picklistLimit), an empty column, or date, don't offer any options during import.
  //    but otherwise append the options to the end of the array
  if (type == "text" || type == "doNotImport" || type == "date"){return [type, Array.from(valArray)[0]]} 
  else {
    let returner = [type]
    Array.from(valArray).forEach(function(element){
      returner.push(element);
    })
    return returner;
  }
}