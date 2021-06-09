<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="login.css">
    <link rel="stylesheet" href="css/mainstyle.css">
    <title>CleA</title>
</head>
<body>    
    <div class="container">
        <div class="background"></div>
        <header class="header">
            <div class="titleH"><a class="item" href ="index.html">CleanAll</a></div>
        <div class="menu">
        <div class="menubutton">
                <button class="options">
                    <div class="bar"></div>
                    <div class="bar"></div>
                    <div class="bar"></div>
                </button>
        </div>
            <nav class="menubar">
                <a class="item" href ="index.html">Despre</a>
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
            <b>Numele complet</b>    
        </label>    
        <input type="text" name="fname" id ="Username"placeholder="Introduceti numele complet" required>    
        <br><br> 
        <label>
            <b>Adresa de email</b>    
        </label>    
        <input type="email" name="email" id ="Username"placeholder="Introduceti adresa de email" required>    
        <br><br>    
        <label>
            <b>Parola</b>    
        </label>    
        <input type="Password" name="password" id="Password" placeholder="Introduceti parola" required>
        <br><br>
        <label>
            <b>Confirmati parola</b>    
        </label>    
        <input type="Password" name="password" id="Password" placeholder="Confirmati parola" required>    
        <br><br>
        <input type="checkbox" id="check" required>    
        <span id="agree">Sunt de acord cu termenii si conditiile</span>  
        <br><br> 
        <button type="submit" name="log" id="log">Inregistrare</button>    
    </form>     
</div>    
<footer class="footer">
    <div class="titleH" href="index.php">CleanAll</div>
    <ul class="menubar">
        <li class="item"><a href="contact.php">Contact</a></li>
        <li class="item" href="services.php">Cum functioneaza</li>
    </ul>
</footer>     
</body>    
</html>     
