-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         5.5.8-log - MySQL Community Server (GPL)
-- SO del servidor:              Win32
-- HeidiSQL Versión:             9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Volcando estructura de base de datos para gestion_turnos_allus
CREATE DATABASE IF NOT EXISTS `gestion_turnos_allus` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `gestion_turnos_allus`;


-- Volcando estructura para tabla gestion_turnos_allus.asesores
CREATE TABLE IF NOT EXISTS `asesores` (
  `idAsesor` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `identificacion` int(11) NOT NULL,
  `username` varchar(45) NOT NULL,
  `clave` text NOT NULL,
  `asesorLider` set('Si','No') DEFAULT 'No',
  `horaInicioLunes` time NOT NULL DEFAULT '07:00:00',
  `horaFinLunes` time NOT NULL DEFAULT '20:00:00',
  `horaInicioMartes` time NOT NULL DEFAULT '07:00:00',
  `horaFinMartes` time NOT NULL DEFAULT '20:00:00',
  `horaInicioMiercoles` time NOT NULL DEFAULT '07:00:00',
  `horaFinMiercoles` time NOT NULL DEFAULT '20:00:00',
  `horaInicioJueves` time NOT NULL DEFAULT '07:00:00',
  `horaFinJueves` time NOT NULL DEFAULT '20:00:00',
  `horaInicioViernes` time NOT NULL DEFAULT '07:00:00',
  `horaFinViernes` time NOT NULL DEFAULT '20:00:00',
  `horaInicioSabado` time NOT NULL DEFAULT '07:00:00',
  `horaFinSabado` time NOT NULL DEFAULT '20:00:00',
  `horaInicioDomingo` time NOT NULL DEFAULT '07:00:00',
  `horaFinDomingo` time NOT NULL DEFAULT '20:00:00',
  `creadoPor` int(11) NOT NULL,
  `fechaCreado` datetime NOT NULL,
  `modificadoPor` int(11) NOT NULL,
  `fechaModificado` datetime NOT NULL,
  `habilitado` set('Si','No') NOT NULL DEFAULT 'Si',
  PRIMARY KEY (`idAsesor`),
  KEY `fk_ase_creado_idx` (`creadoPor`),
  KEY `fk_ase_modificado_idx` (`modificadoPor`),
  CONSTRAINT `fk_ase_creado` FOREIGN KEY (`creadoPor`) REFERENCES `usuarios` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_ase_modificado` FOREIGN KEY (`modificadoPor`) REFERENCES `usuarios` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.


-- Volcando estructura para tabla gestion_turnos_allus.turnos
CREATE TABLE IF NOT EXISTS `turnos` (
  `idTurno` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `fechaInicio` date NOT NULL,
  `fechaFin` date NOT NULL,
  `creadoPor` int(11) NOT NULL,
  `fechaCreado` datetime NOT NULL,
  `modificadoPor` int(11) NOT NULL,
  `fechaModificado` datetime NOT NULL,
  `habilitado` set('Si','No') NOT NULL DEFAULT 'Si',
  PRIMARY KEY (`idTurno`),
  KEY `fk_turno_creado_idx` (`creadoPor`),
  KEY `fk_turno_modificado_idx` (`modificadoPor`),
  CONSTRAINT `fk_turno_creado` FOREIGN KEY (`creadoPor`) REFERENCES `usuarios` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_turno_modificado` FOREIGN KEY (`modificadoPor`) REFERENCES `usuarios` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.


-- Volcando estructura para tabla gestion_turnos_allus.turnos_asesores
CREATE TABLE IF NOT EXISTS `turnos_asesores` (
  `idTurnoAsesor` int(11) NOT NULL AUTO_INCREMENT,
  `idTurno` int(11) NOT NULL,
  `idAsesor` int(11) NOT NULL,
  `creadoPor` int(11) NOT NULL,
  `fechaCreado` datetime NOT NULL,
  `modificadoPor` int(11) NOT NULL,
  `fechaModificado` datetime NOT NULL,
  `habilitado` set('Si','No') NOT NULL DEFAULT 'Si',
  PRIMARY KEY (`idTurnoAsesor`),
  KEY `fk_turase_turno_idx` (`idTurno`),
  KEY `fk_turase_asesor_idx` (`idAsesor`),
  KEY `fk_turase_creado_idx` (`creadoPor`),
  KEY `fk_turase_modificado_idx` (`modificadoPor`),
  CONSTRAINT `fk_turase_turno` FOREIGN KEY (`idTurno`) REFERENCES `turnos` (`idTurno`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_turase_asesor` FOREIGN KEY (`idAsesor`) REFERENCES `asesores` (`idAsesor`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_turase_creado` FOREIGN KEY (`creadoPor`) REFERENCES `usuarios` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_turase_modificado` FOREIGN KEY (`modificadoPor`) REFERENCES `usuarios` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.


-- Volcando estructura para tabla gestion_turnos_allus.turnos_asesores_novedades
CREATE TABLE IF NOT EXISTS `turnos_asesores_novedades` (
  `idTurnoAsesorNovedad` int(11) NOT NULL AUTO_INCREMENT,
  `idTurnoDetalle` int(11) NOT NULL,
  `idAsesor` int(11) NOT NULL,
  `idNovedad` int(11) DEFAULT NULL,
  `horaInicio` time NOT NULL,
  `horaFin` time NOT NULL,
  `observaciones` text,
  `creadoPor` int(11) NOT NULL,
  `fechaCreado` datetime NOT NULL,
  `modificadoPor` int(11) NOT NULL,
  `fechaModificado` datetime NOT NULL,
  `habilitado` set('Si','No') NOT NULL DEFAULT 'Si',
  PRIMARY KEY (`idTurnoAsesorNovedad`),
  KEY `fk_tuasno_turnoDetalle_idx` (`idTurnoDetalle`),
  KEY `fk_tuasno_asesor_idx` (`idAsesor`),
  KEY `fk_tuasno_novedad_idx` (`idNovedad`),
  KEY `fk_tuasno_creado_idx` (`creadoPor`),
  KEY `fk_tuasno_modificado_idx` (`modificadoPor`),
  CONSTRAINT `fk_tuasno_turnoDetalle` FOREIGN KEY (`idTurnoDetalle`) REFERENCES `turnos_detalles` (`idTurnoDetalle`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tuasno_asesor` FOREIGN KEY (`idAsesor`) REFERENCES `asesores` (`idAsesor`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tuasno_novedad` FOREIGN KEY (`idNovedad`) REFERENCES `novedades` (`idNovedad`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tuasno_creado` FOREIGN KEY (`creadoPor`) REFERENCES `usuarios` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tuasno_modificado` FOREIGN KEY (`modificadoPor`) REFERENCES `usuarios` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.


-- Volcando estructura para tabla gestion_turnos_allus.turnos_detalles
CREATE TABLE IF NOT EXISTS `turnos_detalles` (
  `idTurnoDetalle` int(11) NOT NULL AUTO_INCREMENT,
  `idTurno` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `horaInicio` time NOT NULL,
  `horaFin` time NOT NULL,
  `creadoPor` int(11) NOT NULL,
  `fechaCreado` datetime NOT NULL,
  `modificadoPor` int(11) NOT NULL,
  `fechaModificado` datetime NOT NULL,
  `habilitado` set('Si','No') NOT NULL DEFAULT 'Si',
  PRIMARY KEY (`idTurnoDetalle`),
  KEY `fk_turnodet_turno_idx` (`idTurno`),
  KEY `fk_turnodet_creado_idx` (`creadoPor`),
  KEY `fk_turnodet_modificado_idx` (`modificadoPor`),
  CONSTRAINT `fk_turnodet_turno` FOREIGN KEY (`idTurno`) REFERENCES `turnos` (`idTurno`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_turnodet_creado` FOREIGN KEY (`creadoPor`) REFERENCES `usuarios` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_turnodet_modificado` FOREIGN KEY (`modificadoPor`) REFERENCES `usuarios` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.


-- Volcando estructura para tabla gestion_turnos_allus.turnos_detalles_pausas
CREATE TABLE IF NOT EXISTS `turnos_detalles_pausas` (
  `idTurnoDetallePausa` int(11) NOT NULL AUTO_INCREMENT,
  `idTurnoDetalle` int(11) NOT NULL,
  `horaInicio` time NOT NULL,
  `horaFin` time NOT NULL,
  `descripcion` varchar(45) NOT NULL,
  `creadoPor` int(11) NOT NULL,
  `fechaCreado` datetime NOT NULL,
  `modificadoPor` int(11) NOT NULL,
  `fechaModificado` datetime NOT NULL,
  `habilitado` set('Si','No') NOT NULL DEFAULT 'Si',
  PRIMARY KEY (`idTurnoDetallePausa`),
  KEY `fk_turdepa_turnoDetalle_idx` (`idTurnoDetalle`),
  KEY `fk_turdepa_creado_idx` (`creadoPor`),
  KEY `fk_turdepa_modificado_idx` (`modificadoPor`),
  CONSTRAINT `fk_turdepa_turnoDetalle` FOREIGN KEY (`idTurnoDetalle`) REFERENCES `turnos_detalles` (`idTurnoDetalle`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_turdepa_creado` FOREIGN KEY (`creadoPor`) REFERENCES `usuarios` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_turdepa_modificado` FOREIGN KEY (`modificadoPor`) REFERENCES `usuarios` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
