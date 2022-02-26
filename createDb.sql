CREATE DATABASE password;

use password;

CREATE TABLE areas (
    id INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(255) NOT NULL
);


CREATE TABLE empleado_rol(
    empleado_id INT(11) NOT NULL,
    rol_id INT(11) NOT NULL
);


CREATE TABLE empleados (
    id INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    sexo CHAR(1) NOT NULL,
    area_id INT(11) NOT NULL,
    boletin INT(11) NOT NULL,
    descripcion TEXT NOT NULL
);

CREATE TABLE roles (
    id INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(255) NOT NULL
);