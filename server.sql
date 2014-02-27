/*
Navicat MySQL Data Transfer

Source Server         : Guolaoshi
Source Server Version : 50535
Source Host           : localhost:3306
Source Database       : server

Target Server Type    : MYSQL
Target Server Version : 50535
File Encoding         : 65001

Date: 2014-02-27 20:52:56
*/

SET FOREIGN_KEY_CHECKS=0;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of t_broadcast
-- ----------------------------

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
