<?php
include "../include/auth.php";
include "../include/db_auth.php";

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
    <script src="../js/setari.js"></script>
    <script src="../scripts/mainbutton.js"></script>

</head>
<body>

<?php include "../include/navigation.php" ?>

<div class="main-content">
    <div class="content">
        <div class="req-header">
            <div class="setari-title">Setări</div>
            <br>
            <div class="article-row">
                <div class="article-col-1">
                    Nume:
                </div>
                <div class="article-col-2">
                    <input type="text" id="lastname" placeholder="Nume" >
                </div>
            </div>
            <div class="article-row">
                <div class="article-col-1">
                    Prenume:
                </div>
                <div class="article-col-2">
                    <input type="text" id="firstname" placeholder="Prenume" >
                </div>
            </div>
            <div class="article-row">
                <div class="article-col-1">
                    Adresa:
                </div>
                <div class="article-col-2">
                    <input type="text" id="address" placeholder="Adresa" >
                </div>
            </div>
            <div class="article-row">
                <div class="article-col-1">
                    E-mail:
                </div>
                <div class="article-col-2">
                    <input type="text" id="email" readonly  >
                </div>
            </div>
            <div class="article-row">
                <div class="article-col-1">
                    Telefon:
                </div>
                <div class="article-col-2">
                    <input type="text" id="telefon" >
                </div>
            </div>
            <div class="article-row">
                <input type="button" value="Salvează" style="margin-bottom: 1em; float: right;" onclick="save_settings();">
            </div>
            <br>
            <div class="article-row">
                <div class="article-col-1">
                    Parola noua:
                </div>
                <div class="article-col-2">
                    <input type="password" id="parola_1" placeholder="Parola" >
                </div>
            </div>
            <div class="article-row">
                <div class="article-col-1">
                    Verificare parola:
                </div>
                <div class="article-col-2">
                    <input type="password" id="parola_2" placeholder="Verificare parola" >
                </div>
            </div>
            <div class="article-row">
                <input type="button" value="Schimbare parola" style="margin-bottom: 1em; float: right;" onclick="save_password();">
            </div>
        </div>
    </div>
</div>

<?php include "../include/footer.php" ?>
</body>
</html>