"use strict";

let formularioTestimonio = document.getElementById("miFormulario");
let autorTestimonio = document.getElementById("autorTestimonio");
let contenidoTestimonio = document.getElementById("contenidoTestimonio");

autorTestimonio.addEventListener("change", 
    () => validarAutor()
);
contenidoTestimonio.addEventListener("input", 
    () => validarContenido()
);





formularioTestimonio.addEventListener("submit", (evento) => {
    let validaciones = [validarAutor, validarContenido];

    for (let validar of validaciones) {
        if (!validar()) {
            evento.preventDefault(); 
            break;
        }
    }
});





const validarAutor = () => {
    let valor = autorTestimonio.value.trim();
    let span_error = autorTestimonio.nextElementSibling;

    if (valor === "0") { // "0" es el valor por defecto de la opcion "Seleccionar autor..."
        span_error.style.display = "inline";
        span_error.innerText = "Debes seleccionar un autor.";
        return false;
    }
    span_error.style.display = "none";
    return true;
};

const validarContenido = () => {
    let valor = contenidoTestimonio.value.trim();
    let span_error = contenidoTestimonio.nextElementSibling;

    if (valor === "") {
        span_error.style.display = "inline";
        span_error.innerText = "El contenido del testimonio no puede estar vacío.";
        return false;
    }
    span_error.style.display = "none";
    return true;
};

"use strict";

let formularioTestimonio = document.getElementById("miFormulario");
let autorTestimonio = document.getElementById("autorTestimonio");
let contenidoTestimonio = document.getElementById("contenidoTestimonio");

autorTestimonio.addEventListener("change", 
    () => validarAutor()
);
contenidoTestimonio.addEventListener("input", 
    () => validarContenido()
);





formularioTestimonio.addEventListener("submit", (evento) => {
    let validaciones = [validarAutor, validarContenido];

    for (let validar of validaciones) {
        if (!validar()) {
            evento.preventDefault(); 
            break;
        }
    }
});





const validarAutor = () => {
    let valor = autorTestimonio.value.trim();
    let span_error = autorTestimonio.nextElementSibling;

    if (valor === "0") { // "0" es el valor por defecto de la opcion "Seleccionar autor..."
        span_error.style.display = "inline";
        span_error.innerText = "Debes seleccionar un autor.";
        return false;
    }
    span_error.style.display = "none";
    return true;
};

const validarContenido = () => {
    let valor = contenidoTestimonio.value.trim();
    let span_error = contenidoTestimonio.nextElementSibling;

    if (valor === "") {
        span_error.style.display = "inline";
        span_error.innerText = "El contenido del testimonio no puede estar vacío.";
        return false;
    }
    span_error.style.display = "none";
    return true;
};
