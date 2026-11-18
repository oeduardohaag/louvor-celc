<?php
// require "verificar_login.php";
include "config/conexao.php";

$sql = "SELECT * FROM musicas ORDER BY id DESC";
$musicas = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);

$msg = $_GET['msg'] ?? '';
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Repertório de músicas - Louvor CELC</title>
    <link rel="stylesheet" href="css/variables.css">
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/membros.css">
</head>

<body>

    <nav class="navbar">
        <div class="nav-brand">
            <a href="index.php">Louvor <strong>CELC</strong></a>
        </div>
        <div class="nav-links">
            <a href="index.php">Cultos</a>
            <a href="membros.php" class=>Membros</a>
            <a href="musicas.php" class="active">Músicas</a>
        </div>
        <div class="nav-actions">
            <a href="login.php" class="btn btn-danger-outline">Sair da Conta</a>
        </div>
    </nav>

    <main class="container" style="padding: 32px 20px; max-width: 1200px; margin: 0 auto;">

        <div class="page-header"
            style="margin-bottom: 24px; display: flex; justify-content: space-between; align-items: center;">
            <div>
                <h2 style="font-size: 1.5rem; color: var(--text-main);">Gerenciamento de Músicas</h2>
                <p style="color: var(--text-muted); font-size: 0.9rem;">Lista de Nome das músicas e versão</p>
            </div>
            <a href="musicas/nova_musica.php" class="btn"
                style="background-color: var(--primary-gold); color: #000; padding: 10px 16px; border-radius: 6px; text-decoration: none; font-weight: 600; font-size: 0.9rem;">Registrar Música</a>
        </div>

        <?php if ($msg === 'criado'): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                ✅ Música registrada com sucesso!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
            </div>
        <?php endif; ?>

        <div class="table-container">
            <table class="styled-table">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Versão</th>
                        <th style="text-align: right; width: 150px;">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($musicas as $musica): ?>
                        <tr>
                            <td>
                                <strong><?= htmlspecialchars($musica['nome'])  ?></strong>
                            </td>
                            <td><?= htmlspecialchars($musica['versao'])  ?></td>
                            <td style="text-align: right;">
                                <a href="membros/editar_musica.php?id=<?= $musica['id'] ?>" class="btn-card-action btn-editar"
                                    style="padding: 6px 12px; margin-bottom: 4px; display: inline-block;">Editar</a>
                                <a href="membros/excluir_musica.php?id=<?= $musica['id'] ?>" class="btn-card-action btn-excluir"
                                    onclick="return confirm('Deseja realmente excluir essa musica?');"
                                    style="padding: 6px 12px; display: inline-block;">Excluir</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>
        </div>

    </main>

</body>

</html>