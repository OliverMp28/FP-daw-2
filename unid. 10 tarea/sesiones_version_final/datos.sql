-- Crear la base de datos
CREATE DATABASE IF NOT EXISTS gestion_usuarios;

-- Usar la base de datos creada
USE gestion_usuarios;

-- Crear la tabla usuarios
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,            -- Identificador único
    usuario VARCHAR(50) NOT NULL UNIQUE,          -- Nombre de usuario único
    nombre_completo VARCHAR(100) NOT NULL,        -- Nombre completo
    password VARCHAR(255) NOT NULL,               -- Contraseña cifrada
    tipo_usuario VARCHAR(20) NOT NULL             -- Tipo de usuario (admin, socio, normal)
);

-- Insertar el usuario administrador inicial
INSERT INTO usuarios (usuario, nombre_completo, password, tipo_usuario)
VALUES (
    'admin',
    'Administrador del Sistema',
    '$2y$10$FMHC4PxD3EeTbz8j5P0guO4OuLgEuL2XjP0c2Vh3NiKoNqTIgD8kC', -- Contraseña: admin
    'admin'
);
