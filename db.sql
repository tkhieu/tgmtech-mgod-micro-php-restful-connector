-- Adminer 3.6.4 MySQL dump

SET NAMES utf8;
SET foreign_key_checks = 0;
SET time_zone = '+07:00';
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `item_info`;
CREATE TABLE `item_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `posttime` bigint(20) DEFAULT NULL,
  `updatetime` bigint(20) DEFAULT NULL,
  `topicid` bigint(20) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `name` varchar(1024) DEFAULT NULL,
  `images` text CHARACTER SET ascii,
  `phone` varchar(15) DEFAULT NULL,
  `address` varchar(1024) DEFAULT NULL,
  `detail` text,
  `username` varchar(100) DEFAULT NULL,
  `userid` varchar(100) DEFAULT NULL,
  `situation` varchar(1024) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `categoryname` varchar(100) DEFAULT NULL,
  `categoryid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COMMENT='Bảng lưu các thông tin phụ cho một lời rao trên MGOD - ver 1';


-- 2013-05-17 16:07:49
