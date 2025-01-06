"use strict";

let formulario = document.getElementById("formularioSocio");
let nombre = document.getElementById("nombreSocio");
let edad = document.getElementById("edadSocio");
let usuario = document.getElementById("usuarioSocio");
let password = document.getElementById("passwordSocio");
let telefono = document.getElementById("telefonoSocio");
let foto = document.getElementById("fotoSocio");


nombre.addEventListener("input", 
    () => validarNombre()
);

edad.addEventListener("input", 
    () => validarEdad()
);
usuario.addEventListener("input", 
() => validarUsuario()
);
password.addEventListener("input", 
() => validarPassword()
);
telefono.addEventListener("input", 
() => validarTelefono()
);
foto.addEventListener("change", 
() => validarFoto()
);




formulario.addEventListener("submit", (evento) => {
    let validaciones = [
        validarNombre,
        validarEdad,
        validarUsuario,
        validarPassword,
        validarTelefono,
        validarFoto,
    ];

    for (let validar of validaciones) {
        if (!validar()) {
            evento.preventDefault(); 
            break;
        }
    }
});



const validarNombre = () => {
    let valor = nombre.value.trim();
    let span_error = nombre.nextElementSibling;
    const reglaRegular = /^[a-zA-Z\s]+$/;

    if (!reglaRegular.test(valor)) {
        span_error.style.display = "inline";
        span_error.innerText = "El nombre debe contener solo letras y espacios.";
        return false;
    }

    if (valor.length < 4 || valor.length > 50) {
        span_error.style.display = "inline";
        span_error.innerText = "El nombre debe tener entre 4 y 50 caracteres.";
        return false;
    }

    span_error.style.display = "none";
    return true;
};


const validarEdad = () => {
    let valor = parseInt(edad.value.trim());
    let span_error = edad.nextElementSibling;

    if (isNaN(valor) || valor < 18) {
        span_error.style.display = "inline";
        span_error.innerText = "La edad debe ser un número mayor o igual a 18.";
        return false;
    }
    span_error.style.display = "none";
    return true;
};

const validarUsuario = () => {
    let valor = usuario.value.trim();
    let span_error = usuario.nextElementSibling;
    const reglaRegular = /^[a-zA-Z][a-zA-Z0-9]{4,19}$/;

    if (!reglaRegular.test(valor)) {
        span_error.style.display = "inline";
        span_error.innerText =
            "El usuario debe comenzar con una letra y tener entre 5 y 20 caracteres (solo letras o números).";
        return false;
    }
    span_error.style.display = "none";
    return true;
};

const validarPassword = () => {
    let valor = password.value.trim();
    let span_error = password.nextElementSibling;
    const reglaRegular = /^[a-zA-Z][a-zA-Z0-9_]{7,15}$/;

    if (!reglaRegular.test(valor)) {
        span_error.style.display = "inline";
        span_error.innerText =
            "La contraseña debe comenzar con una letra, permitir letras, numeros, guiones bajos, y tener entre 8 y 16 caracteres.";
        return false;
    }
    span_error.style.display = "none";
    return true;
};

const validarTelefono = () => {
    let valor = telefono.value.trim();
    let span_error = telefono.nextElementSibling;
    const reglaRegular = /^\+34\d{9}$/;

    if (!reglaRegular.test(valor)) {
        span_error.style.display = "inline";
        span_error.innerText =
            "El teléfono debe ser un número español válido (+34 seguido de 9 dígitos).";
        return false;
    }
    span_error.style.display = "none";
    return true;
};

const validarFoto = () => {
    let span_error = foto.nextElementSibling;
    const tipos_admitidos = ["image/jpeg"];
    const tamaño_maximo = 5000000; // 5 MB

    if (foto.files.length > 0) {
        let fichero = foto.files[0];
        if (!tipos_admitidos.includes(fichero.type)) {
            span_error.style.display = "inline";
            span_error.innerText = "La foto debe estar en formato JPEG.";
            return false;
        }
        if (fichero.size > tamaño_maximo) {
            span_error.style.display = "inline";
            span_error.innerText =
                "El tamaño del archivo no puede superar los 5 MB.";
            return false;
        }
    } else {
        span_error.style.display = "inline";
        span_error.innerText = "Es obligatorio adjuntar una foto.";
        return false;
    }

    span_error.style.display = "none";
    return true;
};
