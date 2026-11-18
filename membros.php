<?php
include "config/conexao.php";

$sql = "SELECT * FROM membros ORDER BY id DESC";
$membros = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);

$msg = $_GET['msg'] ?? '';
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestão de Membros - Louvor CELC</title>
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
            <a href="membros.php" class="active">Membros</a>
        </div>
        <div class="nav-actions">
            <a href="login.php" class="btn btn-danger-outline">Sair da Conta</a>
        </div>
    </nav>

    <main class="container" style="padding: 32px 20px; max-width: 1200px; margin: 0 auto;">

        <div class="page-header"
            style="margin-bottom: 24px; display: flex; justify-content: space-between; align-items: center;">
            <div>
                <h2 style="font-size: 1.5rem; color: var(--text-main);">Gestão de Membros</h2>
                <p style="color: var(--text-muted); font-size: 0.9rem;">Lista de integrantes do ministério, funções e
                    instrumentos</p>
            </div>
            <a href="membros/novo_membro.php" class="btn"
                style="background-color: var(--primary-gold); color: #000; padding: 10px 16px; border-radius: 6px; text-decoration: none; font-weight: 600; font-size: 0.9rem;">Cadastrar
                Membro</a>
        </div>

        <?php if ($msg === 'criado'): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                ✅ Membro cadastrado com sucesso!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
            </div>
        <?php endif; ?>

        <div class="table-container">
            <table class="styled-table">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Função / Instrumento</th>
                        <th style="text-align: right; width: 150px;">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($membros as $membro): ?>
                        <tr>
                            <td>
                                <strong><?= htmlspecialchars($membro['nome'])  ?></strong>
                            </td>
                            <td><?= htmlspecialchars($membro['email'])  ?></td>
                            <td>
                                <span class="badge-instrumento"><?= htmlspecialchars($membro['função'])  ?></span>
                            </td>
                            <td style="text-align: right;">
                                <a href="membros/editar_membro.php?id=<?= $membro['id'] ?>" class="btn-card-action btn-editar"
                                    style="padding: 6px 12px; margin-bottom: 4px; display: inline-block;">Editar</a>
                                <a href="membros/excluir_membro.php?id=<?= $membro['id'] ?>" class="btn-card-action btn-excluir"
                                    onclick="return confirm('Deseja realmente excluir este membro?');"
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