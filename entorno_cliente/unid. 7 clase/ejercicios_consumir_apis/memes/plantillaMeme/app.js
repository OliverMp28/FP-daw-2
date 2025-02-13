const apiURL = "https://api.imgflip.com/get_memes";
const translateAPI = "https://api.mymemory.translated.net/get?q=";

const btnAleatorio = document.getElementById("ale");
const btnBuscar = document.getElementById("meme");
const busqueda = document.getElementById("busqueda");
const contenedorAPI = document.getElementById("contenedor_api");
const cargandoEl = document.getElementById("cargando");

cargandoEl.style.display = "none";

//aca traduzxco
const traducirTexto = async (texto, from = "en", to = "es") => {
  try {
    const response = await fetch(
      `${translateAPI}${encodeURIComponent(texto)}&langpair=${from}|${to}`
    );
    const data = await response.json();
    return data.responseData.translatedText || texto;
  } catch (error) {
    console.error("Error en la traducción:", error);
    return texto;
  }
};

//esta funcion me da todos los memes pero dentro lo filtro por uno que sea aleatorio
const getRandomMeme = async () => {
  cargandoEl.style.display = "block";
  try {
    const response = await fetch(apiURL);
    if (!response.ok) {
      throw new Error("Error al obtener los memes");
    }
    const data = await response.json();
    if (!data.success) {
      throw new Error("Error en la respuesta de la API de Imgflip");
    }
    const memes = data.data.memes;
    const randomIndex = Math.floor(Math.random() * memes.length);
    const meme = memes[randomIndex];

    const nombreOriginal = meme.name;
    const nombreTraducido = await traducirTexto(nombreOriginal, "en", "es");

    const row = document.createElement("tr");
    row.innerHTML = `
      <td>${nombreOriginal}</td>
      <td>${nombreTraducido}</td>
      <td><img src="${meme.url}" alt="${nombreOriginal}" style="max-width: 150px;"></td>
    `;
    contenedorAPI.appendChild(row);
  } catch (error) {
    console.error("Error al obtener el meme:", error);
    alert("Hubo un error al obtener el meme. Intenta de nuevo.");
  } finally {
    cargandoEl.style.display = "none";
  }
};

//aca hago la busqueda
const searchMeme = async () => {
  const searchTerm = busqueda.value.trim();
  if (!searchTerm) {
    alert("Por favor, ingresa un término para buscar.");
    return;
  }
  cargandoEl.style.display = "block";
  try {
    const response = await fetch(apiURL);
    if (!response.ok) {
      throw new Error("Error al obtener los memes");
    }
    const data = await response.json();
    if (!data.success) {
      throw new Error("Error en la respuesta de la API de Imgflip");
    }
    const memes = data.data.memes;
    // Limpiar resultados anteriores
    contenedorAPI.innerHTML = "";

    const filteredMemes = memes.filter((meme) =>
      meme.name.toLowerCase().includes(searchTerm.toLowerCase())
    );

    if (filteredMemes.length === 0) {
      contenedorAPI.innerHTML = `<tr><td colspan="3">No se encontraron memes que coincidan con "${searchTerm}".</td></tr>`;
      return;
    }

    for (const meme of filteredMemes) {
      const nombreOriginal = meme.name;
      const nombreTraducido = await traducirTexto(nombreOriginal, "en", "es");
      const row = document.createElement("tr");
      row.innerHTML = `
        <td>${nombreOriginal}</td>
        <td>${nombreTraducido}</td>
        <td><img src="${meme.url}" alt="${nombreOriginal}" style="max-width: 150px;"></td>
      `;
      contenedorAPI.appendChild(row);
    }
  } catch (error) {
    console.error("Error al buscar memes:", error);
    alert("Hubo un error al buscar memes. Intenta de nuevo.");
  } finally {
    cargandoEl.style.display = "none";
  }
};

btnAleatorio.addEventListener("click", getRandomMeme);
btnBuscar.addEventListener("click", searchMeme);
