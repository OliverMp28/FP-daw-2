const API_KEY = "8c5f5e48585cfc67af7b8261"; // Reemplaza con tu API key
const BASE_URL = `https://v6.exchangerate-api.com/v6/${API_KEY}`;

const btnIntercambiar = document.getElementById("intercambiar");
const btnTransformar = document.getElementById("ver");
const inputDinero = document.getElementById("dinero");
const selectEntrada = document.getElementById("divisa_entrada");
const selectSalida = document.getElementById("divisa_salida");
const contenedorApi = document.getElementById("contenedor_api");
const cargandoEl = document.getElementById("cargando");

cargandoEl.style.display = "none";

const intercambiarDivisas = () => {
  const temp = selectEntrada.value;
  selectEntrada.value = selectSalida.value;
  selectSalida.value = temp;
};

btnIntercambiar.addEventListener("click", intercambiarDivisas);

const transformarDinero = async () => {
  // Obtenemos los valores ingresados
  const monto = inputDinero.value;
  const monedaOrigen = selectEntrada.value;
  const monedaDestino = selectSalida.value;

  // Validamos que se hayan ingresado todos los datos
  if (!monto || !monedaOrigen || !monedaDestino) {
    alert("Por favor, ingresa la cantidad, la moneda de origen y la moneda de destino.");
    return;
  }

  // Mostramos el indicador de carga
  cargandoEl.style.display = "block";

  // Construimos la URL para el endpoint Pair Conversion
  const url = `${BASE_URL}/pair/${monedaOrigen}/${monedaDestino}/${monto}`;

  try {
    const response = await fetch(url);
    if (!response.ok) {
      throw new Error("Error en la solicitud a la API.");
    }

    const data = await response.json();

    // Verificamos que la respuesta sea exitosa
    if (data.result !== "success") {
      throw new Error(`Error en la conversión: ${data["error-type"]}`);
    }

    // Extraemos los datos de conversión
    const conversionResult = data.conversion_result;
    // const conversionRate = data.conversion_rate;

    const row = document.createElement("tr");
    row.innerHTML = `
      <td>${data.base_code}</td>
      <td>${data.target_code}</td>
      <td>${monto}</td>
      <td>${conversionResult}</td>
    `;

    // Agregamos la fila al contenedor de la tabla
    contenedorApi.appendChild(row);
  } catch (error) {
    console.error("Error al transformar el dinero:", error);
    alert("Error al transformar el dinero: " + error.message);
  } finally {
    // Ocultamos el indicador de carga
    cargandoEl.style.display = "none";
  }
};

btnTransformar.addEventListener("click", transformarDinero);
