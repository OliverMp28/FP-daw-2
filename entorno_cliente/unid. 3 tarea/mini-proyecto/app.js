"use strict";

import { recetas } from "./objeto_recetas.js"; 
import { 
    mostrarRecetas,
    buscarRecetaPorNombre,
    ordenarPorTiempo,
    verificarRecetaConPorcionesAltas,
    verificarValoracionMinima,
    filtrarPorTipo,
    encontrarIndicePorNombre,
    mostrarClavesReceta,
    mostrarEntradasReceta,
    crearRecetaDesdeEntradas 
} from "./funciones.js";

console.log("----- TODAS LAS RECETAS -----");
mostrarRecetas(recetas);

console.log("--------------------------------------------------------");
console.log("Elige una de las opciones mostradas y a continuación se mostrará en la consola");
console.log("--------------------------------------------------------");

let opciones = prompt(`Elige una opción (inserta el número de la opción):\n
    1. Mostrar receta por su nombre\n
    2. Ordenar las recetas por tiempo de preparación\n
    3. Verificar si hay recetas con más de X porciones\n
    4. Verificar si todas las recetas tienen una valoración mínima\n
    5. Filtrar recetas por tipo\n
    6. Encontrar el índice de una receta por nombre\n
    7. Validar claves de una receta\n
    8. Mostrar entradas clave-valor de una receta\n
    9. Crear una nueva receta desde entradas\n
`);

switch (opciones) {
    case "1":
        let nombreReceta = prompt("Inserta el nombre de la receta a buscar");
        console.log("-- Has seleccionado la opción 1 --");
        console.log(buscarRecetaPorNombre(recetas, nombreReceta));
        break;

    case "2":
        console.log("-- Has seleccionado la opción 2: Ordenar por tiempo --");
        const recetasOrdenadas = ordenarPorTiempo(recetas);
        mostrarRecetas(recetasOrdenadas);
        break;

    case "3":
        let porcionesMinimas = parseInt(prompt("Inserta el número mínimo de porciones:"));
        console.log("-- Has seleccionado la opción 3 --");
        const hayRecetasConPorcionesAltas = verificarRecetaConPorcionesAltas(recetas, porcionesMinimas);
        console.log(`¿Hay recetas con más de ${porcionesMinimas} porciones?: ${hayRecetasConPorcionesAltas}`);
        break;

    case "4":
        let valorMinimo = parseInt(prompt("Inserta la valoración mínima:"));
        console.log("-- Has seleccionado la opción 4 --");
        const todasConBuenaValoracion = verificarValoracionMinima(recetas, valorMinimo);
        console.log(`¿Todas tienen al menos una valoración de ${valorMinimo}?: ${todasConBuenaValoracion}`);
        break;

    case "5":
        let tipoReceta = prompt("Inserta el tipo de receta a filtrar (Italiana, Mexicana, etc.):");
        console.log("-- Has seleccionado la opción 5 --");
        const recetasFiltradas = filtrarPorTipo(recetas, tipoReceta);
        if (recetasFiltradas.length > 0) {
            mostrarRecetas(recetasFiltradas);
        } else {
            console.log(`No se han encontrado recetas del tipo: ${tipoReceta}`);
        }
        break;

    case "6":
        let nombreParaIndice = prompt("Inserta el nombre de la receta para encontrar su índice:");
        console.log("-- Has seleccionado la opción 6 --");
        const indiceReceta = encontrarIndicePorNombre(recetas, nombreParaIndice);
        if (indiceReceta !== -1) {
            console.log(`El índice de la receta '${nombreParaIndice}' es: ${indiceReceta}`);
        } else {
            console.log(`No se ha encontrado la receta con nombre: ${nombreParaIndice}`);
        }
        break;

    case "7":
        let nombreParaValidarClaves = prompt("Inserta el nombre de la receta para validar sus claves:");
        console.log("-- Has seleccionado la opción 7 --");
        const recetaParaValidar = buscarRecetaPorNombre(recetas, nombreParaValidarClaves);

        if (recetaParaValidar) { // Verificación simple de existencia
            const validacionClaves = mostrarClavesReceta(recetaParaValidar);
            console.log(`Claves de la receta '${nombreParaValidarClaves}':`, validacionClaves);
        } else {
            console.log(`No se ha encontrado la receta con nombre: ${nombreParaValidarClaves}`);
        }
        break;


    case "8":
        let nombreParaMostrarEntradas = prompt("Inserta el nombre de la receta para mostrar sus entradas:");
        console.log("-- Has seleccionado la opción 8 --");
        const recetaParaEntradas = buscarRecetaPorNombre(recetas, nombreParaMostrarEntradas);

        if (recetaParaEntradas) { // Verificación simple de existencia
            const entradas = mostrarEntradasReceta(recetaParaEntradas);
            console.log(`Entradas clave-valor de la receta '${nombreParaMostrarEntradas}':`, entradas);
        } else {
            console.log(`No se ha encontrado la receta con nombre: ${nombreParaMostrarEntradas}`);
        }
        break;


    case "9":
        console.log("-- Has seleccionado la opción 9: Crear nueva receta --");
        const nuevaReceta = crearRecetaDesdeEntradas();
        console.log("Receta creada con éxito:");
        console.log(nuevaReceta);
        break;

    default:
        console.log("Opción no válida. Por favor, elige un número del 1 al 9.");
}

console.log("--------------------------------------------------------");
console.log("Fin de las opciones.");