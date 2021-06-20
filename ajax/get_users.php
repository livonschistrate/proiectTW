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

$sql = " SELECT COUNT(*) AS cate FROM
        (SELECT
            u.id_user,
            u.firstname,
            u.lastname,
            u.email,
            u.address,
            ur.name AS role_name,
            u.is_validated,
            u.is_deleted,
            u.is_enabled,
            u.register_date
        FROM
            users AS u
        LEFT JOIN user_role AS ur
            ON ur.id_role = u.id_role
        GROUP BY u.id_user) AS t1; ";

$nr_reqs = $db->query($sql)->fetch(PDO::FETCH_ASSOC)['cate'];

$crt_page = (isset($_POST['crt_page'])) ? $_POST['crt_page'] : 1;

$reqs_per_page = (isset($_POST['reqs_per_page'])) ? $_POST['reqs_per_page'] : 10;

$nr_pages =  ceil($nr_reqs / $reqs_per_page);

if ( $crt_page > $nr_pages ) $crt_page =1;

$sort = isset($_POST['sort_col']) ? $_POST['sort_col'] : '1';

$sort_sql = '';

$sort_indicator = array();
for($i=1;$i<10;$i++)
    $sort_indicator[$i] = '';
switch($sort) {
    case '1' :
        $sort_sql = " ORDER BY u.id_user ";
        break;
    case '2' :
        $sort_sql = " ORDER BY u.firstname";
        break;
    case '3' :
        $sort_sql = " ORDER BY u.email ";
        break;
    case '4' :
        $sort_sql = " ORDER BY u.address ";
        break;
    case '5' :
        $sort_sql = " ORDER BY role_name ";
        break;
}

$sort_indicator[ intval($_POST['sort_col']) ] = '<div style="float:right;position: relative;margin-left:3px;">
            <i class="fa fa-arrow-'.((isset($_POST['sort_order']) && $_POST['sort_order']=='1') ? 'down' : 'up').' sort-green"></i></div>';

if (isset($_POST['sort_order']) && $_POST['sort_order']=='1') {
    $sort_sql .= " DESC ";
} else {
    $sort_sql .= " ASC ";
}

$sql = "SELECT
            u.id_user,
            u.firstname,
            u.lastname,
            u.email,
            u.address,
            ur.name AS role_name,
            u.is_validated,
            u.is_deleted,
            u.is_enabled,
            u.register_date
        FROM
            users AS u
        LEFT JOIN user_role AS ur
            ON ur.id_role = u.id_role
        GROUP BY u.id_user ".$sort_sql."
        LIMIT ".($crt_page - 1).", ".$reqs_per_page.";";

// se extrag toate comenzile pentru utilizatorul conectat
$reqs = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
if (count($reqs)>0) { // exista comenzi pentru utilizatorul conectat

    $html = '<table class="table1">';
    $html .= '<thead>';
    $html .= '<tr>';
    $html .= '<th style="width:7%;">Nr. crt</th>';
    $html .= '<th style="width:7%;" class="sortable" onclick="sort(1);" ><div style="float: left;width:80%;text-align: center;">Id util.</div>'.$sort_indicator[1].'</th>';
    $html .= '<th style="width:20%;" class="sortable" onclick="sort(2);" ><div style="float: left;width:80%;text-align: center;">Nume utilizator</div>'.$sort_indicator[2].'</th>';
    $html .= '<th style="width:10%;" class="sortable" onclick="sort(3);" ><div style="float: left;width:80%;text-align: center;">Email</div>'.$sort_indicator[3].'</th>';
    $html .= '<th style="width:10%;" class="sortable" onclick="sort(4);" ><div style="float: left;width:80%;text-align: center;">Adresa</div>'.$sort_indicator[4].'</th>';
    $html .= '<th style="width:15%;" class="sortable" onclick="sort(5);" ><div style="float: left;width:80%;text-align: center;">Rol</div>'.$sort_indicator[5].'</th>';
    $html .= '<th style="width:15%;">Validat</th>';
    $html .= '<th style="width:15%;">Șters</th>';
    $html .= '<th style="width:15%;">Activat</th>';
    $html .= '<th style="width:15%;">Înregistrat pe</th>';
    $html .= '<th style="width:10%;">Acțiuni</th>';
    $html .= '</tr>';
    $html .= '</thead>';

    for($i=0;$i<count($reqs);$i++) {
        $html .= '<tr>';
        $html .= '<td data-label="Nr. crt.">&nbsp;'.(($crt_page-1) * $reqs_per_page + $i + 1 ).'</td>';
        $html .= '<td data-label="Id util.">&nbsp;'.$reqs[$i]['id_user'].'</td>';
        $html .= '<td data-label="Nume client">&nbsp;'.$reqs[$i]['firstname'].' '.$reqs[$i]['lastname'].'</td>';
        $html .= '<td data-label="Email">&nbsp;'.$reqs[$i]['email'].'</td>';
        $html .= '<td data-label="Adresa">&nbsp;'.$reqs[$i]['address'].'</td>';
        $html .= '<td data-label="Rol">&nbsp;'.$reqs[$i]['role_name'].'</td>';
        $html .= '<td data-label="Validat">&nbsp;'.$reqs[$i]['is_validated'].'</td>';
        $html .= '<td data-label="Șters">&nbsp;'.$reqs[$i]['is_deleted'].'</td>';
        $html .= '<td data-label="Activat">&nbsp;'.$reqs[$i]['is_enabled'].'</td>';
        $html .= '<td data-label="Înregistrat pe">&nbsp;'.$reqs[$i]['register_date'].'</td>';
        $html .= '<td><i class="fa fa-edit btn-edit" onclick="show_user(\''.$reqs[$i]['id_user'].'\')"></i> </td>';
        $html .= '</tr>';
    }
    $html .= '</table>';


    $ret['code'] = 1;
    $ret['message'] = 'ok';
    $ret['html'] = $html;
    $ret['nr_pages'] = $nr_pages;
    $ret['crt_page'] = $crt_page;

} else {  // nicio comanda nu a fost gasita in baza de date pentru utilizatorul conectat

    $ret['code'] = 1;
    $ret['message'] = 'ok';
    $ret['html'] = '<div class="no-results">Nu există niciun utilizator înregistrat în sistem.</div>';
    $ret['nr_pages'] = 1;
    $ret['crt_page'] = 1;

}

// se intoarce raspunsul
echo json_encode($ret);
die();