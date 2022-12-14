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
  `tu_caracteristicas_bien` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
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
  `tuc_infoadicional` text COLLATE utf8_spanish_ci NOT NULL,
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
('Archivo pdf con  fotos del bien cultural',
'rpdffotos',
'N/A',
'ACTIVO',
17);


CREATE TABLE `_ct_tramite17_tipo_analisis` (
  `ta_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `ta_concepto` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `ta_estado` 	ENUM ('ACT', 'INA') NOT NULL DEFAULT 'ACT',
  `ta_costo` 	DECIMAL(19,2) NOT NULL,
  PRIMARY KEY (`ta_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

INSERT INTO `_ct_tramite17_tipo_analisis` (ta_id, ta_concepto, ta_costo) VALUES
(1, 'Identificaci??n de fibras textiles (papel) y tejidos', 5.00),
(2, 'An??lisis petrogr??fico (tipo madera)', 8.00),
(3, 'An??lisis qu??mico-mineral??gico', 38.00),
(4, 'Pruebas de solubilidad', 8.00),
(5, 'An??lisis suelos completo', 20.00),
(6, 'An??lisis microbiol??gico', 12.00),
(7, 'P??rdida por calcinaci??n', 6.00),
(8, 'Observaci??n al microscopio', 5.00),
(9, 'Microfoto-rafia', 6.00),
(10, 'Fotograf??a digital', 4.00),
(11, 'An??lisis estratigr??fico (por muestra o por objeto)', 5.00),
(12, 'An??lisis de aglutinantes', 7.00),
(13, 'An??lisis por disfracci??n de rayos X', 35.00),
(14, 'Identificaci??n de sales (cualitativo)', 6.00),
(15, 'An??lisis de morteros (granulometr??a y composici??n)', 18.00),
(16, 'Determinaci??n de humedad', 8.00),
(17, 'Identificaci??n de maderas', 8.00),
(18, 'An??lisis por espectrofotometr??a infrarroja', 13.00),
(19, 'An??lisis por absorci??n at??mica', 9.00),
(20, 'Medici??n de PH', 4.00),
(21, 'Confecci??n de bandas de extensi??n por metro lineal', 15.00),
(22, 'Reintegraci??n de color regatino por decimetro cuadrado', 20.00),
(23, 'Conservaci??n directa por metro cuadrado', 250.00),
(24, 'Restauraci??n por metro cuadrado', 350.00),
(25, 'Dise??o y confecci??n de bastidores t??cnicos por metro lineal', 40.00),
(26, 'Fumigaci??n e higienizaci??n por metro cuadrado', 7.00),
(27, 'An??lisis por cromatograf?? de gases', 30.00),
(28, 'Identificaci??n de pigmentos', 9.00),
(29, 'An??lisis de textiles (tejidos)', 5.00),
(30, 'Determinaci??n de propiedades h??dricas en piedra c/u (Absorci??n, desorci??n de agua, succi??n capilar)', 11.00);

CREATE TABLE `_ct_tramite17_analisis_quimico` (
  `aq_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `tu_id` bigint(20) NOT NULL,
  `ta_id` bigint(20) NOT NULL,
  PRIMARY KEY (`aq_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


CREATE TABLE `_ct_tramite17_detalle_proforma` (
  `dp_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `tu_id` bigint(20) NOT NULL,
  `ta_id` bigint(20) NOT NULL,
  `ta_cantidad` int(11) NOT NULL,
  `ta_concepto` varchar(250) COLLATE utf8_spanish_ci DEFAULT NULL,
  `ta_valor_unitario` 	DECIMAL(19,2) NOT NULL,
  PRIMARY KEY (`dp_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;



SET SQL_SAFE_UPDATES = 0;
update tramites_bv.ct_tramiteanexos
set anx_requerido = 'SI'
where anx_id in ( 59)

SET SQL_SAFE_UPDATES = 0;
update  tramites_bv.ct_tramites
set tra_resultado = 'Proforma'
where tra_id = 17
