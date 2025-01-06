"use strict";

export const recetas = [
    {
        nombre : "Pasta carbonara",
        tipo: "Italiana",
        porciones: 4, 
        tiempo: 30.0, 
        valoracion: 7.4,
        ingredientes: ["pasta", "huevo", "queso parmesano", "tocino","ajo"]
    },
    {
        nombre : "Tacos",
        tipo: "Mexicana",
        porciones: 4, 
        tiempo: 40.0, 
        valoracion: 7.5,
        ingredientes: ["tortillas", "carne", "cebolla", "cilantro","limon"]
    },
    {
        nombre : "Brownies de chocolate",
        tipo: "Postre",
        porciones: 8, 
        tiempo: 50.0, 
        valoracion: 7,
        ingredientes: ["harina", "azucar", "chocolate", "huevos","mantequilla"]
    },
    {
        nombre : "Picante de chorizo",
        tipo: "Italiana",
        porciones: 3, 
        tiempo: 30.0, 
        valoracion: 8.9,
        ingredientes: ["chorizo", "pasta", "aji panca", "ajo","verduras a la parrilla", "nata"]
    },
    {
        nombre : "Arroz con Pollo",
        tipo: "Criollo",
        porciones: 6, 
        tiempo: 60.0, 
        valoracion: 8.5,
        ingredientes: ["arroz", "pollo", "guisantes", "zanahoria","limon", "aji amarillo", "pimentón"]
    },
    {
        nombre : "Ceviche",
        tipo: "Marino",
        porciones: 4, 
        tiempo: 80.0, 
        valoracion: 10,
        ingredientes: ["pescado", "pota", "limon", "aji limo","cilantro", "apio", "choclo", "cebolla", "ajo"]
    }
]


/*

Nombre de la receta (string único): Ej. "Spaghetti Carbonara", "Tacos al Pastor"
Tipo de comida (string repetido para clasificar): Ej. "Italiana", "Mexicana", "Postre", "Vegana"
Porciones (valor entero): Ej. 2, 4, 6
Tiempo de preparación en minutos (valor flotante): Ej. 45.5, 30.0, 90.25
Operaciones a realizar:
Para cumplir con los métodos solicitados, haremos lo siguiente:

forEach: Mostrar todas las recetas disponibles con sus detalles.
sort: Ordenar las recetas por tiempo de preparación o por número de porciones.
some: Verificar si hay alguna receta de un tipo específico, por ejemplo, "Vegana".
every: Comprobar si todas las recetas tienen un tiempo de preparación menor a cierto valor (ej. 60 minutos).
filter: Filtrar las recetas por tipo de comida o porciones.
find: Buscar una receta por nombre.
findIndex: Encontrar la posición de una receta específica en el array.
Object.keys: Obtener las propiedades de una receta (nombre, tipo, porciones, tiempo de preparación).
Object.entries: Obtener las entradas clave-valor de una receta.
Object.fromEntries: Crear un nuevo objeto receta usando entradas clave-valor.
Funcionalidades Extra:
Algunas funcionalidades adicionales que se pueden incluir son:

Añadir nuevas recetas al sistema.
Eliminar recetas por nombre o tipo de comida.
Actualizar el tiempo de preparación o número de porciones de una receta.
Guardar recetas favoritas en una lista separada.
Estructura Modular:
moduloFunciones.js: Aquí estarán todas las funciones para manejar las recetas (búsqueda, filtrado, ordenado, etc.).
app.js: Este será el archivo principal, donde se gestionan las interacciones y se importan las funciones.
*/