--Si no funciona tal vez sea por la primary key de citas, si pasa eso cea la tabla al final



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
'assets/img/noticia6.jpg', '2024-11-28');
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
  `tipo_usuario` varchar(20) NOT NULL,
  PRIMARY KEY (`id`) 
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO socio (id, nombre, edad, usuario, password, telefono, foto, tipo_usuario) VALUES
(1, 'Carlos Mendoza', 28, 'cmendoza', '$2y$10$CekrqojWXis5C2yWAOIlwOkI/pXGH2ShusuCcUxEHABkRrbWVuDiG', '+34555765436', 'assets/img/carlos.jpg', 'socio'),
(2, 'Ana López', 32, 'alopez', '$2y$10$CekrqojWXis5C2yWAOIlwOkI/pXGH2ShusuCcUxEHABkRrbWVuDiG', '+34555765435', 'assets/img/ana.jpg', 'socio'),
(3, 'Luis Fernández', 26, 'lfernandez', '$2y$10$CekrqojWXis5C2yWAOIlwOkI/pXGH2ShusuCcUxEHABkRrbWVuDiG', '+34555765434', 'assets/img/luis.jpg', 'socio'),
(4, 'Maria Torres', 29, 'mtorres', '$2y$10$CekrqojWXis5C2yWAOIlwOkI/pXGH2ShusuCcUxEHABkRrbWVuDiG', '+34555765433', 'assets/img/maria.jpg', 'socio'),
(5, 'Juan Ruiz', 35, 'jruiz', '$2y$10$CekrqojWXis5C2yWAOIlwOkI/pXGH2ShusuCcUxEHABkRrbWVuDiG', '+34555765432', 'assets/img/juan.jpg', 'socio'),
(0, 'Administrador', 0, 'admin', '$2y$10$DANhZDxSpyvRgcE221Dvb.Ni7T4sXcMZhnbQU4ZTFgnGuY0961OHy', 'assets/img/1739127395_59d6f00f-0306-4c1d-89d2-a89535787e35.png', 'admin');


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
-- Estructura de tabla para la tabla `productos`
-- --

CREATE TABLE `productos` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(255) NOT NULL UNIQUE,
  `descripcion` TEXT NULL,
  `precio` DECIMAL(10,2) NOT NULL,
  `stock` INT(11) NOT NULL DEFAULT 0,
  `categoria` VARCHAR(100) NULL,
  `imagen` VARCHAR(255) NULL, -- Ruta de la imagen almacenada en el servidor
  `fecha_creacion` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `productos` (`id`, `nombre`, `descripcion`, `precio`, `stock`, `categoria`, `imagen`, `fecha_creacion`) VALUES
(32, '5pcs Bandas de Resistencia TPE Bandas de Ejercicio', 'Público objetivo: Universal\r\ntipo de producto: tirar de la cuerda\r\nTipo de deporte: Ejercicios de estiramiento\r\nNivel de tensión: medio\r\nMaterial de tela: TPE\r\nFestival: Día de San Valentín, Pascua de Resurrección, Dia de la mujer, Día de la Madre\r\nColor: color mezclado', 2.89, 4, 'Accesorios', '/img/1740608967_producto1.jpg', '2025-02-26 22:29:27'),
(33, '1pc Escalera de entrenamiento de agilidad', 'Rango de edad aplicable: 14+\r\nMaterial principal: PP (polipropileno)\r\nColor: Oscuro, Amarillo\r\nNúmero de productos: 1\r\nID del artículo: EW16642\r\nOrigen: Zhejiang,China', 4.00, 8, 'Accesorios', '/img/1740609113_producto2.jpg', '2025-02-26 22:31:53'),
(34, 'Complejo Multivitaminico Completo', 'Más de 30 vitaminas y minerales, además de extractos de frutas y vegetales, combinados en un único suplemento para cubrir las necesidades diarias de un estilo de vida activo.\r\n\r\nNuestro complejo multivitamínico en polvo es el suplemento multivitaminas definitivo para estilos de vida activos. Los más de 30 ingredientes activos de cada suplemento contribuyen al funcionamiento normal del metabolismo de la energía*, del sistema inmunitario** y de la síntesis de aminoácidos***, complementando tu dieta con un perfil nutricional completo.\r\n\r\nNuestro complejo multivitamínico en polvo ha sido formulado por nutricionistas deportivos de élite para proporcionarte una dosis esencial de vitaminas y minerales. Contiene todos los básicos, como calcio, magnesio, zinc, vitamina C, vitamina D.\r\n\r\n*La vitamina C contribuye al metabolismo normal de la energía.\r\n\r\n**La vitamina D contribuye al funcionamiento normal del sistema inmunitario.\r\n\r\n***El magnesio contribuye a la síntesis normal de las proteínas.', 14.00, 10, 'Suplementos', '/img/1740609220_producto3.jpg', '2025-02-26 22:33:40'),
(35, 'Impact Whey Protein', 'Proteína de lactosuero de alta calidad, analizada para detectar impurezas y a un precio asequible; no es de extrañar que sea nuestro lactosuero más vendido desde hace más de 20 años.\r\n\r\nElaborada por nutricionistas que prestan suma atención hasta el último detalle, cada cacito aporta hasta 23 g de proteínas*, lo que favorece el desarrollo, el mantenimiento y la recuperación muscular1. Tanto si se trata de rendimiento como de bienestar o de mantener un estilo de vida equilibrado, es la nutrición diaria que necesitas para alcanzar todos tus objetivos. ', 12.00, 25, 'Suplementos', '/img/1740609494_producto4.jpg', '2025-02-26 22:38:14'),
(36, 'Camiseta sin mangas elastica y transpirable', 'Material: Poliéster\r\nEstampado: Imprimir\r\nEscarpado: semitransparente\r\nTela: Ligero estiramiento\r\nEstilo de cuello: Cuello redondo\r\nTipo: Regular\r\nTemporada: Verano\r\nInstrucciones de cuidado: Lavar a máquina o limpieza en seco profesional\r\nEstilo: Deportivo\r\nTipo de corte: Regular\r\n', 8.00, 20, 'Ropa', '/img/1740609601_producto5.jpg', '2025-02-26 22:40:01');



-- --------------------------------------------------------
-- Estructura de tabla pedidos
-- --
-- CREATE TABLE `pedidos` (
--   `id` INT(11) NOT NULL AUTO_INCREMENT,
--   `socio_id` INT(11) NOT NULL,
--   `producto_id` INT(11) NOT NULL,
--   `cantidad` INT(11) NOT NULL,
--   `fecha` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
--   PRIMARY KEY (`id`),
--   FOREIGN KEY (`socio_id`) REFERENCES `socio`(`id`) ON DELETE CASCADE,
--   FOREIGN KEY (`producto_id`) REFERENCES `productos`(`id`) ON DELETE CASCADE
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
