var alert_message = null;

// functie care intoarce un element plecand de la id-ul sau
function getId(elem) {
    return document.getElementById(elem);
}

function ajaxReq() {
    if (window.XMLHttpRequest) {
        return new XMLHttpRequest();
    } else if (window.ActiveXObject) {
        return new ActiveXObject("Microsoft.XMLHTTP");
    } else {
        alert("Browser does not support XMLHTTP.");
        return false;
    }
}

// var params = typeof data == 'string' ? data : Object.keys(data).map(
//     function(k){ return encodeURIComponent(k) + '=' + encodeURIComponent(data[k]) }
// ).join('&');


function go_to_dashboard() {
    window.location.href="dashboard.php";
}

function go_to_comenzi() {
    window.location.href="comenzi.php";
}

function go_to_comenzi_operator() {
    window.location.href="comenzi_operator.php";
}

function go_to_edit_utilizatori() {
    window.location.href="edit_utilizatori.php";
}

function go_to_edit_tipuri_articole() {
    window.location.href="edit_tipuri_articole.php";
}

function go_to_edit_preturi() {
    window.location.href="edit_preturi.php";
}

// functie care face logout, apeleaza prin AJAX logout.php si cand vine raspunsul redirectioneaza la pagina de login
function do_logout(){
    var xhttp = ajaxReq();
    xhttp.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
            var result = JSON.parse(this.responseText);
            if (result['logout_ok']==1) {
                window.location.href = 'login.php';
            } else {
                alert("Logout failed. Please try again.");
            }
        }
    };
    xhttp.open("POST", '../ajax/logout.php', true);
    xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhttp.send();
}

// functie care aduce in ecran (afiseaza) fereastra pentru afisarea mesajului de tip alerta
function show_alert(message) {
    getId('alert-content').innerHTML = message;
    getId('alert_message').style.right = "1em";

    // se anuleaza programarea anterioara daca exista
    if (alert_message!=null) clearTimeout(alert_message);
    //programeaza ascunderea automata a ferestrei de alertare peste 7 secunde
    alert_message = setTimeout(close_alert,7000);
}

// functie care ascunde mesajul de tip alerta
function close_alert() {
    if (alert_message!=null) clearTimeout(alert_message);
    getId('alert_message').style.right = "-33em";
}
