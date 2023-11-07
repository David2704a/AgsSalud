{{-- document.addEventListener('DOMContentLoaded', function () {
    const menuItems = document.querySelectorAll('.menu a');
    const tableRows = document.querySelectorAll('tbody tr');
    const mensajeVacio = document.querySelector('.mensaje-vacio'); // Obtener la fila de mensaje vacío
    const searchInput = document.getElementById('search-input'); // Obtener el input de búsqueda
    const searchIcon = document.getElementById('search-icon'); // Obtener el icono de búsqueda

    // Función para aplicar el filtro
    function applyFilter(filtro) {
        let filasVisibles = 0;

        tableRows.forEach(row => {
            const estado = row.classList[0].replace('estado-', '');
            const contenido = row.textContent.toLowerCase();

            if (filtro === estado || filtro === 'Todos' || contenido.includes(filtro)) {
                row.style.display = '';
                filasVisibles++;
            } else {
                row.style.display = 'none';
            }
        });

        // Mostrar el mensaje de "No se encontraron registros" si no hay filas visibles
        mensajeVacio.style.display = filasVisibles === 0 ? 'table-row' : 'none';
    }

    // Evento para aplicar el filtro en tiempo real mientras se escribe en el input
    searchInput.addEventListener('input', function () {
        const filtro = searchInput.value.trim().toLowerCase();
        applyFilter(filtro);
    });

    // Evento para mostrar u ocultar el div search-container al hacer clic en el icono de búsqueda
    searchIcon.addEventListener('click', function () {
        const searchContainer = document.querySelector('.search-container');
        searchContainer.style.display = searchContainer.style.display === 'none' ? 'block' : 'none';
    });

    // Evento para aplicar el filtro al hacer clic en los elementos del menú
    menuItems.forEach(item => {
        item.addEventListener('click', function (event) {
            event.preventDefault();
            const filtro = event.target.getAttribute('data-filtro');
            applyFilter(filtro);
        });
    });
}); --}}
