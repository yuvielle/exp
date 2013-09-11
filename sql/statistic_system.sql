/*
Navicat MySQL Data Transfer

Source Server         : local_mysql
Source Server Version : 50523
Source Host           : localhost:3306
Source Database       : statistic_system

Target Server Type    : MYSQL
Target Server Version : 50523
File Encoding         : 65001

Date: 2013-09-11 13:24:26
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `ss_request`
-- ----------------------------
DROP TABLE IF EXISTS `ss_request`;
CREATE TABLE `ss_request` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(255) DEFAULT NULL,
  `ip` varchar(15) DEFAULT NULL,
  `comment` text,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ss_request
-- ----------------------------
INSERT INTO `ss_request` VALUES ('1', 'http://test.test.ru', '255.255.255.98', 'test record', '2013-09-11 00:10:15');
INSERT INTO `ss_request` VALUES ('2', 'http//test.uuu.ru', '255.243.123.34', 'two test record', '0000-00-00 00:00:00');
INSERT INTO `ss_request` VALUES ('3', 'http://test.test.ru', '123.213.122.11', 'three test record', '0000-00-00 00:00:00');
