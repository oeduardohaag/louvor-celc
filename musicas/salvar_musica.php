<?php
// require "verificar_login.php";

include "../config/conexao.php";

// Pega os dados enviados pelo formulário (POST)
$nome  = $_POST['nome'];
$versao = $_POST['versao'];

$sql  = "INSERT INTO musicas (nome, versao) VALUES (?, ?)";
$stmt = $pdo->prepare($sql);
$stmt->execute([$nome, $versao]);

// Redireciona para a listagem
header("Location: ../musicas.php");
