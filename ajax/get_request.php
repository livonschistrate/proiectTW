<?php
// se includ fisierele obligatorii pentru configuratia aplicatiei si accesul la baza de date
include "../include/config.php";
include "../include/db_auth.php";
include "../include/auth_ajax.php";

// se initializeaza array-ul care va contine raspunsul
$ret = array();
$ret['code'] = 99;
$ret['message'] = 'not ok';

if ( !isset($_POST['id_request']) ) { // nu a venit din pagina apelanta valorea necesara pentru comanda (id-ul)
    $ret['code'] = 99;
    $ret['message'] = 'Valorile de apel sunt incorecte. Reîncărcați pagina și reluați operația.';
    echo json_encode($ret);
    die();
}

$id_request = intval(trim($_POST['id_request']));

if($id_request==0) {

    $ret['code'] = 1;
    $ret['message'] = 'ok';
    $ret['id_request'] = 0;
    $ret['id_state'] = 0;
    $ret['data_start'] = date('Y-m-d',time());
    $ret['data_end'] = null;

} else {

    $sql = "SELECT
                *
            FROM
                requests AS r
            WHERE r.id_request = '" . $id_request . "' ; ";

// se extrag informatiile
    $reqs = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    if (count($reqs) > 0) { // exista comanda

        $ret['code'] = 1;
        $ret['message'] = 'ok';
        $ret['id_request'] = $reqs[0]['id_request'];
        $ret['id_state'] = $reqs[0]['id_state'];
        $ret['data_start'] = $reqs[0]['data_start'];
        $ret['data_end'] = $reqs[0]['data_end'];

    } else {  // nicio comanda nu a fost gasita in baza de date pentru utilizatorul conectat

        $ret['code'] = 99;
        $ret['message'] = 'Informațiile comenzii nu au fost găsite. Reîncărcați pagina și reluați operația.';;
        $ret['id_request'] = 0;
        $ret['id_request'] = 0;
        $ret['data_start'] = date('Y-m-d', time());
        $ret['data_end'] = null;

    }
}
// se intoarce raspunsul
echo json_encode($ret);
die();