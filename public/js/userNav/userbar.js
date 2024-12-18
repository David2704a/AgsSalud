document.addEventListener('DOMContentLoaded', function () {
    const userMenuButton = document.getElementById('user-menu-button');
    const userDropdown = document.getElementById('user-dropdown');

    userMenuButton.addEventListener('click', function () {
        if (userDropdown.classList.contains('show')) {
            userDropdown.classList.remove('show');
            setTimeout(() => {
                userDropdown.style.display = 'none';
            }, 300);
        } else {
            userDropdown.style.display = 'flex';
            setTimeout(() => {
                userDropdown.classList.add('show');
            }, 10);
        }
    });

    document.addEventListener('click', function (event) {
        if (!userMenuButton.contains(event.target) && !userDropdown.contains(event.target)) {
            if (userDropdown.classList.contains('show')) {
                userDropdown.classList.remove('show');
                setTimeout(() => {
                    userDropdown.style.display = 'none';
                }, 300); // Tiempo de la transición en milisegundos
            }
        }
    });
});
