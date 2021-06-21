<?php
// se includ fisierele obligatorii pentru configuratia aplicatiei si accesul la baza de date
include "../include/config.php";
include "../include/db_auth.php";
include "../include/auth_ajax.php";

// se initializeaza array-ul care va contine raspunsul
$ret = array();
$ret['code'] = 99;
$ret['message'] = 'A apărut o eroare, reîncărcați pagina și reluați operația.';

$id_user = intval(trim($_SESSION['id_user']));

 // se doreste actualizarea informatiilor unui user existent
    $sql = "UPDATE users SET firstname='".$_POST['firstname']."',
                             lastname='".$_POST['lastname']."',
                             address='".$_POST['address']."'
                           WHERE id_user=".$id_user.";";
    $db->exec($sql);
    $ret['code'] = 1;
    $ret['message'] = 'Datele dvs. au fost actualizate.';


// se intoarce raspunsul spre pagina care a apelat via AJAX
echo json_encode($ret);
die();