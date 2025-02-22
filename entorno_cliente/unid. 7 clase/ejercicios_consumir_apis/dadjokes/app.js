const url = "https://icanhazdadjoke.com/";

const btn = document.querySelector(".btn");
const resultado = document.querySelector(".result");

const searchInput = document.querySelector(".searchTerm");
const searchBtn = document.querySelector(".btnSearch");

// Función para obtener un chiste aleatorio
const obtenerChistesDePapa = async () => {
  resultado.textContent = "Procesando...";

  try {
    const response = await fetch(url, {
      headers: {
        Accept: "application/json",
        "User-Agent": "Edwin Oliver de atlantida",
      },
    });

    if (!response.ok) {
      throw new Error("Hubo un error, actualiza o verifica el codigo!");
    }

    const data = await response.json();
    resultado.textContent = data.joke;
  } catch (error) {
    resultado.textContent = "Hubo un error..";
    console.error("Error al obtener el chiste de la API:", error);
  }
};

btn.addEventListener("click", obtenerChistesDePapa);



// Función para buscar chistes según un término
const buscarChiste = async () => {
  const term = searchInput.value.trim();

  if (!term) {
    resultado.textContent = "Por favor ingresa un término para buscar.";
    return;
  }

  resultado.textContent = "Carganding...";

  try {
    const searchUrl = `https://icanhazdadjoke.com/search?term=${encodeURIComponent(term)}`;
    const response = await fetch(searchUrl, {
      headers: {
        Accept: "application/json",
        "User-Agent": "Edwin Oliver de atlantida",
      },
    });

    if (!response.ok) {
      throw new Error("Hubo un error en la búsqueda!");
    }

    const data = await response.json();

    // Si no se encuentran chistes, informa
    if (data.total_jokes === 0) {
      resultado.textContent = "No se encontraron chistes para este término";
      return;
    }

    const lista = document.createElement("ul");

    data.results.forEach((jokeObj) => {
      const item = document.createElement("li");
      item.textContent = jokeObj.joke;
      lista.appendChild(item);
    });

    resultado.innerHTML = "";
    resultado.appendChild(lista);
  } catch (error) {
    resultado.textContent = "Hubo un error en la búsqueda..";
    console.error("Error al buscar chistes:", error);
  }
};


searchBtn.addEventListener("click", buscarChiste);
