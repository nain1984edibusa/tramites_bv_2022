use tramites_bv;

CREATE TABLE `_ct_tramite3_respuestas` (
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


CREATE TABLE `_ct_tramite3` (
  `tu_id` bigint(11) NOT NULL AUTO_INCREMENT,
  `tu_codigo` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `usu_extid` int(11) NOT NULL,
  `usu_intid` int(11) NOT NULL,
  `tra_id` int(11) NOT NULL,
  `tu_fecha_ingreso` datetime NOT NULL,
  `tu_fecha_contcont` date NOT NULL,
  `tu_fecha_aprocont` date NOT NULL,
  `tu_fecha_contestacion` datetime DEFAULT NULL,
  `tu_band_convalidar` tinyint(4) NOT NULL DEFAULT -1,
  `tu_band_respuesta` tinyint(4) NOT NULL DEFAULT 0,
  `tu_band_convanxres` tinyint(4) NOT NULL DEFAULT -1,
  `reg_id` int(11) NOT NULL,
  `et_id` int(11) NOT NULL,
  `tu_estado` 	ENUM ('ACT', 'INA') NOT NULL DEFAULT 'ACT',
  `tu_fecha_iniciocoa` date DEFAULT NULL,
  `tu_fecha_convalidacion` date DEFAULT NULL,
  `tu_fecha_concon` date DEFAULT NULL,
  `tu_fecha_concoa` date DEFAULT NULL,
  `te_provincia` int(11) NOT NULL,
  `te_canton` int(11) NOT NULL,
  `te_parroquia` int(11) NOT NULL,
  `te_regional` int(11) NOT NULL,
  `te_direccion` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `te_cumple` varchar(50) COLLATE utf8_spanish_ci DEFAULT 'PENDIENTE',
  `te_observaciones` varchar(250) COLLATE utf8_spanish_ci DEFAULT NULL,
  `te_tipo_movimiento` int(11) NULL DEFAULT 0,
  `te_fecha_desde` date NOT NULL,
  `te_fecha_hasta` date NOT NULL,
  `te_id_provincia_envio` int(11) NOT NULL,
  `te_id_canton_envio` int(11) NOT NULL,
  `te_ciudad_envio` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `te_direccion_envio` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`tu_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


