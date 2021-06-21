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

 // se doreste actualizarea parolei unui user existent
    $sql = "UPDATE users SET password=MD5('".$_POST['password']."')
                           WHERE id_user=".$id_user.";";
    $db->exec($sql);
    $ret['code'] = 1;
    $ret['message'] = 'Parola dvs. a fost actualizata.';


// se intoarce raspunsul spre pagina care a apelat via AJAX
echo json_encode($ret);
die();