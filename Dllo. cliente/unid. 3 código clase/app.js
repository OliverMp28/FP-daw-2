"use strict"

// let suma=0;
// productos.forEach(
//     (articulo)=>{
//         // console.log(articulo["nombre"]);
//         // suma+=articulo["precio"];
//         let {precio,nombre}=articulo;
//         console.log(nombre);
//         suma+=precio;
//     }
// );
// console.log(suma);


// console.log(productos.filter(
//                 (articulo)=>articulo["categoria"]==="electronica"
//            ));
// let suma=0;
// productos.filter(
//             (articulo)=>articulo["categoria"]==="electronica"
//          ).forEach((articulo)=>{
//                 let {precio,nombre}=articulo;
//                 console.log(nombre);
//                 suma+=precio;
//         });
// console.log(suma);

productos.sort(
    (b,a)=>a["precio"]-b["precio"]
);

//>0 hay que cambiar su orden relativo
//0
//<0 lo dejamos igual
console.log(productos);
