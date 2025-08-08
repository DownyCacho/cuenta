// Menú desplegable de perfil
document.addEventListener('DOMContentLoaded', function() {
    const btnPerfil = document.getElementById('btnPerfil');
    const perfilDropdown = document.getElementById('perfilDropdown');

    btnPerfil.addEventListener('click', function(event) {
        perfilDropdown.classList.toggle('show');
        event.stopPropagation();
    });

    document.addEventListener('click', function() {
        perfilDropdown.classList.remove('show');
    });
});