// Importamos el http
const http = require('http');

const server = http.createServer((req, res) => {
  res.setHeader('Content-Type', 'text/plain');
  
  res.end('Hola mundo, conexion con node.js correctamente!');
});

//coloco el servidor en el puerto 3000
server.listen(3000, () => {
  console.log('Servidor conectado correctamente en http://localhost:3000');
});
