<?php
require "../auth/verificar_login.php";
include "../config/conexao.php";

$id = $_GET['id'];

$sql  = "DELETE FROM cultos WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);

header("Location: ../index.php?sucesso=deletado");
exit;