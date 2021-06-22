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
    <script src="../js/edit_preturi.js"></script>
    <script src="../scripts/mainbutton.js"></script>
</head>
<body>

<?php include "../include/navigation.php" ?>

<div class="main-content">
    <div class="content">
        <input type="hidden" id="sort_col" value="1">
        <input type="hidden" id="sort_order" value="0">

        <div class="req-header">
            <div class="req-title">Tipuri de articole</div>
        </div>

        <div id="reqs" class="reqs" style="min-height:20em;">
            We are working on it!
        </div>
    </div>
</div>


<?php include "../include/footer.php" ?>

</body>
</html>