//https://randomuser.me/api/?seed=abc&&results=20
//https://randomuser.me/


const tabla = document.querySelector("#lista_api");
const cargando = document.querySelector("#cargando");
const boton = document.querySelector("#buscar");

function generarURL() {
    const cantidad = document.querySelector("#cantidad").value;
    const genero = document.querySelector("#genero").value;
    const nacionalidad = document.querySelector("#nacionalidad").value;

    const url = `https://randomuser.me/api/?results=${cantidad}&gender=${genero}&nat=${nacionalidad}`;
    return url;
}

boton.addEventListener("click", async ()=>{
  const url = generarURL();
  cargando.style.display="block";
  tabla.innerHTML = "";

  try{
    const respuesta = await fetch(url);
    const datos = await respuesta.json();

    for(let usuario of datos.results){
      const nombre = usuario.name.first + " " + usuario.name.last;
      const email = usuario.email;
      const edad = usuario.dob.age;
      const imagen = usuario.picture.medium;


      const fila = crearFila(nombre, email, edad, imagen);
      tabla.appendChild(fila);
    }

  } catch(error){
    alert("Error : " + error.message);
  } finally{
    cargando.style.display="none";
  }
});


function crearFila(nombre,email,edad,url_imagen){
  const fila=document.createElement("tr");
  
  const imagen=document.createElement("img");
  imagen.src=url_imagen;

  const td_imagen=document.createElement("td");
  td_imagen.appendChild(imagen);

  const td_nombre=document.createElement("td");
  td_nombre.innerHTML=nombre;

  const td_email=document.createElement("td");
  td_email.innerHTML=email;

  const td_edad=document.createElement("td");
  td_edad.innerHTML=edad;

  
  fila.appendChild(td_nombre);
  fila.appendChild(td_email);
  fila.appendChild(td_edad);
  fila.appendChild(td_imagen);
  

  return fila;
}