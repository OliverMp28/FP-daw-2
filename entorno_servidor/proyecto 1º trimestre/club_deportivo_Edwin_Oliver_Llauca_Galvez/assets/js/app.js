// Constantes
const API_URL = 'https://api.api-ninjas.com/v1/exercises';
const API_KEY = '7tDdYJZJWtvH0yIiuJS8XA==UIaBF0yKl2m1BZCP'; // Reemplaza con tu clave de API

// Elementos del DOM
const formFiltros = document.querySelector("#form-filtros"); // Formulario de filtros
const resultadosContainer = document.querySelector("#resultados-ejercicios"); // Contenedor de resultados
const cargando = document.createElement("div"); // Elemento para mostrar el loader

// Configurar el loader
cargando.className = "text-center my-4";
cargando.innerHTML = `
    <div class="spinner-border text-primary" role="status">
        <span class="visually-hidden">Cargando...</span>
    </div>
`;

// Función para generar la URL de la API con los filtros
function generarURL() {
    const nombre = document.querySelector("#buscar-nombre").value.trim(); // Nombre del ejercicio
    const tipo = document.querySelector("#filtro-tipo").value; // Tipo de ejercicio
    const musculo = document.querySelector("#filtro-musculo").value; // Grupo muscular
    const dificultad = document.querySelector("#filtro-dificultad").value; // Dificultad

    // Construir la URL con los parámetros
    const params = new URLSearchParams();
    if (nombre) params.append('name', nombre);
    if (tipo) params.append('type', tipo);
    if (musculo) params.append('muscle', musculo);
    if (dificultad) params.append('difficulty', dificultad);

    return `${API_URL}?${params.toString()}`;
}

// Función para mostrar los ejercicios en tarjetas
// Función para mostrar los ejercicios en tarjetas
function mostrarEjercicios(ejercicios) {
  resultadosContainer.innerHTML = ""; // Limpiar el contenedor

  if (ejercicios.length === 0) {
      resultadosContainer.innerHTML = `
          <div class="col-12 text-center text-muted">
              <p>😞 No se encontraron ejercicios con los filtros seleccionados.</p>
          </div>
      `;
      return;
  }

  ejercicios.forEach(ejercicio => {
      const tarjeta = document.createElement("div");
      tarjeta.className = "col-md-4 mb-4";
      tarjeta.innerHTML = `
          <div class="card h-100 shadow-sm">
              <div class="card-body">
                  <h5 class="card-title fw-bold">${ejercicio.name}</h5>
                  <p class="card-text"><strong>Grupo Muscular:</strong> ${ejercicio.muscle}</p>
                  <p class="card-text"><strong>Tipo:</strong> ${ejercicio.type}</p>
                  <p class="card-text"><strong>Dificultad:</strong> 
                      <span class="badge ${obtenerClaseDificultad(ejercicio.difficulty)}">
                          ${ejercicio.difficulty}
                      </span>
                  </p>
                  <p class="card-text"><strong>Equipo:</strong> ${ejercicio.equipment}</p>
                  <p class="card-text"><strong>Instrucciones:</strong> 
                      <span class="instrucciones">${truncarTexto(ejercicio.instructions, 100)}</span>
                      <a href="#" class="ver-mas">Ver más...</a>
                  </p>
              </div>
          </div>
      `;
      resultadosContainer.appendChild(tarjeta);

      // Agregar evento para expandir/colapsar las instrucciones
      const verMas = tarjeta.querySelector(".ver-mas");
      const instrucciones = tarjeta.querySelector(".instrucciones");
      verMas.addEventListener("click", (e) => {
          e.preventDefault(); // Evitar que el enlace recargue la página
          if (instrucciones.textContent === ejercicio.instructions) {
              instrucciones.textContent = truncarTexto(ejercicio.instructions, 100); // Colapsar
              verMas.textContent = "Ver más...";
          } else {
              instrucciones.textContent = ejercicio.instructions; // Expandir
              verMas.textContent = "Ver menos...";
          }
      });
  });
}

// Función para truncar el texto
function truncarTexto(texto, limite) {
  return texto.length > limite ? texto.slice(0, limite) + "..." : texto;
}

// Función para obtener la clase CSS según la dificultad
function obtenerClaseDificultad(dificultad) {
    switch (dificultad) {
        case "beginner":
            return "bg-success";
        case "intermediate":
            return "bg-warning";
        case "expert":
            return "bg-danger";
        default:
            return "bg-secondary";
    }
}

// Evento para el formulario de filtros
formFiltros.addEventListener("submit", async (e) => {
    e.preventDefault(); // Evitar que el formulario se envíe

    const url = generarURL(); // Generar la URL con los filtros
    resultadosContainer.innerHTML = ""; // Limpiar resultados anteriores
    resultadosContainer.appendChild(cargando); // Mostrar el loader

    try {
        // Realizar la petición a la API
        const respuesta = await fetch(url, {
            headers: { 'X-Api-Key': API_KEY } // Incluir la clave de API en los headers
        });

        if (!respuesta.ok) throw new Error("Error al obtener los datos"); // Manejar errores de la API

        const datos = await respuesta.json(); // Convertir la respuesta a JSON
        mostrarEjercicios(datos); // Mostrar los resultados
    } catch (error) {
        // Mostrar un mensaje de error si algo falla
        resultadosContainer.innerHTML = `
            <div class="col-12 text-center text-danger">
                <p>❌ Error: ${error.message}</p>
            </div>
        `;
    } finally {
        cargando.remove(); // Ocultar el loader
    }
});