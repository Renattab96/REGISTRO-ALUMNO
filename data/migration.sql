Create database Tutorial_crud;
use Tutorial_crud;
Create table Alumnos(
    id INT (11) UNSIGNED AUTO_INCREMENT PRIMARY KEY
    nombre VARCHAR(30) NOT NULL,
    apellido VARCHAR(30) NOT NULL,
    email VARCHAR(50) NOT NULL,
    edad INT(3),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
