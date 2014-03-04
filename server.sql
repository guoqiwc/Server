/*
Navicat MySQL Data Transfer

Source Server         : www.symenty.com
Source Server Version : 50532
Source Host           : www.symenty.com:3306
Source Database       : symentyc_server

Target Server Type    : MYSQL
Target Server Version : 50532
File Encoding         : 65001

Date: 2014-03-04 23:35:33
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
  `index` int(10) unsigned DEFAULT NULL COMMENT '没用的索引',
  `time` bigint(20) unsigned DEFAULT NULL COMMENT '时间戳',
  `title` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `image_url` varchar(255) COLLATE utf8_bin DEFAULT NULL COMMENT '图片地址',
  `image_width` int(5) unsigned DEFAULT NULL COMMENT '图片宽度',
  `image_height` int(5) unsigned DEFAULT NULL COMMENT '图片高度',
  `context` text COLLATE utf8_bin COMMENT '广播内容',
  `link` varchar(255) COLLATE utf8_bin DEFAULT NULL COMMENT '超链接地址',
  PRIMARY KEY (`id`),
  KEY `index_language_time` (`language`,`time`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of t_broadcast
-- ----------------------------
INSERT INTO `t_broadcast` VALUES ('1', 'zh-CN', '0', '1', '第一张图片', '?name=1.jpg', '109', '119', 0xE68891E698AFE7ACACE4B880E5BCA0E59BBEE78987E38082, 'www.symenty.com');
INSERT INTO `t_broadcast` VALUES ('2', 'en-US', '0', '2', 'SB Guolaoshi', '?name=1.jpg', '109', '119', 0x4920616D204F6E65205069632E204655434B43594F55EFBC81, 'www.symenty.com');
INSERT INTO `t_broadcast` VALUES ('3', 'zh-CN', '1', '3', '第二张图片', '?name=2.jpg', '153', '99', 0xE68891E698AFE7ACACE4BA8CE5BCA0E59BBEE78987E38082, 'www.symenty.com');
INSERT INTO `t_broadcast` VALUES ('4', 'en-US', '1', '4', 'Fuck LYJ', '?name=2.jpg', '153', '99', 0x4920616D2054776F205069632E204920616D20746865204B494E47EFBC81, 'www.symenty.com');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of t_error
-- ----------------------------

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of t_loading_page
-- ----------------------------
INSERT INTO `t_loading_page` VALUES ('1', 'zh-CN', '0', 0xE5A682E69E9CE4BDA0E5969CE6ACA2E5AE83EFBC8CE8AEB0E5BE97E68EA8E88D90E7BB99E585B6E4BB96E4BABAE593A67E);
INSERT INTO `t_loading_page` VALUES ('2', 'zh-CN', '1', 0xE5A5BDE4B985E4B88DE8A781EFBC8CE4BDA0E698AFE4B88DE698AFE58EBBE68BAFE69591E585A8E4BABAE7B1BBE595A6EFBC9F);
INSERT INTO `t_loading_page` VALUES ('3', 'en-US', '0', 0x496620596F75204C6F76652049742C205265636F6D6D656E6420746F204F746865722050656F706C657E);
INSERT INTO `t_loading_page` VALUES ('4', 'en-US', '1', 0x576865726520796F7520676F696E67204861683F20546F20536176652068756D616E6974793F);
INSERT INTO `t_loading_page` VALUES ('5', 'zh-CN', '2', 0xE5A682E69E9CE4BDA0E883BDE683B3E588B0EFBC8CE4BDA0E5B0B1E883BDE5819AE588B0EFBC81);
INSERT INTO `t_loading_page` VALUES ('6', 'zh-CN', '3', 0xE4BBBBE4BD95E79A84E99990E588B6EFBC8CE983BDE698AFE4BB8EE887AAE5B7B1E79A84E58685E5BF83E5BC80E5A78BE79A84E38082);
INSERT INTO `t_loading_page` VALUES ('7', 'en-US', '2', 0x496620596F752043616E20447265616D2049742C20596F752043616E20446F2049742E0A);
INSERT INTO `t_loading_page` VALUES ('8', 'en-US', '3', 0x416E79205265737472696374696F6E732C204172652066726F6D2048697320486561727420426567616E2E);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of t_login
-- ----------------------------

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
  `time` varchar(20) COLLATE utf8_bin DEFAULT NULL COMMENT '时间戳',
  `launch_after_boot` tinyint(1) unsigned DEFAULT NULL COMMENT '类型',
  `default_path` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `color_type` int(2) DEFAULT NULL COMMENT '颜色值',
  `language` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '加载语言',
  `load_over_time` int(10) DEFAULT NULL,
  `load_refresh_time` int(10) DEFAULT NULL,
  `color_bee_level` int(10) DEFAULT NULL,
  `color_bee_size` int(10) DEFAULT NULL,
  `palette_hue_level` int(10) DEFAULT NULL,
  `palette_saturation_level` int(10) DEFAULT NULL,
  `palette_brightness_level` int(10) DEFAULT NULL,
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
  KEY `language_index` (`language`,`index`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of t_title
-- ----------------------------
INSERT INTO `t_title` VALUES ('1', 'zh-CN', '0', 0xE588ABE7A2B0E8AEBEE8AEA1E5B888E79A84E698BEE7A4BAE599A8EFBC81);
INSERT INTO `t_title` VALUES ('2', 'zh-CN', '1', 0xE6AF8FE4B8AAE88BA6E980BCE79A84E8AEBEE8AEA1E5B888E8838CE5908EE983BDE69C89E4B880E7BEA4E68C87E782B9E6B19FE5B1B1E79A84E98097E6AF94);
INSERT INTO `t_title` VALUES ('3', 'en-US', '0', 0x446F6E277420546F75636820417274204469726563746F7273204D6F6E69746F7221);
INSERT INTO `t_title` VALUES ('4', 'en-US', '1', 0x486F6F766572696E6720417274204469726563746F72732E2E2E);
INSERT INTO `t_title` VALUES ('5', 'zh-CN', '2', 0xE4BDA0E6898DE7BE8EE5B7A5EFBC8CE4BDA0E4BBACE585A8E5AEB6E983BDE698AFE7BE8EE5B7A5EFBC81);
INSERT INTO `t_title` VALUES ('6', 'en-US', '2', 0x486F6F766572696E6720417274204469726563746F72732E2E2E);
INSERT INTO `t_title` VALUES ('7', 'zh-CN', '3', 0xE8AEBEE8AEA1E698AFE7A9BAEFBC8CE7A9BAE698AFE8AEBEE8AEA1EFBC81);
INSERT INTO `t_title` VALUES ('8', 'en-US', '3', 0x466F6C6C6F7720596F7572204865617274);

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
