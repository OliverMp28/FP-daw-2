"use strict"

// 1. Escribir un programa que convierta una cantidad de días a horas minutos y segundos. Usar
// templates para mostrar todos los datos. Si queréis que el usuario introduzca los datos
// ejecutar el código desde la consola del navegador

let dias = parseInt(prompt("Número de días"));

while(isNaN(dias)){
    dias = parseInt(prompt("Introduce un dato válido para el número de días"));
}

const horas = dias * 24;
const minutos = horas * 60;
const segundos = minutos * 60;

console.log(`${dias} días equivalen a ${horas} horas, ${minutos} minutos y ${segundos} segundos`);

// 2. Escriba un programa conversor de centímetros a kens y shakus, unidades japonesas de
// longitud. Un ken son seis shakus y un shaku equivale a 30,3 cm.

let centimetros = parseInt(prompt(`Centímetros a convertir`));

while(isNaN(centimetros)){
    centimetros = parseInt(prompt(`Introduce un dato válido para los centímetros`));
}

let shaku = 30.3;
let ken = shaku*6;
let shakuConv = (centimetros/shaku);

console.log(`${centimetros} centímetros equivalen a ${Math.round(shakuConv*100)/100} shakus y a ${ken} kens`);

// 3. Pedir que un usuario acierte un numero entre 1 y 100 dando pistas usar prompt y ejecutarlo
// en la consola del navegador. Si queréis que el usuario introduzca los datos ejecutar el código
// desde la consola del navegador.

let numRandom = Math.floor(Math.random()*100)+1;
let respuesta = parseInt(prompt(`Intenta adivinar el número del 1 al 100`));
console.log(numRandom);
do{
    if(isNaN(respuesta)){
        respuesta = parseInt(prompt("Introduce un valor válido"));
    } else if(numRandom !== respuesta){
        if(numRandom > respuesta){
            respuesta = parseInt(prompt("Prueba un número más alto"));
        } else {
            respuesta = parseInt(prompt("Prueba un número más bajo"));
        }
    }

    if(numRandom === respuesta) {
        alert("Has acertado");
    }
} while (respuesta !== numRandom);

// 4. Escribir un programa que determine cuando una frase es un palíndromo haciendo 2 
// versiones: una usando bucles y otra usando método/s de String.

//---------------- con bucles

let frase = "Yo hagojyoga hoy";

let array = frase.toLowerCase().split("").filter((item) => item != ' ');

for(let i=0; i<array.length; i++){
  if(array[i] === array[array.length - (1+i)]){
    if(i === array.length-1){
      console.log("Es palindromo");
    } else {
    continue;
  }
  } else {
    console.log("No es palindromo");
    break;
  }
}

//---------------- con metodos String

let frase2 = "Yo hago yogka hoy";
let frasecomp1 = frase2.split("").filter((item) => item != ' ').join("").toLowerCase();
let frasecomp2 = frase2.split("").filter((item) => item != ' ').reverse().join("").toLowerCase();

if(frasecomp1 === frasecomp2){
  console.log("Es palindromo");
} else {
console.log("No es palindromo");
}

// 5. Escribir un programa que dado un string lo muestre, pero con los caracteres ordenados 
// alfabéticamente. Usa split, sort y join.

let frase3 = "Buenos dias";

let array2 = frase3.split("");
array2.sort();

let frasefin = array2.join('').trim();

console.log(frasefin);

// 6. Escribir un programa que dado un string lo muestre, pero con los caracteres en orden 
// inverso. Usa split, reverse y join. 

let frase4 = "Llamame el lunes";

let array3 = frase4.split("");
array3.reverse();

let frasefin2 = array3.join('').trim();

console.log(frasefin2);

// 7. Crear una función que dado un número entero devuelva el mismo número, pero con los 
// dígitos ordenados de menor a mayor. Usa toString, Split, sort join y parseInt

function menorMayor(numero){
    let num = numero.toString();
    let array = num.split('').sort();
    let numFin = parseInt(array.join(''));
    return numFin;
  }
  
  let numero = 4218;
  
  console.log(menorMayor(numero));

// 8. Crear una función que dado un número entero devuelva la suma de sus dígitos. Primero 
// intentarlo con bucles y después usa toString, Split, sort join y parseInt

function sumaDigitos(numero){
    const num = numero.toString();
    const array = num.split("");
    let suma = 0;
    for(let i=0; i<array.length; i++){
      suma += parseInt(array[i]);
    }
    return suma;
  }
  
  let num = 42189;
  
  console.log(sumaDigitos(num));