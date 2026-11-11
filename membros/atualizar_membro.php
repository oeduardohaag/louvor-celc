<?php
include "conexao.php";

$id    = $_POST['id'];
$nome  = $_POST['nome'];
$email = $_POST['email'];
$senha = $_POST['senha'];
$funcao = $_POST['funcao'];

// WHERE id = ? garante que só atualiza o aluno certo
$sql  = "UPDATE membros SET nome = ?, email = ?, senha = ?, funcao = ? WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$nome, $email, $senha, $funcao, $id]);

header("Location: index.php");
exit;
?>