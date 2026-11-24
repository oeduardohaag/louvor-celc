<?php
require "../auth/verificar_login.php";
include "../config/conexao.php";

$id    = $_POST['id'];
$nome  = $_POST['nome'];
$email = $_POST['email'];
$funcao = $_POST['funcao'];

// WHERE id = ? garante que só atualiza o membro correto
$sql  = "UPDATE membros SET nome = ?, email = ?, funcao = ? WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$nome, $email, $funcao, $id]);

header("Location: ../membros.php?cadastro=atualizado");
exit;
?>