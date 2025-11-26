
CREATE DATABASE clinica_citas_db;
USE clinica_citas_db;

CREATE TABLE usuarios (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    correo VARCHAR(100) UNIQUE NOT NULL,
    telefono VARCHAR(20),
    contrasena VARCHAR(255) NOT NULL,
    rol ENUM('administrador', 'doctor', 'recepcionista', 'paciente') NOT NULL,
    estado ENUM('activo', 'inactivo') DEFAULT 'activo',
    fecha_registro DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE doctores (
    id_doctor INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL,
    especialidad VARCHAR(100) NOT NULL,
    cedula_profesional VARCHAR(50),
    consultorio VARCHAR(50),
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario)
        ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;

CREATE TABLE pacientes (
    id_paciente INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL,
    fecha_nacimiento DATE,
    sexo ENUM('M', 'F', 'Otro'),
    direccion VARCHAR(255),
    tipo_sangre VARCHAR(5),
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario)
        ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;

CREATE TABLE disponibilidad_doctores (
    id_disponibilidad INT AUTO_INCREMENT PRIMARY KEY,
    id_doctor INT NOT NULL,
    dia_semana ENUM('Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo') NOT NULL,
    hora TIME NOT NULL,
    FOREIGN KEY (id_doctor) REFERENCES doctores(id_doctor)
        ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;



CREATE TABLE citas (
    id_cita INT AUTO_INCREMENT PRIMARY KEY,
    id_paciente INT NOT NULL,
    id_doctor INT NOT NULL,
    fecha_cita DATE NOT NULL,
    hora_cita TIME NOT NULL,
    estado ENUM('pendiente', 'confirmada', 'cancelada', 'realizada') DEFAULT 'pendiente',
    motivo VARCHAR(255),
    notas TEXT,
    FOREIGN KEY (id_paciente) REFERENCES pacientes(id_paciente)
        ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (id_doctor) REFERENCES doctores(id_doctor)
        ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;

-- TABLA: expedientes_clinicos
CREATE TABLE expedientes_clinicos (
    id_expediente INT AUTO_INCREMENT PRIMARY KEY,
    id_paciente INT NOT NULL,
    id_doctor INT NOT NULL,
    fecha_registro DATETIME DEFAULT CURRENT_TIMESTAMP,
    diagnostico TEXT,
    tratamiento TEXT,
    observaciones TEXT,
    FOREIGN KEY (id_paciente) REFERENCES pacientes(id_paciente)
        ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (id_doctor) REFERENCES doctores(id_doctor)
        ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;

-- TABLA: reportes
CREATE TABLE reportes (
    id_reporte INT AUTO_INCREMENT PRIMARY KEY,
    tipo_reporte ENUM('citas', 'doctores', 'pacientes', 'expedientes') NOT NULL,
    fecha_generacion DATETIME DEFAULT CURRENT_TIMESTAMP,
    generado_por INT NOT NULL,
    ruta_archivo VARCHAR(255),
    FOREIGN KEY (generado_por) REFERENCES usuarios(id_usuario)
        ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB;

-- TABLA: respaldos
CREATE TABLE respaldos (
    id_respaldo INT AUTO_INCREMENT PRIMARY KEY,
    fecha_respaldo DATETIME DEFAULT CURRENT_TIMESTAMP,
    tipo ENUM('completo', 'incremental') DEFAULT 'completo',
    ruta_archivo VARCHAR(255),
    realizado_por INT,
    FOREIGN KEY (realizado_por) REFERENCES usuarios(id_usuario)
        ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB;


