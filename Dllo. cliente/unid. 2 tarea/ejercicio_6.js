function invertirCaracteres() {
    const frase = prompt("Introduce una frase");
  
    const fraseInvertida = frase.split("").reverse().join("");
  
    console.log("frase con caracteres en orden inverso: " + fraseInvertida);
  }
  
  invertirCaracteres();