function conversorUnidDeMedida() {
    let cm = null;

    while(cm === null || isNaN(cm)){
        cm = Number(prompt("Introduce la cantidad de centimetros:"));
        
        if (isNaN(cm) || cm <= 0) {
            alert("El valor introducido no es válido. Debe ser un número positivo.");
        }
    }

    const shaku = cm / 30.3;
    const ken = shaku / 6;

    console.log(`Has introducido ${cm} centimetros, que equivalen a:
    - ${shaku} shaku
    - ${ken} kens`);
  }
  
 
  conversorUnidDeMedida();