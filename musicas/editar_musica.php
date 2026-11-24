<?php
require "../auth/verificar_login.php";
include "../config/conexao.php";

$id = $_GET['id'];

// Busca apenas o membro com esse ID
$sql = "SELECT * FROM musicas WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);
$musica = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Música - Louvor CELC</title>
    <link rel="stylesheet" href="../css/variables.css">
    <link rel="stylesheet" href="../css/navbar.css">
    <link rel="stylesheet" href="../css/musicas.css">
</head>

<body>

    <nav class="navbar">
        <div class="nav-brand">
            <a href="../index.php">Louvor <strong>CELC</strong></a>
        </div>
        <div class="nav-links">
            <a href="../index.php">Cultos</a>
            <a href="../membros.php">Membros</a>
            <a href="../musicas.php" class="active">Músicas</a>
        </div>
        <div class="nav-actions">
            <a href="../musicas.php" class="btn btn-secondary">Voltar</a>
            <a href="../auth/logout.php" class="btn btn-danger-outline">Sair da Conta</a>
        </div>
    </nav>

    <main class="musicas-form-container">
        <div class="page-header">
            <div>
                <h2 class="page-title">Editar Música</h2>
                <p class="page-subtitle">Atualize o nome e a versão de uma música</p>
            </div>
        </div>

        <form action="atualizar_musica.php" method="POST" class="form-card">

            <input type="hidden" name="id" value="<?= $musica['id'] ?>">

            <div class="form-group">
                <label class="form-label" for="nome">Nome da Música *</label>
                <input class="form-input" type="text" id="nome" name="nome"
                    value="<?= htmlspecialchars($musica['nome']) ?>" placeholder="Ex: É Ele" required>
            </div>

            <div class="form-group">
                <label class="form-label" for="versao">Versão *</label>
                <input class="form-input" type="text" id="versao" name="versao"
                    value="<?= htmlspecialchars($musica['versao']) ?>" placeholder="Ex: Drops INA" required>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary-gold">Salvar Alterações</button>
                <a href="../musicas.php" class="btn-cancel">Cancelar</a>
            </div>

        </form>
    </main>

</body>

</html>