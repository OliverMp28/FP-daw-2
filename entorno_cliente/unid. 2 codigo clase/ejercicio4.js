let frase="Anita lava la tina";

frase=frase.toLowerCase().replaceAll(" ","");

invertida=frase.split("").reverse().join("");

if(frase===invertida){
    console.log("Es un palindromo");
}else{
    console.log("No es un palindromo");
}



