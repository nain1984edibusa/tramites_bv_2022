use tramites_bv;

CREATE TABLE `_ct_tramite17` (
  `tu_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `tu_codigo` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `usu_extid` int(11) NOT NULL,
  `usu_intid` int(11) NOT NULL,
  `tra_id` int(11) NOT NULL,
  `tu_fecha_ingreso` datetime NOT NULL,
  `tu_fecha_contcont` date NOT NULL,
  `tu_fecha_aprocont` date NOT NULL,
  `tu_fecha_contestacion` date DEFAULT NULL,
  `reg_id` int(11) NOT NULL,
  `et_id` int(11) NOT NULL,
  `tu_estado` 	ENUM ('ACT', 'INA') NOT NULL DEFAULT 'ACT',
  `tu_fecha_iniciocoa` date DEFAULT NULL,
  `tu_fecha_convalidacion` date DEFAULT NULL,
  `tu_fecha_concon` date DEFAULT NULL,
  `tu_fecha_concoa` date DEFAULT NULL,
  PRIMARY KEY (`tu_id`),
  KEY `fkUSU_ECODIGO` (`usu_extid`),
  KEY `fkTRA_ID` (`tra_id`),
  KEY `fkREG_CODIGO` (`reg_id`) USING BTREE,
  KEY `ftET_CODIGO` (`et_id`) USING BTREE,
  KEY `fkUSU_ICODIGO` (`usu_intid`) USING BTREE
)ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE `_ct_tramite17_anexos` (
  `tua_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `tua_codigoe` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `tua_rutaarchivo` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `tua_cumple` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `tua_observaciones` varchar(250) COLLATE utf8_spanish_ci DEFAULT NULL,
  `tu_id` int(11) NOT NULL,
  `anx_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`tua_id`),
  KEY `fk_TU_ID` (`tu_id`),
  KEY `fk_REQ_ID` (`anx_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE `_ct_tramite17_requisitos` (
  `tur_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `tur_rutaarchivo` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `tur_cumple` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `tur_observaciones` varchar(250) COLLATE utf8_spanish_ci DEFAULT NULL,
  `tu_id` int(11) NOT NULL,
  `req_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`tur_id`),
  KEY `fk_TU_ID` (`tu_id`),
  KEY `fk_REQ_ID` (`req_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE `_ct_tramite17_respuestas` (
  `tuc_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `tuc_tipocontestacion` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `tuc_rutaarchivo` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `tuc_marcolegal` text COLLATE utf8_spanish_ci NOT NULL,
  `tuc_cumple` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `tuc_observaciones` varchar(250) COLLATE utf8_spanish_ci DEFAULT NULL,
  `usu_aprobador` int(11) NOT NULL DEFAULT 0,
  `usu_ejecutor` int(11) NOT NULL DEFAULT 0,
  `tu_id` int(11) NOT NULL,
  PRIMARY KEY (`tuc_id`),
  KEY `fk_TU_ID` (`tu_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

INSERT INTO `tramites_bv`.`ct_tramiterequisitos`
(
`req_nombre`,
`req_slug`,
`req_rutaformato`,
`req_estado`,
`tra_id`)
VALUES
('Proyecto de investigación arqueológica y/o paleontológica',
'rproyecto',
'N/A',
'ACTIVO',
17);

INSERT INTO `tramites_bv`.`ct_tramiterequisitos`
(
`req_nombre`,
`req_slug`,
`req_rutaformato`,
`req_estado`,
`tra_id`)
VALUES
('Carta de auspicio al arqueólogo registrado',
'rcarta',
'N/A',
'ACTIVO',
17);