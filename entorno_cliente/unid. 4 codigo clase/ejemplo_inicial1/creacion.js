"use strict";

let franquicias = document.querySelectorAll('li');

franquicias.forEach(
    (peli) => {
        peli.addEventListener('click',
            () => {
                peli.after(crearLi("Super-recursividada"));

            }
        );

        peli.addEventListener('mouseleave', () => {
            peli.classList.remove('item_activo');
        });
        
        peli.addEventListener('mouseenter', () => {
            peli.classList.add('item_activo');
        });
        
    }
);

let lista = document.querySelector(".container ul");

document.addEventListener("keypress",
    (e)=>{
        //lista.appendChild(nuevo_li);

        switch(e.key){
            case "i":
                lista.prepend(crearLi("Jussaric world"));
                break;
            case "f":
                lista.append(crearLi("Jussaric world2"));
                break;
        }
    }
)

function crearLi(texto){
    let nuevo_li = document.createElement("li");
    nuevo_li.innerText = texto;
    nuevo_li.classList.add("item");

    nuevo_li.addEventListener("click",
        ()=>{
            nuevo_li.before(crearLi("recursvidad"));
        }
    )

    nuevo_li.addEventListener("mouseenter",
        ()=>{
            nuevo_li.classList.add("item_activo");
        }
    )
    nuevo_li.addEventListener("mouseleave",
        ()=>{
            nuevo_li.classList.remove("item_activo");
        }
    );

    return nuevo_li;
}

