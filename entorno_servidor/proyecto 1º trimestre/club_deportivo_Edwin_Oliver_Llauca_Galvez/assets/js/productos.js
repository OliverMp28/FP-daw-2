"use strict"

let lista_carrito = []; //lista con lo que se añade al carrito
let lista_muebles; //lista completa de muebles
const alerta = document.querySelector(".alerta");

const carrito = document.querySelector(".cart-overlay");
const cerrar_carrito = document.querySelector(".cart-close");
const carrito_productos = document.querySelector(".cart-items");
const abrir_carrito = document.querySelector(".toggle-cart");

let prueba = "animal";
console.log(prueba);

async function obtenerDatos(url_api){
  const respuesta = await fetch(url_api);

  if(respuesta.ok){
    const datos_json = await respuesta.json();
    const claves = Object.keys(datos_json );
    const lista_muebles =   Object.values(datos_json.data);

    for(let mueble of lista_muebles){
      contenedor.appendChild(crearMueble(mueble));
    }
  }else{
    let respuesta_error = await respuesta.json();
    mostrarMensaje(respuesta_error.error, "danger");
  }

  
}

//NUEVO
//Aqui vamos a recuperar de la api la lista de productos y renderizarlos en la web
const contenedor = document.querySelector(".products-container");
obtenerDatos("muebles_api.php");




//==================FUNCIONES AUXILIARES=====================================================

//FUNCION DEL DOM Y EVENTOS PARA EL INTERFAZ DE LA TIENDA

function crearMueble(producto) {
  //MUEBLE ES UN OBJETO CON ESTE FORMATO
  // {
  //   id: 'rec4f2RIftFCb7aHh',
  //   title: 'albany table',
  //   company: 'marcos',
  //   image:
  //     'https://firebasestorage.googleapis.com/v0/b/chat-7d403.appspot.com/o/muebles%2F01_albany_table.jpg?alt=media&token=fe8f3d8c-27ea-49fb-afbc-cd3a9fd5a07e',
  //   price: 79.99,
  // }

  let nuevo_producto = document.createElement("article");
  nuevo_producto.classList.add("product"); // Asegura que tenga la clase adecuada
  nuevo_producto.dataset.id = producto.id; // Agrega el ID del producto

  nuevo_producto.innerHTML = `
    <div class="product-container">
      <img src="${producto.imagen}" class="product-img img" alt="${producto.nombre}">
      <div class="product-icons">
        <button class="product-cart-btn product-icon" title="Añadir al carrito">
          <i class="bi bi-cart-plus-fill"></i> 
        </button>
      </div>
    </div>
    <footer>
      <h3 class="product-name">${producto.nombre}</h3>
      <p class="product-description">${producto.descripcion}</p>
      <div class="product-info">
        <span class="product-category">Categoría: <strong>${producto.categoria}</strong></span>
        <span class="product-stock ${/*producto.stock > 0 ? "in-stock" : "out-of-stock"*/ "."}">
          ${/*producto.stock > 0 ? `Stock: ${producto.stock} disponibles` : "Agotado"*/ "."}
        </span>
      </div>
      <div class="product-footer">
        <h4 class="product-price">${/*producto.precio.toFixed(2)*/ "."} €</h4>
      </div>
    </footer>
  `;


  let boton_añadir = nuevo_producto.querySelector(".product-cart-btn");
  boton_añadir.addEventListener("click", () => {
    // if (producto.stock > 0) {
    if (true) {
      lista_carrito.push(producto);
      const nuevo_elemento = crearItemCarrito(producto);
      carrito_productos.appendChild(nuevo_elemento);
      localStorage.setItem(carrito_local, JSON.stringify(lista_carrito));

      mostrarMensaje("Producto añadido al carrito", "success");
    } else {
      mostrarMensaje("Producto agotado", "danger");
    }
  });

  return nuevo_producto;
}

//FUNCION DEL DOM Y EVENTOS PARA EL CARRITO

function crearItemCarrito(datos_item) {
  const nuevo_item = document.createElement('article');

  nuevo_item.classList.add('cart-item');
  nuevo_item.setAttribute('data-id', datos_item.id);
  nuevo_item.innerHTML = `
    <img src="${datos_item.image}" class="cart-item-img" alt="${datos_item.title}" />
    <div>
      <h4 class="cart-item-name">${datos_item.title}</h4>
      <p class="cart-item-price">${datos_item.price} €</p>
      <button class="cart-item-remove-btn" data-id="${datos_item.id}">
        Eliminar <i class="bi bi-x-lg"></i> <!-- Ícono corregido -->
      </button>
    </div>`;

  const eliminar=nuevo_item.querySelector(".cart-item-remove-btn");
  eliminar.addEventListener("click",
    ()=>{
      const posicion=lista_carrito.findIndex(item=>item["id"]==datos_item.id);
      lista_carrito.splice(posicion,1);
      localStorage.setItem(carrito_local, JSON.stringify(lista_carrito));
      nuevo_item.remove();
      
    }
  );
  
  return nuevo_item;
}


function mostrarMensaje(texto, clase) {
  alerta.innerHTML = `<h3>${texto}</h3>`;

  alerta.classList.add("show");
  alerta.classList.add(clase);
  // remove alert
  setTimeout(() => {
    alerta.innerText = "";
    alerta.classList.remove(clase);
    alerta.classList.remove("show");
  }, 4000);
}

//CODIGO PARA CARGAR LO QUE HAYA EN EL CARRITO 
const carrito_local = "carrito";

lista_carrito = JSON.parse(localStorage.getItem(carrito_local) ?? "[]");

carrito_productos.innerHTML="";
lista_carrito.forEach((objeto)=>{
  const producto = crearItemCarrito(objeto);
  carrito_productos.appendChild(producto);
});

//CODIGO PARA EL FUNCIONAMIENTO DEL CARRITO

abrir_carrito.addEventListener("click",
  () => {
    carrito.classList.add("show");
  });


cerrar_carrito.addEventListener("click",
  () => {
    carrito.classList.remove("show");
  });

