"use strict"

let formulario = document.getElementById("miFormulario");
let campoTexto = document.getElementById('miCampoTexto');
let checkbox = document.getElementById('miCheckbox');
let select = document.getElementById("miSelect");
let numero = document.getElementById("numberField");
let input_ficheros = document.getElementById("fileInput");

campoTexto.addEventListener("input",
    ()=>{
        validarTexto();
    }
)

numero.addEventListener("input",
    ()=>{
        validarNumero();
    }
)

checkbox.addEventListener("change",
    ()=>{
        validarCheckbox();
    });

select.addEventListener("change",
    ()=>{
        validarSelect();
    });

input_ficheros.addEventListener("change",
    ()=>{
        validarFichero();
    }
)


formulario.addEventListener("submit",
    (evento) => {
        let validaciones = [validarTexto, validarCheckbox, validarSelect, validarNumero, validarFichero];
        for (let validar of validaciones) {
            if (!validar()) {
                evento.preventDefault(); // Detiene el envío si hay errores
                break;
            }
        }
         
    });


const validarTexto = () => {
    

    let valor = campoTexto.value.trim();
    let span_error = campoTexto.nextElementSibling;
    if (valor === "") {
        span_error.style.display = "inline";
        span_error.innerText = "El campo nombre no puede estar vacío";
        return false;
    }
    span_error.style.display = "none";
    return true;
};

const validarCheckbox = () => {
    

    let span_error = checkbox.parentNode.nextElementSibling;

    if (!checkbox.checked) {
        span_error.style.display = "inline";
        span_error.innerText = "Debe aceptar los términos";
        return false;
    }
    span_error.style.display = "none";
    return true;
};

const validarSelect = () => {
    

    let span_error = select.nextElementSibling;
    if (select.selectedIndex === 0) {
        span_error.style.display = "inline";
        span_error.innerText = "Debe seleccionar una opción válida";
        return false;
    }
    span_error.style.display = "none";

    return true;
}

const validarNumero = () => {
    
    let valor_numero = parseInt(numero.value.trim());

    let span_error = numero.nextElementSibling;

    if (isNaN(valor_numero)) {
        span_error.style.display = "inline";
        span_error.innerText = "Hay que escribir solo números";
        return false;
    }

    if (valor_numero < 1 || valor_numero > 100) {
        span_error.style.display = "inline";
        span_error.innerText = "Debe estar entre 1 y 100";

        return false;
    }
    span_error.style.display = "none";

    return true;
}


const validarFichero = () => {
    
    let fichero;
    const tipos_admitidos = ["image/png", "image/jpeg"];

    let span_error = input_ficheros.nextElementSibling;


    if (input_ficheros.files.length > 0) {
        fichero = input_ficheros.files[0];
        //Objeto file
        if (!tipos_admitidos.includes(fichero.type)) {
            span_error.style.display = "inline";
            span_error.innerText = "No es un tipo de imagen admitida";
            return false;
        }

        if (fichero.size > 2000000) {
            span_error.style.display = "inline";
            span_error.innerText = "Supera el tamaño maximo permitido";
            return false;
        }
    } else {
        span_error.style.display = "inline";
        span_error.innerText = "Es obligatorio adjuntar una imagen";
        return false;
    }

    span_error.style.display = "none";

    return true;

}



