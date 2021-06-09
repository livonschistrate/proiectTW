<?php
// se includ fisierele obligatorii pentru configuratia aplicatiei si accesul la baza de date
include "../include/config.php";
include "../include/db_auth.php";
include "../include/auth_ajax.php";

// se initializeaza array-ul care va contine raspunsul
$ret['code'] = 99;
$ret['message'] = 'A apărut o eroare, reîncărcați pagina și reluați operația.';

if ( !isset($_POST['id_article']) ) { // nu a venit din pagina apelanta valorea necesara pentru articol (id-ul)
    $ret['code'] = 99;
    $ret['message'] = 'Valorile de apel sunt incorecte. Reîncărcați pagina și reluați operația.';
    echo json_encode($ret);
    die();
}

$id_article = intval(trim($_POST['id_article']));


if ($id_article==0) {

    $ret['id_article'] = 0;
    $ret['type'] = 7;
    $ret['material'] = 1;
    $ret['quantity'] = 1;

    $ret['code'] = 1;
    $ret['message'] = 'ok';

} else {

    $sql = "SELECT
            *
        FROM
        articles AS a
        WHERE id_article = '" . $id_article . "' ;";

// se extrag informatiile unui articol
    $article = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    if (count($article) > 0) { // exista articolul

        $ret['id_article'] = $article[0]['id_article'];
        $ret['type'] = $article[0]['id_article_type'];
        $ret['material'] = $article[0]['id_material'];
        $ret['quantity'] = $article[0]['quantity'];

        $ret['code'] = 1;
        $ret['message'] = 'ok';

    } else {  // nu exista articolul, eroare, se intorc valorile standard

        $ret['id_article'] = 0;
        $ret['type'] = 7;
        $ret['material'] = 1;
        $ret['quantity'] = 1;

        $ret['code'] = 99;
        $ret['message'] = 'Informațiile articolului nu au fost găsite. Reîncărcați pagina și reluați operația.';
    }
}
// se intoarce raspunsul
echo json_encode($ret);
die();