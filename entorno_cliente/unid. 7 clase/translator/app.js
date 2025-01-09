
//https://api.mymemory.translated.net/get

const texto_spa=document.getElementById("spa");
const texto_eng=document.getElementById("eng");

texto_spa.addEventListener("input", 
    async ()=>{
        const texto = texto_spa.value.trim();
        const respuesta= await fetch(`https://api.mymemory.translated.net/get?q=${encodeURIComponent(texto)}&langpair=es|en`);
        const data = await respuesta.json();
        texto_eng.value = data.responseData.translatedText;

    }
)

