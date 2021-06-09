<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="login.css">
    <title>CleA</title>
</head>
<body>    
    <div class="container">
        <div class="background"></div>
        <header class="header">
            <div class="titleH"><a class="item" href =mainpage.html>CleanAll</a></div>
        <div class="menu">
        <div class="menubutton">
                <button class="options">
                    <div class="bar"></div>
                    <div class="bar"></div>
                    <div class="bar"></div>
                </button>
        </div>
            <nav class="menubar">
                <a class="item">Despre</a>
                <a class="item" href="services.html">Servicii</a>
                <a class="item" href="login.html">Log-in</a>
                <a class="item" href="register.html">Înregistrare</a>
            </nav>
            </div>
        </header>
    </div>
    <div class="login">    
    <form>    
        <label>
            <b>Email</b>    
        </label>    
        <input type="email" name="email" id ="Username"placeholder="Introduceti numele de utilizator" required>    
        <br><br>    
        <label>
            <b>Password</b>    
        </label>    
        <input type="password" name="password" id="Password" placeholder="Introduceti parola" required>    
        <br><br>    
        <button type="submit" name="log" id="log">Conecteaza-te</button>  
        <br><br>    
        <input type="checkbox" id="check">    
        <span>Tine minte contul</span>    
        <br><br>    
        Am uitat <a href="#">parola</a>   
        <br><br>
        <span class ="register">Nu ai un cont facut? <a href="register.html"> Inscrie-te</a></span>
    </form>     
</div>
<footer class="footer">
    <div class="titleH" href="mainpage.html">CleanAll</div>
    <ul class="menubar">
        <li class="item">Despre</li>
        <li class="item"><a href="contact.html">Contact</a></li>
        <li class="item">Cum functioneaza</li>
    </ul>
</footer>    
</body>    
</html>     
