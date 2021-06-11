<?php
include "../include/auth.php";
include "../include/config.php";
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
    <script src="../js/lib.js"></script>
</head>
<body>

<?php include "../include/navigation.php" ?>

<div class="main-content">
    <div id="content-info" class="content-info">
        <div>
            <?php echo $_SESSION['name']; ?>, bine ați venit la curățătoria noastră!
            <div class="req-list">
                <?php
                if ($_SESSION['level']=='1') { // este un utilizator normal / client conectat

                    $sql = "SELECT
                                IFNULL(t1.cate, 0) AS cate,
                                s1.name AS name,
                                s1.name_sg AS name_sg,
                                s1.name_pl AS name_pl
                            FROM
                                (SELECT
                                    COUNT(*) AS cate,
                                    r.id_state AS id_state
                                FROM
                                    requests AS r
                                WHERE r.id_user = ".$_SESSION['id_user']."
                                GROUP BY r.id_state) AS t1
                                RIGHT JOIN states AS s1
                                    ON t1.id_state = s1.id_state;";
                    $cereri = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);

                    for($i=0; $i<count($cereri); $i++) {
                        echo '<div>Cereri '.($cereri[$i]['cate']==1 ? $cereri[$i]['name_sg']: $cereri[$i]['name_pl']).': '.$cereri[$i]['cate'].'</div>';
                    }
                } else { // operator sau admin
                    echo '<div style="margin-bottom:1em;border-bottom: solid 1px #b0b0b0;">Situație comenzi în sistem:</div>';
                    $sql = "SELECT
                                    IFNULL(t1.cate, 0) AS cate,
                                    s1.name AS name,
                                    s1.name_sg AS name_sg,
                                    s1.name_pl AS name_pl
                                FROM
                                    (SELECT
                                        COUNT(*) AS cate,
                                        r.id_state AS id_state
                                    FROM
                                        requests AS r                                
                                    GROUP BY r.id_state) AS t1
                                    RIGHT JOIN states AS s1
                                        ON t1.id_state = s1.id_state;";
                    $cereri = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);

                    for ($i = 0; $i < count($cereri); $i++) {
                        echo '<div>Cereri ' . ($cereri[$i]['cate'] == 1 ? $cereri[$i]['name_sg'] : $cereri[$i]['name_pl']) . ': ' . $cereri[$i]['cate'] . '</div>';

                    }
                }
                ?>
            </div>
        </div>
    </div>

</div>

</body>
</html>
