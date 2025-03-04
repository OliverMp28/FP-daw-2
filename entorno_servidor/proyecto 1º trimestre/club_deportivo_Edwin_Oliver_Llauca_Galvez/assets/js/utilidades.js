 function meterEstilosAlerta() {
    if (!document.getElementById("alerta-styles")) {
      const style = document.createElement("style");
      style.id = "alerta-styles";
      style.innerHTML = `
  /* ============================
     ESTILOS DE LA ALERTA
  =============================== */
  .alerta {
    position: fixed;
    top: 1rem;
    right: 1rem;
    padding: 0.75rem 1.25rem;
    border-radius: 8px;
    z-index: 1080;
    display: none;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
    font-size: 0.9rem;
  }
  
  .alerta.show {
    display: block;
    animation: slideIn 0.3s ease-out forwards;
    z-index: 1080;
  }
  
  @keyframes slideIn {
    from {
      transform: translateX(100%);
      opacity: 0;
    }
    to {
      transform: translateX(0);
      opacity: 1;
    }
  }
  
  .alerta.success {
    background-color: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
  }
  
  .alerta.danger {
    background-color: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
  }
  
  .alerta.warning {
    background-color: #ede9d4;
    color: #574d15;
    border: 1px solid #e6e4c3;
  }
      `;
      document.head.appendChild(style);
    }
  }
  
  export function mostrarMensaje(texto, clase) {
    // Aseguramos que los estilos de la alerta están en el DOM
    meterEstilosAlerta();
    
    // Buscamos un contenedor de alerta existente, o lo creamos si no existe
    let alerta = document.querySelector(".alerta");
    if (!alerta) {
      alerta = document.createElement("div");
      alerta.className = "alerta";
      document.body.appendChild(alerta);
    }
  
    alerta.innerHTML = `<h3 style="margin: 0;">${texto}</h3>`;
    alerta.classList.add("show", clase);
  
    // Después de 5 segundos, se remueve el mensaje
    setTimeout(() => {
      alerta.innerHTML = "";
      alerta.classList.remove("show", clase);
    }, 5000);
  }
  