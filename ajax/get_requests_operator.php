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

$where = ' WHERE true ';
if (isset($_POST['filter_data_start']) && $_POST['filter_data_start']!='') {
    $where .= " AND r.data_start='".$_POST['filter_data_start']."' ";
}
if (isset($_POST['filter_id_user']) && $_POST['filter_id_user']!='' && $_POST['filter_id_user']!='0') {
    $where .= " AND r.id_user='".$_POST['filter_id_user']."' ";
}
if (isset($_POST['filter_id_state']) && $_POST['filter_id_state']!='' && $_POST['filter_id_state']!='-1') {
    $where .= " AND r.id_state='".$_POST['filter_id_state']."' ";
}
if (isset($_POST['filter_id_paid']) && $_POST['filter_id_paid']!='' && $_POST['filter_id_paid']!='-1') {
    $where .= " AND r.id_paid='".$_POST['filter_id_paid']."' ";
}


$sql = "SELECT COUNT(*) AS cate FROM
        (SELECT
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
        ".$where."
        GROUP BY r.id_request) AS t1; ";

$nr_reqs = $db->query($sql)->fetch(PDO::FETCH_ASSOC)['cate'];

$crt_page = (isset($_POST['crt_page'])) ? $_POST['crt_page'] : 1;

$reqs_per_page = (isset($_POST['reqs_per_page'])) ? $_POST['reqs_per_page'] : 10;

$nr_pages =  ceil($nr_reqs / $reqs_per_page);

if ( $crt_page > $nr_pages ) $crt_page =1;

$sort = isset($_POST['sort_col']) ? $_POST['sort_col'] : '1';

$sort_sql = '';

$sort_indicator = array();
for($i=1;$i<15;$i++)
    $sort_indicator[$i] = '';
switch($sort) {
    case '1' :
        $sort_sql = " ORDER BY r.id_request ";
        break;
    case '2' :
        $sort_sql = " ORDER BY u.firstname";
        break;
    case '3' :
        $sort_sql = " ORDER BY r.data_start ";
        break;
    case '4' :
        $sort_sql = " ORDER BY r.data_end ";
        break;
    case '5' :
        $sort_sql = " ORDER BY positions ";
        break;
    case '6' :
        $sort_sql = " ORDER BY articles ";
        break;
    case '7' :
        $sort_sql = " ORDER BY price ";
        break;
    case '8' :
        $sort_sql = " ORDER BY payment_name ";
        break;
    case '9' :
        $sort_sql = " ORDER BY r.id_state ";
        break;
}
$sort_indicator[ intval($_POST['sort_col']) ] = '<div style="float:right;position: relative;margin-left:3px;">
            <i class="fa fa-arrow-'.((isset($_POST['sort_order']) && $_POST['sort_order']=='1') ? 'down' : 'up').' sort-green"></i></div>';

if (isset($_POST['sort_order']) && $_POST['sort_order']=='1') {
    $sort_sql .= " DESC ";
} else {
    $sort_sql .= " ASC ";
}

$sql= "SELECT
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
        ".$where."
        GROUP BY r.id_request         
        ".$sort_sql." 
        LIMIT ".($crt_page-1).", ".($reqs_per_page).";";


// se extrag toate comenzile pentru utilizatorul conectat
$reqs = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
if (count($reqs)>0) { // exista comenzi pentru utilizatorul conectat

    $html = '<table class="table1">';
    $html .= '<thead>';
    $html .= '<tr>';
    $html .= '<th style="width:7%;">Nr. crt</th>';
    $html .= '<th style="width:7%;" class="sortable" onclick="sort(1);" ><div style="float: left;width:80%;text-align: center;">Nr. comandă</div>'.$sort_indicator[1].'</th>';
    $html .= '<th style="width:20%;" class="sortable" onclick="sort(2);" ><div style="float: left;width:80%;text-align: center;">Nume client</div>'.$sort_indicator[2].'</th>';
    $html .= '<th style="width:100px;" class="sortable" onclick="sort(3);" ><div style="float: left;width:80%;text-align: center;">Data plasării</div>'.$sort_indicator[3].'</th>';
    $html .= '<th style="width:100px;" class="sortable" onclick="sort(4);" ><div style="float: left;width:80%;text-align: center;">Data terminării</div>'.$sort_indicator[4].'</th>';
    $html .= '<th style="width:10%;" class="sortable" onclick="sort(5);" ><div style="float: left;width:80%;text-align: center;">Nr. poziții</div>'.$sort_indicator[5].'</th>';
    $html .= '<th style="width:10%;" class="sortable" onclick="sort(6);" ><div style="float: left;width:80%;text-align: center;">Nr. articole</div>'.$sort_indicator[6].'</th>';
    $html .= '<th style="width:10%;" class="sortable" onclick="sort(7);" ><div style="float: left;width:80%;text-align: center;">Preț</div>'.$sort_indicator[7].'</th>';
    $html .= '<th style="width:10%;" class="sortable" onclick="sort(8);" ><div style="float: left;width:80%;text-align: center;">Achitată</div>'.$sort_indicator[8].'</th>';
    $html .= '<th style="width:15%;" class="sortable" onclick="sort(9);" ><div style="float: left;width:80%;text-align: center;">Status</div>'.$sort_indicator[9].'</th>';
    $html .= '<th style="width:10%;min-width:100px;">Acțiuni</th>';
    $html .= '</tr>';
    $html .= '</thead>';

    for($i=0;$i<count($reqs);$i++) {
        $html .= '<tr>';
        $html .= '<td data-label="Nr. crt.">&nbsp;'.(($crt_page-1) * $reqs_per_page + $i + 1 ).'</td>';
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
    $ret['nr_pages'] = $nr_pages;
    $ret['nr_reqs'] = $nr_reqs;
    $ret['crt_page'] = $crt_page;

} else {  // nicio comanda nu a fost gasita in baza de date pentru utilizatorul conectat

    $ret['code'] = 1;
    $ret['message'] = 'ok';
    $ret['html'] = '<div class="no-results">Nu există nicio comandă înregistrată în sistem.</div>';
    $ret['nr_pages'] = 1;
    $ret['nr_reqs'] = $nr_reqs;
    $ret['crt_page'] = 1;

}

// se intoarce raspunsul
echo json_encode($ret);
die();