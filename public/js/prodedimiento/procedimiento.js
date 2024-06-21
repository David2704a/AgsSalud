$(document).ready(function(){
    inicializarTablaPrestamos()
});

/*
================================================
FUNCION PARA EL CAMBIO DE PARTES DEL FORM
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
===================================================================
FUNCION PARA FILTAR LOS ELEMENTOS SEGUN EL TIPO DE PROCEDIMIENTO
===================================================================
*/

var originalSelectHtml = $('#idElemento').html();
function traerElementosSinUsuario(){
    var tipoProcedimiento = $('#idTipoProcedimiento').val();
    if($('#idTipoProcedimiento').val() == 3) {

        $('.selectEntregaTodos').hide();
        $('.selectEntregaTecnico').show();

        $('.selectRecibeTecnico').hide();
        $('.selectRecibeTodos').show();



        $.ajax({
            url: '/traerElementosSinUsuarios',
            type: 'GET',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                tipoProcedimiento: tipoProcedimiento
            },
            success: function (data) {

                $('#idElemento').empty();
                $('#idElemento').append('<option value="">Seleccione un elemento</option>');
                $.each(data, function (key, value) {
                    $('#idElemento').append('<option value="' + value.idElemento + '">' + value.id_dispo + ' ' +value.nombre + '</option>');
                });
            },
            error: function (data) {
                console.log('Error en la petición:', data);
            }
        });
    } else {
        $('.selectEntregaTodos').show();
        $('.selectEntregaTecnico').hide();
        $('.selectRecibeTecnico').show();
        $('.selectRecibeTodos').hide();
        $('#idElemento').html(originalSelectHtml);
    }
}

// $('#idTipoProcedimiento').change(traerElementosSinUsuario);

/*
===================================================================
FUNCION PARA INICIALIZAR EL DATATABLE DE LA TABLA DE PROCEDIMIENTOS
===================================================================
*/


function inicializarTablaPrestamos() {
    var table = $('#tablaProcedimientosIN').DataTable({

        language: textoEspañolTables(),

        initComplete: function (settings, json) {

            $('.tableProcedimientosIn .dataTables_filter input[type="search"]').each(function () {
                var input = $(this);
                var label = input.parent('label');
                input.insertAfter(label);
                label.remove();
            });

            $('.tableProcedimientosIn .dataTables_filter input[type="search"]').attr('type', 'text').attr('placeholder', 'Buscar...');

            var buttonHtml = '<button class="search-button" type="button">' +
                '<svg width="17" height="16" fill="none" xmlns="http://www.w3.org/2000/svg" role="img" aria-labelledby="search">' +
                '<path d="M7.667 12.667A5.333 5.333 0 107.667 2a5.333 5.333 0 000 10.667zM14.334 14l-2.9-2.9" stroke="currentColor" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round"></path>' +
                '</svg>' +
                '</button>';

            $('.tableProcedimientosIn .dataTables_filter ').prepend(buttonHtml);

            var resetButtonHtml = '<button class="reset" type="reset">' +
                '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">' +
                '<path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>' +
                '</svg>' +
                '</button>';

            $('.tableProcedimientosIn .dataTables_filter').append(resetButtonHtml);

            $('.reset').click(function () {
                table.search('').columns().search('').draw();
                $('.tableProcedimientosIn .dataTables_filter input[type="search"]').val('');
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
