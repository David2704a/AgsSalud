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

// function showLoadingMessage() {
//     // $('#').modal('hide');
//     document.getElementById('overlay').style.display = 'flex';
// }
