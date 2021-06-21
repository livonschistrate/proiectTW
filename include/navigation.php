<?php

?>


<div class="container">
    <div class="background"></div>
    <header class="header">
        <div class="h-title" href="#" onclick="go_to_dashboard();">CleanAll<br><div class="role-title">
                <?php
                if ($_SESSION['level']<=1) {
                    echo 'Client';
                } elseif ($_SESSION['level']<=5) {
                    echo 'Operator';
                } else {
                    echo 'Administrator';
                }
                ?>
            </div></div>
        <div class="menu" onclick="showMenu()">
            <div class="menubutton">
                <button class="options">
                    <div class="bar"></div>
                    <div class="bar"></div>
                    <div class="bar"></div>
                </button>
            </div>
            <nav  id="menubar" class="display-off">
                <?php
                    if ($_SESSION['level']<=1) {
                        echo '<a class="item" href="#" onclick="go_to_comenzi();">Comenzi</a>';
                    } elseif ($_SESSION['level']<=5) {
                        echo '<a class="item" href="#" onclick="go_to_comenzi_operator();">Comenzi</a>';
                    } else {
                        echo '<a class="item" href="#" onclick="go_to_edit_utilizatori();">Utilizatori</a>';
                        echo '<a class="item" href="#" onclick="go_to_edit_tipuri_articole();">Articole</a>';
                        echo '<a class="item" href="#" onclick="go_to_edit_preturi();">Prețuri</a>';
                    }
                ?>
                <a class="item" href="#" onclick="go_to_setari_utilizator();">Setări</a>
                <a class="item" href="#" onclick="do_logout();">Logout</a>
            </nav>
        </div>
    </header>

</div>
