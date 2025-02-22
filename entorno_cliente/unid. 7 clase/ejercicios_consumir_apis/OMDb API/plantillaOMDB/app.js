const API_KEY = "b76b385c";
const BASE_URL = "http://www.omdbapi.com/";
const busquedaInput = document.getElementById("pelicula");
const btnBuscar = document.getElementById("buscar");
const contenedorAPI = document.getElementById("contenedor_api");
const cargandoEl = document.getElementById("cargando");

let paginacion = document.getElementById("paginacion");
if (!paginacion) {
  paginacion = document.createElement("div");
  paginacion.id = "paginacion";
  paginacion.classList.add("d-flex", "justify-content-center", "mt-3");

  document.querySelector(".col-md-8").appendChild(paginacion);
}

let currentSearch = "";
let currentPage = 1;
let totalPages = 0;


const consultarPeliculas = async (searchTerm, page = 1) => {
  cargandoEl.style.display = "block";
  contenedorAPI.innerHTML = "";
  paginacion.innerHTML = "";

  try {
    const url = `${BASE_URL}?apikey=${API_KEY}&s=${encodeURIComponent(searchTerm)}&page=${page}&type=movie&r=json`;
    const response = await fetch(url);
    if (!response.ok) {
      throw new Error("Error en la solicitud a la API");
    }
    const data = await response.json();

    // Si la respuesta de la API es negativa, mostramos el error
    if (data.Response === "False") {
      throw new Error(data.Error);
    }

    const movies = data.Search;
    // Rellenamos la tabla con los resultados
    movies.forEach(movie => {
      const row = document.createElement("tr");
      row.innerHTML = `
        <td>${movie.Title}</td>
        <td>${movie.Year}</td>
        <td>${movie.Type}</td>
        <td>${movie.Poster !== "N/A" ? `<img src="${movie.Poster}" alt="${movie.Title}" style="max-width: 100px;">` : "No poster"}</td>
      `;
      contenedorAPI.appendChild(row);
    });

    // Calculamos la cantidad total de paginas
    const totalResults = parseInt(data.totalResults);
    totalPages = Math.ceil(totalResults / 10);
    currentPage = page;
    actualizarPaginar();
  } catch (error) {
    //estoe s si da error
    contenedorAPI.innerHTML = `<tr><td colspan="4" class="text-danger">Error: ${error.message}</td></tr>`;
    console.error("Error al buscar películas:", error);
  } finally {
    cargandoEl.style.display = "none";
  }
};




const actualizarPaginar = () => {
  paginacion.innerHTML = "";

  //"Anterior"
  const btnPrev = document.createElement("button");
  btnPrev.className = "btn btn-secondary mx-1";
  btnPrev.textContent = "Anterior";
  btnPrev.disabled = currentPage <= 1;
  btnPrev.addEventListener("click", () => {
    if (currentPage > 1) {
      consultarPeliculas(currentSearch, currentPage - 1);
    }
  });
  paginacion.appendChild(btnPrev);



  const pageIndicator = document.createElement("span");
  pageIndicator.className = "align-self-center mx-2";
  pageIndicator.textContent = `Página ${currentPage} de ${totalPages}`;
  paginacion.appendChild(pageIndicator);



  //"Siguiente"
  const btnNext = document.createElement("button");
  btnNext.className = "btn btn-secondary mx-1";
  btnNext.textContent = "Siguiente";
  btnNext.disabled = currentPage >= totalPages;
  btnNext.addEventListener("click", () => {
    if (currentPage < totalPages) {
      consultarPeliculas(currentSearch, currentPage + 1);
    }
  });
  paginacion.appendChild(btnNext);

  // Icono de info usando la imagen "info.jpg"
  const infoIcon = document.createElement("img");
  infoIcon.src = "info.jpg";
  infoIcon.alt = "Información";
  infoIcon.style.width = "20px";
  infoIcon.style.height = "20px";
  infoIcon.style.marginLeft = "10px";
  infoIcon.title = "Utiliza los botones para navegar entre páginas para ver mas";
  paginacion.appendChild(infoIcon);
};

btnBuscar.addEventListener("click", () => {
  const searchTerm = busquedaInput.value.trim();
  if (!searchTerm) {
    alert("Por favor, ingresa un término de búsqueda.");
    return;
  }
  currentSearch = searchTerm;
  consultarPeliculas(currentSearch, 1);
});
