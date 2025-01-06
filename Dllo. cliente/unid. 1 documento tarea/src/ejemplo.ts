const button = document.getElementById("boton") as HTMLButtonElement;
let mensaje: string = "Boton presionado, acabas de programar con TypeScript";

const mostrar = () => {
  alert(mensaje);
};

button.addEventListener("click", mostrar);
