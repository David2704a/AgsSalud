
    document.addEventListener('DOMContentLoaded', function () {
        const userMenuButton = document.getElementById('user-menu-button');
        const userDropdown = document.getElementById('user-dropdown');

        userMenuButton.addEventListener('click', function () {
            // Alternar la clase 'show' para mostrar u ocultar el menú
            userDropdown.classList.toggle('show');
        });

        // Ocultar el menú si se hace clic fuera de él
        document.addEventListener('click', function (event) {
            if (!userMenuButton.contains(event.target) && !userDropdown.contains(event.target)) {
                userDropdown.classList.remove('show');
            }
        });
    });
