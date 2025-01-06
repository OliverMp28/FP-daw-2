var button = document.getElementById("boton");
var mensaje = "Boton presionado, acabas de programar con TypeScript";
var mostrar = function () {
    alert(mensaje);
};
button.addEventListener("click", mostrar);
