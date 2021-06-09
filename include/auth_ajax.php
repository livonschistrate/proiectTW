<?php
include "config.php";

session_start();


if(!isset($_SESSION['logged_in']) || $_SESSION['logged_in']!=1 ) {
    $ret = array();
    $ret['code'] = 0;
    $ret['message'] = 'Autentificare invalidă sau expirată. Reîncărcați pagina și reluați operația.';
    echo json_encode($ret);
    die();
}
