document.addEventListener('DOMContentLoaded', function () {
    const mensajeVacio = document.querySelector('.mensaje-vacio');
    const searchInput = document.getElementById('search-input');
    const tableBody = document.querySelector('tbody');

    function updateTable(filtro) {
        $.ajax({
            url:urlBase+'/usuariosBuscar',
            method: 'GET',
            data: { filtro: filtro },
            success: function (data) {
                tableBody.innerHTML = data;
            },
            error: function (error) {
                console.error('Error al realizar la búsqueda:', error);
            },
        });
    }

    searchInput.addEventListener('input', function () {
        const filtro = searchInput.value.trim().toLowerCase();
        updateTable(filtro);
    });

    $('.delete-button').on('click', function () {
        var userId = $(this).data('id');
        $('#myModal_' + userId).show();
    });
});