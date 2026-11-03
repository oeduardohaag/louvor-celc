<?php
// Código PHP para editar um culto
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Culto - Louvor CELC</title>
    <link rel="stylesheet" href="css/variables.css">
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/cultos.css">
    <script src="js/cultos.js"></script>
</head>

<body>

    <!-- Barra de Navegação -->
    <nav class="navbar">
        <div class="nav-brand">
            <a href="index.php">Louvor <strong>CELC</strong></a>
        </div>
        <div class="nav-links">
            <a href="index.php">Cultos</a>
            <a href="membros.php">Membros</a>
        </div>
        <div class="nav-actions">
            <a href="index.php" class="btn btn-secondary">Voltar</a>
            <a href="login.php" class="btn btn-danger-outline">Sair</a>
        </div>
    </nav>

    <!-- Conteúdo Principal -->
    <main class="container" style="padding: 32px 20px; max-width: 900px; margin: 0 auto;">
        <div class="page-header" style="margin-bottom: 24px;">
            <h2 style="font-size: 1.5rem; color: var(--text-main);">Editar Culto</h2>
            <p style="color: var(--text-muted); font-size: 0.9rem;">Atualize as informações, o repertório e a escala da
                equipe</p>
        </div>

        <!-- Formulário de Edição -->
        <form action="#" method="POST" class="form-container"
            style="background-color: var(--surface); border: 1px solid var(--border); border-radius: 8px; padding: 24px;">

            <div class="form-group" style="margin-bottom: 1.25rem;">
                <label for="titulo"
                    style="display: block; font-size: 0.85rem; color: var(--text-muted); margin-bottom: 6px; font-weight: 500;">Título
                    do Culto *</label>
                <input type="text" id="titulo" name="titulo" value="Culto de Celebração"
                    placeholder="Ex: Culto de Celebração, Santa Ceia..." required
                    style="width: 100%; background-color: var(--bg-main); border: 1px solid var(--border); border-radius: 6px; color: var(--text-main); padding: 10px 14px; font-size: 0.9rem; outline: none;">
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                <div class="form-group" style="margin-bottom: 1.25rem;">
                    <label for="data"
                        style="display: block; font-size: 0.85rem; color: var(--text-muted); margin-bottom: 6px; font-weight: 500;">Data
                        *</label>
                    <input type="date" id="data" name="data" value="2026-11-15" required
                        style="width: 100%; background-color: var(--bg-main); border: 1px solid var(--border); border-radius: 6px; color: var(--text-main); padding: 10px 14px; font-size: 0.9rem; outline: none;">
                </div>
                <div class="form-group" style="margin-bottom: 1.25rem;">
                    <label for="horario"
                        style="display: block; font-size: 0.85rem; color: var(--text-muted); margin-bottom: 6px; font-weight: 500;">Horário
                        *</label>
                    <input type="time" id="horario" name="horario" value="19:00" required
                        style="width: 100%; background-color: var(--bg-main); border: 1px solid var(--border); border-radius: 6px; color: var(--text-main); padding: 10px 14px; font-size: 0.9rem; outline: none;">
                </div>
            </div>

            <!-- Seção do Repertório -->
            <div class="secao-titulo-form"
                style="font-size: 1rem; color: var(--primary-gold); border-bottom: 1px solid var(--border); padding-bottom: 8px; margin: 16px 0 8px 0; font-weight: 600;">
                Repertório de Músicas</div>
            <div id="container-musicas">
                <div class="dinamico-linha" style="display: flex; gap: 10px; align-items: center; margin-bottom: 10px;">
                    <!-- Campo para digitar o Nome da Música -->
                    <input type="text" name="musicas[0][nome]" placeholder="Nome da música" required
                        style="flex: 2; background-color: var(--bg-main); border: 1px solid var(--border); border-radius: 6px; color: var(--text-main); padding: 10px 14px; font-size: 0.9rem; outline: none;">

                    <!-- Campo para digitar a Versão / Artista -->
                    <input type="text" name="musicas[0][versao]" placeholder="Versão da Música"
                        style="flex: 2; background-color: var(--bg-main); border: 1px solid var(--border); border-radius: 6px; color: var(--text-main); padding: 10px 14px; font-size: 0.9rem; outline: none;">

                    <!-- Select do Tom -->
                    <select name="musicas[0][tom]"
                        style="flex: 1; background-color: var(--bg-main); border: 1px solid var(--border); border-radius: 6px; color: var(--text-main); padding: 10px 14px; font-size: 0.9rem; outline: none;">
                        <option value="" disabled selected>Tom</option>
                        <option value="C">C</option>
                        <option value="C#">C#</option>
                        <option value="D">D</option>
                        <option value="D#">D#</option>
                        <option value="E">E</option>
                        <option value="F">F</option>
                        <option value="F#">F#</option>
                        <option value="G">G</option>
                        <option value="G#">G#</option>
                        <option value="A">A</option>
                        <option value="A#">A#</option>
                        <option value="B">B</option>
                        <option value="Em">Em</option>
                        <option value="Am">Am</option>
                        <option value="Bm">Bm</option>
                    </select>

                    <button type="button" class="btn-remover-linha" onclick="removerLinha(this)"
                        style="background-color: rgba(220, 38, 38, 0.1); border: 1px solid rgba(220, 38, 38, 0.3); color: #f87171; padding: 10px 14px; border-radius: 6px; cursor: pointer; font-weight: 600;">✕</button>
                </div>
            </div>
            <button type="button" id="btn-adicionar-musica" class="btn btn-secondary"
                style="margin-top: 8px; font-size: 0.8rem; padding: 6px 12px; background: rgba(212,175,55,0.1); border-color: rgba(212,175,55,0.3); color: var(--primary-gold); border-radius: 6px; cursor: pointer;">+
                Adicionar Música</button>

            <!-- Seção de Membros Escalados -->
            <div class="secao-titulo-form"
                style="font-size: 1rem; color: var(--primary-gold); border-bottom: 1px solid var(--border); padding-bottom: 8px; margin: 16px 0 8px 0; font-weight: 600;">
                Escala de Membros</div>
            <div id="container-membros">
                <!-- Exemplo de membro já escalado -->
                <div class="dinamico-linha" style="display: flex; gap: 10px; align-items: center; margin-bottom: 10px;">
                    <select name="membros[]"
                        style="flex: 1; background-color: var(--bg-main); border: 1px solid var(--border); border-radius: 6px; color: var(--text-main); padding: 10px 14px; font-size: 0.9rem; outline: none;">
                        <option value="" disabled>Selecione o membro e função</option>
                        <option value="1" selected>João Silva - Violão</option>
                        <option value="2">Maria Souza - Vocal</option>
                        <option value="3">Lucas Mendes - Bateria</option>
                        <option value="4">Carlos Eduardo - Teclado</option>
                    </select>
                    <button type="button" class="btn-remover-linha" onclick="removerLinha(this)"
                        style="background-color: rgba(220, 38, 38, 0.1); border: 1px solid rgba(220, 38, 38, 0.3); color: #f87171; padding: 10px 14px; border-radius: 6px; cursor: pointer; font-weight: 600;">✕</button>
                </div>
            </div>
            <button type="button" id="btn-adicionar-membro" class="btn btn-secondary"
                style="margin-top: 8px; font-size: 0.8rem; padding: 6px 12px; background: rgba(212,175,55,0.1); border-color: rgba(212,175,55,0.3); color: var(--primary-gold); border-radius: 6px; cursor: pointer;">+
                Adicionar Membro</button>

            <!-- Botões de Ação do Formulário -->
            <div class="form-actions"
                style="margin-top: 30px; display: flex; gap: 12px; border-top: 1px solid var(--border); padding-top: 20px;">
                <button type="submit" class="btn btn-primary"
                    style="background-color: var(--primary-gold); color: #000; padding: 10px 20px; border-radius: 6px; font-weight: 600; border: none; cursor: pointer;">Salvar
                    Alterações</button>
                <a href="index.php" class="btn btn-secondary"
                    style="padding: 10px 20px; border-radius: 6px; text-decoration: none; display: inline-flex; align-items: center; justify-content: center; color: var(--text-main);">Cancelar</a>
            </div>

        </form>
    </main>

    <script>
        let contadorMusicas = 1;

        document.getElementById('btn-adicionar-musica').addEventListener('click', function () {
            const container = document.getElementById('container-musicas');
            const novaLinha = document.createElement('div');
            novaLinha.className = 'dinamico-linha';
            novaLinha.style.cssText = "display: flex; gap: 10px; align-items: center; margin-bottom: 10px;";
            novaLinha.innerHTML = `
        <input type="text" name="musicas[${contadorMusicas}][nome]" placeholder="Nome da música" required style="flex: 2; background-color: var(--bg-main); border: 1px solid var(--border); border-radius: 6px; color: var(--text-main); padding: 10px 14px; font-size: 0.9rem; outline: none;">
        <input type="text" name="musicas[${contadorMusicas}][versao]" placeholder="Versão da Música" style="flex: 2; background-color: var(--bg-main); border: 1px solid var(--border); border-radius: 6px; color: var(--text-main); padding: 10px 14px; font-size: 0.9rem; outline: none;">
        <select name="musicas[${contadorMusicas}][tom]" style="flex: 1; background-color: var(--bg-main); border: 1px solid var(--border); border-radius: 6px; color: var(--text-main); padding: 10px 14px; font-size: 0.9rem; outline: none;">
            <option value="" disabled selected>Tom</option>
            <option value="C">C</option><option value="C#">C#</option><option value="D">D</option><option value="D#">D#</option><option value="E">E</option><option value="F">F</option><option value="F#">F#</option><option value="G">G</option><option value="G#">G#</option><option value="A">A</option><option value="A#">A#</option><option value="B">B</option><option value="Em">Em</option><option value="Am">Am</option><option value="Bm">Bm</option>
        </select>
        <button type="button" class="btn-remover-linha" onclick="removerLinha(this)" style="background-color: rgba(220, 38, 38, 0.1); border: 1px solid rgba(220, 38, 38, 0.3); color: #f87171; padding: 10px 14px; border-radius: 6px; cursor: pointer; font-weight: 600;">✕</button>
    `;
            container.appendChild(novaLinha);
            contadorMusicas++;
        });

        function removerLinha(botao) {
            const linha = botao.parentElement;
            linha.remove();
        }

        document.getElementById('btn-adicionar-membro').addEventListener('click', function () {
            const container = document.getElementById('container-membros');
            const novaLinha = document.createElement('div');
            novaLinha.className = 'dinamico-linha';
            novaLinha.style.cssText = "display: flex; gap: 10px; align-items: center; margin-bottom: 10px;";
            novaLinha.innerHTML = `
                <select name="membros[]" style="flex: 1; background-color: var(--bg-main); border: 1px solid var(--border); border-radius: 6px; color: var(--text-main); padding: 10px 14px; font-size: 0.9rem; outline: none;">
                    <option value="" disabled selected>Selecione o membro e função</option>
                    <option value="1">João Silva - Violão</option>
                    <option value="2">Maria Souza - Vocal</option>
                    <option value="3">Lucas Mendes - Bateria</option>
                    <option value="4">Carlos Eduardo - Teclado</option>
                </select>
                <button type="button" class="btn-remover-linha" onclick="removerLinha(this)" style="background-color: rgba(220, 38, 38, 0.1); border: 1px solid rgba(220, 38, 38, 0.3); color: #f87171; padding: 10px 14px; border-radius: 6px; cursor: pointer; font-weight: 600;">✕</button>
            `;
            container.appendChild(novaLinhead = novaLinha);
            container.appendChild(novaLinha);
        });

        function removerLinha(botao) {
            const linha = botao.parentElement;
            linha.remove();
        }
    </script>

</body>

</html>