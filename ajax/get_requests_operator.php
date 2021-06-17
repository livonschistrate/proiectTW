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
            r.id_request,
            r.data_start,
            r.data_end,
            r.id_state,
            COUNT(a.id_article) AS positions,
            IFNULL(SUM(a.quantity),0) AS articles,
            s.name AS state,
            u.firstname,
            u.lastname,
            u.email,
            SUM(p.price * a.quantity) AS price,
            ps.name AS payment_name
        FROM
            requests AS r
            LEFT JOIN articles AS a
                ON r.id_request = a.id_request
            LEFT JOIN states AS s 
                ON r.id_state=s.id_state
            LEFT JOIN users AS u 
                ON r.id_user=u.id_user
            LEFT JOIN prices AS p
                ON a.id_article_type = p.id_article_type AND a.id_material = p.id_material 
            LEFT JOIN paid_status AS ps
                ON ps.id_paid = r.id_paid
        GROUP BY r.id_request; ";

// se extrag toate comenzile pentru utilizatorul conectat
$reqs = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
if (count($reqs)>0) { // exista comenzi pentru utilizatorul conectat

    $html = '<table class="table1">';
    $html .= '<thead>';
    $html .= '<tr>';
    $html .= '<th style="width:7%;">Nr. crt</th>';
    $html .= '<th style="width:7%;">Nr. comandă</th>';
    $html .= '<th style="width:20%;">Nume client</th>';
    $html .= '<th style="width:100px;">Data plasării</th>';
    $html .= '<th style="width:100px;">Data terminării</th>';
    $html .= '<th style="width:10%;">Nr. poziții</th>';
    $html .= '<th style="width:10%;">Nr. articole</th>';
    $html .= '<th style="width:10%;">Preț</th>';
    $html .= '<th style="width:10%;">Achitată</th>';
    $html .= '<th style="width:15%;">Status</th>';
    $html .= '<th style="width:10%;">Acțiuni</th>';
    $html .= '</tr>';
    $html .= '</thead>';

    for($i=0;$i<count($reqs);$i++) {
        $html .= '<tr>';
        $html .= '<td data-label="Nr. crt.">&nbsp;'.($i+1).'</td>';
        $html .= '<td data-label="Nr. comandă">&nbsp;'.$reqs[$i]['id_request'].'</td>';
        $html .= '<td data-label="Nume client">&nbsp;'.$reqs[$i]['firstname'].' '.$reqs[$i]['lastname'].'</td>';
        $html .= '<td data-label="Data plasării">&nbsp;'.$reqs[$i]['data_start'].'</td>';
        $html .= '<td data-label="Data terminării">&nbsp;'.$reqs[$i]['data_end'].'</td>';
        $html .= '<td data-label="Nr. poziții">&nbsp;'.$reqs[$i]['positions'].'</td>';
        $html .= '<td data-label="Nr. articole">&nbsp;'.$reqs[$i]['articles'].'</td>';
        $html .= '<td data-label="Preț">&nbsp;'.$reqs[$i]['price'].'</td>';
        $html .= '<td data-label="Achitată">&nbsp;'.$reqs[$i]['payment_name'].'</td>';
        $html .= '<td data-label="Status">&nbsp;'.$reqs[$i]['state'].'</td>';
        $html .= '<td data-label="Acțiuni"><i class="fa fa-edit btn-edit" onclick="show_request(\''.$reqs[$i]['id_request'].'\')"></i> <i class="fa fa-trash btn-delete" onclick="delete_req(\''.$reqs[$i]['id_request'].'\')"></i></td>';
        $html .= '</tr>';
    }
    $html .= '</table>';


    $ret['code'] = 1;
    $ret['message'] = 'ok';
    $ret['html'] = $html;

} else {  // nicio comanda nu a fost gasita in baza de date pentru utilizatorul conectat

    $ret['code'] = 1;
    $ret['message'] = 'ok';
    $ret['html'] = '<div class="no-results">Nu există nicio comandă înregistrată în sistem.</div>';

}

// se intoarce raspunsul
echo json_encode($ret);
die();