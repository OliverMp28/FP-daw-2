function esPalindromoBucle() {
    const frase = prompt("Intriduce una palabra para ver si es palindromo");
  
    const fraseMinuscula = frase.toLowerCase();
    
    let inicio = 0;
    let fin = fraseMinuscula.length - 1;
  
    while (inicio < fin) {
      if (fraseMinuscula[inicio] !== fraseMinuscula[fin]) {
        console.log("No es un palíndromo.");
        return;
      }
      inicio++;
      fin--;
    }
  
    console.log("Es un palíndromo.");
  }
  

//CON METODOS
  function esPalindromoMetodos() {
    const frase = prompt("Introduce una frase:");
  
    const fraseMinuscula = frase.toLowerCase();
  
    const fraseReversa = fraseMinuscula.split("").reverse().join("");
  
    if (fraseMinuscula === fraseReversa) {
      console.log("Es un palíndromo.");
    } else {
      console.log("No es un palíndromo.");
    }
  }
  

  esPalindromoMetodos();
  esPalindromoBucle();