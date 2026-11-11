<?php
$host    = "localhost";
$banco   = "louvor_celc";
$usuario = "root";
$senha   = "";

$pdo = new PDO(
    "mysql:host=$host;dbname=$banco;charset=utf8",
    $usuario,
    $senha
);

$pdo->setAttribute(
    PDO::ATTR_ERRMODE,
    PDO::ERRMODE_EXCEPTION
);
?>