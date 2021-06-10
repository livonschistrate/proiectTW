<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Services</title>
    <link rel="stylesheet" href="css/mainstyle.css">
    <link rel="stylesheet" href="services.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Raleway:wght@500&family=Source+Sans+Pro:wght@600&display=swap" rel="stylesheet">
    <script src="scripts/mainbutton.js"></script>
</head>
<body>
    <div class="container">
        <div class="background"></div>
        <header class="header">
            <div class="title" href="index.php">CleanAll</div>
        <div class="menu" onclick="showMenu()">
            <div class="menubutton">
                <button class="options">
                    <div class="bar"></div>
                    <div class="bar"></div>
                    <div class="bar"></div>
                </button>
            </div>
        <nav id="menubar" class="display-off">
            <a class="item" href="contact.php">Contact</a>
            <a class="item" href="services.php">Servicii</a>
            <a class="item" href="login.php">Log-in</a>
            <a class="item" href="register.php">Înregistrare</a>
        </nav>
        </div>
        </header>
    </div>

    <div class="howitworks">
        <div class="wsquare">
            <p class="hitwtext"> CUM FUNCTIONEAZA? </p>
            <br>
            <div class="steps">
                <div class="step1">
                        <button class="s-text accord" onclick="toggleA(this);" id="ac-button" type="radio">Inspectie detaliata</button>
                    <div id="accordpanel">
                        <p class="step-detail"> Buzunarele si hainele sunt verificate astfel incat sa
                        nu aiba nimic inauntru inainte de a fi puse la spalat.
                        </p>
                        
                    </div>
                </div>

                <div class="step2">
                    <button class="s-text accord" onclick="toggleA(this);" id="ac-button" type="radio">Curatare premium</button>
                    <div id="accordpanel">
                        <p class="step-detail">Hainele deschise la culoare sunt separate de cele inchise
                        si sunt spalate folosind apa rece pentru a pastra culoarea (si a salva energie).
                        </p>
                    </div>
                </div>

                <div class="step3">
                    <button class="s-text accord" onclick="toggleA(this);" id="ac-button" type="radio">Preferintele tale</button>
                    <div id="accordpanel">
                        <p class="step-detail">Ai nevoie de detergent hipoalergenic? Vrei balsam de rufe?
                        Nicio problema - trebuie doar sa-ti selectezi preferintele.
                        </p>
                    </div>
                </div>

                <div class="step4">
                    <button class="s-text accord" onclick="toggleA(this);" id="ac-button" type="radio" style="border-radius: 10px;">Ingrijit si pliat</button>
                    <div id="accordpanel">
                        <p class="step-detail">Ai nevoie de detergent hipoalergenic? Vrei balsam de rufe?
                        Nicio problema - trebuie doar sa-ti selectezi preferintele.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="pricebox">
        <div class="wsquare">
            <p class="priceboxtitle"> PRETURI </p>
            <br>
            <a href="subscription.php" class="priceboxtitle pbtlink"> Vezi abonamentele aici </a>
        </div>
    </div>

    <footer class="footer">
        <div class="title" href="index.php">CleanAll</div>
        <ul id="menubar">
            <li class="item" href="contact.php">Contact</li>
            <li class="item" href="services.php">Cum functioneaza</li>
        </ul>
    </footer>
    <script src="scripts/accordion.js"></script>
    <script src="scripts/mainbutton.js"></script>
</body>
</html>