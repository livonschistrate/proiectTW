<?php

?>


<div class="container">
    <div class="background"></div>
    <header class="header">
        <div class="title" href="#" onclick="go_to_dashboard();">CleanAll</div>
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

                    }
                ?>

                <a class="item" href="#" onclick="do_logout();">Logout</a>
            </nav>
        </div>
    </header>
</div>
