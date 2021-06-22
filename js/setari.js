var err_displayed=false;
// imediat după ce a fost incarcata in browser structura DOM a paginii
document.addEventListener("DOMContentLoaded", function() {
    setTimeout(load_user,1);
});

function load_user(){
    var xhttp = ajaxReq();
    err_displayed = false;
    xhttp.onreadystatechange = function(){
        if(this.readyState === 4 && this.status === 200){
            var result = JSON.parse(this.responseText);
            if(result['code'] == 1){
                getId('firstname').value = result['firstname'];
                getId('lastname').value = result['lastname'];
                getId('address').value = result['address'];
                getId('email').value = result['email'];
                getId('telefon').value = result['telefon'];
            } else {
                show_alert(result['message']);
            }
        }
    };
    xhttp.open("POST", '../ajax/get_user.php', true);
    xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhttp.send();
}

function save_settings(){
    var xhttp = ajaxReq();
    err_displayed = false;
    xhttp.onreadystatechange = function(){
        if(this.readyState === 4 && this.status === 200){
            var result = JSON.parse(this.responseText);
            if(result['code'] == 1){
                setTimeout(load_user,1);
            }
            show_alert(result['message']);
        }
    };
    xhttp.open("POST", '../ajax/save_settings.php', true);
    xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhttp.send(encodeURI('firstname='+getId('firstname').value + "&lastname=" + getId('lastname').value+"&address="+getId('address').value+"&telefon="+getId('telefon').value));
}
function save_password(){
    if (getId('parola_1').value!=getId('parola_2').value) {
        show_alert('Parola noua nu a fost confirmata corect. Reintroduceti de doua ori parola noua si reincercati.');
        return;
    }
    if (getId('parola_1').value.length<5) {
        show_alert('Parola noua este prea scurta. Parola trebuie sa aiba minim 5 caractere.');
        return;
    }
    var xhttp = ajaxReq();
    err_displayed = false;
    xhttp.onreadystatechange = function(){
        if(this.readyState === 4 && this.status === 200){
            var result = JSON.parse(this.responseText);
            show_alert(result['message']);
        }
    };
    xhttp.open("POST", '../ajax/change_password.php', true);
    xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhttp.send(encodeURI('password='+getId('parola_1').value));
}