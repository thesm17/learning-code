//var poster = require('./poster');
let fileUploaded = false;
var fileContents;
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
  })
}

const handleFiles = async (files) => {
  const file = files[0];

  try {
    fileContents = await readUploadedFileAsText(file);
    var headers="";
    for (i = 0; i<fileContents.data[0].length; i++) {
      headers+=fileContents.data[0][i]+"<br>";
    }
    displayElement(headers);
    
    //  fileContents.data.forEach(e => {displayElement(e)});
    //displayRow(0);
    
    
  } catch (e) {
    console.warn(e.message);
  }
}

const displayElement = (e) => {
document.getElementById("my-row").innerHTML += e;
}

function errorHandler(evt) {
  if(evt.target.error.name == "NotReadableError") {
      alert("Cannot read file!");
  }
}