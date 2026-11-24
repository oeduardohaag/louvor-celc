<?php
require "../auth/verificar_login.php";
require '../config/conexao.php';

$erro   = null;
$nome   = '';
$email  = '';
$funcao = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome      = trim($_POST['nome'] ?? '');
    $email     = trim($_POST['email'] ?? '');
    $senha     = $_POST['senha'] ?? '';
    $confirmar = $_POST['confirmar'] ?? '';
    $funcao    = trim($_POST['funcao'] ?? '');

    if ($nome === '' || $email === '' || $senha === '' || $funcao === '') {
        $erro = "Preencha todos os campos.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erro = "E-mail inválido.";
    } elseif (strlen($senha) < 6) {
        $erro = "A senha deve ter pelo menos 6 caracteres.";
    } elseif ($senha !== $confirmar) {
        $erro = "As senhas não conferem.";
    } else {
        $stmt = $pdo->prepare("SELECT id FROM membros WHERE email = ?");
        $stmt->execute([$email]);

        if ($stmt->fetch()) {
            $erro = "Este e-mail já está cadastrado.";
        } else {
            $hash = password_hash($senha, PASSWORD_DEFAULT);

            $stmt = $pdo->prepare(
                "INSERT INTO membros (nome, email, senha, funcao) VALUES (?, ?, ?, ?)"
            );
            $stmt->execute([$nome, $email, $hash, $funcao]);

            header("Location: ../membros.php?cadastro=ok");
            exit;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Membro - Louvor CELC</title>
    <link rel="stylesheet" href="../css/variables.css">
    <link rel="stylesheet" href="../css/navbar.css">
    <link rel="stylesheet" href="../css/membros.css">
    <script src="../js/membros.js" defer></script>
</head>

<body>

    <nav class="navbar">
        <div class="nav-brand">
            <a href="../index.php">Louvor <strong>CELC</strong></a>
        </div>
        <div class="nav-links">
            <a href="../index.php">Cultos</a>
            <a href="../membros.php" class="active">Membros</a>
            <a href="../musicas.php">Músicas</a>
        </div>
        <div class="nav-actions">
            <a href="../membros.php" class="btn btn-secondary">Voltar</a>
            <a href="../auth/logout.php" class="btn btn-danger-outline">Sair da Conta</a>
        </div>
    </nav>

    <main class="membros-form-container">
        <div class="page-header">
            <div>
                <h2 class="page-title">Cadastrar Novo Membro</h2>
                <p class="page-subtitle">Insira os dados do integrante, senha e defina sua função no ministério</p>
            </div>
        </div>

        <?php if ($erro): ?>
            <div class="alert alert-danger">
                <?= htmlspecialchars($erro) ?>
            </div>
        <?php endif; ?>

        <form method="POST" class="form-card">

            <div class="form-group">
                <label class="form-label" for="nome">Nome Completo *</label>
                <input class="form-input" type="text" id="nome" name="nome" value="<?= htmlspecialchars($nome) ?>"
                    placeholder="Ex: João Silva" required>
            </div>

            <div class="form-group">
                <label class="form-label" for="email">E-mail *</label>
                <input class="form-input" type="email" id="email" name="email" value="<?= htmlspecialchars($email) ?>"
                    placeholder="exemplo@email.com" required>
            </div>

            <div class="form-group">
                <label class="form-label" for="senha">Senha *</label>
                <input class="form-input" type="password" id="senha" name="senha" placeholder="••••••••" minlength="6" required>
            </div>

            <div class="form-group">
                <label class="form-label" for="confirmar">Confirmar senha *</label>
                <input class="form-input" type="password" id="confirmar" name="confirmar" minlength="6"
                    placeholder="••••••••" required>
            </div>

            <div class="form-group">
                <label class="form-label" for="funcao">Função / Instrumento Principal *</label>
                <select class="form-select" id="funcao" name="funcao" required>
                    <option value="">Selecione uma função</option>
                    <option value="Vocal" <?= $funcao === 'Vocal' ? 'selected' : '' ?>>Vocal</option>
                    <option value="Violão" <?= $funcao === 'Violão' ? 'selected' : '' ?>>Violão</option>
                    <option value="Guitarra" <?= $funcao === 'Guitarra' ? 'selected' : '' ?>>Guitarra</option>
                    <option value="Teclado" <?= $funcao === 'Teclado' ? 'selected' : '' ?>>Teclado</option>
                    <option value="Baixo" <?= $funcao === 'Baixo' ? 'selected' : '' ?>>Baixo</option>
                    <option value="Bateria" <?= $funcao === 'Bateria' ? 'selected' : '' ?>>Bateria</option>
                </select>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary-gold">Cadastrar Membro</button>
                <a href="../membros.php" class="btn btn-cancel">Cancelar</a>
            </div>

        </form>
    </main>
</body>

</html>