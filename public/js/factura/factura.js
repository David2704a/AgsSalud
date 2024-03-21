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
        url: urlBase+'/facturasBuscar',
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
  SHOW PDF
  ================================================
  */
  function mostrarArchivo(rutaArchivo) {
    if (!rutaArchivo) {
        alert("No hay una factura cargada.");
    } else {
        const url = `http://localhost:8000/storage/Facturas/${rutaArchivo}`;
        window.open(url);
    }
  }

  /*
================================================
ALERT
================================================
*/
setTimeout(function(){
  document.getElementById('success-alert').style.display = 'none';
}, 3000);


