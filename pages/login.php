<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" href="../css/mainstyle.css">
    <script src="../js/lib.js"></script>
    <script src="../js/login.js"></script>
    <script src="../scripts/mainbutton.js"></script>
    <title>CleA</title>
</head>
<body>
<div class="container">
    <div class="background"></div>
    <header class="header">
        <a class="h-title" href="../index.php">CleanAll</a>
        <div class="menu" onclick="showMenu()">
            <div class="menubutton">
                <button class="options">
                    <div class="bar"></div>
                    <div class="bar"></div>
                    <div class="bar"></div>
                </button>
            </div>
            <nav  id="menubar" class="display-off">
                <a class="item" href="contact.php">Contact</a>
                <a class="item" href="services.php">Servicii</a>
                <a class="item" href="login.php">Log-in</a>
                <a class="item" href="register.php">Înregistrare</a>
            </nav>
        </div>
    </header>
</div>
<h2 class="title">Welcome back</h2><br>
<div class="login">
    <form>
        <label>
            <b>Email</b>
        </label>
        <input type="text" name="email" id ="Email" placeholder="Adresa de e-mail" required>
        <br><br>
        <label>
            <b>Password</b>
        </label>
        <input type="password" name="password" id="Password" placeholder="Parola dvs." required>
        <br><br>
        <button type="button" id="btnLogin" onclick="check_login(this);">Log in</button>
        <br><br>
        <input type="checkbox" id="check">
        <span>Remember me</span>
        <br><br>
        Forgot <a href="#">password</a>
        <br><br>
        <span class ="register">Don't have an account? <a href="register.php"> Sign up</a></span>
    </form>
</div>
<footer class="footer">
    <div class="h-title" href="index.php">CleanAll</div>
    <ul id="menubar">
        <a href="contact.php" class="item">Contact</a>
        <a href="services.php" class="item">Cum functioneaza</a>
    </ul>
</footer>

<?php
echo getenv('CLEARDB_DATABASE_URL');
?>

</body>
</html>
