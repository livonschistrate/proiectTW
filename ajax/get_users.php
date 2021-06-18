<?php
// se includ fisierele obligatorii pentru configuratia aplicatiei si accesul la baza de date
include "../include/config.php";
include "../include/db_auth.php";
include "../include/auth_ajax.php";

if ($_SESSION['level']<5) { // nu este cel putin rang de operator
    $ret = array();
    $ret['code'] = 0;
    $ret['message'] = 'Nu aveți dreptul să accesați această resursă.';
    echo json_encode($ret);
    die();
}

// se initializeaza array-ul care va contine raspunsul
$ret = array();
$ret['code'] = 99;

$sql = "SELECT
            u.id_user,
            u.firstname,
            u.lastname,
            u.email,
            u.address,
            ur.name AS role_name
        FROM
            users AS u
        LEFT JOIN user_role AS ur
            ON ur.id_role = u.id_role
        GROUP BY u.id_user; ";

// se extrag toate comenzile pentru utilizatorul conectat
$reqs = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
if (count($reqs)>0) { // exista comenzi pentru utilizatorul conectat

    $html = '<table class="table1">';
    $html .= '<thead>';
    $html .= '<tr>';
    $html .= '<th style="width:7%;">Nr. crt</th>';
    $html .= '<th style="width:7%;">Id util.</th>';
    $html .= '<th style="width:20%;">Nume utilizator</th>';
    $html .= '<th style="width:10%;">Email</th>';
    $html .= '<th style="width:10%;">Adresa</th>';
    $html .= '<th style="width:15%;">Rol</th>';
    $html .= '<th style="width:10%;">Acțiuni</th>';
    $html .= '</tr>';
    $html .= '</thead>';

    for($i=0;$i<count($reqs);$i++) {
        $html .= '<tr>';
        $html .= '<td data-label="Nr. crt.">&nbsp;'.($i+1).'</td>';
        $html .= '<td data-label="Id util.">&nbsp;'.$reqs[$i]['id_user'].'</td>';
        $html .= '<td data-label="Nume client">&nbsp;'.$reqs[$i]['firstname'].' '.$reqs[$i]['lastname'].'</td>';
        $html .= '<td data-label="Email">&nbsp;'.$reqs[$i]['email'].'</td>';
        $html .= '<td data-label="Adresa">&nbsp;'.$reqs[$i]['address'].'</td>';
        $html .= '<td data-label="Rol">&nbsp;'.$reqs[$i]['role_name'].'</td>';
        $html .= '<td><i class="fa fa-edit btn-edit" onclick="show_user(\''.$reqs[$i]['id_user'].'\')"></i> </td>';
        $html .= '</tr>';
    }
    $html .= '</table>';


    $ret['code'] = 1;
    $ret['message'] = 'ok';
    $ret['html'] = $html;

} else {  // nicio comanda nu a fost gasita in baza de date pentru utilizatorul conectat

    $ret['code'] = 1;
    $ret['message'] = 'ok';
    $ret['html'] = '<div class="no-results">Nu există niciun utilizator înregistrat în sistem.</div>';

}

// se intoarce raspunsul
echo json_encode($ret);
die();