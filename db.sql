/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : anhmh

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2018-03-02 18:09:10
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for admins
-- ----------------------------
DROP TABLE IF EXISTS `admins`;
CREATE TABLE `admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '管理者ID',
  `name` varchar(40) NOT NULL COMMENT '管理者名',
  `email` varchar(40) NOT NULL COMMENT 'forLoginID',
  `password` varchar(255) NOT NULL COMMENT 'パスワード',
  `admin_type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0:culator,1:admin',
  `disable` tinyint(1) NOT NULL DEFAULT '0' COMMENT '削除フラグ',
  `created` int(11) DEFAULT NULL COMMENT '作成日',
  `updated` int(11) DEFAULT NULL COMMENT '更新日',
  PRIMARY KEY (`id`),
  KEY `id` (`id`,`email`,`password`,`disable`),
  KEY `admin_type` (`id`,`admin_type`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='Admins master';

-- ----------------------------
-- Records of admins
-- ----------------------------

-- ----------------------------
-- Table structure for authenticates
-- ----------------------------
DROP TABLE IF EXISTS `authenticates`;
CREATE TABLE `authenticates` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '`user_id/admin_id base on type',
  `token` varchar(255) NOT NULL DEFAULT '' COMMENT 'トークン',
  `expire_date` int(11) NOT NULL DEFAULT '0' COMMENT 'トークンの期限',
  `regist_type` varchar(20) NOT NULL DEFAULT '' COMMENT 'user/admin',
  `created` int(11) DEFAULT NULL COMMENT '作成日',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=148 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of authenticates
-- ----------------------------

-- ----------------------------
-- Function structure for abc
-- ----------------------------
DROP FUNCTION IF EXISTS `abc`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `abc`(`a` INT(1)) RETURNS int(11)
    NO SQL
return 1
;;
DELIMITER ;
DROP TRIGGER IF EXISTS `before_insert_admins`;
DELIMITER ;;
CREATE TRIGGER `before_insert_admins` BEFORE INSERT ON `admins` FOR EACH ROW SET 
	new.created = UNIX_TIMESTAMP(),
	new.updated = UNIX_TIMESTAMP()
;;
DELIMITER ;
DROP TRIGGER IF EXISTS `before_update_admins`;
DELIMITER ;;
CREATE TRIGGER `before_update_admins` BEFORE UPDATE ON `admins` FOR EACH ROW SET 
             new.updated = UNIX_TIMESTAMP()
;;
DELIMITER ;
DROP TRIGGER IF EXISTS `before_insert_authenticates`;
DELIMITER ;;
CREATE TRIGGER `before_insert_authenticates` BEFORE INSERT ON `authenticates` FOR EACH ROW SET 

	new.created = UNIX_TIMESTAMP()
;;
DELIMITER ;
