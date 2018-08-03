var xmlHttp =  createXmlHttpRequestObject();

function createXmlHttpRequestObject(){
    var xmlHttp;

    if (window.XMLHttpRequest){
        xmlHttp = new XMLHttpRequest();
    }else{
        xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
    }

    return xmlHttp;
} 

function process(){
    if (xmlHttp){
        try {
            xmlHttp.open("GET", "bacon.txt", true);
            xmlHttp.onreadystatechange = handleServerResponse;
            xmlHttp.send();
        }catch(e){
            alert(e.toString());
        }
    }
}

function handleServerResponse(){
    theD = document.getElementById("theD");
    if (xmlHttp.readyState==1){
        theD.innerHTML+= "Status: server connection established <br/>"; 
    }else if (xmlHttp.readyState==2){
        theD.innerHTML+= "Status: request received. <br/>"; 
    } else if (xmlHttp.readyState==3){
        theD.innerHTML+= "Status: server processing. <br/>"; 
    } else if (xmlHttp.readyState==4){        
        if (xmlHttp.status=200){
            try{
                text = xmlHttp.responseText;
                theD.innerHTML+= "Status: request is finished.<br/>"; 
                theD.innerHTML+=text; 
            }catch(e){
                alert(e.toString());}
        }else{ alert(xmlHttp.statusText);}

    }

}