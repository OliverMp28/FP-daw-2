//https://randomuser.me/api/?seed=abc&&results=20
//https://randomuser.me/


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