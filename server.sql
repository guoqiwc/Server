/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50535
Source Host           : localhost:3306
Source Database       : server

Target Server Type    : MYSQL
Target Server Version : 50535
File Encoding         : 65001

Date: 2014-03-01 01:40:59
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for t_about_window_b
-- ----------------------------
DROP TABLE IF EXISTS `t_about_window_b`;
CREATE TABLE `t_about_window_b` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ip` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `mac` varchar(60) COLLATE utf8_bin DEFAULT NULL,
  `type` tinyint(5) unsigned DEFAULT NULL COMMENT '类型',
  `time` varchar(20) COLLATE utf8_bin DEFAULT NULL COMMENT '时间戳',
  `state` tinyint(1) DEFAULT NULL COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of t_about_window_b
-- ----------------------------

-- ----------------------------
-- Table structure for t_all_window_b
-- ----------------------------
DROP TABLE IF EXISTS `t_all_window_b`;
CREATE TABLE `t_all_window_b` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ip` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `mac` varchar(60) COLLATE utf8_bin DEFAULT NULL,
  `type` tinyint(5) unsigned DEFAULT NULL COMMENT '类型',
  `duration` int(10) DEFAULT NULL,
  `time` varchar(20) COLLATE utf8_bin DEFAULT NULL COMMENT '时间戳',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of t_all_window_b
-- ----------------------------

-- ----------------------------
-- Table structure for t_broadcast
-- ----------------------------
DROP TABLE IF EXISTS `t_broadcast`;
CREATE TABLE `t_broadcast` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `language` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `index` int(10) unsigned DEFAULT NULL COMMENT '索引',
  `time` bigint(20) unsigned DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `image_url` varchar(255) COLLATE utf8_bin DEFAULT NULL COMMENT '图片地址',
  `image_width` int(5) unsigned DEFAULT NULL COMMENT '图片宽度',
  `image_height` int(5) unsigned DEFAULT NULL COMMENT '图片高度',
  `context` text COLLATE utf8_bin COMMENT '广播内容',
  `link` varchar(255) COLLATE utf8_bin DEFAULT NULL COMMENT '超链接地址',
  PRIMARY KEY (`id`),
  KEY `index_language_time` (`language`,`time`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of t_broadcast
-- ----------------------------
INSERT INTO `t_broadcast` VALUES ('1', 'CN', '0', '1', '1', '1', '1', '1', 0x31, '1');
INSERT INTO `t_broadcast` VALUES ('2', 'EN', '0', '2', '2', '2', '2', '2', 0x32, '2');
INSERT INTO `t_broadcast` VALUES ('3', 'CN', '1', '3', '3', '3', '3', '3', 0x33, '3');
INSERT INTO `t_broadcast` VALUES ('4', 'CN', '2', '5', '4', '4', '4', '4', 0x34, '4');
INSERT INTO `t_broadcast` VALUES ('5', 'EN', '1', '4', '5', '5', '5', '5', 0x35, '5');
INSERT INTO `t_broadcast` VALUES ('6', 'CN', '3', '6', '6', '6', '6', '6', 0x36, '6');
INSERT INTO `t_broadcast` VALUES ('7', 'JP', '0', '4', '4', '4', '4', '4', 0x34, '4');
INSERT INTO `t_broadcast` VALUES ('8', 'JP', '1', '3', '3', '3', '3', '3', 0x33, '3');

-- ----------------------------
-- Table structure for t_error
-- ----------------------------
DROP TABLE IF EXISTS `t_error`;
CREATE TABLE `t_error` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `mac` varchar(60) COLLATE utf8_bin DEFAULT NULL,
  `ip` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `os` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `version` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `time` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `error_message` text COLLATE utf8_bin COMMENT '错误信息',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of t_error
-- ----------------------------
INSERT INTO `t_error` VALUES ('1', '1', 'C0-F8-DA-BE-38-D0', '192.168.1.102', 'Windows 8', 'v 2.0.4', '144795ea4ea', 0x547970654572726F723A204572726F722023313030390A0961742066756E6374696F6E732E6170706C69636174696F6E506167652E68656C7057696E646F772E766965773A3A48656C7057696E646F774D65646961746F722F6F6E436C6F73656448616E646C657228290A0961742046756E6374696F6E2F534457696E646F772E617324303A616E6F6E796D6F757328290A09617420636F6D2E677265656E736F636B2E636F72653A3A547765656E436F72652F636F6D706C65746528290A09617420636F6D2E677265656E736F636B3A3A547765656E4C6974652F72656E64657254696D6528290A09617420636F6D2E677265656E736F636B2E636F72653A3A53696D706C6554696D656C696E652F72656E64657254696D6528290A09617420636F6D2E677265656E736F636B3A3A547765656E4C697465242F757064617465416C6C2829);

-- ----------------------------
-- Table structure for t_help_window_b
-- ----------------------------
DROP TABLE IF EXISTS `t_help_window_b`;
CREATE TABLE `t_help_window_b` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ip` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `mac` varchar(60) COLLATE utf8_bin DEFAULT NULL,
  `check_lanuch` tinyint(1) unsigned DEFAULT NULL,
  `time` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `hold_time_list` text COLLATE utf8_bin COMMENT '字符串形式的列表',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of t_help_window_b
-- ----------------------------
INSERT INTO `t_help_window_b` VALUES ('1', '192.168.1.102', 'C0-F8-DA-BE-38-D0', '0', '14479656011', 0x33363439263131363126373730263633352631343330263138323926);
INSERT INTO `t_help_window_b` VALUES ('2', '192.168.1.102', 'C0-F8-DA-BE-38-D0', '0', '14479670cee', 0x323735312635303526363432263630312631323839263026);
INSERT INTO `t_help_window_b` VALUES ('3', '192.168.1.102', 'C0-F8-DA-BE-38-D0', '0', '1447967d40f', 0x3430323226302631333632263026373033263026);
INSERT INTO `t_help_window_b` VALUES ('4', '192.168.1.102', 'C0-F8-DA-BE-38-D0', '0', '1447969aa91', 0x333330382630263026302630263026);
INSERT INTO `t_help_window_b` VALUES ('5', '192.168.1.102', 'C0-F8-DA-BE-38-D0', '0', '144796a897a', 0x333330352630263026302630263026);
INSERT INTO `t_help_window_b` VALUES ('6', '192.168.1.102', 'C0-F8-DA-BE-38-D0', '0', '144796b4206', 0x333339362630263026302630263026);
INSERT INTO `t_help_window_b` VALUES ('7', '192.168.1.102', 'C0-F8-DA-BE-38-D0', '0', '144796baabf', 0x343238372630263026302630263026);
INSERT INTO `t_help_window_b` VALUES ('8', '192.168.1.102', 'C0-F8-DA-BE-38-D0', '0', '144796c6b51', 0x323830332630263026302630263026);
INSERT INTO `t_help_window_b` VALUES ('9', '192.168.1.102', 'C0-F8-DA-BE-38-D0', '0', '144796ccf77', 0x323837362630263026302630263026);
INSERT INTO `t_help_window_b` VALUES ('10', '192.168.1.102', 'C0-F8-DA-BE-38-D0', '0', '144796d6a7f', 0x333134302630263026302630263026);
INSERT INTO `t_help_window_b` VALUES ('11', '192.168.1.102', 'C0-F8-DA-BE-38-D0', '0', '144796e5123', 0x343830382630263026302630263026);
INSERT INTO `t_help_window_b` VALUES ('12', '192.168.1.102', '', '0', '\0144796f6122\0C0-F8-', 0x333031342630263026302630263026);
INSERT INTO `t_help_window_b` VALUES ('13', '192.168.1.102', '', '0', '\014479703547\0C0-F8-', 0x353133352630263026302630263026);
INSERT INTO `t_help_window_b` VALUES ('14', '192.168.1.102', 'C0-F8-DA-BE-38-D0', '0', '14479711e9d', 0x333331342630263026302630263026);
INSERT INTO `t_help_window_b` VALUES ('15', '192.168.1.102', '', '0', '\014479747187\0C0-F8-', 0x333336322630263026302630263026);
INSERT INTO `t_help_window_b` VALUES ('16', '192.168.1.102', '', '0', '\014479752b89\0C0-F8-', 0x333330312630263026302630263026);
INSERT INTO `t_help_window_b` VALUES ('17', '192.168.1.102', 'C0-F8-DA-BE-38-D0', '0', '144797575c7', 0x323934352630263026302630263026);
INSERT INTO `t_help_window_b` VALUES ('18', '192.168.1.102', 'C0-F8-DA-BE-38-D0', '0', '1447975d00c', 0x323937352630263026302630263026);
INSERT INTO `t_help_window_b` VALUES ('19', '192.168.1.102', 'C0-F8-DA-BE-38-D0', '0', '14479761bc5', 0x333433302630263026302630263026);
INSERT INTO `t_help_window_b` VALUES ('20', '192.168.1.102', 'C0-F8-DA-BE-38-D0', '0', '1447977e38f', 0x393637362630263026302630263026);
INSERT INTO `t_help_window_b` VALUES ('21', '192.168.1.102', 'C0-F8-DA-BE-38-D0', '0', '1447979b64a', 0x31313637322634373231263026302630263026);
INSERT INTO `t_help_window_b` VALUES ('22', '192.168.1.102', 'C0-F8-DA-BE-38-D0', '0', '144797a9b28', 0x333433342630263026302630263026);
INSERT INTO `t_help_window_b` VALUES ('23', '192.168.1.102', 'C0-F8-DA-BE-38-D0', '0', '144797b10ff', 0x343030382630263026302630263026);
INSERT INTO `t_help_window_b` VALUES ('24', '192.168.1.102', 'C0-F8-DA-BE-38-D0', '1', '144797b6e8b', 0x333932312630263026302630263026);
INSERT INTO `t_help_window_b` VALUES ('25', '192.168.1.102', 'C0-F8-DA-BE-38-D0', '1', '144797bcf9f', 0x333138342630263026302630263026);
INSERT INTO `t_help_window_b` VALUES ('26', '192.168.1.102', 'C0-F8-DA-BE-38-D0', '1', '144797c0d5f', 0x343036332630263026302630263026);
INSERT INTO `t_help_window_b` VALUES ('27', '192.168.1.102', 'C0-F8-DA-BE-38-D0', '1', '144797d5232', 0x31313136342630263026302630263026);
INSERT INTO `t_help_window_b` VALUES ('28', '192.168.1.102', 'C0-F8-DA-BE-38-D0', '1', '144797d7b55', 0x32313639362630263026302630263026);
INSERT INTO `t_help_window_b` VALUES ('29', '192.168.1.102', 'C0-F8-DA-BE-38-D0', '1', '144797e0b80', 0x363137352630263026302630263026);
INSERT INTO `t_help_window_b` VALUES ('30', '192.168.1.102', 'C0-F8-DA-BE-38-D0', '1', '144797e9ddc', 0x363937352630263026302630263026);
INSERT INTO `t_help_window_b` VALUES ('31', '192.168.1.102', 'C0-F8-DA-BE-38-D0', '1', '144797f85f8', 0x31313137392630263026302630263026);
INSERT INTO `t_help_window_b` VALUES ('32', '192.168.1.102', 'C0-F8-DA-BE-38-D0', '0', '1447980a6c6', 0x31323839382630263026302630263026);
INSERT INTO `t_help_window_b` VALUES ('33', '192.168.1.102', 'C0-F8-DA-BE-38-D0', '0', '14479820b24', 0x383737332630263026302630263026);
INSERT INTO `t_help_window_b` VALUES ('34', '192.168.1.102', 'C0-F8-DA-BE-38-D0', '7', '14479826463', 0x333134382630263026302630263026);
INSERT INTO `t_help_window_b` VALUES ('35', '192.168.1.102', 'C0-F8-DA-BE-38-D0', '0', '1447983c832', 0x333335302630263026302630263026);
INSERT INTO `t_help_window_b` VALUES ('36', '192.168.1.102', 'C0-F8-DA-BE-38-D0', '123', '14479842ae9', 0x333035312630263026302630263026);
INSERT INTO `t_help_window_b` VALUES ('37', '192.168.1.102', 'C0-F8-DA-BE-38-D0', '1', '1447989cc37', 0x3131363830263130303137263433323226302630263026);

-- ----------------------------
-- Table structure for t_loading_page
-- ----------------------------
DROP TABLE IF EXISTS `t_loading_page`;
CREATE TABLE `t_loading_page` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `language` varchar(10) COLLATE utf8_bin DEFAULT '',
  `index` int(10) unsigned DEFAULT '0',
  `content` text COLLATE utf8_bin,
  PRIMARY KEY (`id`),
  KEY `index_language` (`language`),
  KEY `index_language_index` (`language`,`index`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of t_loading_page
-- ----------------------------
INSERT INTO `t_loading_page` VALUES ('1', 'CN', '0', 0x4CE4B880E58FA5);
INSERT INTO `t_loading_page` VALUES ('2', 'CN', '1', 0x4CE4BA8CE58FA5);
INSERT INTO `t_loading_page` VALUES ('3', 'EN', '0', 0x4669727374);
INSERT INTO `t_loading_page` VALUES ('4', 'EN', '1', 0x5365636F6E64);
INSERT INTO `t_loading_page` VALUES ('5', 'CN', '2', 0x4CE4B889E58FA5);

-- ----------------------------
-- Table structure for t_login
-- ----------------------------
DROP TABLE IF EXISTS `t_login`;
CREATE TABLE `t_login` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `mac` varchar(60) COLLATE utf8_bin DEFAULT NULL,
  `ip` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `os` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `version` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `time` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `login` tinyint(1) unsigned DEFAULT NULL COMMENT '1为登陆 0为退出',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of t_login
-- ----------------------------
INSERT INTO `t_login` VALUES ('49', '1', 'C0-F8-DA-BE-38-D0', '192.168.1.102', 'Windows 8', 'v 2.0.4', '144795130a6', '1');
INSERT INTO `t_login` VALUES ('50', '1', 'C0-F8-DA-BE-38-D0', '192.168.1.102', 'Windows 8', 'v 2.0.4', '1447954b5bc', '1');
INSERT INTO `t_login` VALUES ('51', '1', 'C0-F8-DA-BE-38-D0', '192.168.1.102', '', '', '1447954c507', '0');
INSERT INTO `t_login` VALUES ('52', '1', 'C0-F8-DA-BE-38-D0', '192.168.1.102', 'Windows 8', 'v 2.0.4', '1447958c7f5', '1');
INSERT INTO `t_login` VALUES ('53', '1', 'C0-F8-DA-BE-38-D0', '192.168.1.102', '', '', '1447959ca2b', '0');
INSERT INTO `t_login` VALUES ('54', '1', 'C0-F8-DA-BE-38-D0', '192.168.1.102', 'Windows 8', 'v 2.0.4', '144795e187c', '1');
INSERT INTO `t_login` VALUES ('55', '1', 'C0-F8-DA-BE-38-D0', '192.168.1.102', '', '', '14479610401', '0');
INSERT INTO `t_login` VALUES ('56', '1', 'C0-F8-DA-BE-38-D0', '192.168.1.102', 'Windows 8', 'v 2.0.4', '1447961497a', '1');
INSERT INTO `t_login` VALUES ('57', '1', 'C0-F8-DA-BE-38-D0', '192.168.1.102', 'Windows 8', 'v 2.0.4', '1447963da35', '1');
INSERT INTO `t_login` VALUES ('58', '1', 'C0-F8-DA-BE-38-D0', '192.168.1.102', 'Windows 8', 'v 2.0.4', '14479653f5b', '1');
INSERT INTO `t_login` VALUES ('59', '1', 'C0-F8-DA-BE-38-D0', '192.168.1.102', 'Windows 8', 'v 2.0.4', '1447966fa9f', '1');
INSERT INTO `t_login` VALUES ('60', '1', 'C0-F8-DA-BE-38-D0', '192.168.1.102', 'Windows 8', 'v 2.0.4', '1447967c070', '1');
INSERT INTO `t_login` VALUES ('61', '1', 'C0-F8-DA-BE-38-D0', '192.168.1.102', 'Windows 8', 'v 2.0.4', '1447969a1cf', '1');
INSERT INTO `t_login` VALUES ('62', '1', 'C0-F8-DA-BE-38-D0', '192.168.1.102', 'Windows 8', 'v 2.0.4', '144796a80dd', '1');
INSERT INTO `t_login` VALUES ('63', '1', 'C0-F8-DA-BE-38-D0', '192.168.1.102', 'Windows 8', 'v 2.0.4', '144796b390a', '1');
INSERT INTO `t_login` VALUES ('64', '1', 'C0-F8-DA-BE-38-D0', '192.168.1.102', 'Windows 8', 'v 2.0.4', '144796b9e21', '1');
INSERT INTO `t_login` VALUES ('65', '1', 'C0-F8-DA-BE-38-D0', '192.168.1.102', 'Windows 8', 'v 2.0.4', '144796c6483', '1');
INSERT INTO `t_login` VALUES ('66', '1', 'C0-F8-DA-BE-38-D0', '192.168.1.102', 'Windows 8', 'v 2.0.4', '144796cc860', '1');
INSERT INTO `t_login` VALUES ('67', '1', 'C0-F8-DA-BE-38-D0', '192.168.1.102', 'Windows 8', 'v 2.0.4', '144796d6296', '1');
INSERT INTO `t_login` VALUES ('68', '1', 'C0-F8-DA-BE-38-D0', '192.168.1.102', 'Windows 8', 'v 2.0.4', '144796da0a9', '1');
INSERT INTO `t_login` VALUES ('69', '1', 'C0-F8-DA-BE-38-D0', '192.168.1.102', 'Windows 8', 'v 2.0.4', '144796e0e09', '1');
INSERT INTO `t_login` VALUES ('70', '1', 'C0-F8-DA-BE-38-D0', '192.168.1.102', 'Windows 8', 'v 2.0.4', '144796e4278', '1');
INSERT INTO `t_login` VALUES ('71', '1', 'C0-F8-DA-BE-38-D0', '192.168.1.102', 'Windows 8', 'v 2.0.4', '144796f5996', '1');
INSERT INTO `t_login` VALUES ('72', '1', 'C0-F8-DA-BE-38-D0', '192.168.1.102', 'Windows 8', 'v 2.0.4', '14479702582', '1');
INSERT INTO `t_login` VALUES ('73', '1', 'C0-F8-DA-BE-38-D0', '192.168.1.102', 'Windows 8', 'v 2.0.4', '144797115dd', '1');
INSERT INTO `t_login` VALUES ('74', '1', 'C0-F8-DA-BE-38-D0', '192.168.1.102', 'Windows 8', 'v 2.0.4', '1447972ff5d', '1');
INSERT INTO `t_login` VALUES ('75', '1', 'C0-F8-DA-BE-38-D0', '192.168.1.102', 'Windows 8', 'v 2.0.4', '1447973bb8f', '1');
INSERT INTO `t_login` VALUES ('76', '1', 'C0-F8-DA-BE-38-D0', '192.168.1.102', 'Windows 8', 'v 2.0.4', '144797468e1', '1');

-- ----------------------------
-- Table structure for t_main_window_b
-- ----------------------------
DROP TABLE IF EXISTS `t_main_window_b`;
CREATE TABLE `t_main_window_b` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ip` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `mac` varchar(60) COLLATE utf8_bin DEFAULT NULL,
  `type` tinyint(5) unsigned DEFAULT NULL COMMENT '类型',
  `time` varchar(20) COLLATE utf8_bin DEFAULT NULL COMMENT '时间戳',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of t_main_window_b
-- ----------------------------

-- ----------------------------
-- Table structure for t_setting_window_b
-- ----------------------------
DROP TABLE IF EXISTS `t_setting_window_b`;
CREATE TABLE `t_setting_window_b` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ip` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `mac` varchar(60) COLLATE utf8_bin DEFAULT NULL,
  `time` bigint(20) unsigned DEFAULT NULL COMMENT '时间戳',
  `launch_after_boot` tinyint(1) unsigned DEFAULT NULL COMMENT '类型',
  `default_path` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `color_type` smallint(2) DEFAULT NULL COMMENT '颜色值',
  `language` varchar(10) COLLATE utf8_bin DEFAULT NULL COMMENT '加载语言',
  `load_over_time` int(10) DEFAULT NULL,
  `load_refresh_time` int(10) DEFAULT NULL,
  `color_bee_level` smallint(10) DEFAULT NULL,
  `color_bee_size` smallint(10) DEFAULT NULL,
  `palette_hue_level` smallint(10) DEFAULT NULL,
  `palette_saturation_level` smallint(10) DEFAULT NULL,
  `palette_brightness_level` smallint(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of t_setting_window_b
-- ----------------------------

-- ----------------------------
-- Table structure for t_suspension_window_b
-- ----------------------------
DROP TABLE IF EXISTS `t_suspension_window_b`;
CREATE TABLE `t_suspension_window_b` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ip` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `mac` varchar(60) COLLATE utf8_bin DEFAULT NULL,
  `type` tinyint(5) unsigned DEFAULT NULL COMMENT '类型',
  `time` varchar(20) COLLATE utf8_bin DEFAULT NULL COMMENT '时间戳',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of t_suspension_window_b
-- ----------------------------

-- ----------------------------
-- Table structure for t_title
-- ----------------------------
DROP TABLE IF EXISTS `t_title`;
CREATE TABLE `t_title` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `language` varchar(10) COLLATE utf8_bin DEFAULT '',
  `index` int(10) unsigned DEFAULT '0',
  `content` text COLLATE utf8_bin,
  PRIMARY KEY (`id`),
  KEY `index_language` (`language`),
  KEY `index_language_index` (`language`,`index`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of t_title
-- ----------------------------
INSERT INTO `t_title` VALUES ('1', 'CN', '0', 0xE7ACACE4B880E58FA5);
INSERT INTO `t_title` VALUES ('2', 'CN', '1', 0xE7ACACE4BA8CE58FA5);
INSERT INTO `t_title` VALUES ('3', 'EN', '0', 0x4669727374);
INSERT INTO `t_title` VALUES ('4', 'EN', '1', 0x5365636F6E64);
INSERT INTO `t_title` VALUES ('5', 'CN', '2', 0xE7ACACE4B889E58FA5);

-- ----------------------------
-- Table structure for t_webshot_b
-- ----------------------------
DROP TABLE IF EXISTS `t_webshot_b`;
CREATE TABLE `t_webshot_b` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ip` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `mac` varchar(60) COLLATE utf8_bin DEFAULT NULL,
  `max_task_num` int(10) unsigned DEFAULT NULL COMMENT '类型',
  `time` varchar(20) COLLATE utf8_bin DEFAULT NULL COMMENT '时间戳',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of t_webshot_b
-- ----------------------------

-- ----------------------------
-- Table structure for t_webshot_window_b
-- ----------------------------
DROP TABLE IF EXISTS `t_webshot_window_b`;
CREATE TABLE `t_webshot_window_b` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ip` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `mac` varchar(60) COLLATE utf8_bin DEFAULT NULL,
  `type` tinyint(5) unsigned DEFAULT NULL COMMENT '类型',
  `time` varchar(20) COLLATE utf8_bin DEFAULT NULL COMMENT '时间戳',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of t_webshot_window_b
-- ----------------------------
