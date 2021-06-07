

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
