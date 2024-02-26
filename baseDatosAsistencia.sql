CREATE DATABASE ListaDeEstudiantes;

USE ListaDeEstudiantes;

select * from profesores;
select * from asignaturas;
select * from asistencia;
select * from alumnos;
select * from administradores;


-- Crear la tabla de Alumnos
CREATE TABLE Alumnos (
    ID_Alumno INT AUTO_INCREMENT,
    Nombre VARCHAR(50) NOT NULL,
    Apellido VARCHAR(50) NOT NULL,
    Correo VARCHAR(100) NOT NULL,
    Pass VARCHAR(255) NOT NULL,
    Especialidad ENUM('DAW', 'DAM', 'ASIR'),
    Foto VARCHAR(255), 
    passPredeterminada BOOLEAN DEFAULT TRUE,
    PRIMARY KEY (ID_Alumno)
);
-- Crear la tabla de Administradores
CREATE TABLE Administradores (
    ID_Administrador INT AUTO_INCREMENT,
    Nombre VARCHAR(50) NOT NULL,
    Apellido VARCHAR(50) NOT NULL,
    Correo VARCHAR(100) NOT NULL,
    Pass VARCHAR(255) NOT NULL,
     passPredeterminada BOOLEAN DEFAULT TRUE,
    PRIMARY KEY (ID_Administrador)
);
INSERT INTO Administradores (Nombre, Apellido, Correo, Pass, passPredeterminada)
VALUES ('admin1', 'Apellido1', 'admin1@correo.com', 'contrasena', TRUE),
       ('admin2', 'Apellido2', 'admin2@correo.com', 'contrasena', TRUE),
       ('admin3', 'Apellido3', 'admin3@correo.com', 'contrasena', TRUE);


ALTER TABLE Administradores
ADD COLUMN passPredeterminada BOOLEAN DEFAULT TRUE;
UPDATE Profesores
SET passPredeterminada = TRUE;

Update Profesores set passPredeterminada = false where Nombre='Angel';

-- Crear la tabla de Profesores
CREATE TABLE Profesores (
    ID_Profesor INT AUTO_INCREMENT,
    Nombre VARCHAR(50) NOT NULL,
    Apellido VARCHAR(50) NOT NULL,
    Correo VARCHAR(100) NOT NULL,
    pass VARCHAR(255) NOT NULL,
    passPredeterminada BOOLEAN DEFAULT TRUE,
    PRIMARY KEY (ID_Profesor)
);

-- Crear la tabla de Asignaturas
CREATE TABLE Asignaturas (
    ID_Asignatura INT AUTO_INCREMENT,
    Nombre_Asignatura VARCHAR(100) NOT NULL,
    PRIMARY KEY (ID_Asignatura)
);

ALTER TABLE Asistencia
ADD COLUMN Ruta_Justificante VARCHAR(255);


CREATE TABLE Asistencia (
    ID_Asistencia INT AUTO_INCREMENT,
    ID_Asignatura INT NOT NULL,
    Fecha_Asistencia DATE NOT NULL,
    ID_Alumno INT NOT NULL, 
    ID_Profesor INT NOT NULL,
    Asistencia ENUM('Asistencia', 'Retraso', 'Ausente','Justificado'),
    Hora TIME,
    observaciones text,
    Ruta_Justificante VARCHAR(255),
    PRIMARY KEY (ID_Asistencia),
    FOREIGN KEY (ID_Asignatura) REFERENCES Asignaturas(ID_Asignatura),
    FOREIGN KEY (ID_Alumno) REFERENCES Alumnos(ID_Alumno),
    FOREIGN KEY (ID_Profesor) REFERENCES Profesores(ID_Profesor)
);

