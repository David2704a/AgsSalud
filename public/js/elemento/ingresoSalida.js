$('#fechaInicioIngreso').on('change', function () {
    var fechaInicioIngreso = $('#fechaInicioIngreso').val();
    $('#duracionDesde').val(fechaInicioIngreso);
})

$(document).ready(function () {
    inicializarTablaElementsFil();

})


$('#btnTraerElementosfiltrados').on('click', function () {
    var idUsuario = $('#idUserAutorizado').val();
    var datosElementos = [];

    $('#TableDescripcionEquipos tbody tr').each(function () {
        var idElemento = $(this).find('.inputsAgregadosss').val();
        if (idElemento) {
            var elemento = {
                idElemento: idElemento
            };
            datosElementos.push(elemento);
        }
    });
    $.ajax({
        type: 'GET',
        url: urlBase + '/traerElementosfiltrados',
        data: {
            idUsuario: idUsuario,
            datosElementos: datosElementos.length > 0 ? datosElementos : null
        },
        success: function (response) {
            $('#tableElementsModal').DataTable().destroy();
            $('#tableElementsModal tbody').empty();
            $.each(response, function (index, dato) {
                $('#tableElementsModal tbody').append(
                    '<tr>' +
                    '<td>' + dato.id_dispo + '</td>' +
                    '<td>' + dato.nombre + '</td>' +
                    '<td> <button class="btn btn-success btnBajarDatosElm" type="button"> <div class="rellenoIcon"><i class="fa-solid fa-arrow-down"></i></div> </button> </td>' +
                    '<input type="hidden" class="idElementoTableFil" value="' + dato.idElemento + '">' +
                    '</tr>'
                );
            });

            inicializarTablaElementsFil();
        }
    });
});

$(document).ready(function () {
    function actualizarIDs() {
        $('#TableDescripcionEquipos tbody tr').each(function (index, row) {
            var contador = index + 1;
            $(row).find('.input-container.inputsAgregados label').attr('for', 'descripcionIngreso_' + contador).text('DESCRIPCIÓN:');
            $(row).find('.inputsAgregadoss').attr('id', 'descripcion_equipo_ingreso' + contador).attr('name', 'descripcion_equipo_ingreso' + contador);
            $(row).find('inputsAgregadosss').attr('id', 'id_elemento' + contador);
        });
    }

    $('#tableElementsModal').on('click', '.btnBajarDatosElm', function () {
        var idElemento = $(this).closest('tr').find('.idElementoTableFil').val();

        $.ajax({
            type: 'GET',
            url: urlBase + '/traerDatosElementoFil',
            data: {
                idElemento: idElemento,
            },
            success: function (response) {
                var rowCount = $('#TableDescripcionEquipos tbody tr').length;

                if (rowCount >= 5) {
                    alertSwitch('error', 'Unicamente es posible hacer ingreso y/o salida a 5 equipos a la vez.');
                    return;
                }

                var contador = rowCount + 1;

                $('#TableDescripcionEquipos tbody').append(
                    '<tr>' +
                    '<td>' +
                    '<div class="input-container inputsAgregados">' +
                    '<label for="descripcionIngreso_' + contador + '">DESCRIPCIÓN:</label>' +
                    '<input class="inputsAgregadoss" type="text" id="descripcion_equipo_ingreso' + contador + '" name="descripcion_equipo_ingreso' + contador + '">' +
                    '<input class="inputsAgregadosss" type="hidden" id="id_elemento' + contador + '" value="' + response.idElemento + '">' +
                    '</div>' +
                    '</td>' +
                    '<td>' + (response.marca ? response.marca : 'NO REGISTRA') + '</td>' +
                    '<td>' + (response.modelo ? response.modelo : 'NO REGISTRA') + '</td>' +
                    '<td>' + (response.serial ? response.id_dispo : 'NO REGISTRA') + '</td>' +
                    '<td>' + (response.estado ? response.estado : 'NO REGISTRA') + '</td>' +
                    '<td>' + '<button type="button" class="btn btn-danger btn-sm btnBorrarFila"><i class="fa-solid fa-xmark"></i></button>' + '</td>' +
                    '</tr>'
                );
                $('#modalFormSalidaIn').modal('hide');
            }
        });
    });

    $('#TableDescripcionEquipos').on('click', '.btnBorrarFila', function () {
        var row = $(this).closest('tr');
        row.remove();
        actualizarIDs();
    });
});


$('#btnGenerarInforme').on('click', function () {
    var csrfToken = $('meta[name="csrf-token"]').attr('content');

    var motivoIngreso = $('input[name="motivo_ingreso"]:checked').val();
    var descripcionIngreso = $('#descripcionIngreso').val();
    var fechaInicioIngreso = $('#fechaInicioIngreso').val();
    var fechaFinSalida = $('#fechaFinSalida').val();
    var horaInicioIngreso = $('#horaInicioIngreso').val();
    var prestamo = $('input[name="prestamo"]:checked').val();
    var idUserAutoriza = $('#idUserAutoriza').val();
    var idUserAutorizado = $('#idUserAutorizado').val();
    var idElemento = $('#idElementoIngresoS').val();

    const data = {
        idUserAutorizado: idUserAutorizado,
        idUserAutoriza: idUserAutoriza,
        idElemento: idElemento,
        fechaInicioIngreso: fechaInicioIngreso,
        fechaFinSalida: fechaFinSalida,
        'prestamo': prestamo,
        horaInicioIngreso: horaInicioIngreso,
        descripcionIngreso: descripcionIngreso,
        'motivoIngreso': motivoIngreso
    }

    let contador = 5;

    for (let i = 2; i <= contador; i++) {
        let id_elemento = $('#id_elemento' + i).val();
        if (id_elemento) {
            data['id_elemento_' + i] = id_elemento;
        }
    }
    for (let i = 2; i <= contador; i++) {
        let descripcion = $('#descripcion_equipo_ingreso' + i).val();
        if (descripcion) {
            data['descripcion_equipo_ingreso_' + i] = descripcion;
        }
    }

    $(document).ready(function () {
        /*
        VALIDACIÓN PARA EL INPUT FECHA INICIO
        */
        $('#fechaInicioIngreso').on('change', function () {
            if ($(this).val()) {
                $(this).removeClass('input-error').addClass('input-success');
            } else {
                $(this).removeClass('input-valid').addClass('input-error');
                alertSwitch('error', 'Debes ingresar una Fecha de Salida');
            }
        });
        $('#fechaInicioIngreso').on('blur', function () {
            $(this).removeClass('input-error input-success');
        });


        /*
        VALIDACIÓN PARA EL INPUT DE HORA INICIO
        */
        $('#horaInicioIngreso').on('change', function () {
            if ($(this).val()) {
                $(this).removeClass('input-error').addClass('input-success');
            } else {
                $(this).removeClass('input-valid').addClass('input-error');
                alertSwitch('error', 'Debes ingresar una Fecha de Salida');
            }
        });
        $('#horaInicioIngreso').on('blur', function () {
            $(this).removeClass('input-error input-success');
        });

        /*
        VALIDACIÓN PARA LOS CHECKS DE PRESTAMO
        */

        $('input[name="prestamo"]').change(function () {
            if ($(this).val()) {
                $('.checkbox-container').removeClass('input-error');
            } else {
                $('.checkbox-container').addClass('input-error');
                alertSwitch('error', 'Debes ingresar una Fecha de Salida');
            }

        });
        $('input[name="prestamo"]').on('blur', function () {
            $(this).removeClass('input-error input-success');
        });

        /*
        VALIDACIÓN PRA LOC CHECKS DE MOTIVO DE INFRESO
        */

        $('input[name="motivo_ingreso"]').change(function () {
            if ($(this).val()) {
                $('.checkbox-container').removeClass('input-error');
            } else {
                $('.checkbox-container').addClass('input-error');
                alertSwitch('error', 'Debes ingresar una Fecha de Salida');
            }

        });
        $('input[name="motivo_ingreso"]').on('blur', function () {
            $(this).removeClass('input-error input-success');
        });
    });

    
    if (!data['fechaInicioIngreso']) {
        $('#fechaInicioIngreso').focus();
        $('#fechaInicioIngreso').addClass('input-error');
        alertSwitch('error', 'Debes Ingresar una Fecha de Salida')
    } else if (!data['horaInicioIngreso']) {
        $('#horaInicioIngreso').focus();
        $('#horaInicioIngreso').addClass('input-error');
        alertSwitch('error', 'Debes Ingresar una Hora de Salida')
    } else if (!data['prestamo']) {
        $('.checkbox-container').addClass('input-error');
        alertSwitch('error', 'Debe Seleccionar si es un Prestamo o no')
    } else if (!data['motivoIngreso']) {
        $('.checkbox-containerMotivo').addClass('input-error');
        alertSwitch('error', 'Debe Seleccionar un Motivo de Ingreso y/o Salida')
    } else if (!data['descripcionIngreso']) {
        alertSwitch('error', 'Debe Ingresar una descripción al Equipo/Accesorio')
    }
    else {
        $.ajax({
            type: 'POST',
            url: urlBase + '/guardarDatosInforme',
            data: {
                datos: data,
                _token: csrfToken,
            },
            success: function (response) {
                alertSwitch('success', 'Datos del Informe Guardados con Éxito');

                if (response.mensaje) {
                    alertSwitch('error', response.mensaje);
                } else {
                    window.open(urlBase + '/viewpdf/' + response.id, '_blank');
                    alertSwitch('success', 'Datos del Informe Guardados con Éxito');

                    $('#descripcionIngreso').val('');
                    $('#fechaInicioIngreso').val('');
                    $('#fechaFinSalida').val('');
                    $('#horaInicioIngreso').val('');
                    $('#duracionDesde').val('');
                    $('input[name="prestamo"]').prop('checked', false);
                    $('input[name="motivo_ingreso"]').prop('checked', false);
                }

            },
            error: function (error) {
                console.error(error);
                var errorMessage = error.responseJSON && error.responseJSON.error ? error.responseJSON.error : 'Error desconocido';
                alertSwitch('error', errorMessage);
            }
        });

    }

})



function inicializarTablaElementsFil() {
    var table = $('#tableElementsModal').DataTable({

        language: textoEspañolTables(),
        // ordering: false,

        initComplete: function (settings, json) {

            $('.tableContainerElements .dataTables_filter input[type="search"]').each(function () {
                var input = $(this);
                var label = input.parent('label');
                input.insertAfter(label);
                label.remove();
            });

            $('.tableContainerElements .dataTables_filter input[type="search"]').attr('type', 'text').attr('placeholder', 'Buscar...');

            var buttonHtml = '<button class="search-button" type="button">' +
                '<svg width="17" height="16" fill="none" xmlns="http://www.w3.org/2000/svg" role="img" aria-labelledby="search">' +
                '<path d="M7.667 12.667A5.333 5.333 0 107.667 2a5.333 5.333 0 000 10.667zM14.334 14l-2.9-2.9" stroke="currentColor" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round"></path>' +
                '</svg>' +
                '</button>';

            $('.tableContainerElements .dataTables_filter ').prepend(buttonHtml);

            var resetButtonHtml = '<button class="reset" type="reset">' +
                '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">' +
                '<path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>' +
                '</svg>' +
                '</button>';

            $('.tableContainerElements .dataTables_filter').append(resetButtonHtml);

            $('.reset').click(function () {
                table.search('').columns().search('').draw();
                $('.tableContainerElements .dataTables_filter input[type="search"]').val('');
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


// document.getElementById('door').addEventListener('mouseenter', function () {
//     this.classList.add('open');
// });

// document.getElementById('door').addEventListener('mouseleave', function () {
//     this.classList.remove('open');
// });
