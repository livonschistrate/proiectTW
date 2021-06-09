var err_displayed = false;

// functie care apeleaza AJAX check_login.php pentru a verifica autentificarea utilizatorilor
// raspunsul vine sub forma unui associative array in format JSON
function check_login(){
    err_displayed = false;
    var xhttp = ajaxReq();
    xhttp.onreadystatechange = function() {
        try {
            if (this.readyState === 4 && this.status === 200) {
                console.log(this.responseText); // pentru depanare
                var result = JSON.parse(this.responseText);
                console.log(result);
                if (result['login_ok'] == 1) {
                    window.location.href = 'dashboard.php';
                } else {
                    alert("Autentificare eșuată, vă rugăm să reîncercați.");
                }
            }
        }catch (e) {
            alert('A apărut o eroare. Vă rugăm să reîncărcați pagina și să reluați operația.');
        }
    };
    var uname = document.getElementById("Username").value;
    var passw = document.getElementById("Password").value;


    xhttp.open("POST", 'ajax/check_login.php', true);
    xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
//    xhttp.send("array="+JSON.stringify({username:uname, password:passw}));
    xhttp.send("username="+ uname + "&password=" + passw);
}