var err_displayed=false;
// imediat după ce a fost incarcata in browser structura DOM a paginii
document.addEventListener("DOMContentLoaded", function() {
   setTimeout(load_requests,10);
   // var req_window = getId('request');
   // window.onclick = function(event) {
   //    if (event.target == req_window) {
   //       close_req();
   //    }
   // }
});


// functie care incarca lista de comenzi pentru un utilizator
function load_requests(){
   var xhttp = ajaxReq()
   err_displayed = false;
   xhttp.onreadystatechange = function() {
      if (this.readyState === 4 && this.status === 200) {

         var result = JSON.parse(this.responseText);

         if (result['code'] == 1) { // ok, se afiseaza rezultatul
            getId("reqs").innerHTML = result['html'];
            getId("nr_reqs").innerHTML = 'Nr: ' +result['nr_reqs'];
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
   xhttp.open("POST", '../ajax/get_requests_operator.php', true);
   xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
   xhttp.send(encodeURI("sort_col="+getId('sort_col').value+"&sort_order="+getId('sort_order').value+"&reqs_per_page="+getId('reqs_per_page').value+"&crt_page="+getId('crt_page').value+"&filter_data_start="+getId('filter_data_start').value+"&filter_id_user="+getId('filter_id_user').value+"&filter_id_state="+getId('filter_id_state').value+"&filter_id_paid="+getId('filter_id_paid').value));
}

// functie care afiseaza div-ul pentru adugarea/editarea unei comenzi
function show_request(id_req) {
   getId("reqs").innerHTML = '<div class="loading"></div>';
   getId('id_request').value = id_req;

   // cand se adauga o comanda noua se pune pe 0 id-ul de la articol
   getId('id_article').value = 0;

   var req_window = getId('request');
   req_window.style.display = "block";
   setTimeout(load_request,1);
   setTimeout(load_articles,1);
}

// functie care ascunde pop-ul pentru adaugarea unei cereri
function close_req() {
   getId('request').style.display = "none";
}


function filter_request() {
   var req_window = getId('req_filter');
   req_window.style.display = "block";
}

function close_filter() {
   getId('req_filter').style.display = "none";
}

function show_article(id_article = 0) {
   getId('id_article').value = id_article;
   var add_window = getId('add_article');
   add_window.style.display = "block";
   setTimeout(load_article,1);
}

function close_add_art() {
   getId('add_article').style.display = "none";
}

// functie care salveaza o comanda
function save_req(){
   var xhttp = ajaxReq();
   err_displayed = false;
   xhttp.onreadystatechange = function() {

      if (this.readyState === 4 && this.status === 200) {

         var result = JSON.parse(this.responseText);

         if (result['code'] == 1) { // ok, se afiseaza rezultatul

            getId('id_request').value = parseInt(result['id_request']);

            setTimeout(load_request,1);

            // se reincarca lista cu comenzile
            setTimeout(load_requests,1);

            // se reincarca lista cu articole
            setTimeout(load_articles,1);

         }

         show_alert(result['message']);
      }
   };
   xhttp.open("POST", '../ajax/save_request_operator.php', true);
   xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
   xhttp.send(encodeURI("id_request="+getId('id_request').value+"&data_start="+getId('data_start').value+"&state="+getId('state').value+"&id_paid="+getId('id_paid').value));
   getId("req-articles-list").innerHTML = '<div class="loading"></div>';
}

// functie care sterge o comanda
function delete_req(id_request) {
   var c = confirm("Sunteți sigur/ă că doriți să ștergeți comanda?\nVor fi șterse și toate articolele care sunt asignate acestei comenzi.\n\nNu se va putea reveni asupra acestei operații.\n\n Apăsați OK dacă doriți să ștergeți comanda.");
   if (c) {
      var xhttp = ajaxReq();
      err_displayed = false;
      xhttp.onreadystatechange = function() {
         if (this.readyState === 4 && this.status === 200) {

            var result = JSON.parse(this.responseText);

            if (result['code'] == 1) { // ok, se afiseaza rezultatul

               // se reincarca lista cu articole
               setTimeout(load_requests,1);

            }
            show_alert(result['message']);
         }
      };
      xhttp.open("POST", '../ajax/delete_request.php', true);
      xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      xhttp.send("id_request="+id_request);
   }
}


// functie care incarca lista de articole pentru o comanda
function load_articles(){
   var xhttp = ajaxReq()
   err_displayed = false;
   xhttp.onreadystatechange = function() {
      if (this.readyState === 4 && this.status === 200) {

         var result = JSON.parse(this.responseText);

         if (result['code'] == 1) { // ok, se afiseaza rezultatul

            getId("req-articles-list").innerHTML = result['html'];

            // se reincarca lista cu comenzile
            setTimeout(load_requests,1);

         } else {
            show_alert('A apărut o eroare. Vă rugăm să reîncărcați pagina și să reluați operația.');
         }
      }
   };
   xhttp.open("POST", '../ajax/get_articles.php', true);
   xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
   xhttp.send("id_request="+getId('id_request').value);
}


// functie care salveaza un articol
function save_article(){
   if ( parseInt(getId('id_request').value)==0 ) {
      show_alert("Pentru a adăuga articole salvați mai întâi comanda.");
      return ;
   }
   var xhttp = ajaxReq();
   err_displayed = false;
   xhttp.onreadystatechange = function() {
      if (this.readyState === 4 && this.status === 200) {

         var result = JSON.parse(this.responseText);

         if (result['code'] == 1) { // ok, se afiseaza rezultatul

            getId('id_article').value = parseInt(result['id_article']);

            // se reincarca lista cu articole
            setTimeout(load_articles,1);

            // se inchide fereastra de editare a articolului
            close_add_art();
         }
         show_alert(result['message']);
      }
   };
   xhttp.open("POST", '../ajax/save_article.php', true);
   xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
   xhttp.send("id_request="+getId('id_request').value+"&id_article="+getId('id_article').value+"&type="+getId('article_type').value+"&material="+getId('material').value+"&quantity="+getId('quantity').value);
}

// functie care sterge o intrare din lista de articole
function delete_article(id_article) {
   var c = confirm("Sunteți sigur/ă că doriți să ștergeți articolele din lista comenzii?\n\nNu se va putea reveni asupra acestei operații.\n\n Apăsați OK dacă doriți să ștergeți articolele.");
   if (c) {
      var xhttp = ajaxReq();
      err_displayed = false;
      xhttp.onreadystatechange = function() {
         if (this.readyState === 4 && this.status === 200) {

            var result = JSON.parse(this.responseText);

            if (result['code'] == 1) { // ok, se afiseaza rezultatul

               // se reincarca lista cu articole
               setTimeout(load_articles,1);

            }
            show_alert(result['message']);
         }
      };
      xhttp.open("POST", '../ajax/delete_article.php', true);
      xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      xhttp.send("id_article="+id_article);
   }
}

// functie care incarca informatiile despre o comanda
function load_request() {
   var xhttp = ajaxReq();
   err_displayed = false;
   xhttp.onreadystatechange = function() {
      if (this.readyState === 4 && this.status === 200) {

         var result = JSON.parse(this.responseText);

         if (result['code'] == 1) { // ok, se afiseaza rezultatul

            getId('data_start').value = result['data_start'];
            getId('state').value = result['id_state'];
            if (parseInt(result['id_request'])==0) {
               getId('nr_request').innerHTML = "--";
            }  else {
               getId('nr_request').innerHTML = result['id_request'];
            }

         } else {
            show_alert(result['message']);
         }
      }
   };
   xhttp.open("POST", '../ajax/get_request.php', true);
   xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
   xhttp.send("id_request="+getId('id_request').value);

}

// functie care incarca informatiile despre un articol
function load_article() {
   var xhttp = ajaxReq();
   err_displayed = false;
   xhttp.onreadystatechange = function() {
      if (this.readyState === 4 && this.status === 200) {

         var result = JSON.parse(this.responseText);

         if (result['code'] == 1) { // ok, se afiseaza rezultatul

            getId('id_article').value = parseInt(result['id_article']);
            getId('article_type').value = parseInt(result['type']);
            getId('material').value = parseInt(result['material']);
            getId('quantity').value = parseInt(result['quantity']);

         } else {
            show_alert(result['message']);
         }
      }
   };
   xhttp.open("POST", '../ajax/get_article.php', true);
   xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
   xhttp.send("id_article="+getId('id_article').value);

}

function sort(col) {
   if (getId('sort_order').value=='1') order=0;
   else order=1;
   //order = !order;
   getId('sort_order').value = order;
   getId('sort_col').value = col;
   setTimeout(load_requests,1);
}

function reload_data(){
   setTimeout(load_requests,1);
}

function do_filter_requests() {
   getId('filter_data_start').value = getId('data_start_filter').value;
   getId('filter_id_user').value = getId('id_user_filter').value;
   getId('filter_id_state').value = getId('id_state_filter').value;
   getId('filter_id_paid').value = getId('id_paid_filter').value;
   getId('filter_text').innerHTML = '';
   if (getId('id_user_filter').value != '' && getId('id_user_filter').value != '0') {
      getId('filter_text').innerHTML += ' client: ' + getId('id_user_filter').options[getId('id_user_filter').selectedIndex].text;
   }
   if (getId('data_start_filter').value != '') {
      getId('filter_text').innerHTML += ' in data: ' + getId('data_start_filter').value;
   }
   if (getId('id_state_filter').value != '' && getId('id_state_filter').value != '-1') {
      getId('filter_text').innerHTML += ' stare: ' + getId('id_state_filter').options[getId('id_state_filter').selectedIndex].text;
   }
   if (getId('id_paid_filter').value != '' && getId('id_paid_filter').value != '-1') {
      getId('filter_text').innerHTML += ' achitate: ' + getId('id_paid_filter').options[getId('id_paid_filter').selectedIndex].text;
   }
   close_filter();
   reload_data();
}

function do_clear_filter(){
   getId('filter_text').innerHTML = '';
   getId('filter_data_start').value = '';
   getId('data_start_filter').value = '';
   getId('filter_id_user').value = '';
   getId('id_user_filter').value = '0';
   getId('filter_id_state').value = '';
   getId('id_state_filter').value = '-1';
   getId('filter_id_paid').value = '';
   getId('id_paid_filter').value = '-1';
   close_filter();
   reload_data();
}