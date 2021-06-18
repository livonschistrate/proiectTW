<?php
session_start();
// se includ fisierele obligatorii pentru configuratia aplicatiei si accesul la baza de date
include "../include/config.php";
include "../include/db_auth.php";

// se initializeaza array-ul care va contine raspunsul
$ret = array();

$sql = "SELECT * 
        FROM users 
        WHERE 
            email='".trim($_POST['email'])."' 
            AND 
            password=MD5('".trim($_POST['password'])."');";

// se cauta utilizatorul in baza de date pornind de la username/email si parola
$user = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
if (count($user)>0) { // a fost gasit utilizatorul (cu parola) in baza de date, se marcheaza sesiunea ca fiind conectata (logged in)

    $ret['login_ok'] = 1;
    $ret['message'] = 'Login OK!';
    $_SESSION['logged_in'] = 1;
    $_SESSION['level'] = $user[0]['id_role'];
    $_SESSION['id_user'] = $user[0]['id_user'];
    $_SESSION['name'] = $user[0]['firstname'].' '.$user[0]['lastname'];
    $_SESSION['email'] = $user[0]['email'];

} else {  // utilizator inexistent sau parola gresita

    $ret['login_ok'] = 0;
    $ret['message'] = 'Login failed';
    $_SESSION['logged_in'] = 0;
    $_SESSION['level'] = 0;
    $_SESSION['id_user'] = 0;
    $_SESSION['name'] = '';
    $_SESSION['email'] = '';

}

// se intoarce raspunsul
echo json_encode($ret);
die();