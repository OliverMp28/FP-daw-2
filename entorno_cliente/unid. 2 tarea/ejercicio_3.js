function adivinarNumero() {
    const numeroRandom = Math.floor(Math.random() * 100) + 1;
    let numeroUsuario = null;
    
    while (numeroUsuario !== numeroRandom) {
      numeroUsuario = parseInt(prompt("Introduce un numero entre 1 y 100:"), 10);
  
      if (isNaN(numeroUsuario) || numeroUsuario < 1 || numeroUsuario > 100) {
        console.log("Error, introduce un numero entre 1 y 100.");
        return;
      }
  
      if (numeroUsuario < numeroRandom) {
        console.log("El numero secreto es mayor.");
      } else if (numeroUsuario > numeroRandom) {
        console.log("El numero secreto es menor.");
      } else {
        console.log(`Felicidades! el número secreto era ${numeroRandom}.`);
      }
    }
  }
  
  adivinarNumero();
  