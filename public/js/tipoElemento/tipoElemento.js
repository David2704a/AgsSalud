document.addEventListener('DOMContentLoaded', function () {
    const mensajeVacio = document.querySelector('.mensaje-vacio');
    const searchInput = document.getElementById('search-inputeleme4nto');
    const tableBody = document.querySelector('tbody');
  
  
  
    function updateTable(filtro) {
      $.ajax({
        url: urlBase+'/tipoelementoBuscar',
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
  
  
  });