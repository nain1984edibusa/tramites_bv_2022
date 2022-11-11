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

<<<<<<< HEAD

=======
CREATE TABLE `_ct_tramite4_contenedor` (
  `con_id` int(11) NOT NULL AUTO_INCREMENT,
  `tu_id` int(11) NOT NULL,
  `obj_id` int(11) NOT NULL,
  `tc_id` int(11) NOT NULL,
  `con_numero` int(11) NOT NULL,
  `con_seguridad` int(11) NOT NULL,
  PRIMARY KEY (`con_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE `_ct_tramite4_estado_objeto` (
  `eob_id` int(11) NOT NULL AUTO_INCREMENT,
  `eob_nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `eob_estado` 	ENUM ('ACT', 'INA') NOT NULL DEFAULT 'ACT',
  PRIMARY KEY (`eob_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

INSERT INTO `_ct_tramite4_estado_objeto` (`eob_id`, `eob_nombre`) VALUES
(1, 'PENDIENTE'),
(2, 'NO PATRIMONIAL'),
(3, 'SE PRESUME PATRIMONIAL');

CREATE TABLE `_ct_tramite4_tipo_bien_cultural` (
   `tbc_id` int(10) NOT NULL AUTO_INCREMENT,
   `tbc_nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
    `tbc_estado` 	ENUM ('ACT', 'INA') NOT NULL DEFAULT 'ACT',
  PRIMARY KEY (`tbc_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

INSERT INTO `_ct_tramite4_tipo_bien_cultural` (`tbc_id`, `tbc_nombre`) VALUES
(1, 'ATESANIAS'),
(2, 'DOCUMENOS SUELTOS'),
(3, 'ESCULTURAS'),
(4, 'FOTOGRAFIAS'),
(5, 'IMPRESION GRAFICA'),
(6, 'MISCELANEOS'),
(7, 'ORFEBRERIA'),
(8, 'PINTURAS'),
(9, 'REPLICAS ARQUEOLOGICAS'),
(10, 'TEXTILES'),
(11, 'OTROS');


CREATE TABLE `_ct_tramite4_objeto` (
  `obj_id` int(11) NOT NULL AUTO_INCREMENT,
  `tu_id` bigint(20) NOT NULL,
  `tbc_id` int(11) NOT NULL,
  `eob_id` int(11) NOT NULL,
  `con_id` int(11) NOT NULL,
  `obj_cantidad` int(11) NOT NULL,
  `obj_tema` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `obj_autor` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `obj_tecnica` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `obj_largo` int(11) NOT NULL,
  `obj_ancho` int(11) NOT NULL,
  `obj_profundidad` int(11) NOT NULL,
  PRIMARY KEY (`obj_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE `_ct_tramite4_tipo_contenedor` (
   `tc_id` int(10) NOT NULL AUTO_INCREMENT,
   `tc_nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
   `tc_estado` 	ENUM ('ACT', 'INA') NOT NULL DEFAULT 'ACT',
  PRIMARY KEY (`tc_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

INSERT INTO `_ct_tramite4_tipo_contenedor` (`tc_id`, `tc_nombre`) VALUES
(1, 'CAJA'),
(2, 'MALETA'),
(3, 'TUBO'),
(4, 'EMBALAJE MENOR'),
(5, 'OTROS'),
(6, 'NINGUNO');

CREATE TABLE `_ct_tramite4_modo_envio` (
   `me_id` int(10) NOT NULL AUTO_INCREMENT,
   `me_nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
   `me_estado` 	ENUM ('ACT', 'INA') NOT NULL DEFAULT 'ACT',
  PRIMARY KEY (`me_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


INSERT INTO `_ct_tramite4_modo_envio` (`me_id`, `me_nombre`) VALUES
(1, 'AEREO'),
(2, 'POSTAL'),
(3, 'MARITIMO');





CREATE TABLE `ct_nacionalidad` (
  `nac_codigo` int(10) NOT NULL AUTO_INCREMENT,
  `nac_nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`nac_codigo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

INSERT INTO `ct_nacionalidad` (`nac_codigo`, `nac_nombre`) VALUES
(1, 'Afgano'),
(2, 'Islas Aland'),
(3, 'Albano'),
(4, 'Alemán'),
(5, 'Argelino'),
(6, 'American Samoa'),
(7, 'Andorrana'),
(8, 'Angolano'),
(9, 'Anguila'),
(10, 'Antartico'),
(11, 'Antiguano'),
(12, 'Saudí'),
(13, 'Argentino'),
(14, 'Armenio'),
(15, 'Arubeño'),
(16, 'Asiático'),
(17, 'Australiano'),
(18, 'Austríaco'),
(19, 'Azerbaiyano'),
(20, 'Blangladesi'),
(21, 'Bareiní'),
(22, 'Bangladeshí '),
(23, 'Barbadense'),
(24, 'Bielorruso'),
(25, 'Belga'),
(26, 'Beliceño'),
(27, 'Beninés'),
(28, 'Bermudeño'),
(29, 'Butanés'),
(30, 'Boliviano'),
(31, 'Bonairense'),
(32, 'Bosnio '),
(33, 'Botsuano '),
(34, 'Brasileño'),
(35, 'Británico'),
(36, 'Bruneano'),
(37, 'Búlgaro'),
(38, 'Burkinés'),
(39, 'Burundés'),
(40, 'Caboverdiano'),
(41, 'Camboyano'),
(42, 'Camerunés'),
(43, 'Canadiense'),
(44, 'Chadiano'),
(45, 'Chileno'),
(46, 'Chino'),
(47, 'Chipriota'),
(48, 'Cocano'),
(49, 'Colombiano'),
(50, 'Comorense'),
(51, 'Cong'),
(52, 'Congoleño'),
(53, 'Cookiano'),
(54, 'Costarricense'),
(55, 'Marfileño'),
(56, 'Croata'),
(57, 'Cubano'),
(58, 'Curazoleño'),
(59, 'Danés'),
(60, 'Yibutiano'),
(61, 'Dominicano'),
(62, 'Ecuatoriano'),
(63, 'Egipcio'),
(64, 'Salvadoreño'),
(65, 'Emiratí'),
(66, 'Eritreo'),
(67, 'Eslovaco'),
(68, 'Esloveno'),
(69, 'España'),
(70, 'American'),
(71, 'Estonio'),
(72, 'Etíope'),
(73, 'Feroés'),
(74, 'Fijiano'),
(75, 'Filipino'),
(76, 'Finés'),
(77, 'Francés'),
(78, 'Francopolinesio'),
(79, 'Gabonés'),
(80, 'Gambiano'),
(81, 'Ghanés'),
(82, 'Georgiano'),
(83, 'Gibraltareño'),
(84, 'Granadino'),
(85, 'Griego'),
(86, 'Groenlandés'),
(87, 'Guadalupeño'),
(88, 'Guameño'),
(89, 'Guatemalteco'),
(90, 'Guernseyés'),
(91, 'Bisauguineano '),
(92, 'Ecuatoguineano'),
(93, 'Guineano'),
(94, 'Guyanés'),
(95, 'Guayanés'),
(96, 'Haitiano'),
(97, 'Neerlandés'),
(98, 'Holy See'),
(99, 'Hondureño'),
(100, 'Húngaro'),
(101, 'Indú'),
(102, 'Indonesio'),
(103, 'Iraní'),
(104, 'Iraqui'),
(105, 'Irlandes'),
(106, ' Islandés'),
(107, 'Kelpers'),
(108, 'Caimanés'),
(109, 'Pascuense'),
(110, 'Salomonense'),
(111, 'Manés'),
(112, 'Israeli'),
(113, 'Italiano'),
(114, 'Jamaiquino'),
(115, 'Japones'),
(116, 'Jersey'),
(117, 'Jordano'),
(118, 'Kazajo '),
(119, 'Keniano'),
(120, 'Kiribati'),
(121, 'Kore'),
(122, 'Kuwaiti'),
(123, 'Kirguís '),
(124, 'Laosiano'),
(125, '?Latvian'),
(126, 'Libanés'),
(127, 'Lesotense'),
(128, 'Liberiano'),
(129, 'Libanés'),
(130, 'Liechtensteiniano'),
(131, 'Lituano'),
(132, 'Luxemburgués'),
(133, '?Macaense'),
(134, 'Macedonio'),
(135, 'Malgache'),
(136, 'Malasio'),
(137, 'Malauí'),
(138, 'Maldivo'),
(139, 'Maliense'),
(140, 'Maltés'),
(141, 'Marroquí'),
(142, 'Marshalés'),
(143, 'Martiniqués'),
(144, 'Mauritano'),
(145, 'Mauriciano'),
(146, 'Mayotés'),
(147, 'Mexicano'),
(148, 'Micronesio'),
(149, 'Moldavo'),
(150, 'Monegasco'),
(151, 'Mongolian'),
(152, 'Montenegrino'),
(153, 'Montserratense'),
(154, 'Mozambiqueño'),
(155, 'Namibio'),
(156, 'Nauruano'),
(157, 'Nauruano'),
(158, 'Nepalí'),
(159, 'Nicaragüense'),
(160, 'Nigeriano'),
(161, 'Nigerino'),
(162, 'Niueño'),
(163, 'Norfolkense'),
(164, 'Normariano'),
(165, 'Noruego'),
(166, 'Neocaledonio'),
(167, 'Neozelandés'),
(168, 'Omaní'),
(169, 'Pakistaní '),
(170, 'Palao'),
(171, 'Palestino'),
(172, 'Panameño'),
(173, 'Papú neoguineano'),
(174, 'Paraguayo'),
(175, 'Peruano'),
(176, 'Pitcairnés'),
(177, 'Polaco'),
(178, 'Portugués'),
(179, 'Puertorriqueño'),
(180, 'Catarí '),
(181, 'Reinounidenses'),
(182, 'Centroafricano'),
(183, 'Checo'),
(184, 'Dominicano'),
(185, 'Reunionés'),
(186, 'Rumano'),
(187, 'Ruandés'),
(188, 'Ruso'),
(189, 'Francés'),
(190, 'Santaheleno'),
(191, 'Sancristobaleño'),
(192, 'Sanpedrino'),
(193, 'Sanvicentino'),
(194, 'Samoano'),
(195, 'Sanmarinense'),
(196, 'Sanmartinense'),
(197, 'Santalucense'),
(198, 'Santotomense'),
(199, 'Senegalés'),
(200, 'Serbio'),
(201, 'Seychellense'),
(202, 'Sierraleonés'),
(203, 'Singapurense'),
(204, 'Sanmartinense '),
(205, 'Sirio'),
(206, 'Somalí'),
(207, 'South Georgia and the South Sandwich Islands'),
(208, 'Ceilandés'),
(209, 'Sudafricano'),
(210, 'Sudanés'),
(211, 'Sursudanés'),
(212, 'Sueco'),
(213, 'Suizo'),
(214, 'Surinamés'),
(215, 'Svalbarense'),
(216, 'Suazi'),
(217, 'Tailandés'),
(218, 'Taiwanés'),
(219, 'Tanzano'),
(220, 'Tayiko'),
(221, 'Timorense'),
(222, 'Togolés'),
(223, 'Tokelauano'),
(224, 'Tongano'),
(225, 'Trinitense '),
(226, 'Tunecino'),
(227, 'Turkmeno'),
(228, 'Turk'),
(229, 'Turco'),
(230, 'Tuvaluano'),
(231, 'Ucraniano'),
(232, 'Ugandés'),
(233, 'United States Minor Outlying Islands'),
(234, 'Uruguayo'),
(235, 'Uzbeko'),
(236, 'Vanuatuense'),
(237, 'Venezolano'),
(238, 'Vietnamita'),
(239, 'Virgenense británico'),
(240, 'Walisiano'),
(241, 'Saharaui'),
(242, 'Yemení '),
(243, 'Zambiano'),
(244, 'Zimbabuense');

CREATE TABLE `ct_pais` (
  `pai_codigo` int(5) NOT NULL AUTO_INCREMENT,
  `pai_iso` varchar(5) COLLATE utf8_spanish_ci NOT NULL,
  `pai_nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`pai_codigo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

INSERT INTO `ct_pais` (`pai_codigo`, `pai_iso`, `pai_nombre`) VALUES
(1, 'AF', 'AFGHANISTAN'),
(2, 'AX', 'ALAND ISLANDS'),
(3, 'AL', 'ALBANIA'),
(4, 'DE', 'ALEMANIA'),
(5, 'DZ', 'ALGERIA'),
(6, 'AS', 'AMERICAN SAMOA'),
(7, 'AD', 'ANDORRA'),
(8, 'AO', 'ANGOLA'),
(9, 'AI', 'ANGUILLA'),
(10, 'AQ', 'ANTARCTICA'),
(11, 'AG', 'ANTIGUA Y BARBUDA'),
(12, 'SA', 'ARABIA SAUDITA'),
(13, 'AR', 'ARGENTINA'),
(14, 'AM', 'ARMENIA'),
(15, 'AW', 'ARUBA'),
(16, 'AP', 'ASIA / REGION PACIFICO'),
(17, 'AU', 'AUSTRALIA'),
(18, 'AT', 'AUSTRIA'),
(19, 'AZ', 'AZERBAIJAN'),
(20, 'BS', 'BAHAMAS'),
(21, 'BH', 'BAHRAIN'),
(22, 'BD', 'BANGLADESH'),
(23, 'BB', 'BARBADOS'),
(24, 'BY', 'BELARUS'),
(25, 'BE', 'BELGICA'),
(26, 'BZ', 'BELICE'),
(27, 'BJ', 'BENIN'),
(28, 'BM', 'BERMUDA'),
(29, 'BT', 'BHUTAN'),
(30, 'BO', 'BOLIVIA'),
(31, 'BQ', 'BONAIR'),
(32, 'BA', 'BOSNIA AND HERZEGOVINA'),
(33, 'BW', 'BOTSWANA'),
(34, 'BR', 'BRASIL'),
(35, 'IO', 'BRITISH INDIAN OCEAN TERRITORY'),
(36, 'BN', 'BRUNEI DARUSSALAM'),
(37, 'BG', 'BULGARIA'),
(38, 'BF', 'BURKINA FASO'),
(39, 'BI', 'BURUNDI'),
(40, 'CV', 'CABO VERDE'),
(41, 'KH', 'CAMBOYA'),
(42, 'CM', 'CAMERUN'),
(43, 'CA', 'CANADA'),
(44, 'TD', 'CHAD'),
(45, 'CL', 'CHILE'),
(46, 'CN', 'CHINA'),
(47, 'CY', 'CHIPRE'),
(48, 'CC', 'COCOS (KEELING) ISLANDS'),
(49, 'CO', 'COLOMBIA'),
(50, 'KM', 'COMOROS'),
(51, 'CD', 'CONG'),
(52, 'CG', 'CONGO'),
(53, 'CK', 'COOK ISLANDS'),
(54, 'CR', 'COSTA RICA'),
(55, 'CI', 'COTE D IVOIRE'),
(56, 'HR', 'CROACIA'),
(57, 'CU', 'CUBA'),
(58, 'CW', 'CURACAO'),
(59, 'DK', 'DINAMARCA'),
(60, 'DJ', 'DJIBOUTI'),
(61, 'DM', 'DOMINICA'),
(62, 'EC', 'ECUADOR'),
(63, 'EG', 'EGIPTO'),
(64, 'SV', 'EL SALVADOR'),
(65, 'AE', 'EMIRATOS ARABES UNIDOS'),
(66, 'ER', 'ERITREA'),
(67, 'SK', 'ESLOVAQUIA'),
(68, 'SI', 'ESLOVENIA'),
(69, 'ES', 'ESPAÑA'),
(70, 'US', 'ESTADOS UNIDOS'),
(71, 'EE', 'ESTONIA'),
(72, 'ET', 'ETIOPIA'),
(73, 'FO', 'FAROE ISLANDS'),
(74, 'FJ', 'FIJI'),
(75, 'PH', 'FILIPINAS'),
(76, 'FI', 'FINLANDIA'),
(77, 'FR', 'FRANCIA'),
(78, 'PF', 'FRENCH POLYNESIA'),
(79, 'GA', 'GABON'),
(80, 'GM', 'GAMBIA'),
(81, 'GH', 'GANA'),
(82, 'GE', 'GEORGIA'),
(83, 'GI', 'GIBRALTAR'),
(84, 'GD', 'GRANADA'),
(85, 'GR', 'GRECIA'),
(86, 'GL', 'GROENLANDIA'),
(87, 'GP', 'GUADELOUPE'),
(88, 'GU', 'GUAM'),
(89, 'GT', 'GUATEMALA'),
(90, 'GG', 'GUERNSEY'),
(91, 'GN', 'GUINEA'),
(92, 'GQ', 'GUINEA ECUATORIAL'),
(93, 'GW', 'GUINEA-BISSAU'),
(94, 'GY', 'GUYANA'),
(95, 'GF', 'GUYANA FRANCESA'),
(96, 'HT', 'HAITI'),
(97, 'NL', 'HOLANDA, PAISES BAJOS'),
(98, 'VA', 'HOLY SEE (VATICAN CITY STATE)'),
(99, 'HN', 'HONDURAS'),
(100, 'HU', 'HUNGRIA'),
(101, 'IN', 'INDIA'),
(102, 'ID', 'INDONESIA'),
(103, 'IR', 'IRA'),
(104, 'IQ', 'IRAQ'),
(105, 'IE', 'IRLANDA'),
(106, 'IS', 'ISLANDIA'),
(107, 'FK', 'ISLAS (MALVINAS)'),
(108, 'KY', 'ISLAS CAIMAN'),
(109, 'CX', 'ISLAS DE PASCUA'),
(110, 'SB', 'ISLAS SALOMON'),
(111, 'IM', 'ISLE OF MAN'),
(112, 'IL', 'ISRAEL'),
(113, 'IT', 'ITALIA'),
(114, 'JM', 'JAMAICA'),
(115, 'JP', 'JAPAN'),
(116, 'JE', 'JERSEY'),
(117, 'JO', 'JORDAN'),
(118, 'KZ', 'KAZAKHSTAN'),
(119, 'KE', 'KENYA'),
(120, 'KI', 'KIRIBATI'),
(121, 'KR', 'KORE'),
(122, 'KW', 'KUWAIT'),
(123, 'KG', 'KYRGYZSTAN'),
(124, 'LA', 'LAO PEOPLE S DEMOCRATIC REPUBLIC'),
(125, 'LV', 'LATVIA'),
(126, 'LB', 'LEBANON'),
(127, 'LS', 'LESOTHO'),
(128, 'LR', 'LIBERIA'),
(129, 'LY', 'LIBYA'),
(130, 'LI', 'LIECHTENSTEIN'),
(131, 'LT', 'LITHUANIA'),
(132, 'LU', 'LUXEMBOURG'),
(133, 'MO', 'MACAU'),
(134, 'MK', 'MACEDONIA'),
(135, 'MG', 'MADAGASCAR'),
(136, 'MY', 'MALASIA'),
(137, 'MW', 'MALAWI'),
(138, 'MV', 'MALDIVES'),
(139, 'ML', 'MALI'),
(140, 'MT', 'MALTA'),
(141, 'MA', 'MARRUECOS'),
(142, 'MH', 'MARSHALL ISLANDS'),
(143, 'MQ', 'MARTINIQUE'),
(144, 'MR', 'MAURITANIA'),
(145, 'MU', 'MAURITIUS'),
(146, 'YT', 'MAYOTTE'),
(147, 'MX', 'MEXICO'),
(148, 'FM', 'MICRONESI'),
(149, 'MD', 'MOLDOV'),
(150, 'MC', 'MONACO'),
(151, 'MN', 'MONGOLIA'),
(152, 'ME', 'MONTENEGRO'),
(153, 'MS', 'MONTSERRAT'),
(154, 'MZ', 'MOZAMBIQUE'),
(155, 'MM', 'MYANMAR'),
(156, 'NA', 'NAMIBIA'),
(157, 'NR', 'NAURU'),
(158, 'NP', 'NEPAL'),
(159, 'NI', 'NICARAGUA'),
(160, 'NE', 'NIGER'),
(161, 'NG', 'NIGERIA'),
(162, 'NU', 'NIUE'),
(163, 'NF', 'NORFOLK ISLAND'),
(164, 'MP', 'NORTHERN MARIANA ISLANDS'),
(165, 'NO', 'NORUEGA'),
(166, 'NC', 'NUEVA CALEDONIA'),
(167, 'NZ', 'NUEVA ZELANDIA'),
(168, 'OM', 'OMAN'),
(169, 'PK', 'PAKISTAN'),
(170, 'PW', 'PALAU'),
(171, 'PS', 'PALESTINA'),
(172, 'PA', 'PANAMA'),
(173, 'PG', 'PAPUA NEW GUINEA'),
(174, 'PY', 'PARAGUAY'),
(175, 'PE', 'PERU'),
(176, 'PN', 'PITCAIRN ISLANDS'),
(177, 'PL', 'POLONIA'),
(178, 'PT', 'PORTUGAL'),
(179, 'PR', 'PUERTO RICO'),
(180, 'QA', 'QATAR'),
(181, 'GB', 'REINO UNIDO'),
(182, 'CF', 'REPUBLICA CENTRAL DE AFRICA'),
(183, 'CZ', 'REPUBLICA CHECA'),
(184, 'DO', 'REPUBLICA DOMINICANA'),
(185, 'RE', 'REUNION'),
(186, 'RO', 'ROMANIA'),
(187, 'RW', 'RUANDA'),
(188, 'RU', 'RUSIA'),
(189, 'BL', 'SAINT BARTHELEMY'),
(190, 'SH', 'SAINT HELENA'),
(191, 'KN', 'SAINT KITTS AND NEVIS'),
(192, 'PM', 'SAINT PIERRE AND MIQUELON'),
(193, 'VC', 'SAINT VINCENT AND THE GRENADINES'),
(194, 'WS', 'SAMOA'),
(195, 'SM', 'SAN MARINO'),
(196, 'MF', 'SAN MARTIN'),
(197, 'LC', 'SANTA LUCIA'),
(198, 'ST', 'SAO TOME AND PRINCIPE'),
(199, 'SN', 'SENEGAL'),
(200, 'RS', 'SERBIA'),
(201, 'SC', 'SEYCHELLES'),
(202, 'SL', 'SIERRA LEONE'),
(203, 'SG', 'SINGAPUR'),
(204, 'SX', 'SINT MAARTEN (DUTCH PART)'),
(205, 'SY', 'SIRIA REPUBLICA ARABE'),
(206, 'SO', 'SOMALIA'),
(207, 'GS', 'SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS'),
(208, 'LK', 'SRI LANKA'),
(209, 'ZA', 'SUDAFRICA'),
(210, 'SD', 'SUDAN'),
(211, 'SS', 'SUDAN DEL SUR'),
(212, 'SE', 'SUECIA'),
(213, 'CH', 'SUIZA'),
(214, 'SR', 'SURINAM'),
(215, 'SJ', 'SVALBARD AND JAN MAYEN'),
(216, 'SZ', 'SWAZILAND'),
(217, 'TH', 'TAILANDIA'),
(218, 'TW', 'TAIWAN'),
(219, 'TJ', 'TAJIKISTAN'),
(220, 'TZ', 'TANZANIA'),
(221, 'TL', 'TIMOR-LESTE'),
(222, 'TG', 'TOGO'),
(223, 'TK', 'TOKELAU'),
(224, 'TO', 'TONGA'),
(225, 'TT', 'TRINIDAD Y TOBAGO'),
(226, 'TN', 'TUNISIA'),
(227, 'TM', 'TURKMENISTAN'),
(228, 'TC', 'TURKS AND CAICOS ISLANDS'),
(229, 'TR', 'TURQUIA'),
(230, 'TV', 'TUVALU'),
(231, 'UA', 'UCRANIA'),
(232, 'UG', 'UGANDA'),
(233, 'UM', 'UNITED STATES MINOR OUTLYING ISLANDS'),
(234, 'UY', 'URUGUAY'),
(235, 'UZ', 'UZBEKISTAN'),
(236, 'VU', 'VANUATU'),
(237, 'VE', 'VENEZUELA'),
(238, 'VN', 'VIETNAM'),
(239, 'VG', 'VIRGIN ISLAND'),
(240, 'WF', 'WALLIS AND FUTUNA'),
(241, 'EH', 'WESTERN SAHARA'),
(242, 'YE', 'YEMEN'),
(243, 'ZM', 'ZAMBIA'),
(244, 'ZW', 'ZIMBABWE');

CREATE TABLE `ct_regional` (
  `reg_id` int(10) NOT NULL AUTO_INCREMENT,
  `reg_nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `reg_ciudad` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `reg_direccion` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `reg_provincia` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
   `reg_estado` 	ENUM ('ACT', 'INA') NOT NULL DEFAULT 'ACT',
  PRIMARY KEY (`reg_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


INSERT INTO `ct_regional` (`reg_id`, `reg_nombre`, `reg_ciudad`, `reg_direccion`, `reg_provincia`) VALUES
(1, 'Zonal 1', 'Quito', 'Av. Colón Oe1-93 y Av. 10 de Agosto, Palacio La Circasiana', 'Esmeraldas, Imbabura,Carchi, Sucumbios'),
(2, 'Zonal 2', 'Quito', 'Av. Colón Oe1-93 y Av. 10 de Agosto, Palacio La Circasiana', 'Pichincha, Napo, Orellana'),
(3, 'Zonal 3', 'Riobamba', 'Primera Constituyente y 5 de junio. Gobernación de Chimborazo', 'Cotopaxi,Tungurahua, Chimborazo, Pastaza'),
(4, 'Zonal 4', 'Portoviejo', 'Morales y Bolívar Esq. Casa Vélez.', 'Manabí, Sto. Domingo'),
(5, 'Zonal 5', 'Guayaquil', 'Numa Pompillo Llona N°. 182-184. Las Peñas.', 'Sta. Elena, Guayas, Bolivar,Los Ríos, Galápagos'),
(6, 'Zonal 6', 'Cuenca', 'Benigno Malo 640 entre Presidente Córdova y Juan Jaramillo. Casa de las Palomas', 'Cañar, Azuay,Morona Santiago'),
(7, 'Zonal 7', 'Loja', 'Sucre y Quito. Esq.', 'El Oro, Loja, Zamora');

CREATE TABLE `ct_horario` (
   `ho_codigo` int(10) NOT NULL AUTO_INCREMENT,
   `ho_hora` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
   `ho_estado` 	ENUM ('ACT', 'INA') NOT NULL DEFAULT 'ACT',
  PRIMARY KEY (`ho_codigo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


INSERT INTO `ct_horario` (`ho_codigo`, `ho_hora`) VALUES
(1, '08:00 - 08:30'),
(2, '08:30 - 09:00'),
(3, '09:00 - 09:30'),
(4, '09:30 - 10:00'),
(5, '10:00 - 10:30'),
(6, '10:30 - 11:00'),
(7, '11:00 - 11:30'),
(8, '11:30 - 12:00'),
(9, '12:00 - 12:30'),
(10, '12:30 - 13:00'),
(11, '13:00 - 13:30'),
(12, '13:30 - 14:00'),
(13, '14:00 - 14:30'),
(14, '14:30 - 15:00'),
(15, '15:00 - 15:30'),
(16, '15:30 - 16:00'),
(17, '16:00 - 16:30');



CREATE TABLE `ct_tramite_usuario_turno` (
  `tut_id` int(11) NOT NULL AUTO_INCREMENT,
  `tut_fecha` date NOT NULL,
  `tut_hora` int NOT NULL,
  `tut_zonal_id` int(11) NOT NULL,
  `tu_id` int(11) NOT NULL,
  PRIMARY KEY (`tut_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


INSERT INTO `tramites_bv`.`ct_usuarios`
(`usu_usuario`,
`rol_id`,
`usu_tidentificador`,
`usu_identificador`,
`usu_nombre`,
`usu_apellido`,
`pro_id`,
`can_id`,
`par_id`,
`usu_telefono`,
`usu_direccion`,
`reg_id`,
`usu_correo`,
`usu_contrasena`,
`usu_fechcreacion`,
`usu_estado`,
`usu_certificado`)
VALUES
('asignador_riesgos_matriz',
'3',
'CI',
'1715141877',
'ASIGNADOR RIESGOS',
'MATRIZ',
17,
'1701',
'170101',
'0995728605',
'MATRIZ',
'2',
'eduardo.bustillos@patrimoniocultural.gob.ec',
'$2y$10$p2Sb3LaHoWQbtQCp1eY1muTFQg4C2vCOGccpFUvICvmHqNIAapbbq',
NOW(),
'ACTIVO',
'0');


alter table tramites_bv.ct_usuarios
  add usu_asignado_tramite int(11) NULL;
>>>>>>> tramite3
