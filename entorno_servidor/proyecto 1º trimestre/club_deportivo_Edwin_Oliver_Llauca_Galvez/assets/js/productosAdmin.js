"use strict"
import { initValidacionesProducto } from "./productosValidaciones.js";
import { mostrarMensaje } from "./utilidades.js";


// let lista_carrito = []; // Lista con lo que se añade al carrito
let lista_productos; // Lista completa de productos
const alerta = document.querySelector(".alerta");

const btnCrearProducto = document.getElementById("crear_producto");

const contenedor = document.querySelector(".tabla-cuerpo");


// Elementos de paginaci
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

btnCrearProducto.addEventListener("click", crearProductoModal);

// Función para construir la query string con filtros y paginación
function construirParametrosUrl(page, filtros = currentFilters) {
  const params = new URLSearchParams();
  params.append("limit", "20");
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


async function obtenerDatos(page, filtros = currentFilters) {
  const url = `${URL_PROCESAR}?${construirParametrosUrl(page, filtros)}`;
  console.log(url);

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

  let fila = document.createElement("tr");
  fila.classList.add("transition");
  fila.dataset.id = producto.id;
  fila.innerHTML = `
    <td class="text-center fw-semibold text-muted">#${producto.id}</td>
    <td>
      <div class="d-flex align-items-center">
        <div class="flex-shrink-0">
          <img src="${producto.imagen}" alt="Producto" class="img-fluid rounded-2" style="width: 50px; height: 50px; object-fit: cover;">
        </div>
        <div class="flex-grow-1 ms-3">
          <span class="fw-semibold">${producto.nombre}</span>
        </div>
      </div>
    </td>
    <td class="d-none d-lg-table-cell text-truncate" style="max-width: 250px;">
      ${producto.descripcion ? producto.descripcion : ''}
    </td>
    <td class="text-success fw-semibold">${producto.precio}€</td>
    <td class="text-center">
      <span class="badge ${producto.stock > 0 ? 'bg-success bg-opacity-25 text-success' : 'bg-danger bg-opacity-25 text-danger'}">${producto.stock}</span>
    </td>
    <td>
      <span>${producto.categoria}</span>
    </td>
    <td class="d-none d-xl-table-cell text-muted small">${producto.fecha_creacion.split(" ")[0]}</td>
    <td class="text-center">
      <div class="botones-acciones-producto d-flex gap-2 justify-content-center">
        <button class="btn btn-sm btn-outline-warning" title="Editar">
          <i class="bi bi-pencil-square"></i>
        </button>
        <button class="btn btn-sm btn-outline-danger" title="Eliminar">
          <i class="bi bi-trash3"></i>
        </button>
        <button class="btn btn-sm btn-outline-info" title="Detalles">
          <i class="bi bi-eye"></i>
        </button>
      </div>
    </td>
  `;

  // Asignar funcionalidades básicas a los botones
  // Dentro de tu función crearProducto (para el admin):
  const btnEditar = fila.querySelector(".btn-outline-warning");
  const btnEliminar = fila.querySelector(".btn-outline-danger");
  const btnDetalles = fila.querySelector(".btn-outline-info");
  

  btnEditar.addEventListener("click", () => {
    editarProductoModal(producto);
  });
  btnEliminar.addEventListener("click", () => {
    eliminarProductoModal(producto);
  });
  btnDetalles.addEventListener("click", () => {
    verDetallesProductoModal(producto);
  });
  


  return fila;
}



//================== MODAL ================================
//esta funcion es para mostrar un modal, es adaptable al contenido, titulo y botones que se le pase
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
      console.log("Botón presionado:", text);
      const modalElement = document.getElementById("generalModal");
      const modalInstance = bootstrap.Modal.getInstance(modalElement);

      //ocultamos el modal y esperamos a que se cierre completamente
      modalInstance.hide();

  
      modalElement.addEventListener("hidden.bs.modal", function handler() {
        //quito el listener para evitar mltiples ejecuciones
        modalElement.removeEventListener("hidden.bs.modal", handler);
        // Ejecutamos la acción (que puede abrir otro modal)
        onClick();
      }, { once: true });
    });
    modalFooter.appendChild(button);
  });

  //Crear y mostrar el modal
  const modalElement = document.getElementById("generalModal");
  const modalInstance = new bootstrap.Modal(modalElement);
  modalInstance.show();
}
// document.getElementById("generalModal").addEventListener('hidden.bs.modal', function () {
//   document.querySelectorAll('.modal-backdrop').forEach(el => el.remove());
// });


function crearProductoModal() {
  const form = document.createElement("form");
  form.id = "nuevoProductoForm";
  // form.action = "procesar.php";
  // form.method = "post";
  form.enctype = "multipart/form-data";
  form.className = "shadow p-4 rounded bg-white mx-auto";
  form.style.maxWidth = "600px";

  form.innerHTML = `
    <h2 class="text-center mb-4">Inserte los datos del nuevo producto</h2>
    <div class="mb-3">
      <label for="nuevoNombre" class="form-label">Nombre:</label>
      <input type="text" class="form-control" id="nuevoNombre" name="nombre" placeholder="Introduce el nombre del producto" required>
      <span class="error"></span>
    </div>
    <div class="mb-3">
      <label for="nuevoDescripcion" class="form-label">Descripción:</label>
      <textarea class="form-control" id="nuevoDescripcion" name="descripcion" placeholder="Introduce la descripción" rows="3"></textarea>
      <span class="error"></span>
    </div>
    <div class="mb-3">
      <label for="nuevoPrecio" class="form-label">Precio (€):</label>
      <input type="number" class="form-control" id="nuevoPrecio" name="precio" placeholder="Introduce el precio" min="0" step="0.01" required>
      <span class="error"></span>
    </div>
    <div class="mb-3">
      <label for="nuevoStock" class="form-label">Stock:</label>
      <input type="number" class="form-control" id="nuevoStock" name="stock" placeholder="Introduce el stock" min="0" required>
      <span class="error"></span>
    </div>
    <div class="mb-3">
      <label for="nuevoCategoria" class="form-label">Categoría:</label>
      <select class="form-select" id="nuevoCategoria" name="categoria" required>
        <option value="Ropa">Ropa</option>
        <option value="Suplementos">Suplementos</option>
        <option value="Accesorios">Accesorios</option>
      </select>
      <span class="error"></span>
    </div>
    <div class="mb-3">
      <label for="nuevoImagen" class="form-label">Imagen:</label>
      <input type="file" class="form-control" id="nuevoImagen" name="imagen" accept=".webp, .jpeg, .png" required>
      <span class="error"></span>
      <div id="previewImagen" class="mt-2"></div>
    </div>
    <div class="d-flex justify-content-between">
      <button type="button" id="cancelarNuevoProducto" class="btn btn-secondary">Cancelar</button>
      <button type="submit" class="btn btn-success">Crear Producto</button>
    </div>
  `;

  // Vista previa de la imagen seleccionada
  form.querySelector("#nuevoImagen").addEventListener("change", function(event) {
    const file = event.target.files[0];
    const preview = form.querySelector("#previewImagen");
    preview.innerHTML = "";
    if (file && (file.type === "image/jpeg" || file.type === "image/png" || file.type === "image/webp")) {
      const img = document.createElement("img");
      img.src = URL.createObjectURL(file);
      img.classList.add("img-fluid", "rounded-2", "mt-2");
      img.style.width = "100px";
      img.style.height = "100px";
      img.style.objectFit = "cover";
      preview.appendChild(img);
    } else {
      preview.innerHTML = '<p class="text-danger small">Formato no válido.</p>';
    }
  });


  showModal({
    title: "Crear Nuevo Producto",
    content: form,
    buttons: [] //No se agregan botones extra en el footer, ya que el formulario incluye sus propios botones.
  });

  //con esto me aseguro de que el modal esté abierto y cargado para llamar a estas funciones
  const modalElement = document.getElementById("generalModal");
  modalElement.addEventListener("shown.bs.modal", () => {
      //evento del boton para cancelar y cerrar el modal
    form.querySelector("#cancelarNuevoProducto").addEventListener("click", function() {
      bootstrap.Modal.getInstance(document.getElementById("generalModal")).hide();
    });

    initValidacionesProducto();
    initEnvioProducto();
  }, { once: true });

}

// function editarProductoModal(producto) {
//   const content = document.createElement("div");
//   content.innerHTML = `
//     <div class="mb-3">
//       <label for="editNombre" class="form-label">Nombre</label>
//       <input type="text" class="form-control" id="editNombre" value="${producto.nombre}">
//     </div>
//     <div class="mb-3">
//       <label for="editDescripcion" class="form-label">Descripción</label>
//       <textarea class="form-control" id="editDescripcion">${producto.descripcion ? producto.descripcion : ''}</textarea>
//     </div>
//     <div class="mb-3">
//       <label for="editPrecio" class="form-label">Precio</label>
//       <input type="number" class="form-control" id="editPrecio" value="${producto.precio}">
//     </div>
//     <div class="mb-3">
//       <label for="editStock" class="form-label">Stock</label>
//       <input type="number" class="form-control" id="editStock" value="${producto.stock}">
//     </div>
//     <div class="mb-3">
//       <label for="editCategoria" class="form-label">Categoría</label>
//       <select class="form-select" id="editCategoria">
//         <option value="Ropa" ${producto.categoria === 'Ropa' ? 'selected' : ''}>Ropa</option>
//         <option value="Suplementos" ${producto.categoria === 'Suplementos' ? 'selected' : ''}>Suplementos</option>
//         <option value="Accesorios" ${producto.categoria === 'Accesorios' ? 'selected' : ''}>Accesorios</option>
//       </select>
//     </div>
//     <div class="mb-3">
//       <label class="form-label">Imagen</label>
//       <div>
//         <img src="${producto.imagen}" class="img-fluid rounded-2" style="width: 100px; height: 100px; object-fit: cover;">
//       </div>
//       <small class="text-muted">La imagen no es editable</small>
//     </div>
//   `;

//   showModal({
//     title: "Editar Producto",
//     content: content,
//     buttons: [
//       { 
//         text: "Cancelar", 
//         className: "btn-secondary", 
//         onClick: () => { 
//           console.log("Edición cancelada"); 
//         } 
//       },
//       { 
//         text: "Guardar Cambios", 
//         className: "btn-primary", 
//         onClick: () => {
//           const updatedProducto = {
//             id: producto.id,
//             nombre: content.querySelector("#editNombre").value,
//             descripcion: content.querySelector("#editDescripcion").value,
//             precio: content.querySelector("#editPrecio").value,
//             stock: content.querySelector("#editStock").value,
//             categoria: content.querySelector("#editCategoria").value,
//             imagen: producto.imagen,
//             fecha_creacion: producto.fecha_creacion
//           };
//           console.log("Producto actualizado:", updatedProducto);
//         } 
//       }
//     ]
//   });
// }

function editarProductoModal(producto) {
  // Crear el formulario de edición
  const form = document.createElement("form");
  form.id = "editarProductoForm";
  form.className = "shadow p-4 rounded bg-white mx-auto";
  form.style.maxWidth = "600px";

  form.innerHTML = `
    <h2 class="text-center mb-4">Editar Producto</h2>
    <div class="mb-3">
      <label for="editNombre" class="form-label">Nombre:</label>
      <input type="text" class="form-control" id="editNombre" name="nombre" value="${producto.nombre}" required>
      <span class="error"></span>
    </div>
    <div class="mb-3">
      <label for="editDescripcion" class="form-label">Descripción:</label>
      <textarea class="form-control" id="editDescripcion" name="descripcion" rows="3">${producto.descripcion ? producto.descripcion : ''}</textarea>
      <span class="error"></span>
    </div>
    <div class="mb-3">
      <label for="editPrecio" class="form-label">Precio (€):</label>
      <input type="number" class="form-control" id="editPrecio" name="precio" value="${producto.precio}" min="0" step="0.01" required>
      <span class="error"></span>
    </div>
    <div class="mb-3">
      <label for="editStock" class="form-label">Stock:</label>
      <input type="number" class="form-control" id="editStock" name="stock" value="${producto.stock}" min="0" required>
      <span class="error"></span>
    </div>
    <div class="mb-3">
      <label for="editCategoria" class="form-label">Categoría:</label>
      <select class="form-select" id="editCategoria" name="categoria" required>
        <option value="Ropa" ${producto.categoria === 'Ropa' ? 'selected' : ''}>Ropa</option>
        <option value="Suplementos" ${producto.categoria === 'Suplementos' ? 'selected' : ''}>Suplementos</option>
        <option value="Accesorios" ${producto.categoria === 'Accesorios' ? 'selected' : ''}>Accesorios</option>
      </select>
      <span class="error"></span>
    </div>
    <div class="mb-3">
      <label class="form-label">Imagen</label>
      <div>
        <img src="${producto.imagen}" class="img-fluid rounded-2" style="width: 100px; height: 100px; object-fit: cover;">
      </div>
      <small class="text-muted">La imagen no es editable</small>
    </div>
    <div class="d-flex justify-content-between">
      <button type="button" id="cancelarEditarProducto" class="btn btn-secondary">Cancelar</button>
      <button type="submit" class="btn btn-primary">Guardar Cambios</button>
    </div>
  `;

  // Mostrar el modal reutilizable con el formulario de edición
  showModal({
    title: "Editar Producto",
    content: form,
    buttons: [] // No agregamos botones extra, el formulario ya los incluye.
  });

  const modalElement = document.getElementById("generalModal");
  modalElement.addEventListener("shown.bs.modal", () => {
    // Evento para el botn "Cancelar"
    form.querySelector("#cancelarEditarProducto").addEventListener("click", () => {
      bootstrap.Modal.getInstance(modalElement).hide();
    });

    form.addEventListener("submit", async (evento) => {
      evento.preventDefault();
      await enviarFormularioEditarProducto(form, producto.id);
    });
  }, { once: true });
}

function eliminarProductoModal(producto) {
  const content = document.createElement("div");
  content.innerHTML = `<p>¿Estás seguro de que deseas eliminar el producto <strong>${producto.nombre}</strong>?</p>`;
  
  showModal({
    title: "Eliminar Producto",
    content: content,
    buttons: [
      { 
        text: "Cancelar", 
        className: "btn-secondary", 
        onClick: () => { 
          console.log("Eliminación cancelada"); 
        } 
      },
      { 
        text: "Eliminar", 
        className: "btn-danger", 
        onClick: () => { 
          enviarFormularioEliminarProducto(producto.id);
        }
      }
    ]
  });
}

function verDetallesProductoModal(producto) {
  const content = document.createElement("div");
  content.innerHTML = `
    <div class="mb-3">
      <img src="${producto.imagen}" class="img-fluid mb-3" alt="${producto.nombre}">
    </div>
    <h3>${producto.nombre}</h3>
    <p>${producto.descripcion ? producto.descripcion : ''}</p>
    <p><strong>Precio:</strong> ${producto.precio} €</p>
    <p><strong>Categoría:</strong> ${producto.categoria}</p>
    <p><strong>Stock:</strong> ${producto.stock}</p>
    <p><strong>Creación:</strong> ${producto.fecha_creacion.split(" ")[0]}</p>
  `;
  
  showModal({
    title: "Detalles del Producto",
    content: content,
    buttons: [
      { 
        text: "Editar", 
        className: "btn-warning", 
        onClick: () => { editarProductoModal(producto); } 
      },
      { 
        text: "Eliminar", 
        className: "btn-danger", 
        onClick: () => { eliminarProductoModal(producto); } 
      },
      { 
        text: "Cerrar", 
        className: "btn-secondary", 
        onClick: () => {} 
      }
    ]
  });
}




//================== VALIDACIONES EN EL FETCH ============================
function initEnvioProducto() {
  const formProducto = document.getElementById("nuevoProductoForm");
  if (!formProducto) return;

  formProducto.addEventListener("submit", async function (evento) {
    evento.preventDefault(); // Evita la recarga de la página


    await enviarFormularioProducto(formProducto);
  });
}


async function enviarFormularioProducto(formProducto) {
  const formData = new FormData(formProducto);

  try {
    const respuesta = await fetch("procesar.php", {
      method: "POST",
      body: formData,
    });

    const resultado = await respuesta.json();

    if (respuesta.ok && resultado.id) {
      // Limpia el formulario
      formProducto.reset();

      //aqui ejecuto un click al boton del formulario ya que al crear un producto se debe actualizar el listado(si se esta viendo los productos filtrados tambien)
      let botonSubmit = document.querySelector('#filtroForm button[type="submit"]');
      botonSubmit.click();

      bootstrap.Modal.getInstance(document.getElementById("generalModal")).hide();

      mostrarMensaje("Producto creado correctamente", "success");
    } else {
      // Si el backend devuelve un error, mostramos el mensaje adecuado
      mostrarMensaje(resultado.error?? "Hubo un error al crear el producto", "danger");
    }
  } catch (error) {
    mostrarMensaje("Error en la conexión con el servidor", "danger");
    console.error("Error al enviar el formulario:", error);
  }
}


async function enviarFormularioEditarProducto(form, productoId) {
  const data = {
    id: productoId,
    nombre: form.querySelector("#editNombre").value,
    descripcion: form.querySelector("#editDescripcion").value,
    precio: parseFloat(form.querySelector("#editPrecio").value),
    stock: parseInt(form.querySelector("#editStock").value, 10),
    categoria: form.querySelector("#editCategoria").value
  };
  console.log("Datos a enviar:", data);

  try {
    const respuesta = await fetch("procesar.php", {
      method: "PUT", // Utilizamos PUT para editar
      headers: {
        "Content-Type": "application/json"
      },
      body: JSON.stringify(data)
    });

    const resultado = await respuesta.json();
    console.log("Respuesta del servidor:", resultado);

    if (respuesta.ok && resultado.datos && resultado.datos.id) {
      // Actualizamos el listado
      const botonSubmit = document.querySelector('#filtroForm button[type="submit"]');
      if (botonSubmit) botonSubmit.click();

      //Cerramos el modal y mostramos el mensaje de éxito
      bootstrap.Modal.getInstance(document.getElementById("generalModal")).hide();
      mostrarMensaje("Producto actualizado correctamente", "success");
    } else {
      mostrarMensaje(resultado.error ?? "Hubo un error al actualizar el producto", "danger");
    }
  } catch (error) {
    mostrarMensaje("Error en la conexión con el servidor", "danger");
    console.error("Error al enviar el formulario de edición:", error);
  }
}


async function enviarFormularioEliminarProducto(productoId) {
  try {
    const respuesta = await fetch("procesar.php", {
      method: "DELETE", 
      headers: {
        "Content-Type": "application/json"
      },
      body: JSON.stringify({ id: productoId })
    });

    const resultado = await respuesta.json();
    console.log("Respuesta del servidor:", resultado);

    if (respuesta.ok && resultado.mensaje) {
      const botonSubmit = document.querySelector('#filtroForm button[type="submit"]');
      if (botonSubmit) botonSubmit.click();

      // Cerramos el modal y mostramos el mensaje de éxito
      bootstrap.Modal.getInstance(document.getElementById("generalModal")).hide();
      mostrarMensaje(resultado.mensaje, "success");
    } else {
      mostrarMensaje(resultado.error ?? "Hubo un error al eliminar el producto", "danger");
    }
  } catch (error) {
    mostrarMensaje("Error en la conexión con el servidor", "danger");
    console.error("Error al eliminar el producto:", error);
  }
}