<?php
require "../auth/verificar_login.php";
include "../config/conexao.php";

// Pega os dados enviados pelo formulário
$nome  = $_POST['nome'];
$versao = $_POST['versao'];

$sql  = "INSERT INTO musicas (nome, versao) VALUES (?, ?)";
$stmt = $pdo->prepare($sql);
$stmt->execute([$nome, $versao]);

header("Location: ../musicas.php?musica=registrada");
exit;