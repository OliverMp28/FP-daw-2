
//http://api.weatherapi.com/v1/current.json?key=027e499e71bf4031b73155522211901&q=Granada


const tabla = document.querySelector("#tiempo_api");
const cargando = document.querySelector("#cargando");
const boton=document.querySelector("#buscar");


boton.addEventListener("click", async ()=>{
  const texto = document.querySelector("#ciudad").value;
  tabla.innerHTML = "";
  
  const url = `http://api.weatherapi.com/v1/current.json?key=027e499e71bf4031b73155522211901&q=${encodeURIComponent(texto)}`;

  try {
    const respuesta = await fetch(url);
    const datos = await respuesta.json();

    //la api devuelve un mensaje al insertar algo que no tiene esperado, por lo que uso la clase error para generar un error
    if (datos.error) {
      throw new Error(datos.error.message);
    }

    const humedad = datos.current.humidity;
    const temperatura = datos.current.temp_c;
    const icono = datos.current.condition.icon;

    const fila = crearFila(humedad, temperatura, icono);
    tabla.appendChild(fila);
  } catch (error) {
    alert("error en tu busqueda: " + error.message);
  } finally {
    cargando.style.display = "none";
  }

});


function crearFila(humedad, temperatura, icono) {
  const fila = document.createElement("tr");
  
  const td_humedad = document.createElement("td");
  td_humedad.classList.add("text-center");
  td_humedad.innerText = humedad+"%";

  const td_temperatura = document.createElement("td");
  td_temperatura.classList.add("text-center");
  td_temperatura.innerText = temperatura+"ºC";


  const imagen = document.createElement("img");
  imagen.src = icono;

  const td_icono = document.createElement("td");
  td_icono.classList.add("text-center");
  td_icono.appendChild(imagen);


 
  fila.appendChild(td_humedad);
  fila.appendChild(td_temperatura);
  fila.appendChild(td_icono);

  return fila;
}