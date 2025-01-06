"use strict";

let contenedor = document.querySelector("div");
// contenedor[0].style.border="10px solid blue";

// //let h1 = document.querySelector("h1");
// let h1 = document.getElementById("cabecera");
// h1.innerText = "aaa HOLA";
// h1.innerHTML += "aaa <em>HOLA</em>";

// let franquicias = document.querySelectorAll(".item");
// franquicias.forEach(franquicia => {
//     franquicia.style.textDecoration="underline";
//     franquicia.classList.remove("item");
//     franquicia.classList.add("item_activo");
// });


//MOVERSE EN EL ARBOL

// contenedor.children[0].innerHTML = "s";
// contenedor.children[1].style.border="10px dotted yellow";

// Array.from(contenedor.children[1].children).forEach(peli => {
//     peli.style.textDecoration="underline";
//     peli.classList.remove("item");
//     peli.classList.add("item_activo");
// });

// contenedor.parentNode.style.background="orange";

// contenedor.children[0].nextElementSibling.style.border="10px solid red";
// contenedor.children[1].previousElementSibling.innerText="10px solid red";



let datos={
    "Matrix":{
        "titulo":"The Matrix",
        "peliculas":4,
        "imagen":"matrix.jpg"
    },
    "StarWars":{
        "titulo":"Star Wars",
        "peliculas":9,
        "imagen":"Star_Wars_Logo.svg"
    },
    "Harry":{
        "titulo":"Harry Potter",
        "peliculas":8,
        "imagen":"Harry_Potter_wordmark.svg"
    },
    "ESDLA":{
        "titulo":"El Señor de los Anillos",
        "peliculas":6,
        "imagen":"One_ring.png"
    },
    "Marvel":{
        "titulo":"Marvel",
        "peliculas":32,
        "imagen":"Marvel_Logo.svg"
    }
}

let franquicias = document.querySelectorAll("li");

franquicias.forEach(
    (peli) => {
        peli.addEventListener("contextmenu", 
            (event) =>{
                event.preventDefault();
                let clave = peli.getAttribute("data-peli");
                //peli.innerHTML="<img width='50px' src='encendida.gif'>";
                if(peli.getAttribute("data-visto") === null){
                    peli.innerHTML=`${datos[clave]["titulo"]}
                        <img width='50px' src='${datos[clave]["imagen"]}'>
                            Tiene ${datos[clave]["peliculas"]} peliculas`;

                    peli.setAttribute("data-visto", "true");
                }else{
                    peli.innerHTML= datos[clave]["titulo"];
                    peli.removeAttribute("data-visto");
                }
            });
    }
);

franquicias.forEach(franquicia => {
    franquicia.addEventListener("click", () => {

        // if(franquicia.style.textDecoration === "none"){
        //     franquicia.style.textDecoration="line-through";
        // }else{
        //     franquicia.style.textDecoration="none";
        // }

        if(franquicia.getAttribute("data-visto")===null){
            franquicia.style.textDecoration="line-through";
            franquicia.setAttribute("data-visto", "true");
        }else{
            franquicia.style.textDecoration="none";
            franquicia.removeAttribute("data-visto");
        }

    });
    franquicia.addEventListener("mouseenter", () => {
        // if(franquicia.classList.contains("item_activo")){
            franquicia.classList.add("item_activo");
        // }else{
        //     franquicia.classList.remove("item");
        //     franquicia.classList.add("item_activo");
        // }
    });
    franquicia.addEventListener("mouseleave", () => {
        // if(franquicia.classList.contains("item_activo")){
            franquicia.classList.remove("item_activo");
        // }else{
        //     franquicia.classList.remove("item");
        //     franquicia.classList.add("item_activo");
        // }
    });
});

