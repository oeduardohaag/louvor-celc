<?php
require "../auth/verificar_login.php";
include "../config/conexao.php";

$id = $_GET['id'];

$sql  = "DELETE FROM musicas WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);

header("Location: ../musicas?musica=deletada");
?>