<?php
// se includ fisierele obligatorii pentru configuratia aplicatiei si accesul la baza de date
include "../include/config.php";
include "../include/db_auth.php";
include "../include/auth_ajax.php";

// se initializeaza array-ul care va contine raspunsul
$ret = array();
$ret['code'] = 99;
$ret['message'] = 'A apărut o eroare, reîncărcați pagina și reluați operația.';

if (!isset($_POST['id_user']) ) { // nu au venit din pagina apelanta valorile necesare pentru salvare
    $ret['code'] = 99;
    $ret['message'] = 'Valorile de apel sunt incorecte. Reîncărcați pagina și reluați operația.';
    echo json_encode($ret);
    die();
}

$id_user = intval(trim($_POST['id_user']));

if ( $id_user==0) {

} else { // se doreste actualizarea rolului unui user existent
    $sql = "UPDATE users SET id_role='".$_POST['id_role']."',
                            is_validated=".intval($_POST['validated']).",
                            is_enabled=".intval($_POST['enabled'])."
                           WHERE id_user=".$id_user.";";
    $db->exec($sql);
    $ret['id_user'] = $id_user; // se intoarce ca raspuns in pagina id-ul cererii
    $ret['code'] = 1;
    $ret['message'] = 'Datele utilizatorului au fost actualizate.';
}

// se intoarce raspunsul spre pagina care a apelat via AJAX
echo json_encode($ret);
die();