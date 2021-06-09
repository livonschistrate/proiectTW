<?php


$host = '127.0.0.1';
$db   = 'proiecttw';
$user = 'root';
$pass = 'mysql1234';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
try {
    $db = new PDO($dsn, $user, $pass, $options);
} catch (Exception $e) {
    echo "<html>
            <head><meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" >
              <title>Problemă internă a sistemului</title>
            </head>
            <body>
              <p align=\"center\"><span style=\"font-family:Tahoma,Verdana,Helvetica,Arial;font-size:13px;\">A apărut o problemă internă a sistemului - ".date("d.m.Y H:i:s")."<br>
              Reîncercaţi conexiunea (prin reîncărcarea paginii).<br>
              În cazul în care problema nu se remediază contactaţi suportul tehnic pentru a semnala această problemă.</span></p>
            </body>
          </html>";
    exit(0);
}
