"use strict"

// let nombre;
// let y=25;

//let x=y>20?"Ok":"No Ok"; 

// console.log(nombre ?? "Anonimo");
// console.log(nombre || "Anonimo");


// let altura;
// console.log(altura ?? 100);


// let altura;
// altura??=80;
// console.log(altura);

let datos={
    ciudad:"Granada",
    dinero:1000000,
    alcaldesa:"Maria Fran Carazo",
    habitantes:250000,
}
datos["trabajadores"]=13450;
// let campo="ciudad";
// console.log(datos[campo]);
// console.log(datos["ciudad"]);





// console.log(datos.dinero);
// console.log(datos["alcaldesa"]);
// datos.dinero+=1000;
// datos["alcaldesa"]="Sra."+datos["alcaldesa"];
// console.log(datos.dinero);
// console.log(datos["alcaldesa"]);


// let frase="Ir para casa para poder cenar a tiempo en casa para poder dormir pronto en casa";
// let contadores={};

// let palabras=frase.toLowerCase().split(" ");

// for(let pal of palabras){
//     contadores[pal]??=0;
//     contadores[pal]++;
// }
// console.log(contadores);




let trabajadores={
    "Juan":1200,
    "Maria":2000,
    "Antonio":1500,
    "Víctor":3000
};
// for(let trabajador in trabajadores){
//     console.log(`${trabajador} cobra ${trabajadores[trabajador]}€`);
// }


let almacen=[
    {
        "producto":"aluminio",
        "precio":1.5,
        "stock":5000,
    },
    {
        "producto":"cobre",
        "precio":2.5,
        "stock":6000,
    },
    {
        "producto":"hierro",
        "precio":2.1,
        "stock":5000,
    }
];
// console.log(almacen[2]["precio"]);
// console.log(almacen[1]["stock"]);


// for(let producto of almacen){
//     for(let atributo in producto){
//         console.log(`${atributo}:${producto[atributo]}`);
//     }
// }

// for(let articulo of almacen){
//         console.log(`${articulo["producto"]}:${articulo["precio"]}€`);
// }

function sumar(x,y){
    return x+y;
}

const sumar_flecha=(x,y)=>{
    return x+y;
}

// console.log(sumar(9,2));
// console.log(sumar_flecha(9,2));


function hablar(mensaje,tono){
    console.log(tono(mensaje));
}
hablar("Vamonos de aqui",gritar);

function normal(mensaje){
    return mensaje;
}

function gritar(mensaje){
    return "!!!!!"+mensaje+"¡¡¡¡";
}

function susurrar(mensaje){
    return "shshshs"+mensaje+"shshshsh";
}


hablar("Buenos días",(mensaje)=>"¿¿¿"+mensaje+"????");


