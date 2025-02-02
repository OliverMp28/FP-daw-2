import { actividades } from './traducciones.js';

const API_URL = 'https://api.api-ninjas.com/v1/exercises';
const CALORIAS_API_URL = 'https://api.api-ninjas.com/v1/caloriesburned';
const API_KEY = '7tDdYJZJWtvH0yIiuJS8XA==UIaBF0yKl2m1BZCP';


const formFiltros = document.querySelector("#form-filtros");
const resultadosContainer = document.querySelector("#resultados-ejercicios");
const cargando = document.createElement("div");

// Configurar el loader 
cargando.className = "text-center my-4";
cargando.innerHTML = `
    <div class="spinner-border text-primary" role="status">
        <span class="visually-hidden">Cargando...</span>
    </div>
`;

// Función para generar la URL (sin URLSearchParams)
function generarURL() {
    const params = [];
    const nombre = document.querySelector("#buscar-nombre").value.trim();
    const tipo = document.querySelector("#filtro-tipo").value;
    const musculo = document.querySelector("#filtro-musculo").value;
    const dificultad = document.querySelector("#filtro-dificultad").value;

    //aqui uso encodeURIComponent para evitar problemas como espacios entre palabras o caracteres especiales que no tenia previsto, esto me quita estos posibles problemas al generar la url
    if (nombre) params.push(`name=${encodeURIComponent(nombre)}`);
    if (tipo) params.push(`type=${encodeURIComponent(tipo)}`);
    if (musculo) params.push(`muscle=${encodeURIComponent(musculo)}`);
    if (dificultad) params.push(`difficulty=${encodeURIComponent(dificultad)}`);

    return params.length > 0 ? `${API_URL}?${params.join('&')}` : API_URL;
}

// Función para mostrar ejercicios (usando for...of)
function mostrarEjercicios(ejercicios) {
    resultadosContainer.innerHTML = "";

    if (ejercicios.length === 0) {
        resultadosContainer.innerHTML = `
            <div class="col-12 text-center text-muted">
                <p>😞 No se encontraron ejercicios</p>
            </div>
        `;
        return;
    }

    // Usar for...of en lugar de forEach
    for (const ejercicio of ejercicios) {
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
                        <span class="instrucciones">${(ejercicio.instructions.length > 0)? truncarTexto(ejercicio.instructions, 100) : "Proximamente..."}</span>
                        ${(ejercicio.instructions.length > 0)?  "<a href='#' class='ver-mas'>Ver más...</a>": ""}
                    </p>
                </div>
            </div>
        `;

        //si no hay instrucciones disponibles no se escucha el evento click del ver mas ya que sino daria error ya que tambien lo quité
        if(ejercicio.instructions.length > 0) {
            const verMas = tarjeta.querySelector(".ver-mas");
            const instrucciones = tarjeta.querySelector(".instrucciones");
            verMas.addEventListener("click", (e) => {
                e.preventDefault();
                if (instrucciones.textContent === ejercicio.instructions) {
                    instrucciones.innerHTML = truncarTexto(ejercicio.instructions, 100);
                    verMas.innerHTML = "Ver más...";
                } else {
                    instrucciones.innerHTML = ejercicio.instructions;
                    verMas.innerHTML = "Ver menos...";
                }
            });
        }
        

        resultadosContainer.appendChild(tarjeta);
    }
}

// Resto del código se mantiene igual
function truncarTexto(texto, limite) {
    return texto.length > limite ? texto.slice(0, limite) + "..." : texto;
}

function obtenerClaseDificultad(dificultad) {
    switch (dificultad) {
        case "beginner": return "bg-success";
        case "intermediate": return "bg-warning";
        case "expert": return "bg-danger";
        default: return "bg-secondary";
    }
}

formFiltros.addEventListener("submit", async (e) => {
    e.preventDefault();
    const url = generarURL();
    resultadosContainer.innerHTML = "";
    resultadosContainer.appendChild(cargando);

    try {
        const respuesta = await fetch(url, {
            headers: {
            'X-Api-Key': API_KEY,
            'Accept': 'application/json' 
            }
        });

        if (!respuesta.ok) throw new Error("Error al obtener los datos");
        const datos = await respuesta.json();
        mostrarEjercicios(datos);

    } catch (error) {
        resultadosContainer.innerHTML = `
            <div class="col-12 text-center text-danger">
            <p> Error: ${error.message}</p>
            </div>
        `;
    } finally {
        cargando.remove();
    }

});



//AQUI ME ENCARGO MAS PARA LA API DE CALORIAS
const inputActividad = document.querySelector("#inputActividad");
const inputPeso = document.querySelector("#inputPeso");
const inputDuracion = document.querySelector("#inputDuracion");
const btnCalcular = document.querySelector("#btnCalcular");
const sugerenciasLista = document.querySelector("#sugerenciasLista");
const listaResultados = document.querySelector("#listaResultados");

function generarURLCalorias(actividad, peso, duracion) {
    let url = "";
    const parametros = [];
    if (actividad){
        parametros.push(`activity=${encodeURIComponent(actividad)}`);
    }
    if (peso){
        parametros.push(`weight=${encodeURIComponent(peso)}`);
    } 
    if (duracion){
        parametros.push(`duration=${encodeURIComponent(duracion)}`);
    } 

    url = `${CALORIAS_API_URL}?${parametros.join('&')}`;
    return url;
}

//esto es para mostrar sugerencias de autocompletado
function mostrarSugerencias(texto) {
    sugerenciasLista.innerHTML = "" // Limpiar sugerencias anteriores
    if (!texto) return;

    const sugerencias = actividades.filter(actividad =>
        actividad.es.toLowerCase().includes(texto.toLowerCase())
    ).slice(0, 5);//con el slice evito que me sugiera todo lo que encuentra, maximo 5 sugerencias

    for (const sugerencia of sugerencias) {
        const item = document.createElement("li");
        item.className = "list-group-item list-group-item-action";
        item.innerHTML = sugerencia.es;
        item.addEventListener("click", () => {
          inputActividad.value = sugerencia.es; // Mostrar en español
          sugerenciasLista.classList.add("d-none"); // Ocultar lista
        });
        sugerenciasLista.appendChild(item);
    }
      

    if (sugerencias.length > 0) {
        sugerenciasLista.classList.remove("d-none"); // Mostrar lista
    } else {
        sugerenciasLista.classList.add("d-none"); // Ocultar lista si no hay sugerencias
    }
}

// Función para mostrar resultados de la API
function mostrarResultadosCalorias(resultados) {
    listaResultados.innerHTML = ""; // Limpiar resultados anteriores

    if (resultados.length === 0) {
        listaResultados.innerHTML = `
            <li class="list-group-item text-muted">No se encontraron resultados.</li>
        `;
        return;
    }

    resultados.forEach(resultado => {
        const item = document.createElement("li");
        item.className = "list-group-item";
        item.innerHTML = `
            <div class="fw-bold"> ${resultado.name}</div>
            <div>🔥 ${resultado.calories_per_hour} cal/h → ⏳ ${resultado.total_calories} cal totales (${resultado.duration_minutes} min)</div>
        `;
        listaResultados.appendChild(item);
    });
}

// Evento para el input de actividad (autocompletado)
inputActividad.addEventListener("input", () => {
    mostrarSugerencias(inputActividad.value);
});


btnCalcular.addEventListener("click", async () => {
    const actividadTexto = inputActividad.value.trim();
    const peso = inputPeso.value.trim();
    const duracion = inputDuracion.value.trim();

    //si no se envia ningun nombre de actividad poner un alert, el nombre es obligatorio
    if (!actividadTexto) {
        alert("campo actividad obligatorio. \nPor favor, coloque un aactividad");
        return;
    }

    //esto se encarga de traducir, busca encontrar alguna traduccion si no hay entonces la envia asi como esta
    const actividad = actividades.find(a => a.es === actividadTexto)?.en || actividadTexto;

    const url = generarURLCalorias(actividad, peso, duracion);

    try {
        listaResultados.innerHTML = "";
        listaResultados.innerHTML = "<li class='list-group-item text-center'>Cargando... </li>";

        const respuesta = await fetch(url, {
            headers: { 
                'X-Api-Key': API_KEY,
                'Accept': 'application/json' 
            }
        });

        if (!respuesta.ok){
            throw new Error("Error al obtener los datos");
        } 

        const datos = await respuesta.json();
        mostrarResultadosCalorias(datos);
    } catch (error) {
        listaResultados.innerHTML = `
            <li class="list-group-item text-danger">Error: ${error.message}</li>
        `;
    }
});