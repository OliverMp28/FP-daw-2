import  {datos} from "./asientos.js";

// Número máximo de asientos permitidos
const MAX_ASIENTOS = 8;

/**
 * Función que se encarga de cargar los eventos de los asientos
 * y de asignarles un comportamiento al hacer click sobre ellos.
 * Además, se encarga de resaltar los asientos al pasar el mouse sobre ellos.
 */
function cargarEventosAsientos() {
    const asientos = document.querySelectorAll('.asiento');
    asientos.forEach(asiento => {
        const idAsiento = asiento.dataset.idasiento; 
        asiento.addEventListener('click', () => seleccionarAsiento(idAsiento));
        asiento.addEventListener('mouseover', () => resaltarAsiento(idAsiento));
        asiento.addEventListener('mouseleave', () => quitarResaltadoAsiento(idAsiento));
    });
}

/**
 * Función que se encarga de resaltar un asiento al pasar el mouse sobre él.
 * @param {*} idAsiento id del asiento
 */
function resaltarAsiento(idAsiento) {
    if (datos[idAsiento].estado === "disponible") {
        document.querySelector(`[data-idAsiento="${idAsiento}"]`).classList.add('resaltado');
        //document.querySelector(`[data-idAsiento="${idAsiento}"]`).style.backgroundColor = 'rgba(201, 198, 111, 0.64)';
    }
}

/**
 * Función que se encarga de quitar el resaltado de un asiento al dejar de pasar el mouse sobre él.
 * @param {*} idAsiento 
 */
function quitarResaltadoAsiento(idAsiento) {
    document.querySelector(`[data-idAsiento="${idAsiento}"]`).classList.remove('resaltado');
}

/**
 * Función que se encarga de seleccionar o deseleccionar un asiento al hacer click sobre él.
 * @param {*} idAsiento  id del asiento
 */
function seleccionarAsiento(idAsiento) {
    let asientosSeleccionados = Object.values(datos).filter(asiento => asiento.estado === "seleccionado").length;
    let asientosReservados = Object.values(datos).filter(asiento => asiento.estado === "reservado").length;
    let totalAsientos = asientosSeleccionados + asientosReservados;

    //verifico si se ha alcanzado el limite de asientos
    if (datos[idAsiento].estado === "disponible") {
        if (totalAsientos >= MAX_ASIENTOS) {
            alert(`No puede seleccionar más de ${MAX_ASIENTOS} asientos. 
            Esto es por seguridad y para evitar la reventa de entradas. 
            Si usted es representante de un centro de estudios o tiene justificación para reservar varios asientos, por favor contáctenos.`);
            return;
        }

        datos[idAsiento].estado = "seleccionado";
        document.querySelector(`[data-idAsiento="${idAsiento}"]`).classList.add('seleccionado');
    } else if (datos[idAsiento].estado === "seleccionado") {
        datos[idAsiento].estado = "disponible";
        document.querySelector(`[data-idAsiento="${idAsiento}"]`).classList.remove('seleccionado');
    }

    actualizarPanelAsientos();
}

/**
 * Función que se encarga de actualizar el panel de asientos seleccionados.
 */
function actualizarPanelAsientos() {
    let totalSeleccionados = 0;
    let precioTotal = 0;
    let tablaResumen = `
        <table>
            <thead>
                <tr>
                    <th>Fila</th>
                    <th>Asiento</th>
                    <th>Zona</th>
                    <th>Precio</th>
                </tr>
            </thead>
            <tbody>
    `;

    for (const id in datos) {
        if (datos[id].estado === "seleccionado") {
            totalSeleccionados++;
            precioTotal += datos[id].precio;
            tablaResumen += `
                <tr>
                    <td>${datos[id].fila}</td>
                    <td>${datos[id].numero}</td>
                    <td>${datos[id].zona}</td>
                    <td>$${datos[id].precio}</td>
                </tr>
            `;
        }
    }

    tablaResumen += `
            </tbody>
        </table>
        <p>Total Asientos Seleccionados: ${totalSeleccionados}</p>
        <p>Precio Total: $${precioTotal}</p>
    `;

    if (totalSeleccionados === 0) {
        document.querySelector('.resultados').innerHTML = `
            <p>Asientos Seleccionados: 0</p>
            <p>No hay asientos seleccionados actualmente.</p>
        `;
    } else {
        document.querySelector('.resultados').innerHTML = tablaResumen;
    }
}

/**
 * Función que se encarga de confirmar la reserva de los asientos seleccionados.
 */
function confirmarReserva() {
    let historialContenido = '';

    for (const id in datos) {
        if (datos[id].estado === "seleccionado") {
            datos[id].estado = "reservado";

            document.querySelector(`[data-idAsiento="${id}"]`).classList.remove('seleccionado');
            document.querySelector(`[data-idAsiento="${id}"]`).style.backgroundColor = 'red';
            document.querySelector(`[data-idAsiento="${id}"]`).style.cursor = 'not-allowed';

            historialContenido += `
                <p>Asiento: ${datos[id].fila}${datos[id].numero}, Zona: ${datos[id].zona}, Precio: $${datos[id].precio}</p>
            `;
        }
    }

    const historialDiv = document.querySelector('.resumen-reservas');
    historialDiv.innerHTML += historialContenido;

   // actualizarPanelAsientos();
    alert('Reserva confirmada');
}

/**
 * Función que se encarga de inicializar la aplicación.
 */
function inicializar() {
    cargarEventosAsientos();
    document.getElementById("boton-reservar").addEventListener("click", confirmarReserva);
}

/**
 * Inicializo la aplicación.
 */
inicializar();