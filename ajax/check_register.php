<?php
session_start();
include "../include/config.php";
include "../include/db_auth.php";

$ret = array();
$ret['code'] = 99;
$ret['message'] = 'A apărut o eroare, reîncărcați pagina și reluați operația.';

if(!isset($_POST['firstname']) || !isset($_POST['lastname']) || !isset($_POST['password']) || !isset($_POST['email'])){
    $ret['code'] = 99;
    $ret['message'] = 'Valorile de apel sunt incorecte. Reîncărcați pagina și reluați operația.';
    echo json_encode($ret);
    die();
}

// se verifica daca utilizatorul exista deja in baza de date
$sql = "SELeCT * FROM users WHERE email='".trim($_POST['email'])."'";
$deja_user = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);

if(count($deja_user)==0){

    $sql = "INSERT INTO users 
    (firstname, lastname, email,password,id_role,is_validated,is_deleted,is_enabled,register_date)
    VALUES ('".$_POST['firstname']."','".$_POST['lastname']."','".$_POST['email']."','".MD5($_POST['password'])."',1,0,0,1,NOW())";
    $db -> exec($sql);
    $id_user = $db->lastInsertId();
    $ret['id_user'] = $id_user;

    $ret['register_ok'] = 1;
    $ret['code'] = 1;
    $ret['message'] = 'Utilizatorul a fost inregistrat cu succes! Apasati ok pentru a fi redirectionat/a la pagina de login.';

} else {  // utilizatorul este deja in baza de date
    $ret['register_ok'] = 0;
    $ret['code'] = 99;
    $ret['message'] = 'Exista deja inregistrat un utilizator cu adresa de e-mail completata!';
}

echo json_encode($ret);

//$sqlcheck = "SELECT *
//            FROM users
//            WHERE
//                username='".trim($_POST['username'])."'
//                AND
//                email='".trim($_POST['email'])."'
//                AND
//                password='".trim($_POST['password'])."';";
//
//$usercheck = $db -> query($sqlcheck)->fetchAll(PDO::FETCH_ASSOC);
//
//if(count($user)>0){
//
//    $ret['register_ok'] = 1;
//    $ret['message'] = 'Register OK!';
//    $_SESSION['registered'] = 1;
//    $_SESSION['level'] = $user[0]['level'];
//    $_SESSION['id_user'] = $user[0]['id_user'];
//    $_SESSION['name'] = $user[0]['username'];
//} else {
//    $ret['register_ok'] = 0;
//    $ret['message'] = 'User already registered!';
//    $_SESSION['registered'] = 0;
//    $_SESSION['level'] = 0;
//    $_SESSION['id_user'] = 0;
//    $_SESSION['name'] = '';
//}
die();