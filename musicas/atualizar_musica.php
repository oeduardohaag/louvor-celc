<?php
require "../auth/verificar_login.php";
include "../config/conexao.php";

$id    = $_POST['id'];
$nome  = $_POST['nome'];
$versao = $_POST['versao'];

$sql  = "UPDATE musicas SET nome = ?, versao = ? WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$nome, $versao, $id]);

header("Location: ../musicas.php?musica=atualizada");
exit;
?>