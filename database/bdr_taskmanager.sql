/*
 Navicat Premium Data Transfer

 Source Server         : local
 Source Server Type    : MySQL
 Source Server Version : 50631
 Source Host           : localhost
 Source Database       : bdr_taskmanager

 Target Server Type    : MySQL
 Target Server Version : 50631
 File Encoding         : utf-8

 Date: 01/31/2018 22:44:43 PM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `todo`
-- ----------------------------
DROP TABLE IF EXISTS `todo`;
CREATE TABLE `todo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `description` text,
  `order` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `todo`
-- ----------------------------
BEGIN;
INSERT INTO `todo` VALUES ('1', 'teste 02', 'teste 02', '1'), ('5', 'teste 01', 'teste 01', '0'), ('28', 'teste 03', 'teste 03', '2'), ('47', 'teste 05', 'teste 05', '4'), ('48', 'teste 04', 'teste 04', '3');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
