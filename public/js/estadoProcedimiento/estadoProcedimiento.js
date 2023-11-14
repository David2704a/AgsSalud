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
        url: '/estadoProcedimiento/buscar',
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
    var deleteForm = document.getElementById('deleteForm');
    var modalMessage = document.getElementById('modalMessage');

    var currentRecordId; // Variable global para almacenar el ID del registro

    function handleDeleteButtonClick(event) {
        event.preventDefault();

        // Obtener el ID del registro desde el botón
        var recordId = event.currentTarget.getAttribute('data-id');

        // Personalizar el contenido del modal según el registro
        modalMessage.innerHTML = `<p>¿Estás seguro de que quieres eliminar el registro con ID ${recordId}?</p>`;

        // Actualizar la acción del formulario de eliminación con el ID correcto
        var action = deleteForm.getAttribute('action').replace('REPLACE_ID', recordId);
        deleteForm.setAttribute('action', action);

        modal.style.display = 'block';
    }

    // Asignar evento click al contenedor principal
    var deleteButtonsContainer = document.querySelector('.delete-buttons-container');
    deleteButtonsContainer.addEventListener('click', function (event) {
        // Verificar si el clic fue en el botón (y no en el ícono)
        var button = event.target.closest('.delete-button');
        if (button) {
            handleDeleteButtonClick(event);
        }
    });

    // Asignar evento click al ícono dentro del botón
    var deleteIcons = document.querySelectorAll('.delete-button i');
    deleteIcons.forEach(function (icon) {
        icon.addEventListener('click', function (event) {
            event.stopPropagation(); // Detener la propagación para que no llegue al contenedor
        });
    });

    closeSpan.onclick = closeModal;

    window.onclick = function (event) {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    };

    // Manejar el envío del formulario de eliminación
    deleteForm.addEventListener('submit', function (event) {
        // Actualizar la acción del formulario con el ID almacenado
        var action = deleteForm.getAttribute('action').replace('REPLACE_ID', currentRecordId);
        deleteForm.setAttribute('action', action);

        // Confirmar la eliminación si el usuario confirma en el modal
        var confirmDelete = confirm('¿Estás seguro de que quieres eliminar este registro?');
        if (!confirmDelete) {
            event.preventDefault(); // Detener el envío del formulario si el usuario cancela
        } else {
            closeModal(); // Cerrar el modal después de confirmar la eliminación
        }
    });

    function closeModal() {
        modal.style.display = 'none';
    }
});
