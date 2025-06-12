<?php
// Exemplo 1 — root SEM senha (XAMPP padrão)
$host = "localhost:3306";
$user = "root";
$pass = "";           
$db   = "dbseg";

$con = mysqli_connect($host, $user, $pass, $db);

if (!$con) {
    die("Falha na conexão: " . mysqli_connect_error());
}
?>
