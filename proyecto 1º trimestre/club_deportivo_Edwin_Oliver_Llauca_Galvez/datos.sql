-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-11-2024
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `club_deportivo`
CREATE DATABASE IF NOT EXISTS club_deportivo;
USE club_deportivo;

--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas`
--

CREATE TABLE `citas` (
  `id` int(11) NOT NULL,
  `socio` int(11) NOT NULL,
  `servicio` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticia`
--

CREATE TABLE `noticia` (
  `id` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `contenido` text NOT NULL,
  `imagen` varchar(100) DEFAULT NULL,
  `fecha_publicacion` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `noticia` (`id`, `titulo`, `contenido`, `imagen`, `fecha_publicacion`) VALUES
(1, 'Inauguración de Nuevas Instalaciones', 
'Estamos encantados de anunciar la inauguración de nuestras nuevas instalaciones de entrenamiento. 
Este espacio está diseñado para ofrecer a nuestros socios lo mejor en equipamiento y comodidad. 
Incluye una nueva área de CrossFit, una sala de meditación con ambientes relajantes, y un gimnasio completamente equipado con máquinas de última generación. 
No te pierdas la oportunidad de visitar estas instalaciones que estarán disponibles a partir del 1 de diciembre. 
Además, ofreceremos tours guiados y demostraciones gratuitas durante la primera semana.', 
'assets/img/noticia1.jpg', '2024-11-15'),

(2, 'Evento Especial: Maratón Navideña de Zumba', 
'Ven a disfrutar de nuestra maratón navideña de Zumba el próximo 20 de diciembre. 
Este evento es ideal para quemar calorías mientras bailas al ritmo de música festiva. 
Durante el evento, contaremos con la participación de instructores internacionales que nos traerán las mejores coreografías para esta temporada. 
También habrá premios para los socios más entusiastas y rifas de accesorios deportivos. 
No olvides venir con ropa cómoda y muchas ganas de pasarla bien. ¡Te esperamos!', 
'assets/img/noticia2.jpg', '2024-11-25'),

(3, 'Horarios de Fin de Año en el Club Deportivo', 
'A medida que se acerca el final del año, queremos informarte sobre los horarios especiales que tendremos en diciembre y enero. 
Durante estas fechas, ajustaremos nuestras actividades para adaptarnos a tus necesidades. 
El gimnasio estará abierto de 6:00 a 14:00 los días festivos, y las clases grupales tendrán horarios especiales. 
Te invitamos a revisar nuestro calendario en línea para conocer todos los detalles. 
¡No dejes que las festividades sean una excusa para descuidar tu salud y bienestar!', 
'assets/img/noticia3.jpg', '2024-11-18'),

(4, 'Competencia Interna de CrossFit: Demuestra tu Fuerza', 
'Te invitamos a participar en nuestra Competencia Interna de CrossFit el 10 de diciembre. 
Este evento está diseñado para socios de todos los niveles y es una excelente oportunidad para demostrar tu progreso y habilidades. 
Habrá diferentes categorías según el nivel de experiencia, desde principiantes hasta avanzados. 
Además, ofreceremos premios para los ganadores y certificados de participación para todos los asistentes. 
¡Es momento de llevar tu entrenamiento al siguiente nivel!', 
'assets/img/noticia4.jpg', '2024-11-20'),

(5, 'Nueva Clase de Yoga Restaurativo: Encuentra tu Equilibrio', 
'Estamos emocionados de anunciar nuestra nueva clase de Yoga Restaurativo, diseñada para aliviar el estrés y mejorar la flexibilidad. 
Esta clase está dirigida por Sofía Torres, nuestra experta en yoga y bienestar, quien te guiará en una experiencia única de relajación profunda. 
Las sesiones se llevarán a cabo todos los martes y jueves a las 7:00 pm en nuestra sala de yoga recién renovada. 
No importa tu nivel de experiencia, esta clase es ideal para cualquiera que busque un momento de calma en medio de la rutina diaria. 
¡Reserva tu lugar ahora!', 
'assets/img/noticia5.jpg', '2024-11-22'),

(6, 'Conferencia Gratuita sobre Nutrición Deportiva', 
'El próximo 5 de diciembre, ofrecemos una conferencia gratuita sobre nutrición deportiva. 
Este evento estará liderado por el Dr. Luis Martínez, especialista en alimentación y rendimiento físico. 
Durante la conferencia, aprenderás sobre cómo optimizar tu dieta para alcanzar tus metas deportivas, la importancia de la hidratación, y los mejores suplementos para tu tipo de entrenamiento. 
Además, podrás hacer preguntas y recibir consejos personalizados al final de la charla. 
No te pierdas esta oportunidad única para mejorar tu rendimiento a través de la nutrición.', 
'assets/img/noticia2.jpg', '2024-11-28');
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio`
--

CREATE TABLE `servicio` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `duracion` int(11) NOT NULL,
  `precio` decimal(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `servicio` (`id`, `descripcion`, `duracion`, `precio`) VALUES
(1, 'Entrenamiento Personal', 60, 30.00),
(2, 'Masaje Deportivo', 45, 25.00),
(3, 'Clases de Yoga', 90, 20.00),
(4, 'Clase de Spinning', 50, 15.00),
(5, 'Sesión de Zumba', 60, 18.00),
(6, 'Pilates Avanzado', 70, 22.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `socio`
--

CREATE TABLE `socio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `edad` int(11) DEFAULT NULL,
  `usuario` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `foto` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`) 
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO socio (nombre, edad, usuario, password, telefono, foto) VALUES
('Carlos Mendoza', 28, 'cmendoza', 'hashed_password3', '5553334444', 'assets/img/carlos.jpg'),
('Ana López', 32, 'alopez', 'hashed_password4', '5559876543', 'assets/img/ana.jpg'),
('Luis Fernández', 26, 'lfernandez', 'hashed_password5', '5552345678', 'assets/img/luis.jpg'),
('Maria Torres', 29, 'mtorres', 'hashed_password6', '5558765432', 'assets/img/maria.jpg'),
('Juan Ruiz', 35, 'jruiz', 'hashed_password7', '5557654321', 'assets/img/juan.jpg');


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `testimonio`
--

CREATE TABLE `testimonio` (
  `id` int(11) NOT NULL,
  `autor` int(11) NOT NULL,
  `contenido` text NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `testimonio` (`id`, `autor`, `contenido`, `fecha`) VALUES
(1, 1, 'Gran experiencia en el club, los entrenadores son muy atentos.', '2024-11-30'),
(2, 2, 'Excelentes instalaciones y ambiente.', '2024-12-01'),
(3, 3, 'Las clases de spinning son increíbles, muy motivadoras.', '2024-12-02'),
(4, 4, 'Los masajes deportivos me ayudan mucho en mi recuperación.', '2024-12-03'),
(5, 5, 'La atención personalizada es lo mejor del club.', '2024-12-04');



INSERT INTO `citas` (`id`, `socio`, `servicio`, `fecha`, `hora`, `estado`) VALUES
(1, 1, 1, '2024-11-30', '10:00:00', 0),
(2, 1, 2, '2024-12-05', '11:00:00', 0),
(3, 1, 5, '2024-12-10', '17:30:00', 0),
(4, 2, 2, '2024-12-02', '11:00:00', 0),
(5, 2, 6, '2024-12-06', '08:00:00', 0),
(6, 3, 1, '2024-11-29', '09:00:00', 0),
(7, 3, 3, '2024-12-03', '12:00:00', 0),
(8, 4, 4, '2024-11-30', '15:30:00', 0),
(9, 5, 7, '2024-12-07', '18:45:00', 0),
(10, 6, 8, '2024-12-08', '14:00:00', 0);

-- --------------------------------------------------------

--
-- Índices para tablas volcadas
--

ALTER TABLE `citas` ADD PRIMARY KEY (`id`);
ALTER TABLE `noticia` ADD PRIMARY KEY (`id`);
ALTER TABLE `servicio` ADD PRIMARY KEY (`id`);
ALTER TABLE `testimonio` ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

ALTER TABLE `citas` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
ALTER TABLE `noticia` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
ALTER TABLE `servicio` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
ALTER TABLE `testimonio` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

COMMIT;
