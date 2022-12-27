/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Other/SQLTemplate.sql to edit this template
 */
/**
 * Author:  TICS
 * Created: 21 dic. 2022
 */

CREATE TABLE `ct_gestion_tramite` (
  `gt_id` bigint(11) NOT NULL AUTO_INCREMENT,
  `reg_id` int(11) NOT NULL,
  `agt_id` int(11) NOT NULL,
  `tra_id` int(11) NOT NULL,
  `gt_fecha_recepcion` datetime NOT NULL,
  `gt_fecha_respuesta` datetime NULL,
  `egt_id` int(11) NOT NULL DEFAULT 2,
  `gt_tecnico_responsable` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `ti_id` int(11) NOT NULL,  
  `gt_identificacion` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `gt_nombre` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `gt_email` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,  
  `gt_numero_celular` varchar(250) COLLATE utf8_spanish_ci DEFAULT NULL, 
  `usu_int_id` int(11) NOT NULL,
  PRIMARY KEY (`gt_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE `ct_estado_gestion_tramite` (
   `egt_id` int(10) NOT NULL AUTO_INCREMENT,
   `egt_nombre` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
   `egt_estado` ENUM ('ACT', 'INA') NOT NULL DEFAULT 'ACT',
  PRIMARY KEY (`egt_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

INSERT INTO `ct_estado_gestion_tramite` (`egt_id`, `egt_nombre`) VALUES
(1, 'ATENDIDO'),
(2, 'EN TRAMITE');

CREATE TABLE `ct_area_gestion_tramite` (
   `agt_id` int(10) NOT NULL AUTO_INCREMENT,
   `agt_nombre` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
   `agt_estado` ENUM ('ACT', 'INA') NOT NULL DEFAULT 'ACT',
  PRIMARY KEY (`agt_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

INSERT INTO `ct_area_gestion_tramite` (`agt_id`, `agt_nombre`) VALUES
(1, 'DCTCSPC'),
(2, 'UCTCSPC'),
(3, 'DAAPPS'),
(4, 'UAAPPS'),
(5, 'DGRPC'),
(6, 'DII'),
(7, 'UTCT');
