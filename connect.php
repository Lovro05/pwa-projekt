<?php
$servername = "localhost";
$username = "root";
$password = "";
$basename = "pwa_projekt";

$dbc = mysqli_connect($servername, $username, $password, $basename);

if (!$dbc) {
    die("Greška pri spajanju na bazu: " . mysqli_connect_error());
}

mysqli_set_charset($dbc, "utf8");
?>