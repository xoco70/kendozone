/*
Navicat MySQL Data Transfer

Source Server         : Homestead
Source Server Version : 50712
Source Host           : 127.0.0.1:33060
Source Database       : kendo_test

Target Server Type    : MYSQL
Target Server Version : 50712
File Encoding         : 65001

Date: 2016-05-18 23:36:42
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for test_association
-- ----------------------------
DROP TABLE IF EXISTS `test_association`;
CREATE TABLE `test_association` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `federation_id` int(10) unsigned NOT NULL,
  `president_id` int(10) unsigned NOT NULL,
  `state` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `association_name_unique` (`name`),
  KEY `association_president_id_foreign` (`president_id`),
  KEY `association_federation_id_foreign` (`federation_id`),
  CONSTRAINT `association_federation_id_foreign` FOREIGN KEY (`federation_id`) REFERENCES `test_federation` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `association_president_id_foreign` FOREIGN KEY (`president_id`) REFERENCES `test_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of test_association
-- ----------------------------
INSERT INTO `test_association` VALUES ('1', 'core.no_association', '0', '1', null, null, null, null, '2016-05-18 22:30:00', '2016-05-18 22:30:00', null);
INSERT INTO `test_association` VALUES ('2', 'Asociación de Kendo y Artes Marciales Afines del Distrito Federal, A.C.', '37', '1', 'Distrito Federal', '', '55 17 63 48 59', null, '2016-05-18 22:30:00', '2016-05-18 22:30:00', null);
INSERT INTO `test_association` VALUES ('3', 'Asociación de Kendo del Estado de Nuevo León, A.C.	', '37', '1', 'Nuevo Léon', '', '811 486 0071', null, '2016-05-18 22:30:00', '2016-05-18 22:30:00', null);
INSERT INTO `test_association` VALUES ('4', 'Asociación de Kendo del Estado de Veracruz, A.C.', '37', '1', 'Veracruz', '', '(229) 9374231', null, '2016-05-18 22:30:00', '2016-05-18 22:30:00', null);
INSERT INTO `test_association` VALUES ('5', 'Asociación de Kendo Iaido y Jodo del Estado de Coahuila, A.C.', '37', '1', 'Coahuila', '', '(871) 7292971', null, '2016-05-18 22:30:00', '2016-05-18 22:30:00', null);
INSERT INTO `test_association` VALUES ('6', 'ASOCIACION DE KENSHI DEL ESTADO DE PUEBLA, A.C.', '37', '1', 'Puebla', '', '', null, '2016-05-18 22:30:00', '2016-05-18 22:30:00', null);
INSERT INTO `test_association` VALUES ('7', 'Asociación Mexiquense de Kendo, A.C.', '37', '9', 'Estado de México', '', '(55) 13011905', null, '2016-05-18 22:30:00', '2016-05-18 22:30:00', null);
INSERT INTO `test_association` VALUES ('8', 'Asociación de Kendo de la Universidad Autónoma de México', '37', '1', 'Distrito Federal', '', '', null, '2016-05-18 22:30:00', '2016-05-18 22:30:00', null);
INSERT INTO `test_association` VALUES ('9', 'Grupo de Kendo del Estado de Chihuahua', '37', '1', 'Chihuahua', '', '(614) 4820716', null, '2016-05-18 22:30:00', '2016-05-18 22:30:00', null);
INSERT INTO `test_association` VALUES ('10', 'Asociación de Iaido y Kendo de Querétaro', '37', '1', 'Querétaro', '', '', null, '2016-05-18 22:30:00', '2016-05-18 22:30:00', null);
INSERT INTO `test_association` VALUES ('11', 'Asociación de Kendo, Iaido y Jodo de Jalisco TenKen Ryuu AC', '37', '1', 'Jalisco', '', '(044) 33 3393-6164', null, '2016-05-18 22:30:00', '2016-05-18 22:30:00', null);
INSERT INTO `test_association` VALUES ('12', 'Asociación de Iaido y Kendo del Instituto Politécnico Nacional', '37', '1', 'Distrito Federal', '', '(044) 55-24-95-95-15', null, '2016-05-18 22:30:00', '2016-05-18 22:30:00', null);
INSERT INTO `test_association` VALUES ('13', 'Grupo de Kendo del Estado de San Luis Potosí', '37', '1', 'San Luis Pótosi', '', '', null, '2016-05-18 22:30:00', '2016-05-18 22:30:00', null);
INSERT INTO `test_association` VALUES ('14', 'Asociación de Kendo del Estado de Morelos', '37', '1', 'Morelos', '', '045-777-303-1202', null, '2016-05-18 22:30:00', '2016-05-18 22:30:00', null);
INSERT INTO `test_association` VALUES ('15', 'ASOCIACIÓN ESTATAL DE KENDO E IAIDO DE AGUASCALIENTES, A.C.', '37', '1', 'Aguascalientes', '', '4492094939', null, '2016-05-18 22:30:00', '2016-05-18 22:30:00', null);
INSERT INTO `test_association` VALUES ('16', 'Mr. Avery Schmitt', '15', '7', null, '81603 Considine Shoals\nRobertstown, VA 81484-5367', '1-835-907-6138 x8981', null, '2016-05-18 22:30:00', '2016-05-18 22:30:00', null);
INSERT INTO `test_association` VALUES ('17', 'Claudie Greenholt Jr.', '22', '9', null, '19596 Francesca Ports\nRickeymouth, SC 50408-2064', '771-258-7944 x7550', null, '2016-05-18 22:30:00', '2016-05-18 22:30:00', null);
INSERT INTO `test_association` VALUES ('18', 'Mrs. Lavinia Jacobi', '5', '1', null, '33371 Ebert Dale Suite 366\nSimonisfort, GA 98024-4910', '247-667-7519', null, '2016-05-18 22:30:00', '2016-05-18 22:30:00', null);
INSERT INTO `test_association` VALUES ('19', 'Mr. Consuelo Macejkovic V', '15', '5', null, '398 Hassan Locks Apt. 079\nCarterland, MI 68086', '851-583-1677', null, '2016-05-18 22:30:00', '2016-05-18 22:30:00', null);
INSERT INTO `test_association` VALUES ('20', 'Kristopher Welch', '33', '3', null, '11655 Botsford Squares Suite 090\nRyanfurt, FL 71508', '1-540-781-8696', null, '2016-05-18 22:30:00', '2016-05-18 22:30:00', null);

-- ----------------------------
-- Table structure for test_category
-- ----------------------------
DROP TABLE IF EXISTS `test_category`;
CREATE TABLE `test_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `gender` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `isTeam` int(10) unsigned NOT NULL DEFAULT '0',
  `ageCategory` int(10) unsigned NOT NULL DEFAULT '0',
  `ageMin` int(10) unsigned NOT NULL DEFAULT '0',
  `ageMax` int(10) unsigned NOT NULL DEFAULT '0',
  `gradeCategory` int(10) unsigned NOT NULL DEFAULT '0',
  `gradeMin` int(10) unsigned NOT NULL DEFAULT '0',
  `gradeMax` int(10) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `category_fields_unique` (`name`,`gender`,`isTeam`,`ageCategory`,`ageMin`,`ageMax`,`gradeCategory`,`gradeMin`,`gradeMax`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of test_category
-- ----------------------------
INSERT INTO `test_category` VALUES ('1', 'categories.man_first_force', 'M', '0', '0', '0', '0', '1', '0', '0', '2016-05-18 22:29:59', '2016-05-18 22:29:59');
INSERT INTO `test_category` VALUES ('2', 'categories.man_second_force', 'M', '0', '0', '0', '0', '2', '0', '0', '2016-05-18 22:29:59', '2016-05-18 22:29:59');
INSERT INTO `test_category` VALUES ('3', 'categories.men_single', 'M', '0', '0', '0', '0', '0', '0', '0', '2016-05-18 22:29:59', '2016-05-18 22:29:59');
INSERT INTO `test_category` VALUES ('4', 'categories.men_team', 'M', '1', '0', '0', '0', '0', '0', '0', '2016-05-18 22:29:59', '2016-05-18 22:29:59');
INSERT INTO `test_category` VALUES ('5', 'categories.woman_first_force', 'F', '0', '0', '0', '0', '1', '0', '0', '2016-05-18 22:29:59', '2016-05-18 22:29:59');
INSERT INTO `test_category` VALUES ('6', 'categories.woman_second_force', 'F', '0', '0', '0', '0', '2', '0', '0', '2016-05-18 22:29:59', '2016-05-18 22:29:59');
INSERT INTO `test_category` VALUES ('7', 'categories.ladies_single', 'F', '0', '0', '0', '0', '0', '0', '0', '2016-05-18 22:29:59', '2016-05-18 22:29:59');
INSERT INTO `test_category` VALUES ('8', 'categories.ladies_team', 'F', '1', '0', '0', '0', '0', '0', '0', '2016-05-18 22:29:59', '2016-05-18 22:29:59');
INSERT INTO `test_category` VALUES ('9', 'categories.mixed_single', 'X', '0', '0', '0', '0', '0', '0', '0', '2016-05-18 22:29:59', '2016-05-18 22:29:59');
INSERT INTO `test_category` VALUES ('10', 'categories.mixed_team', 'X', '1', '0', '0', '0', '0', '0', '0', '2016-05-18 22:29:59', '2016-05-18 22:29:59');

-- ----------------------------
-- Table structure for test_category_settings
-- ----------------------------
DROP TABLE IF EXISTS `test_category_settings`;
CREATE TABLE `test_category_settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `championship_id` int(10) unsigned NOT NULL,
  `isTeam` tinyint(1) NOT NULL,
  `teamSize` tinyint(4) NOT NULL,
  `fightingAreas` tinyint(3) unsigned DEFAULT NULL,
  `fightDuration` text COLLATE utf8_unicode_ci NOT NULL,
  `hasRoundRobin` tinyint(1) NOT NULL,
  `roundRobinWinner` tinyint(4) NOT NULL,
  `hasEncho` tinyint(1) NOT NULL,
  `enchoQty` tinyint(4) NOT NULL,
  `enchoDuration` text COLLATE utf8_unicode_ci NOT NULL,
  `hasHantei` tinyint(1) NOT NULL,
  `cost` smallint(6) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `category_settings_championship_id_unique` (`championship_id`),
  CONSTRAINT `category_settings_championship_id_foreign` FOREIGN KEY (`championship_id`) REFERENCES `test_championship` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of test_category_settings
-- ----------------------------

-- ----------------------------
-- Table structure for test_championship
-- ----------------------------
DROP TABLE IF EXISTS `test_championship`;
CREATE TABLE `test_championship` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tournament_id` int(10) unsigned NOT NULL,
  `category_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `championship_tournament_id_category_id_unique` (`tournament_id`,`category_id`),
  KEY `championship_tournament_id_index` (`tournament_id`),
  KEY `championship_category_id_index` (`category_id`),
  CONSTRAINT `championship_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `test_category` (`id`) ON DELETE CASCADE,
  CONSTRAINT `championship_tournament_id_foreign` FOREIGN KEY (`tournament_id`) REFERENCES `test_tournament` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of test_championship
-- ----------------------------
INSERT INTO `test_championship` VALUES ('1', '5', '4', '2016-05-18 22:29:59', '2016-05-18 22:29:59', null);
INSERT INTO `test_championship` VALUES ('2', '4', '10', '2016-05-18 22:29:59', '2016-05-18 22:29:59', null);
INSERT INTO `test_championship` VALUES ('3', '6', '7', '2016-05-18 22:29:59', '2016-05-18 22:29:59', null);
INSERT INTO `test_championship` VALUES ('4', '5', '5', '2016-05-18 22:29:59', '2016-05-18 22:29:59', null);
INSERT INTO `test_championship` VALUES ('5', '5', '6', '2016-05-18 22:29:59', '2016-05-18 22:29:59', null);
INSERT INTO `test_championship` VALUES ('6', '1', '3', '2016-05-18 22:29:59', '2016-05-18 22:29:59', null);
INSERT INTO `test_championship` VALUES ('7', '5', '1', '2016-05-18 22:29:59', '2016-05-18 22:29:59', null);
INSERT INTO `test_championship` VALUES ('8', '1', '5', '2016-05-18 22:29:59', '2016-05-18 22:29:59', null);
INSERT INTO `test_championship` VALUES ('9', '6', '4', '2016-05-18 22:29:59', '2016-05-18 22:29:59', null);
INSERT INTO `test_championship` VALUES ('10', '4', '1', '2016-05-18 22:29:59', '2016-05-18 22:29:59', null);

-- ----------------------------
-- Table structure for test_championship_user
-- ----------------------------
DROP TABLE IF EXISTS `test_championship_user`;
CREATE TABLE `test_championship_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `championship_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `confirmed` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `championship_user_championship_id_user_id_unique` (`championship_id`,`user_id`),
  KEY `championship_user_championship_id_index` (`championship_id`),
  KEY `championship_user_user_id_index` (`user_id`),
  CONSTRAINT `championship_user_championship_id_foreign` FOREIGN KEY (`championship_id`) REFERENCES `test_championship` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `championship_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `test_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of test_championship_user
-- ----------------------------
INSERT INTO `test_championship_user` VALUES ('1', '4', '5', '0', '2016-05-18 22:29:59', '2016-05-18 22:29:59', null);
INSERT INTO `test_championship_user` VALUES ('3', '2', '7', '1', '2016-05-18 22:29:59', '2016-05-18 22:29:59', null);
INSERT INTO `test_championship_user` VALUES ('4', '6', '2', '0', '2016-05-18 22:29:59', '2016-05-18 22:29:59', null);
INSERT INTO `test_championship_user` VALUES ('5', '8', '2', '0', '2016-05-18 22:29:59', '2016-05-18 22:29:59', null);
INSERT INTO `test_championship_user` VALUES ('6', '2', '4', '1', '2016-05-18 22:29:59', '2016-05-18 22:29:59', null);
INSERT INTO `test_championship_user` VALUES ('7', '10', '6', '0', '2016-05-18 22:29:59', '2016-05-18 22:29:59', null);
INSERT INTO `test_championship_user` VALUES ('8', '7', '1', '0', '2016-05-18 22:29:59', '2016-05-18 22:29:59', null);
INSERT INTO `test_championship_user` VALUES ('10', '5', '3', '0', '2016-05-18 22:29:59', '2016-05-18 22:29:59', null);
INSERT INTO `test_championship_user` VALUES ('11', '3', '5', '0', '2016-05-18 22:29:59', '2016-05-18 22:29:59', null);
INSERT INTO `test_championship_user` VALUES ('12', '4', '3', '1', '2016-05-18 22:29:59', '2016-05-18 22:29:59', null);
INSERT INTO `test_championship_user` VALUES ('13', '1', '4', '1', '2016-05-18 22:29:59', '2016-05-18 22:29:59', null);
INSERT INTO `test_championship_user` VALUES ('15', '3', '4', '1', '2016-05-18 22:29:59', '2016-05-18 22:29:59', null);
INSERT INTO `test_championship_user` VALUES ('16', '2', '2', '0', '2016-05-18 22:29:59', '2016-05-18 22:29:59', null);
INSERT INTO `test_championship_user` VALUES ('17', '2', '1', '0', '2016-05-18 22:29:59', '2016-05-18 22:29:59', null);
INSERT INTO `test_championship_user` VALUES ('19', '4', '6', '1', '2016-05-18 22:29:59', '2016-05-18 22:29:59', null);
INSERT INTO `test_championship_user` VALUES ('20', '8', '5', '0', '2016-05-18 22:29:59', '2016-05-18 22:29:59', null);
INSERT INTO `test_championship_user` VALUES ('21', '6', '1', '0', '2016-05-18 22:29:59', '2016-05-18 22:29:59', null);
INSERT INTO `test_championship_user` VALUES ('25', '3', '7', '0', '2016-05-18 22:29:59', '2016-05-18 22:29:59', null);
INSERT INTO `test_championship_user` VALUES ('26', '1', '7', '0', '2016-05-18 22:29:59', '2016-05-18 22:29:59', null);
INSERT INTO `test_championship_user` VALUES ('27', '2', '5', '0', '2016-05-18 22:29:59', '2016-05-18 22:29:59', null);
INSERT INTO `test_championship_user` VALUES ('28', '4', '2', '0', '2016-05-18 22:29:59', '2016-05-18 22:29:59', null);
INSERT INTO `test_championship_user` VALUES ('29', '8', '7', '0', '2016-05-18 22:29:59', '2016-05-18 22:29:59', null);
INSERT INTO `test_championship_user` VALUES ('30', '1', '3', '0', '2016-05-18 22:29:59', '2016-05-18 22:29:59', null);

-- ----------------------------
-- Table structure for test_club
-- ----------------------------
DROP TABLE IF EXISTS `test_club`;
CREATE TABLE `test_club` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `association_id` int(10) unsigned NOT NULL,
  `president_id` int(10) unsigned NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `club_name_unique` (`name`),
  KEY `club_president_id_foreign` (`president_id`),
  KEY `club_association_id_foreign` (`association_id`),
  CONSTRAINT `club_association_id_foreign` FOREIGN KEY (`association_id`) REFERENCES `test_federation` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `club_president_id_foreign` FOREIGN KEY (`president_id`) REFERENCES `test_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of test_club
-- ----------------------------
INSERT INTO `test_club` VALUES ('1', 'core.no_club', '0', '1', null, null, null, '2016-05-18 22:30:00', '2016-05-18 22:30:00', null);
INSERT INTO `test_club` VALUES ('2', 'Mrs. Briana Greenfelder', '9', '4', '1905 Wintheiser Ferry\nRileyfort, CO 00658', '1-451-335-3192', null, '2016-05-18 22:30:00', '2016-05-18 22:30:00', null);
INSERT INTO `test_club` VALUES ('3', 'Noelia Boehm', '13', '7', '8181 Cole Extensions Apt. 967\nWillmsland, CO 88345', '+1 (552) 273-0372', null, '2016-05-18 22:30:00', '2016-05-18 22:30:00', null);
INSERT INTO `test_club` VALUES ('4', 'Miss Georgette Champlin MD', '1', '8', '824 Harber Course\nSkilesfurt, KY 80672', '(532) 848-1062', null, '2016-05-18 22:30:00', '2016-05-18 22:30:00', null);
INSERT INTO `test_club` VALUES ('5', 'Prof. Destini Kuhn', '1', '1', '6492 Jaylon Canyon Suite 809\nLegrosville, NV 43958', '1-430-894-3234', null, '2016-05-18 22:30:00', '2016-05-18 22:30:00', null);
INSERT INTO `test_club` VALUES ('6', 'Miss Megane Wolf II', '6', '2', '2139 Anika Brook Apt. 221\nAdriannaview, ND 07133-3590', '+1-296-255-3464', null, '2016-05-18 22:30:00', '2016-05-18 22:30:00', null);
INSERT INTO `test_club` VALUES ('7', 'Naucali', '7', '10', '4981 Lehner Mill\nHipolitoshire, ME 93926', '731-774-6578 x1726', null, '2016-05-18 22:30:00', '2016-05-18 22:30:00', null);

-- ----------------------------
-- Table structure for test_countries
-- ----------------------------
DROP TABLE IF EXISTS `test_countries`;
CREATE TABLE `test_countries` (
  `id` int(10) unsigned NOT NULL,
  `capital` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `citizenship` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country_code` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `currency` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `currency_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `currency_sub_unit` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `currency_symbol` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `full_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `iso_3166_2` char(2) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `iso_3166_3` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `region_code` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `sub_region_code` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `eea` tinyint(1) NOT NULL DEFAULT '0',
  `calling_code` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `flag` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `countries_id_index` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of test_countries
-- ----------------------------
INSERT INTO `test_countries` VALUES ('4', 'Kabul', 'Afghan', '004', 'afghani', 'AFN', 'pul', '؋', 'Islamic Republic of Afghanistan', 'AF', 'AFG', 'Afghanistan', '142', '034', '0', '93', 'AF.png');
INSERT INTO `test_countries` VALUES ('8', 'Tirana', 'Albanian', '008', 'lek', 'ALL', '(qindar (pl. qindarka))', 'Lek', 'Republic of Albania', 'AL', 'ALB', 'Albania', '150', '039', '0', '355', 'AL.png');
INSERT INTO `test_countries` VALUES ('10', 'Antartica', 'of Antartica', '010', '', '', '', '', 'Antarctica', 'AQ', 'ATA', 'Antarctica', '', '', '0', '672', 'AQ.png');
INSERT INTO `test_countries` VALUES ('12', 'Algiers', 'Algerian', '012', 'Algerian dinar', 'DZD', 'centime', 'DZD', 'People’s Democratic Republic of Algeria', 'DZ', 'DZA', 'Algeria', '002', '015', '0', '213', 'DZ.png');
INSERT INTO `test_countries` VALUES ('16', 'Pago Pago', 'American Samoan', '016', 'US dollar', 'USD', 'cent', '$', 'Territory of American', 'AS', 'ASM', 'American Samoa', '009', '061', '0', '1', 'AS.png');
INSERT INTO `test_countries` VALUES ('20', 'Andorra la Vella', 'Andorran', '020', 'euro', 'EUR', 'cent', '€', 'Principality of Andorra', 'AD', 'AND', 'Andorra', '150', '039', '0', '376', 'AD.png');
INSERT INTO `test_countries` VALUES ('24', 'Luanda', 'Angolan', '024', 'kwanza', 'AOA', 'cêntimo', 'Kz', 'Republic of Angola', 'AO', 'AGO', 'Angola', '002', '017', '0', '244', 'AO.png');
INSERT INTO `test_countries` VALUES ('28', 'St John’s', 'of Antigua and Barbuda', '028', 'East Caribbean dollar', 'XCD', 'cent', '$', 'Antigua and Barbuda', 'AG', 'ATG', 'Antigua and Barbuda', '019', '029', '0', '1', 'AG.png');
INSERT INTO `test_countries` VALUES ('31', 'Baku', 'Azerbaijani', '031', 'Azerbaijani manat', 'AZN', 'kepik (inv.)', 'ман', 'Republic of Azerbaijan', 'AZ', 'AZE', 'Azerbaijan', '142', '145', '0', '994', 'AZ.png');
INSERT INTO `test_countries` VALUES ('32', 'Buenos Aires', 'Argentinian', '032', 'Argentine peso', 'ARS', 'centavo', '$', 'Argentine Republic', 'AR', 'ARG', 'Argentina', '019', '005', '0', '54', 'AR.png');
INSERT INTO `test_countries` VALUES ('36', 'Canberra', 'Australian', '036', 'Australian dollar', 'AUD', 'cent', '$', 'Commonwealth of Australia', 'AU', 'AUS', 'Australia', '009', '053', '0', '61', 'AU.png');
INSERT INTO `test_countries` VALUES ('40', 'Vienna', 'Austrian', '040', 'euro', 'EUR', 'cent', '€', 'Republic of Austria', 'AT', 'AUT', 'Austria', '150', '155', '1', '43', 'AT.png');
INSERT INTO `test_countries` VALUES ('44', 'Nassau', 'Bahamian', '044', 'Bahamian dollar', 'BSD', 'cent', '$', 'Commonwealth of the Bahamas', 'BS', 'BHS', 'Bahamas', '019', '029', '0', '1', 'BS.png');
INSERT INTO `test_countries` VALUES ('48', 'Manama', 'Bahraini', '048', 'Bahraini dinar', 'BHD', 'fils (inv.)', 'BHD', 'Kingdom of Bahrain', 'BH', 'BHR', 'Bahrain', '142', '145', '0', '973', 'BH.png');
INSERT INTO `test_countries` VALUES ('50', 'Dhaka', 'Bangladeshi', '050', 'taka (inv.)', 'BDT', 'poisha (inv.)', 'BDT', 'People’s Republic of Bangladesh', 'BD', 'BGD', 'Bangladesh', '142', '034', '0', '880', 'BD.png');
INSERT INTO `test_countries` VALUES ('51', 'Yerevan', 'Armenian', '051', 'dram (inv.)', 'AMD', 'luma', 'AMD', 'Republic of Armenia', 'AM', 'ARM', 'Armenia', '142', '145', '0', '374', 'AM.png');
INSERT INTO `test_countries` VALUES ('52', 'Bridgetown', 'Barbadian', '052', 'Barbados dollar', 'BBD', 'cent', '$', 'Barbados', 'BB', 'BRB', 'Barbados', '019', '029', '0', '1', 'BB.png');
INSERT INTO `test_countries` VALUES ('56', 'Brussels', 'Belgian', '056', 'euro', 'EUR', 'cent', '€', 'Kingdom of Belgium', 'BE', 'BEL', 'Belgium', '150', '155', '1', '32', 'BE.png');
INSERT INTO `test_countries` VALUES ('60', 'Hamilton', 'Bermudian', '060', 'Bermuda dollar', 'BMD', 'cent', '$', 'Bermuda', 'BM', 'BMU', 'Bermuda', '019', '021', '0', '1', 'BM.png');
INSERT INTO `test_countries` VALUES ('64', 'Thimphu', 'Bhutanese', '064', 'ngultrum (inv.)', 'BTN', 'chhetrum (inv.)', 'BTN', 'Kingdom of Bhutan', 'BT', 'BTN', 'Bhutan', '142', '034', '0', '975', 'BT.png');
INSERT INTO `test_countries` VALUES ('68', 'Sucre (BO1)', 'Bolivian', '068', 'boliviano', 'BOB', 'centavo', '$b', 'Plurinational State of Bolivia', 'BO', 'BOL', 'Bolivia, Plurinational State of', '019', '005', '0', '591', 'BO.png');
INSERT INTO `test_countries` VALUES ('70', 'Sarajevo', 'of Bosnia and Herzegovina', '070', 'convertible mark', 'BAM', 'fening', 'KM', 'Bosnia and Herzegovina', 'BA', 'BIH', 'Bosnia and Herzegovina', '150', '039', '0', '387', 'BA.png');
INSERT INTO `test_countries` VALUES ('72', 'Gaborone', 'Botswanan', '072', 'pula (inv.)', 'BWP', 'thebe (inv.)', 'P', 'Republic of Botswana', 'BW', 'BWA', 'Botswana', '002', '018', '0', '267', 'BW.png');
INSERT INTO `test_countries` VALUES ('74', 'Bouvet island', 'of Bouvet island', '074', '', '', '', 'kr', 'Bouvet Island', 'BV', 'BVT', 'Bouvet Island', '', '', '0', '47', 'BV.png');
INSERT INTO `test_countries` VALUES ('76', 'Brasilia', 'Brazilian', '076', 'real (pl. reais)', 'BRL', 'centavo', 'R$', 'Federative Republic of Brazil', 'BR', 'BRA', 'Brazil', '019', '005', '0', '55', 'BR.png');
INSERT INTO `test_countries` VALUES ('84', 'Belmopan', 'Belizean', '084', 'Belize dollar', 'BZD', 'cent', 'BZ$', 'Belize', 'BZ', 'BLZ', 'Belize', '019', '013', '0', '501', 'BZ.png');
INSERT INTO `test_countries` VALUES ('86', 'Diego Garcia', 'Changosian', '086', 'US dollar', 'USD', 'cent', '$', 'British Indian Ocean Territory', 'IO', 'IOT', 'British Indian Ocean Territory', '', '', '0', '246', 'IO.png');
INSERT INTO `test_countries` VALUES ('90', 'Honiara', 'Solomon Islander', '090', 'Solomon Islands dollar', 'SBD', 'cent', '$', 'Solomon Islands', 'SB', 'SLB', 'Solomon Islands', '009', '054', '0', '677', 'SB.png');
INSERT INTO `test_countries` VALUES ('92', 'Road Town', 'British Virgin Islander;', '092', 'US dollar', 'USD', 'cent', '$', 'British Virgin Islands', 'VG', 'VGB', 'Virgin Islands, British', '019', '029', '0', '1', 'VG.png');
INSERT INTO `test_countries` VALUES ('96', 'Bandar Seri Begawan', 'Bruneian', '096', 'Brunei dollar', 'BND', 'sen (inv.)', '$', 'Brunei Darussalam', 'BN', 'BRN', 'Brunei Darussalam', '142', '035', '0', '673', 'BN.png');
INSERT INTO `test_countries` VALUES ('100', 'Sofia', 'Bulgarian', '100', 'lev (pl. leva)', 'BGN', 'stotinka', 'лв', 'Republic of Bulgaria', 'BG', 'BGR', 'Bulgaria', '150', '151', '1', '359', 'BG.png');
INSERT INTO `test_countries` VALUES ('104', 'Yangon', 'Burmese', '104', 'kyat', 'MMK', 'pya', 'K', 'Union of Myanmar/', 'MM', 'MMR', 'Myanmar', '142', '035', '0', '95', 'MM.png');
INSERT INTO `test_countries` VALUES ('108', 'Bujumbura', 'Burundian', '108', 'Burundi franc', 'BIF', 'centime', 'BIF', 'Republic of Burundi', 'BI', 'BDI', 'Burundi', '002', '014', '0', '257', 'BI.png');
INSERT INTO `test_countries` VALUES ('112', 'Minsk', 'Belarusian', '112', 'Belarusian rouble', 'BYR', 'kopek', 'p.', 'Republic of Belarus', 'BY', 'BLR', 'Belarus', '150', '151', '0', '375', 'BY.png');
INSERT INTO `test_countries` VALUES ('116', 'Phnom Penh', 'Cambodian', '116', 'riel', 'KHR', 'sen (inv.)', '៛', 'Kingdom of Cambodia', 'KH', 'KHM', 'Cambodia', '142', '035', '0', '855', 'KH.png');
INSERT INTO `test_countries` VALUES ('120', 'Yaoundé', 'Cameroonian', '120', 'CFA franc (BEAC)', 'XAF', 'centime', 'FCF', 'Republic of Cameroon', 'CM', 'CMR', 'Cameroon', '002', '017', '0', '237', 'CM.png');
INSERT INTO `test_countries` VALUES ('124', 'Ottawa', 'Canadian', '124', 'Canadian dollar', 'CAD', 'cent', '$', 'Canada', 'CA', 'CAN', 'Canada', '019', '021', '0', '1', 'CA.png');
INSERT INTO `test_countries` VALUES ('132', 'Praia', 'Cape Verdean', '132', 'Cape Verde escudo', 'CVE', 'centavo', 'CVE', 'Republic of Cape Verde', 'CV', 'CPV', 'Cape Verde', '002', '011', '0', '238', 'CV.png');
INSERT INTO `test_countries` VALUES ('136', 'George Town', 'Caymanian', '136', 'Cayman Islands dollar', 'KYD', 'cent', '$', 'Cayman Islands', 'KY', 'CYM', 'Cayman Islands', '019', '029', '0', '1', 'KY.png');
INSERT INTO `test_countries` VALUES ('140', 'Bangui', 'Central African', '140', 'CFA franc (BEAC)', 'XAF', 'centime', 'FCF', 'Central African Republic', 'CF', 'CAF', 'Central African Republic', '002', '017', '0', '236', 'CF.png');
INSERT INTO `test_countries` VALUES ('144', 'Colombo', 'Sri Lankan', '144', 'Sri Lankan rupee', 'LKR', 'cent', '₨', 'Democratic Socialist Republic of Sri Lanka', 'LK', 'LKA', 'Sri Lanka', '142', '034', '0', '94', 'LK.png');
INSERT INTO `test_countries` VALUES ('148', 'N’Djamena', 'Chadian', '148', 'CFA franc (BEAC)', 'XAF', 'centime', 'XAF', 'Republic of Chad', 'TD', 'TCD', 'Chad', '002', '017', '0', '235', 'TD.png');
INSERT INTO `test_countries` VALUES ('152', 'Santiago', 'Chilean', '152', 'Chilean peso', 'CLP', 'centavo', 'CLP', 'Republic of Chile', 'CL', 'CHL', 'Chile', '019', '005', '0', '56', 'CL.png');
INSERT INTO `test_countries` VALUES ('156', 'Beijing', 'Chinese', '156', 'renminbi-yuan (inv.)', 'CNY', 'jiao (10)', '¥', 'People’s Republic of China', 'CN', 'CHN', 'China', '142', '030', '0', '86', 'CN.png');
INSERT INTO `test_countries` VALUES ('158', 'Taipei', 'Taiwanese', '158', 'new Taiwan dollar', 'TWD', 'fen (inv.)', 'NT$', 'Republic of China, Taiwan (TW1)', 'TW', 'TWN', 'Taiwan, Province of China', '142', '030', '0', '886', 'TW.png');
INSERT INTO `test_countries` VALUES ('162', 'Flying Fish Cove', 'Christmas Islander', '162', 'Australian dollar', 'AUD', 'cent', '$', 'Christmas Island Territory', 'CX', 'CXR', 'Christmas Island', '', '', '0', '61', 'CX.png');
INSERT INTO `test_countries` VALUES ('166', 'Bantam', 'Cocos Islander', '166', 'Australian dollar', 'AUD', 'cent', '$', 'Territory of Cocos (Keeling) Islands', 'CC', 'CCK', 'Cocos (Keeling) Islands', '', '', '0', '61', 'CC.png');
INSERT INTO `test_countries` VALUES ('170', 'Santa Fe de Bogotá', 'Colombian', '170', 'Colombian peso', 'COP', 'centavo', '$', 'Republic of Colombia', 'CO', 'COL', 'Colombia', '019', '005', '0', '57', 'CO.png');
INSERT INTO `test_countries` VALUES ('174', 'Moroni', 'Comorian', '174', 'Comorian franc', 'KMF', '', 'KMF', 'Union of the Comoros', 'KM', 'COM', 'Comoros', '002', '014', '0', '269', 'KM.png');
INSERT INTO `test_countries` VALUES ('175', 'Mamoudzou', 'Mahorais', '175', 'euro', 'EUR', 'cent', '€', 'Departmental Collectivity of Mayotte', 'YT', 'MYT', 'Mayotte', '002', '014', '0', '262', 'YT.png');
INSERT INTO `test_countries` VALUES ('178', 'Brazzaville', 'Congolese', '178', 'CFA franc (BEAC)', 'XAF', 'centime', 'FCF', 'Republic of the Congo', 'CG', 'COG', 'Congo', '002', '017', '0', '242', 'CG.png');
INSERT INTO `test_countries` VALUES ('180', 'Kinshasa', 'Congolese', '180', 'Congolese franc', 'CDF', 'centime', 'CDF', 'Democratic Republic of the Congo', 'CD', 'COD', 'Congo, the Democratic Republic of the', '002', '017', '0', '243', 'CD.png');
INSERT INTO `test_countries` VALUES ('184', 'Avarua', 'Cook Islander', '184', 'New Zealand dollar', 'NZD', 'cent', '$', 'Cook Islands', 'CK', 'COK', 'Cook Islands', '009', '061', '0', '682', 'CK.png');
INSERT INTO `test_countries` VALUES ('188', 'San José', 'Costa Rican', '188', 'Costa Rican colón (pl. colones)', 'CRC', 'céntimo', '₡', 'Republic of Costa Rica', 'CR', 'CRI', 'Costa Rica', '019', '013', '0', '506', 'CR.png');
INSERT INTO `test_countries` VALUES ('191', 'Zagreb', 'Croatian', '191', 'kuna (inv.)', 'HRK', 'lipa (inv.)', 'kn', 'Republic of Croatia', 'HR', 'HRV', 'Croatia', '150', '039', '1', '385', 'HR.png');
INSERT INTO `test_countries` VALUES ('192', 'Havana', 'Cuban', '192', 'Cuban peso', 'CUP', 'centavo', '₱', 'Republic of Cuba', 'CU', 'CUB', 'Cuba', '019', '029', '0', '53', 'CU.png');
INSERT INTO `test_countries` VALUES ('196', 'Nicosia', 'Cypriot', '196', 'euro', 'EUR', 'cent', 'CYP', 'Republic of Cyprus', 'CY', 'CYP', 'Cyprus', '142', '145', '1', '357', 'CY.png');
INSERT INTO `test_countries` VALUES ('203', 'Prague', 'Czech', '203', 'Czech koruna (pl. koruny)', 'CZK', 'halér', 'Kč', 'Czech Republic', 'CZ', 'CZE', 'Czech Republic', '150', '151', '1', '420', 'CZ.png');
INSERT INTO `test_countries` VALUES ('204', 'Porto Novo (BJ1)', 'Beninese', '204', 'CFA franc (BCEAO)', 'XOF', 'centime', 'XOF', 'Republic of Benin', 'BJ', 'BEN', 'Benin', '002', '011', '0', '229', 'BJ.png');
INSERT INTO `test_countries` VALUES ('208', 'Copenhagen', 'Danish', '208', 'Danish krone', 'DKK', 'øre (inv.)', 'kr', 'Kingdom of Denmark', 'DK', 'DNK', 'Denmark', '150', '154', '1', '45', 'DK.png');
INSERT INTO `test_countries` VALUES ('212', 'Roseau', 'Dominican', '212', 'East Caribbean dollar', 'XCD', 'cent', '$', 'Commonwealth of Dominica', 'DM', 'DMA', 'Dominica', '019', '029', '0', '1', 'DM.png');
INSERT INTO `test_countries` VALUES ('214', 'Santo Domingo', 'Dominican', '214', 'Dominican peso', 'DOP', 'centavo', 'RD$', 'Dominican Republic', 'DO', 'DOM', 'Dominican Republic', '019', '029', '0', '1', 'DO.png');
INSERT INTO `test_countries` VALUES ('218', 'Quito', 'Ecuadorian', '218', 'US dollar', 'USD', 'cent', '$', 'Republic of Ecuador', 'EC', 'ECU', 'Ecuador', '019', '005', '0', '593', 'EC.png');
INSERT INTO `test_countries` VALUES ('222', 'San Salvador', 'Salvadoran', '222', 'Salvadorian colón (pl. colones)', 'SVC', 'centavo', '$', 'Republic of El Salvador', 'SV', 'SLV', 'El Salvador', '019', '013', '0', '503', 'SV.png');
INSERT INTO `test_countries` VALUES ('226', 'Malabo', 'Equatorial Guinean', '226', 'CFA franc (BEAC)', 'XAF', 'centime', 'FCF', 'Republic of Equatorial Guinea', 'GQ', 'GNQ', 'Equatorial Guinea', '002', '017', '0', '240', 'GQ.png');
INSERT INTO `test_countries` VALUES ('231', 'Addis Ababa', 'Ethiopian', '231', 'birr (inv.)', 'ETB', 'cent', 'ETB', 'Federal Democratic Republic of Ethiopia', 'ET', 'ETH', 'Ethiopia', '002', '014', '0', '251', 'ET.png');
INSERT INTO `test_countries` VALUES ('232', 'Asmara', 'Eritrean', '232', 'nakfa', 'ERN', 'cent', 'Nfk', 'State of Eritrea', 'ER', 'ERI', 'Eritrea', '002', '014', '0', '291', 'ER.png');
INSERT INTO `test_countries` VALUES ('233', 'Tallinn', 'Estonian', '233', 'euro', 'EUR', 'cent', 'kr', 'Republic of Estonia', 'EE', 'EST', 'Estonia', '150', '154', '1', '372', 'EE.png');
INSERT INTO `test_countries` VALUES ('234', 'Tórshavn', 'Faeroese', '234', 'Danish krone', 'DKK', 'øre (inv.)', 'kr', 'Faeroe Islands', 'FO', 'FRO', 'Faroe Islands', '150', '154', '0', '298', 'FO.png');
INSERT INTO `test_countries` VALUES ('238', 'Stanley', 'Falkland Islander', '238', 'Falkland Islands pound', 'FKP', 'new penny', '£', 'Falkland Islands', 'FK', 'FLK', 'Falkland Islands (Malvinas)', '019', '005', '0', '500', 'FK.png');
INSERT INTO `test_countries` VALUES ('239', 'King Edward Point (Grytviken)', 'of South Georgia and the South Sandwich Islands', '239', '', '', '', '£', 'South Georgia and the South Sandwich Islands', 'GS', 'SGS', 'South Georgia and the South Sandwich Islands', '', '', '0', '44', 'GS.png');
INSERT INTO `test_countries` VALUES ('242', 'Suva', 'Fijian', '242', 'Fiji dollar', 'FJD', 'cent', '$', 'Republic of Fiji', 'FJ', 'FJI', 'Fiji', '009', '054', '0', '679', 'FJ.png');
INSERT INTO `test_countries` VALUES ('246', 'Helsinki', 'Finnish', '246', 'euro', 'EUR', 'cent', '€', 'Republic of Finland', 'FI', 'FIN', 'Finland', '150', '154', '1', '358', 'FI.png');
INSERT INTO `test_countries` VALUES ('248', 'Mariehamn', 'Åland Islander', '248', 'euro', 'EUR', 'cent', null, 'Åland Islands', 'AX', 'ALA', 'Åland Islands', '150', '154', '0', '358', null);
INSERT INTO `test_countries` VALUES ('250', 'Paris', 'French', '250', 'euro', 'EUR', 'cent', '€', 'French Republic', 'FR', 'FRA', 'France', '150', '155', '1', '33', 'FR.png');
INSERT INTO `test_countries` VALUES ('254', 'Cayenne', 'Guianese', '254', 'euro', 'EUR', 'cent', '€', 'French Guiana', 'GF', 'GUF', 'French Guiana', '019', '005', '0', '594', 'GF.png');
INSERT INTO `test_countries` VALUES ('258', 'Papeete', 'Polynesian', '258', 'CFP franc', 'XPF', 'centime', 'XPF', 'French Polynesia', 'PF', 'PYF', 'French Polynesia', '009', '061', '0', '689', 'PF.png');
INSERT INTO `test_countries` VALUES ('260', 'Port-aux-Francais', 'of French Southern and Antarctic Lands', '260', 'euro', 'EUR', 'cent', '€', 'French Southern and Antarctic Lands', 'TF', 'ATF', 'French Southern Territories', '', '', '0', '33', 'TF.png');
INSERT INTO `test_countries` VALUES ('262', 'Djibouti', 'Djiboutian', '262', 'Djibouti franc', 'DJF', '', 'DJF', 'Republic of Djibouti', 'DJ', 'DJI', 'Djibouti', '002', '014', '0', '253', 'DJ.png');
INSERT INTO `test_countries` VALUES ('266', 'Libreville', 'Gabonese', '266', 'CFA franc (BEAC)', 'XAF', 'centime', 'FCF', 'Gabonese Republic', 'GA', 'GAB', 'Gabon', '002', '017', '0', '241', 'GA.png');
INSERT INTO `test_countries` VALUES ('268', 'Tbilisi', 'Georgian', '268', 'lari', 'GEL', 'tetri (inv.)', 'GEL', 'Georgia', 'GE', 'GEO', 'Georgia', '142', '145', '0', '995', 'GE.png');
INSERT INTO `test_countries` VALUES ('270', 'Banjul', 'Gambian', '270', 'dalasi (inv.)', 'GMD', 'butut', 'D', 'Republic of the Gambia', 'GM', 'GMB', 'Gambia', '002', '011', '0', '220', 'GM.png');
INSERT INTO `test_countries` VALUES ('275', null, 'Palestinian', '275', null, null, null, '₪', null, 'PS', 'PSE', 'Palestinian Territory, Occupied', '142', '145', '0', '970', 'PS.png');
INSERT INTO `test_countries` VALUES ('276', 'Berlin', 'German', '276', 'euro', 'EUR', 'cent', '€', 'Federal Republic of Germany', 'DE', 'DEU', 'Germany', '150', '155', '1', '49', 'DE.png');
INSERT INTO `test_countries` VALUES ('288', 'Accra', 'Ghanaian', '288', 'Ghana cedi', 'GHS', 'pesewa', '¢', 'Republic of Ghana', 'GH', 'GHA', 'Ghana', '002', '011', '0', '233', 'GH.png');
INSERT INTO `test_countries` VALUES ('292', 'Gibraltar', 'Gibraltarian', '292', 'Gibraltar pound', 'GIP', 'penny', '£', 'Gibraltar', 'GI', 'GIB', 'Gibraltar', '150', '039', '0', '350', 'GI.png');
INSERT INTO `test_countries` VALUES ('296', 'Tarawa', 'Kiribatian', '296', 'Australian dollar', 'AUD', 'cent', '$', 'Republic of Kiribati', 'KI', 'KIR', 'Kiribati', '009', '057', '0', '686', 'KI.png');
INSERT INTO `test_countries` VALUES ('300', 'Athens', 'Greek', '300', 'euro', 'EUR', 'cent', '€', 'Hellenic Republic', 'GR', 'GRC', 'Greece', '150', '039', '1', '30', 'GR.png');
INSERT INTO `test_countries` VALUES ('304', 'Nuuk', 'Greenlander', '304', 'Danish krone', 'DKK', 'øre (inv.)', 'kr', 'Greenland', 'GL', 'GRL', 'Greenland', '019', '021', '0', '299', 'GL.png');
INSERT INTO `test_countries` VALUES ('308', 'St George’s', 'Grenadian', '308', 'East Caribbean dollar', 'XCD', 'cent', '$', 'Grenada', 'GD', 'GRD', 'Grenada', '019', '029', '0', '1', 'GD.png');
INSERT INTO `test_countries` VALUES ('312', 'Basse Terre', 'Guadeloupean', '312', 'euro', 'EUR ', 'cent', '€', 'Guadeloupe', 'GP', 'GLP', 'Guadeloupe', '019', '029', '0', '590', 'GP.png');
INSERT INTO `test_countries` VALUES ('316', 'Agaña (Hagåtña)', 'Guamanian', '316', 'US dollar', 'USD', 'cent', '$', 'Territory of Guam', 'GU', 'GUM', 'Guam', '009', '057', '0', '1', 'GU.png');
INSERT INTO `test_countries` VALUES ('320', 'Guatemala City', 'Guatemalan', '320', 'quetzal (pl. quetzales)', 'GTQ', 'centavo', 'Q', 'Republic of Guatemala', 'GT', 'GTM', 'Guatemala', '019', '013', '0', '502', 'GT.png');
INSERT INTO `test_countries` VALUES ('324', 'Conakry', 'Guinean', '324', 'Guinean franc', 'GNF', '', 'GNF', 'Republic of Guinea', 'GN', 'GIN', 'Guinea', '002', '011', '0', '224', 'GN.png');
INSERT INTO `test_countries` VALUES ('328', 'Georgetown', 'Guyanese', '328', 'Guyana dollar', 'GYD', 'cent', '$', 'Cooperative Republic of Guyana', 'GY', 'GUY', 'Guyana', '019', '005', '0', '592', 'GY.png');
INSERT INTO `test_countries` VALUES ('332', 'Port-au-Prince', 'Haitian', '332', 'gourde', 'HTG', 'centime', 'G', 'Republic of Haiti', 'HT', 'HTI', 'Haiti', '019', '029', '0', '509', 'HT.png');
INSERT INTO `test_countries` VALUES ('334', 'Territory of Heard Island and McDonald Islands', 'of Territory of Heard Island and McDonald Islands', '334', '', '', '', '$', 'Territory of Heard Island and McDonald Islands', 'HM', 'HMD', 'Heard Island and McDonald Islands', '', '', '0', '61', 'HM.png');
INSERT INTO `test_countries` VALUES ('336', 'Vatican City', 'of the Holy See/of the Vatican', '336', 'euro', 'EUR', 'cent', '€', 'the Holy See/ Vatican City State', 'VA', 'VAT', 'Holy See (Vatican City State)', '150', '039', '0', '39', 'VA.png');
INSERT INTO `test_countries` VALUES ('340', 'Tegucigalpa', 'Honduran', '340', 'lempira', 'HNL', 'centavo', 'L', 'Republic of Honduras', 'HN', 'HND', 'Honduras', '019', '013', '0', '504', 'HN.png');
INSERT INTO `test_countries` VALUES ('344', '(HK3)', 'Hong Kong Chinese', '344', 'Hong Kong dollar', 'HKD', 'cent', '$', 'Hong Kong Special Administrative Region of the People’s Republic of China (HK2)', 'HK', 'HKG', 'Hong Kong', '142', '030', '0', '852', 'HK.png');
INSERT INTO `test_countries` VALUES ('348', 'Budapest', 'Hungarian', '348', 'forint (inv.)', 'HUF', '(fillér (inv.))', 'Ft', 'Republic of Hungary', 'HU', 'HUN', 'Hungary', '150', '151', '1', '36', 'HU.png');
INSERT INTO `test_countries` VALUES ('352', 'Reykjavik', 'Icelander', '352', 'króna (pl. krónur)', 'ISK', '', 'kr', 'Republic of Iceland', 'IS', 'ISL', 'Iceland', '150', '154', '1', '354', 'IS.png');
INSERT INTO `test_countries` VALUES ('356', 'New Delhi', 'Indian', '356', 'Indian rupee', 'INR', 'paisa', '₹', 'Republic of India', 'IN', 'IND', 'India', '142', '034', '0', '91', 'IN.png');
INSERT INTO `test_countries` VALUES ('360', 'Jakarta', 'Indonesian', '360', 'Indonesian rupiah (inv.)', 'IDR', 'sen (inv.)', 'Rp', 'Republic of Indonesia', 'ID', 'IDN', 'Indonesia', '142', '035', '0', '62', 'ID.png');
INSERT INTO `test_countries` VALUES ('364', 'Tehran', 'Iranian', '364', 'Iranian rial', 'IRR', '(dinar) (IR1)', '﷼', 'Islamic Republic of Iran', 'IR', 'IRN', 'Iran, Islamic Republic of', '142', '034', '0', '98', 'IR.png');
INSERT INTO `test_countries` VALUES ('368', 'Baghdad', 'Iraqi', '368', 'Iraqi dinar', 'IQD', 'fils (inv.)', 'IQD', 'Republic of Iraq', 'IQ', 'IRQ', 'Iraq', '142', '145', '0', '964', 'IQ.png');
INSERT INTO `test_countries` VALUES ('372', 'Dublin', 'Irish', '372', 'euro', 'EUR', 'cent', '€', 'Ireland (IE1)', 'IE', 'IRL', 'Ireland', '150', '154', '1', '353', 'IE.png');
INSERT INTO `test_countries` VALUES ('376', '(IL1)', 'Israeli', '376', 'shekel', 'ILS', 'agora', '₪', 'State of Israel', 'IL', 'ISR', 'Israel', '142', '145', '0', '972', 'IL.png');
INSERT INTO `test_countries` VALUES ('380', 'Rome', 'Italian', '380', 'euro', 'EUR', 'cent', '€', 'Italian Republic', 'IT', 'ITA', 'Italy', '150', '039', '1', '39', 'IT.png');
INSERT INTO `test_countries` VALUES ('384', 'Yamoussoukro (CI1)', 'Ivorian', '384', 'CFA franc (BCEAO)', 'XOF', 'centime', 'XOF', 'Republic of Côte d’Ivoire', 'CI', 'CIV', 'Côte d\'Ivoire', '002', '011', '0', '225', 'CI.png');
INSERT INTO `test_countries` VALUES ('388', 'Kingston', 'Jamaican', '388', 'Jamaica dollar', 'JMD', 'cent', '$', 'Jamaica', 'JM', 'JAM', 'Jamaica', '019', '029', '0', '1', 'JM.png');
INSERT INTO `test_countries` VALUES ('392', 'Tokyo', 'Japanese', '392', 'yen (inv.)', 'JPY', '(sen (inv.)) (JP1)', '¥', 'Japan', 'JP', 'JPN', 'Japan', '142', '030', '0', '81', 'JP.png');
INSERT INTO `test_countries` VALUES ('398', 'Astana', 'Kazakh', '398', 'tenge (inv.)', 'KZT', 'tiyn', 'лв', 'Republic of Kazakhstan', 'KZ', 'KAZ', 'Kazakhstan', '142', '143', '0', '7', 'KZ.png');
INSERT INTO `test_countries` VALUES ('400', 'Amman', 'Jordanian', '400', 'Jordanian dinar', 'JOD', '100 qirsh', 'JOD', 'Hashemite Kingdom of Jordan', 'JO', 'JOR', 'Jordan', '142', '145', '0', '962', 'JO.png');
INSERT INTO `test_countries` VALUES ('404', 'Nairobi', 'Kenyan', '404', 'Kenyan shilling', 'KES', 'cent', 'KES', 'Republic of Kenya', 'KE', 'KEN', 'Kenya', '002', '014', '0', '254', 'KE.png');
INSERT INTO `test_countries` VALUES ('408', 'Pyongyang', 'North Korean', '408', 'North Korean won (inv.)', 'KPW', 'chun (inv.)', '₩', 'Democratic People’s Republic of Korea', 'KP', 'PRK', 'Korea, Democratic People\'s Republic of', '142', '030', '0', '850', 'KP.png');
INSERT INTO `test_countries` VALUES ('410', 'Seoul', 'South Korean', '410', 'South Korean won (inv.)', 'KRW', '(chun (inv.))', '₩', 'Republic of Korea', 'KR', 'KOR', 'Korea, Republic of', '142', '030', '0', '82', 'KR.png');
INSERT INTO `test_countries` VALUES ('414', 'Kuwait City', 'Kuwaiti', '414', 'Kuwaiti dinar', 'KWD', 'fils (inv.)', 'KWD', 'State of Kuwait', 'KW', 'KWT', 'Kuwait', '142', '145', '0', '965', 'KW.png');
INSERT INTO `test_countries` VALUES ('417', 'Bishkek', 'Kyrgyz', '417', 'som', 'KGS', 'tyiyn', 'лв', 'Kyrgyz Republic', 'KG', 'KGZ', 'Kyrgyzstan', '142', '143', '0', '996', 'KG.png');
INSERT INTO `test_countries` VALUES ('418', 'Vientiane', 'Lao', '418', 'kip (inv.)', 'LAK', '(at (inv.))', '₭', 'Lao People’s Democratic Republic', 'LA', 'LAO', 'Lao People\'s Democratic Republic', '142', '035', '0', '856', 'LA.png');
INSERT INTO `test_countries` VALUES ('422', 'Beirut', 'Lebanese', '422', 'Lebanese pound', 'LBP', '(piastre)', '£', 'Lebanese Republic', 'LB', 'LBN', 'Lebanon', '142', '145', '0', '961', 'LB.png');
INSERT INTO `test_countries` VALUES ('426', 'Maseru', 'Basotho', '426', 'loti (pl. maloti)', 'LSL', 'sente', 'L', 'Kingdom of Lesotho', 'LS', 'LSO', 'Lesotho', '002', '018', '0', '266', 'LS.png');
INSERT INTO `test_countries` VALUES ('428', 'Riga', 'Latvian', '428', 'euro', 'EUR', 'cent', 'Ls', 'Republic of Latvia', 'LV', 'LVA', 'Latvia', '150', '154', '1', '371', 'LV.png');
INSERT INTO `test_countries` VALUES ('430', 'Monrovia', 'Liberian', '430', 'Liberian dollar', 'LRD', 'cent', '$', 'Republic of Liberia', 'LR', 'LBR', 'Liberia', '002', '011', '0', '231', 'LR.png');
INSERT INTO `test_countries` VALUES ('434', 'Tripoli', 'Libyan', '434', 'Libyan dinar', 'LYD', 'dirham', 'LYD', 'Socialist People’s Libyan Arab Jamahiriya', 'LY', 'LBY', 'Libya', '002', '015', '0', '218', 'LY.png');
INSERT INTO `test_countries` VALUES ('438', 'Vaduz', 'Liechtensteiner', '438', 'Swiss franc', 'CHF', 'centime', 'CHF', 'Principality of Liechtenstein', 'LI', 'LIE', 'Liechtenstein', '150', '155', '1', '423', 'LI.png');
INSERT INTO `test_countries` VALUES ('440', 'Vilnius', 'Lithuanian', '440', 'euro', 'EUR', 'cent', 'Lt', 'Republic of Lithuania', 'LT', 'LTU', 'Lithuania', '150', '154', '1', '370', 'LT.png');
INSERT INTO `test_countries` VALUES ('442', 'Luxembourg', 'Luxembourger', '442', 'euro', 'EUR', 'cent', '€', 'Grand Duchy of Luxembourg', 'LU', 'LUX', 'Luxembourg', '150', '155', '1', '352', 'LU.png');
INSERT INTO `test_countries` VALUES ('446', 'Macao (MO3)', 'Macanese', '446', 'pataca', 'MOP', 'avo', 'MOP', 'Macao Special Administrative Region of the People’s Republic of China (MO2)', 'MO', 'MAC', 'Macao', '142', '030', '0', '853', 'MO.png');
INSERT INTO `test_countries` VALUES ('450', 'Antananarivo', 'Malagasy', '450', 'ariary', 'MGA', 'iraimbilanja (inv.)', 'MGA', 'Republic of Madagascar', 'MG', 'MDG', 'Madagascar', '002', '014', '0', '261', 'MG.png');
INSERT INTO `test_countries` VALUES ('454', 'Lilongwe', 'Malawian', '454', 'Malawian kwacha (inv.)', 'MWK', 'tambala (inv.)', 'MK', 'Republic of Malawi', 'MW', 'MWI', 'Malawi', '002', '014', '0', '265', 'MW.png');
INSERT INTO `test_countries` VALUES ('458', 'Kuala Lumpur (MY1)', 'Malaysian', '458', 'ringgit (inv.)', 'MYR', 'sen (inv.)', 'RM', 'Malaysia', 'MY', 'MYS', 'Malaysia', '142', '035', '0', '60', 'MY.png');
INSERT INTO `test_countries` VALUES ('462', 'Malé', 'Maldivian', '462', 'rufiyaa', 'MVR', 'laari (inv.)', 'Rf', 'Republic of Maldives', 'MV', 'MDV', 'Maldives', '142', '034', '0', '960', 'MV.png');
INSERT INTO `test_countries` VALUES ('466', 'Bamako', 'Malian', '466', 'CFA franc (BCEAO)', 'XOF', 'centime', 'XOF', 'Republic of Mali', 'ML', 'MLI', 'Mali', '002', '011', '0', '223', 'ML.png');
INSERT INTO `test_countries` VALUES ('470', 'Valletta', 'Maltese', '470', 'euro', 'EUR', 'cent', 'MTL', 'Republic of Malta', 'MT', 'MLT', 'Malta', '150', '039', '1', '356', 'MT.png');
INSERT INTO `test_countries` VALUES ('474', 'Fort-de-France', 'Martinican', '474', 'euro', 'EUR', 'cent', '€', 'Martinique', 'MQ', 'MTQ', 'Martinique', '019', '029', '0', '596', 'MQ.png');
INSERT INTO `test_countries` VALUES ('478', 'Nouakchott', 'Mauritanian', '478', 'ouguiya', 'MRO', 'khoum', 'UM', 'Islamic Republic of Mauritania', 'MR', 'MRT', 'Mauritania', '002', '011', '0', '222', 'MR.png');
INSERT INTO `test_countries` VALUES ('480', 'Port Louis', 'Mauritian', '480', 'Mauritian rupee', 'MUR', 'cent', '₨', 'Republic of Mauritius', 'MU', 'MUS', 'Mauritius', '002', '014', '0', '230', 'MU.png');
INSERT INTO `test_countries` VALUES ('484', 'Mexico City', 'Mexican', '484', 'Mexican peso', 'MXN', 'centavo', '$', 'United Mexican States', 'MX', 'MEX', 'Mexico', '019', '013', '0', '52', 'MX.png');
INSERT INTO `test_countries` VALUES ('492', 'Monaco', 'Monegasque', '492', 'euro', 'EUR', 'cent', '€', 'Principality of Monaco', 'MC', 'MCO', 'Monaco', '150', '155', '0', '377', 'MC.png');
INSERT INTO `test_countries` VALUES ('496', 'Ulan Bator', 'Mongolian', '496', 'tugrik', 'MNT', 'möngö (inv.)', '₮', 'Mongolia', 'MN', 'MNG', 'Mongolia', '142', '030', '0', '976', 'MN.png');
INSERT INTO `test_countries` VALUES ('498', 'Chisinau', 'Moldovan', '498', 'Moldovan leu (pl. lei)', 'MDL', 'ban', 'MDL', 'Republic of Moldova', 'MD', 'MDA', 'Moldova, Republic of', '150', '151', '0', '373', 'MD.png');
INSERT INTO `test_countries` VALUES ('499', 'Podgorica', 'Montenegrin', '499', 'euro', 'EUR', 'cent', null, 'Montenegro', 'ME', 'MNE', 'Montenegro', '150', '039', '0', '382', null);
INSERT INTO `test_countries` VALUES ('500', 'Plymouth (MS2)', 'Montserratian', '500', 'East Caribbean dollar', 'XCD', 'cent', '$', 'Montserrat', 'MS', 'MSR', 'Montserrat', '019', '029', '0', '1', 'MS.png');
INSERT INTO `test_countries` VALUES ('504', 'Rabat', 'Moroccan', '504', 'Moroccan dirham', 'MAD', 'centime', 'MAD', 'Kingdom of Morocco', 'MA', 'MAR', 'Morocco', '002', '015', '0', '212', 'MA.png');
INSERT INTO `test_countries` VALUES ('508', 'Maputo', 'Mozambican', '508', 'metical', 'MZN', 'centavo', 'MT', 'Republic of Mozambique', 'MZ', 'MOZ', 'Mozambique', '002', '014', '0', '258', 'MZ.png');
INSERT INTO `test_countries` VALUES ('512', 'Muscat', 'Omani', '512', 'Omani rial', 'OMR', 'baiza', '﷼', 'Sultanate of Oman', 'OM', 'OMN', 'Oman', '142', '145', '0', '968', 'OM.png');
INSERT INTO `test_countries` VALUES ('516', 'Windhoek', 'Namibian', '516', 'Namibian dollar', 'NAD', 'cent', '$', 'Republic of Namibia', 'NA', 'NAM', 'Namibia', '002', '018', '0', '264', 'NA.png');
INSERT INTO `test_countries` VALUES ('520', 'Yaren', 'Nauruan', '520', 'Australian dollar', 'AUD', 'cent', '$', 'Republic of Nauru', 'NR', 'NRU', 'Nauru', '009', '057', '0', '674', 'NR.png');
INSERT INTO `test_countries` VALUES ('524', 'Kathmandu', 'Nepalese', '524', 'Nepalese rupee', 'NPR', 'paisa (inv.)', '₨', 'Nepal', 'NP', 'NPL', 'Nepal', '142', '034', '0', '977', 'NP.png');
INSERT INTO `test_countries` VALUES ('528', 'Amsterdam (NL2)', 'Dutch', '528', 'euro', 'EUR', 'cent', '€', 'Kingdom of the Netherlands', 'NL', 'NLD', 'Netherlands', '150', '155', '1', '31', 'NL.png');
INSERT INTO `test_countries` VALUES ('531', 'Willemstad', 'Curaçaoan', '531', 'Netherlands Antillean guilder (CW1)', 'ANG', 'cent', null, 'Curaçao', 'CW', 'CUW', 'Curaçao', '019', '029', '0', '599', null);
INSERT INTO `test_countries` VALUES ('533', 'Oranjestad', 'Aruban', '533', 'Aruban guilder', 'AWG', 'cent', 'ƒ', 'Aruba', 'AW', 'ABW', 'Aruba', '019', '029', '0', '297', 'AW.png');
INSERT INTO `test_countries` VALUES ('534', 'Philipsburg', 'Sint Maartener', '534', 'Netherlands Antillean guilder (SX1)', 'ANG', 'cent', null, 'Sint Maarten', 'SX', 'SXM', 'Sint Maarten (Dutch part)', '019', '029', '0', '721', null);
INSERT INTO `test_countries` VALUES ('535', null, 'of Bonaire, Sint Eustatius and Saba', '535', 'US dollar', 'USD', 'cent', null, null, 'BQ', 'BES', 'Bonaire, Sint Eustatius and Saba', '019', '029', '0', '599', null);
INSERT INTO `test_countries` VALUES ('540', 'Nouméa', 'New Caledonian', '540', 'CFP franc', 'XPF', 'centime', 'XPF', 'New Caledonia', 'NC', 'NCL', 'New Caledonia', '009', '054', '0', '687', 'NC.png');
INSERT INTO `test_countries` VALUES ('548', 'Port Vila', 'Vanuatuan', '548', 'vatu (inv.)', 'VUV', '', 'Vt', 'Republic of Vanuatu', 'VU', 'VUT', 'Vanuatu', '009', '054', '0', '678', 'VU.png');
INSERT INTO `test_countries` VALUES ('554', 'Wellington', 'New Zealander', '554', 'New Zealand dollar', 'NZD', 'cent', '$', 'New Zealand', 'NZ', 'NZL', 'New Zealand', '009', '053', '0', '64', 'NZ.png');
INSERT INTO `test_countries` VALUES ('558', 'Managua', 'Nicaraguan', '558', 'córdoba oro', 'NIO', 'centavo', 'C$', 'Republic of Nicaragua', 'NI', 'NIC', 'Nicaragua', '019', '013', '0', '505', 'NI.png');
INSERT INTO `test_countries` VALUES ('562', 'Niamey', 'Nigerien', '562', 'CFA franc (BCEAO)', 'XOF', 'centime', 'XOF', 'Republic of Niger', 'NE', 'NER', 'Niger', '002', '011', '0', '227', 'NE.png');
INSERT INTO `test_countries` VALUES ('566', 'Abuja', 'Nigerian', '566', 'naira (inv.)', 'NGN', 'kobo (inv.)', '₦', 'Federal Republic of Nigeria', 'NG', 'NGA', 'Nigeria', '002', '011', '0', '234', 'NG.png');
INSERT INTO `test_countries` VALUES ('570', 'Alofi', 'Niuean', '570', 'New Zealand dollar', 'NZD', 'cent', '$', 'Niue', 'NU', 'NIU', 'Niue', '009', '061', '0', '683', 'NU.png');
INSERT INTO `test_countries` VALUES ('574', 'Kingston', 'Norfolk Islander', '574', 'Australian dollar', 'AUD', 'cent', '$', 'Territory of Norfolk Island', 'NF', 'NFK', 'Norfolk Island', '009', '053', '0', '672', 'NF.png');
INSERT INTO `test_countries` VALUES ('578', 'Oslo', 'Norwegian', '578', 'Norwegian krone (pl. kroner)', 'NOK', 'øre (inv.)', 'kr', 'Kingdom of Norway', 'NO', 'NOR', 'Norway', '150', '154', '1', '47', 'NO.png');
INSERT INTO `test_countries` VALUES ('580', 'Saipan', 'Northern Mariana Islander', '580', 'US dollar', 'USD', 'cent', '$', 'Commonwealth of the Northern Mariana Islands', 'MP', 'MNP', 'Northern Mariana Islands', '009', '057', '0', '1', 'MP.png');
INSERT INTO `test_countries` VALUES ('581', 'United States Minor Outlying Islands', 'of United States Minor Outlying Islands', '581', 'US dollar', 'USD', 'cent', '$', 'United States Minor Outlying Islands', 'UM', 'UMI', 'United States Minor Outlying Islands', '', '', '0', '1', 'UM.png');
INSERT INTO `test_countries` VALUES ('583', 'Palikir', 'Micronesian', '583', 'US dollar', 'USD', 'cent', '$', 'Federated States of Micronesia', 'FM', 'FSM', 'Micronesia, Federated States of', '009', '057', '0', '691', 'FM.png');
INSERT INTO `test_countries` VALUES ('584', 'Majuro', 'Marshallese', '584', 'US dollar', 'USD', 'cent', '$', 'Republic of the Marshall Islands', 'MH', 'MHL', 'Marshall Islands', '009', '057', '0', '692', 'MH.png');
INSERT INTO `test_countries` VALUES ('585', 'Melekeok', 'Palauan', '585', 'US dollar', 'USD', 'cent', '$', 'Republic of Palau', 'PW', 'PLW', 'Palau', '009', '057', '0', '680', 'PW.png');
INSERT INTO `test_countries` VALUES ('586', 'Islamabad', 'Pakistani', '586', 'Pakistani rupee', 'PKR', 'paisa', '₨', 'Islamic Republic of Pakistan', 'PK', 'PAK', 'Pakistan', '142', '034', '0', '92', 'PK.png');
INSERT INTO `test_countries` VALUES ('591', 'Panama City', 'Panamanian', '591', 'balboa', 'PAB', 'centésimo', 'B/.', 'Republic of Panama', 'PA', 'PAN', 'Panama', '019', '013', '0', '507', 'PA.png');
INSERT INTO `test_countries` VALUES ('598', 'Port Moresby', 'Papua New Guinean', '598', 'kina (inv.)', 'PGK', 'toea (inv.)', 'PGK', 'Independent State of Papua New Guinea', 'PG', 'PNG', 'Papua New Guinea', '009', '054', '0', '675', 'PG.png');
INSERT INTO `test_countries` VALUES ('600', 'Asunción', 'Paraguayan', '600', 'guaraní', 'PYG', 'céntimo', 'Gs', 'Republic of Paraguay', 'PY', 'PRY', 'Paraguay', '019', '005', '0', '595', 'PY.png');
INSERT INTO `test_countries` VALUES ('604', 'Lima', 'Peruvian', '604', 'new sol', 'PEN', 'céntimo', 'S/.', 'Republic of Peru', 'PE', 'PER', 'Peru', '019', '005', '0', '51', 'PE.png');
INSERT INTO `test_countries` VALUES ('608', 'Manila', 'Filipino', '608', 'Philippine peso', 'PHP', 'centavo', 'Php', 'Republic of the Philippines', 'PH', 'PHL', 'Philippines', '142', '035', '0', '63', 'PH.png');
INSERT INTO `test_countries` VALUES ('612', 'Adamstown', 'Pitcairner', '612', 'New Zealand dollar', 'NZD', 'cent', '$', 'Pitcairn Islands', 'PN', 'PCN', 'Pitcairn', '009', '061', '0', '649', 'PN.png');
INSERT INTO `test_countries` VALUES ('616', 'Warsaw', 'Polish', '616', 'zloty', 'PLN', 'grosz (pl. groszy)', 'zł', 'Republic of Poland', 'PL', 'POL', 'Poland', '150', '151', '1', '48', 'PL.png');
INSERT INTO `test_countries` VALUES ('620', 'Lisbon', 'Portuguese', '620', 'euro', 'EUR', 'cent', '€', 'Portuguese Republic', 'PT', 'PRT', 'Portugal', '150', '039', '1', '351', 'PT.png');
INSERT INTO `test_countries` VALUES ('624', 'Bissau', 'Guinea-Bissau national', '624', 'CFA franc (BCEAO)', 'XOF', 'centime', 'XOF', 'Republic of Guinea-Bissau', 'GW', 'GNB', 'Guinea-Bissau', '002', '011', '0', '245', 'GW.png');
INSERT INTO `test_countries` VALUES ('626', 'Dili', 'East Timorese', '626', 'US dollar', 'USD', 'cent', '$', 'Democratic Republic of East Timor', 'TL', 'TLS', 'Timor-Leste', '142', '035', '0', '670', 'TL.png');
INSERT INTO `test_countries` VALUES ('630', 'San Juan', 'Puerto Rican', '630', 'US dollar', 'USD', 'cent', '$', 'Commonwealth of Puerto Rico', 'PR', 'PRI', 'Puerto Rico', '019', '029', '0', '1', 'PR.png');
INSERT INTO `test_countries` VALUES ('634', 'Doha', 'Qatari', '634', 'Qatari riyal', 'QAR', 'dirham', '﷼', 'State of Qatar', 'QA', 'QAT', 'Qatar', '142', '145', '0', '974', 'QA.png');
INSERT INTO `test_countries` VALUES ('638', 'Saint-Denis', 'Reunionese', '638', 'euro', 'EUR', 'cent', '€', 'Réunion', 'RE', 'REU', 'Réunion', '002', '014', '0', '262', 'RE.png');
INSERT INTO `test_countries` VALUES ('642', 'Bucharest', 'Romanian', '642', 'Romanian leu (pl. lei)', 'RON', 'ban (pl. bani)', 'lei', 'Romania', 'RO', 'ROU', 'Romania', '150', '151', '1', '40', 'RO.png');
INSERT INTO `test_countries` VALUES ('643', 'Moscow', 'Russian', '643', 'Russian rouble', 'RUB', 'kopek', 'руб', 'Russian Federation', 'RU', 'RUS', 'Russian Federation', '150', '151', '0', '7', 'RU.png');
INSERT INTO `test_countries` VALUES ('646', 'Kigali', 'Rwandan; Rwandese', '646', 'Rwandese franc', 'RWF', 'centime', 'RWF', 'Republic of Rwanda', 'RW', 'RWA', 'Rwanda', '002', '014', '0', '250', 'RW.png');
INSERT INTO `test_countries` VALUES ('652', 'Gustavia', 'of Saint Barthélemy', '652', 'euro', 'EUR', 'cent', null, 'Collectivity of Saint Barthélemy', 'BL', 'BLM', 'Saint Barthélemy', '019', '029', '0', '590', null);
INSERT INTO `test_countries` VALUES ('654', 'Jamestown', 'Saint Helenian', '654', 'Saint Helena pound', 'SHP', 'penny', '£', 'Saint Helena, Ascension and Tristan da Cunha', 'SH', 'SHN', 'Saint Helena, Ascension and Tristan da Cunha', '002', '011', '0', '290', 'SH.png');
INSERT INTO `test_countries` VALUES ('659', 'Basseterre', 'Kittsian; Nevisian', '659', 'East Caribbean dollar', 'XCD', 'cent', '$', 'Federation of Saint Kitts and Nevis', 'KN', 'KNA', 'Saint Kitts and Nevis', '019', '029', '0', '1', 'KN.png');
INSERT INTO `test_countries` VALUES ('660', 'The Valley', 'Anguillan', '660', 'East Caribbean dollar', 'XCD', 'cent', '$', 'Anguilla', 'AI', 'AIA', 'Anguilla', '019', '029', '0', '1', 'AI.png');
INSERT INTO `test_countries` VALUES ('662', 'Castries', 'Saint Lucian', '662', 'East Caribbean dollar', 'XCD', 'cent', '$', 'Saint Lucia', 'LC', 'LCA', 'Saint Lucia', '019', '029', '0', '1', 'LC.png');
INSERT INTO `test_countries` VALUES ('663', 'Marigot', 'of Saint Martin', '663', 'euro', 'EUR', 'cent', null, 'Collectivity of Saint Martin', 'MF', 'MAF', 'Saint Martin (French part)', '019', '029', '0', '590', null);
INSERT INTO `test_countries` VALUES ('666', 'Saint-Pierre', 'St-Pierrais; Miquelonnais', '666', 'euro', 'EUR', 'cent', '€', 'Territorial Collectivity of Saint Pierre and Miquelon', 'PM', 'SPM', 'Saint Pierre and Miquelon', '019', '021', '0', '508', 'PM.png');
INSERT INTO `test_countries` VALUES ('670', 'Kingstown', 'Vincentian', '670', 'East Caribbean dollar', 'XCD', 'cent', '$', 'Saint Vincent and the Grenadines', 'VC', 'VCT', 'Saint Vincent and the Grenadines', '019', '029', '0', '1', 'VC.png');
INSERT INTO `test_countries` VALUES ('674', 'San Marino', 'San Marinese', '674', 'euro', 'EUR ', 'cent', '€', 'Republic of San Marino', 'SM', 'SMR', 'San Marino', '150', '039', '0', '378', 'SM.png');
INSERT INTO `test_countries` VALUES ('678', 'São Tomé', 'São Toméan', '678', 'dobra', 'STD', 'centavo', 'Db', 'Democratic Republic of São Tomé and Príncipe', 'ST', 'STP', 'Sao Tome and Principe', '002', '017', '0', '239', 'ST.png');
INSERT INTO `test_countries` VALUES ('682', 'Riyadh', 'Saudi Arabian', '682', 'riyal', 'SAR', 'halala', '﷼', 'Kingdom of Saudi Arabia', 'SA', 'SAU', 'Saudi Arabia', '142', '145', '0', '966', 'SA.png');
INSERT INTO `test_countries` VALUES ('686', 'Dakar', 'Senegalese', '686', 'CFA franc (BCEAO)', 'XOF', 'centime', 'XOF', 'Republic of Senegal', 'SN', 'SEN', 'Senegal', '002', '011', '0', '221', 'SN.png');
INSERT INTO `test_countries` VALUES ('688', 'Belgrade', 'Serb', '688', 'Serbian dinar', 'RSD', 'para (inv.)', null, 'Republic of Serbia', 'RS', 'SRB', 'Serbia', '150', '039', '0', '381', null);
INSERT INTO `test_countries` VALUES ('690', 'Victoria', 'Seychellois', '690', 'Seychelles rupee', 'SCR', 'cent', '₨', 'Republic of Seychelles', 'SC', 'SYC', 'Seychelles', '002', '014', '0', '248', 'SC.png');
INSERT INTO `test_countries` VALUES ('694', 'Freetown', 'Sierra Leonean', '694', 'leone', 'SLL', 'cent', 'Le', 'Republic of Sierra Leone', 'SL', 'SLE', 'Sierra Leone', '002', '011', '0', '232', 'SL.png');
INSERT INTO `test_countries` VALUES ('702', 'Singapore', 'Singaporean', '702', 'Singapore dollar', 'SGD', 'cent', '$', 'Republic of Singapore', 'SG', 'SGP', 'Singapore', '142', '035', '0', '65', 'SG.png');
INSERT INTO `test_countries` VALUES ('703', 'Bratislava', 'Slovak', '703', 'euro', 'EUR', 'cent', 'Sk', 'Slovak Republic', 'SK', 'SVK', 'Slovakia', '150', '151', '1', '421', 'SK.png');
INSERT INTO `test_countries` VALUES ('704', 'Hanoi', 'Vietnamese', '704', 'dong', 'VND', '(10 hào', '₫', 'Socialist Republic of Vietnam', 'VN', 'VNM', 'Viet Nam', '142', '035', '0', '84', 'VN.png');
INSERT INTO `test_countries` VALUES ('705', 'Ljubljana', 'Slovene', '705', 'euro', 'EUR', 'cent', '€', 'Republic of Slovenia', 'SI', 'SVN', 'Slovenia', '150', '039', '1', '386', 'SI.png');
INSERT INTO `test_countries` VALUES ('706', 'Mogadishu', 'Somali', '706', 'Somali shilling', 'SOS', 'cent', 'S', 'Somali Republic', 'SO', 'SOM', 'Somalia', '002', '014', '0', '252', 'SO.png');
INSERT INTO `test_countries` VALUES ('710', 'Pretoria (ZA1)', 'South African', '710', 'rand', 'ZAR', 'cent', 'R', 'Republic of South Africa', 'ZA', 'ZAF', 'South Africa', '002', '018', '0', '27', 'ZA.png');
INSERT INTO `test_countries` VALUES ('716', 'Harare', 'Zimbabwean', '716', 'Zimbabwe dollar (ZW1)', 'ZWL', 'cent', 'Z$', 'Republic of Zimbabwe', 'ZW', 'ZWE', 'Zimbabwe', '002', '014', '0', '263', 'ZW.png');
INSERT INTO `test_countries` VALUES ('724', 'Madrid', 'Spaniard', '724', 'euro', 'EUR', 'cent', '€', 'Kingdom of Spain', 'ES', 'ESP', 'Spain', '150', '039', '1', '34', 'ES.png');
INSERT INTO `test_countries` VALUES ('728', 'Juba', 'South Sudanese', '728', 'South Sudanese pound', 'SSP', 'piaster', null, 'Republic of South Sudan', 'SS', 'SSD', 'South Sudan', '002', '015', '0', '211', null);
INSERT INTO `test_countries` VALUES ('729', 'Khartoum', 'Sudanese', '729', 'Sudanese pound', 'SDG', 'piastre', null, 'Republic of the Sudan', 'SD', 'SDN', 'Sudan', '002', '015', '0', '249', null);
INSERT INTO `test_countries` VALUES ('732', 'Al aaiun', 'Sahrawi', '732', 'Moroccan dirham', 'MAD', 'centime', 'MAD', 'Western Sahara', 'EH', 'ESH', 'Western Sahara', '002', '015', '0', '212', 'EH.png');
INSERT INTO `test_countries` VALUES ('740', 'Paramaribo', 'Surinamese', '740', 'Surinamese dollar', 'SRD', 'cent', '$', 'Republic of Suriname', 'SR', 'SUR', 'Suriname', '019', '005', '0', '597', 'SR.png');
INSERT INTO `test_countries` VALUES ('744', 'Longyearbyen', 'of Svalbard', '744', 'Norwegian krone (pl. kroner)', 'NOK', 'øre (inv.)', 'kr', 'Svalbard and Jan Mayen', 'SJ', 'SJM', 'Svalbard and Jan Mayen', '150', '154', '0', '47', 'SJ.png');
INSERT INTO `test_countries` VALUES ('748', 'Mbabane', 'Swazi', '748', 'lilangeni', 'SZL', 'cent', 'SZL', 'Kingdom of Swaziland', 'SZ', 'SWZ', 'Swaziland', '002', '018', '0', '268', 'SZ.png');
INSERT INTO `test_countries` VALUES ('752', 'Stockholm', 'Swedish', '752', 'krona (pl. kronor)', 'SEK', 'öre (inv.)', 'kr', 'Kingdom of Sweden', 'SE', 'SWE', 'Sweden', '150', '154', '1', '46', 'SE.png');
INSERT INTO `test_countries` VALUES ('756', 'Berne', 'Swiss', '756', 'Swiss franc', 'CHF', 'centime', 'CHF', 'Swiss Confederation', 'CH', 'CHE', 'Switzerland', '150', '155', '1', '41', 'CH.png');
INSERT INTO `test_countries` VALUES ('760', 'Damascus', 'Syrian', '760', 'Syrian pound', 'SYP', 'piastre', '£', 'Syrian Arab Republic', 'SY', 'SYR', 'Syrian Arab Republic', '142', '145', '0', '963', 'SY.png');
INSERT INTO `test_countries` VALUES ('762', 'Dushanbe', 'Tajik', '762', 'somoni', 'TJS', 'diram', 'TJS', 'Republic of Tajikistan', 'TJ', 'TJK', 'Tajikistan', '142', '143', '0', '992', 'TJ.png');
INSERT INTO `test_countries` VALUES ('764', 'Bangkok', 'Thai', '764', 'baht (inv.)', 'THB', 'satang (inv.)', '฿', 'Kingdom of Thailand', 'TH', 'THA', 'Thailand', '142', '035', '0', '66', 'TH.png');
INSERT INTO `test_countries` VALUES ('768', 'Lomé', 'Togolese', '768', 'CFA franc (BCEAO)', 'XOF', 'centime', 'XOF', 'Togolese Republic', 'TG', 'TGO', 'Togo', '002', '011', '0', '228', 'TG.png');
INSERT INTO `test_countries` VALUES ('772', '(TK2)', 'Tokelauan', '772', 'New Zealand dollar', 'NZD', 'cent', '$', 'Tokelau', 'TK', 'TKL', 'Tokelau', '009', '061', '0', '690', 'TK.png');
INSERT INTO `test_countries` VALUES ('776', 'Nuku’alofa', 'Tongan', '776', 'pa’anga (inv.)', 'TOP', 'seniti (inv.)', 'T$', 'Kingdom of Tonga', 'TO', 'TON', 'Tonga', '009', '061', '0', '676', 'TO.png');
INSERT INTO `test_countries` VALUES ('780', 'Port of Spain', 'Trinidadian; Tobagonian', '780', 'Trinidad and Tobago dollar', 'TTD', 'cent', 'TT$', 'Republic of Trinidad and Tobago', 'TT', 'TTO', 'Trinidad and Tobago', '019', '029', '0', '1', 'TT.png');
INSERT INTO `test_countries` VALUES ('784', 'Abu Dhabi', 'Emirian', '784', 'UAE dirham', 'AED', 'fils (inv.)', 'AED', 'United Arab Emirates', 'AE', 'ARE', 'United Arab Emirates', '142', '145', '0', '971', 'AE.png');
INSERT INTO `test_countries` VALUES ('788', 'Tunis', 'Tunisian', '788', 'Tunisian dinar', 'TND', 'millime', 'TND', 'Republic of Tunisia', 'TN', 'TUN', 'Tunisia', '002', '015', '0', '216', 'TN.png');
INSERT INTO `test_countries` VALUES ('792', 'Ankara', 'Turk', '792', 'Turkish lira (inv.)', 'TRY', 'kurus (inv.)', '₺', 'Republic of Turkey', 'TR', 'TUR', 'Turkey', '142', '145', '0', '90', 'TR.png');
INSERT INTO `test_countries` VALUES ('795', 'Ashgabat', 'Turkmen', '795', 'Turkmen manat (inv.)', 'TMT', 'tenge (inv.)', 'm', 'Turkmenistan', 'TM', 'TKM', 'Turkmenistan', '142', '143', '0', '993', 'TM.png');
INSERT INTO `test_countries` VALUES ('796', 'Cockburn Town', 'Turks and Caicos Islander', '796', 'US dollar', 'USD', 'cent', '$', 'Turks and Caicos Islands', 'TC', 'TCA', 'Turks and Caicos Islands', '019', '029', '0', '1', 'TC.png');
INSERT INTO `test_countries` VALUES ('798', 'Funafuti', 'Tuvaluan', '798', 'Australian dollar', 'AUD', 'cent', '$', 'Tuvalu', 'TV', 'TUV', 'Tuvalu', '009', '061', '0', '688', 'TV.png');
INSERT INTO `test_countries` VALUES ('800', 'Kampala', 'Ugandan', '800', 'Uganda shilling', 'UGX', 'cent', 'UGX', 'Republic of Uganda', 'UG', 'UGA', 'Uganda', '002', '014', '0', '256', 'UG.png');
INSERT INTO `test_countries` VALUES ('804', 'Kiev', 'Ukrainian', '804', 'hryvnia', 'UAH', 'kopiyka', '₴', 'Ukraine', 'UA', 'UKR', 'Ukraine', '150', '151', '0', '380', 'UA.png');
INSERT INTO `test_countries` VALUES ('807', 'Skopje', 'of the former Yugoslav Republic of Macedonia', '807', 'denar (pl. denars)', 'MKD', 'deni (inv.)', 'ден', 'the former Yugoslav Republic of Macedonia', 'MK', 'MKD', 'Macedonia, the former Yugoslav Republic of', '150', '039', '0', '389', 'MK.png');
INSERT INTO `test_countries` VALUES ('818', 'Cairo', 'Egyptian', '818', 'Egyptian pound', 'EGP', 'piastre', '£', 'Arab Republic of Egypt', 'EG', 'EGY', 'Egypt', '002', '015', '0', '20', 'EG.png');
INSERT INTO `test_countries` VALUES ('826', 'London', 'British', '826', 'pound sterling', 'GBP', 'penny (pl. pence)', '£', 'United Kingdom of Great Britain and Northern Ireland', 'GB', 'GBR', 'United Kingdom', '150', '154', '1', '44', 'GB.png');
INSERT INTO `test_countries` VALUES ('831', 'St Peter Port', 'of Guernsey', '831', 'Guernsey pound (GG2)', 'GGP (GG2)', 'penny (pl. pence)', null, 'Bailiwick of Guernsey', 'GG', 'GGY', 'Guernsey', '150', '154', '0', '44', null);
INSERT INTO `test_countries` VALUES ('832', 'St Helier', 'of Jersey', '832', 'Jersey pound (JE2)', 'JEP (JE2)', 'penny (pl. pence)', null, 'Bailiwick of Jersey', 'JE', 'JEY', 'Jersey', '150', '154', '0', '44', null);
INSERT INTO `test_countries` VALUES ('833', 'Douglas', 'Manxman; Manxwoman', '833', 'Manx pound (IM2)', 'IMP (IM2)', 'penny (pl. pence)', null, 'Isle of Man', 'IM', 'IMN', 'Isle of Man', '150', '154', '0', '44', null);
INSERT INTO `test_countries` VALUES ('834', 'Dodoma (TZ1)', 'Tanzanian', '834', 'Tanzanian shilling', 'TZS', 'cent', 'TZS', 'United Republic of Tanzania', 'TZ', 'TZA', 'Tanzania, United Republic of', '002', '014', '0', '255', 'TZ.png');
INSERT INTO `test_countries` VALUES ('840', 'Washington DC', 'American', '840', 'US dollar', 'USD', 'cent', '$', 'United States of America', 'US', 'USA', 'United States', '019', '021', '0', '1', 'US.png');
INSERT INTO `test_countries` VALUES ('850', 'Charlotte Amalie', 'US Virgin Islander', '850', 'US dollar', 'USD', 'cent', '$', 'United States Virgin Islands', 'VI', 'VIR', 'Virgin Islands, U.S.', '019', '029', '0', '1', 'VI.png');
INSERT INTO `test_countries` VALUES ('854', 'Ouagadougou', 'Burkinabe', '854', 'CFA franc (BCEAO)', 'XOF', 'centime', 'XOF', 'Burkina Faso', 'BF', 'BFA', 'Burkina Faso', '002', '011', '0', '226', 'BF.png');
INSERT INTO `test_countries` VALUES ('858', 'Montevideo', 'Uruguayan', '858', 'Uruguayan peso', 'UYU', 'centésimo', '$U', 'Eastern Republic of Uruguay', 'UY', 'URY', 'Uruguay', '019', '005', '0', '598', 'UY.png');
INSERT INTO `test_countries` VALUES ('860', 'Tashkent', 'Uzbek', '860', 'sum (inv.)', 'UZS', 'tiyin (inv.)', 'лв', 'Republic of Uzbekistan', 'UZ', 'UZB', 'Uzbekistan', '142', '143', '0', '998', 'UZ.png');
INSERT INTO `test_countries` VALUES ('862', 'Caracas', 'Venezuelan', '862', 'bolívar fuerte (pl. bolívares fuertes)', 'VEF', 'céntimo', 'Bs', 'Bolivarian Republic of Venezuela', 'VE', 'VEN', 'Venezuela, Bolivarian Republic of', '019', '005', '0', '58', 'VE.png');
INSERT INTO `test_countries` VALUES ('876', 'Mata-Utu', 'Wallisian; Futunan; Wallis and Futuna Islander', '876', 'CFP franc', 'XPF', 'centime', 'XPF', 'Wallis and Futuna', 'WF', 'WLF', 'Wallis and Futuna', '009', '061', '0', '681', 'WF.png');
INSERT INTO `test_countries` VALUES ('882', 'Apia', 'Samoan', '882', 'tala (inv.)', 'WST', 'sene (inv.)', 'WS$', 'Independent State of Samoa', 'WS', 'WSM', 'Samoa', '009', '061', '0', '685', 'WS.png');
INSERT INTO `test_countries` VALUES ('887', 'San’a', 'Yemenite', '887', 'Yemeni rial', 'YER', 'fils (inv.)', '﷼', 'Republic of Yemen', 'YE', 'YEM', 'Yemen', '142', '145', '0', '967', 'YE.png');
INSERT INTO `test_countries` VALUES ('894', 'Lusaka', 'Zambian', '894', 'Zambian kwacha (inv.)', 'ZMW', 'ngwee (inv.)', 'ZK', 'Republic of Zambia', 'ZM', 'ZMB', 'Zambia', '002', '014', '0', '260', 'ZM.png');

-- ----------------------------
-- Table structure for test_federation
-- ----------------------------
DROP TABLE IF EXISTS `test_federation`;
CREATE TABLE `test_federation` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `president_id` int(10) unsigned DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country_id` int(10) unsigned NOT NULL,
  `website` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `federation_name_unique` (`name`),
  KEY `federation_president_id_foreign` (`president_id`),
  KEY `federation_country_id_foreign` (`country_id`),
  CONSTRAINT `federation_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `test_countries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `federation_president_id_foreign` FOREIGN KEY (`president_id`) REFERENCES `test_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of test_federation
-- ----------------------------
INSERT INTO `test_federation` VALUES ('1', '-', '1', null, null, '0', null, '2016-05-18 22:29:59', '2016-05-18 22:29:59');
INSERT INTO `test_federation` VALUES ('2', 'The British Kendo Association', '1', '113 Vibart Road, Yardley, Birmingham, B26 2AB, UK', '32-2-672-8342', '826', 'www.kendo.org.uk', '2016-05-18 22:30:00', '2016-05-18 22:30:00');
INSERT INTO `test_federation` VALUES ('3', 'Comite National de Kendo/FFJDA', '1', '21-25 avenue de la Porte de Chatillon 75014 Paris Cedex 14, France', '33-140-52-1681', '250', ' www.cnkendo-dr.com', '2016-05-18 22:30:00', '2016-05-18 22:30:00');
INSERT INTO `test_federation` VALUES ('4', 'Kendo Section, Swedish Budo & Martial Arts Federation', '1', 'C/O Mr. Iask Rubensson, Torsvagen 13, 19267 SOLLENTUNA, Sweden, B26 2AB, UK', '46-70-786-1622', '752', 'www.kendoforbundet.se', '2016-05-18 22:30:00', '2016-05-18 22:30:00');
INSERT INTO `test_federation` VALUES ('5', 'All Belgium Kendo Federation', '1', 'c/o Mr. Daniel Delepiere, Bosbessenlaan 6, B-3090, Overijse, Belgium', '32-476-960-072', '56', 'www.abkfevents.be', '2016-05-18 22:30:00', '2016-05-18 22:30:00');
INSERT INTO `test_federation` VALUES ('6', 'Nederlandse Kendo Renmei', '1', 'C/O Mr.K.Hattum, Hoofdstraat 187, 3114 GD Schiedam, Netherlands', '31-1044191631', '528', ' www.nkr.nl', '2016-05-18 22:30:00', '2016-05-18 22:30:00');
INSERT INTO `test_federation` VALUES ('7', 'Swiss Kendo and Iaido, SJV/FSJ', '1', 'Swiss Kendo & Iaido, CH-1004, Lausanne, Switzerland', '41-21-6489102', '756', 'www.kendo.ch', '2016-05-18 22:30:00', '2016-05-18 22:30:00');
INSERT INTO `test_federation` VALUES ('8', 'Deutscher Kendobund e. V. (DKenB)', '1', 'C/O Mr. Detlef Viebranz, Im Buchholzfelde 3 30966 Hemmingen, Germany', '49-511-2330963', '276', 'www.dkenb.de', '2016-05-18 22:30:00', '2016-05-18 22:30:00');
INSERT INTO `test_federation` VALUES ('9', 'Royal Spanish Judo Federation and Associated Sports', '1', 'C/ Ferraz, 16-7 Izq, 28008, Madrid, Spain', '34-91-559-4958', '724', 'www.rfejudo.com  ', '2016-05-18 22:30:00', '2016-05-18 22:30:00');
INSERT INTO `test_federation` VALUES ('10', 'Austrian Kendo Association', '1', 'c/o Mr. Harald Hofer Markfeldgasse 4/5・A-2380, Perchtoldsdorf, Austria', '43-1-86-55-022', '40', 'http://www.kendo-austria.at ', '2016-05-18 22:30:00', '2016-05-18 22:30:00');
INSERT INTO `test_federation` VALUES ('11', 'Norwegian Kendo Committee  -Norweigan Martial Arts Federation', '1', 'C/O Mr. Joakim Kosmo Tiriltunga 54, 1259, Oslo, Norway', '47-480-49369', '578', '', '2016-05-18 22:30:00', '2016-05-18 22:30:00');
INSERT INTO `test_federation` VALUES ('12', 'Danish Kendo Federation', '1', 'C/O David A. Mwaipaya  Carl Blochs Vej 99 5230 Odense M Denmark', '45-22-45-60-81', '208', 'www.kendo-dkf.dk ', '2016-05-18 22:30:00', '2016-05-18 22:30:00');
INSERT INTO `test_federation` VALUES ('13', 'Finnish Kendo Association', '1', 'c/o Mr. Mika Kankainen, Puikkaritie 4 B 1  90520 Oulu, Finland', '358--40-3010-331', '246', 'Finnish Kendo Association', '2016-05-18 22:30:00', '2016-05-18 22:30:00');
INSERT INTO `test_federation` VALUES ('14', 'Confederazione Italiana Kendo', '1', 'C.P.38 Angera (Va), Italy', '39-02-700591227', '380', 'www.kendo-cik.it', '2016-05-18 22:30:00', '2016-05-18 22:30:00');
INSERT INTO `test_federation` VALUES ('15', 'Hungarian Kendo, Iaido & Jodo Federation', '1', 'H-1073 Budapest,Dob u. 80. I. 12, Hungary', '36-1-342-0034', '348', 'www.kendo.hu', '2016-05-18 22:30:00', '2016-05-18 22:30:00');
INSERT INTO `test_federation` VALUES ('16', 'Polish Kendo Federation', '1', ' (Head Office) PL-91-463 Lodz, Zgierska 73, pok. 410, Poland', '48-42-2536-153', '616', ' www.kendo.pl', '2016-05-18 22:30:00', '2016-05-18 22:30:00');
INSERT INTO `test_federation` VALUES ('17', 'Serbian Kendo Federation', '1', 'c/o Mr. Milos Pavlovic, Serbian Kendo Federation, Makedonska 28/2, 11000, Beograd, Serbia', '381-11-3035044', '688', 'www.kendo.rs', '2016-05-18 22:30:00', '2016-05-18 22:30:00');
INSERT INTO `test_federation` VALUES ('18', 'Czech Kendo Federation', '1', 'c/o Mr. Tomas Jelen, Dvoristska 1244 19800 Praha 9, Czech Republic', '420-737444231', '203', 'www.czech-kendo.cz', '2016-05-18 22:30:00', '2016-05-18 22:30:00');
INSERT INTO `test_federation` VALUES ('19', 'The Romanian Kendo Department, Federation of Contact Martial Arts', '1', 'Baba Novac Street, no. 3, bl. S2, sc. 2, ap. 57, District 3, 031633, Bucharest, Romania', '40-743-224-131', '642', 'www.kendo-romania.ro', '2016-05-18 22:30:00', '2016-05-18 22:30:00');
INSERT INTO `test_federation` VALUES ('20', 'Shobukai Kendo Luxembourg', '1', 'FLAM C/O Mr. Dias de Carvalho Romaniga (KENDO)  52, route dePetange L-4645 Niederkorn, Luxembourg', '352-691-632-169', '442', 'www.shobukai.lu', '2016-05-18 22:30:00', '2016-05-18 22:30:00');
INSERT INTO `test_federation` VALUES ('21', 'Russian Kendo Federation', '1', 'Proezd Kadomtseva, d. 17, kv.16, RU-129128, Moscow, Russia', '7-916-118-7949', '643', 'www.kendo-russia.ru', '2016-05-18 22:30:00', '2016-05-18 22:30:00');
INSERT INTO `test_federation` VALUES ('22', 'Associacao Portuguesa de Kendo', '1', 'Alameda dos Oceanos, Lote 3.13.03c-4A, 1990-207 Lisboa-Poltugal', '351-919851862', '620', 'www.kendo.pt', '2016-05-18 22:30:00', '2016-05-18 22:30:00');
INSERT INTO `test_federation` VALUES ('23', 'Kendo na h-Eireann', '1', 'C/O Kathryn CASSIDY,  27 The Wheat Barn Baker\'s Yard North Portland Street, Dublin 1, Ireland', '353-85-1432065', '372', 'www.irishkendofederation.org', '2016-05-18 22:30:00', '2016-05-18 22:30:00');
INSERT INTO `test_federation` VALUES ('24', 'Federacio Andorrana de Kendo', '1', 'Centre Esportiu Serradells, Carretera de la Comella s/n, AD500 Andorra la Vella, Principat d\'Andorra', '376-362979', '20', 'www.kendo-andorra.org', '2016-05-18 22:30:00', '2016-05-18 22:30:00');
INSERT INTO `test_federation` VALUES ('25', 'Bulgarian Kendo Federation', '1', 'JK Hadji Dimitar Zlatitsa St., bl. 138, ent. 3, floor 3, apt. 48, Sofia 1510, Bulgaria', '359-29457180', '100', 'www.kendo.bg', '2016-05-18 22:30:00', '2016-05-18 22:30:00');
INSERT INTO `test_federation` VALUES ('26', 'Hellenic Kendo Iaido Naginata Federation', '1', 'C/O Mr. I Papadimitriou, Ierolochiton 63, GR-38334, Volos, P,C, Greece', '30-242-1063079 / 30-242-1034880', '300', '', '2016-05-18 22:30:00', '2016-05-18 22:30:00');
INSERT INTO `test_federation` VALUES ('27', 'Israel Kendo & Budo Federation', '1', 'P.O.Box 171 Ein Sarid Israel', '972-54-4443312', '376', '', '2016-05-18 22:30:00', '2016-05-18 22:30:00');
INSERT INTO `test_federation` VALUES ('28', 'Montenagrian Kendo Federation', '1', 'C/O Mr. Djuro Stojanovic, Boska Buhe 39, 81000 Podgorica, Montenegro', '382-6901-0346', '499', '', '2016-05-18 22:30:00', '2016-05-18 22:30:00');
INSERT INTO `test_federation` VALUES ('29', 'Latvian Kendo Federation', '1', 'Malnavas Street 18-34, LV 1057, Riga Latvia', '371-29217637', '428', '', '2016-05-18 22:30:00', '2016-05-18 22:30:00');
INSERT INTO `test_federation` VALUES ('30', 'Lithuanian Kendo Association', '1', 'Poloko g. 11-10, 01204 Vilnius, Lithuania', '370-650-19680', '440', 'www.kendo-lka.lt', '2016-05-18 22:30:00', '2016-05-18 22:30:00');
INSERT INTO `test_federation` VALUES ('31', 'Croatian Kendo Assosiation', '1', 'Sestinski dol 8 b, 10000 Zagreb, Croatia', '385-1-33 67 219', '191', 'http://www.kendo.hr', '2016-05-18 22:30:00', '2016-05-18 22:30:00');
INSERT INTO `test_federation` VALUES ('32', 'Kendo zveza Slovenije/Kendo Federation of Slovenia', '1', 'Topolsica 27, SI-3326 Topolsica Slovenia', '386-40-629-622', '705', 'http://www.kendo-zveza.si', '2016-05-18 22:30:00', '2016-05-18 22:30:00');
INSERT INTO `test_federation` VALUES ('33', 'Turkish Kendo Association', '1', 'Uzuncair Sok. Detay Apt. No:14 D:6, Uskudar-Acibadem Istanbul-Turkey 34660', '90-5322139862', '792', '', '2016-05-18 22:30:00', '2016-05-18 22:30:00');
INSERT INTO `test_federation` VALUES ('34', 'All United States Kendo Federation', '1', 'C/O Mr. Yoshiteru TAGAWA, AUSKF president, 41444 Fawn Trail, Novi, Michigan, 48375-4813 USA', '1-248-349-5377', '840', 'www.AUSKF.INFO', '2016-05-18 22:30:00', '2016-05-18 22:30:00');
INSERT INTO `test_federation` VALUES ('35', 'Hawaii Kendo Federation', '1', 'c/o Ms. Kathleen Nekomoto 775 Kinalau place #2006 Honolulu, Hawaii 96813', '1-808-551-9892', '840', 'www.hawaiikendo.com', '2016-05-18 22:30:00', '2016-05-18 22:30:00');
INSERT INTO `test_federation` VALUES ('36', 'Canadian Kendo Federation', '1', '65,Saint-Paul Street west, Apt 610 Montreal, QC, Canada H2Y 3S5', '1-514-844-469', '124', 'http://kendo-canada.com/', '2016-05-18 22:30:00', '2016-05-18 22:30:00');
INSERT INTO `test_federation` VALUES ('37', 'Mexican Kendo Federation', '8', 'C/O Mr. Ing. Jesus Maya Martinez, President, Mexican Kendo Federation Av. Rio Churrubusco puerta 9 , entre Anily Viaducto Rio de la Piedad, col. Magdalena Mixihuca, Iztacalco, 08010, Mexico D.F, Mexico', '52-4455-4339-0414', '484', 'www.kendo.mx', '2016-05-18 22:30:00', '2016-05-18 22:30:00');
INSERT INTO `test_federation` VALUES ('38', 'Brazilian Kendo Confederation', '1', 'c/o Mr. C.Kogima, Rua Monsenhor Basillo Pereira, 271 Parque Jabaquara- Sao Paulo- Brazil, 04343-090', '55-11-9-5584-6291', '76', 'www.cbkendo.esp.br', '2016-05-18 22:30:00', '2016-05-18 22:30:00');
INSERT INTO `test_federation` VALUES ('39', 'Federacion Argentina de Kendo', '1', 'Mr. Francisco SCARAMELLINI, Quintana 1740 CP 3400 Corrientes Argentina', '54-379-4427362', '32', 'www.kendoargentina.org', '2016-05-18 22:30:00', '2016-05-18 22:30:00');
INSERT INTO `test_federation` VALUES ('40', 'Federacion Venezolana de Kendo', '1', 'Mr. Ariel Pintos, Calle Cuyuni, Quinta Maral, Colinas de Bello Monte, Caracas 1051, Venezuela, Sur America', '58-212-7533226', '862', 'www.fvkendo.com', '2016-05-18 22:30:00', '2016-05-18 22:30:00');
INSERT INTO `test_federation` VALUES ('41', 'Kendo Aruba/Bun Bu Itchi ', '1', 'c/o Mr. S. A. Velasquez, Mazurka 13, Cunucu Abao, Aruba (Dutch Caribbean)', '297-5-873974', '533', 'www.kendoaruba.com', '2016-05-18 22:30:00', '2016-05-18 22:30:00');
INSERT INTO `test_federation` VALUES ('42', 'Chilean Kendo Federation', '1', 'Avenida Providencia 2528, local 210. Providencia, Santiago, Chile, 7510007', '56-09-8755-3369', '152', 'www.kendo.cl', '2016-05-18 22:30:00', '2016-05-18 22:30:00');
INSERT INTO `test_federation` VALUES ('43', 'Federation Dominicana de Kendo', '1', 'Calle Caonabo 66 Edificio Raycarlos 102 Gazcue, Santo Domingo, Dominican Republic', '809-224-0457', '214', 'www.cbnintl.com', '2016-05-18 22:30:00', '2016-05-18 22:30:00');
INSERT INTO `test_federation` VALUES ('44', 'Asociacion Ecuatoriana de Kendo', '1', 'P.O.Box 17-07-9024, Quito,Ecuador', '593-2-2431-285', '218', 'http://kendoecuador.org', '2016-05-18 22:30:00', '2016-05-18 22:30:00');
INSERT INTO `test_federation` VALUES ('45', 'South African Kendo Federation', '1', 'P.O. BOX 785577, Sandton, Johanesburg, South Africa, 2146', '27-82-389-9098', '710', 'www.sakf.co.za', '2016-05-18 22:30:00', '2016-05-18 22:30:00');
INSERT INTO `test_federation` VALUES ('46', 'Australian Kendo Renmei Incorporated', '1', ' PO Box 353, North Carlton, VIC 3054, Australia', '-', '36', 'www.kendoaustralia.asn.au', '2016-05-18 22:30:00', '2016-05-18 22:30:00');
INSERT INTO `test_federation` VALUES ('47', 'New Zealand Kendo Federation', '1', '82a Bay Rd., St. Heliers, Aukland, New Zealand', '64-21-274-2415', '554', 'www.kendo.org.nz', '2016-05-18 22:30:00', '2016-05-18 22:30:00');

-- ----------------------------
-- Table structure for test_grade
-- ----------------------------
DROP TABLE IF EXISTS `test_grade`;
CREATE TABLE `test_grade` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `order` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `grade_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of test_grade
-- ----------------------------
INSERT INTO `test_grade` VALUES ('1', 'core.without_grade', '0', '2016-05-18 22:29:57', '2016-05-18 22:29:57');
INSERT INTO `test_grade` VALUES ('2', '7 Kyu', '1', '2016-05-18 22:29:57', '2016-05-18 22:29:57');
INSERT INTO `test_grade` VALUES ('3', '6 Kyu', '2', '2016-05-18 22:29:57', '2016-05-18 22:29:57');
INSERT INTO `test_grade` VALUES ('4', '5 Kyu', '3', '2016-05-18 22:29:57', '2016-05-18 22:29:57');
INSERT INTO `test_grade` VALUES ('5', '4 Kyu', '4', '2016-05-18 22:29:57', '2016-05-18 22:29:57');
INSERT INTO `test_grade` VALUES ('6', '3 Kyu', '5', '2016-05-18 22:29:57', '2016-05-18 22:29:57');
INSERT INTO `test_grade` VALUES ('7', '2 Kyu', '6', '2016-05-18 22:29:57', '2016-05-18 22:29:57');
INSERT INTO `test_grade` VALUES ('8', '1 Kyu', '7', '2016-05-18 22:29:57', '2016-05-18 22:29:57');
INSERT INTO `test_grade` VALUES ('9', '1 Dan', '8', '2016-05-18 22:29:57', '2016-05-18 22:29:57');
INSERT INTO `test_grade` VALUES ('10', '2 Dan', '9', '2016-05-18 22:29:57', '2016-05-18 22:29:57');
INSERT INTO `test_grade` VALUES ('11', '3 Dan', '10', '2016-05-18 22:29:57', '2016-05-18 22:29:57');
INSERT INTO `test_grade` VALUES ('12', '4 Dan', '11', '2016-05-18 22:29:57', '2016-05-18 22:29:57');
INSERT INTO `test_grade` VALUES ('13', '5 Dan', '12', '2016-05-18 22:29:57', '2016-05-18 22:29:57');
INSERT INTO `test_grade` VALUES ('14', '6 Dan', '13', '2016-05-18 22:29:57', '2016-05-18 22:29:57');
INSERT INTO `test_grade` VALUES ('15', '7 Dan', '14', '2016-05-18 22:29:57', '2016-05-18 22:29:57');
INSERT INTO `test_grade` VALUES ('16', '8 Dan', '15', '2016-05-18 22:29:57', '2016-05-18 22:29:57');

-- ----------------------------
-- Table structure for test_invitation
-- ----------------------------
DROP TABLE IF EXISTS `test_invitation`;
CREATE TABLE `test_invitation` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` text COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `object_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `object_id` int(10) unsigned NOT NULL,
  `expiration` date NOT NULL,
  `active` tinyint(1) NOT NULL,
  `used` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of test_invitation
-- ----------------------------

-- ----------------------------
-- Table structure for test_logs
-- ----------------------------
DROP TABLE IF EXISTS `test_logs`;
CREATE TABLE `test_logs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `owner_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `owner_id` int(11) NOT NULL,
  `old_value` text COLLATE utf8_unicode_ci,
  `new_value` text COLLATE utf8_unicode_ci,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of test_logs
-- ----------------------------
INSERT INTO `test_logs` VALUES ('1', null, 'App\\User', '1', 'null', '{\"name\":\"No User\",\"email\":\"nouser@nouser.com\"}', 'created', '2016-05-18 22:29:58', '2016-05-18 22:29:58');
INSERT INTO `test_logs` VALUES ('2', null, 'App\\User', '2', 'null', '{\"name\":\"Juliatzin Del torro\",\"email\":\"flordcactus@gmail.com\",\"password\":\"$2y$10$1PtkhrFJK953dQYFb5pKMugryyRprg8r9hLHMDNJwXB8oKZWvjfau\",\"grade_id\":7,\"country_id\":\"484\",\"city\":\"Mexico City\",\"latitude\":\"19.4342\",\"longitude\":\"-99.1386\",\"role_id\":\"1\",\"avatar\":\"https:\\/\\/lh3.googleusercontent.com\\/-1IZ2nbY2o40\\/AAAAAAAAAAI\\/AAAAAAAAHEY\\/KrhjLc7m66g\\/photo.jpg?sz=50\",\"token\":\"JgczvNP4eEn2LCHPj2MGg4obZooeIj\",\"verified\":\"1\",\"provider\":\"google\",\"provider_id\":\"113769489654625617770\",\"remember_token\":\"7rCCxMRjsqSgHCt1mbOSkz5TV0iKe9YYVNMrOwX2g5pLUsF3qBqVQ1zlYOuv\"}', 'created', '2016-05-18 22:29:58', '2016-05-18 22:29:58');
INSERT INTO `test_logs` VALUES ('3', null, 'App\\User', '3', 'null', '{\"name\":\"root\",\"firstname\":\"Virginie\",\"lastname\":\"Hammes\",\"email\":\"superuser@kendozone.com\",\"password\":\"$2y$10$Rx7rnY8IzKHvJZMSeTTFK.p.xf\\/zmEsV\\/6UYFPehBjtoTEvLSRdpC\",\"grade_id\":1,\"country_id\":246,\"city\":\"West Rozellaburgh\",\"latitude\":63.086821,\"longitude\":-104.73848,\"role_id\":\"1\",\"verified\":1,\"remember_token\":\"URmu98kt7y\",\"provider\":\"\",\"provider_id\":\"dM8AW\",\"locale\":\"es\"}', 'created', '2016-05-18 22:29:58', '2016-05-18 22:29:58');
INSERT INTO `test_logs` VALUES ('4', null, 'App\\User', '4', 'null', '{\"name\":\"federation\",\"firstname\":\"Mayra\",\"lastname\":\"Feest\",\"email\":\"federation@kendozone.com\",\"password\":\"$2y$10$1Azfw8GAuB7QQlxJ6zO69.z6gBJfbp9SSn4q5xvYnEgop6IMxeTQC\",\"grade_id\":2,\"country_id\":608,\"city\":\"Maribelstad\",\"latitude\":-35.736662,\"longitude\":-26.151264,\"role_id\":\"2\",\"verified\":1,\"remember_token\":\"aD8CYQo96N\",\"provider\":\"\",\"provider_id\":\"mL2P0\",\"locale\":\"en\"}', 'created', '2016-05-18 22:29:58', '2016-05-18 22:29:58');
INSERT INTO `test_logs` VALUES ('5', null, 'App\\User', '5', 'null', '{\"name\":\"association\",\"firstname\":\"Bridget\",\"lastname\":\"Hirthe\",\"email\":\"association@kendozone.com\",\"password\":\"$2y$10$NdI7rsLHrvUFeHhS8Yf6a.8LuMMAC4JJZw3NG6sKBGK5c3RP69ffm\",\"grade_id\":1,\"country_id\":328,\"city\":\"Ullrichberg\",\"latitude\":38.593578,\"longitude\":29.833143,\"role_id\":\"3\",\"verified\":1,\"remember_token\":\"hVlAhDlYjO\",\"provider\":\"\",\"provider_id\":\"18vZ9\",\"locale\":\"en\"}', 'created', '2016-05-18 22:29:58', '2016-05-18 22:29:58');
INSERT INTO `test_logs` VALUES ('6', null, 'App\\User', '6', 'null', '{\"name\":\"club\",\"firstname\":\"Nils\",\"lastname\":\"Tromp\",\"email\":\"club@kendozone.com\",\"password\":\"$2y$10$YD7jDB8H\\/f7sg2DTfXDPUe0lzqZyKlRTvxB6u\\/5bBIh9VVGlUExBi\",\"grade_id\":3,\"country_id\":410,\"city\":\"Eloiseview\",\"latitude\":70.448226,\"longitude\":98.949235,\"role_id\":\"4\",\"verified\":1,\"remember_token\":\"8RTQYOWbiR\",\"provider\":\"\",\"provider_id\":\"luy7M\",\"locale\":\"es\"}', 'created', '2016-05-18 22:29:58', '2016-05-18 22:29:58');
INSERT INTO `test_logs` VALUES ('7', null, 'App\\User', '7', 'null', '{\"name\":\"user\",\"firstname\":\"Cleta\",\"lastname\":\"Grant\",\"email\":\"user@kendozone.com\",\"password\":\"$2y$10$Sl6sfaDH7AgZH00rbEbAY.BVbnO.04UuVfiOs22g0QYpui1tCgekC\",\"grade_id\":5,\"country_id\":428,\"city\":\"East Giovanimouth\",\"latitude\":5.592078,\"longitude\":153.707274,\"role_id\":\"5\",\"verified\":1,\"remember_token\":\"UANgaL5ovH\",\"provider\":\"\",\"provider_id\":\"CvjEj\",\"locale\":\"es\"}', 'created', '2016-05-18 22:29:59', '2016-05-18 22:29:59');
INSERT INTO `test_logs` VALUES ('8', null, 'App\\Category', '1', 'null', '{\"name\":\"categories.man_first_force\",\"gender\":\"M\",\"isTeam\":0,\"ageCategory\":0,\"gradeCategory\":1}', 'created', '2016-05-18 22:29:59', '2016-05-18 22:29:59');
INSERT INTO `test_logs` VALUES ('9', null, 'App\\Category', '2', 'null', '{\"name\":\"categories.man_second_force\",\"gender\":\"M\",\"isTeam\":0,\"ageCategory\":0,\"gradeCategory\":2}', 'created', '2016-05-18 22:29:59', '2016-05-18 22:29:59');
INSERT INTO `test_logs` VALUES ('10', null, 'App\\Category', '3', 'null', '{\"name\":\"categories.men_single\",\"gender\":\"M\",\"isTeam\":0,\"ageCategory\":0}', 'created', '2016-05-18 22:29:59', '2016-05-18 22:29:59');
INSERT INTO `test_logs` VALUES ('11', null, 'App\\Category', '4', 'null', '{\"name\":\"categories.men_team\",\"gender\":\"M\",\"isTeam\":1,\"ageCategory\":0}', 'created', '2016-05-18 22:29:59', '2016-05-18 22:29:59');
INSERT INTO `test_logs` VALUES ('12', null, 'App\\Category', '5', 'null', '{\"name\":\"categories.woman_first_force\",\"gender\":\"F\",\"isTeam\":0,\"ageCategory\":0,\"gradeCategory\":1}', 'created', '2016-05-18 22:29:59', '2016-05-18 22:29:59');
INSERT INTO `test_logs` VALUES ('13', null, 'App\\Category', '6', 'null', '{\"name\":\"categories.woman_second_force\",\"gender\":\"F\",\"isTeam\":0,\"ageCategory\":0,\"gradeCategory\":2}', 'created', '2016-05-18 22:29:59', '2016-05-18 22:29:59');
INSERT INTO `test_logs` VALUES ('14', null, 'App\\Category', '7', 'null', '{\"name\":\"categories.ladies_single\",\"gender\":\"F\",\"isTeam\":0,\"ageCategory\":0}', 'created', '2016-05-18 22:29:59', '2016-05-18 22:29:59');
INSERT INTO `test_logs` VALUES ('15', null, 'App\\Category', '8', 'null', '{\"name\":\"categories.ladies_team\",\"gender\":\"F\",\"isTeam\":1,\"ageCategory\":0}', 'created', '2016-05-18 22:29:59', '2016-05-18 22:29:59');
INSERT INTO `test_logs` VALUES ('16', null, 'App\\Category', '9', 'null', '{\"name\":\"categories.mixed_single\",\"gender\":\"X\",\"isTeam\":0,\"ageCategory\":0}', 'created', '2016-05-18 22:29:59', '2016-05-18 22:29:59');
INSERT INTO `test_logs` VALUES ('17', null, 'App\\Category', '10', 'null', '{\"name\":\"categories.mixed_team\",\"gender\":\"X\",\"isTeam\":1,\"ageCategory\":0}', 'created', '2016-05-18 22:29:59', '2016-05-18 22:29:59');
INSERT INTO `test_logs` VALUES ('18', null, 'App\\Tournament', '1', 'null', '{\"user_id\":1,\"name\":\"Fake Tournoi\",\"dateIni\":{\"date\":\"2016-05-24 22:29:59.000000\",\"timezone_type\":3,\"timezone\":\"America\\/Mexico_City\"},\"dateFin\":{\"date\":\"2016-05-24 22:29:59.000000\",\"timezone_type\":3,\"timezone\":\"America\\/Mexico_City\"},\"registerDateLimit\":\"2016-05-24 00:00:00\",\"sport\":1,\"type\":0,\"mustPay\":1,\"venue\":\"CDOM\"}', 'created', '2016-05-18 22:29:59', '2016-05-18 22:29:59');
INSERT INTO `test_logs` VALUES ('19', null, 'App\\Tournament', '2', 'null', '{\"user_id\":1,\"name\":\"DeepSkyBlue\",\"dateIni\":{\"date\":\"2016-05-24 22:29:59.000000\",\"timezone_type\":3,\"timezone\":\"America\\/Mexico_City\"},\"dateFin\":{\"date\":\"2016-05-24 22:29:59.000000\",\"timezone_type\":3,\"timezone\":\"America\\/Mexico_City\"},\"registerDateLimit\":\"2016-05-24 00:00:00\",\"sport\":1,\"type\":false,\"mustPay\":false,\"venue\":\"73904 Howe Manor\\nKuvalistown, CT 75052\",\"latitude\":39.451214,\"longitude\":57.953139,\"level_id\":5}', 'created', '2016-05-18 22:29:59', '2016-05-18 22:29:59');
INSERT INTO `test_logs` VALUES ('20', null, 'App\\Tournament', '3', 'null', '{\"user_id\":1,\"name\":\"Plum\",\"dateIni\":{\"date\":\"2016-05-21 22:29:59.000000\",\"timezone_type\":3,\"timezone\":\"America\\/Mexico_City\"},\"dateFin\":{\"date\":\"2016-05-21 22:29:59.000000\",\"timezone_type\":3,\"timezone\":\"America\\/Mexico_City\"},\"registerDateLimit\":\"2016-05-21 00:00:00\",\"sport\":1,\"type\":false,\"mustPay\":true,\"venue\":\"121 Jacobs Hollow Apt. 919\\nWest Carlee, OK 37913-5004\",\"latitude\":19.82616,\"longitude\":143.59306,\"level_id\":2}', 'created', '2016-05-18 22:29:59', '2016-05-18 22:29:59');
INSERT INTO `test_logs` VALUES ('21', null, 'App\\Tournament', '4', 'null', '{\"user_id\":6,\"name\":\"MediumSpringGreen\",\"dateIni\":{\"date\":\"2016-05-25 22:29:59.000000\",\"timezone_type\":3,\"timezone\":\"America\\/Mexico_City\"},\"dateFin\":{\"date\":\"2016-05-25 22:29:59.000000\",\"timezone_type\":3,\"timezone\":\"America\\/Mexico_City\"},\"registerDateLimit\":\"2016-05-25 00:00:00\",\"sport\":1,\"type\":true,\"mustPay\":false,\"venue\":\"29697 Dorian Shoals Apt. 146\\nVernicehaven, OK 64052\",\"latitude\":-19.38708,\"longitude\":-91.548175,\"level_id\":3}', 'created', '2016-05-18 22:29:59', '2016-05-18 22:29:59');
INSERT INTO `test_logs` VALUES ('22', null, 'App\\Tournament', '5', 'null', '{\"user_id\":7,\"name\":\"MediumOrchid\",\"dateIni\":{\"date\":\"2016-05-25 22:29:59.000000\",\"timezone_type\":3,\"timezone\":\"America\\/Mexico_City\"},\"dateFin\":{\"date\":\"2016-05-25 22:29:59.000000\",\"timezone_type\":3,\"timezone\":\"America\\/Mexico_City\"},\"registerDateLimit\":\"2016-05-25 00:00:00\",\"sport\":1,\"type\":true,\"mustPay\":false,\"venue\":\"179 Jody Hills Apt. 787\\nSouth Marquisechester, WV 02648\",\"latitude\":-65.633594,\"longitude\":-58.399489,\"level_id\":7}', 'created', '2016-05-18 22:29:59', '2016-05-18 22:29:59');
INSERT INTO `test_logs` VALUES ('23', null, 'App\\Tournament', '6', 'null', '{\"user_id\":3,\"name\":\"Azure\",\"dateIni\":{\"date\":\"2016-05-30 22:29:59.000000\",\"timezone_type\":3,\"timezone\":\"America\\/Mexico_City\"},\"dateFin\":{\"date\":\"2016-05-30 22:29:59.000000\",\"timezone_type\":3,\"timezone\":\"America\\/Mexico_City\"},\"registerDateLimit\":\"2016-05-30 00:00:00\",\"sport\":1,\"type\":false,\"mustPay\":true,\"venue\":\"1760 Carter Ferry Apt. 689\\nSouth Ceceliahaven, PA 14788\",\"latitude\":74.5233,\"longitude\":6.28613,\"level_id\":2}', 'created', '2016-05-18 22:29:59', '2016-05-18 22:29:59');
INSERT INTO `test_logs` VALUES ('24', null, 'App\\ChampionshipUser', '1', 'null', '{\"championship_id\":4,\"user_id\":5,\"confirmed\":0}', 'created', '2016-05-18 22:29:59', '2016-05-18 22:29:59');
INSERT INTO `test_logs` VALUES ('25', null, 'App\\ChampionshipUser', '3', 'null', '{\"championship_id\":2,\"user_id\":7,\"confirmed\":1}', 'created', '2016-05-18 22:29:59', '2016-05-18 22:29:59');
INSERT INTO `test_logs` VALUES ('26', null, 'App\\ChampionshipUser', '4', 'null', '{\"championship_id\":6,\"user_id\":2,\"confirmed\":0}', 'created', '2016-05-18 22:29:59', '2016-05-18 22:29:59');
INSERT INTO `test_logs` VALUES ('27', null, 'App\\ChampionshipUser', '5', 'null', '{\"championship_id\":8,\"user_id\":2,\"confirmed\":0}', 'created', '2016-05-18 22:29:59', '2016-05-18 22:29:59');
INSERT INTO `test_logs` VALUES ('28', null, 'App\\ChampionshipUser', '6', 'null', '{\"championship_id\":2,\"user_id\":4,\"confirmed\":1}', 'created', '2016-05-18 22:29:59', '2016-05-18 22:29:59');
INSERT INTO `test_logs` VALUES ('29', null, 'App\\ChampionshipUser', '7', 'null', '{\"championship_id\":10,\"user_id\":6,\"confirmed\":0}', 'created', '2016-05-18 22:29:59', '2016-05-18 22:29:59');
INSERT INTO `test_logs` VALUES ('30', null, 'App\\ChampionshipUser', '8', 'null', '{\"championship_id\":7,\"user_id\":1,\"confirmed\":0}', 'created', '2016-05-18 22:29:59', '2016-05-18 22:29:59');
INSERT INTO `test_logs` VALUES ('31', null, 'App\\ChampionshipUser', '10', 'null', '{\"championship_id\":5,\"user_id\":3,\"confirmed\":0}', 'created', '2016-05-18 22:29:59', '2016-05-18 22:29:59');
INSERT INTO `test_logs` VALUES ('32', null, 'App\\ChampionshipUser', '11', 'null', '{\"championship_id\":3,\"user_id\":5,\"confirmed\":0}', 'created', '2016-05-18 22:29:59', '2016-05-18 22:29:59');
INSERT INTO `test_logs` VALUES ('33', null, 'App\\ChampionshipUser', '12', 'null', '{\"championship_id\":4,\"user_id\":3,\"confirmed\":1}', 'created', '2016-05-18 22:29:59', '2016-05-18 22:29:59');
INSERT INTO `test_logs` VALUES ('34', null, 'App\\ChampionshipUser', '13', 'null', '{\"championship_id\":1,\"user_id\":4,\"confirmed\":1}', 'created', '2016-05-18 22:29:59', '2016-05-18 22:29:59');
INSERT INTO `test_logs` VALUES ('35', null, 'App\\ChampionshipUser', '15', 'null', '{\"championship_id\":3,\"user_id\":4,\"confirmed\":1}', 'created', '2016-05-18 22:29:59', '2016-05-18 22:29:59');
INSERT INTO `test_logs` VALUES ('36', null, 'App\\ChampionshipUser', '16', 'null', '{\"championship_id\":2,\"user_id\":2,\"confirmed\":0}', 'created', '2016-05-18 22:29:59', '2016-05-18 22:29:59');
INSERT INTO `test_logs` VALUES ('37', null, 'App\\ChampionshipUser', '17', 'null', '{\"championship_id\":2,\"user_id\":1,\"confirmed\":0}', 'created', '2016-05-18 22:29:59', '2016-05-18 22:29:59');
INSERT INTO `test_logs` VALUES ('38', null, 'App\\ChampionshipUser', '19', 'null', '{\"championship_id\":4,\"user_id\":6,\"confirmed\":1}', 'created', '2016-05-18 22:29:59', '2016-05-18 22:29:59');
INSERT INTO `test_logs` VALUES ('39', null, 'App\\ChampionshipUser', '20', 'null', '{\"championship_id\":8,\"user_id\":5,\"confirmed\":0}', 'created', '2016-05-18 22:29:59', '2016-05-18 22:29:59');
INSERT INTO `test_logs` VALUES ('40', null, 'App\\ChampionshipUser', '21', 'null', '{\"championship_id\":6,\"user_id\":1,\"confirmed\":0}', 'created', '2016-05-18 22:29:59', '2016-05-18 22:29:59');
INSERT INTO `test_logs` VALUES ('41', null, 'App\\ChampionshipUser', '25', 'null', '{\"championship_id\":3,\"user_id\":7,\"confirmed\":0}', 'created', '2016-05-18 22:29:59', '2016-05-18 22:29:59');
INSERT INTO `test_logs` VALUES ('42', null, 'App\\ChampionshipUser', '26', 'null', '{\"championship_id\":1,\"user_id\":7,\"confirmed\":0}', 'created', '2016-05-18 22:29:59', '2016-05-18 22:29:59');
INSERT INTO `test_logs` VALUES ('43', null, 'App\\ChampionshipUser', '27', 'null', '{\"championship_id\":2,\"user_id\":5,\"confirmed\":0}', 'created', '2016-05-18 22:29:59', '2016-05-18 22:29:59');
INSERT INTO `test_logs` VALUES ('44', null, 'App\\ChampionshipUser', '28', 'null', '{\"championship_id\":4,\"user_id\":2,\"confirmed\":0}', 'created', '2016-05-18 22:29:59', '2016-05-18 22:29:59');
INSERT INTO `test_logs` VALUES ('45', null, 'App\\ChampionshipUser', '29', 'null', '{\"championship_id\":8,\"user_id\":7,\"confirmed\":0}', 'created', '2016-05-18 22:29:59', '2016-05-18 22:29:59');
INSERT INTO `test_logs` VALUES ('46', null, 'App\\ChampionshipUser', '30', 'null', '{\"championship_id\":1,\"user_id\":3,\"confirmed\":0}', 'created', '2016-05-18 22:29:59', '2016-05-18 22:29:59');
INSERT INTO `test_logs` VALUES ('47', null, 'App\\User', '8', 'null', '{\"name\":\"FMK\",\"firstname\":\"Keely\",\"lastname\":\"Hansen\",\"email\":\"fmk@kendozone.com\",\"password\":\"$2y$10$YD1brhOJmE0BCfXF3.N1WuKEcZMZEIKWqEQxtBySZJ8mpoVMxqJda\",\"grade_id\":5,\"country_id\":612,\"city\":\"Pourosborough\",\"latitude\":-43.740957,\"longitude\":177.607075,\"role_id\":\"2\",\"verified\":1,\"remember_token\":\"4ihlZYuEMw\",\"provider\":\"\",\"provider_id\":\"dheOy\",\"locale\":\"es\"}', 'created', '2016-05-18 22:30:00', '2016-05-18 22:30:00');
INSERT INTO `test_logs` VALUES ('48', null, 'App\\Association', '1', 'null', '{\"name\":\"core.no_association\",\"president_id\":\"1\"}', 'created', '2016-05-18 22:30:00', '2016-05-18 22:30:00');
INSERT INTO `test_logs` VALUES ('49', null, 'App\\User', '9', 'null', '{\"name\":\"AIKEM_President\",\"firstname\":\"Shayna\",\"lastname\":\"Muller\",\"email\":\"presidencia@aikem.com\",\"password\":\"$2y$10$S1NTsGWaF\\/qh74rbn30AP.rbI\\/mSHeXD5JpktCoGsNO3mee9IMksy\",\"grade_id\":1,\"country_id\":292,\"city\":\"West Lisandro\",\"latitude\":-29.659687,\"longitude\":-83.932016,\"role_id\":\"3\",\"verified\":1,\"remember_token\":\"Hev8524uY4\",\"provider\":\"\",\"provider_id\":\"K9Ty8\",\"locale\":\"en\"}', 'created', '2016-05-18 22:30:00', '2016-05-18 22:30:00');
INSERT INTO `test_logs` VALUES ('50', null, 'App\\Association', '2', 'null', '{\"federation_id\":37,\"name\":\"Asociaci\\u00f3n de Kendo y Artes Marciales Afines del Distrito Federal, A.C.\",\"president_id\":\"1\",\"address\":\"\",\"phone\":\"55 17 63 48 59\",\"state\":\"Distrito Federal\"}', 'created', '2016-05-18 22:30:00', '2016-05-18 22:30:00');
INSERT INTO `test_logs` VALUES ('51', null, 'App\\Association', '3', 'null', '{\"federation_id\":37,\"name\":\"Asociaci\\u00f3n de Kendo del Estado de Nuevo Le\\u00f3n, A.C.\\t\",\"president_id\":\"1\",\"address\":\"\",\"phone\":\"811 486 0071\",\"state\":\"Nuevo L\\u00e9on\"}', 'created', '2016-05-18 22:30:00', '2016-05-18 22:30:00');
INSERT INTO `test_logs` VALUES ('52', null, 'App\\Association', '4', 'null', '{\"federation_id\":37,\"name\":\"Asociaci\\u00f3n de Kendo del Estado de Veracruz, A.C.\",\"president_id\":\"1\",\"address\":\"\",\"phone\":\"(229) 9374231\",\"state\":\"Veracruz\"}', 'created', '2016-05-18 22:30:00', '2016-05-18 22:30:00');
INSERT INTO `test_logs` VALUES ('53', null, 'App\\Association', '5', 'null', '{\"federation_id\":37,\"name\":\"Asociaci\\u00f3n de Kendo Iaido y Jodo del Estado de Coahuila, A.C.\",\"president_id\":\"1\",\"address\":\"\",\"phone\":\"(871) 7292971\",\"state\":\"Coahuila\"}', 'created', '2016-05-18 22:30:00', '2016-05-18 22:30:00');
INSERT INTO `test_logs` VALUES ('54', null, 'App\\Association', '6', 'null', '{\"federation_id\":37,\"name\":\"ASOCIACION DE KENSHI DEL ESTADO DE PUEBLA, A.C.\",\"president_id\":\"1\",\"address\":\"\",\"phone\":\"\",\"state\":\"Puebla\"}', 'created', '2016-05-18 22:30:00', '2016-05-18 22:30:00');
INSERT INTO `test_logs` VALUES ('55', null, 'App\\Association', '7', 'null', '{\"federation_id\":37,\"name\":\"Asociaci\\u00f3n Mexiquense de Kendo, A.C.\",\"president_id\":9,\"address\":\"\",\"phone\":\"(55) 13011905\",\"state\":\"Estado de M\\u00e9xico\"}', 'created', '2016-05-18 22:30:00', '2016-05-18 22:30:00');
INSERT INTO `test_logs` VALUES ('56', null, 'App\\Association', '8', 'null', '{\"federation_id\":37,\"name\":\"Asociaci\\u00f3n de Kendo de la Universidad Aut\\u00f3noma de M\\u00e9xico\",\"president_id\":\"1\",\"address\":\"\",\"phone\":\"\",\"state\":\"Distrito Federal\"}', 'created', '2016-05-18 22:30:00', '2016-05-18 22:30:00');
INSERT INTO `test_logs` VALUES ('57', null, 'App\\Association', '9', 'null', '{\"federation_id\":37,\"name\":\"Grupo de Kendo del Estado de Chihuahua\",\"president_id\":\"1\",\"address\":\"\",\"phone\":\"(614) 4820716\",\"state\":\"Chihuahua\"}', 'created', '2016-05-18 22:30:00', '2016-05-18 22:30:00');
INSERT INTO `test_logs` VALUES ('58', null, 'App\\Association', '10', 'null', '{\"federation_id\":37,\"name\":\"Asociaci\\u00f3n de Iaido y Kendo de Quer\\u00e9taro\",\"president_id\":\"1\",\"address\":\"\",\"phone\":\"\",\"state\":\"Quer\\u00e9taro\"}', 'created', '2016-05-18 22:30:00', '2016-05-18 22:30:00');
INSERT INTO `test_logs` VALUES ('59', null, 'App\\Association', '11', 'null', '{\"federation_id\":37,\"name\":\"Asociaci\\u00f3n de Kendo, Iaido y Jodo de Jalisco TenKen Ryuu AC\",\"president_id\":\"1\",\"address\":\"\",\"phone\":\"(044) 33 3393-6164\",\"state\":\"Jalisco\"}', 'created', '2016-05-18 22:30:00', '2016-05-18 22:30:00');
INSERT INTO `test_logs` VALUES ('60', null, 'App\\Association', '12', 'null', '{\"federation_id\":37,\"name\":\"Asociaci\\u00f3n de Iaido y Kendo del Instituto Polit\\u00e9cnico Nacional\",\"president_id\":\"1\",\"address\":\"\",\"phone\":\"(044) 55-24-95-95-15\",\"state\":\"Distrito Federal\"}', 'created', '2016-05-18 22:30:00', '2016-05-18 22:30:00');
INSERT INTO `test_logs` VALUES ('61', null, 'App\\Association', '13', 'null', '{\"federation_id\":37,\"name\":\"Grupo de Kendo del Estado de San Luis Potos\\u00ed\",\"president_id\":\"1\",\"address\":\"\",\"phone\":\"\",\"state\":\"San Luis P\\u00f3tosi\"}', 'created', '2016-05-18 22:30:00', '2016-05-18 22:30:00');
INSERT INTO `test_logs` VALUES ('62', null, 'App\\Association', '14', 'null', '{\"federation_id\":37,\"name\":\"Asociaci\\u00f3n de Kendo del Estado de Morelos\",\"president_id\":\"1\",\"address\":\"\",\"phone\":\"045-777-303-1202\",\"state\":\"Morelos\"}', 'created', '2016-05-18 22:30:00', '2016-05-18 22:30:00');
INSERT INTO `test_logs` VALUES ('63', null, 'App\\Association', '15', 'null', '{\"federation_id\":37,\"name\":\"ASOCIACI\\u00d3N ESTATAL DE KENDO E IAIDO DE AGUASCALIENTES, A.C.\",\"president_id\":\"1\",\"address\":\"\",\"phone\":\"4492094939\",\"state\":\"Aguascalientes\"}', 'created', '2016-05-18 22:30:00', '2016-05-18 22:30:00');
INSERT INTO `test_logs` VALUES ('64', null, 'App\\Association', '16', 'null', '{\"name\":\"Mr. Avery Schmitt\",\"federation_id\":15,\"president_id\":7,\"address\":\"81603 Considine Shoals\\nRobertstown, VA 81484-5367\",\"phone\":\"1-835-907-6138 x8981\"}', 'created', '2016-05-18 22:30:00', '2016-05-18 22:30:00');
INSERT INTO `test_logs` VALUES ('65', null, 'App\\Association', '17', 'null', '{\"name\":\"Claudie Greenholt Jr.\",\"federation_id\":22,\"president_id\":9,\"address\":\"19596 Francesca Ports\\nRickeymouth, SC 50408-2064\",\"phone\":\"771-258-7944 x7550\"}', 'created', '2016-05-18 22:30:00', '2016-05-18 22:30:00');
INSERT INTO `test_logs` VALUES ('66', null, 'App\\Association', '18', 'null', '{\"name\":\"Mrs. Lavinia Jacobi\",\"federation_id\":5,\"president_id\":1,\"address\":\"33371 Ebert Dale Suite 366\\nSimonisfort, GA 98024-4910\",\"phone\":\"247-667-7519\"}', 'created', '2016-05-18 22:30:00', '2016-05-18 22:30:00');
INSERT INTO `test_logs` VALUES ('67', null, 'App\\Association', '19', 'null', '{\"name\":\"Mr. Consuelo Macejkovic V\",\"federation_id\":15,\"president_id\":5,\"address\":\"398 Hassan Locks Apt. 079\\nCarterland, MI 68086\",\"phone\":\"851-583-1677\"}', 'created', '2016-05-18 22:30:00', '2016-05-18 22:30:00');
INSERT INTO `test_logs` VALUES ('68', null, 'App\\Association', '20', 'null', '{\"name\":\"Kristopher Welch\",\"federation_id\":33,\"president_id\":3,\"address\":\"11655 Botsford Squares Suite 090\\nRyanfurt, FL 71508\",\"phone\":\"1-540-781-8696\"}', 'created', '2016-05-18 22:30:00', '2016-05-18 22:30:00');
INSERT INTO `test_logs` VALUES ('69', null, 'App\\Club', '1', 'null', '{\"name\":\"core.no_club\",\"president_id\":\"1\"}', 'created', '2016-05-18 22:30:00', '2016-05-18 22:30:00');
INSERT INTO `test_logs` VALUES ('70', null, 'App\\User', '10', 'null', '{\"name\":\"naucali_President\",\"firstname\":\"Reginald\",\"lastname\":\"Bins\",\"email\":\"naucali@aikem.com\",\"password\":\"$2y$10$fg3L\\/kzeiLRBS80OBJ2pDuCYvap8h8Ol3zT0J0bwd.6aaQx\\/rTZZu\",\"grade_id\":5,\"country_id\":729,\"city\":\"East Susannahaven\",\"latitude\":33.373852,\"longitude\":160.761447,\"role_id\":\"4\",\"verified\":1,\"remember_token\":\"7QrryBOnsh\",\"provider\":\"\",\"provider_id\":\"JZP97\",\"locale\":\"es\"}', 'created', '2016-05-18 22:30:00', '2016-05-18 22:30:00');
INSERT INTO `test_logs` VALUES ('71', null, 'App\\Club', '2', 'null', '{\"name\":\"Mrs. Briana Greenfelder\",\"association_id\":9,\"president_id\":4,\"address\":\"1905 Wintheiser Ferry\\nRileyfort, CO 00658\",\"phone\":\"1-451-335-3192\"}', 'created', '2016-05-18 22:30:00', '2016-05-18 22:30:00');
INSERT INTO `test_logs` VALUES ('72', null, 'App\\Club', '3', 'null', '{\"name\":\"Noelia Boehm\",\"association_id\":13,\"president_id\":7,\"address\":\"8181 Cole Extensions Apt. 967\\nWillmsland, CO 88345\",\"phone\":\"+1 (552) 273-0372\"}', 'created', '2016-05-18 22:30:00', '2016-05-18 22:30:00');
INSERT INTO `test_logs` VALUES ('73', null, 'App\\Club', '4', 'null', '{\"name\":\"Miss Georgette Champlin MD\",\"association_id\":1,\"president_id\":8,\"address\":\"824 Harber Course\\nSkilesfurt, KY 80672\",\"phone\":\"(532) 848-1062\"}', 'created', '2016-05-18 22:30:00', '2016-05-18 22:30:00');
INSERT INTO `test_logs` VALUES ('74', null, 'App\\Club', '5', 'null', '{\"name\":\"Prof. Destini Kuhn\",\"association_id\":1,\"president_id\":1,\"address\":\"6492 Jaylon Canyon Suite 809\\nLegrosville, NV 43958\",\"phone\":\"1-430-894-3234\"}', 'created', '2016-05-18 22:30:00', '2016-05-18 22:30:00');
INSERT INTO `test_logs` VALUES ('75', null, 'App\\Club', '6', 'null', '{\"name\":\"Miss Megane Wolf II\",\"association_id\":6,\"president_id\":2,\"address\":\"2139 Anika Brook Apt. 221\\nAdriannaview, ND 07133-3590\",\"phone\":\"+1-296-255-3464\"}', 'created', '2016-05-18 22:30:00', '2016-05-18 22:30:00');
INSERT INTO `test_logs` VALUES ('76', null, 'App\\Club', '7', 'null', '{\"name\":\"Naucali\",\"association_id\":7,\"president_id\":10,\"address\":\"4981 Lehner Mill\\nHipolitoshire, ME 93926\",\"phone\":\"731-774-6578 x1726\"}', 'created', '2016-05-18 22:30:00', '2016-05-18 22:30:00');

-- ----------------------------
-- Table structure for test_ltm_translations
-- ----------------------------
DROP TABLE IF EXISTS `test_ltm_translations`;
CREATE TABLE `test_ltm_translations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `status` int(11) NOT NULL DEFAULT '0',
  `locale` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `group` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of test_ltm_translations
-- ----------------------------

-- ----------------------------
-- Table structure for test_migrations
-- ----------------------------
DROP TABLE IF EXISTS `test_migrations`;
CREATE TABLE `test_migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of test_migrations
-- ----------------------------
INSERT INTO `test_migrations` VALUES ('2014_04_02_193005_create_translations_table', '1');
INSERT INTO `test_migrations` VALUES ('2014_09_02_182709_setup_countries_table', '1');
INSERT INTO `test_migrations` VALUES ('2014_09_02_182710_charify_countries_table', '1');
INSERT INTO `test_migrations` VALUES ('2014_10_12_000000_create_roles_tables', '1');
INSERT INTO `test_migrations` VALUES ('2014_10_12_000001_create_Grade_table', '1');
INSERT INTO `test_migrations` VALUES ('2014_10_12_000010_create_users_table', '1');
INSERT INTO `test_migrations` VALUES ('2014_10_12_100000_create_password_resets_table', '1');
INSERT INTO `test_migrations` VALUES ('2015_08_01_104512_create_log_table', '1');
INSERT INTO `test_migrations` VALUES ('2015_11_01_171759_create_Federation_table', '1');
INSERT INTO `test_migrations` VALUES ('2015_11_01_171759_create_TournamentLevel_table', '1');
INSERT INTO `test_migrations` VALUES ('2015_11_01_171759_create_Tournament_table', '1');
INSERT INTO `test_migrations` VALUES ('2015_11_01_171760_create_Association_table', '1');
INSERT INTO `test_migrations` VALUES ('2015_11_12_220258_create_permissions_table', '1');
INSERT INTO `test_migrations` VALUES ('2015_12_03_230346_create_Category_table', '1');
INSERT INTO `test_migrations` VALUES ('2015_12_09_030143_create_Settings_table', '1');
INSERT INTO `test_migrations` VALUES ('2015_12_11_034941_create_Invitation_table', '1');
INSERT INTO `test_migrations` VALUES ('2015_12_23_025811_create_CategorySettings_table', '1');
INSERT INTO `test_migrations` VALUES ('2016_05_06_171760_create_Club_table', '1');
INSERT INTO `test_migrations` VALUES ('2016_95_04_171759_create_Team_table', '1');
INSERT INTO `test_migrations` VALUES ('2016_95_04_171760_create_Request_table', '1');
INSERT INTO `test_migrations` VALUES ('2017_95_04_171760_create_FK', '1');

-- ----------------------------
-- Table structure for test_password_resets
-- ----------------------------
DROP TABLE IF EXISTS `test_password_resets`;
CREATE TABLE `test_password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of test_password_resets
-- ----------------------------

-- ----------------------------
-- Table structure for test_permission_role
-- ----------------------------
DROP TABLE IF EXISTS `test_permission_role`;
CREATE TABLE `test_permission_role` (
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `permission_role_role_id_foreign` (`role_id`),
  CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `test_permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `test_roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of test_permission_role
-- ----------------------------

-- ----------------------------
-- Table structure for test_permissions
-- ----------------------------
DROP TABLE IF EXISTS `test_permissions`;
CREATE TABLE `test_permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `label` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of test_permissions
-- ----------------------------
INSERT INTO `test_permissions` VALUES ('1', 'CanEditProfile', '', '2016-05-18 22:29:59', '2016-05-18 22:29:59');
INSERT INTO `test_permissions` VALUES ('2', 'CanDeleteProfile', '', '2016-05-18 22:29:59', '2016-05-18 22:29:59');
INSERT INTO `test_permissions` VALUES ('3', 'CanChangeSettings', '', '2016-05-18 22:29:59', '2016-05-18 22:29:59');
INSERT INTO `test_permissions` VALUES ('4', 'CanAccessDashboard', '', '2016-05-18 22:29:59', '2016-05-18 22:29:59');
INSERT INTO `test_permissions` VALUES ('5', 'CanSeeTournaments', '', '2016-05-18 22:29:59', '2016-05-18 22:29:59');
INSERT INTO `test_permissions` VALUES ('6', 'CanCreateTournament', '', '2016-05-18 22:29:59', '2016-05-18 22:29:59');
INSERT INTO `test_permissions` VALUES ('7', 'CanEditTournament', '', '2016-05-18 22:29:59', '2016-05-18 22:29:59');
INSERT INTO `test_permissions` VALUES ('8', 'CanDeleteTournament', '', '2016-05-18 22:29:59', '2016-05-18 22:29:59');
INSERT INTO `test_permissions` VALUES ('9', 'CanSeePlaces', '', '2016-05-18 22:29:59', '2016-05-18 22:29:59');
INSERT INTO `test_permissions` VALUES ('10', 'CanCreatePlace', '', '2016-05-18 22:29:59', '2016-05-18 22:29:59');
INSERT INTO `test_permissions` VALUES ('11', 'CanEditPlace', '', '2016-05-18 22:29:59', '2016-05-18 22:29:59');
INSERT INTO `test_permissions` VALUES ('12', 'CanDeletePlace', '', '2016-05-18 22:29:59', '2016-05-18 22:29:59');
INSERT INTO `test_permissions` VALUES ('13', 'CanRegisterUser', '', '2016-05-18 22:29:59', '2016-05-18 22:29:59');
INSERT INTO `test_permissions` VALUES ('14', 'CanInviteCompetitor', '', '2016-05-18 22:29:59', '2016-05-18 22:29:59');
INSERT INTO `test_permissions` VALUES ('15', 'CanBanCompetitor', '', '2016-05-18 22:29:59', '2016-05-18 22:29:59');
INSERT INTO `test_permissions` VALUES ('16', 'CanSeeStatistics', '', '2016-05-18 22:29:59', '2016-05-18 22:29:59');
INSERT INTO `test_permissions` VALUES ('17', 'CanSeeCompetitor', '', '2016-05-18 22:29:59', '2016-05-18 22:29:59');
INSERT INTO `test_permissions` VALUES ('18', 'CanSeeGroup', '', '2016-05-18 22:29:59', '2016-05-18 22:29:59');
INSERT INTO `test_permissions` VALUES ('19', 'CanSeeLogs', '', '2016-05-18 22:29:59', '2016-05-18 22:29:59');
INSERT INTO `test_permissions` VALUES ('20', 'CanDeleteAccount', '', '2016-05-18 22:29:59', '2016-05-18 22:29:59');
INSERT INTO `test_permissions` VALUES ('21', 'CanChangeRole', '', '2016-05-18 22:29:59', '2016-05-18 22:29:59');

-- ----------------------------
-- Table structure for test_request
-- ----------------------------
DROP TABLE IF EXISTS `test_request`;
CREATE TABLE `test_request` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `object_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `object_id` int(10) unsigned NOT NULL,
  `used` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of test_request
-- ----------------------------

-- ----------------------------
-- Table structure for test_roles
-- ----------------------------
DROP TABLE IF EXISTS `test_roles`;
CREATE TABLE `test_roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `label` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of test_roles
-- ----------------------------
INSERT INTO `test_roles` VALUES ('1', 'SuperAdmin', 'SuperAdmin', '2016-05-18 22:29:57', '2016-05-18 22:29:57');
INSERT INTO `test_roles` VALUES ('2', 'Owner', 'Owner', '2016-05-18 22:29:57', '2016-05-18 22:29:57');
INSERT INTO `test_roles` VALUES ('3', 'Admin', 'Admin', '2016-05-18 22:29:57', '2016-05-18 22:29:57');
INSERT INTO `test_roles` VALUES ('4', 'Moderator', 'Moderator', '2016-05-18 22:29:57', '2016-05-18 22:29:57');
INSERT INTO `test_roles` VALUES ('5', 'User', 'User', '2016-05-18 22:29:57', '2016-05-18 22:29:57');

-- ----------------------------
-- Table structure for test_settings
-- ----------------------------
DROP TABLE IF EXISTS `test_settings`;
CREATE TABLE `test_settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `isTeam` tinyint(1) NOT NULL,
  `teamSize` tinyint(4) NOT NULL,
  `fightDuration` tinyint(4) NOT NULL,
  `hasRoundRobin` tinyint(1) NOT NULL,
  `roundRobinWinner` tinyint(4) NOT NULL,
  `hasEncho` tinyint(1) NOT NULL,
  `enchoQty` tinyint(4) NOT NULL,
  `enchoDuration` tinyint(4) NOT NULL,
  `hasHantei` tinyint(1) NOT NULL,
  `cost` smallint(6) NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `settings_user_id_foreign` (`user_id`),
  CONSTRAINT `settings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `test_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of test_settings
-- ----------------------------

-- ----------------------------
-- Table structure for test_team
-- ----------------------------
DROP TABLE IF EXISTS `test_team`;
CREATE TABLE `test_team` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `championship_id` int(10) unsigned NOT NULL,
  `name` int(10) unsigned NOT NULL,
  `picture` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `team_championship_id_foreign` (`championship_id`),
  CONSTRAINT `team_championship_id_foreign` FOREIGN KEY (`championship_id`) REFERENCES `test_championship` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of test_team
-- ----------------------------

-- ----------------------------
-- Table structure for test_tournament
-- ----------------------------
DROP TABLE IF EXISTS `test_tournament`;
CREATE TABLE `test_tournament` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dateIni` date NOT NULL,
  `dateFin` date NOT NULL,
  `registerDateLimit` date NOT NULL,
  `sport` int(10) unsigned NOT NULL DEFAULT '1',
  `type` tinyint(4) NOT NULL DEFAULT '1',
  `mustPay` tinyint(1) NOT NULL,
  `venue` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `latitude` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `longitude` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `level_id` int(10) unsigned NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tournament_slug_unique` (`slug`),
  KEY `tournament_user_id_foreign` (`user_id`),
  KEY `tournament_level_id_foreign` (`level_id`),
  CONSTRAINT `tournament_level_id_foreign` FOREIGN KEY (`level_id`) REFERENCES `test_tournamentLevel` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `tournament_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `test_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of test_tournament
-- ----------------------------
INSERT INTO `test_tournament` VALUES ('1', '1', 'Fake Tournoi', 'fake-tournoi', '2016-05-24', '2016-05-24', '2016-05-24', '1', '0', '1', 'CDOM', '41.31', '-72.92', '1', '2016-05-18 22:29:59', '2016-05-18 22:29:59', null);
INSERT INTO `test_tournament` VALUES ('2', '1', 'DeepSkyBlue', 'deepskyblue', '2016-05-24', '2016-05-24', '2016-05-24', '1', '0', '0', '73904 Howe Manor\nKuvalistown, CT 75052', '41.31', '-72.92', '5', '2016-05-18 22:29:59', '2016-05-18 22:29:59', null);
INSERT INTO `test_tournament` VALUES ('3', '1', 'Plum', 'plum', '2016-05-21', '2016-05-21', '2016-05-21', '1', '0', '1', '121 Jacobs Hollow Apt. 919\nWest Carlee, OK 37913-5004', '41.31', '-72.92', '2', '2016-05-18 22:29:59', '2016-05-18 22:29:59', null);
INSERT INTO `test_tournament` VALUES ('4', '6', 'MediumSpringGreen', 'mediumspringgreen', '2016-05-25', '2016-05-25', '2016-05-25', '1', '1', '0', '29697 Dorian Shoals Apt. 146\nVernicehaven, OK 64052', '41.31', '-72.92', '3', '2016-05-18 22:29:59', '2016-05-18 22:29:59', null);
INSERT INTO `test_tournament` VALUES ('5', '7', 'MediumOrchid', 'mediumorchid', '2016-05-25', '2016-05-25', '2016-05-25', '1', '1', '0', '179 Jody Hills Apt. 787\nSouth Marquisechester, WV 02648', '41.31', '-72.92', '7', '2016-05-18 22:29:59', '2016-05-18 22:29:59', null);
INSERT INTO `test_tournament` VALUES ('6', '3', 'Azure', 'azure', '2016-05-30', '2016-05-30', '2016-05-30', '1', '0', '1', '1760 Carter Ferry Apt. 689\nSouth Ceceliahaven, PA 14788', '41.31', '-72.92', '2', '2016-05-18 22:29:59', '2016-05-18 22:29:59', null);

-- ----------------------------
-- Table structure for test_tournamentLevel
-- ----------------------------
DROP TABLE IF EXISTS `test_tournamentLevel`;
CREATE TABLE `test_tournamentLevel` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of test_tournamentLevel
-- ----------------------------
INSERT INTO `test_tournamentLevel` VALUES ('1', 'ND');
INSERT INTO `test_tournamentLevel` VALUES ('2', 'core.local');
INSERT INTO `test_tournamentLevel` VALUES ('3', 'core.district');
INSERT INTO `test_tournamentLevel` VALUES ('4', 'core.level_city');
INSERT INTO `test_tournamentLevel` VALUES ('5', 'core.level_state');
INSERT INTO `test_tournamentLevel` VALUES ('6', 'core.regional');
INSERT INTO `test_tournamentLevel` VALUES ('7', 'core.national');
INSERT INTO `test_tournamentLevel` VALUES ('8', 'core.international');

-- ----------------------------
-- Table structure for test_users
-- ----------------------------
DROP TABLE IF EXISTS `test_users`;
CREATE TABLE `test_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `firstname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lastname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `federation_id` int(10) unsigned NOT NULL DEFAULT '1',
  `association_id` int(10) unsigned NOT NULL DEFAULT '1',
  `club_id` int(10) unsigned NOT NULL DEFAULT '1',
  `grade_id` int(10) unsigned NOT NULL DEFAULT '1',
  `city` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `latitude` double DEFAULT NULL,
  `longitude` double DEFAULT NULL,
  `role_id` int(10) unsigned NOT NULL DEFAULT '5',
  `country_id` int(10) unsigned NOT NULL,
  `avatar` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT '0',
  `token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `provider_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `locale` varchar(5) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'en',
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_slug_unique` (`slug`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_provider_id_unique` (`provider_id`),
  KEY `users_grade_id_foreign` (`grade_id`),
  KEY `users_role_id_foreign` (`role_id`),
  KEY `users_country_id_foreign` (`country_id`),
  KEY `users_federation_id_foreign` (`federation_id`),
  KEY `users_association_id_foreign` (`association_id`),
  KEY `users_club_id_foreign` (`club_id`),
  CONSTRAINT `users_association_id_foreign` FOREIGN KEY (`association_id`) REFERENCES `test_association` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `users_club_id_foreign` FOREIGN KEY (`club_id`) REFERENCES `test_club` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `users_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `test_countries` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `users_federation_id_foreign` FOREIGN KEY (`federation_id`) REFERENCES `test_federation` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `users_grade_id_foreign` FOREIGN KEY (`grade_id`) REFERENCES `test_grade` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `test_roles` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of test_users
-- ----------------------------
INSERT INTO `test_users` VALUES ('1', 'No User', 'nouseratnouser-com', null, null, 'nouser@nouser.com', '', '1', '1', '1', '1', 'New Haven', '41.31', '-72.92', '5', '840', null, '0', 'sTkd5YrtV1fRkWq0bYtdrUd4OQEHYp', '', null, 'en', null, '2016-05-18 22:29:58', '2016-05-18 22:29:58', null);
INSERT INTO `test_users` VALUES ('2', 'Juliatzin Del torro', 'flordcactusatgmail-com', null, null, 'flordcactus@gmail.com', '$2y$10$1PtkhrFJK953dQYFb5pKMugryyRprg8r9hLHMDNJwXB8oKZWvjfau', '1', '1', '1', '7', 'Mexico City', '19.4342', '-99.1386', '1', '484', 'https://lh3.googleusercontent.com/-1IZ2nbY2o40/AAAAAAAAAAI/AAAAAAAAHEY/KrhjLc7m66g/photo.jpg?sz=50', '1', 'e9M4b4wA2wMnyVp40D3Hu1Y5CbZapi', 'google', '113769489654625617770', 'en', '7rCCxMRjsqSgHCt1mbOSkz5TV0iKe9YYVNMrOwX2g5pLUsF3qBqVQ1zlYOuv', '2016-05-18 22:29:58', '2016-05-18 22:29:58', null);
INSERT INTO `test_users` VALUES ('3', 'root', 'superuseratkendozone-com', 'Virginie', 'Hammes', 'superuser@kendozone.com', '$2y$10$Rx7rnY8IzKHvJZMSeTTFK.p.xf/zmEsV/6UYFPehBjtoTEvLSRdpC', '1', '1', '1', '1', 'West Rozellaburgh', '63.086821', '-104.73848', '1', '246', null, '1', 'aaUMApMSdcU1UagESIz28Ppc1kHAxY', '', 'dM8AW', 'es', 'URmu98kt7y', '2016-05-18 22:29:58', '2016-05-18 22:29:58', null);
INSERT INTO `test_users` VALUES ('4', 'federation', 'federationatkendozone-com', 'Mayra', 'Feest', 'federation@kendozone.com', '$2y$10$1Azfw8GAuB7QQlxJ6zO69.z6gBJfbp9SSn4q5xvYnEgop6IMxeTQC', '1', '1', '1', '2', 'Maribelstad', '-35.736662', '-26.151264', '2', '608', null, '1', 'rdav2vL4J4FkXICxM19sD7Ub2GKKnx', '', 'mL2P0', 'en', 'aD8CYQo96N', '2016-05-18 22:29:58', '2016-05-18 22:29:58', null);
INSERT INTO `test_users` VALUES ('5', 'association', 'associationatkendozone-com', 'Bridget', 'Hirthe', 'association@kendozone.com', '$2y$10$NdI7rsLHrvUFeHhS8Yf6a.8LuMMAC4JJZw3NG6sKBGK5c3RP69ffm', '1', '1', '1', '1', 'Ullrichberg', '38.593578', '29.833143', '3', '328', null, '1', 'NrAOWvtyXRvu7g6hD7RCKM7IiNKag1', '', '18vZ9', 'en', 'hVlAhDlYjO', '2016-05-18 22:29:58', '2016-05-18 22:29:58', null);
INSERT INTO `test_users` VALUES ('6', 'club', 'clubatkendozone-com', 'Nils', 'Tromp', 'club@kendozone.com', '$2y$10$YD7jDB8H/f7sg2DTfXDPUe0lzqZyKlRTvxB6u/5bBIh9VVGlUExBi', '1', '1', '1', '3', 'Eloiseview', '70.448226', '98.949235', '4', '410', null, '1', 'X15SfKXxAvP8obgxfiBr6eg9bH7aYg', '', 'luy7M', 'es', '8RTQYOWbiR', '2016-05-18 22:29:58', '2016-05-18 22:29:58', null);
INSERT INTO `test_users` VALUES ('7', 'user', 'useratkendozone-com', 'Cleta', 'Grant', 'user@kendozone.com', '$2y$10$Sl6sfaDH7AgZH00rbEbAY.BVbnO.04UuVfiOs22g0QYpui1tCgekC', '1', '1', '1', '5', 'East Giovanimouth', '5.592078', '153.707274', '5', '428', null, '1', 'KA7fCAKNM4qNrKBl6DRMp5FWqhVtcT', '', 'CvjEj', 'es', 'UANgaL5ovH', '2016-05-18 22:29:59', '2016-05-18 22:29:59', null);
INSERT INTO `test_users` VALUES ('8', 'FMK', 'fmkatkendozone-com', 'Keely', 'Hansen', 'fmk@kendozone.com', '$2y$10$YD1brhOJmE0BCfXF3.N1WuKEcZMZEIKWqEQxtBySZJ8mpoVMxqJda', '1', '1', '1', '5', 'Pourosborough', '-43.740957', '177.607075', '2', '612', null, '1', 'oyXW0bi8TWBXHKyLolVYx2KVU2u22D', '', 'dheOy', 'es', '4ihlZYuEMw', '2016-05-18 22:30:00', '2016-05-18 22:30:00', null);
INSERT INTO `test_users` VALUES ('9', 'AIKEM_President', 'presidenciaataikem-com', 'Shayna', 'Muller', 'presidencia@aikem.com', '$2y$10$S1NTsGWaF/qh74rbn30AP.rbI/mSHeXD5JpktCoGsNO3mee9IMksy', '1', '1', '1', '1', 'West Lisandro', '-29.659687', '-83.932016', '3', '292', null, '1', 'IUfBIikmHFsfW4dDk0cDn2oaZTkt5J', '', 'K9Ty8', 'en', 'Hev8524uY4', '2016-05-18 22:30:00', '2016-05-18 22:30:00', null);
INSERT INTO `test_users` VALUES ('10', 'naucali_President', 'naucaliataikem-com', 'Reginald', 'Bins', 'naucali@aikem.com', '$2y$10$fg3L/kzeiLRBS80OBJ2pDuCYvap8h8Ol3zT0J0bwd.6aaQx/rTZZu', '1', '1', '1', '5', 'East Susannahaven', '33.373852', '160.761447', '4', '729', null, '1', 'wLLxXZjfbncc93nyhCvt3oJfMyziDI', '', 'JZP97', 'es', '7QrryBOnsh', '2016-05-18 22:30:00', '2016-05-18 22:30:00', null);
