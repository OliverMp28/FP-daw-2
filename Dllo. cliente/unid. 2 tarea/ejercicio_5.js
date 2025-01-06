function ordenarAlfabeticamente() {
    const frase = prompt("Introduce una frase");
  
    const fraseOrdenada = frase.split("").sort().join("");
  
    console.log("Frase con caracteres ordenados es: " + fraseOrdenada);
  }
  
  ordenarAlfabeticamente();