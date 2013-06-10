-- Adminer 3.7.0 MySQL dump

SET NAMES utf8;
SET foreign_key_checks = 0;
SET time_zone = '+00:00';
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP DATABASE IF EXISTS `heroku_30763ce34eaaa50`;
CREATE DATABASE `heroku_30763ce34eaaa50` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `heroku_30763ce34eaaa50`;

CREATE TABLE `favorite_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` bigint(20) DEFAULT NULL,
  `username` varchar(1024) DEFAULT NULL,
  `itemid` bigint(20) DEFAULT NULL,
  `topicid` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `item_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `posttime` bigint(20) DEFAULT NULL,
  `updatetime` bigint(20) DEFAULT NULL,
  `topicid` bigint(20) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `name` varchar(1024) DEFAULT NULL,
  `images` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `phone` varchar(15) DEFAULT NULL,
  `address` varchar(1024) DEFAULT NULL,
  `detail` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `username` varchar(100) DEFAULT NULL,
  `userid` varchar(100) DEFAULT NULL,
  `situation` varchar(1024) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `categoryname` varchar(100) DEFAULT NULL,
  `categoryid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Bảng lưu các thông tin phụ cho một lời rao trên MGOD - ver 1';


-- 2013-06-10 06:42:58
