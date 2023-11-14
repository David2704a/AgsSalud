/*
================================================
CAMBIO DE PARTES DEL FORM
================================================
*/

function mostrarParte(idParte) {
    const partes = document.querySelectorAll('.form-part');
    partes.forEach(parte => {
        parte.classList.remove('active');
        if (parte.id === idParte) {
            parte.classList.add('active');
            actualizarProgreso();
        }
    });
}

function actualizarProgreso() {
const partes = document.querySelectorAll('.form-part');
const marcadores = document.querySelectorAll('.marker');
const progreso = document.getElementById('progress');

const numeroParteActual = Array.from(partes).findIndex(parte => parte.classList.contains('active'));
const porcentajeProgreso = ((numeroParteActual + 1) / partes.length) * 100;

progreso.style.width = porcentajeProgreso + '%';

// Marcar el número de parte actual como lleno
marcadores.forEach((marker, index) => {
if (index <= numeroParteActual) {
    marker.classList.add('filled');
} else {
    marker.classList.remove('filled');
}
});
}

/*
================================================
FILTRO
================================================
*/

document.addEventListener('DOMContentLoaded', function () {
    const mensajeVacio = document.querySelector('.mensaje-vacio');
    const searchInput = document.getElementById('search-input');
    const tableBody = document.querySelector('tbody');



    function updateTable(filtro) {
      $.ajax({
        url: '/tipoProcedimiento/buscar',
        method: 'GET',
        data: { filtro: filtro },
        success: function (data) {
          tableBody.innerHTML = data;
        },
        error: function (error) {
          console.error('Error al realizar la búsqueda:', error);
        }
      });
    }

    searchInput.addEventListener('input', function () {
      const filtro = searchInput.value.trim().toLowerCase();
      updateTable(filtro);
    });


  });


    /*
  ================================================
  FUNCIONES PARA EL MODAL
  ================================================
  */

  document.addEventListener('DOMContentLoaded', function () {
    var modal = document.getElementById('myModal');
    var closeSpan = document.querySelector('.modal-content .close');
    var modalContent = document.querySelector('.modal-content');
    var modalMessage = document.getElementById('modalMessage');
    var cancelButton = document.getElementById('cancelButton');
    function handleDeleteButtonClick(event) {
        event.preventDefault();

        var recordId = event.target.getAttribute('data-id');
        var recordTipo = event.target.getAttribute('data-tipo');

        modalMessage.innerHTML = `<p class="record-id-message">¿Estás seguro de que quieres eliminar el registro con el nombre: "<span class="record-id">${recordTipo}</span>"?</p>`;


        var deleteForm = document.getElementById('deleteForm');
        var action = deleteForm.getAttribute('action').replace('REPLACE_ID', recordId);
        deleteForm.setAttribute('action', action);

        modal.style.display = 'block';
    }


    var deleteButtons = document.querySelectorAll('.delete-button');
    deleteButtons.forEach(function (button) {
        button.addEventListener('click', handleDeleteButtonClick);
    });

    cancelButton.onclick = closeModal;

    window.onclick = function (event) {
        if (event.target === modal) {
            closeModal();
        }
    };

    function closeModal() {
        modal.style.display = 'none';
    }
});


