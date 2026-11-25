<?php
require "auth/verificar_login.php";
include "config/conexao.php";

$sql = "SELECT * FROM musicas ORDER BY id DESC";
$musicas = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);

$msg = $_GET['msg'] ?? ($_GET['musica'] ?? '');
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Repertório de Músicas - Louvor CELC</title>
    <link rel="stylesheet" href="css/variables.css">
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/musicas.css">
</head>

<body>

    <nav class="navbar">
        <div class="nav-brand">
            <a href="index.php">Louvor <strong>CELC</strong></a>
        </div>
        <div class="nav-links">
            <a href="index.php">Cultos</a>
            <a href="membros.php">Membros</a>
            <a href="musicas.php" class="active">Músicas</a>
        </div>
        <div class="nav-actions">
            <a href="auth/logout.php" class="btn btn-danger-outline">Sair da Conta</a>
        </div>
    </nav>

    <main class="musicas-container">

        <div class="page-header">
            <div>
                <h2 class="page-title">Repertório de Músicas</h2>
                <p class="page-subtitle">Lista com nomes das músicas e versões que tocamos durante os cultos</p>
            </div>
            <a href="musicas/nova_musica.php" class="btn btn-primary-gold">Registrar Nova Música</a>
        </div>

        <?php if ($msg === 'criado' || $msg === 'registrada'): ?>
            <div class="alert alert-registered" role="alert">
                Música registrada com sucesso!
            </div>
        <?php elseif ($msg === 'atualizada'): ?>
            <div class="alert alert-updated" role="alert">
                Música atualizada com sucesso!
            </div>
        <?php elseif ($msg === 'deletada'): ?>
            <div class="alert alert-deleted" role="alert">
                Música removida com sucesso!
            </div>
        <?php endif; ?>

        <div class="table-container">
            <table class="styled-table">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Versão</th>
                        <th class="col-actions-header">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($musicas)): ?>
                        <tr>
                            <td colspan="3" class="page-subtitle">Nenhuma música cadastrada ainda.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($musicas as $musica): ?>
                            <tr>
                                <td>
                                    <strong><?= htmlspecialchars($musica['nome']) ?></strong>
                                </td>
                                <td><?= htmlspecialchars($musica['versao']) ?></td>
                                <td class="col-actions">
                                    <div class="table-actions-group">
                                        <a href="musicas/editar_musica.php?id=<?= $musica['id'] ?>"
                                            class="btn-card-action btn-editar">Editar</a>
                                        <a href="musicas/excluir_musica.php?id=<?= $musica['id'] ?>"
                                            class="btn-card-action btn-excluir"
                                            onclick="return confirm('Deseja realmente excluir essa música?');">Excluir</a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

    </main>

</body>

</html>