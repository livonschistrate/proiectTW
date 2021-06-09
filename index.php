<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CleanAll</title>
    <link rel="stylesheet" href="css/mainstyle.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Raleway:wght@500&family=Source+Sans+Pro:wght@600&display=swap" rel="stylesheet">
    
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
        <nav  id="menubar" class="display-off">
            <a class="item" href="contact.php">Contact</a>
            <a class="item" href="services.php">Servicii</a>
            <a class="item" href="login.php">Log-in</a>
            <a class="item" href="register.php">Înregistrare</a>
        </nav>
        </div>
        </header>
    </div>

     <div class="first-pickup">
        <div class="wsquare">
            <p class="save3hrs">Economisiți 3 ore pe săptămâna cu <b>CleanAll</b>!</p>
            <br></br>
            <div class="intro-text">
                <p class="cleanapp-does">Salut! Eu sunt CleanAll și sunt aici ca să-ți preiau, să curăț și să-ți livrez rufele!</p>
            </div>
            
                <img class="laundry-image" src="images/laundryroom.jpg">
            
            <div class="image-to-button"></div>
            <button class="signup">Programează-ți prima preluare!</button>
        </div>
    </div>

    <div class="our-services">
        <div class="wsquare">
            <p class="service-box">SERVICIILE NOASTRE</p>
            
        <section class="carousel">
            <button type="button" id="leftBtn" class="lr-button"> &lt </button>
            <div class="carousel-service">
                <h1 class="ctext s1">Curatare uscata</h1>
                <br>
                <img src="images/drycleaning.jpg" class="im-1 im-drycleaning">
                <p class="cpar">
                    Curatarea uscata este un proces unde hainele sunt curatate 
                    folosind un solvent chimic. Folosim masina de tip Hydro Carbon, pentru a va
                    procesa hainele delicate! 
                </p>
            </div>

            <div class="carousel-service">
                <h1 class="ctext s2">Curatare de pantofi</h1>
                <br>
                <img src="images/shoes.jpg" class="im-1 im-shoes">
                <p class="cpar">
                    Serviciul de curatare a pantofilor de la CleanAll va transforma pantofii tai murdari
                    intr-un nou look. Ne putem descurca cu toate tipurile de pantofi.
                </p>
            </div>

            <div class="carousel-service">
                <h1 class="ctext s3">Curatare de covoare</h1>
                <br>
                <img src="images/carpetcl.jpg" class="im-1 im-carpet">
                <p class="cpar"> Profesionistii in curatarea covoarelor de la CleanAll sunt echipati
                    cu masinarii de ultima ora pentru a-ti oferi cele mai bune servicii.
                </p>
            </div>

            <div class="carousel-service">
                <h1 class="ctext s4">Spalare, calcare si impachetare</h1>
                <br>
                <img src="images/wdif.jpg" class="im-1 im-wdif">
                <p class="cpar"> Hainele sunt procesate folosind detergenti 100% bio-degradabile. Ideal pentru
                    imbracamintea zilnica.
                </p>
            </div>

            <div class="carousel-service">
                <h1 class="ctext s5">Tesetura</h1>
                <br>
                <img src="images/darning.jpg" class="im-1 im-darning">
                <p class="cpar"> De ce sa renunti la haine deoarece ele sunt rupte? Expertii nostri in
                    tesaturi pot repara daunele si sa le ascunda in asa fel incat sa fie neobservabile.
                </p>
            </div>

            <button type="button" id="rightBtn" class="lr-button"> &gt </button>
        </section>        
        
        </div>
    </div>
    
    <div class="whyus">
        <div class="wsquare">
            <p class="service-box">DE CE NOI?</p>

            <ul class="reasons">
                <li class="reasontext">
                    Noi oferim o gama larga de servicii de prezentare si ingrijire adecvata
                    necesara pentru hainele dumneavoastra. Avem experti si specialisti care se
                    ocupa de imbracaminte in cel mai bun mod.
                </li>
                <li class="reasontext">
                    Ne straduim sa depasim dorintele clientilor oferind servicii excelente care sunt
                    foarte potrivite pentru buzunar. Oferim cele mai bune tarife pentru servicii de
                    curatatorie chimica si spalatorie. Pentru a va ajuta cu economisirea unor sume
                    enorme de bani, va recomandam sa parcurgeti diversele noastre pachete.
                </li>
                <li class="reasontext">
                    Folosim doar substante chimice ecologice de la rufe la curatarea uscata a hainelor
                    pretioase. Produse chimice care nu numai ca sunt delicate pentru imbracaminte si
                    eficiente in curatare, dar, in acelasi timp, nu dauneaza mediului nostru.
                </li>
                <li class="reasontext">
                    Masuram serviciile utilizand un proces de manipulare intern care se potriveste
                    fiecarei conditii prealabile si transport la timp. Folosim masina de hidrocarburi
                    de ultima generatie cu privire la asigurarea utilitatii, eficacitatii si
                    rezonabilitatii masinii.
                </li>
            </ul>
        </div>
    </div>

    <footer class="footer">
        <div class="title" href="index.php">CleanAll</div>
        <ul id="menubar">
            <li class="item" href="contact.php">Contact</li>
            <li class="item" href="services.php">Cum functioneaza</li>
        </ul>
    </footer>
    <script src="scripts/carousel.js"></script>
    <script src="scripts/mainbutton.js"></script>
</body>
</html>