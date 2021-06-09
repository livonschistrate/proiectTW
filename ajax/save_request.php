<?php
// se includ fisierele obligatorii pentru configuratia aplicatiei si accesul la baza de date
include "../include/config.php";
include "../include/db_auth.php";
include "../include/auth_ajax.php";

// se initializeaza array-ul care va contine raspunsul
$ret = array();
$ret['code'] = 99;
$ret['message'] = 'A apărut o eroare, reîncărcați pagina și reluați operația.';

if (!isset($_POST['id_request']) || !isset($_POST['data_start'])) { // nu au venit din pagina apelanta valorile necesare pentru salvare
    $ret['code'] = 99;
    $ret['message'] = 'Valorile de apel sunt incorecte. Reîncărcați pagina și reluați operația.';
    echo json_encode($ret);
    die();
}

$id_request = intval(trim($_POST['id_request']));

if ( $id_request==0) { //  este necesara adaugarea unei noi cereri
    $sql = "INSERT INTO requests (id_user, data_start, id_state) 
                           VALUES(".$_SESSION['id_user'].",'".$_POST['data_start']."',0);";
    $db->exec($sql);
    $id_request = $db->lastInsertId(); // se recupereaza id-ul cererii introduse in baza de date
    $ret['id_request'] = $id_request; // se intoarce ca raspuns in pagina id-ul cererii

    $ret['code'] = 1;
    $ret['message'] = 'Datele comenzii dvs. au fost salvate.<br>Puteți continua să adăugați articole la comandă.';

} else { // se doreste actualizarea unei cereri existente
    $sql = "UPDATE requests SET data_start='".$_POST['data_start']."' 
                           WHERE id_request=".$id_request.";";
    $db->exec($sql);
    $ret['id_request'] = $id_request; // se intoarce ca raspuns in pagina id-ul cererii
    $ret['code'] = 1;
    $ret['message'] = 'Datele comenzii dvs. au fost actualizate.<br>Puteți continua să adăugați articole la comandă.';
}

// se intoarce raspunsul spre pagina care a apelat via AJAX save_request.php
echo json_encode($ret);
die();