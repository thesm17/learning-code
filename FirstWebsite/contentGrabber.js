//Have in here three different fake blogs posts, 
//with an image, a description, and a small writeup.

//want to use document.element.appendChild

const blog1 = {
    photo:"<img src=\"https://upload.wikimedia.org/wikipedia/commons/thumb/d/d1/Mount_Everest_as_seen_from_Drukair2_PLW_edit.jpg/600px-Mount_Everest_as_seen_from_Drukair2_PLW_edit.jpg\">",
    overlay:"Visiting Mount Everest was amazing! I almost died!",
    description: "What an adventure it was climbing the tallest mountain on the earth!"+
    "<br/><br/> First Christy and I rented some camels and then we started climbing. It was so insane." +
    "<br/><br/> Then we reached the top. Isn't the picture we took incredible? You can thank Cristy's Pixel for that."
};

function process(){
    var photos=document.getElementById("photo1");
    var overlays=document.getElementById("overlay1");
    var descriptions=document.getElementById("description1");

  //  photos.innerHTML=blog1.photo;
    overlays.innerHTML=blog1.overlay
    descriptions.innerHTML=blog1.description;
}