<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/login.css">
    <link rel="stylesheet" href="../css/mainstyle.css">
    <script src="../scripts/mainbutton.js"></script>
    <script src="../js/registration.js"></script>
    <script src="../js/lib.js"></script>
    <title>CleA</title>
</head>
<body>    
    <div class="container">
        <div class="background"></div>
        <header class="header">
            <div class="h-title"><a class="item" href ="../index.php">CleanAll</a></div>
        <div class="menu">
        <div class="menubutton">
                <button class="options">
                    <div class="bar"></div>
                    <div class="bar"></div>
                    <div class="bar"></div>
                </button>
        </div>
            <nav class="menubar">
                <a class="item" href ="contact.php">Contact</a>
                <a class="item" href="services.php">Servicii</a>
                <a class="item" href="login.php">Log-in</a>
                <a class="item" href="register.php">Înregistrare</a>
            </nav>
            </div>
        </header>
    </div>
    <div class="login">    
    <form>
        <label>
            <b>Prenume</b>
        </label>
        <input type="text" name="fname" id ="Firstname"placeholder="Prenume" required>
        <br><br>
        <label>
            <b>Nume</b>
        </label>
        <input type="text" name="lname" id ="Lastname"placeholder="Nume" required>
        <br><br>
        <label>
            <b>Adresa de email</b>    
        </label>    
        <input type="email" name="email" id ="Email"placeholder="Introduceti adresa de email" required>
        <br><br>    
        <label>
            <b>Parola</b>    
        </label>    
        <input type="Password" name="password" id="Password" placeholder="Introduceti parola" required>
        <br><br>
        <label>
            <b>Confirmati parola</b>    
        </label>    
        <input type="Password" name="password" id="CPassword" placeholder="Confirmati parola" required>
        <br><br>
        <input type="checkbox" id="check" required>    
        <span id="agree">Sunt de acord cu termenii si conditiile</span>  
        <br><br> 
        <button type="button" id="btnRegister" onclick="check_register(this);">Inregistrare</button>
    </form>     
</div>    
<?php
 include "../include/footer.php";

?>
</body>    
</html>     
