<?php
require "auth/verificar_login.php";
require_once "config/conexao.php";

$buscaCulto = trim($_GET['culto'] ?? '');
$buscaMembro = trim($_GET['membro'] ?? '');
$sucesso = $_GET['sucesso'] ?? '';

$sql = "SELECT DISTINCT c.* 
        FROM cultos c
        LEFT JOIN culto_membros cm ON c.id = cm.culto_id
        LEFT JOIN membros m ON cm.membro_id = m.id
        WHERE 1=1";

$params = [];

if ($buscaCulto !== '') {
    $sql .= " AND c.nome LIKE ?";
    $params[] = "%$buscaCulto%";
}

if ($buscaMembro !== '') {
    $sql .= " AND m.nome LIKE ?";
    $params[] = "%$buscaMembro%";
}

$sql .= " ORDER BY c.data_culto DESC, c.hora_culto DESC";

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$cultos = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmtMusicas = $pdo->query("
    SELECT 
        r.culto_id,
        m.nome AS nome_musica,
        m.versao AS versao_musica,
        r.tom,
        r.foto
    FROM repertorio r
    INNER JOIN musicas m ON r.musica_id = m.id
    ORDER BY r.id ASC
");

$musicasPorCulto = [];
foreach ($stmtMusicas->fetchAll(PDO::FETCH_ASSOC) as $musica) {
    $musicasPorCulto[$musica['culto_id']][] = [
        'nome' => $musica['nome_musica'],
        'versao' => $musica['versao_musica'] ?? '',
        'tom' => $musica['tom'],
        'foto' => $musica['foto'] ?? ''
    ];
}

$stmtMembros = $pdo->query("
    SELECT 
        cm.culto_id,
        m.nome,
        m.funcao
    FROM culto_membros cm
    INNER JOIN membros m ON cm.membro_id = m.id
    ORDER BY m.nome ASC
");

$membrosPorCulto = [];
foreach ($stmtMembros->fetchAll(PDO::FETCH_ASSOC) as $membro) {
    $membrosPorCulto[$membro['culto_id']][] = $membro;
}
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
            <a href="auth/logout.php" class="btn btn-danger-outline">Sair da Conta</a>
        </div>
    </nav>

    <main class="cultos-container">
        <div class="page-header">
            <div>
                <h2 class="page-title">Gestão de Cultos</h2>
                <p class="page-subtitle">Acompanhe os repertórios e a escala dos próximos cultos</p>
            </div>
            <a href="cultos/criar_culto.php" class="btn btn-primary-gold">+ Criar Novo Culto</a>
        </div>

        <?php if ($sucesso === 'criado'): ?>
            <div class="alert alert-registered">Culto cadastrado com sucesso!</div>
        <?php elseif ($sucesso === 'atualizado'): ?>
            <div class="alert alert-updated">Culto atualizado com sucesso!</div>
        <?php elseif ($sucesso === 'deletado'): ?>
            <div class="alert alert-deleted">Culto excluído com sucesso!</div>
        <?php endif; ?>

        <form id="form-filtros" method="GET" action="index.php" class="filtros-container">
            <input type="text" id="filtro-culto" name="culto" value="<?= htmlspecialchars($buscaCulto) ?>"
                placeholder="Buscar por nome do culto..." class="input-filtro">
            <input type="text" id="filtro-membro" name="membro" value="<?= htmlspecialchars($buscaMembro) ?>"
                placeholder="Buscar por participante escalado..." class="input-filtro">
            <button type="submit" class="btn btn-primary-gold">Filtrar</button>
            <a href="index.php" id="btn-limpar-filtros" class="btn btn-outline">Limpar</a>
        </form>

        <div class="cultos-lista-container">
            <?php if (empty($cultos)): ?>
                <p class="culto-empty-msg">Nenhum culto encontrado.</p>
            <?php else: ?>
                <?php foreach ($cultos as $culto): ?>
                    <?php
                    $idCulto = $culto['id'];
                    $dataFormatada = date('d/m/Y', strtotime($culto['data_culto']));
                    $horaFormatada = date('H:i', strtotime($culto['hora_culto']));
                    $repertorio = $musicasPorCulto[$idCulto] ?? [];
                    $escala = $membrosPorCulto[$idCulto] ?? [];

                    $escalaTexto = empty($escala)
                        ? 'Nenhum membro escalado'
                        : implode(', ', array_map(fn($m) => "{$m['nome']} ({$m['funcao']})", $escala));

                    $repertorioJson = htmlspecialchars(json_encode($repertorio, JSON_UNESCAPED_UNICODE), ENT_QUOTES, 'UTF-8');
                    ?>

                    <div class="culto-card" data-culto-id="<?= $idCulto ?>" data-nome="<?= htmlspecialchars($culto['nome']) ?>"
                        data-data="<?= $dataFormatada ?>" data-hora="<?= $horaFormatada ?>"
                        data-escala="<?= htmlspecialchars($escalaTexto) ?>" data-repertorio="<?= $repertorioJson ?>">

                        <div class="culto-card-header">
                            <span class="culto-data">Data: <?= $dataFormatada ?></span>
                        </div>

                        <div class="culto-card-body">
                            <h3 class="culto-card-title"><?= htmlspecialchars($culto['nome']) ?></h3>
                            <p class="culto-horario"><strong>Horário:</strong> <?= $horaFormatada ?></p>

                            <div class="culto-secao-info">
                                <span class="culto-secao-titulo">Repertório:</span>
                                <?php if (empty($repertorio)): ?>
                                    <p class="culto-secao-vazia">Nenhuma música definida.</p>
                                <?php else: ?>
                                    <ul class="culto-musicas-lista">
                                        <?php foreach ($repertorio as $musica): ?>
                                            <li>
                                                <span class="musica-nome"><?= htmlspecialchars($musica['nome']) ?></span>
                                                <?php if (!empty($musica['versao'])): ?>
                                                    <span class="musica-versao">(<?= htmlspecialchars($musica['versao']) ?>)</span>
                                                <?php endif; ?>
                                                <span class="badge-tom">Tom: <?= htmlspecialchars($musica['tom']) ?></span>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php endif; ?>
                            </div>

                            <div class="culto-secao-info">
                                <span class="culto-secao-titulo">Escala:</span>
                                <?php if (empty($escala)): ?>
                                    <p class="culto-secao-vazia">Nenhum membro escalado.</p>
                                <?php else: ?>
                                    <div class="culto-membros-lista">
                                        <?php foreach ($escala as $membro): ?>
                                            <div class="membro-tag-escala">
                                                <span class="membro-nome"><?= htmlspecialchars($membro['nome']) ?></span>
                                                <span class="badge-instrumento"><?= htmlspecialchars($membro['funcao']) ?></span>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="culto-card-actions">
                            <a href="cultos/excluir_culto.php?id=<?= $idCulto ?>" class="btn-card-action btn-excluir"
                                onclick="event.stopPropagation(); return confirm('Deseja realmente excluir este culto?');"
                                title="Excluir Culto">✕ Excluir</a>
                            <a href="cultos/editar_culto.php?id=<?= $idCulto ?>" class="btn-card-action btn-editar"
                                onclick="event.stopPropagation();" title="Editar Culto">✎ Editar</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
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

</body>

</html>