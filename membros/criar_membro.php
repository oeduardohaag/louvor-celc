<?php

?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Membro - Louvor CELC</title>
    <link rel="stylesheet" href="../css/variables.css">
    <link rel="stylesheet" href="../css/navbar.css">
    <link rel="stylesheet" href="../css/membros.css">
    <script src="../js/membros.js" defer></script>
</head>

<body>

    <nav class="navbar">
        <div class="nav-brand">
            <a href="../index.php">Louvor <strong>CELC</strong></a>
        </div>
        <div class="nav-links">
            <a href="../index.php">Cultos</a>
            <a href="../membros.php" class="active">Membros</a>
        </div>
        <div class="nav-actions">
            <a href="../membros.php" class="btn btn-secondary">Voltar</a>
            <a href="../login.php" class="btn btn-danger-outline">Sair</a>
        </div>
    </nav>

    <main class="container" style="padding: 32px 20px; max-width: 650px; margin: 0 auto;">
        <div class="page-header" style=": 24px;">
            <h2 style="font-size: 1.5rem; color: var(--text-main);">Cadastrar Novo Membro</h2>
            <p style="color: var(--text-muted); font-size: 0.9rem;">Insira os dados do integrante, defina sua função e
                ajuste a foto de perfil</p>
        </div>

        <form action="#" method="POST" enctype="multipart/form-data" class="form-container"
            style="background-color: var(--surface); border: 1px solid var(--border); border-radius: 8px; padding: 24px;">

            <div class="form-group" style="margin-bottom: 1rem;">
                <label for="nome"
                    style="display: block; font-size: 0.85rem; color: var(--text-muted); margin-bottom: 6px; font-weight: 500;">Nome
                    Completo *</label>
                <input type="text" id="nome" name="nome" placeholder="Ex: João Silva" required
                    style="width: 100%; background-color: var(--bg-main); border: 1px solid var(--border); border-radius: 6px; color: var(--text-main); padding: 10px 14px; font-size: 0.9rem; outline: none;">
            </div>

            <div class="form-group" style="margin-bottom: 1rem;">
                <label for="email"
                    style="display: block; font-size: 0.85rem; color: var(--text-muted); margin-bottom: 6px; font-weight: 500;">E-mail
                    *</label>
                <input type="email" id="email" name="email" placeholder="exemplo@email.com" required
                    style="width: 100%; background-color: var(--bg-main); border: 1px solid var(--border); border-radius: 6px; color: var(--text-main); padding: 10px 14px; font-size: 0.9rem; outline: none;">
            </div>

            <div class="form-group" style="margin-bottom: 1rem;">
                <label for="instrumento"
                    style="display: block; font-size: 0.85rem; color: var(--text-muted); margin-bottom: 6px; font-weight: 500;">Função
                    / Instrumento Principal *</label>
                <select id="instrumento" name="instrumento" required>
                    <option value="" disabled selected>Selecione uma função</option>
                    <option value="Vocal">Vocal</option>
                    <option value="Violão">Violão</option>
                    <option value="Guitarra">Guitarra</option>
                    <option value="Teclado">Teclado</option>
                    <option value="Baixo">Baixo</option>
                    <option value="Bateria">Bateria</option>
                    <option value="Sonoplastia">Sonoplastia</option>
                    <option value="Mídia">Mídia</option>
                </select>
            </div>

            <div class="form-group" style="margin-bottom: 1rem;">
                <label for="foto"
                    style="display: block; font-size: 0.85rem; color: var(--text-muted); margin-bottom: 6px; font-weight: 500;">Foto
                    de Perfil (Opcional)</label>
                <input type="file" id="foto" name="foto" accept="image/*"
                    style="width: 100%; background-color: var(--bg-main); border: 1px solid var(--border); border-radius: 6px; color: var(--text-muted); padding: 8px 12px; font-size: 0.85rem; outline: none; cursor: pointer;">

                <div class="preview-container">
                    <div class="avatar-preview-circulo">
                        <span id="placeholder-text" class="avatar-preview-placeholder">Sem foto</span>
                        <img id="img-preview" src="" alt="Preview do Avatar">
                    </div>
                    <div class="preview-info">
                        <p>Como aparecerá na tabela</p>
                        <span>A imagem é ajustada automaticamente em proporção circular para manter o padrão visual
                            limpo.</span>
                    </div>
                </div>
            </div>

            <div class="form-actions"
                style="margin-top: 30px; display: flex; gap: 12px; border-top: 1px solid var(--border); padding-top: 20px;">
                <button type="submit" class="btn btn-primary"
                    style="background-color: var(--primary-gold); color: #000; padding: 10px 20px; border-radius: 6px; font-weight: 600; border: none; cursor: pointer;">Cadastrar
                    Membro</button>
                <a href="../membros.php" class="btn btn-secondary"
                    style="padding: 10px 20px; border-radius: 6px; text-decoration: none; display: inline-flex; align-items: center; justify-content: center; color: var(--text-main);">Cancelar</a>
            </div>

        </form>
    </main>

    <script>
        const inputFoto = document.getElementById('foto');
        const imgPreview = document.getElementById('img-preview');
        const placeholderText = document.getElementById('placeholder-text');

        inputFoto.addEventListener('change', function (event) {
            const arquivo = event.target.files[0];
            if (arquivo) {
                const leitor = new FileReader();
                leitor.onload = function (e) {
                    imgPreview.src = e.target.result;
                    imgPreview.style.display = 'block';
                    placeholderText.style.display = 'none';
                }
                leitor.readAsDataURL(arquivo);
            } else {
                imgPreview.src = '';
                imgPreview.style.display = 'none';
                placeholderText.style.display = 'block';
            }
        });
    </script>

</body>

</html>