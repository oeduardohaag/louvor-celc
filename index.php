<?php
// require "verificar_login.php";
include "config/conexao.php";

// Fazer a query englobando todas an infos requeridas para um culto
$sql    = "SELECT * FROM cultos ORDER BY id DESC";
$cultos = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);

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
    <script src="js/cultos.js" defer></script>
</head>

<body>

    <nav class="navbar">
        <div class="nav-brand">
            <a href="index.php">Louvor <strong>CELC</strong></a>
        </div>
        <div class="nav-links">
            <a href="index.php" class="active">Cultos</a>
            <a href="membros.php">Membros</a>
            <a href="musicas.php">Músicas</a>
        </div>
        <div class="nav-actions">
            <a href="logout.php" class="btn btn-danger-outline">Sair da Conta</a>
        </div>
    </nav>

    <main class="container">
        <div class="page-header">
            <div>
                <h2>Gestão de Cultos</h2>
                <p>Acompanhe os repertórios e a escala dos próximos cultos</p>
            </div>
            <a href="cultos/criar_culto.php" class="btn btn-primary">+ Criar Novo Culto</a>
        </div>

        <form id="form-filtros" class="filtros-container">
            <input type="text" id="filtro-culto" placeholder="Buscar por nome do culto..." class="input-filtro">
            <input type="text" id="filtro-membro" placeholder="Buscar por participante escalado..." class="input-filtro">
            <button type="submit" class="btn btn-primary">Filtrar</button>
            <button type="button" id="btn-limpar-filtros" class="btn btn-outline">Limpar</button>
        </form>

        <!-- Lista / Grid de Cards de Culto -->
        <div class="cultos-lista-container">

            <!-- Card 1 -->
            <div class="culto-card"
                data-culto-id="1"
                data-nome="Culto de Celebração"
                data-data="15/11/2026"
                data-hora="19:00"
                data-escala="João Silva (Violão), Maria Souza (Vocal)"
                data-repertorio='[{"nome":"Grandes Coisas","versao":"Diante do Trono","tom":"G","foto":""},{"nome":"Bondade de Deus","versao":"Isadora Pompeo","tom":"C","foto":""}]'>

                <div class="culto-card-header">
                    <span class="culto-data">Data: 15/11/2026</span>
                </div>

                <div class="culto-card-body">
                    <h3>Culto de Celebração</h3>
                    <p class="culto-horario"><strong>Horário:</strong> 19:00</p>

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

                    <div class="culto-secao-info espaco-topo">
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
                    <a href="cultos/excluir_culto.php?id=1" class="btn-card-action btn-excluir" onclick="event.stopPropagation(); return confirm('Deseja realmente excluir este culto?');" title="Excluir Culto">✕ Excluir</a>
                    <a href="cultos/editar_culto.php?id=1" class="btn-card-action btn-editar" onclick="event.stopPropagation();" title="Editar Culto">✎ Editar</a>
                </div>
            </div>
        </div>
    </main>

    <div id="modal-culto" class="modal-overlay">
        <div class="modal-content">
            <button type="button" id="modal-btn-fechar" class="modal-close">&times;</button>

            <span id="modal-data-hora" class="modal-data-hora"></span>
            <h2 id="modal-titulo" class="modal-titulo"></h2>

            <p class="modal-escala">
                <strong>Equipe Escalada:</strong> <span id="modal-membros"></span>
            </p>

            <hr class="modal-divider">

            <h3 class="modal-subtitulo">Repertório & Cifras</h3>
            <div id="modal-repertorio" class="modal-repertorio-container"></div>
        </div>
    </div>