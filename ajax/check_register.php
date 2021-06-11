<?php
session_start();
include "../include/config.php";
include "../include/db_auth.php";

$ret = array();
$id_user = intval(trim($_POST['id_user']));

$sql = "INSERT INTO users 
    (id_user,firstname, email,password,level)
    VALUES (".$id_user.",'".$_POST['username']."','".$_POST['email']."','".$_POST['password']."',1)";

$user = $db -> query($sql)->fetchAll(PDO::FETCH_ASSOC);
if(count($user)>0){

    $ret['register_ok'] = 1;
    $ret['message'] = 'Register OK!';
    $_SESSION['registered'] = 0;
    $_SESSION['level'] = 0;
    $_SESSION['id_user'] = 0;
    $_SESSION['name'] = '';
}

echo json_encode($ret);
die();