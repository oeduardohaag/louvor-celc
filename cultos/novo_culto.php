<?php
require "../auth/verificar_login.php";
require_once "../config/conexao.php";

$erro = '';

// Carrega as músicas registradas e lista de membros do banco de dados
$musicasCatalogo = $pdo->query("SELECT id, nome, versao FROM musicas ORDER BY nome ASC")->fetchAll(PDO::FETCH_ASSOC);
$membrosLista    = $pdo->query("SELECT id, nome, funcao FROM membros ORDER BY nome ASC")->fetchAll(PDO::FETCH_ASSOC);

// Armazena todos os tons músicas para seleção
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
    <title>Criar Culto - Louvor CELC</title>
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
                <h2 class="page-title">Criar Novo Culto</h2>
                <p class="page-subtitle">Preencha as informações, monte o repertório e escale a equipe</p>
            </div>
        </div>

        <?php if ($erro): ?>
            <div class="alert alert-danger">
                <?= htmlspecialchars($erro) ?>
            </div>
        <?php endif; ?>

        <form action="salvar_culto.php" method="POST" enctype="multipart/form-data" class="form-card">

            <div class="form-group">
                <label class="form-label" for="titulo">Título do Culto *</label>
                <input class="form-input" type="text" id="titulo" name="titulo"
                    placeholder="Ex: Culto de Celebração, Santa Ceia..." required>
            </div>

            <div class="form-grid-2">
                <div class="form-group">
                    <label class="form-label" for="data">Data *</label>
                    <input class="form-input" type="date" id="data" name="data" required>
                </div>
                <div class="form-group">
                    <label class="form-label" for="horario">Horário *</label>
                    <input class="form-input" type="time" id="horario" name="horario" required>
                </div>
            </div>

            <div class="secao-titulo-form">Repertório de Músicas</div>
            <div id="container-musicas">
                <div class="dinamico-linha">
                    <select class="form-select select-musica" name="musicas[0][musica_id]" required>
                        <option value="" disabled selected>Selecione a música</option>
                        <?php foreach ($musicasCatalogo as $m): ?>
                            <option value="<?= $m['id'] ?>">
                                <?= htmlspecialchars($m['nome']) ?><?= !empty($m['versao']) ? ' (' . htmlspecialchars($m['versao']) . ')' : '' ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <select class="form-select select-tom" name="musicas[0][tom]" required>
                        <option value="" disabled selected>Tom</option>
                        <?php foreach ($tonsDisponiveis as $t): ?>
                            <option value="<?= $t ?>"><?= $t ?></option>
                        <?php endforeach; ?>
                    </select>
                    <div class="cifra-upload-group">
                        <input class="input-file-cifra" type="file" name="musicas[0][foto]" accept="image/*"
                            title="Foto da Cifra (Opcional)">
                    </div>
                    <button type="button" class="btn-remover-linha" onclick="removerLinha(this)">✕</button>
                </div>
            </div>
            <button type="button" id="btn-adicionar-musica" class="btn-adicionar-linha">+ Adicionar Música</button>

            <div class="secao-titulo-form">Escala de Membros</div>
            <div id="container-membros">
                <div class="dinamico-linha">
                    <select class="form-select select-membro" name="membros[]">
                        <option value="" disabled selected>Selecione o membro e função</option>
                        <?php foreach ($membrosLista as $mb): ?>
                            <option value="<?= $mb['id'] ?>">
                                <?= htmlspecialchars($mb['nome']) ?> - <?= htmlspecialchars($mb['funcao']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <button type="button" class="btn-remover-linha" onclick="removerLinha(this)">✕</button>
                </div>
            </div>
            <button type="button" id="btn-adicionar-membro" class="btn-adicionar-linha">+ Adicionar Membro</button>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary-gold">Cadastrar Culto</button>
                <a href="../index.php" class="btn btn-cancel">Cancelar</a>
            </div>

        </form>
    </main>

</body>

</html>