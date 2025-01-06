"use strict";

// Función para mostrar las recetas
export function mostrarRecetas(recetas) {
    recetas.forEach((receta, index) => {
        console.log(`Receta #${index + 1}:`);
        console.log(`Nombre: ${receta.nombre}`);
        console.log(`Tipo: ${receta.tipo}`);
        console.log(`Porciones: ${receta.porciones}`);
        console.log(`Tiempo: ${receta.tiempo} minutos`);
        console.log(`Valoración: ${receta.valoracion}/10`);
        console.log(`Ingredientes: ${receta.ingredientes.join(', ')}`);
        console.log('------------------------------------------');
    });
}

// Función para buscar una receta por su nombre
export function buscarRecetaPorNombre(recetas, nombre) {
    let buscado = recetas.find(receta => receta.nombre.toLowerCase().includes(nombre.toLowerCase()));
    let resultado = "";

    if (buscado) {
        resultado = buscado;
    } else {
        resultado = `No se ha encontrado la receta con nombre: ${nombre}`;
    }
    return resultado;
}

// Función para ordenar las recetas por tiempo de preparación
export function ordenarPorTiempo(recetas) {
    let ordenadasPorTiempo = recetas.sort((a, b) => a.tiempo - b.tiempo);
    return ordenadasPorTiempo;
}

// Nueva función que utiliza el método some para verificar recetas con más porciones que las especificadas
export function verificarRecetaConPorcionesAltas(recetas, porcionesMinimas) {
    // Verificar si existe alguna receta con más porciones de las indicadas
    return recetas.some(receta => receta.porciones > porcionesMinimas);
}

// Función para comprobar si todas las recetas tienen una valoración mínima
export function verificarValoracionMinima(recetas, valorMinimo) {
    return recetas.every(receta => receta.valoracion >= valorMinimo);
}

// Función para filtrar recetas por tipo
export function filtrarPorTipo(recetas, tipo) {
    return recetas.filter(receta => receta.tipo.toLowerCase() === tipo.toLowerCase());
}

// Función para encontrar el índice de una receta por su nombre
export function encontrarIndicePorNombre(recetas, nombre) {
    return recetas.findIndex(receta => receta.nombre.toLowerCase() === nombre.toLowerCase());
}

// Función mejorada para mostrar las claves de las recetas
// Ahora se utiliza para validar campos obligatorios de una receta
export function mostrarClavesReceta(receta) {
    const clavesObligatorias = ['nombre', 'tipo', 'porciones', 'tiempo', 'valoracion', 'ingredientes'];
    const clavesReceta = Object.keys(receta);
    
    const faltantes = clavesObligatorias.filter(clave => !clavesReceta.includes(clave));
    
    if (faltantes.length > 0) {
        return `Faltan las siguientes claves en la receta: ${faltantes.join(', ')}`;
    }
    
    return `Todas las claves obligatorias están presentes en la receta: ${clavesReceta.join(', ')}`;
}

// Función para mostrar las entradas clave-valor de una receta
export function mostrarEntradasReceta(receta) {
    return Object.entries(receta);
}

// Función mejorada para crear una receta desde entradas clave-valor
export function crearRecetaDesdeEntradas() {
    // Entradas de datos simuladas por el usuario
    let nombre = prompt("Nombre de la receta:");
    let tipo = prompt("Tipo de receta (Italiana, Mexicana, Postre, etc.):");
    let porciones = parseInt(prompt("Número de porciones:"));
    let tiempo = parseInt(prompt("Tiempo de preparación (en minutos):"));
    let valoracion = parseInt(prompt("Valoración de la receta (1-10):"));
    let ingredientes = prompt("Inserta los ingredientes separados por comas:").split(',');

    // Validación de los datos ingresados
    if (!nombre || !tipo || isNaN(porciones) || isNaN(tiempo) || isNaN(valoracion) || ingredientes.length === 0) {
        return "Error: Algunos campos son inválidos o están incompletos.";
    }

    // Crear la receta usando Object.fromEntries
    let nuevaReceta = Object.fromEntries([
        ["nombre", nombre],
        ["tipo", tipo],
        ["porciones", porciones],
        ["tiempo", tiempo],
        ["valoracion", valoracion],
        ["ingredientes", ingredientes] // Ahora los ingredientes también están incluidos
    ]);

    return nuevaReceta;
}