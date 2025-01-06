let botones = document.querySelectorAll('.container button');

document.addEventListener("keyup",
    (e)=>{
        if(e.key==="Enter"){
            let nuevo_container = document.createElement("div");
            nuevo_container.classList.add("container");
            nuevo_container.innerHTML = `<div class="boxes box-4">
                                            <h1 id="cabecera"> Ejemplo 4</h1>
                                            <button id="btn-4">Enter</button>
                                            <input id="inp-4" type="text" placeholder="Texto">
                                            <img class="foto marco" src="cascada.jpg" id="im4" alt="playa caribeña">
                                        </div>`;
            document.body.appendChild(nuevo_container);
        }
    }
);

botones.forEach(
    (boton) => {
        boton.addEventListener("click", () => {
            let input = boton.nextElementSibling;
            let imagen = input.nextElementSibling;
            let url = input.value;
            imagen.setAttribute("src", url);
        });
    }
);