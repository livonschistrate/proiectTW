var err_displayed=false;
// imediat după ce a fost incarcata in browser structura DOM a paginii
document.addEventListener("DOMContentLoaded", function() {
    setTimeout(load_users,10);
    var req_window = getId('user');
    window.onclick = function(event) {
        if (event.target == req_window) {
            close_req();
        }
    }
});


// functie care incarca lista de comenzi pentru un utilizator
function load_articles(){
    var xhttp = ajaxReq()
    err_displayed = false;
    xhttp.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {

            var result = JSON.parse(this.responseText);

            if (result['code'] == 1) { // ok, se afiseaza rezultatul
                getId("reqs").innerHTML = result['html'];
                getId('crt_page').options.length = 0;
                for(i=0;i<result['nr_pages'];i++) {
                    var selected = false;
                    if ( i+1 == parseInt(result['crt_page']) ) selected = true;
                    getId('crt_page').options[i] = new Option(i+1, i+1, selected, selected);
                }
            } else {
                show_alert('A apărut o eroare. Vă rugăm să reîncărcați pagina și să reluați operația.');
            }
        }
    };
    xhttp.open("POST", '../ajax/get_articles.php', true);
    xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhttp.send(encodeURI("sort_col="+getId('sort_col').value+"&sort_order="+getId('sort_order').value+"&reqs_per_page="+getId('reqs_per_page').value+"&crt_page="+getId('crt_page').value));
}

// functie care afiseaza div-ul pentru adugarea/editarea unei comenzi
// function show_user(id_user) {
//    getId('id_user').value = id_user;
//    var req_window = getId('user');
//    req_window.style.display = "block";
//    setTimeout(load_user,1);
// }

// functie care ascunde pop-ul pentru adaugarea unei cereri
function close_req() {
    getId('article').style.display = "none";
}


// functie care salveaza o comanda
function save_article(){
    var xhttp = ajaxReq();
    err_displayed = false;
    xhttp.onreadystatechange = function() {

        if (this.readyState === 4 && this.status === 200) {

            var result = JSON.parse(this.responseText);

            if (result['code'] == 1) { // ok, se afiseaza rezultatul

                getId('id_article').value = parseInt(result['id_article']);

                setTimeout(load_user,1);

                // se reincarca lista cu comenzile
                setTimeout(load_users,1);

            }

            show_alert(result['message']);
        }
    };
    xhttp.open("POST", '../ajax/save_article.php', true);
    xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhttp.send(encodeURI("id_article="+getId('id_article').value);
    //getId("req-articles-list").innerHTML = '<div class="loading"></div>';
}


// functie care incarca informatiile despre un user
function load_article() {
    var xhttp = ajaxReq();
    err_displayed = false;
    xhttp.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {

            var result = JSON.parse(this.responseText);

            if (result['code'] == 1) { // ok, se afiseaza rezultatul
                getId('id_article').value = result['id_article'];
                console.log('>>>'+result['id_article']);
                if (parseInt(result['id_article'])==0) {
                    getId('nr_article').innerHTML = "--";
                }  else {
                    getId('nr_article').innerHTML = result['id_article'];
                }

            } else {
                show_alert(result['message']);
            }
        }
    };
    //xhttp.open("POST", '../ajax/get_user_administrator.php', true);
    xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhttp.send("id_article="+getId('id_article').value);

}

// function sort(col) {
//    if (getId('sort_order').value=='1') order=0;
//    else order=1;
//    //order = !order;
//    getId('sort_order').value = order;
//    getId('sort_col').value = col;
//    setTimeout(load_users,1);
// }

function reload_data(){
    setTimeout(load_articles,1);
}
