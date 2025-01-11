"use strict"



const form = document.querySelector(".lista-form");
const alert = document.querySelector(".alert");
const contenido = document.getElementById("contenido");
const btn_enviar = document.querySelector(".submit-btn");
const lista_html = document.querySelector(".lista-list");
const btn_borrar_todo = document.querySelector(".clear-btn");

function mostrarMensaje(texto, clase) {
    alert.innerText = texto;
    alert.classList.add(clase);
    
    setTimeout(() => {
        alert.innerText = "";
        alert.classList.remove(clase);
    }, 4000);
}

form.addEventListener("submit",
    (evento) => {
        evento.preventDefault();
        const valor = contenido.value.trim();
        
    });

btn_borrar_todo.addEventListener("click",
    () => {
        lista_html.innerHTML="";
        
    });




/*
`<p class="title">${valor}</p>
                                <div class="btn-container">
                                    <button type="button" class="done-btn">
                                        <i class="fas fa-chevron-down"></i>
                                    </button>
                                    <button type="button" class="delete-btn">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>`
*/