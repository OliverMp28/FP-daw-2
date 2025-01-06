"use strict";

let formulario = document. getElementById("miFormulario");
let campoTexto = document.getElementById("miCampoTexto");


formulario.addEventListener("submit", 
    (evento)=>{
        let textoValido = validarTexto();
        let checkboxValido = validarCheckbox();
        if(!textoValido || !checkboxValido || !validarSelect() || !validarNumero() || !validarFichero()) {
            evento.preventDefault();
        }
    } 
);

const validarTexto = () => {
    let campoTexto = document.getElementById('miCampoTexto');

    let valor = campoTexto.value.trim();
    let span_error = campoTexto.nextElementSibling;
    if (valor === "") {
        span_error.style.display="inline";
        span_error.textContent = "El campo no puede estar vacío";
        alert("El campo no puede estar vacío");
        return false;
    }
    span_error.style.display="none";
    return true;
  };

const validarCheckbox = () => {
    let checkbox = document.getElementById('miCheckbox');
    if (!checkbox.checked) {
      alert("Debe aceptar los términos");
      return false;
    }
    return true;
};

const validarSelect = () => {
    let select=document.getElementById("miSelect");

    if (select.selectedIndex  === 0) {
      alert("Debe seleccionar una opción");
      return false;
    }
    return true;
}

const validarNumero = () =>{
    let numero = document.getElementById("numberField").value.trim();

    if(isNaN(numero)){
        alert("Introduzca un número valido");
        return false;
    }

    if(numero <1 || numero >100){
        alert("Introduzca un número entre 1 y 100");
        return false;
    }
    return true;
}

const validarFichero = () => {
    let input_fichero = document.getElementById("fileInput");
    let fichero;
    let tipos_admitidos = ["image/png", "image/jpeg"];
    // fichero = input_fichero.files[0];

    // if(fichero){
    //     return true;
    // }else{
    //     alert("No has seleccionado ningun fichero");
    //     return false;
    // }
    if(input_fichero.files.lenght>0){
        fichero = input_fichero.files[0];

        //Objeto file
        if(!tipos_admitidos.includes(fichero.type)){
            alert("Solo se admiten ficheros de tipo PNG o JPEG");
            return false;
        }

        if(fichero.size>2000000){
            alert("El tamaño del fichero es demasiado grande. Maximo 2MB");
            return false;
        }
        return true;
    }
}