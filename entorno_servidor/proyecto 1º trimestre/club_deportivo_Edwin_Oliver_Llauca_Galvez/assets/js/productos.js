"use strict"

let lista_carrito = []; // Lista con lo que se añade al carrito
let lista_productos; // Lista completa de productos
const alerta = document.querySelector(".alerta");

const carrito = document.querySelector(".cart-overlay");
const cerrar_carrito = document.querySelector(".cart-close");
const carrito_productos = document.querySelector(".cart-items");
const abrir_carrito = document.querySelector(".toggle-cart");
const cartItemCount = document.querySelector(".cart-item-count");
// Funcionalidad para Vaciar carro y Tramitar pedido
const btnVaciarCarro = document.querySelector(".btn-vaciar-carro");
const btnTramitarPedido = document.querySelector(".btn-tramitar-pedido");


const contenedor = document.querySelector(".products-container");

// Elementos de paginación
const prevPageBtn = document.querySelector("#prevPage");
const nextPageBtn = document.querySelector("#nextPage");
const pageInfo = document.querySelector("#pageInfo");

const URL_API = "../api/api.php";

let paginaActual = 1;
let totalPaginas = 1;

//esto es para almacenar los filtros actuales
let currentFilters = {};


// Función para construir la query string con filtros y paginación
function buildQueryParams(page) {
  const params = new URLSearchParams();
  params.append("limit", "9");
  params.append("page", page);
  if (currentFilters.nombre) {
    params.append("nombre", currentFilters.nombre);
  }
  if (currentFilters.precio_min) {
    params.append("precio_min", currentFilters.precio_min);
  }
  if (currentFilters.precio_max) {
    params.append("precio_max", currentFilters.precio_max);
  }
  if (currentFilters.categoria) {
    params.append("categoria", currentFilters.categoria);
  }
  return params.toString();
}


async function obtenerDatos(url_api) {
  console.log(url_api);
  const respuesta = await fetch(url_api);
  console.log(respuesta);

  if (respuesta.ok) {
    const datos_json = await respuesta.json();
    lista_productos = datos_json.datos;
    totalPaginas = datos_json.paginacion.paginas;
    paginaActual = datos_json.paginacion.actual;

    // Limpiar contenedor antes de agregar nuevos productos
    contenedor.innerHTML = "";

    // Renderizar productos
    for (let producto of lista_productos) {
      contenedor.appendChild(crearProducto(producto));
    }

    // Actualizar paginación
    actualizarPaginacion();
  } else {
    let respuesta_error = await respuesta.json();
    mostrarMensaje(respuesta_error.error, "danger");
  }
}

function actualizarPaginacion() {
  pageInfo.textContent = `Página ${paginaActual} de ${totalPaginas}`;
  prevPageBtn.disabled = paginaActual === 1;
  nextPageBtn.disabled = paginaActual === totalPaginas;
}

// Manejadores de eventos para paginación
prevPageBtn.addEventListener("click", () => {
  if (paginaActual > 1) {
    const nuevaPagina = paginaActual - 1;
    obtenerDatos(`${URL_API}?${buildQueryParams(nuevaPagina)}`);
  }
});

nextPageBtn.addEventListener("click", () => {
  if (paginaActual < totalPaginas) {
    const nuevaPagina = paginaActual + 1;
    obtenerDatos(`${URL_API}?${buildQueryParams(nuevaPagina)}`);
  }
});


// Manejador de evento para el formulario de filtros
const filtroForm = document.querySelector("#filtroForm");
filtroForm.addEventListener("submit", (e) => {
  e.preventDefault();
  // Actualizar currentFilters con los valores del formulario
  currentFilters = {
    nombre: document.querySelector("#filterNombre").value.trim(),
    precio_min: document.querySelector("#filterPrecioMin").value.trim(),
    precio_max: document.querySelector("#filterPrecioMax").value.trim(),
    categoria: document.querySelector("#filterCategoria").value
  };
  // Reiniciar a la primera página con los filtros aplicados
  obtenerDatos(`${URL_API}?${buildQueryParams(1)}`);
});


//================== OBTENGO LOS DATOS =======================
// Cargar la primera página de productos sin filtros ya que es para la primera carga
obtenerDatos(`${URL_API}?${buildQueryParams(1)}`);
//============================================================



//==================FUNCIONES AUXILIARES=====================================================

//FUNCION DEL DOM Y EVENTOS PARA EL INTERFAZ DE LA TIENDA

function crearProducto(producto) {
  //producto es un objeto con este formato
  // {
//     "id": 19,
//     "nombre": "prueba 1 sin imagen 17",
//     "descripcion": "Proteína en polvo a base de guisante",
//     "precio": "27.99",
//     "stock": 21,
//     "categoria": "Suplementos",
//     "imagen": "http://localhost/FP%20daw%202/entorno_servidor/proyecto%201%c2%ba%20trimestre/club_deportivo_Edwin_Oliver_Llauca_Galvez/api/img/1740243384_563-5636962_imgenes-de-doraemon-con-fondo-transparente-descarga-doraemon.png",
//     "fecha_creacion": "2025-02-22 17:56:24"
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
        <span class="product-stock ${producto.stock > 0 ? "in-stock" : "out-of-stock"}">
          ${producto.stock > 0 ? `Stock: ${producto.stock} disponibles` : "Agotado"}
        </span>
      </div>
      <div class="product-footer">
        <h4 class="product-price">${producto.precio} €</h4>
      </div>
    </footer>
  `;


  let boton_añadir = nuevo_producto.querySelector(".product-cart-btn");
  boton_añadir.addEventListener("click", () => {
    if (producto.stock > 0) {
      lista_carrito.push(producto);
      const nuevo_elemento = crearItemCarrito(producto);
      carrito_productos.appendChild(nuevo_elemento);
      localStorage.setItem(carrito_local, JSON.stringify(lista_carrito));
      updateCartCount(); // Actualiza el contador
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
    <img src="${datos_item.imagen}" class="cart-item-img" alt="${datos_item.nombre}" />
    <div>
      <h4 class="cart-item-name">${datos_item.nombre}</h4>
      <p class="cart-item-price">${datos_item.precio} €</p>
      <button class="cart-item-remove-btn" data-id="${datos_item.id}">
        Eliminar <i class="bi bi-x-lg"></i> <!-- Ícono corregido -->
      </button>
    </div>`;

  const eliminar=nuevo_item.querySelector(".cart-item-remove-btn");
  eliminar.addEventListener("click", 
  () => {
    const posicion = lista_carrito.findIndex(item => item.id == datos_item.id);
    lista_carrito.splice(posicion, 1);
    localStorage.setItem(carrito_local, JSON.stringify(lista_carrito));
    nuevo_item.remove();
    updateCartCount(); // Actualiza el contador tras eliminar
  });
  
  
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
lista_carrito.forEach((objeto) => {
  const producto = crearItemCarrito(objeto);
  carrito_productos.appendChild(producto);
});
updateCartCount();



//CODIGO PARA EL FUNCIONAMIENTO DEL CARRITO

abrir_carrito.addEventListener("click",
  () => {
    carrito.classList.add("show");
  });


cerrar_carrito.addEventListener("click",
  () => {
    carrito.classList.remove("show");
  });

function updateCartCount() {
  cartItemCount.textContent = lista_carrito.length;
}

btnVaciarCarro.addEventListener("click", () => {
  // Vaciar el carrito, limpiar la lista y el DOM, actualizar el localStorage
  lista_carrito = [];
  localStorage.setItem(carrito_local, JSON.stringify(lista_carrito));
  carrito_productos.innerHTML = "";
  updateCartCount();
  mostrarMensaje("Carrito vaciado", "success");
});

btnTramitarPedido.addEventListener("click", () => {
  console.log("pedido tramitado");
  mostrarMensaje("Pedido tramitado", "success");
});

