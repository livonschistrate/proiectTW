<?php
include "../include/auth.php";
include "../include/db_auth.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CleanAll</title>
    <link rel="stylesheet" href="../css/mainstyle.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Raleway:wght@500&family=Source+Sans+Pro:wght@600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../fonts/awesome/css/all.min.css">
    <script src="../js/lib.js"></script>
    <script src="../js/comenzi.js"></script>
    <script src="../scripts/mainbutton.js"></script>

</head>
<body>

<?php include "../include/navigation.php" ?>

<div class="main-content">
    <div class="content">
        <input type="hidden" id="sort_col" value="1">
        <input type="hidden" id="sort_order" value="0">

        <div class="req-header">
            <div class="req-title">Comenzile dvs.</div>
            <i class="fa fa-2x fa-plus-circle add-req" onclick="show_request(0);" title="Adaugă o comandă"></i>
        </div>
        <div class="pagination">
            Pag.
            <select id="crt_page" class="req-select" style="margin-right: 4px;" onchange="reload_data();">
                <option value="1" selected>1</option>
            </select>
            Nr./pag.
            <select id="reqs_per_page" class="req-select" style="margin-right: 4px;" onchange="reload_data();">
                <option value="10">10
                <option value="20">20
                <option value="50">50
                <option value="100">100
            </select>
        </div>

        <div id="reqs" class="reqs">

        </div>
    </div>
</div>

<!--div pentru adaugarea/editarea unei comenzi-->
<div id="request" class="modal">
    <div class="modal-content modal-request">
        <input type="hidden" id="id_request" value="0">
        <div>
            <div class="req-title">Editare comandă</div>
            <i class="fa fa-times close-req" id="close_req" onclick="close_req();"></i>
        </div>
        <div class="req-form">
            <div class="article-row">
                <div class="article-col-1">
                    Nr. comandă:
                </div>
                <div class="article-col-2">
                    <label id="nr_request" class="req-nr">--</label>
                </div>
            </div>
            <div class="article-row">
                <div class="article-col-1">
                    Data preluării:
                </div>
                <div class="article-col-2">
                    <input id="data_start" type="date" class="req-date">
                </div>
            </div>
            <input type="button" value="Salvează" style="float:right;margin-bottom: 1em;" onclick="save_req();">
        </div>
        <div class="req-article-header">
            <div class="req-article-title">Lista articole</div>
            <i class="fa fa-2x fa-plus-circle add-req" onclick="show_article(0);"></i>
        </div>
        <div id="req-articles-list" class="req-article-list">

        </div>
    </div>
</div>

<!--div pentru adaugarea sau editarea unui articol la o comanda-->
<div id="add_article" class="modal-article">
    <input type="hidden" id="id_article" value="0">
    <div class="article">
        <div>
            <div class="req-title">Editare articol</div>
            <i class="fa fa-times close-req" id="close_art" onclick="close_add_art();"></i>
        </div>
        <div class="req-form">
            <div class="article-row">
                <div class="article-col-1">
                    Tip
                </div>
                <div class="article-col-2">
                    <select id="article_type" class="req-select">
                        <?php
                            // se afiseaza lista cu tipurile de articole existente in baza de date
                            $sql = "SELECT * 
                                    FROM article_types 
                                    ORDER BY article_name;";
                            $article_types = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
                            for($i=0;$i<count($article_types);$i++){
                                echo '<option value="'.$article_types[$i]['id_article_type'].'"> '.$article_types[$i]['article_name'];
                            }
                        ?>
                    </select>

                </div>
            </div>
            <div class="article-row">
                <div class="article-col-1">
                    Material
                </div>
                <div class="article-col-2">
                    <select id="material" class="req-select">
                        <?php
                        // se afiseaza lista cu tipurile de materiale existente in baza de date
                        $sql = "SELECT * 
                                    FROM materials 
                                    ORDER BY material_name;";
                        $materials = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
                        for($i=0;$i<count($materials);$i++){
                            echo '<option value="'.$materials[$i]['id_material'].'"> '.$materials[$i]['material_name'];
                        }
                        ?>
                    </select>

                </div>
            </div>
            <div class="article-row">
                <div class="article-col-1">
                    Cantitate
                </div>
                <div class="article-col-2">
                    <select id="quantity" class="req-select">
                        <?php
                        // se afiseaza lista cu numerele pentru cantitate
                        for($i=1;$i<=25;$i++){
                            echo '<option value="'.$i.'"> '.$i;
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="article-row" >
                <input type="button" value="Salvează" style="float:right;" onclick="save_article();">
            </div>

        </div>
    </div>
</div>

<?php include "../include/footer.php" ?>


</body>
</html>
