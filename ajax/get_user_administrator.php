<?php
// se includ fisierele obligatorii pentru configuratia aplicatiei si accesul la baza de date
include "../include/config.php";
include "../include/db_auth.php";
include "../include/auth_ajax.php";

// se initializeaza array-ul care va contine raspunsul
$ret['code'] = 99;
$ret['message'] = 'A apărut o eroare, reîncărcați pagina și reluați operația.';

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
    $user = $db->query($sql)->fetch(PDO::FETCH_ASSOC);
    if (count($user) > 0) { // exista utilizatorul

        $ret['id_user'] = $user['id_user'];
        $ret['firstname'] = $user['firstname'];
        $ret['lastname'] = $user['lastname'];
        $ret['address'] = $user['address'];
        $ret['email'] = $user['email'];
        $ret['id_role'] = $user['id_role'];
        $ret['validated'] = $user['is_validated'];
        $ret['enabled'] = $user['is_enabled'];

        $ret['code'] = 1;
        $ret['message'] = 'ok';

    } else {  // nu exista userul, eroare, se intorc valorile standard

        $ret['id_user'] = 0;
        $ret['firstname'] = '';
        $ret['lastname'] = '';
        $ret['address'] = '';
        $ret['email'] = '';
        $ret['id_role'] = '';
        $ret['validated'] = '';
        $ret['enabled'] = '';

        $ret['code'] = 99;
        $ret['message'] = 'Informațiile utilizatorului nu au fost găsite. Reîncărcați pagina și reluați operația.';
    }
}
// se intoarce raspunsul
echo json_encode($ret);
die();