<?php
// se includ fisierele obligatorii pentru configuratia aplicatiei si accesul la baza de date
include "../include/config.php";
include "../include/db_auth.php";
include "../include/auth_ajax.php";

// se initializeaza array-ul care va contine raspunsul
$ret = array();
$ret['code'] = 99;

$sql = "SELECT
            r.id_request,
            r.data_start,
            r.data_end,
            r.id_state,
            COUNT(a.id_article) AS positions,
            IFNULL(SUM(a.quantity),0) AS articles,
            s.name AS state            
        FROM
            requests AS r
            LEFT JOIN articles AS a
                ON r.id_request = a.id_request
            LEFT JOIN states AS s 
                ON r.id_state=s.id_state
        WHERE r.id_user = '".$_SESSION['id_user']."'
        GROUP BY r.id_request; ";

// se extrag toate comenzile pentru utilizatorul conectat
$reqs = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
if (count($reqs)>0) { // exista comenzi pentru utilizatorul conectat

    $html = '<table class="table1">';
    $html .= '<tr>';
    $html .= '<th style="width:10%;">Nr. crt</th>';
    $html .= '<th style="width:15%;">Nr. comandă</th>';
    $html .= '<th style="width:15%;">Data plasării</th>';
    $html .= '<th style="width:15%;">Data terminării</th>';
    $html .= '<th style="width:12%;">Nr. poziții</th>';
    $html .= '<th style="width:12%;">Nr. articole</th>';
    $html .= '<th>Status</th>';
    $html .= '<th style="width:10%;">Acțiuni</th>';
    $html .= '</tr>';

    for($i=0;$i<count($reqs);$i++) {
        $html .= '<tr>';
        $html .= '<td>'.($i+1).'</td>';
        $html .= '<td>'.$reqs[$i]['id_request'].'</td>';
        $html .= '<td>'.$reqs[$i]['data_start'].'</td>';
        $html .= '<td>'.$reqs[$i]['data_end'].'</td>';
        $html .= '<td>'.$reqs[$i]['positions'].'</td>';
        $html .= '<td>'.$reqs[$i]['articles'].'</td>';
        $html .= '<td>'.$reqs[$i]['state'].'</td>';
        if (intval($reqs[$i]['id_state'])!=0) {
            $html .= '<td></td>';
        } else {
            $html .= '<td><i class="fa fa-edit btn-edit" onclick="show_request(\'' . $reqs[$i]['id_request'] . '\')"></i> <i class="fa fa-trash btn-delete" onclick="delete_req(\'' . $reqs[$i]['id_request'] . '\')"></i></td>';
        }
        $html .= '</tr>';
    }
    $html .= '</table>';


    $ret['code'] = 1;
    $ret['message'] = 'ok';
    $ret['html'] = $html;

} else {  // nicio comanda nu a fost gasita in baza de date pentru utilizatorul conectat

    $ret['code'] = 1;
    $ret['message'] = 'ok';
    $ret['html'] = '<div class="no-results">Nu există nicio comandă înregistrată pentru dvs.</div>';

}

// se intoarce raspunsul
echo json_encode($ret);
die();