"use strict";

// Selección de elementos del formulario
let formularioServicio = document.getElementById("formularioServicio");
let descripcionServicio = document.getElementById("descripcionServicio");
let duracionServicio = document.getElementById("duracionServicio");
let precioServicio = document.getElementById("precioServicio");



descripcionServicio.addEventListener("input", () => {
    validarDescripcion();
});

duracionServicio.addEventListener("input", () => {
    validarDuracion();
});

precioServicio.addEventListener("input", () => {
    validarPrecio();
});


// Evento para validar todo el formulario al enviar
formularioServicio.addEventListener("submit", (evento) => {
    let validaciones = [validarDescripcion, validarDuracion, validarPrecio];
    for (let validar of validaciones) {
        if (!validar()) {
            evento.preventDefault(); 
            break;
        }
    }
});




const validarDescripcion = () => {
    let valor = descripcionServicio.value.trim();
    let span_error = descripcionServicio.nextElementSibling;

    if (valor.length < 3 || valor.length > 50) {
        span_error.style.display = "inline";
        span_error.innerText =
            "La descripción debe tener entre 3 y 50 caracteres.";
        return false;
    }

    span_error.style.display = "none";
    return true;
};

const validarDuracion = () => {
    let valor = parseInt(duracionServicio.value.trim());
    let span_error = duracionServicio.nextElementSibling;

    if (isNaN(valor) || valor < 15) {
        span_error.style.display = "inline";
        span_error.innerText = "La duracion debe ser al menos de 15 minutos.";
        return false;
    }

    span_error.style.display = "none";
    return true;
};

const validarPrecio = () => {
    let valor = parseInt(precioServicio.value.trim());
    let span_error = precioServicio.nextElementSibling;

    if (isNaN(valor) || valor <= 0) {
        span_error.style.display = "inline";
        span_error.innerText = "El precio debe ser mayor o igual a 0.";
        return false;
    }

    span_error.style.display = "none";
    return true;
};
