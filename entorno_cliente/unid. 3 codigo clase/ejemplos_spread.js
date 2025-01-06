"use strict"

let arr = [1, 2, 3, 4, 5];
let copia = arr;
copia[0] = 25;

console.log(arr);
console.log(copia);

let copia2 = {...arr};
copia2[0] = 24;
console.log(copia2);
console.log(arr);

let objeto = { 
    nombre: 'Juan', 
    edad: 25 
};

let opciones={
    title: 'Título',
    withh: 400,
    heightt: 600,
}
let {heightt:alto, withh:ancho, title:titulo} = opciones;
console.log(alto, ancho, titulo);

 