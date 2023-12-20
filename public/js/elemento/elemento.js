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
        url:'/elemento/buscar',
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


  /*
================================================
ALERT
================================================
*/
setTimeout(function(){
  document.getElementById('success-alert').style.display = 'none';
}, 3000);


// excel booton

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








