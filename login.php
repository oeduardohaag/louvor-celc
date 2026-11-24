<?php
session_start();
require 'config/conexao.php';

$erro = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $senha = $_POST['senha'] ?? '';

    $stmt = $pdo->prepare("SELECT * FROM membros WHERE email = ?");
    $stmt->execute([$email]);
    $usuario = $stmt->fetch();

    if ($usuario && password_verify($senha, $usuario['senha'])) {
        $_SESSION['usuario_id']   = $usuario['id'];
        $_SESSION['usuario_nome'] = $usuario['nome'];

        header("Location: index.php");
        exit;
    } else {
        $erro = "E-mail ou senha inválidos.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Louvor CELC</title>
    <link rel="stylesheet" href="css/variables.css">
    <link rel="stylesheet" href="css/login.css">
</head>

<body class="login-page">
    <main class="login-container">
        <section class="login-card">
            <header class="login-header">
                <h2 class="login-title">Louvor <strong>CELC</strong></h2>
                <p class="login-subtitle">Faça login para entrar na gestão do ministério</p>
            </header>

            <form class="login-form" method="POST">
                <div class="form-group">
                    <label class="form-label" for="email">E-mail</label>
                    <input class="form-input" type="email" id="email" name="email" placeholder="Digite seu e-mail" required>
                </div>

                <div class="form-group">
                    <label class="form-label" for="senha">Senha</label>
                    <input class="form-input" type="password" id="senha" name="senha" placeholder="••••••••" required>
                </div>

                <?php if ($erro): ?>
                    <div class="alert alert-danger">
                        <?= htmlspecialchars($erro) ?>
                    </div>
                <?php endif; ?>

                <button type="submit" class="btn btn-primary login-submit">Entrar</button>
            </form>
        </section>
    </main>
</body>

</html>