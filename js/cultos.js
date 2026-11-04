document.addEventListener('DOMContentLoaded', function () {
    
    // --- LÓGICA DO MODAL DE DETALHES DO CULTO ---
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
                containerRepertorio.innerHTML = '<p style="color: var(--text-muted);">Nenhuma música cadastrada neste culto.</p>';
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
        btnFechar.addEventListener('click', fecharModal);
    }

    if (modal) {
        modal.addEventListener('click', function (e) {
            if (e.target === modal) fecharModal();
        });
    }

    function fecharModal() {
        modal.classList.remove('ativo');
    }


    // --- LÓGICA DE FILTRAGEM (FRONTEND SIMULADO) ---
    const formFiltros = document.getElementById('form-filtros');
    const inputCulto = document.getElementById('filtro-culto');
    const inputMembro = document.getElementById('filtro-membro');
    const btnLimpar = document.getElementById('btn-limpar-filtros');

    if (formFiltros) {
        formFiltros.addEventListener('submit', function (e) {
            e.preventDefault();
            const termoCulto = inputCulto.value.toLowerCase().trim();
            const termoMembro = inputMembro.value.toLowerCase().trim();

            cardsCulto.forEach(card => {
                const nomeCulto = card.dataset.nome.toLowerCase();
                const escalaMembros = card.dataset.escala.toLowerCase();

                const bateCulto = !termoCulto || nomeCulto.includes(termoCulto);
                const bateMembro = !termoMembro || escalaMembros.includes(termoMembro);

                if (bateCulto && bateMembro) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    }

    if (btnLimpar) {
        btnLimpar.addEventListener('click', function () {
            inputCulto.value = '';
            inputMembro.value = '';
            cardsCulto.forEach(card => card.style.display = 'block');
        });
    }
});