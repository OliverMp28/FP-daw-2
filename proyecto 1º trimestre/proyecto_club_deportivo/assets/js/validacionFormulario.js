"use strict";

let formulario = document.getElementById("miFormulario");

formulario.addEventListener("submit", (evento) => {
    let tituloValido = validarTitulo();
    let contenidoValido = validarContenido();
    let imagenValida = validarImagen();
    let fechaValida = validarFecha();

    if (!tituloValido || !contenidoValido || !imagenValida || !fechaValida) {
        evento.preventDefault();
    }
});

const validarTitulo = () => {
    let campoTitulo = document.getElementById("tituloNoticia");
    let valor = campoTitulo.value.trim();
    let span_error = campoTitulo.nextElementSibling;

    if (valor === "") {
        span_error.style.display = "inline";
        span_error.textContent = "El titulo no puede estar vacío";
        return false;
    }

    if (valor.length < 3) {
        span_error.style.display = "inline";
        span_error.textContent = "El titulo debe tener al menos 3 caracteres";
        return false;
    }

    span_error.style.display = "none";
    return true;
};

const validarContenido = () => {
    let campoContenido = document.getElementById("contenidoNoticia");
    let valor = campoContenido.value.trim();
    let span_error = campoContenido.nextElementSibling;

    if (valor === "") {
        span_error.style.display = "inline";
        span_error.textContent = "El contenido no puede estar vacío";
        return false;
    }

    if (valor.length < 3) {
        span_error.style.display = "inline";
        span_error.textContent = "El contenido debe tener al menos 3 caracteres";
        return false;
    }

    span_error.style.display = "none";
    return true;
};

const validarImagen = () => {
    let inputImagen = document.getElementById("imagenNoticia");
    let span_error = inputImagen.nextElementSibling;
    //let tipos_admitidos = ["image/png", "image/jpeg"];
    let tipos_admitidos = ["image/jpeg"];
    let maxSize = 5000000; // 5 MB

    if (inputImagen.files.length > 0) {
        let fichero = inputImagen.files[0];

        if (!tipos_admitidos.includes(fichero.type)) {
            span_error.style.display = "inline";
            span_error.textContent = "Solo se admiten imagenes JPEG";
            return false;
        }

        if (fichero.size > maxSize) {
            span_error.style.display = "inline";
            span_error.textContent = "El tamaño del archivo no puede superar los 5MB";
            return false;
        }

        span_error.style.display = "none";
        return true;
    } else {
        span_error.style.display = "inline";
        span_error.textContent = "Debe seleccionar una imagen";
        return false;
    }
};

const validarFecha = () => {
    let campoFecha = document.getElementById("fechaPublicacion");
    let span_error = campoFecha.nextElementSibling;
    let fechaSeleccionada = new Date(campoFecha.value);
    let fechaActual = new Date();
    console.log("FechaActual: " + fechaActual + " o: ");
    console.log("fechaSeleccionada: " + fechaSeleccionada);

    if (isNaN(fechaSeleccionada)) {
        span_error.style.display = "inline";
        span_error.textContent = "Debe seleccionar una fecha valida";
        return false;
    }

    if (fechaSeleccionada <= fechaActual) {
        span_error.style.display = "inline";
        span_error.textContent = "La fecha debe ser posterior a hoy";
        return false;
    }

    span_error.style.display = "none";
    return true;
};
