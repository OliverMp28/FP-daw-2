/*Escribir un programa que convierta una cantidad de días a horas minutos y segundos. Usar 
templates para mostrar todos los datos. Si queréis que el usuario introduzca los datos 
ejecutar el código desde la consola del navegador.*/

/*
Se solicita al usuario que introduzca un número de días a través de un cuadro de diálogo (prompt).
La función prompt devuelve un valor de tipo cadena (string), por lo que se usa Number() para convertirlo a número.
*/
let dias = parseInt(prompt("Introduce el número de días:"));
/*
Se verifica si el valor introducido es un número válido y si es mayor que 0.
isNaN(dias) devuelve true si dias NO es un número, por lo que usamos ! (NOT) para invertirlo. 
Así, la condición comprueba que dias sea un número y mayor que 0.
*/ 

if (!isNaN(dias) && dias > 0){
   
   
   
    let horas = dias * 24;
    let minutos = horas * 60;
    let segundos = minutos * 60;
    
    console.log(` 
    Dias: ${dias}
    Horas: ${horas}
    Minutos: ${minutos}
    Segundos: ${segundos}
    `);




    
} else {
    console.log("Error: Introduce un número válido.");
}

