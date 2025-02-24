"use strict";

// Función que inicializa las validaciones para el formulario de nuevo producto
export function initValidacionesProducto() {
  const formProducto = document.getElementById("nuevoProductoForm");
  if (!formProducto) return; // Si el formulario no existe, salir
  console.log("Iniciando validaciones de productos");

  const nombreProducto = formProducto.querySelector("#nuevoNombre");
  const precioProducto = formProducto.querySelector("#nuevoPrecio");
  const stockProducto = formProducto.querySelector("#nuevoStock");
  const categoriaProducto = formProducto.querySelector("#nuevoCategoria");
  const imagenProducto = formProducto.querySelector("#nuevoImagen");

  // Asignar validaciones en tiempo real
  nombreProducto.addEventListener("input", validarNombreProducto);
  precioProducto.addEventListener("input", validarPrecioProducto);
  stockProducto.addEventListener("input", validarStockProducto);
  categoriaProducto.addEventListener("input", validarCategoriaProducto);
  imagenProducto.addEventListener("change", validarImagenProducto);

  // Validación al enviar el formulario
  formProducto.addEventListener("submit", (evento) => {
    let validaciones = [
      validarNombreProducto,
      validarPrecioProducto,
      validarStockProducto,
      validarCategoriaProducto,
      validarImagenProducto,
    ];
    for (let validar of validaciones) {
      if (!validar()) {
        evento.preventDefault();
        break;
      }
    }
  });
}

const validarNombreProducto = () => {
    console.log("Validando nombre del producto");
  const nombreProducto = document.getElementById("nuevoNombre");
  const valor = nombreProducto.value.trim();
  const span_error = nombreProducto.nextElementSibling;
  const reglaRegular = /^[a-zA-Z0-9\s]+$/; // Letras, números y espacios

  if (!reglaRegular.test(valor)) {
    span_error.style.display = "inline";
    span_error.innerText = "El nombre solo debe contener letras, números y espacios.";
    return false;
  }

  if (valor.length < 4 || valor.length > 50) {
    span_error.style.display = "inline";
    span_error.innerText = "El nombre debe tener entre 4 y 50 caracteres.";
    return false;
  }

  span_error.style.display = "none";
  return true;
};

const validarPrecioProducto = () => {
  const precioProducto = document.getElementById("nuevoPrecio");
  const valor = precioProducto.value.trim();
  const span_error = precioProducto.nextElementSibling;
  const precio = parseFloat(valor);

  if (isNaN(precio) || precio <= 0) {
    span_error.style.display = "inline";
    span_error.innerText = "El precio debe ser un número mayor que 0.";
    return false;
  }

  span_error.style.display = "none";
  return true;
};

const validarStockProducto = () => {
  const stockProducto = document.getElementById("nuevoStock");
  const valor = stockProducto.value.trim();
  const span_error = stockProducto.nextElementSibling;
  const stock = parseInt(valor);

  if (isNaN(stock) || stock < 0) {
    span_error.style.display = "inline";
    span_error.innerText = "El stock debe ser un número entero mayor o igual a 0.";
    return false;
  }

  span_error.style.display = "none";
  return true;
};

const validarCategoriaProducto = () => {
  const categoriaProducto = document.getElementById("nuevoCategoria");
  const valor = categoriaProducto.value.trim();
  const span_error = categoriaProducto.nextElementSibling;
  const categoriasPermitidas = ["Ropa", "Suplementos", "Accesorios"];

  if (!categoriasPermitidas.includes(valor)) {
    span_error.style.display = "inline";
    span_error.innerText = "Seleccione una categoría válida.";
    return false;
  }

  span_error.style.display = "none";
  return true;
};

const validarImagenProducto = () => {
  const imagenProducto = document.getElementById("nuevoImagen");
  const span_error = imagenProducto.nextElementSibling;
  const tiposPermitidos = ["image/jpeg", "image/png"];
  const tamañoMaximo = 5000000; // 5 MB

  if (imagenProducto.files.length === 0) {
    span_error.style.display = "inline";
    span_error.innerText = "Es obligatorio adjuntar una imagen.";
    return false;
  }

  const fichero = imagenProducto.files[0];

  if (!tiposPermitidos.includes(fichero.type)) {
    span_error.style.display = "inline";
    span_error.innerText = "La imagen debe ser en formato JPG, JPEG o PNG.";
    return false;
  }

  if (fichero.size > tamañoMaximo) {
    span_error.style.display = "inline";
    span_error.innerText = "El tamaño del archivo no puede superar los 5 MB.";
    return false;
  }

  span_error.style.display = "none";
  return true;
}

