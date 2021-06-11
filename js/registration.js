var err_displayed = false;


function check_register(){
    err_displayed = false;
    var xhttp = ajaxReq();
    xhttp.onreadystatechange = function(){
        try{
            if(this.readyState === 4 && this.status === 200){
                console.log(this.responseText);
                var result = JSON.parse(this.responseText);
                console.log(result);
                if(result['register_ok'] == 1){
                    window.location.href = 'login.php';
                } else {
                    alert("Inregistrare esuata, va rugam sa incercati.");
                }
            }
        } catch (e){
            alert("A aparut o eroare. Va rugam sa reincarcati pagina si sa reluati operatia.");
        }
    };

    var uname = document.getElementById("Username").value;
    var email = document.getElementById("Email").value;
    var passw = document.getElementById("Password").value;

    xhttp.open("POST", 'ajax/check_login.php',true);
    xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhttp.send("username="+ uname + "&email=" + email + "&password=" + passw);
}