var accord = document.getElementsByClassName("accord");
var i;

for(i = 0; i < accord.length; i++) {
    //accord[i].addEventListener("click", toggleA());
}

function toggleA(btn){
    //this.classList.toggleA("active");
    var panel = btn.nextElementSibling;
    if(panel.style.display === "block"){
        panel.style.display = "none";
    }
    else{
        panel.style.display = "block";
    }
}
