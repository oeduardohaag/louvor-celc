<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestão de Membros - Louvor CELC</title>
    <!-- Importação dos arquivos CSS separados -->
    <link rel="stylesheet" href="css/variables.css">
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/membros.css">
</head>
<body>

    <!-- Barra de Navegação -->
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
        
        <div class="page-header" style="margin-bottom: 24px; display: flex; justify-content: space-between; align-items: center;">
            <div>
                <h2 style="font-size: 1.5rem; color: var(--text-main);">Gestão de Membros</h2>
                <p style="color: var(--text-muted); font-size: 0.9rem;">Lista de integrantes do ministério, funções e instrumentos</p>
            </div>
            <a href="criar_membro.php" class="btn" style="background-color: var(--primary-gold); color: #000; padding: 10px 16px; border-radius: 6px; text-decoration: none; font-weight: 600; font-size: 0.9rem;">Cadastrar Membro</a>
        </div>

        <div class="table-container">
            <table class="styled-table">
                <thead>
                    <tr>
                        <th style="width: 60px; text-align: center;">Foto</th>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Função / Instrumento</th>
                        <th style="text-align: right; width: 150px;">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="text-align: center;">
                            <div class="membro-avatar-container" style="margin: 0 auto;">
                                <img src="uploads/joao.jpg" alt="João Silva" class="membro-avatar">
                            </div>
                        </td>
                        <td>
                            <strong style="color: var(--text-main);">João Silva</strong>
                        </td>
                        <td style="color: var(--text-muted);">joao.silva@email.com</td>
                        <td>
                            <span class="badge-instrumento">Violão</span>
                        </td>
                        <td style="text-align: right;">
                            <a href="editar_membro.php?id=1" class="btn-card-action btn-editar" style="padding: 6px 12px; margin-bottom: 4px; display: inline-block;">Editar</a>
                            <a href="excluir_membro.php?id=1" class="btn-card-action btn-excluir" onclick="return confirm('Deseja realmente excluir este membro?');" style="padding: 6px 12px; display: inline-block;">Excluir</a>
                        </td>
                    </tr>

                    <tr>
                        <td style="text-align: center;">
                            <div class="membro-avatar-container" style="margin: 0 auto;">
                                <div class="membro-avatar-placeholder" title="Sem foto">
                                    <svg viewBox="0 0 24 24">
                                        <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                    </svg>
                                </div>
                            </div>
                        </td>
                        <td>
                            <strong style="color: var(--text-main);">Maria Souza</strong>
                        </td>
                        <td style="color: var(--text-muted);">maria.souza@email.com</td>
                        <td>
                            <span class="badge-instrumento">Vocal</span>
                        </td>
                        <td style="text-align: right;">
                            <a href="editar_membro.php?id=2" class="btn-card-action btn-editar" style="padding: 6px 12px; margin-bottom: 4px; display: inline-block;">Editar</a>
                            <a href="excluir_membro.php?id=2" class="btn-card-action btn-excluir" onclick="return confirm('Deseja realmente excluir este membro?');" style="padding: 6px 12px; display: inline-block;">Excluir</a>
                        </td>
                    </tr>

                    <tr>
                        <td style="text-align: center;">
                            <div class="membro-avatar-container" style="margin: 0 auto;">
                                <div class="membro-avatar-placeholder" title="Sem foto">
                                    <svg viewBox="0 0 24 24">
                                        <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                    </svg>
                                </div>
                            </div>
                        </td>
                        <td>
                            <strong style="color: var(--text-main);">Lucas Mendes</strong>
                        </td>
                        <td style="color: var(--text-muted);">lucas.mendes@email.com</td>
                        <td>
                            <span class="badge-instrumento">Bateria</span>
                        </td>
                        <td style="text-align: right;">
                            <a href="editar_membro.php?id=3" class="btn-card-action btn-editar" style="padding: 6px 12px; margin-bottom: 4px; display: inline-block;">Editar</a>
                            <a href="excluir_membro.php?id=3" class="btn-card-action btn-excluir" onclick="return confirm('Deseja realmente excluir este membro?');" style="padding: 6px 12px; display: inline-block;">Excluir</a>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>

    </main>

</body>
</html>