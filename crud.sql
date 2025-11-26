--  BASE DE DATOS NORMALIZADA
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--  TABLA USUARIOS
CREATE TABLE IF NOT EXISTS usuarios (
  id_usuario INT AUTO_INCREMENT PRIMARY KEY,
  usuario VARCHAR(60) NOT NULL,
  clave VARCHAR(255) NOT NULL,
  nombre VARCHAR(50) NOT NULL,
  apellidos VARCHAR(50) NOT NULL,
  perfil VARCHAR(10) NOT NULL,
  estado VARCHAR(10) DEFAULT NULL
) ENGINE=InnoDB;

--  TABLA CLIENTE
CREATE TABLE IF NOT EXISTS cliente (
  id_cliente INT AUTO_INCREMENT PRIMARY KEY,
  nombre_cliente VARCHAR(50),
  apellido_cliente VARCHAR(50),
  telefono_cliente VARCHAR(20),
  email_cliente VARCHAR(100),
  direccion_cliente VARCHAR(200)
) ENGINE=InnoDB;

--  TABLA TIPO DE EVENTO
CREATE TABLE IF NOT EXISTS tipoevento (
  id_tipoevento INT AUTO_INCREMENT PRIMARY KEY,
  descripcion_tipoevento VARCHAR(200)
) ENGINE=InnoDB;

--  TABLA METODO DE PAGO
CREATE TABLE IF NOT EXISTS metododepago (
  id_metodo INT AUTO_INCREMENT PRIMARY KEY,
  descripcion_metodo VARCHAR(200),
  tipo_metodo ENUM('Tarjeta de crédito','Tarjeta de débito','Transferencia bancaria')
) ENGINE=InnoDB;

--  TABLA ESTADO DE RESERVA
CREATE TABLE IF NOT EXISTS estadoreserva (
  id_estadoserva INT AUTO_INCREMENT PRIMARY KEY,
  descripcion VARCHAR(200)
) ENGINE=InnoDB;

--  TABLA EVENTOS NORMALIZADA
CREATE TABLE IF NOT EXISTS eventos (
  id_evento INT AUTO_INCREMENT PRIMARY KEY,
  nombre_evento VARCHAR(100),
  descripcion_evento TEXT,
  fecha_evento DATE,
  hora_evento TIME,
  lugar_evento VARCHAR(200),

  -- NUEVAS RELACIONES
  id_cliente INT,
  id_tipoevento INT,
  id_metodo_pago INT,
  id_estado INT,

  FOREIGN KEY (id_cliente) REFERENCES cliente(id_cliente),
  FOREIGN KEY (id_tipoevento) REFERENCES tipoevento(id_tipoevento),
  FOREIGN KEY (id_metodo_pago) REFERENCES metododepago(id_metodo),
  FOREIGN KEY (id_estado) REFERENCES estadoreserva(id_estadoserva)
) ENGINE=InnoDB;

--  TABLA SERVICIOS NORMALIZADA
DROP TABLE IF EXISTS servicios_eventos;

CREATE TABLE servicios (
  id_servicio INT AUTO_INCREMENT PRIMARY KEY,
  nombre_servicio VARCHAR(100) NOT NULL,
  precio DECIMAL(10,2) NOT NULL
) ENGINE=InnoDB;

--  TABLA PUENTE MUCHOS A MUCHOS: EVENTOS - SERVICIOS
CREATE TABLE eventos_servicios (
  id_evento INT NOT NULL,
  id_servicio INT NOT NULL,

  PRIMARY KEY (id_evento, id_servicio),

  FOREIGN KEY (id_evento) REFERENCES eventos(id_evento) ON DELETE CASCADE,
  FOREIGN KEY (id_servicio) REFERENCES servicios(id_servicio) ON DELETE CASCADE
) ENGINE=InnoDB;

--  TABLA CITAS (RELACIONADA CON USUARIOS)
CREATE TABLE IF NOT EXISTS citas (
  id_cita INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(60) NOT NULL,
  telefono VARCHAR(20) NOT NULL,
  fecha_cita DATE NOT NULL,
  fecha_registro TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  id_usuario INT NOT NULL,
  FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;

--  TABLA SUSCRIPCIONES (RELACIONADA CON USUARIOS)
CREATE TABLE IF NOT EXISTS suscripciones (
  id_suscripcion INT AUTO_INCREMENT PRIMARY KEY,
  id_usuario INT NOT NULL,
  correo VARCHAR(100) NOT NULL,
  tipo ENUM('un mes','un trimestre','un semestre','un año') NOT NULL,
  fecha_inicio DATE NOT NULL,
  fecha_fin DATE DEFAULT NULL,
  estado ENUM('activo','inactivo') DEFAULT 'activo',
  fecha_registro TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;

COMMIT;
