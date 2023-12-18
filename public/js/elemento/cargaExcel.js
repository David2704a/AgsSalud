<script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

function mostrarBotonCargar() {
    var archivoInput = document.getElementById('archivo');
    var cargarBtn = document.getElementById('cargarBtn');
    var archivoLabel = document.getElementById('archivoLabel');

    if (archivoInput.files.length > 0) {
        cargarBtn.style.display = 'inline-block';

        // Actualiza la etiqueta con el nombre completo del archivo seleccionado
        var nombreArchivo = archivoInput.files[0].name;
        archivoLabel.innerHTML = '<i class="fas fa-file-excel"></i> Archivo: <span title="' + nombreArchivo + '">' + obtenerParteNombre(nombreArchivo) + '</span>';

        // Opcional: Oculta el input de archivo si ya se ha seleccionado uno (puedes ajustar según tu preferencia)
        archivoInput.style.display = 'none';
    } else {
        cargarBtn.style.display = 'none';
        archivoLabel.innerHTML = '<i class="fas fa-file-excel"></i> Selecciona un archivo:';
    }
}

function obtenerParteNombre(nombreCompleto) {
    // Puedes ajustar la longitud de la parte que deseas mostrar
    var longitudParte = 15;
    if (nombreCompleto.length > longitudParte) {
        return nombreCompleto.substring(0, longitudParte) + '...';
    } else {
        return nombreCompleto;
    }
}

function mostrarNotificacion(mensaje, exito) {
    Toastify({
        text: mensaje,
        duration: 3000, // Duración en milisegundos
        gravity: "top", // Posición de la notificación (puedes ajustar según tu preferencia)
        close: true,
        backgroundColor: exito ? "green" : "red", // Color de fondo (verde para éxito, rojo para error)
        stopOnFocus: true, // Detener la notificación cuando se enfoca en la pantalla
        callback: function () {
            // No se necesita ningún código aquí ahora
        }
    }).showToast();
}

document.getElementById('cargarBtn').addEventListener('click', function (event) {
    event.preventDefault();
    
    // Ocultar el botón antes de realizar la solicitud
    this.style.display = 'none';

    var formData = new FormData(document.getElementById('formularioImportar'));

    fetch(document.getElementById('formularioImportar').action, {
        method: document.getElementById('formularioImportar').method,
        body: formData,
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Si la importación es exitosa, muestra una notificación verde
            mostrarNotificacion('Archivo importado correctamente', true);
        } else {
            // Si hay un error, muestra una notificación roja con el mensaje de error
            mostrarNotificacion('Error durante la importación: ' + data.error, false);
        }
    })
    .catch(error => {
        console.error('Error durante la solicitud fetch:', error);
        // Muestra una notificación roja en caso de error
        mostrarNotificacion('Error durante la importación. Consulta la consola para obtener más detalles.', false);
    });
})