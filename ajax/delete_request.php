<?php
// se includ fisierele obligatorii pentru configuratia aplicatiei si accesul la baza de date
include "../include/config.php";
include "../include/db_auth.php";
include "../include/auth_ajax.php";

// se initializeaza array-ul care va contine raspunsul
$ret['code'] = 99;
$ret['message'] = 'A apărut o eroare, reîncărcați pagina și reluați operația.';

if ( !isset($_POST['id_request']) ) { // nu a venit din pagina apelanta valorea necesara pentru articol (id-ul)
    $ret['code'] = 99;
    $ret['message'] = 'Valorile de apel sunt incorecte. Reîncărcați pagina și reluați operația.';
    echo json_encode($ret);
    die();
}

$id_request = intval(trim($_POST['id_request']));


if ($id_request==0) {

    $ret['id_request'] = 0;
    $ret['code'] = 1;
    $ret['message'] = 'ok';

} else {

    $sql = "DELETE FROM 
                articles 
            WHERE id_request = " . $id_request . " ;";

    $db->exec($sql);

    $sql = "DELETE FROM 
                requests 
            WHERE id_request = " . $id_request . " ;";

    $db->exec($sql);


    $ret['id_request'] = 0;

    $ret['code'] = 1;
    $ret['message'] = 'Comanda a fost ștearsă.';

}
// se intoarce raspunsul
echo json_encode($ret);
die();