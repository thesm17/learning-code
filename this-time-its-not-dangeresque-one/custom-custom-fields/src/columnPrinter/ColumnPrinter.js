let attendeesArray = [];
let currentWinner;
let allWinners = [];
let fileUploaded = false;
let numberOfFields;

function handleFiles(files) {
  // Check for the various File API support.
  if (window.FileReader) {
    // FileReader are supported.
    getAsText(files[0]);
    fileUploaded = true;
  } else {
    alert('FileReader are not supported in this browser.');
  }
}

function getAsText(fileToRead) {
  let reader = new FileReader();
  // Read file into memory as UTF-8
  reader.readAsText(fileToRead);
  // Handle errors load
  reader.onload = loadHandler;
  reader.onerror = errorHandler;
}

function loadHandler(event) {
  let csv = event.target.result;
  processData(csv);
}

function processData(csv) {
  let allTextLines = csv.split(/\r\n|\n/);
  for (let i=0; i<allTextLines.length; i++) {
      let data = allTextLines[i].split(',');
          let tarr = [];
          for (var j=0; j<data.length; j++) {
              tarr.push(data[j]);
          }
          attendeesArray.push(tarr);
  }
arrayCreated = true;
attendeesArray.map(cellValue => {
  console.log(`Cell ${cellValue}`);
})
}


function errorHandler(evt) {
  if(evt.target.error.name == "NotReadableError") {
      alert("Cannot read file!");
  }
}