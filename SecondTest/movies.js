function createList(){
    let s;
    s = "<ul>" + 
        "<li>Armagetiton</li>" + 
        "<li>Jo Mudda</li>" +
        "<li>Bartok the Magnificent</li>" + 
        "</ul>";
        divMovies = document.getElementById("divMovies");
        divMovies.innerHTML = s;
}

function gameTime(){
    title = document.createTextNode("Games!");
    list = document.createElement("ul");

    item1 = document.createElement("li");
    text1 = document.createTextNode("Phoenix 2");
    item1.appendChild(text1);

    item2 = document.createElement("li");
    text2 = document.createTextNode("GunBound");
    item2.appendChild(text2);

    item3 = document.createElement("li");
    text3 = document.createTextNode("Shmup");
    item3.appendChild(text3);

    list.appendChild(item1);
    list.appendChild(item2);
    list.appendChild(item3);

    divGames = document.getElementById("divGames");
    divGames.appendChild(title);
    divGames.appendChild(list);

}