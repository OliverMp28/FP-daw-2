function ordenarDigitos(num) {
    const numOrdenado = parseInt(num.toString().split("").sort().join(""));
  
    return numOrdenado;
  }
  
  const numero = 84520;
  console.log("numero ordenado: " + ordenarDigitos(numero));