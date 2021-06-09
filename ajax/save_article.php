<?php
// se includ fisierele obligatorii pentru configuratia aplicatiei si accesul la baza de date
include "../include/config.php";
include "../include/db_auth.php";
include "../include/auth_ajax.php";

// se initializeaza array-ul care va contine raspunsul
$ret = array();
$ret['code'] = 99;
$ret['message'] = 'A apărut o eroare, reîncărcați pagina și reluați operația.';

if ( !isset($_POST['id_article']) || !isset($_POST['id_request']) ) { // nu a venit din pagina apelanta valorea necesara pentru salvarea unui articol
    $ret['code'] = 99;
    $ret['message'] = 'Valorile de apel sunt incorecte. Reîncărcați pagina și reluați operația.';
    echo json_encode($ret);
    die();
}

$id_request = intval(trim($_POST['id_request']));
$id_article = intval(trim($_POST['id_article']));

if ( $id_article==0) { //  este necesara adaugarea unui nou articol
    $sql = "INSERT INTO articles (id_request, quantity, id_article_type, id_material) 
                           VALUES(".$id_request.",'".$_POST['quantity']."','".$_POST['type']."','".$_POST['material']."');";
    $db->exec($sql);
    $id_article = $db->lastInsertId(); // se recupereaza id-ul articolului introdus in baza de date
    $ret['id_article'] = $id_request; // se intoarce ca raspuns in pagina id-ul articolului

    $ret['code'] = 1;
    $ret['message'] = 'Informațiile articolului au fost salvate.<br>Puteți continua să adăugați articole la comandă.';

} else { // se doreste actualizarea unei cereri existente
    $sql = "UPDATE articles SET quantity='".$_POST['quantity']."',
                                id_article_type='".$_POST['type']."',
                                id_material='".$_POST['material']."' 
                           WHERE id_article=".$id_article.";";
    $db->exec($sql);
    $ret['id_article'] = $id_article; // se intoarce ca raspuns in pagina id-ul articolului
    $ret['code'] = 1;
    $ret['message'] = 'Informațiile articolului au fost actualizate.<br>Puteți continua să adăugați articole la comandă.';
}

// se intoarce raspunsul spre pagina care a apelat via AJAX save_request.php
echo json_encode($ret);
die();