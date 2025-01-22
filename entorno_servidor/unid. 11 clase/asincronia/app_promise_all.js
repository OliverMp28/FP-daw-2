const images = [
    'https://firebasestorage.googleapis.com/v0/b/chat-7d403.appspot.com/o/muebles%2F01_albany_table.jpg?alt=media&token=fe8f3d8c-27ea-49fb-afbc-cd3a9fd5a07e',
    'https://firebasestorage.googleapis.com/v0/b/chat-7d403.appspot.com/o/muebles%2F02_accent_chair.jpg?alt=media&token=8751f618-1322-4dac-a4fc-ab1d0e3fc5c6',
    'https://firebasestorage.googleapis.com/v0/b/chat-7d403.appspot.com/o/muebles%2F03_wooden_table.jpg?alt=media&token=d0c42974-ab71-494e-a196-723eb05a5eab'
];

const promises = []; // Array para almacenar las Promesas manualmente

for (let i = 0; i < images.length; i++) {
    promises.push(loadImage(images[i])); // Agregar Promesas al array
}

Promise.all(promises)
    .then(imgs => {
        for (const img of imgs) {
            document.body.appendChild(img); // Agregar imágenes al body
        }
    })
    .catch(err => console.error('Error cargando alguna imagen:', err));

// Función loadImage (mismo comportamiento que antes)
function loadImage(url) {
    return new Promise((resolve, reject) => {
        const img = new Image();
        img.onload = () => resolve(img);
        img.onerror = () => reject(new Error(`Error al cargar la imagen: ${url}`));
        img.style.width="25%";
        img.src = url;
    });
}
