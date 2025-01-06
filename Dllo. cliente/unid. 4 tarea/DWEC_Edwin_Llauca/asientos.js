//objeto datos el cual exporto

const datos = {
    // Asientos Laterales Izquierda
    "AI01": {   fila: "A", 
                numero: 1, 
                zona: "Lateral Izquierda", 
                estado: "disponible", 
                precio: 60 
            },
    "AI02": { fila: "A", numero: 2, zona: "Lateral Izquierda", estado: "disponible", precio: 60 },
    "BI03": { fila: "B", numero: 3, zona: "Lateral Izquierda", estado: "disponible", precio: 60 },
    "BI04": { fila: "B", numero: 4, zona: "Lateral Izquierda", estado: "disponible", precio: 60 },
    "CI05": { fila: "C", numero: 5, zona: "Lateral Izquierda", estado: "disponible", precio: 60 },
    "CI06": { fila: "C", numero: 6, zona: "Lateral Izquierda", estado: "disponible", precio: 60 },
    "DI07": { fila: "D", numero: 7, zona: "Lateral Izquierda", estado: "disponible", precio: 60 },
    "EI08": { fila: "E", numero: 8, zona: "Lateral Izquierda", estado: "disponible", precio: 60 },

    // Asientos Premium
    "A01": { fila: "A", numero: 1, zona: "Premium", estado: "disponible", precio: 120 },
    "A02": { fila: "A", numero: 2, zona: "Premium", estado: "disponible", precio: 120 },
    "A03": { fila: "A", numero: 3, zona: "Premium", estado: "disponible", precio: 120 },
    "A04": { fila: "A", numero: 4, zona: "Premium", estado: "disponible", precio: 120 },
    "A05": { fila: "A", numero: 5, zona: "Premium", estado: "disponible", precio: 120 },
    "A06": { fila: "A", numero: 6, zona: "Premium", estado: "disponible", precio: 120 },
    "B01": { fila: "B", numero: 1, zona: "Premium", estado: "disponible", precio: 120 },
    "B02": { fila: "B", numero: 2, zona: "Premium", estado: "disponible", precio: 120 },
    "B03": { fila: "B", numero: 3, zona: "Premium", estado: "disponible", precio: 120 },
    "B04": { fila: "B", numero: 4, zona: "Premium", estado: "disponible", precio: 120 },
    "B05": { fila: "B", numero: 5, zona: "Premium", estado: "disponible", precio: 120 },
    "B06": { fila: "B", numero: 6, zona: "Premium", estado: "disponible", precio: 120 },
    "C01": { fila: "C", numero: 1, zona: "Premium", estado: "disponible", precio: 120 },
    "C02": { fila: "C", numero: 2, zona: "Premium", estado: "disponible", precio: 120 },
    "C03": { fila: "C", numero: 3, zona: "Premium", estado: "disponible", precio: 120 },
    "C04": { fila: "C", numero: 4, zona: "Premium", estado: "disponible", precio: 120 },
    "C05": { fila: "C", numero: 5, zona: "Premium", estado: "disponible", precio: 120 },
    "C06": { fila: "C", numero: 6, zona: "Premium", estado: "disponible", precio: 120 },

    // Asientos Intermedios
    "D01": { fila: "D", numero: 1, zona: "Intermedia", estado: "disponible", precio: 90 },
    "D02": { fila: "D", numero: 2, zona: "Intermedia", estado: "disponible", precio: 90 },
    "D03": { fila: "D", numero: 3, zona: "Intermedia", estado: "disponible", precio: 90 },
    "D04": { fila: "D", numero: 4, zona: "Intermedia", estado: "disponible", precio: 90 },
    "D05": { fila: "D", numero: 5, zona: "Intermedia", estado: "disponible", precio: 90 },
    "D06": { fila: "D", numero: 6, zona: "Intermedia", estado: "disponible", precio: 90 },
    "D07": { fila: "D", numero: 7, zona: "Intermedia", estado: "disponible", precio: 90 },
    "D08": { fila: "D", numero: 8, zona: "Intermedia", estado: "disponible", precio: 90 },
    "E01": { fila: "E", numero: 1, zona: "Intermedia", estado: "disponible", precio: 90 },
    "E02": { fila: "E", numero: 2, zona: "Intermedia", estado: "disponible", precio: 90 },
    "E03": { fila: "E", numero: 3, zona: "Intermedia", estado: "disponible", precio: 90 },
    "E04": { fila: "E", numero: 4, zona: "Intermedia", estado: "disponible", precio: 90 },
    "E05": { fila: "E", numero: 5, zona: "Intermedia", estado: "disponible", precio: 90 },
    "E06": { fila: "E", numero: 6, zona: "Intermedia", estado: "disponible", precio: 90 },
    "E07": { fila: "E", numero: 7, zona: "Intermedia", estado: "disponible", precio: 90 },
    "E08": { fila: "E", numero: 8, zona: "Intermedia", estado: "disponible", precio: 90 },

    // Asientos Económicos
    "F01": { fila: "F", numero: 1, zona: "Económica", estado: "disponible", precio: 50 },
    "F02": { fila: "F", numero: 2, zona: "Económica", estado: "disponible", precio: 50 },
    "F03": { fila: "F", numero: 3, zona: "Económica", estado: "disponible", precio: 50 },
    "F04": { fila: "F", numero: 4, zona: "Económica", estado: "disponible", precio: 50 },
    "F05": { fila: "F", numero: 5, zona: "Económica", estado: "disponible", precio: 50 },
    "F06": { fila: "F", numero: 6, zona: "Económica", estado: "disponible", precio: 50 },
    "F07": { fila: "F", numero: 7, zona: "Económica", estado: "disponible", precio: 50 },
    "F08": { fila: "F", numero: 8, zona: "Económica", estado: "disponible", precio: 50 },
    "F09": { fila: "F", numero: 9, zona: "Económica", estado: "disponible", precio: 50 },
    "G01": { fila: "G", numero: 1, zona: "Económica", estado: "disponible", precio: 50 },
    "G02": { fila: "G", numero: 2, zona: "Económica", estado: "disponible", precio: 50 },
    "G03": { fila: "G", numero: 3, zona: "Económica", estado: "disponible", precio: 50 },
    "G04": { fila: "G", numero: 4, zona: "Económica", estado: "disponible", precio: 50 },
    "G05": { fila: "G", numero: 5, zona: "Económica", estado: "disponible", precio: 50 },
    "G06": { fila: "G", numero: 6, zona: "Económica", estado: "disponible", precio: 50 },
    "G07": { fila: "G", numero: 7, zona: "Económica", estado: "disponible", precio: 50 },
    "G08": { fila: "G", numero: 8, zona: "Económica", estado: "disponible", precio: 50 },
    "G09": { fila: "G", numero: 9, zona: "Económica", estado: "disponible", precio: 50 },

    // Asientos Laterales Derecha
    "AD01": { fila: "A", numero: 1, zona: "Lateral Derecha", estado: "disponible", precio: 60 },
    "AD02": { fila: "A", numero: 2, zona: "Lateral Derecha", estado: "disponible", precio: 60 },
    "BD03": { fila: "B", numero: 3, zona: "Lateral Derecha", estado: "disponible", precio: 60 },
    "BD04": { fila: "B", numero: 4, zona: "Lateral Derecha", estado: "disponible", precio: 60 },
    "CD05": { fila: "C", numero: 5, zona: "Lateral Derecha", estado: "disponible", precio: 60 },
    "CD06": { fila: "C", numero: 6, zona: "Lateral Derecha", estado: "disponible", precio: 60 },
    "DD07": { fila: "D", numero: 7, zona: "Lateral Derecha", estado: "disponible", precio: 60 },
    "ED08": { fila: "E", numero: 8, zona: "Lateral Derecha", estado: "disponible", precio: 60 }
};

export {datos};