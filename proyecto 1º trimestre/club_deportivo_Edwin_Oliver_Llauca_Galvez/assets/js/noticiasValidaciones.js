"use strict";

let formulario = document.getElementById("miFormulario");
let tituloNoticia = document.getElementById("tituloNoticia");
let contenidoNoticia = document.getElementById("contenidoNoticia");
let imagenNoticia = document.getElementById("imagenNoticia");
let fechaPublicacion = document.getElementById("fechaPublicacion");



tituloNoticia.addEventListener("input", () => {
    validarTitulo();
});

contenidoNoticia.addEventListener("input", () => {
    validarContenido();
});

imagenNoticia.addEventListener("change", () => {
    validarImagen();
});

fechaPublicacion.addEventListener("change", () => {
    validarFecha();
});


formulario.addEventListener("submit", (evento) => {
    let validaciones = [validarTitulo, validarContenido, validarImagen, validarFecha];
    for (let validar of validaciones) {
        if (!validar()) {
            evento.preventDefault(); // Detener el envío si hay errores
            break;
        }
    }
});



const validarTitulo = () => {
    let valor = tituloNoticia.value.trim();
    let span_error = tituloNoticia.nextElementSibling;

    if (valor.length < 3) {
        span_error.style.display = "inline";
        span_error.innerText = "El título debe tener al menos 3 caracteres.";
        return false;
    }

    span_error.style.display = "none";
    return true;
};

const validarContenido = () => {
    let valor = contenidoNoticia.value.trim();
    let span_error = contenidoNoticia.nextElementSibling;

    if (valor.length < 3) {
        span_error.style.display = "inline";
        span_error.innerText = "El contenido debe tener al menos 3 caracteres.";
        return false;
    }

    span_error.style.display = "none";
    return true;
};

const validarImagen = () => {
    let span_error = imagenNoticia.nextElementSibling;
    let fichero = imagenNoticia.files[0];
    const tipos_admitidos = ["image/jpeg"];

    if (!fichero) {
        span_error.style.display = "inline";
        span_error.innerText = "Debe seleccionar una imagen.";
        return false;
    }

    if (!tipos_admitidos.includes(fichero.type)) {
        span_error.style.display = "inline";
        span_error.innerText = "La imagen debe ser en formato JPEG.";
        return false;
    }

    if (fichero.size > 4000000) {
        span_error.style.display = "inline";
        span_error.innerText = "La imagen no debe superar los 5 MB.";
        return false;
    }

    span_error.style.display = "none";
    return true;
};

const validarFecha = () => {
    let span_error = fechaPublicacion.nextElementSibling;
    let valorFecha = new Date(fechaPublicacion.value);
    let fechaActual = new Date();

    // Comprobar si la fecha es válida y posterior a la actual
    if (isNaN(valorFecha.getTime()) || valorFecha <= fechaActual) {
        span_error.style.display = "inline";
        span_error.innerText = "La fecha debe ser posterior a la fecha actual.";
        return false;
    }

    span_error.style.display = "none";
    return true;
};

"use strict";

let formulario = document.getElementById("miFormulario");
let tituloNoticia = document.getElementById("tituloNoticia");
let contenidoNoticia = document.getElementById("contenidoNoticia");
let imagenNoticia = document.getElementById("imagenNoticia");
let fechaPublicacion = document.getElementById("fechaPublicacion");



tituloNoticia.addEventListener("input", () => {
    validarTitulo();
});

contenidoNoticia.addEventListener("input", () => {
    validarContenido();
});

imagenNoticia.addEventListener("change", () => {
    validarImagen();
});

fechaPublicacion.addEventListener("change", () => {
    validarFecha();
});


formulario.addEventListener("submit", (evento) => {
    let validaciones = [validarTitulo, validarContenido, validarImagen, validarFecha];
    for (let validar of validaciones) {
        if (!validar()) {
            evento.preventDefault(); // Detener el envío si hay errores
            break;
        }
    }
});



const validarTitulo = () => {
    let valor = tituloNoticia.value.trim();
    let span_error = tituloNoticia.nextElementSibling;

    if (valor.length < 3) {
        span_error.style.display = "inline";
        span_error.innerText = "El título debe tener al menos 3 caracteres.";
        return false;
    }

    span_error.style.display = "none";
    return true;
};

const validarContenido = () => {
    let valor = contenidoNoticia.value.trim();
    let span_error = contenidoNoticia.nextElementSibling;

    if (valor.length < 3) {
        span_error.style.display = "inline";
        span_error.innerText = "El contenido debe tener al menos 3 caracteres.";
        return false;
    }

    span_error.style.display = "none";
    return true;
};

const validarImagen = () => {
    let span_error = imagenNoticia.nextElementSibling;
    let fichero = imagenNoticia.files[0];
    const tipos_admitidos = ["image/jpeg"];

    if (!fichero) {
        span_error.style.display = "inline";
        span_error.innerText = "Debe seleccionar una imagen.";
        return false;
    }

    if (!tipos_admitidos.includes(fichero.type)) {
        span_error.style.display = "inline";
        span_error.innerText = "La imagen debe ser en formato JPEG.";
        return false;
    }

    if (fichero.size > 4000000) {
        span_error.style.display = "inline";
        span_error.innerText = "La imagen no debe superar los 5 MB.";
        return false;
    }

    span_error.style.display = "none";
    return true;
};

const validarFecha = () => {
    let span_error = fechaPublicacion.nextElementSibling;
    let valorFecha = new Date(fechaPublicacion.value);
    let fechaActual = new Date();

    // Comprobar si la fecha es válida y posterior a la actual
    if (isNaN(valorFecha.getTime()) || valorFecha <= fechaActual) {
        span_error.style.display = "inline";
        span_error.innerText = "La fecha debe ser posterior a la fecha actual.";
        return false;
    }

    span_error.style.display = "none";
    return true;
};
