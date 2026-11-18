<?php
// session_start();
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
    } elseif (strlen($funcao) < 6) {
        $erro = "A função deve ter pelo menos 6 caracteres.";
    } else {
        // e-mail já cadastrado?
        $stmt = $pdo->prepare("SELECT id FROM membros WHERE email = ?");
        $stmt->execute([$email]);

        if ($stmt->fetch()) {
            $erro = "Este e-mail já está cadastrado.";
        } else {
            $hash = password_hash($senha, PASSWORD_DEFAULT);

            $stmt = $pdo->prepare(
                "INSERT INTO membros (nome, email, senha, função) VALUES (?, ?, ?, ?)"
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
        </div>
        <div class="nav-actions">
            <a href="../membros.php" class="btn btn-secondary">Voltar</a>
            <a href="../login.php" class="btn btn-danger-outline">Sair</a>
        </div>
    </nav>

    <main class="container" style="padding: 32px 20px; max-width: 650px; margin: 0 auto;">
        <div class="page-header" style="margin-bottom: 24px;">
            <h2 style="font-size: 1.5rem; color: var(--text-main);">Cadastrar Novo Membro</h2>
            <p style="color: var(--text-muted); font-size: 0.9rem;">
                Insira os dados do integrante, senha e defina sua função no ministério
            </p>
        </div>

        <?php if ($erro): ?>
            <div>
                <?= htmlspecialchars($erro) ?>
            </div>
        <?php endif; ?>

        <form method="POST" class="form-container"
            style="background-color: var(--surface); border: 1px solid var(--border); border-radius: 8px; padding: 24px;">

            <div class="form-group" style="margin-bottom: 1rem;">
                <label
                    style="display: block; font-size: 0.85rem; color: var(--text-muted); margin-bottom: 6px; font-weight: 500;">Nome
                    Completo *</label>
                <input type="text" id="nome" name="nome" value="<?= htmlspecialchars($nome) ?>" placeholder="Ex: João Silva" required
                    style="width: 100%; background-color: var(--bg-main); border: 1px solid var(--border); border-radius: 6px; color: var(--text-main); padding: 10px 14px; font-size: 0.9rem; outline: none;">
            </div>

            <div class="form-group" style="margin-bottom: 1rem;">
                <label
                    style="display: block; font-size: 0.85rem; color: var(--text-muted); margin-bottom: 6px; font-weight: 500;">E-mail
                    *</label>
                <input type="email" id="email" name="email" value="<?= htmlspecialchars($email) ?>" placeholder="exemplo@email.com" required
                    style="width: 100%; background-color: var(--bg-main); border: 1px solid var(--border); border-radius: 6px; color: var(--text-main); padding: 10px 14px; font-size: 0.9rem; outline: none;">
            </div>

            <div class="form-group" style="margin-bottom: 1rem;">
                <label
                    style="display: block; font-size: 0.85rem; color: var(--text-muted); margin-bottom: 6px; font-weight: 500;">Senha
                    *</label>
                <input type="password" id="senha" name="senha" placeholder="••••••••" required
                    style="width: 100%; background-color: var(--bg-main); border: 1px solid var(--border); border-radius: 6px; color: var(--text-main); padding: 10px 14px; font-size: 0.9rem; outline: none;">
            </div>

            <div class="form-group" style="margin-bottom: 1rem;">
                <label
                    style="display: block; font-size: 0.85rem; color: var(--text-muted); margin-bottom: 6px; font-weight: 500;">Confirmar senha
                    *</label>
                <input type="password" name="confirmar" minlength="6"
                    placeholder="••••••••" required style="width: 100%; background-color: var(--bg-main); border: 1px solid var(--border); border-radius: 6px; color: var(--text-main); padding: 10px 14px; font-size: 0.9rem; outline: none;">
            </div>

            <div class="form-group" style="margin-bottom: 1rem;">
                <label for="instrumento"
                    style="display: block; font-size: 0.85rem; color: var(--text-muted); margin-bottom: 6px; font-weight: 500;">Função
                    / Instrumento Principal *</label>
                <input type="text" id="funcao" name="funcao" value="<?= htmlspecialchars($funcao) ?>" placeholder="Baixista" required
                    style="width: 100%; background-color: var(--bg-main); border: 1px solid var(--border); border-radius: 6px; color: var(--text-main); padding: 10px 14px; font-size: 0.9rem; outline: none;">
            </div>

            <div class="form-actions"
                style="margin-top: 30px; display: flex; gap: 12px; border-top: 1px solid var(--border); padding-top: 20px;">
                <button type="submit" class="btn btn-primary"
                    style="background-color: var(--primary-gold); color: #000; padding: 10px 20px; border-radius: 6px; font-weight: 600; border: none; cursor: pointer;">Cadastrar
                    Membro</button>
                <a href="../membros.php" class="btn btn-secondary"
                    style="padding: 10px 20px; border-radius: 6px; text-decoration: none; display: inline-flex; align-items: center; justify-content: center; color: var(--text-main);">Cancelar</a>
            </div>

        </form>
    </main>
</body>

</html>