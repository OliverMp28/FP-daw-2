"use strict";

let formularioCita = document.getElementById("formularioCita");
let socioCita = document.getElementById("socioCita");
let servicioCita = document.getElementById("servicioCita");
let fechaCita = document.getElementById("fechaCita");
let horaCita = document.getElementById("horaCita");


socioCita.addEventListener("change", 
() => validarSocio()
);
servicioCita.addEventListener("change", 
() => validarServicio()
);
fechaCita.addEventListener("input", 
() => validarFecha()
);
horaCita.addEventListener("input", 
() => validarHora()
);


formularioCita.addEventListener("submit", (evento) => {
    let validaciones = [validarSocio, validarServicio, validarFecha, validarHora];

    for (let validar of validaciones) {
        if (!validar()) {
            evento.preventDefault();
            break;
        }
    }
});


const validarSocio = () => {
    let valor = socioCita.value.trim();
    let span_error = socioCita.nextElementSibling;

    if (valor === "0") { // "0" es el valor por defecto de la opción "Seleccionar cliente..."
        span_error.style.display = "inline";
        span_error.innerText = "Debes seleccionar un socio.";
        return false;
    }
    span_error.style.display = "none";
    return true;
};

const validarServicio = () => {
    let valor = servicioCita.value.trim();
    let span_error = servicioCita.nextElementSibling;

    if (valor === "0") { // "0" es el valor por defecto de la opción "Seleccionar servicio..."
        span_error.style.display = "inline";
        span_error.innerText = "Debes seleccionar un servicio.";
        return false;
    }
    span_error.style.display = "none";
    return true;
};

const validarFecha = () => {
    let valor = fechaCita.value.trim();
    let span_error = fechaCita.nextElementSibling;
    let fecha_actual = new Date();
    let fecha_input = new Date(valor);

    if (fecha_input <= fecha_actual) {
        span_error.style.display = "inline";
        span_error.innerText = "La fecha debe ser posterior a la fecha actual.";
        return false;
    }
    span_error.style.display = "none";
    return true;
};

const validarHora = () => {
    let valor = horaCita.value.trim();
    let span_error = horaCita.nextElementSibling;

    if (valor === "") {
        span_error.style.display = "inline";
        span_error.innerText = "La hora no puede estar vacia.";
        return false;
    }
    span_error.style.display = "none";
    return true;
};
