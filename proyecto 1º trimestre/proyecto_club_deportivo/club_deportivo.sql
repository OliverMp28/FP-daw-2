-- Archivo SQL para la base de datos 'club_deportivo'

-- Creación de la base de datos
CREATE DATABASE IF NOT EXISTS club_deportivo;
USE club_deportivo;

-- Tabla 'socio'
CREATE TABLE socio (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    edad INT,
    usuario VARCHAR(30) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    telefono VARCHAR(15),
    foto VARCHAR(100)
);

-- Tabla 'servicio'
CREATE TABLE servicio (
    id INT AUTO_INCREMENT PRIMARY KEY,
    descripcion VARCHAR(100) NOT NULL,
    duracion INT NOT NULL,  -- en minutos
    precio DECIMAL(8, 2) NOT NULL
);

-- Tabla 'testimonio'
CREATE TABLE testimonio (
    id INT AUTO_INCREMENT PRIMARY KEY,
    autor INT NOT NULL,
    contenido TEXT NOT NULL,
    fecha DATE NOT NULL,
    FOREIGN KEY (autor) REFERENCES socio(id) ON DELETE CASCADE
);

-- Tabla 'noticia'
CREATE TABLE noticia (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(100) NOT NULL,
    contenido TEXT NOT NULL,
    imagen VARCHAR(100),
    fecha_publicacion DATE NOT NULL
);

-- Tabla 'citas'
CREATE TABLE citas (
    socio INT NOT NULL,
    servicio INT NOT NULL,
    fecha DATE NOT NULL,
    hora TIME NOT NULL,
    PRIMARY KEY (socio, servicio, fecha, hora),
    FOREIGN KEY (socio) REFERENCES socio(id) ON DELETE CASCADE,
    FOREIGN KEY (servicio) REFERENCES servicio(id) ON DELETE CASCADE
);

-- Datos de ejemplo para la tabla 'socio'
INSERT INTO socio (nombre, edad, usuario, password, telefono, foto) VALUES
('Carlos Mendoza', 28, 'cmendoza', 'hashed_password3', '5553334444', '/uploads/carlos.jpg'),
('Ana López', 32, 'alopez', 'hashed_password4', '5559876543', '/uploads/ana.jpg'),
('Luis Fernández', 26, 'lfernandez', 'hashed_password5', '5552345678', '/uploads/luis.jpg'),
('Sofía Torres', 29, 'storres', 'hashed_password6', '5558765432', '/uploads/sofia.jpg'),
('Pedro Ruiz', 35, 'pruiz', 'hashed_password7', '5557654321', '/uploads/pedro.jpg'),
('Elena Martínez', 22, 'emartinez', 'hashed_password8', '5555678901', '/uploads/elena.jpg');

-- Datos de ejemplo para la tabla 'servicio'
INSERT INTO servicio (descripcion, duracion, precio) VALUES
('Clase de Spinning', 50, 15.00),
('Sesión de Zumba', 60, 18.00),
('Pilates Avanzado', 70, 22.00),
('CrossFit', 60, 35.00),
('Entrenamiento de Fuerza', 45, 28.00),
('Meditación Guiada', 40, 12.00);

-- Datos de ejemplo para la tabla 'testimonio'
INSERT INTO testimonio (autor, contenido, fecha) VALUES
(3, 'Las clases de spinning son increíbles, muy motivadoras.', '2023-10-25'),
(4, 'Los masajes deportivos me ayudan mucho en mi recuperación.', '2023-11-08'),
(5, 'La atención personalizada es lo mejor del club.', '2023-09-20'),
(6, 'Gran ambiente en las clases de yoga, me siento renovada.', '2023-11-03'),
(1, 'El servicio de entrenamiento de fuerza ha mejorado mi rendimiento.', '2023-11-15'),
(2, 'La meditación guiada es perfecta para relajarme después del trabajo.', '2023-10-30');

-- Datos de ejemplo para la tabla 'noticia'
INSERT INTO noticia (titulo, contenido, imagen, fecha_publicacion) VALUES
('Clases de Zumba Abiertas al Público', 'Participa en nuestras clases de zumba todos los sábados.', '/uploads/noticia3.jpg', '2023-10-10'),
('Seminario de Nutrición Deportiva', 'Aprende sobre la alimentación ideal para deportistas.', '/uploads/noticia4.jpg', '2023-11-02'),
('Competencia de CrossFit', 'Únete a nuestra competencia mensual y prueba tus límites.', '/uploads/noticia5.jpg', '2023-10-20'),
('Día de Puertas Abiertas', 'Ven y conoce nuestras instalaciones sin costo el próximo fin de semana.', '/uploads/noticia6.jpg', '2023-11-09'),
('Nueva Sala de Meditación', 'Hemos inaugurado una nueva sala para sesiones de meditación.', '/uploads/noticia7.jpg', '2023-09-15'),
('Actualización de Horarios', 'Consulta los nuevos horarios para la temporada de invierno.', '/uploads/noticia8.jpg', '2023-11-20');

-- Datos de ejemplo para la tabla 'citas'
INSERT INTO citas (socio, servicio, fecha, hora) VALUES
(3, 1, '2023-12-01', '09:00:00'),
(4, 3, '2023-12-02', '10:30:00'),
(5, 5, '2023-12-03', '15:00:00'),
(6, 4, '2023-12-04', '14:00:00'),
(1, 2, '2023-12-05', '11:00:00'),
(2, 6, '2023-12-06', '08:00:00'),
(3, 2, '2023-12-07', '12:00:00'),
(4, 1, '2023-12-08', '13:30:00'),
(5, 4, '2023-12-09', '16:00:00'),
(6, 3, '2023-12-12', '09:45:00'),
(1, 5, '2023-12-13', '17:30:00'),
(2, 6, '2023-12-14', '07:15:00');

