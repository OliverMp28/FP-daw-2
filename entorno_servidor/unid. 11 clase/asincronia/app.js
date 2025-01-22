"use strict"

function cargarImagen(url){
    return new Promise((resolve,reject)=>{
        const imagen=new Image();
        imagen.style.width="25%";
        imagen.src=url;
        imagen.onload=()=>resolve(imagen);
        imagen.onerror=()=>reject(new Error("No se ha podido cargar la imagen"));
    })
}

//cargarImagen("https://firebasestorage.googleapis.com/v0/b/chat-7d403.appspot.com/o/muebles%2F01_albany_table.jpg?alt=media&token=fe8f3d8c-27ea-49fb-afbc-cd3a9fd5a07e")
cargarImagen("https://images.ctggdgdffassets.net/denf86kkcx7r/4IPlg4Qazd4sFRuCUHIJ1T/f6c71da7eec727babcd554d843a528b8/gatocomuneuropeo-97")
.then((imagen)=>{
    document.body.appendChild(imagen);
})
.catch((error)=>{
    console.log(error)
    const imagen_reposicion=document.createElement("img");
    imagen_reposicion.style.width="50%";
    imagen_reposicion.src="fallback_image.webp";
    document.body.appendChild(imagen_reposicion);
});











//CALLBACK ,  PROMISE

// function operacion(a,b,op){
//     return new Promise(resolve=>{
//         setTimeout(()=>{
//             resolve(op(a,b));
//         },3000);
//     });
// }

// const resolucion=(resultado)=>{
//     console.log(resultado);
// };

// operacion(7,4,(x,y)=>x+y).then(resolucion);
    





//console.log(operacion(7,4,(x,y)=>x+y));






// console.log(operacion(5,6,(x,y)=>x+y));




// let resultado=operacion(5,6,(x,y)=>x+y);
// console.log(resultado);
// resultado=operacion(5,6,(x,y)=>x*y);
// console.log(resultado);
// resultado=operacion(5,6,(x,y)=>x-y);
// console.log(resultado);

// let contador=0;
// document.body.addEventListener("click",
//     ()=>{
//         contador++;
//     })
// console.log(contador);