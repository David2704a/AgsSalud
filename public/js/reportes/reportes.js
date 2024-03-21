 /*
 ================================================================
 DATATABLE PARA LAS TABLAS
 ================================================================
 */

//     inicializarTablaPrestamos();
//     inicializarTablaElementos();


// function inicializarTablaPrestamos() {
//     var table = $('#tablaReportesPrestamos').DataTable({

//         // language: textoEspañolTables(),


//         initComplete: function (settings, json) {

//             $('.tablePrestamos .dataTables_filter input[type="search"]').each(function () {
//                 var input = $(this);
//                 var label = input.parent('label');
//                 input.insertAfter(label);
//                 label.remove();
//             });


//             $('.tablePrestamos .dataTables_filter input[type="search"]').attr('type', 'text').attr('placeholder', 'Buscar...');



//             var buttonHtml = '<button class="search-button" type="button">' +
//                 '<svg width="17" height="16" fill="none" xmlns="http://www.w3.org/2000/svg" role="img" aria-labelledby="search">' +
//                 '<path d="M7.667 12.667A5.333 5.333 0 107.667 2a5.333 5.333 0 000 10.667zM14.334 14l-2.9-2.9" stroke="currentColor" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round"></path>' +
//                 '</svg>' +
//                 '</button>';


//             $('.tablePrestamos .dataTables_filter ').prepend(buttonHtml);


//             var resetButtonHtml = '<button class="reset" type="reset">' +
//                 '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">' +
//                 '<path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>' +
//                 '</svg>' +
//                 '</button>';

//             $('.tablePrestamos .dataTables_filter').append(resetButtonHtml);


//             $('.reset').click(function () {
//                 table.search('').columns().search('').draw();
//                 $('.tablePrestamos .dataTables_filter input[type="search"]').val('');
//             });
//         }
//     });
// }

// function inicializarTablaElementos() {
//     var table = $('#tablaReportElementos').DataTable({

//         language: textoEspañolTables(),


//         initComplete: function (settings, json) {

//             $('.tableElementos .dataTables_filter input[type="search"]').each(function () {
//                 var input = $(this);
//                 var label = input.parent('label');
//                 input.insertAfter(label);
//                 label.remove();
//             });


//             $('.tableElementos .dataTables_filter input[type="search"]').attr('type', 'text').attr('placeholder', 'Buscar...');



//             var buttonHtml = '<button class="search-button" type="button">' +
//                 '<svg width="17" height="16" fill="none" xmlns="http://www.w3.org/2000/svg" role="img" aria-labelledby="search">' +
//                 '<path d="M7.667 12.667A5.333 5.333 0 107.667 2a5.333 5.333 0 000 10.667zM14.334 14l-2.9-2.9" stroke="currentColor" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round"></path>' +
//                 '</svg>' +
//                 '</button>';


//             $('.tableElementos .dataTables_filter ').prepend(buttonHtml);


//             var resetButtonHtml = '<button class="reset" type="reset">' +
//                 '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">' +
//                 '<path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>' +
//                 '</svg>' +
//                 '</button>';

//             $('.tableElementos .dataTables_filter').append(resetButtonHtml);


//             $('.reset').click(function () {
//                 table.search('').columns().search('').draw();
//                 $('.tableElementos .dataTables_filter input[type="search"]').val('');
//             });
//         }
//     });
// }

// function textoEspañolTables(){
//     return {

//         "sEmptyTable":     "No hay datos disponibles en la tabla",
//         "sInfo":           "Mostrando _START_ a _END_ de _TOTAL_ entradas",
//         "sInfoEmpty":      "Mostrando 0 a 0 de 0 entradas",
//         "sZeroRecords":    "No se encontraron registros coincidentes",
//         "lengthMenu": "Mostrar _MENU_ entradas por página",
//         "oPaginate": {
//             "sFirst":    "Primero",
//             "sLast":     "Último",
//             "sNext":     "Siguiente",
//             "sPrevious": "Anterior"
//         }

//     }
// }
/*
============================================================
FUNCION PARA CAMBIAR DE CONTENIDO
============================================================
*/

 // Mostrar u ocultar campos según el tipo de informe seleccionado
 function cambiarContenido(tipoModulo) {
    var elementos = document.getElementById('elementos');
    var procedimientos = document.getElementById('procedimientos');
    var menuItems = document.querySelectorAll('.menu-item');



    // Ocultar todos los contenidos
    elementos.classList.add('hidden');
    procedimientos.classList.add('hidden');


    // Mostrar el contenido según el tipo de informe seleccionado
    if (tipoModulo === 'elemento') {
        elementos.classList.remove('hidden');
    } else if (tipoModulo === 'procedimiento') {
        procedimientos.classList.remove('hidden');
    }



    menuItems.forEach(function (item) {
        item.classList.remove('active');
    });

    event.currentTarget.classList.add('active');
}


function OptionsDocumentsElementos() {
    var documentOptions = document.getElementById('documentOptionsElements');
    documentOptions.style.display = (documentOptions.style.display === 'flex') ? 'none' : 'flex';
}
function OptionsDocumentsProcedimientos() {
    var documentOptions = document.getElementById('documentOptionsProcedimientos');
    documentOptions.style.display = (documentOptions.style.display === 'flex') ? 'none' : 'flex';

    console.log('aloooooo');
}


function preSubmitAction() {
    // Realiza el filtrado u otras acciones aquí
    console.log('Realizando acción antes del envío del formulario');
    return true; // Permitir el envío del formulario
}

function cambioDeRutasElemento(format) {
    // Cambia la acción del formulario según el formato seleccionado
    var form = document.getElementById('exportFormE');
    if (format === 'excel') {
        form.action = "{{ url('/excel/elemento') }}"; // Cambia la ruta según sea necesario
    } else if (format === 'pdf') {
        form.target = '_blank';
        form.action = "{{ url('/pdf/elemento') }}"; // Cambia la ruta según sea necesario
    }




    // Completa el formulario y lo envía
    form.submit();
}

function cambioDeRutasProcedimiento(format) {
    // Cambia la acción del formulario según el formato seleccionado
    var form = document.getElementById('exportFormP');
    if (format === 'excel') {
        form.action = excelUrl; // Cambia la ruta según sea necesario
    } else if (format === 'pdf') {
        form.target = '_blank';
        form.action = "{{ url('/pdf/procedimiento') }}"; // Cambia la ruta según sea necesario
    }




    // Completa el formulario y lo envía
    form.submit();
}



function aplicarFiltrosElementos() {
    // Recopilar valores de campos
    var idTipoProcedimiento = document.getElementById('idTipoProcedimiento').value;
    var idEstadoEquipo = document.getElementById('idEstadoEquipo').value;
    var idTipoElemento = document.getElementById('idTipoElemento').value;
    var idCategoria = document.getElementById('idCategoria').value;
    var idElemento = document.getElementById('idElemento').value;

    console.log(idElemento, 'elementooooooo');

    // Realizar la llamada AJAX
    var xhr = new XMLHttpRequest();
    var url = "/reportes/filtro"; // Reemplaza con la ruta correcta
    var params = "idTipoProcedimiento=" + idTipoProcedimiento +
                 "&idEstadoEquipo=" + idEstadoEquipo +
                 "&idTipoElemento=" + idTipoElemento +
                 "&idCategoria=" + idCategoria +
                 "&id_dispo=" + idElemento;

    xhr.open("GET", url + "?" + params, true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // Actualizar la tabla con la respuesta del servidor
            var tabla = document.getElementById('miTabla');
            tabla.innerHTML = xhr.responseText;
        }
    };
    xhr.send();
}
function aplicarFiltrosPrestamo() {
// Recopilar valores de campos
var idResponsableEntrega = document.getElementById('idResponsableEntrega').value;
var idResponsableRecibe = document.getElementById('idResponsableRecibe').value;
var idProcedimiento = document.getElementById('idProcedimiento').value;
var fechaInicio = document.getElementById('fechaInicio').value;
var fechaFin = document.getElementById('fechaFin').value;

// Realizar la llamada AJAX
var xhr = new XMLHttpRequest();
var url = "/reportes/filtrop"; // Reemplaza con la ruta correcta
var params = "idResponsableEntrega=" + idResponsableEntrega +
             "&idResponsableRecibe=" + idResponsableRecibe +
             "&idProcedimiento=" + idProcedimiento +
             "&fechaInicio=" + fechaInicio +
             "&fechaFin=" + fechaFin;

xhr.open("GET", url + "?" + params, true);
xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
        // Actualizar la tabla con la respuesta del servidor
        var tabla = document.getElementById('miTablaP'); // Asegúrate de tener el ID correcto
        tabla.innerHTML = xhr.responseText;
    }
};
xhr.send();
}



document.addEventListener('DOMContentLoaded', function () {
    const mensajeVacio = document.querySelector('.mensaje-vacio');
    const searchInput = document.getElementById('search-input');
    const tableBody = document.querySelector('.tbodyElementos');



    function updateTable(filtro) {
      $.ajax({
        url:urlBase+'/buscarReporte',
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
