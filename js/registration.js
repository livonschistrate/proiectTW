var err_displayed = false;


function check_register(){

    var passw = document.getElementById("Password").value;
    var cpassw = document.getElementById("CPassword").value;
    var firstname = document.getElementById("Firstname").value;
    var lastname = document.getElementById("Lastname").value;
    var email = document.getElementById("Email").value;
    if (firstname=="") {
        show_alert("Prenumele nu a fost completat");
        return;
    }
    if (lastname=="") {
        show_alert("Numele nu a fost completat");
        return;
    }
    if (email=="") {
        show_alert("Adresa de e-mail nu a fost completata");
        return;
    }
    if (passw!=cpassw) {
        show_alert("Parolele introduse nu sunt identice!");
        return;
    }
    err_displayed = false;
    var xhttp = ajaxReq();
    xhttp.onreadystatechange = function(){
        try{
            if(this.readyState === 4 && this.status === 200){
                console.log(this.responseText);
                var result = JSON.parse(this.responseText);
                console.log(result);
                if(result['register_ok'] == 1){
                    alert(result['message']);
                    window.location.href = 'login.php';
                } else {
                    alert(result['message']);
                }
            }
        } catch (e){
            alert("A aparut o eroare. Va rugam sa reincarcati pagina si sa reluati operatia.");
        }
    };



    xhttp.open("POST", '../ajax/check_register.php',true);
    xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhttp.send( encodeURI("firstname="+ firstname + "&lastname=" + lastname + "&email=" + email + "&password=" + passw));
}