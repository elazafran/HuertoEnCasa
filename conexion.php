<?php
//$username = "elazafran";
$username = "dbo769650442";
//$password = "piramide";
$password = "Pa56word";
//$hostname = "localhost";
$hostname = "db769650442.hosting-data.io";
//$dbname = "huertoencasa";
$dbname = "db769650442";

$mysqli = new mysqli($hostname, $username, $password, $dbname);
$mysqli->set_charset("utf8");
/* verificar la conexión */
if (mysqli_connect_errno()) {
    printf("Falló la conexión failed: %s\n", $mysqli->connect_error);
    exit();
}