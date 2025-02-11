"use strict";

let lista_carrito = [];
const alerta = document.querySelector(".alerta");
const contenedor_productos = document.querySelector(".products-container");

const carrito = document.querySelector(".cart-overlay");
const cerrar_carrito = document.querySelector(".cart-close");
const carrito_productos = document.querySelector(".cart-items");
const abrir_carrito = document.querySelector(".toggle-cart");

abrir_carrito.addEventListener("click", () => {
  carrito.classList.add("show");
});

cerrar_carrito.addEventListener("click", () => {
  carrito.classList.remove("show");
});

const carrito_local = "carrito";
//RENDERIZAR EL LOCALSTORAGE DEL CARRITO


//==================FUNCIONES AUXILIARES=====================================================

function crearItemCarrito(datos_item) {
  const nuevo_item = document.createElement("article");

  nuevo_item.classList.add("cart-item");
  nuevo_item.setAttribute("data-id", datos_item.id);
  nuevo_item.innerHTML = `
  <img src="${datos_item.image}"
            class="cart-item-img"
            alt="${datos_item.title}"
          />  
          <div>
            <h4 class="cart-item-name">${datos_item.title}</h4>
            <p class="cart-item-price">${datos_item.price}</p>
            <button class="cart-item-remove-btn" data-id="${datos_item.id}">Eliminar <i class="fas fa-times"></i></button>
          </div>`;
          //BOTON DE ELIMINAR 
  return nuevo_item;
}

const añadir_carrito = document.querySelectorAll(".product-cart-btn");
for(let carrito_boton of añadir_carrito){
    //EVENTO CLICK DEL BOTON AÑADIR AL CARRITO DE CADA PRODUCTO
}

function mostrarMensaje(texto, clase) {
  alerta.innerHTML = `<h3>${texto}</h3>`;

  alerta.classList.add(clase);
  // remove alert
  setTimeout(() => {
    alerta.innerText = "";
    alerta.classList.remove(clase);
  }, 2000);
}
