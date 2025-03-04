"use strict"
import { mostrarMensaje } from "./utilidades.js";


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

// const URL_API = "../api/api.php";
const URL_PROCESAR = "procesar.php";

let paginaActual = 1;
let totalPaginas = 1;

//esto es para almacenar los filtros actuales
let currentFilters = {};
let filtros = {};


// Función para construir la query string con filtros y paginación
function construirParametrosUrl(page, filtros = currentFilters) {
  const params = new URLSearchParams();
  params.append("limit", "5");
  params.append("page", page);
  if (filtros.nombre) {
    params.append("nombre", filtros.nombre);
  }
  if (filtros.precio_min) {
    params.append("precio_min", filtros.precio_min);
  }
  if (filtros.precio_max) {
    params.append("precio_max", filtros.precio_max);
  }
  if (filtros.categoria) {
    params.append("categoria", filtros.categoria);
  }
  return params.toString();
}


// async function obtenerDatos(url_api) {
//   console.log(url_api);
//   const respuesta = await fetch(url_api);
//   console.log(respuesta);

//   if (respuesta.ok) {
//     const datos_json = await respuesta.json();
//     lista_productos = datos_json.datos;
//     totalPaginas = datos_json.paginacion.paginas;
//     paginaActual = datos_json.paginacion.actual;

//     // Limpiar contenedor antes de agregar nuevos productos
//     contenedor.innerHTML = "";

//     // Renderizar productos
//     for (let producto of lista_productos) {
//       contenedor.appendChild(crearProducto(producto));
//     }

//     // Actualizar paginación
//     actualizarPaginacion();
//   } else {
//     let respuesta_error = await respuesta.json();
//     mostrarMensaje(respuesta_error.error, "danger");
//   }
// }

async function obtenerDatos(page, filtros = currentFilters) {
  const url = `${URL_PROCESAR}?${construirParametrosUrl(page, filtros)}`;

  try {
    const respuesta = await fetch(url);
    if (respuesta.status === 404) {
      mostrarMensaje("No hay productos encontrados", "warning");
      return; 
    }
    
    const datos_json = await respuesta.json();

    if (!respuesta.ok) throw new Error(datos_json.error);

    lista_productos = datos_json.datos;
    totalPaginas = datos_json.paginacion.paginas;
    paginaActual = datos_json.paginacion.actual;

    contenedor.innerHTML = "";
    lista_productos.forEach(producto => contenedor.appendChild(crearProducto(producto)));

    actualizarPaginacion();
  } catch (error) {
    mostrarMensaje("Error: " + error.message, "danger");
  }
}

function actualizarPaginacion() {
  pageInfo.textContent = `Página ${paginaActual} de ${totalPaginas}`;
  prevPageBtn.disabled = paginaActual === 1;
  nextPageBtn.disabled = paginaActual === totalPaginas;
}

// Manejadores de eventos para paginación
// prevPageBtn.addEventListener("click", () => {
//   if (paginaActual > 1) {
//     const nuevaPagina = paginaActual - 1;
//     obtenerDatos(`${URL_API}?${construirParametrosUrl(nuevaPagina)}`);
//   }
// });

// nextPageBtn.addEventListener("click", () => {
//   if (paginaActual < totalPaginas) {
//     const nuevaPagina = paginaActual + 1;
//     obtenerDatos(`${URL_API}?${construirParametrosUrl(nuevaPagina)}`);
//   }
// });
prevPageBtn.addEventListener("click", () => {
  if (paginaActual > 1) obtenerDatos(paginaActual - 1);
});

nextPageBtn.addEventListener("click", () => {
  if (paginaActual < totalPaginas) obtenerDatos(paginaActual + 1);
});


// Manejador de evento para el formulario de filtros
const filtroForm = document.querySelector("#filtroForm");

filtroForm.addEventListener("submit", (e) => {
  e.preventDefault();
  // Actualizar usar filtros con los valores del formulario
  filtros = {
    nombre: document.querySelector("#filterNombre").value.trim(),
    precio_min: document.querySelector("#filterPrecioMin").value.trim(),
    precio_max: document.querySelector("#filterPrecioMax").value.trim(),
    categoria: document.querySelector("#filterCategoria").value
  };
  obtenerDatos(1, filtros);
});


//================== OBTENGO LOS DATOS =======================
// Cargar la primera pagina por defecto al cargar
obtenerDatos(1);
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
    <footer style='cursor: pointer'>
      <h3 class="product-name">${producto.nombre}</h3>
      <p class="product-description text-limited">${producto.descripcion}</p>
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

  let ver_mas = nuevo_producto.querySelector("footer");
  ver_mas.addEventListener("click", () => mostrarProductoEnModal(producto));

  let boton_añadir = nuevo_producto.querySelector(".product-cart-btn");
  boton_añadir.addEventListener("click", () => agregarProductoAlCarrito(producto));

  return nuevo_producto;
}

//funci para agregar un producto al carrito con control de stock
function agregarProductoAlCarrito(producto) {
  //se cuenta cuantas veces el producto esta en el carrito
  let cantidadEnCarrito = lista_carrito.filter(item => item.id === producto.id).length;

  if (cantidadEnCarrito >= producto.stock) {
    mostrarMensaje("No puedes agregar más de este producto, stock agotado.", "danger");
    return;
  }

  // Agregar producto al carrito
  lista_carrito.push(producto);
  carrito_productos.appendChild(crearItemCarrito(producto));
  localStorage.setItem(carrito_local, JSON.stringify(lista_carrito));
  actualizarCartCount();
  mostrarMensaje("Producto añadido al carrito", "success");
}


//FUNCION DEL DOM Y EVENTOS PARA EL CARRITO

function crearItemCarrito(datos_item) {
  const nuevo_item = document.createElement("article");
  nuevo_item.classList.add("cart-item");
  nuevo_item.setAttribute("data-id", datos_item.id);

  nuevo_item.innerHTML = `
    <img src="${datos_item.imagen}" class="cart-item-img" alt="${datos_item.nombre}" />
    <div>
      <h4 class="cart-item-name">${datos_item.nombre}</h4>
      <p class="cart-item-price">${datos_item.precio} €</p>
      <button class="cart-item-remove-btn" data-id="${datos_item.id}">
        Eliminar <i class="bi bi-x-lg"></i>
      </button>
    </div>
  `;

  const btnEliminar = nuevo_item.querySelector(".cart-item-remove-btn");
  btnEliminar.addEventListener("click", () => eliminarProductoDelCarrito(datos_item, nuevo_item));

  return nuevo_item;
}
function eliminarProductoDelCarrito(producto, elementoCarrito) {
  const index = lista_carrito.findIndex(item => item.id === producto.id);
  if (index !== -1) {
    lista_carrito.splice(index, 1);
    localStorage.setItem(carrito_local, JSON.stringify(lista_carrito));
    elementoCarrito.remove();
    actualizarCartCount();
  }
}



//CODIGO PARA CARGAR LO QUE HAYA EN EL CARRITO 
const carrito_local = "carrito";

lista_carrito = JSON.parse(localStorage.getItem(carrito_local) ?? "[]");

carrito_productos.innerHTML="";
lista_carrito.forEach((objeto) => {
  const producto = crearItemCarrito(objeto);
  carrito_productos.appendChild(producto);
});
actualizarCartCount();



//CODIGO PARA EL FUNCIONAMIENTO DEL CARRITO

abrir_carrito.addEventListener("click",
  () => {
    carrito.classList.add("show");
  });


cerrar_carrito.addEventListener("click",
  () => {
    carrito.classList.remove("show");
  });

//esto se encargara de cerrar el carrito si se da click fuera
carrito.addEventListener("click", (e) => {
  if (e.target === carrito) {
    carrito.classList.remove("show");
  }
});

function actualizarCartCount() {
  cartItemCount.textContent = lista_carrito.length;
}

btnVaciarCarro.addEventListener("click", () => {
  showModal({
    title: "Vaciar Carrito",
    content: "¿Está seguro de que desea vaciar su carrito de compras?",
    buttons: [
      { text: "Cancelar", className: "btn-secondary", onClick: () => {} },
      {
        text: "Aceptar",
        className: "btn-primary",
        onClick: () => {
          lista_carrito = [];
          localStorage.setItem(carrito_local, JSON.stringify(lista_carrito));
          carrito_productos.innerHTML = "";
          actualizarCartCount();
          mostrarMensaje("Carrito vaciado", "success");
        }
      }
    ]
  });
});

btnTramitarPedido.addEventListener("click", () => {
  showModal({
    title: "Tramitar Pedido",
    content: "¿Está seguro de que desea tramitar el pedido?",
    buttons: [
      { text: "Cancelar", className: "btn-secondary", onClick: () => {} },
      {
        text: "Aceptar",
        className: "btn-primary",
        onClick: async () => {
          // Agrupamos los productos del carrito para obtener la cantidad de cada uno
          const productosAgrupadosDelCarrito = agruparProductosDelCarrito();
          let errorAlActualizar = false;

          // Iteramos por cada producto único en el carrito
          for (const idProducto in productosAgrupadosDelCarrito) {
            const { producto, cantidadEnCarrito } = productosAgrupadosDelCarrito[idProducto];
            // Calculamos el nuevo stock: stock actual menos la cantidad pedida
            const nuevoStock = producto.stock - cantidadEnCarrito;
            try {
              const resultadoActualizacion = await actualizarStockProducto(producto.id, nuevoStock);

              if (!resultadoActualizacion.datos || resultadoActualizacion.error) {
                mostrarMensaje(
                  resultadoActualizacion.error || `Error al actualizar el producto con ID ${producto.id}`,
                  "danger"
                );
                errorAlActualizar = true;
              } else {
                console.log("Producto actualizado:", resultadoActualizacion);
              }
            } catch (error) {
              mostrarMensaje("Error en la conexión con el servidor", "danger");
              console.error("Error al actualizar producto:", error);
              errorAlActualizar = true;
            }
          }

          // Si todas las actualizaciones fueron exitosas, vaciamos el carrito y mostramos el mensaje
          if (!errorAlActualizar) {
            console.log("Pedido tramitado");
            mostrarMensaje("Pedido tramitado", "success");
            lista_carrito = [];
            localStorage.setItem(carrito_local, JSON.stringify(lista_carrito));

            let botonSubmit = document.querySelector('#filtroForm button[type="submit"]');
            botonSubmit.click();

            carrito_productos.innerHTML = "";
            actualizarCartCount();
          }
        }
      }
    ]
  });
});

// Función que envía la actualización de stock de un producto al backend
async function actualizarStockProducto(productoId, nuevoStock) {
  const datosAEnviar = {
    id: productoId,
    stock: nuevoStock
  };

  try {
    const respuesta = await fetch("procesar.php", {
      method: "PUT",
      headers: {
        "Content-Type": "application/json"
      },
      body: JSON.stringify(datosAEnviar)
    });
    return await respuesta.json();
  } catch (error) {
    throw error;
  }
}

/**
 * Función que agrupa los productos del carrito para saber cuantas unidades se han pedido de cada producto
 * 
 */
function agruparProductosDelCarrito() {
  const productosAgrupados = {};

  for (const producto of lista_carrito) {
    if (!productosAgrupados[producto.id]) {
      productosAgrupados[producto.id] = {
        producto: producto,
        cantidadEnCarrito: 0
      };
    }
    productosAgrupados[producto.id].cantidadEnCarrito++;
  }

  return productosAgrupados;
}




//================== MODAL ================================

function showModal({ title, content, buttons = [] }) {
  const modalTitle = document.getElementById("generalModalLabel");
  const modalBody = document.getElementById("generalModalBody");
  const modalFooter = document.getElementById("generalModalFooter");

  modalTitle.textContent = title;

  // Configurar el cuerpo del modal
  modalBody.innerHTML = ""; // Limpiamos contenido anterior
  if (typeof content === "string") {
    modalBody.innerHTML = content;
  } else {
    modalBody.appendChild(content); // Si es un nodo HTML, lo agregamos
  }

  // Configurar los botones en el footer
  modalFooter.innerHTML = ""; 
  buttons.forEach(({ text, className, onClick }) => {
    const button = document.createElement("button");
    button.textContent = text;
    button.className = `btn ${className}`;
    button.addEventListener("click", () => {
      onClick();
      bootstrap.Modal.getInstance(document.getElementById("generalModal")).hide();
    });
    modalFooter.appendChild(button);
  });

  //Crear y mostrar el modal
  const modalElement = document.getElementById("generalModal");
  const modalInstance = new bootstrap.Modal(modalElement);
  modalInstance.show();
}


function mostrarProductoEnModal(producto) {
  const contenido = document.createElement("div");
  contenido.innerHTML = `
    <img src="${producto.imagen}" class="img-fluid mb-3" alt="${producto.nombre}">
    <h3>${producto.nombre}</h3>
    <p>${producto.descripcion}</p>
    <p><strong>Precio:</strong> ${producto.precio} €</p>
    <p><strong>Categoría:</strong> ${producto.categoria}</p>
    <p><strong>Stock:</strong> ${producto.stock > 0 ? producto.stock + " disponibles" : "Agotado"}</p>
  `;

  showModal({
    title: "Detalles del Producto",
    content: contenido,
    buttons: [
      { text: "Cerrar", className: "btn-secondary", onClick: () => {} },
      {
        text: "Añadir al Carrito",
        className: "btn-success",
        onClick: () => {
          if (producto.stock > 0) {
            lista_carrito.push(producto);
            const nuevo_elemento = crearItemCarrito(producto);
            carrito_productos.appendChild(nuevo_elemento);
            localStorage.setItem(carrito_local, JSON.stringify(lista_carrito));
            actualizarCartCount();
            mostrarMensaje("Producto añadido al carrito", "success");
          } else {
            mostrarMensaje("Producto agotado", "danger");
          }
        }
      }
    ]
  });
}

