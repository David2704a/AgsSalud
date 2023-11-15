/*
================================================
ALERT
================================================
*/
setTimeout(function(){
    document.getElementById('alert').style.display = 'none';
}, 5000);
/*
================================================
FUNTIONS MODAL
================================================
*/


document.addEventListener('DOMContentLoaded', function () {
    var modal = document.getElementById('myModal');
    var modalMessage = document.getElementById('modalMessage');
    var cancelButton = document.getElementById('cancelButton');

    function handleDeleteButtonClick(event) {
        event.preventDefault();

        // Obtener el botón o el icono, dependiendo de dónde se hizo clic
        var buttonOrIcon = event.target.closest('.delete-button');
        if (!buttonOrIcon) {
            return;
        }

        var recordId = buttonOrIcon.getAttribute('data-id');
        var recordName = buttonOrIcon.getAttribute('data-name');

        modalMessage.innerHTML = `<p class="record-id-message">¿Estás seguro de que quieres eliminar el registro con el nombre:
         <span class="record-id"> ${recordName} </span>
        y el ID: "<span class="record-id"> ${recordId} </span>"?</p>`;

        var deleteForm = document.getElementById('deleteForm');
        var action = deleteForm.getAttribute('action').replace('REPLACE_ID', recordId);
        deleteForm.setAttribute('action', action);

        modal.style.display = 'block';

        console.log('se le dio click');
    }

    // Utilizar delegación de eventos en el contenedor de los botones de eliminación
    document.body.addEventListener('click', function (event) {
        // Verificar si el clic fue en un botón o en el ícono
        if (event.target.classList.contains('delete-button') || event.target.closest('.delete-button')) {
            handleDeleteButtonClick(event);
        }
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


