CREATE DATABASE IF NOT EXISTS gestion_usuarios;

USE gestion_usuarios;

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,        
    usuario VARCHAR(50) NOT NULL UNIQUE,         
    nombre_completo VARCHAR(100) NOT NULL,   
    password VARCHAR(255) NOT NULL,           
    tipo_usuario VARCHAR(20) NOT NULL           
);

INSERT INTO usuarios (usuario, nombre_completo, password, tipo_usuario)
VALUES (
    'admin',
    'Administrador del Sistema',
    '$2y$10$/Gak8Q57m0Lde.NKDbYZAeuwFoI7iMq2YUKoKlmNku2Gg.c2h3r2.', 
    'admin'
);
