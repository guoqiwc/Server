/*
Navicat MySQL Data Transfer

Source Server         : Guolaoshi
Source Server Version : 50535
Source Host           : localhost:3306
Source Database       : server

Target Server Type    : MYSQL
Target Server Version : 50535
File Encoding         : 65001

Date: 2014-02-22 22:02:33
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for t_login
-- ----------------------------
DROP TABLE IF EXISTS `t_login`;
CREATE TABLE `t_login` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `mac` varchar(60) COLLATE utf8_bin DEFAULT NULL,
  `ip` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `os` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `version` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `time` bigint(20) DEFAULT NULL,
  `login` bit(1) DEFAULT NULL COMMENT '1为登陆 0为退出',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of t_login
-- ----------------------------
