let numRandom = Math.floor(Math.random()*100)+1;
let respuesta; 
do{
    respuesta= parseInt(prompt(`Intenta adivinar el número del 1 al 100`));;    
    if(respuesta>numRandom){
        alert("Introduce un número más bajo");
    }else if(respuesta<numRandom){
        alert("Introduce un número más alto");
    }
} while (respuesta !== numRandom);
alert("Enhorabuena lo has acertado");