document.addEventListener('DOMContentLoaded', function () {
    const btnAddMusica = document.getElementById('btn-adicionar-musica');
    const containerMusicas = document.getElementById('container-musicas');

    if (btnAddMusica && containerMusicas) {
        btnAddMusica.addEventListener('click', function () {
            const index = containerMusicas.querySelectorAll('.dinamico-linha').length;
            const primeiraLinha = containerMusicas.querySelector('.dinamico-linha');
            const selectMusicasBase = primeiraLinha.querySelector('select[name*="[musica_id]"]');
            const selectTomBase = primeiraLinha.querySelector('select[name*="[tom]"]');

            const novaLinha = document.createElement('div');
            novaLinha.className = 'dinamico-linha';

            novaLinha.innerHTML = `
                <select class="form-select select-musica" name="musicas[${index}][musica_id]" required>
                    ${selectMusicasBase.innerHTML}
                </select>
                <select class="form-select select-tom" name="musicas[${index}][tom]" required>
                    ${selectTomBase.innerHTML}
                </select>
                <div class="cifra-upload-group">
                    <input class="input-file-cifra" type="file" name="musicas[${index}][foto]" accept="image/*" title="Foto da Cifra (Opcional)">
                </div>
                <button type="button" class="btn-remover-linha" onclick="removerLinha(this)">✕</button>
            `;

            novaLinha.querySelector('select[name*="[musica_id]"]').selectedIndex = 0;
            novaLinha.querySelector('select[name*="[tom]"]').selectedIndex = 0;

            containerMusicas.appendChild(novaLinha);
        });
    }

    const btnAddMembro = document.getElementById('btn-adicionar-membro');
    const containerMembros = document.getElementById('container-membros');

    if (btnAddMembro && containerMembros) {
        btnAddMembro.addEventListener('click', function () {
            const primeiroSelect = containerMembros.querySelector('select[name="membros[]"]');
            const novaLinha = document.createElement('div');
            novaLinha.className = 'dinamico-linha';

            novaLinha.innerHTML = `
                <select class="form-select select-membro" name="membros[]">
                    ${primeiroSelect.innerHTML}
                </select>
                <button type="button" class="btn-remover-linha" onclick="removerLinha(this)">✕</button>
            `;

            novaLinha.querySelector('select').selectedIndex = 0;
            containerMembros.appendChild(novaLinha);
        });
    }

    // Modal de detalhes e cifras na index.php
    const modal = document.getElementById('modal-culto');
    const btnFechar = document.getElementById('modal-btn-fechar');
    const cardsCulto = document.querySelectorAll('.culto-card');

    cardsCulto.forEach(card => {
        card.addEventListener('click', function () {
            const nome = this.dataset.nome;
            const data = this.dataset.data;
            const hora = this.dataset.hora;
            const escala = this.dataset.escala;
            const repertorio = JSON.parse(this.dataset.repertorio || '[]');

            document.getElementById('modal-data-hora').textContent = `${data} às ${hora}`;
            document.getElementById('modal-titulo').textContent = nome;
            document.getElementById('modal-membros').textContent = escala;

            const containerRepertorio = document.getElementById('modal-repertorio');
            containerRepertorio.innerHTML = '';

            if (repertorio.length === 0) {
                containerRepertorio.innerHTML = '<p class="culto-secao-vazia">Nenhuma música cadastrada neste culto.</p>';
            } else {
                repertorio.forEach(m => {
                    let htmlFoto = '';
                    if (m.foto) {
                        htmlFoto = `
                            <div class="modal-cifra-box">
                                <span class="modal-cifra-titulo">Foto da Cifra:</span>
                                <a href="${m.foto}" target="_blank">
                                    <img src="${m.foto}" alt="Cifra da música ${m.nome}" class="modal-cifra-img">
                                </a>
                            </div>
                        `;
                    }

                    const cardMusica = document.createElement('div');
                    cardMusica.className = 'modal-musica-card';
                    cardMusica.innerHTML = `
                        <div class="modal-musica-header">
                            <div>
                                <strong class="modal-musica-nome">${m.nome}</strong>
                                <span class="modal-musica-versao"> - ${m.versao || 'Versão Padrão'}</span>
                            </div>
                            <span class="badge-tom">Tom: ${m.tom}</span>
                        </div>
                        ${htmlFoto}
                    `;
                    containerRepertorio.appendChild(cardMusica);
                });
            }

            modal.classList.add('ativo');
        });
    });

    if (btnFechar) {
        btnFechar.addEventListener('click', () => modal.classList.remove('ativo'));
    }

    if (modal) {
        modal.addEventListener('click', function (e) {
            if (e.target === modal) modal.classList.remove('ativo');
        });
    }
});

function removerLinha(botao) {
    const linha = botao.parentElement;
    const container = linha.parentElement;
    if (container.querySelectorAll('.dinamico-linha').length > 1) {
        linha.remove();
    }
}