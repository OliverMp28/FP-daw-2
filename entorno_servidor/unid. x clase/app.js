"use strict";

// function operacion(a,b,op){
//     return new Promise(resolve=>{
//         setTimeout(() => {
//             // console.log(op(a,b));
//             resolve(op(a,b));
//         }, 3000);
//     });

    
// }

// const resolucion=(resultado)=>{
//     console.log(resultado);
// }

// operacion(5,6,(x,y)=>x+y). then(resolucion)

function cargarImagen(url){
    return new Promise((resolve, reject)=>{
        const imagen = new Image();

        setTimeout(() => {
            imagen.style.width = "25%";
            imagen.src = url;
            imagen.onload = resolve(imagen);
            imagen.onerror = reject(new Error("Error al cargar la imagen"));
            // imagen.onload = ()=>resolve(imagen);
            // imagen.onerror = ()=>reject(new Error("Error al cargar la imagen"));
        }, 2000);

    });
}

cargarImagen("https://www.elmueble.com/medio/2023/03/16/gato-himalayo_9cdb4500_230316125054_900x900.jpg")
    .then((imagen)=>{
        document.body.appendChild(imagen);
    } )
    .catch((error)=>{
        console.error(error);
        let imagen_reposicion = document.createElement("img");
        imagen_reposicion.style.width = "25%";
        imagen_reposicion.src = "https://www.freeiconspng.com/uploads/shiny-metal-red-error-image-designs-1.png";
        document.body.appendChild(imagen_reposicion);
    });



