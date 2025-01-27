// Constantes
const API_URL = 'https://api.api-ninjas.com/v1/exercises';
const CALORIES_API_URL = 'https://api.api-ninjas.com/v1/caloriesburned';
const API_KEY = '7tDdYJZJWtvH0yIiuJS8XA==UIaBF0yKl2m1BZCP';

// Elementos del DOM
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
                    instrucciones.textContent = truncarTexto(ejercicio.instructions, 100);
                    verMas.textContent = "Ver más...";
                } else {
                    instrucciones.textContent = ejercicio.instructions;
                    verMas.textContent = "Ver menos...";
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
            headers: { 'X-Api-Key': API_KEY }
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

// JSON de actividades traducidas (español → inglés)
// JSON de actividades traducidas (español → inglés)
const actividades = [
    { es: "correr", en: "running" },
    { es: "caminar", en: "walking" },
    { es: "nadar", en: "swimming" },
    { es: "ciclismo", en: "cycling" },
    { es: "yoga", en: "yoga" },
    { es: "levantamiento de pesas", en: "weight lifting" },
    { es: "esquiar", en: "skiing" },
    { es: "patinaje", en: "skating" },
    { es: "boxeo", en: "boxing" },
    { es: "escalada", en: "climbing" },
    { es: "gimnasia", en: "gymnastics" },
    { es: "remo", en: "rowing" },
    { es: "baloncesto", en: "basketball" },
    { es: "fútbol", en: "soccer" },
    { es: "béisbol", en: "baseball" },
    { es: "voleibol", en: "volleyball" },
    { es: "tenis", en: "tennis" },
    { es: "golf", en: "golf" },
    { es: "surf", en: "surfing" },
    { es: "kitesurf", en: "kitesurfing" },
    { es: "windsurf", en: "windsurfing" },
    { es: "pesca", en: "fishing" },
    { es: "senderismo", en: "hiking" },
    { es: "entrenamiento funcional", en: "functional training" },
    { es: "pilates", en: "pilates" },
    { es: "crossfit", en: "crossfit" },
    { es: "artes marciales", en: "martial arts" },
    { es: "karate", en: "karate" },
    { es: "judo", en: "judo" },
    { es: "taekwondo", en: "taekwondo" },
    { es: "carrera de obstáculos", en: "obstacle course racing" },
    { es: "paracaidismo", en: "skydiving" },
    { es: "parapente", en: "paragliding" },
    { es: "buceo", en: "diving" },
    { es: "esnórquel", en: "snorkeling" },
    { es: "hockey sobre hielo", en: "ice hockey" },
    { es: "hockey sobre césped", en: "field hockey" },
    { es: "rugby", en: "rugby" },
    { es: "cricket", en: "cricket" },
    { es: "pádel", en: "padel" },
    { es: "squash", en: "squash" },
    { es: "bádminton", en: "badminton" },
    { es: "parkour", en: "parkour" },
    { es: "equitación", en: "horseback riding" },
    { es: "tiro con arco", en: "archery" },
    { es: "tiro deportivo", en: "sport shooting" },
    { es: "patinaje sobre hielo", en: "ice skating" },
    { es: "patinaje en línea", en: "inline skating" },
    { es: "carrera de autos", en: "car racing" },
    { es: "motociclismo", en: "motorcycling" },
    { es: "esgrima", en: "fencing" },
    { es: "triatlón", en: "triathlon" },
    { es: "esquí acuático", en: "water skiing" },
    { es: "snowboard", en: "snowboarding" },
    { es: "canoa", en: "canoeing" },
    { es: "kayak", en: "kayaking" },
    { es: "espeleología", en: "caving" },
    { es: "danzas", en: "dancing" },
    { es: "zumba", en: "zumba" },
    { es: "carreras de montaña", en: "trail running" },
    { es: "duatlón", en: "duathlon" },
    { es: "apnea", en: "freediving" },
    { es: "esquí", en: "ski" },
    { es: "esquiar", en: "skiing" },
    { es: "ski de fondo", en: "cross-country skiing" },
    { es: "snowboarding", en: "snowboarding" },
    { es: "patinaje artístico", en: "figure skating" },
    { es: "patinaje", en: "skating" },
    { es: "patines en línea", en: "rollerblading" },
    { es: "montar bicicleta", en: "bike riding" },
    { es: "ciclismo de montaña", en: "mountain biking" },
    { es: "ciclismo de ruta", en: "road cycling" },
    { es: "trail running", en: "trail running" },
    { es: "carrera de resistencia", en: "endurance running" },
    { es: "maratón", en: "marathon" },
    { es: "media maratón", en: "half marathon" },
    { es: "jogging", en: "jogging" },
    { es: "trote", en: "jogging" },
    { es: "senderismo extremo", en: "extreme hiking" },
    { es: "trekking", en: "trekking" },
    { es: "trekking de montaña", en: "mountain trekking" },
    { es: "buceo libre", en: "freediving" },
    { es: "apnea", en: "apnea diving" },
    { es: "kayaking", en: "kayaking" },
    { es: "canoa", en: "canoeing" },
    { es: "remo deportivo", en: "competitive rowing" },
    { es: "vela", en: "sailing" },
    { es: "windsurfing", en: "windsurfing" },
    { es: "kitesurfing", en: "kitesurfing" },
    { es: "surf de remo", en: "stand-up paddleboarding" },
    { es: "SUP", en: "SUP" },
    { es: "natación sincronizada", en: "synchronized swimming" },
    { es: "entrenamiento de natación", en: "swimming training" },
    { es: "levantamiento olímpico", en: "olympic weightlifting" },
    { es: "pesas rusas", en: "kettlebell training" },
    { es: "entrenamiento con pesas", en: "strength training" },
    { es: "gimnasia de calistenia", en: "calisthenics" },
    { es: "calistenia", en: "calisthenics" },
    { es: "entrenamiento de circuito", en: "circuit training" },
    { es: "tabata", en: "tabata" },
    { es: "intervalos de alta intensidad", en: "HIIT" },
    { es: "entrenamiento funcional", en: "functional training" },
    { es: "clases de baile", en: "dance classes" },
    { es: "baile contemporáneo", en: "contemporary dance" },
    { es: "hip hop", en: "hip hop dancing" },
    { es: "salsa", en: "salsa dancing" },
    { es: "bachata", en: "bachata dancing" },
    { es: "danza clásica", en: "classical dance" },
    { es: "zumba fitness", en: "zumba fitness" },
    { es: "kickboxing", en: "kickboxing" },
    { es: "boxeo recreativo", en: "recreational boxing" },
    { es: "muay thai", en: "muay thai" },
    { es: "artes marciales mixtas", en: "MMA" },
    { es: "defensa personal", en: "self-defense" },
    { es: "jiu-jitsu brasileño", en: "Brazilian jiu-jitsu" },
    { es: "karate-do", en: "karate" },
    { es: "combate deportivo", en: "combat sports" },
    { es: "rugby de playa", en: "beach rugby" },
    { es: "rugby sevens", en: "rugby sevens" },
    { es: "fútbol sala", en: "futsal" },
    { es: "fútbol americano", en: "American football" },
    { es: "tocho bandera", en: "flag football" },
    { es: "balonmano", en: "handball" },
    { es: "ultimate frisbee", en: "ultimate frisbee" },
    { es: "tenis de mesa", en: "table tennis" },
    { es: "ping-pong", en: "ping-pong" },
    { es: "hockey en césped", en: "field hockey" },
    { es: "hockey sobre patines", en: "roller hockey" },
    { es: "lacrosse", en: "lacrosse" },
    { es: "triatlón olímpico", en: "Olympic triathlon" },
    { es: "ironman", en: "Ironman" },
    { es: "duatlón de montaña", en: "mountain duathlon" },
    { es: "carrera de obstáculos", en: "obstacle racing" },
    { es: "spartan race", en: "Spartan race" },
    { es: "carrera urbana", en: "urban running" },
    { es: "karting", en: "karting" },
    { es: "trial en moto", en: "motorcycle trials" },
    { es: "trial en bicicleta", en: "bicycle trials" },
    { es: "descenso en bici", en: "downhill biking" },
    { es: "ciclismo BMX", en: "BMX cycling" },
    { es: "esgrima deportiva", en: "sport fencing" },
    { es: "esgrima histórica", en: "historical fencing" },
    { es: "pole dance", en: "pole dance" },
    { es: "deportes acuáticos", en: "water sports" },
    { es: "deportes extremos", en: "extreme sports" },
    { es: "deportes de invierno", en: "winter sports" }
];


// Función para generar la URL de la API
function generarURLCalorias(actividad, peso, duracion) {
    const params = [];
    if (actividad) params.push(`activity=${encodeURIComponent(actividad)}`);
    if (peso) params.push(`weight=${encodeURIComponent(peso)}`);
    if (duracion) params.push(`duration=${encodeURIComponent(duracion)}`);
    return `${CALORIES_API_URL}?${params.join('&')}`;
}

// Función para mostrar sugerencias de autocompletado
function mostrarSugerencias(texto) {
    sugerenciasLista.innerHTML = ""; // Limpiar sugerencias anteriores
    if (!texto) return;

    const sugerencias = actividades.filter(actividad =>
        actividad.es.toLowerCase().includes(texto.toLowerCase())
    ).slice(0, 5); // Mostrar máximo 5 sugerencias

    sugerencias.forEach(sugerencia => {
        const item = document.createElement("li");
        item.className = "list-group-item list-group-item-action";
        item.textContent = sugerencia.es;
        item.addEventListener("click", () => {
            inputActividad.value = sugerencia.es; // Mostrar en español
            sugerenciasLista.classList.add("d-none"); // Ocultar lista
        });
        sugerenciasLista.appendChild(item);
    });

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

// Evento para el botón de calcular
btnCalcular.addEventListener("click", async () => {
    const actividadTexto = inputActividad.value.trim();
    const peso = inputPeso.value.trim();
    const duracion = inputDuracion.value.trim();

    // Validar campos
    if (!actividadTexto) {
        alert("campo actividad obligatorio. \nPor favor, coloque un aactividad");
        return;
    }

    // Traducir actividad a inglés
    const actividad = actividades.find(a => a.es === actividadTexto)?.en || actividadTexto;

    // Generar URL y realizar la consulta
    const url = generarURLCalorias(actividad, peso, duracion);

    try {
        listaResultados.innerHTML = ""; // Limpiar resultados anteriores
        listaResultados.innerHTML = `<li class="list-group-item text-center">Cargando...</li>`; // Mostrar loader

        const respuesta = await fetch(url, {
            headers: { 'X-Api-Key': API_KEY }
        });

        if (!respuesta.ok) throw new Error("Error al obtener los datos");

        const datos = await respuesta.json();
        mostrarResultadosCalorias(datos);
    } catch (error) {
        listaResultados.innerHTML = `
            <li class="list-group-item text-danger">Error: ${error.message}</li>
        `;
    }
});