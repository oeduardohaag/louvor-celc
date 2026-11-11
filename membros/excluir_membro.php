<?php
include "../config/conexao.php";

$id = $_GET['id'];

$sql  = "DELETE FROM membros WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);

header("Location: membros.php");
exit;
?>