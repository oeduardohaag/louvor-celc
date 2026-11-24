<?php
require "../auth/verificar_login.php";
include "../config/conexao.php";

$id = $_GET['id'];

// Busca apenas o membro com esse ID
$sql  = "SELECT * FROM membros WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);
$membro = $stmt->fetch(PDO::FETCH_ASSOC);

$funcoesDisponiveis = ['Vocal', 'Violão', 'Guitarra', 'Teclado', 'Baixo', 'Bateria'];
$funcaoAtual = $membro['funcao'] ?? '';
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Membro - Louvor CELC</title>
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
                <h2 class="page-title">Editar Membro</h2>
                <p class="page-subtitle">Atualize as informações ou a função do integrante</p>
            </div>
        </div>

        <form action="atualizar_membro.php" method="POST" class="form-card">

            <input type="hidden" name="id" value="<?= $membro['id'] ?>">

            <div class="form-group">
                <label class="form-label" for="nome">Nome Completo *</label>
                <input class="form-input" type="text" id="nome" name="nome"
                    value="<?= htmlspecialchars($membro['nome']) ?>" placeholder="Ex: João Silva" required>
            </div>

            <div class="form-group">
                <label class="form-label" for="email">E-mail *</label>
                <input class="form-input" type="email" id="email" name="email"
                    value="<?= htmlspecialchars($membro['email']) ?>" placeholder="exemplo@email.com" required>
            </div>

            <div class="form-group">
                <label class="form-label" for="funcao">Função / Instrumento Principal *</label>
                <select class="form-select" id="funcao" name="funcao" required>
                    <option value="">Selecione uma função</option>
                    <?php foreach ($funcoesDisponiveis as $funcao): ?>
                        <option value="<?= $funcao ?>" <?= ($funcaoAtual === $funcao) ? 'selected' : '' ?>><?= $funcao ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary-gold">Salvar Alterações</button>
                <a href="../membros.php" class="btn btn-cancel">Cancelar</a>
            </div>

        </form>
    </main>

</body>

</html>