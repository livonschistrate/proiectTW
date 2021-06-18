<?php
// se includ fisierele obligatorii pentru configuratia aplicatiei si accesul la baza de date
include "../include/config.php";
include "../include/db_auth.php";
include "../include/auth_ajax.php";

// se initializeaza array-ul care va contine raspunsul
$ret['code'] = 99;
$ret['message'] = 'A apărut o eroare, reîncărcați pagina și reluați operația.';

if ( !isset($_POST['id_user']) ) { // nu a venit din pagina apelanta valorea necesara pentru user (id-ul)
    $ret['code'] = 99;
    $ret['message'] = 'Valorile de apel sunt incorecte. Reîncărcați pagina și reluați operația.';
    echo json_encode($ret);
    die();
}

$id_user = intval(trim($_POST['id_user']));


if ($id_user==0) {

    $ret['id_user'] = 0;
    $ret['id_role'] = 0;

    $ret['code'] = 1;
    $ret['message'] = 'ok';

} else {

    $sql = "SELECT
            *
        FROM
        users AS a
        WHERE id_user = '" . $id_user . "' ;";

// se extrag informatiile unui user
    $user = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    if (count($user) > 0) { // exista articolul

        $ret['id_user'] = $user[0]['id_user'];
        $ret['id_role'] = $user[0]['id_role'];

        $ret['code'] = 1;
        $ret['message'] = 'ok';

    } else {  // nu exista userul, eroare, se intorc valorile standard

        $ret['id_user'] = 0;
        $ret['id_role'] = 0;

        $ret['code'] = 99;
        $ret['message'] = 'Informațiile articolului nu au fost găsite. Reîncărcați pagina și reluați operația.';
    }
}
// se intoarce raspunsul
echo json_encode($ret);
die();