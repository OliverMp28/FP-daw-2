-- Eliminar las tablas si existen
DROP TABLE IF EXISTS Matriculas;
DROP TABLE IF EXISTS Alumnos;
DROP TABLE IF EXISTS Asignaturas;

-- Crear tabla Alumnos
CREATE TABLE Alumnos (
  dni VARCHAR(9) PRIMARY KEY,
  nombre_completo VARCHAR(100),
  edad INT
);

-- Crear tabla Asignaturas
CREATE TABLE Asignaturas (
  id_asignatura INT AUTO_INCREMENT,
  nombre_asignatura VARCHAR(100),
  creditos INT,
  PRIMARY KEY (id_asignatura)
);


-- Crear tabla Matriculas
CREATE TABLE Matriculas (
  id_matricula INT AUTO_INCREMENT,
  dni_alumno VARCHAR(9),
  id_asignatura INT,
  anio INT,
  nota INT,
  PRIMARY KEY (id_matricula),
  FOREIGN KEY (dni_alumno) REFERENCES Alumnos(dni),
  FOREIGN KEY (id_asignatura) REFERENCES Asignaturas(id_asignatura)
);


-- Insertar datos en Alumnos
INSERT INTO Alumnos (dni, nombre_completo, edad) VALUES
('55555555Z', 'Ramón Torres', 19),
('22222222B', 'María López', 21),
('33333333C', 'Paloma Ruiz', 24),
('44444444R', 'Isabel Perea', 25),
('66666666D', 'Carlos Gómez', 22),
('77777777E', 'Lucía Martínez', 20),
('88888888F', 'Antonio Fernández', 23),
('99999999G', 'Marta González', 26),
('11111111H', 'Javier Pérez', 27);


-- Insertar datos en Asignaturas
INSERT INTO Asignaturas (nombre_asignatura, creditos) VALUES
('Bases de datos', 15),
('Programación', 18),
('Lenguajes de marcas', 23),
('Redes de computadoras', 20),
('Sistemas operativos', 25),
('Algoritmos', 12),
('Ingeniería de software', 22),
('Matemáticas discretas', 14);



-- Insertar datos en Matriculas
INSERT INTO Matriculas (dni_alumno, id_asignatura, anio, nota) VALUES
('55555555Z', 1, 2020, 8),
('55555555Z', 2, 2020, 4),
('22222222B', 1, 2019, 4),
('22222222B', 1, 2020, 6),
('33333333C', 2, 2019, 7),
('44444444R', 3, 2020, 9),
('66666666D', 4, 2024, 5),
('77777777E', 2, 2024, 6),
('88888888F', 5, 2020, 10),
('99999999G', 4, 2024, 9),
('11111111H', 6, 2024, 7),
('55555555Z', 7, 2024, 8),
('22222222B', 3, 2024, 6),
('33333333C', 5, 2024, 7),
('44444444R', 8, 2020, 8),
('66666666D', 2, 2024, 4),
('77777777E', 6, 2024, 9),
('88888888F', 7, 2024, 6),
('99999999G', 8, 2024, 10),
('11111111H', 3, 2024, 5);
