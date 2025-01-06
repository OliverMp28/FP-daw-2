function sumaDigitosBucle(num) {
    let suma = 0;
    
    while (num > 0) {
      let ultimoDigito = num % 10;
      
      suma += ultimoDigito;
      
      num = parseInt(num / 10);
    }
  
    return suma;
  }
  
  function sumaDigitosConMetodos(num) {
    let digitos = num.toString().split("");
    
    let suma = 0;
  
    for (let i = 0; i < digitos.length; i++) {
      suma += parseInt(digitos[i]); 
    }
  
    return suma;
  }
  
  const numero = 12345;
  console.log("Suma de los digitos metodos: " + sumaDigitosConMetodos(numero));
  console.log("Suma de los digitos con bucles: " + sumaDigitosBucle(numero));