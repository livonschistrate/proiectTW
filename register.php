<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>CleA</title>
</head>
<body>    
    <h2 class="title">Register</h2><br>    
    <div class="login">    
    <form>    
        <label>
            <b>Full name</b>    
        </label>    
        <input type="text" name="fname" id ="Username"placeholder="Enter full name" required>    
        <br><br> 
        <label>
            <b>Email adress</b>    
        </label>    
        <input type="email" name="email" id ="Username"placeholder="Enter full name" required>    
        <br><br>    
        <label>
            <b>Password</b>    
        </label>    
        <input type="Password" name="password" id="Password" placeholder="Password" required>
        <br><br>
        <label>
            <b>Confirm password</b>    
        </label>    
        <input type="Password" name="password" id="Password" placeholder="Password" required>    
        <br><br>
        <input type="checkbox" id="check" required>    
        <span id="agree">I agree with terms and conditions</span>  
        <br><br> 
        <button type="submit" name="log" id="log">Register</button>    
    </form>     
</div>    
</body>    
</html>     