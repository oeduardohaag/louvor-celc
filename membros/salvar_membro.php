<?php
require 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome   = $_POST['nome'];
    $email  = $_POST['email'];
    $hash   = password_hash($_POST['senha'], PASSWORD_DEFAULT);
    $funcao = $_POST['funcao'];

    $stmt = $pdo->prepare(
        "INSERT INTO membros (nome, email, senha, função) VALUES (?, ?, ?, ?)"
    );
    $stmt->execute([$nome, $email, $hash, $funcao]);

    header("Location: membros.php");
    exit;
}
?>
