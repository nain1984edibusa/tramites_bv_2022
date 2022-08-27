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
('Archivo pdf con  fotos del bien cultural',
'rpdffotos',
'N/A',
'ACTIVO',
17);


CREATE TABLE `_ct_tramite17_tipo_analisis` (
  `ta_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `ta_concepto` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `ta_estado` 	ENUM ('ACT', 'INA') NOT NULL DEFAULT 'ACT',
  `ta_costo` 	DECIMAL(19,4) NOT NULL,
  PRIMARY KEY (`ta_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

INSERT INTO `_ct_tramite17_tipo_analisis` (ta_id, ta_concepto, ta_costo) VALUES
(1, 'Identificación de fibras textiles (papel) y tejidos', 5.00),
(2, 'Análisis petrográfico (tipo madera)', 8.00),
(3, 'Análisis químico-mineralógico', 38.00),
(4, 'Pruebas de solubilidad', 8.00),
(5, 'Análisis suelos completo', 20.00),
(6, 'Análisis microbiológico', 12.00),
(7, 'Pérdida por calcinación', 6.00),
(8, 'Observación al microscopio', 5.00),
(9, 'Microfoto-rafia', 6.00),
(10, 'Fotografía digital', 4.00),
(11, 'Análisis estratigráfico (por muestra o por objeto)', 5.00),
(12, 'Análisis de aglutinantes', 7.00),
(13, 'Análisis por disfracción de rayos X', 35.00),
(14, 'Identificación de sales (cualitativo)', 6.00),
(15, 'Análisis de morteros (granulometría y composición)', 18.00),
(16, 'Determinación de humedad', 8.00),
(17, 'Identificación de maderas', 8.00),
(18, 'Análisis por espectrofotometría infrarroja', 13.00),
(19, 'Análisis por absorción atómica', 9.00),
(20, 'Medición de PH', 4.00),
(21, 'Confección de bandas de extensión por metro lineal', 15.00),
(22, 'Reintegración de color regatino por decimetro cuadrado', 20.00),
(23, 'Conservación directa por metro cuadrado', 250.00),
(24, 'Restauración por metro cuadrado', 350.00),
(25, 'Diseño y confección de bastidores técnicos por metro lineal', 40.00),
(26, 'Fumigación e higienización por metro cuadrado', 7.00),
(27, 'Análisis por cromatografí de gases', 30.00),
(28, 'Identificación de pigmentos', 9.00),
(29, 'Análisis de textiles (tejidos)', 5.00),
(30, 'Determinación de propiedades hídricas en piedra c/u (Absorción, desorción de agua, succión capilar)', 11.00);

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
  PRIMARY KEY (`aq_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;



SET SQL_SAFE_UPDATES = 0;
update tramites_bv.ct_tramiteanexos
set anx_requerido = 'SI'
where anx_id in ( 59)


  <?php while ($requisito = mysql_fetch_array($trequisitos)) {
                    echo '<input type="checkbox" name="' . $row["req_id"] . '" value="' . $row["req_nombre"] . '">' . $row["req_slug"];
                }
                ?>
