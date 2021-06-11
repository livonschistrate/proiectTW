<?php
session_start();
echo
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <script src="../js/lib.js"></script>
    <script src="../js/login.js"></script>
    <title>CleA</title>
</head>
<body>
<h2 class="title">Welcome back</h2><br>
<div class="login">
    <form>
        <label>
            <b>Email</b>
        </label>
        <input type="email" name="email" id ="Username" placeholder="Enter username" required>
        <br><br>
        <label>
            <b>Password</b>
        </label>
        <input type="password" name="password" id="Password" placeholder="Enter password" required>
        <br><br>
        <button type="button" name="log" id="log" onclick="check_login(this);">Log in</button>
        <br><br>
        <input type="checkbox" id="check">
        <span>Remember me</span>
        <br><br>
        Forgot <a href="#">password</a>
        <br><br>
        <span class ="register">Don't have an account? <a href="register.html"> Sign up</a></span>
    </form>
</div>

<?php
echo ">".getenv('CLEARDB_DATABASE_URL')."<";
?>
</body>
</html>
