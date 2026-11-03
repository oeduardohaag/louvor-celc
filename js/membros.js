document.addEventListener('DOMContentLoaded', function () {
    const inputFoto = document.getElementById('foto');
    const imgPreview = document.getElementById('img-preview');
    const placeholderText = document.getElementById('placeholder-text');

    if (inputFoto && imgPreview) {
        inputFoto.addEventListener('change', function (event) {
            const arquivo = event.target.files[0];
            if (arquivo) {
                const leitor = new FileReader();
                leitor.onload = function (e) {
                    imgPreview.src = e.target.result;
                    imgPreview.style.display = 'block';
                    if (placeholderText) {
                        placeholderText.style.display = 'none';
                    }
                }
                leitor.readAsDataURL(arquivo);
            }
        });
    }
});