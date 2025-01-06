"use strict"

let datos=[];

const form=document.getElementById("formu");
const nombre=document.getElementById("nom");
const apellidos=document.getElementById("ape");
const edad=document.getElementById("edad");

const boton=document.getElementById("guardar");
const div_info=document.getElementById("info");

form.addEventListener("submit",
    (evento) => {
        evento.preventDefault();
        let valor_nombre=nombre.value.trim();
        let valor_apellidos=apellidos.value.trim();
        let valor_edad=parseInt(edad.value.trim());
        
        form.reset();
    });

