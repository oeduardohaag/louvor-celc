<?php
include "conexao.php";

$id = $_GET['id'];

$sql  = "DELETE FROM membros WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$id]);

header("Location: membros.php");
exit;
?>