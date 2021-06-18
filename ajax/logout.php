<?php
session_start();

// se reseteaza variabilele sesiune
$_SESSION['logged_in']=0;
$_SESSION['logged_in'] = 0;
$_SESSION['id_role'] = 0;
$_SESSION['id_user'] = 0;
$_SESSION['name'] = '';

// se construieste un array care va fi intors sub forma JSON
$ret = array();
$ret['logout_ok'] = 1;
$ret['message'] = 'Logout OK!';

echo json_encode($ret);
