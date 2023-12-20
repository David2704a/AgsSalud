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
        form.action = "{{ url('/excel/procedimiento') }}"; // Cambia la ruta según sea necesario
    } else if (format === 'pdf') {
        form.target = '_blank';
        form.action = "{{ url('/pdf/procedimiento') }}"; // Cambia la ruta según sea necesario
    }




    // Completa el formulario y lo envía
    form.submit();
}
/*
===================
PARA EL REPORTE DE PRESTAMOS
===================
*/
document.getElementById('idResponsableEntrega').addEventListener('change', actualizarTabla);
document.getElementById('idResponsableRecibe').addEventListener('change', actualizarTabla);
document.getElementById('fechaInicio').addEventListener('change', actualizarTabla);
document.getElementById('fechaFin').addEventListener('change', actualizarTabla);
document.getElementById('idProcedimiento').addEventListener('change', actualizarTabla);


/*
===================
PARA EL REPORTE DE ELEMENTOS
====================
*/

document.getElementById('idTipoProcedimiento').addEventListener('change', actualizarTabla);
// Función para actualizar la tabla
function actualizarTabla() {
console.log('Se llamó a actualizarTabla');
/*
===================
PARA EL REPORTE DE PRESTAMOS
===================
*/
var idResponsableEntrega = document.getElementById('idResponsableEntrega').value;
var idResponsableRecibe = document.getElementById('idResponsableRecibe').value;
var fechaInicio = document.getElementById('fechaInicio').value;
var fechaFin = document.getElementById('fechaFin').value;
var idProcedimiento = document.getElementById('idProcedimiento').value;

/*
===================
PARA EL REPORTE DE ELEMENTOS
====================
*/

var idTipoProcedimiento = document.getElementById('idTipoProcedimiento').value


// Recorre las filas de la tabla
var filas = document.querySelectorAll('#miTabla tbody tr');
filas.forEach(function(fila) {
    var cumpleFiltro = true;

    // Lógica de filtrado según los valores seleccionados
    if (idProcedimiento && fila.dataset.idprocedimiento !== idProcedimiento) {
        cumpleFiltro = false;
    }
    if (fechaInicio) {
        var fechaInicioFila = new Date(fila.dataset.fechainicio).getTime();
        var fechaInicioSeleccionada = new Date(fechaInicio).getTime();
        if (fechaInicioFila < fechaInicioSeleccionada) {
            cumpleFiltro = false;
        }
    }
    if (idResponsableEntrega && fila.dataset.idresponsableentrega !== idResponsableEntrega) {
        cumpleFiltro = false;
    }
    if (idResponsableRecibe && fila.dataset.idresponsablerecibe !== idResponsableRecibe) {
        cumpleFiltro = false;
    }

    // Agrega más lógica de filtrado según sea necesario

    // Mostrar u ocultar la fila según si cumple o no con los filtros
    fila.style.display = cumpleFiltro ? '' : 'none';
});
}
