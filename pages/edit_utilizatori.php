<?php
include "../include/auth.php";
include "../include/db_auth.php";

if ($_SESSION['level']<10) { // nu este rang de administrator
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CleanAll</title>
    <link rel="stylesheet" href="../css/mainstyle.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Raleway:wght@500&family=Source+Sans+Pro:wght@600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../fonts/awesome/css/all.min.css">
    <script src="../js/lib.js"></script>
    <script src="../scripts/mainbutton.js"></script>
</head>
<body>
<div class="container">
    <div class="background"></div>
    <header class="header">
        <div class="h-title" href="#" onclick="go_to_dashboard();">CleanAll</div>
        <div class="menu" onclick="showMenu()">
            <div class="menubutton">
                <button class="options">
                    <div class="bar"></div>
                    <div class="bar"></div>
                    <div class="bar"></div>
                </button>
            </div>
        </div>
    </header>
</div>
<div class="not_allowed">
    Nu aveți dreptul să accesați această pagină!
    <br>
    <span onclick="go_to_dashboard()">Clic aici pentru a merge la pagina de intrare.</span>
</div>
</body>
</html>
<?php
    die();
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CleanAll</title>
    <link rel="stylesheet" href="../css/mainstyle.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Raleway:wght@500&family=Source+Sans+Pro:wght@600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../fonts/awesome/css/all.min.css">
    <script src="../js/lib.js"></script>
    <script src="../js/edit_utilizatori.js"></script>
    <script src="../scripts/mainbutton.js"></script>
</head>
<body>

<?php include "../include/navigation.php" ?>

<div class="main-content">
    <div class="content">
        <input type="hidden" id="sort_col" value="1">
        <input type="hidden" id="sort_order" value="0">

        <div class="req-header">
            <div class="req-title">Utilizatori</div>
            <i class="fa fa-2x fa-plus-circle add-req" onclick="show_user(0);" title="Adaugă un utlizator"></i>
        </div>
        <div class="pagination">
            Pag.
            <select id="crt_page" class="req-select" style="margin-right: 4px;" onchange="reload_data();">
                <option value="1" selected>1</option>
            </select>
            Nr./pag.
            <select id="reqs_per_page" class="req-select" style="margin-right: 4px;" onchange="reload_data();">
                <option value="10">10
                <option value="20">20
                <option value="50">50
                <option value="100">100
            </select>
        </div>

        <div id="reqs" class="reqs">

        </div>
    </div>
</div>

<!--div pentru schimbarea nivelului-->
<div id="user" class="modal">
    <div class="modal-content modal-request">
        <input type="hidden" id="id_user" value="0">
        <div>
            <div class="req-title">Editare rol utilizator</div>
            <i class="fa fa-times close-req" id="close_req" onclick="close_req();"></i>
        </div>
        <div class="req-form">
            <div class="article-row">
                <div class="article-col-1">
                    Id. user:
                </div>
                <div class="article-col-2">
                    <label id="nr_user" class="req-nr">--</label>
                </div>
            </div>
            <div class="article-row">
                <div class="article-col-1">
                    Rolul utilizatorului:
                </div>
                <div class="article-col-2">
                    <select id="id_role" class="req-select">
                        <?php
                        // se afiseaza lista cu tipurile de roluri existente in baza de date
                        $sql = "SELECT * 
                                    FROM user_role 
                                    ORDER BY id_role;";
                        $states = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
                        for($i=0;$i<count($states);$i++){
                            echo '<option value="'.$states[$i]['id_role'].'"> '.$states[$i]['name'];
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="article-row">
                <div class="article-col-1">
                    Validat:
                </div>
                <div class="article-col-2">
                    <select id="validated" class="req-select">
                        <option value="0">Nevalidat</option>
                        <option value="1">Validat</option>
                    </select>
                </div>
            </div>
            <div class="article-row">
                <div class="article-col-1">
                    Activ:
                </div>
                <div class="article-col-2">
                    <select id="enabled" class="req-select">
                        <option value="0">Inactiv</option>
                        <option value="1">Activ</option>
                    </select>
                </div>
            </div>
            <div class="article-row">
                <input type="button" value="Salvează" style="float:right;" onclick="save_user();">
            </div>
        </div>


    </div>
</div>



<?php include "../include/footer.php" ?>

</body>
</html>
