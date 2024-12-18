$(document).ready(function () {
    filtrarElementos();
    filtroProcedimientos();
    $('.filtrosInputsElementos select').on('change', function () {
        filtrarElementos();
    });

});



var responseGetElementos;
var responseGetPro;
$(document).ready(function () {
    inicializarTablaPrestamos();
    inicializarTablaElementos();
})
/*
=======================================================
FUNCION PARA EL FILTRO DE LA TABLA DE ELEMENTOS
=======================================================
*/
function filtrarElementos() {
    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    var idUsuario = $('#idUsuario').val();
    var idEstadoEquipo = $('#idEstadoEquipo').val();
    var idTipoElemento = $('#idTipoElemento').val();
    var idCategoria = $('#idCategoria').val();
    var idElemento = $('#idElemento').val();

    const data = {
        'idUsuario': idUsuario,
        'idEstadoEquipo': idEstadoEquipo,
        'idTipoElemento': idTipoElemento,
        'idCategoria': idCategoria,
        'idElemento': idElemento
    };

    const datos = JSON.stringify(data);

    $.ajax({
        type: 'POST',
        url: urlBase + '/filtroElementos',
        data: {
            datos: datos,
            _token: csrfToken,
        },
        success: function (response) {
            responseGetElementos = response;
            if ($.fn.DataTable.isDataTable('#tablaReportElementos')) {
                $('#tablaReportElementos').DataTable().destroy();
            }

            $('#tablaReportElementos tbody').empty();

            $.each(responseGetElementos, function (index, elemento) {
                $('#tablaReportElementos tbody').append(
                    `<tr>
                        <td>${elemento.id_dispo ? elemento.id_dispo : 'NO APLICA'}</td>
                        <td>${elemento.referencia ? elemento.referencia : 'NO APLICA'}</td>
                        <td>${elemento.descripcion ? elemento.descripcion : 'NO APLICA'}</td>
                        <td>${elemento.estadoElemento ? elemento.estadoElemento : 'NO APLICA'}</td>
                        <td>${elemento.nameCategoria ? elemento.nameCategoria : 'NO APLICA'}</td>
                        <td>${elemento.codigoFactura ? elemento.codigoFactura : 'NO APLICA'}</td>
                        <td>${elemento.nameProveedor ? elemento.nameProveedor : 'NO APLICA'}</td>
                        <td>
                            ${elemento.nombre1 ? elemento.nombre1 : 'NO APLICA'}
                            ${elemento.nombre2 ? elemento.nombre2 : ''}
                            ${elemento.apellido1 ? elemento.apellido1 : ''}
                            ${elemento.apellido2 ? elemento.apellido2 : ''}
                        </td>
                    </tr>`
                );
            });

            inicializarTablaElementos();

            $('.download').click(function (e) {
                e.preventDefault();
                exportarReporte(responseGetElementos);
            });
        }
    });
}

// Llamar a la función al cargar la página

function escapeHtml(unsafe) {
    return unsafe
        .replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;")
        .replace(/"/g, "&quot;")
        .replace(/'/g, "&#039;");
}

function exportarReporte(data) {
    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    var jsonData = escapeHtml(JSON.stringify(data));

    var form = $('<form action="' + urlBase + '/exportarElementos" method="post">' +
        '<input type="hidden" name="_token" value="' + csrfToken + '" />' +
        '<input type="hidden" name="data" value=\'' + jsonData + '\' />' +
        '</form>');

    $(document.body).append(form);
    form.submit();
    form.remove();
}


/*
================================================================
DATATABLE PARA LA TABLA DE ELEMENTOS
================================================================
*/






function inicializarTablaElementos() {
    var table = $('#tablaReportElementos').DataTable({

        language: textoEspañolTables(),


        initComplete: function (settings, json) {

            $('.tableElementos .dataTables_filter input[type="search"]').each(function () {
                var input = $(this);
                var label = input.parent('label');
                input.insertAfter(label);
                label.remove();
            });


            $('.tableElementos .dataTables_filter input[type="search"]').attr('type', 'text').attr('placeholder', 'Buscar...');



            var buttonHtml = '<button class="search-button" type="button">' +
                '<svg width="17" height="16" fill="none" xmlns="http://www.w3.org/2000/svg" role="img" aria-labelledby="search">' +
                '<path d="M7.667 12.667A5.333 5.333 0 107.667 2a5.333 5.333 0 000 10.667zM14.334 14l-2.9-2.9" stroke="currentColor" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round"></path>' +
                '</svg>' +
                '</button>';


            $('.tableElementos .dataTables_filter ').prepend(buttonHtml);


            var resetButtonHtml = '<button class="reset" type="reset">' +
                '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">' +
                '<path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>' +
                '</svg>' +
                '</button>';

            $('.tableElementos .dataTables_filter').append(resetButtonHtml);


            $('.reset').click(function () {
                table.search('').columns().search('').draw();
                $('.tableElementos .dataTables_filter input[type="search"]').val('');
            });
        }
    });
}

function textoEspañolTables() {
    return {

        "sEmptyTable": "No hay datos disponibles en la tabla",
        "sInfo": "Mostrando _START_ a _END_ de _TOTAL_ entradas",
        "sInfoEmpty": "Mostrando 0 a 0 de 0 entradas",
        "sZeroRecords": "No se encontraron registros coincidentes",
        "lengthMenu": "Mostrar _MENU_ entradas por página",
        "oPaginate": {
            "sFirst": "Primero",
            "sLast": "Último",
            "sNext": "Siguiente",
            "sPrevious": "Anterior"
        }

    }
}
/*
============================================================
FUNCION PARA CAMBIAR DE CONTENIDO
============================================================
*/
function cambiarContenido(tipoModulo) {
    var elementos = document.getElementById('elementos');
    var procedimientos = document.getElementById('procedimientos');
    var menuItems = document.querySelectorAll('.menu-item');

    elementos.classList.add('hidden');
    procedimientos.classList.add('hidden');

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

}

document.addEventListener("DOMContentLoaded", function () {
    const loaderWrapper = document.querySelector(".loader-wrapper");
    if (loaderWrapper) {
        loaderWrapper.style.display = "none";
    }

    const content = document.querySelector(".content");
    if (content) {
        content.style.display = "block";
    }
});


/*
========================================================
FUNCION PARA EL FILTRO Y EXPORTACION DE PROCEDIMIENTOS
========================================================
*/

function filtroProcedimientos() {
    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    var idResponsableEntrega = $('#idResponsableEntrega').val();
    var idResponsableRecibe = $('#idResponsableRecibe').val();
    var idElemento = $('#idProcedimiento').val();
    var fechaInicio = $('#fechaInicio').val();
    var fechaFin = $('#fechaFin').val();

    const data = {
        'idResponsableEntrega': idResponsableEntrega,
        'idResponsableRecibe': idResponsableRecibe,
        'idElemento': idElemento,
        'fechaInicio': fechaInicio,
        'fechaFin': fechaFin,
    }
    const datos = JSON.stringify(data);

    $.ajax({
        type: 'POST',
        url: urlBase + '/filtroProcedimientos',
        data: {
            _token: csrfToken,
            datos: datos
        },
        success: function (response) {

            responseGetPro = response;
            if ($.fn.DataTable.isDataTable('#tablaReportesPrestamos')) {
                $('#tablaReportesPrestamos').DataTable().destroy();
            }

            $('#tablaReportesPrestamos tbody').empty()

            $.each(response, function (index, response) {
                $('#tablaReportesPrestamos tbody').append(
                    '<tr>' +
                    '<td>' + response.idProcedimiento + '</td>' +
                    '<td>' + response.fechaInicio + '</td>' +
                    '<td>' + (response.nameCategoria ? response.nameCategoria : 'NO APLICA') + '</td>' +
                    '<td>' + (response.id_dispo ? response.id_dispo : 'NO APLICA') + '</td>' +
                    '<td>' + (response.estado ? response.estado : 'NO APLICA') + '</td>' +
                    '<td>' + (response.nameEntrega ? response.nameEntrega : 'NO APLICA') + '</td>' +
                    '<td>' + (response.nameRecibe ? response.nameRecibe : 'NO APLICA') + '</td>' +
                    '<td>' + (response.fechaFin ? response.fechaFin : 'NO APLICA') + '</td>' +
                    '<td>' + (response.nameEntregaDev ? response.nameEntregaDev : 'NO APLICA') + '</td>' +
                    '<td>' + (response.nameRecibeDev ? response.nameRecibeDev : 'NO APLICA') + '</td>' +
                    '<td>' + (response.observacion ? response.observacion : 'NO APLICA') + '</td>' +
                    '</tr>'
                )
            });
            inicializarTablaPrestamos()
            $('.downloadP').click(function (e) {
                e.preventDefault();
                exportarReportePro(responseGetPro);
            });
            $('.downloadPDF').click(function (e) {
                e.preventDefault();
                exportarReportePDF(responseGetPro);
            });
        }
    })
}


function exportarReportePro(data) {
    $('#loading-overlay').show();
    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    var jsonData = escapeHtml(JSON.stringify(data));

    var form = $('<form action="' + urlBase + '/exportarPrestamos" method="post">' +
        '<input type="hidden" name="_token" value="' + csrfToken + '" />' +
        '<input type="hidden" name="data" value=\'' + jsonData + '\' />' +
        '</form>');
    $(document.body).append(form);
    form.submit();
    form.remove();
    setTimeout(function () {
        $('#loading-overlay').hide();
    }, 1000);
}


function exportarReportePDF(datos) {
    // var csrfToken = $('meta[name="csrf-token"]').attr('content');
    console.log(datos);
    $.ajax({
        type: 'GET',
        url: urlBase + '/generatePDF',
        data: {
            // _token: csrfToken,
            datos: datos
        },
        success: function (response) {

            var baseUrl = urlBase + '/generatePDF';

            var url = baseUrl + '?' + $.param({ datos: datos });

            var a = document.createElement('a');
            a.href = url;
            a.setAttribute('target', '_blank');
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
        },
        error: function (xhr, status, error) {
            console.error('Error al exportar el PDF:', error);
        }
    });
}


/*
================================================================
DATATABLE PARA LA TABLA DE ELEMENTOS
================================================================
*/

function inicializarTablaPrestamos() {
    var table = $('#tablaReportesPrestamos').DataTable({

        language: textoEspañolTables(),

        initComplete: function (settings, json) {

            $('.tablePrestamos .dataTables_filter input[type="search"]').each(function () {
                var input = $(this);
                var label = input.parent('label');
                input.insertAfter(label);
                label.remove();
            });

            $('.tablePrestamos .dataTables_filter input[type="search"]').attr('type', 'text').attr('placeholder', 'Buscar...');

            var buttonHtml = '<button class="search-button" type="button">' +
                '<svg width="17" height="16" fill="none" xmlns="http://www.w3.org/2000/svg" role="img" aria-labelledby="search">' +
                '<path d="M7.667 12.667A5.333 5.333 0 107.667 2a5.333 5.333 0 000 10.667zM14.334 14l-2.9-2.9" stroke="currentColor" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round"></path>' +
                '</svg>' +
                '</button>';

            $('.tablePrestamos .dataTables_filter ').prepend(buttonHtml);

            var resetButtonHtml = '<button class="reset" type="reset">' +
                '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">' +
                '<path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>' +
                '</svg>' +
                '</button>';

            $('.tablePrestamos .dataTables_filter').append(resetButtonHtml);

            $('.reset').click(function () {
                table.search('').columns().search('').draw();
                $('.tablePrestamos .dataTables_filter input[type="search"]').val('');
            });
        }
    });
}
