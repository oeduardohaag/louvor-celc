<?php
include "../config/conexao.php";

$id    = $_POST['id'];
$nome  = $_POST['nome'];
$email = $_POST['email'];
$funcao = $_POST['funcao'];

// WHERE id = ? garante que só atualiza o aluno certo
$sql  = "UPDATE membros SET nome = ?, email = ?, função = ? WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$nome, $email, $funcao, $id]);

header("Location: ../membros.php");
exit;
?>