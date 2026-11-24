<?php
require "auth/verificar_login.php";
include "config/conexao.php";

$sql = "SELECT * FROM membros ORDER BY id DESC";
$membros = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);

$cadastro = $_GET['cadastro'] ?? ($_GET['msg'] ?? '');
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
            <a href="musicas.php">Músicas</a>
        </div>
        <div class="nav-actions">
            <a href="auth/logout.php" class="btn btn-danger-outline">Sair da Conta</a>
        </div>
    </nav>

    <main class="membros-container">

        <div class="page-header">
            <div>
                <h2 class="page-title">Gestão de Membros</h2>
                <p class="page-subtitle">Lista de integrantes do ministério, funções e instrumentos</p>
            </div>
            <a href="membros/novo_membro.php" class="btn btn-primary-gold">+ Cadastrar Membro</a>
        </div>

        <?php if ($cadastro === 'ok' || $cadastro === 'criado'): ?>
            <div class="alert alert-registered" role="alert">
                Membro cadastrado com sucesso!
            </div>
        <?php elseif ($cadastro === 'atualizado'): ?>
            <div class="alert alert-updated" role="alert">
                Dados do membro atualizados com sucesso!
            </div>
        <?php elseif ($cadastro === 'removido'): ?>
            <div class="alert alert-deleted" role="alert">
                Membro removido com sucesso!
            </div>
        <?php endif; ?>

        <div class="table-container">
            <table class="styled-table">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Função / Instrumento</th>
                        <th class="col-actions-header">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($membros)): ?>
                        <tr>
                            <td colspan="4" class="page-subtitle">Nenhum membro cadastrado ainda.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($membros as $membro): ?>
                            <tr>
                                <td>
                                    <strong><?= htmlspecialchars($membro['nome']) ?></strong>
                                </td>
                                <td><?= htmlspecialchars($membro['email']) ?></td>
                                <td>
                                    <span class="badge-instrumento"><?= htmlspecialchars($membro['funcao']) ?></span>
                                </td>
                                <td class="col-actions">
                                    <div class="table-actions-group">
                                        <a href="membros/editar_membro.php?id=<?= $membro['id'] ?>"
                                            class="btn-card-action btn-editar">Editar</a>
                                        <a href="membros/excluir_membro.php?id=<?= $membro['id'] ?>"
                                            class="btn-card-action btn-excluir"
                                            onclick="return confirm('Deseja realmente excluir este membro?');">Excluir</a>
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