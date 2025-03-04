"use strict";

import { mostrarMensaje } from "./utilidades.js";

document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("form-acceder");
  
    form.addEventListener("submit", async (event) => {
      event.preventDefault();
  
      const formData = new FormData(form);
  
      try {
        const response = await fetch("procesar.php", {
          method: "POST",
          body: formData,
        });
  
        if (!response.ok) {
          throw new Error("Error en la respuesta del servidor");
        }
  
        const data = await response.json();
        
        mostrarMensaje(data.message, data.type);
  
        //esto redirige a la pagina de inicio que se le indique en el servidor
        if (data.redirect) {
            setTimeout(() => {
              window.location.href = "../index.php";
            }, 2000); 
          }
  
      } catch (error) {
        mostrarMensaje("Error en la conexión con el servidor", "danger");
        console.error(error);
      }
    });
  });