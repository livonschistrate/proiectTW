<?php
// se includ fisierele obligatorii pentru configuratia aplicatiei si accesul la baza de date
include "../include/config.php";
include "../include/db_auth.php";
include "../include/auth_ajax.php";

// se initializeaza array-ul care va contine raspunsul
$ret['code'] = 99;
$ret['message'] = 'A apărut o eroare, reîncărcați pagina și reluați operația.';

if ( !isset($_POST['id_request']) ) { // nu a venit din pagina apelanta valorea necesara pentru comanda (id-ul)
    $ret['code'] = 99;
    $ret['message'] = 'Valorile de apel sunt incorecte. Reîncărcați pagina și reluați operația.';
    echo json_encode($ret);
    die();
}

$id_request = intval(trim($_POST['id_request']));

$sql = "SELECT
            *
        FROM
        articles AS a
        LEFT JOIN article_types AS t
            ON a.id_article_type = t.id_article_type
        LEFT JOIN materials AS m
            ON a.id_material = m.id_material
        LEFT JOIN prices AS p
            ON a.id_article_type = p.id_article_type AND a.id_material = p.id_material 
        WHERE id_request = '".$id_request."' ;";

// se extrag toate articolele pentru o comanda
$articles = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
if (count($articles)>0) { // exista articole pentru cererea curenta

    $html = '<table class="table1">';
    $html .= '<thead>';
    $html .= '<tr>';
    $html .= '<th style="width:10%;">Nr. crt</th>';
    $html .= '<th style="width:15%;">Cantitate</th>';
    $html .= '<th>Tip articol</th>';
    $html .= '<th>Material</th>';
    $html .= '<th>Pret</th>';
    $html .= '<th style="width:15%;">Acțiuni</th>';
    $html .= '</tr>';
    $html .= '</thead>';

    for($i=0;$i<count($articles);$i++) {
        $html .= '<tr>';
        $html .= '<td data-label="Nr. crt:">&nbsp;'.($i+1).'</td>';
        $html .= '<td data-label="Cantitate:">&nbsp;'.$articles[$i]['quantity'].'</td>';
        $html .= '<td data-label="Tip articol:">&nbsp;'.$articles[$i]['article_name'].'</td>';
        $html .= '<td data-label="Material:">&nbsp;'.$articles[$i]['material_name'].'</td>';
        $html .= '<td data-label="Pret:">&nbsp;'.$articles[$i]['price'].'</td>';
        $html .= '<td><i class="fa fa-edit btn-edit" onclick="show_article(\''.$articles[$i]['id_article'].'\')"></i> <i class="fa fa-trash btn-delete" onclick="delete_article(\''.$articles[$i]['id_article'].'\')"></i></td>';
        $html .= '</tr>';
    }
    $html .= '</table>';

    $ret['code'] = 1;
    $ret['message'] = 'ok';
    $ret['html'] = $html;
} else {  // niciun articol nu a fost gaist in baza de date
    $ret['code'] = 1;
    $ret['message'] = 'ok';
    $ret['html'] = '<div class="no-results">Nu există niciun articol asignat acestei comenzi.<br> Puteți adăuga articole folosind pictograma (+) din partea de sus a formularului.</div>';
}

// se intoarce raspunsul
echo json_encode($ret);
die();