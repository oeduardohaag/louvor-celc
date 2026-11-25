<?php
require "../auth/verificar_login.php";
require_once "../config/conexao.php";

$id = $_GET['id'] ?? $_POST['id'] ?? 0;

$erro = '';

$musicasLista = $pdo->query("SELECT id, nome, versao FROM musicas ORDER BY nome ASC")->fetchAll(PDO::FETCH_ASSOC);
$membrosLista = $pdo->query("SELECT id, nome, funcao FROM membros ORDER BY nome ASC")->fetchAll(PDO::FETCH_ASSOC);

$stmtCulto = $pdo->prepare("SELECT * FROM cultos WHERE id = ?");
$stmtCulto->execute([$id]);
$culto = $stmtCulto->fetch(PDO::FETCH_ASSOC);

$stmtRepertorioAtual = $pdo->prepare("SELECT * FROM repertorio WHERE culto_id = ? ORDER BY id ASC");
$stmtRepertorioAtual->execute([$id]);
$repertorioAtual = $stmtRepertorioAtual->fetchAll(PDO::FETCH_ASSOC);

$stmtEscalaAtual = $pdo->prepare("SELECT membro_id FROM culto_membros WHERE culto_id = ?");
$stmtEscalaAtual->execute([$id]);
$escalaAtual = $stmtEscalaAtual->fetchAll(PDO::FETCH_COLUMN);

$tonsDisponiveis = [
    'C', 'C#', 'D', 'D#', 'E', 'F', 'F#', 'G', 'G#', 'A', 'A#', 'B',
    'Cm', 'C#m', 'Dm', 'D#m', 'Em', 'Fm', 'F#m', 'Gm', 'G#m', 'Am', 'A#m', 'Bm'
];
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Culto - Louvor CELC</title>
    <link rel="stylesheet" href="../css/variables.css">
    <link rel="stylesheet" href="../css/navbar.css">
    <link rel="stylesheet" href="../css/cultos.css">
    <script src="../js/cultos.js" defer></script>
</head>

<body>

    <nav class="navbar">
        <div class="nav-brand">
            <a href="../index.php">Louvor <strong>CELC</strong></a>
        </div>
        <div class="nav-links">
            <a href="../index.php" class="active">Cultos</a>
            <a href="../membros.php">Membros</a>
            <a href="../musicas.php">Músicas</a>
        </div>
        <div class="nav-actions">
            <a href="../index.php" class="btn btn-secondary">Voltar</a>
            <a href="../auth/logout.php" class="btn btn-danger-outline">Sair da Conta</a>
        </div>
    </nav>

    <main class="cultos-form-container">
        <div class="page-header">
            <div>
                <h2 class="page-title">Editar Culto</h2>
                <p class="page-subtitle">Altere as informações, o repertório ou a escala deste culto</p>
            </div>
        </div>

        <?php if ($erro): ?>
            <div class="alert alert-danger">
                <?= htmlspecialchars($erro) ?>
            </div>
        <?php endif; ?>

        <form action="atualizar_culto.php" method="POST" enctype="multipart/form-data" class="form-card">
            <input type="hidden" name="id" value="<?= $id ?>">

            <div class="form-group">
                <label class="form-label" for="titulo">Título do Culto *</label>
                <input class="form-input" type="text" id="titulo" name="titulo"
                    value="<?= htmlspecialchars($culto['nome']) ?>" required>
            </div>

            <div class="form-grid-2">
                <div class="form-group">
                    <label class="form-label" for="data">Data *</label>
                    <input class="form-input" type="date" id="data" name="data"
                        value="<?= htmlspecialchars($culto['data_culto']) ?>" required>
                </div>
                <div class="form-group">
                    <label class="form-label" for="horario">Horário *</label>
                    <input class="form-input" type="time" id="horario" name="horario"
                        value="<?= htmlspecialchars(substr($culto['hora_culto'], 0, 5)) ?>" required>
                </div>
            </div>

            <div class="secao-titulo-form">Repertório de Músicas</div>
            <div id="container-musicas">
                <?php
                $linhasMusicas = !empty($repertorioAtual) ? $repertorioAtual : [['musica_id' => '', 'tom' => '', 'foto' => '']];
                foreach ($linhasMusicas as $idx => $rep):
                ?>
                    <div class="dinamico-linha">
                        <input type="hidden" name="musicas[<?= $idx ?>][foto_atual]"
                            value="<?= htmlspecialchars($rep['foto'] ?? '') ?>">

                        <select class="form-select select-musica" name="musicas[<?= $idx ?>][musica_id]" required>
                            <option value="" disabled <?= empty($rep['musica_id']) ? 'selected' : '' ?>>Selecione a música</option>
                            <?php foreach ($musicasLista as $m): ?>
                                <option value="<?= $m['id'] ?>" <?= ($m['id'] == $rep['musica_id']) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($m['nome']) ?><?= !empty($m['versao']) ? ' (' . htmlspecialchars($m['versao']) . ')' : '' ?>
                                </option>
                            <?php endforeach; ?>
                        </select>

                        <select class="form-select select-tom" name="musicas[<?= $idx ?>][tom]" required>
                            <option value="" disabled <?= empty($rep['tom']) ? 'selected' : '' ?>>Tom</option>
                            <?php foreach ($tonsDisponiveis as $t): ?>
                                <option value="<?= $t ?>" <?= ($t === $rep['tom']) ? 'selected' : '' ?>><?= $t ?></option>
                            <?php endforeach; ?>
                        </select>

                        <div class="cifra-upload-group">
                            <input class="input-file-cifra" type="file" name="musicas[<?= $idx ?>][foto]" accept="image/*"
                                title="Substituir foto da cifra">
                            <?php if (!empty($rep['foto'])): ?>
                                <a class="link-cifra-atual" href="../<?= htmlspecialchars($rep['foto']) ?>" target="_blank">Ver cifra atual</a>
                            <?php endif; ?>
                        </div>

                        <button type="button" class="btn-remover-linha" onclick="removerLinha(this)">✕</button>
                    </div>
                <?php endforeach; ?>
            </div>
            <button type="button" id="btn-adicionar-musica" class="btn-adicionar-linha">+ Adicionar Música</button>

            <div class="secao-titulo-form">Escala de Membros</div>
            <div id="container-membros">
                <?php
                $linhasMembros = !empty($escalaAtual) ? $escalaAtual : [''];
                foreach ($linhasMembros as $membroSelecionado):
                ?>
                    <div class="dinamico-linha">
                        <select class="form-select select-membro" name="membros[]">
                            <option value="" disabled <?= empty($membroSelecionado) ? 'selected' : '' ?>>Selecione o membro e função</option>
                            <?php foreach ($membrosLista as $mb): ?>
                                <option value="<?= $mb['id'] ?>" <?= ($mb['id'] == $membroSelecionado) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($mb['nome']) ?> - <?= htmlspecialchars($mb['funcao']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <button type="button" class="btn-remover-linha" onclick="removerLinha(this)">✕</button>
                    </div>
                <?php endforeach; ?>
            </div>
            <button type="button" id="btn-adicionar-membro" class="btn-adicionar-linha">+ Adicionar Membro</button>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary-gold">Salvar Alterações</button>
                <a href="../index.php" class="btn btn-cancel">Cancelar</a>
            </div>

        </form>
    </main>

</body>

</html>