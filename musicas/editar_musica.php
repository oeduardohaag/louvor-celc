<?php
include "../config/conexao.php";

$id = $_GET['id'];

// Busca apenas o membro com esse ID
$sql  = "SELECT * FROM musicas WHERE id = ?";
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
            <a href="../membros.php">Membros</a>
            <a href="../musicas.php" class="active">Músicas</a>
        </div>
        <div class="nav-actions">
            <a href="../musicas.php" class="btn btn-secondary">Voltar</a>
            <a href="../logout.php" class="btn btn-danger-outline">Sair</a>
        </div>
    </nav>

    <main class="container" style="padding: 32px 20px; max-width: 650px; margin: 0 auto;">
        <div class="page-header" style="margin-bottom: 24px;">
            <h2 style="font-size: 1.5rem; color: var(--text-main);">Editar Música</h2>
            <p style="color: var(--text-muted); font-size: 0.9rem;">Atualize o nome e versão de uma música</p>
        </div>

        <form action="atualizar_musica.php" method="POST" enctype="multipart/form-data" class="form-container" style="background-color: var(--surface); border: 1px solid var(--border); border-radius: 8px; padding: 24px;">

            <input type="hidden" name="id" value="<?= $musica['id'] ?>">

            <div class="form-group" style="margin-bottom: 1.25rem;">
                <label for="nome" style="display: block; font-size: 0.85rem; color: var(--text-muted); margin-bottom: 6px; font-weight: 500;">Nome Completo *</label>
                <input type="text" id="nome" name="nome" value="<?= htmlspecialchars($musica['nome']) ?>" placeholder="Ex: É Ele" required style="width: 100%; background-color: var(--bg-main); border: 1px solid var(--border); border-radius: 6px; color: var(--text-main); padding: 10px 14px; font-size: 0.9rem; outline: none;">
            </div>

            <div class="form-group" style="margin-bottom: 1.25rem;">
                <label for="email" style="display: block; font-size: 0.85rem; color: var(--text-muted); margin-bottom: 6px; font-weight: 500;">E-mail *</label>
                <input type="email" id="email" name="email" value="<?= htmlspecialchars($musica['versao']) ?>" placeholder="exemplo@email.com" required style="width: 100%; background-color: var(--bg-main); border: 1px solid var(--border); border-radius: 6px; color: var(--text-main); padding: 10px 14px; font-size: 0.9rem; outline: none;">
            </div>

            </div>

            <div class="form-actions" style="margin-top: 30px; display: flex; gap: 12px; border-top: 1px solid var(--border); padding-top: 20px;">
                <button type="submit" class="btn btn-primary" style="background-color: var(--primary-gold); color: #000; padding: 10px 20px; border-radius: 6px; font-weight: 600; border: none; cursor: pointer;">Salvar Alterações</button>
                <a href="../musicas.php" class="btn btn-secondary" style="padding: 10px 20px; border-radius: 6px; text-decoration: none; display: inline-flex; align-items: center; justify-content: center; color: var(--text-main);">Cancelar</a>
            </div>

        </form>
    </main>

</body>

</html>