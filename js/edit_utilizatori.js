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
function load_users(){
   var xhttp = ajaxReq()
   err_displayed = false;
   xhttp.onreadystatechange = function() {
      if (this.readyState === 4 && this.status === 200) {

         var result = JSON.parse(this.responseText);

         if (result['code'] == 1) { // ok, se afiseaza rezultatul
            getId("reqs").innerHTML = result['html'];
         } else {
            show_alert('A apărut o eroare. Vă rugăm să reîncărcați pagina și să reluați operația.');
         }
      }
   };
   xhttp.open("POST", '../ajax/get_users.php', true);
   xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
   xhttp.send();
}

// functie care afiseaza div-ul pentru adugarea/editarea unei comenzi
function show_user(id_req) {
   //getId("reqs").innerHTML = '<div class="loading"></div>';
   getId('id_user').value = id_req;

   // cand se adauga o comanda noua se pune pe 0 id-ul de la articol
   //getId('id_article').value = 0;

   var req_window = getId('user');
   req_window.style.display = "block";
   setTimeout(load_user,1);
}

// functie care ascunde pop-ul pentru adaugarea unei cereri
function close_req() {
   getId('user').style.display = "none";
}


// functie care salveaza o comanda
function save_user(){
   var xhttp = ajaxReq();
   err_displayed = false;
   xhttp.onreadystatechange = function() {

      if (this.readyState === 4 && this.status === 200) {

         var result = JSON.parse(this.responseText);

         if (result['code'] == 1) { // ok, se afiseaza rezultatul

            getId('id_user').value = parseInt(result['id_user']);

            setTimeout(load_user,1);

            // se reincarca lista cu comenzile
            setTimeout(load_users,1);

         }

         show_alert(result['message']);
      }
   };
   xhttp.open("POST", '../ajax/save_user.php', true);
   xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
   xhttp.send("id_user="+getId('id_user').value+"&id_role="+getId('id_role').value);
   //getId("req-articles-list").innerHTML = '<div class="loading"></div>';
}


// functie care incarca informatiile despre un user
function load_user() {
   var xhttp = ajaxReq();
   err_displayed = false;
   xhttp.onreadystatechange = function() {
      if (this.readyState === 4 && this.status === 200) {

         var result = JSON.parse(this.responseText);

         if (result['code'] == 1) { // ok, se afiseaza rezultatul


            getId('id_role').value = result['id_role'];
            console.log('>>>'+result['id_user']);
            if (parseInt(result['id_user'])==0) {
               getId('nr_user').innerHTML = "--";
            }  else {
               getId('nr_user').innerHTML = result['id_user'];
            }

         } else {
            show_alert(result['message']);
         }
      }
   };
   xhttp.open("POST", '../ajax/get_user.php', true);
   xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
   xhttp.send("id_user="+getId('id_user').value);

}

