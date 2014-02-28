/*
Navicat MySQL Data Transfer

Source Server         : Guolaoshi
Source Server Version : 50535
Source Host           : localhost:3306
Source Database       : server

Target Server Type    : MYSQL
Target Server Version : 50535
File Encoding         : 65001

Date: 2014-02-28 17:49:18
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for t_about_window_b
-- ----------------------------
DROP TABLE IF EXISTS `t_about_window_b`;
CREATE TABLE `t_about_window_b` (
  `id` int(10) unsigned NOT NULL,
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
  `id` int(10) unsigned NOT NULL,
  `ip` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `mac` varchar(60) COLLATE utf8_bin DEFAULT NULL,
  `type` tinyint(5) unsigned DEFAULT NULL COMMENT '类型',
  `state` tinyint(5) DEFAULT NULL,
  `time` varchar(20) COLLATE utf8_bin DEFAULT NULL COMMENT '时间戳',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

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
  `time` bigint(20) unsigned DEFAULT NULL,
  `error_message` text COLLATE utf8_bin COMMENT '错误信息',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of t_error
-- ----------------------------

-- ----------------------------
-- Table structure for t_help_window_b
-- ----------------------------
DROP TABLE IF EXISTS `t_help_window_b`;
CREATE TABLE `t_help_window_b` (
  `id` int(10) unsigned NOT NULL,
  `ip` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `mac` varchar(60) COLLATE utf8_bin DEFAULT NULL,
  `check_lanuch` tinyint(1) unsigned DEFAULT NULL,
  `time` bigint(20) unsigned DEFAULT NULL,
  `hold_time_list` text COLLATE utf8_bin COMMENT '字符串形式的列表',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of t_help_window_b
-- ----------------------------

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
  `time` bigint(20) unsigned DEFAULT NULL,
  `login` tinyint(1) unsigned DEFAULT NULL COMMENT '1为登陆 0为退出',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of t_login
-- ----------------------------

-- ----------------------------
-- Table structure for t_main_window_b
-- ----------------------------
DROP TABLE IF EXISTS `t_main_window_b`;
CREATE TABLE `t_main_window_b` (
  `id` int(10) unsigned NOT NULL,
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
  `id` int(10) unsigned NOT NULL,
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
  `id` int(10) unsigned NOT NULL,
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
