<?php
// BACKEND: index.php
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Principal - Louvor CELC</title>
    <link rel="stylesheet" href="css/variables.css">
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/cultos.css">
    <link rel="stylesheet" href="css/membros.css">
</head>
<body>

    <nav class="navbar">
        <div class="nav-brand">
            <a href="index.php">Louvor <strong>CELC</strong></a>
        </div>
        <div class="nav-links">
            <a href="index.php" class="active">Cultos</a>
            <a href="membros.php">Membros</a>
        </div>
        <div class="nav-actions">
            <a href="login.php" class="btn btn-danger-outline">Sair da Conta</a>
        </div>
    </nav>

    <main class="container" style="padding: 32px 20px; max-width: 1200px; margin: 0 auto;">
        <div class="page-header" style="margin-bottom: 24px; display: flex; justify-content: space-between; align-items: center;">
            <div>
                <h2 style="font-size: 1.5rem; color: var(--text-main);">Gestão de Cultos</h2>
                <p style="color: var(--text-muted); font-size: 0.9rem;">Acompanhe os repertórios e a escala dos próximos cultos</p>
            </div>
            <a href="criar_culto.php" class="btn" style="background-color: var(--primary-gold); color: #000; padding: 10px 16px; border-radius: 6px; text-decoration: none; font-weight: 600; font-size: 0.9rem;">Criar Novo Culto</a>
        </div>

        <div class="cultos-lista-container">
            
            <div class="culto-card">
                <div class="culto-card-header">
                    <span class="culto-data">Data: 15/11/2026</span>
                </div>

                <div class="culto-card-body">
                    <h3>Culto de Celebração</h3>
                    <p style="margin-bottom: 12px;"><strong>Horário:</strong> 19:00</p>

                    <div class="culto-secao-info">
                        <span class="culto-secao-titulo">Repertório:</span>
                        <ul class="culto-musicas-lista">
                            <li>
                                <span class="musica-nome">Grandes Coisas</span> 
                                <span class="musica-versao">(Diante do Trono)</span> 
                                <span class="badge-tom">Tom: G</span>
                            </li>
                            <li>
                                <span class="musica-nome">Bondade de Deus</span> 
                                <span class="musica-versao">(Isadora Pompeo)</span> 
                                <span class="badge-tom">Tom: C</span>
                            </li>
                        </ul>
                    </div>

                    <div class="culto-secao-info" style="margin-top: 12px;">
                        <span class="culto-secao-titulo">Escala:</span>
                        <div class="culto-membros-lista">
                            <div class="membro-tag-escala">
                                <span class="membro-nome">João Silva</span>
                                <span class="badge-instrumento">Violão</span>
                            </div>
                            <div class="membro-tag-escala">
                                <span class="membro-nome">Maria Souza</span>
                                <span class="badge-instrumento">Vocal</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="culto-card-actions">
                    <a href="excluir_culto.php?id=1" class="btn-card-action btn-excluir" onclick="return confirm('Deseja realmente excluir este culto?');" title="Excluir Culto">✕ Excluir</a>
                    <a href="editar_culto.php?id=1" class="btn-card-action btn-editar" title="Editar Culto">✎ Editar</a>
                </div>
            </div>

            <div class="culto-card">
                <div class="culto-card-header">
                    <span class="culto-data">Data: 01/12/2026</span>
                </div>

                <div class="culto-card-body">
                    <h3>Culto de Santa Ceia</h3>
                    <p style="margin-bottom: 12px;"><strong>Horário:</strong> 18:00</p>

                    <div class="culto-secao-info">
                        <span class="culto-secao-titulo">Repertório:</span>
                        <ul class="culto-musicas-lista">
                            <li>
                                <span class="musica-nome">Ceia e Comunhão</span> 
                                <span class="musica-versao">(Coral CELC)</span> 
                                <span class="badge-tom">Tom: D</span>
                            </li>
                        </ul>
                    </div>

                    <div class="culto-secao-info" style="margin-top: 12px;">
                        <span class="culto-secao-titulo">Escala:</span>
                        <div class="culto-membros-lista">
                            <div class="membro-tag-escala">
                                <span class="membro-nome">Ana Paula</span>
                                <span class="badge-instrumento">Vocal</span>
                            </div>
                            <div class="membro-tag-escala">
                                <span class="membro-nome">Carlos Eduardo</span>
                                <span class="badge-instrumento">Teclado</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="culto-card-actions">
                    <a href="excluir_culto.php?id=2" class="btn-card-action btn-excluir" onclick="return confirm('Deseja realmente excluir este culto?');" title="Excluir Culto">✕ Excluir</a>
                    <a href="editar_culto.php?id=2" class="btn-card-action btn-editar" title="Editar Culto">✎ Editar</a>
                </div>
            </div>

            <div class="culto-card">
                <div class="culto-card-header">
                    <span class="culto-data">Data: 05/12/2026</span>
                </div>

                <div class="culto-card-body">
                    <h3>Culto de Jovens</h3>
                    <p style="margin-bottom: 12px;"><strong>Horário:</strong> 19:30</p>

                    <div class="culto-secao-info">
                        <span class="culto-secao-titulo">Repertório:</span>
                        <ul class="culto-musicas-lista">
                            <li>
                                <span class="musica-nome">Ousado Amor</span> 
                                <span class="musica-versao">(Isaias Saad)</span> 
                                <span class="badge-tom">Tom: C</span>
                            </li>
                        </ul>
                    </div>

                    <div class="culto-secao-info" style="margin-top: 12px;">
                        <span class="culto-secao-titulo">Escala:</span>
                        <div class="culto-membros-lista">
                            <div class="membro-tag-escala">
                                <span class="membro-nome">Lucas Mendes</span>
                                <span class="badge-instrumento">Bateria</span>
                            </div>
                            <div class="membro-tag-escala">
                                <span class="membro-nome">Beatriz Lima</span>
                                <span class="badge-instrumento">Guitarra</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="culto-card-actions">
                    <a href="excluir_culto.php?id=3" class="btn-card-action btn-excluir" onclick="return confirm('Deseja realmente excluir este culto?');" title="Excluir Culto">✕ Excluir</a>
                    <a href="editar_culto.php?id=3" class="btn-card-action btn-editar" title="Editar Culto">✎ Editar</a>
                </div>
            </div>

        </div>
    </main>

</body>
</html>