    CREATE DATABASE IF NOT EXISTS agenda_contactos;
    USE agenda_contactos;

    -- Tabla de tipos de contacto
    CREATE TABLE tipos (
        tipo_id INT AUTO_INCREMENT PRIMARY KEY,
        tipo_nombre NVARCHAR(250) NOT NULL,
        tipo_descripcion TEXT
    );

    -- Tabla de personas
    CREATE TABLE personas (
        persona_id INT AUTO_INCREMENT PRIMARY KEY,
        nombre NVARCHAR(250) NOT NULL,
        apellido NVARCHAR(250) NOT NULL,
        email NVARCHAR(250),
        tipo_id INT,
        FOREIGN KEY (tipo_id) REFERENCES tipos(tipo_id)
            ON DELETE SET NULL
            ON UPDATE CASCADE
    );

    -- Tabla de celulares
    CREATE TABLE celulares (
        celular_id INT AUTO_INCREMENT PRIMARY KEY,
        telefono NVARCHAR(50) NOT NULL,
        persona_id INT,
        FOREIGN KEY (persona_id) REFERENCES personas(persona_id)
            ON DELETE CASCADE
    );

    -- Datos de ejemplo para tipos
    INSERT INTO tipos (tipo_nombre, tipo_descripcion) VALUES
    ('Colegas', 'Personas del entorno laboral o profesional.'),
    ('Conocidos', 'Amistades casuales o relaciones informales.'),
    ('Familiares', 'Miembros de la familia o parientes.');

    -- Personas de ejemplo
    INSERT INTO personas (nombre, apellido, email, tipo_id) VALUES
    ('Daniela', 'Ramos', 'daniela.ramos@mail.com', 1),
    ('Carlos', 'Vega', 'carlos.vega@workmail.com', 2),
    ('Lucía', 'Medina', 'lucia.medina@yahoo.com', 3);

    -- Teléfonos relacionados
    INSERT INTO celulares (telefono, persona_id) VALUES
    ('79991122', 1),
    ('75557733', 1),
    ('72220011', 2),
    ('73338844', 3);
