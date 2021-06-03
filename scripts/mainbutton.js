
function showMenu(){
    var menu = document.getElementById('menubar');
    if(menu.className === "display-off")
        menu.className += " display-on";
    else
        menu.className = "display-off";
}