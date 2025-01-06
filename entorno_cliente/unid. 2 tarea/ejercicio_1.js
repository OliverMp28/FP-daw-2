"use strict"

function convertirDias() {
    let dias = null;

    while(dias === null || isNaN(dias)){
        dias = parseInt(prompt("Introduce la cantidad de días:"));
        
        if (isNaN(dias) || dias <= 0) {
            alert("El valor introducido no es válido. Debe ser un número entero positivo.");
        }
    }

    const horas = dias * 24;
    const minutos = horas * 60;
    const segundos = minutos * 60;

    console.log(`Has introducido ${dias} días, que equivalen a:
    - ${horas} horas
    - ${minutos} minutos
    - ${segundos} segundos`);
  }
  
 
  convertirDias();
  