"use strict"

/*
document.addEventListener("click", 
    ()=>{
        document.title="Titulo modificado con js";
        document.body.style.backgroundColor = "lightblue";

        let div_caja = document.getElementById("caja");
        div_caja.innerHTML+="<img src='encendida.gif'>"; 
    }
);

let primera = document.getElementById("primera");
primera.src="encendida.gif";
primera.style.width="200px";
primera.style.border="5px dashed blue"

let titulo = document.querySelector("h1");
titulo.classList.add("borde_rojo");
titulo.classList.add("fondo_cyan");
titulo.innerHTML="Ejemplo de <em> DWEC</em>";
*/

let titulos = document.querySelectorAll("h1");
titulos[0].innerText = "Lo he echo con js";

titulos[0].addEventListener("selectstart", (evento)=>{
    evento.preventDefault();
})
titulos[0].addEventListener("mouseenter", ()=>{
    titulos[0].classList.add("borde_verde");
})
titulos[0].addEventListener("mouseleave", ()=>{
    titulos[0].classList.remove("borde_verde");
});



let contenido = document.querySelectorAll("img");
console.log(contenido);
contenido.forEach(imagen=>{
    imagen.addEventListener("contextmenu", 
        (evento)=>{evento.preventDefault();}
    );
    imagen.addEventListener("click", ()=>{
        imagen.style.border = "4px dotted orange";
        imagen.src = "encendida.gif";
        imagen.style.borderRadius="50%";
    });
    imagen.addEventListener("mouseleave", ()=>{
        imagen.style.borderColor = "purple";
        imagen.style.borderStyle= "dashed";
    });
});




// //contenido[2].src = "encendida.gif";
// for(let imagen of contenido){
//     imagen.style.border = "4px dotted orange";
// }

// contenido.forEach(imagen => {
//     imagen.src = "encendida.gif";
// });

// for(let i=0; i<contenido.length; i++){
//     contenido[i].style.borderRadius="50%";
// };

