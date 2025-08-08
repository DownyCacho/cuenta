 // Mostrar mensaje si la imagen es NoUsuario.png
        window.onload = function() {
            const img = document.getElementById('imgPerfil');
            const mensaje = document.getElementById('mensajeFoto');
            if (img.src.includes('NoUsuario.png')) {
                mensaje.style.display = 'block';
            } else {
                mensaje.style.display = 'none';
            }
        }

        function mostrarFoto(event) {
            const img = document.getElementById('imgPerfil');
            const mensaje = document.getElementById('mensajeFoto');
            if (event.target.files && event.target.files[0]) {
                img.src = URL.createObjectURL(event.target.files[0]);
                mensaje.style.display = 'none';
            }
        }