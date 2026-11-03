let contadorMusicas = 1;

document.addEventListener('DOMContentLoaded', function () {
    const btnAddMusica = document.getElementById('btn-adicionar-musica');
    const btnAddMembro = document.getElementById('btn-adicionar-membro');

    if (btnAddMusica) {
        btnAddMusica.addEventListener('click', function () {
            const container = document.getElementById('container-musicas');
            const novaLinha = document.createElement('div');
            novaLinha.className = 'dinamico-linha';
            novaLinha.style.cssText = "display: flex; gap: 10px; align-items: center; margin-bottom: 10px;";
            novaLinha.innerHTML = `
                <input type="text" name="musicas[${contadorMusicas}][nome]" placeholder="Nome da música" required style="flex: 2; background-color: var(--bg-main); border: 1px solid var(--border); border-radius: 6px; color: var(--text-main); padding: 10px 14px; font-size: 0.9rem; outline: none;">
                <input type="text" name="musicas[${contadorMusicas}][versao]" placeholder="Versão (Ex: Diante do Trono)" style="flex: 2; background-color: var(--bg-main); border: 1px solid var(--border); border-radius: 6px; color: var(--text-main); padding: 10px 14px; font-size: 0.9rem; outline: none;">
                <select name="musicas[${contadorMusicas}][tom]" style="flex: 1; background-color: var(--bg-main); border: 1px solid var(--border); border-radius: 6px; color: var(--text-main); padding: 10px 14px; font-size: 0.9rem; outline: none;">
                    <option value="" disabled selected>Tom</option>
                    <option value="C">C</option><option value="C#">C#</option><option value="D">D</option><option value="D#">D#</option><option value="E">E</option><option value="F">F</option><option value="F#">F#</option><option value="G">G</option><option value="G#">G#</option><option value="A">A</option><option value="A#">A#</option><option value="B">B</option><option value="Em">Em</option><option value="Am">Am</option><option value="Bm">Bm</option>
                </select>
                <button type="button" class="btn-remover-linha" onclick="removerLinha(this)" style="background-color: rgba(220, 38, 38, 0.1); border: 1px solid rgba(220, 38, 38, 0.3); color: #f87171; padding: 10px 14px; border-radius: 6px; cursor: pointer; font-weight: 600;">✕</button>
            `;
            container.appendChild(novaLinha);
            contadorMusicas++;
        });
    }

    if (btnAddMembro) {
        btnAddMembro.addEventListener('click', function () {
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
            container.appendChild(novaLinha);
        });
    }
});

function removerLinha(botao) {
    const linha = botao.parentElement;
    linha.remove();
}