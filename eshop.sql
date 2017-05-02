/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50624
 Source Host           : localhost
 Source Database       : eshop

 Target Server Type    : MySQL
 Target Server Version : 50624
 File Encoding         : utf-8

 Date: 05/02/2017 15:45:33 PM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `t_blog`
-- ----------------------------
DROP TABLE IF EXISTS `t_blog`;
CREATE TABLE `t_blog` (
  `blog_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `content` text,
  `add_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`blog_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `t_blog_comment`
-- ----------------------------
DROP TABLE IF EXISTS `t_blog_comment`;
CREATE TABLE `t_blog_comment` (
  `comm_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `content` text,
  `add_time` timestamp NULL DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`comm_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `t_cart`
-- ----------------------------
DROP TABLE IF EXISTS `t_cart`;
CREATE TABLE `t_cart` (
  `cart_id` int(11) NOT NULL AUTO_INCREMENT,
  `prod_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`cart_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `t_category`
-- ----------------------------
DROP TABLE IF EXISTS `t_category`;
CREATE TABLE `t_category` (
  `cate_id` int(11) NOT NULL AUTO_INCREMENT,
  `cate_name` varchar(50) DEFAULT NULL,
  `p_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`cate_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `t_category`
-- ----------------------------
BEGIN;
INSERT INTO `t_category` VALUES ('1', '男士', '0'), ('2', '女士', '0'), ('3', '儿童', '0'), ('4', '上衣', '1'), ('5', '裤子', '1'), ('6', '上衣', '2'), ('7', '裙子', '2'), ('8', '西装', '4'), ('9', '化妆品', '2'), ('10', '眼霜', '9'), ('11', '眼影', '9');
COMMIT;

-- ----------------------------
--  Table structure for `t_order`
-- ----------------------------
DROP TABLE IF EXISTS `t_order`;
CREATE TABLE `t_order` (
  `order_id` int(11) NOT NULL,
  `order_no` varchar(50) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `t_order_item`
-- ----------------------------
DROP TABLE IF EXISTS `t_order_item`;
CREATE TABLE `t_order_item` (
  `item_id` int(11) NOT NULL AUTO_INCREMENT,
  `prod_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `t_product`
-- ----------------------------
DROP TABLE IF EXISTS `t_product`;
CREATE TABLE `t_product` (
  `prod_id` int(11) NOT NULL AUTO_INCREMENT,
  `prod_name` varchar(100) DEFAULT NULL,
  `prod_price` float(8,2) DEFAULT NULL,
  `description` text,
  `cate_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`prod_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `t_product`
-- ----------------------------
BEGIN;
INSERT INTO `t_product` VALUES ('1', 'BELLE B&W', '187.95', '11111', '7'), ('2', 'CLUBYORK', '187.95', '22222', '7'), ('3', 'ROADSTER', '220.95', '33333', '6'), ('4', 'BLACKFLPS', '150.95', '44444', '10'), ('5', 'RED CHECKS', '140.95', '55555', '11'), ('6', 'NEW LOOK', '100.00', '6666', '11'), ('7', 'aaaa', '133.00', '7777', '4'), ('8', 'bbbb', '123.00', '8888', '4'), ('9', 'cccc', '222.00', '9999', '4'), ('10', 'ddd', '333.00', '93837', '8');
COMMIT;

-- ----------------------------
--  Table structure for `t_product_comment`
-- ----------------------------
DROP TABLE IF EXISTS `t_product_comment`;
CREATE TABLE `t_product_comment` (
  `comm_id` int(11) NOT NULL AUTO_INCREMENT,
  `comm_content` text,
  `comm_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`comm_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `t_product_img`
-- ----------------------------
DROP TABLE IF EXISTS `t_product_img`;
CREATE TABLE `t_product_img` (
  `img_id` int(11) NOT NULL AUTO_INCREMENT,
  `img_title` varchar(255) DEFAULT NULL,
  `img_src` varchar(255) DEFAULT NULL COMMENT '大图路径',
  `thumb_img_src` varchar(255) DEFAULT NULL COMMENT '缩略图路径',
  `is_main` varchar(1) DEFAULT '0' COMMENT '1：主图',
  `prod_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`img_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `t_product_img`
-- ----------------------------
BEGIN;
INSERT INTO `t_product_img` VALUES ('1', '1111', 'uploads/products/bs1.jpg', 'uploads/products/bs1.jpg', '1', '1'), ('2', '2222', 'uploads/products/bs2.jpg', 'uploads/products/bs2.jpg', '1', '2'), ('3', '3333', 'uploads/products/bs3.jpg', 'uploads/products/bs3.jpg', '1', '3'), ('4', '4444', 'uploads/products/ab1.jpg', 'uploads/products/ab1.jpg', '0', '1'), ('5', '5555', 'uploads/products/bs4.jpg', 'uploads/products/bs4.jpg', '1', '4'), ('6', '6666', 'uploads/products/bs5.jpg', 'uploads/products/bs5.jpg', '1', '5'), ('7', '7777', 'uploads/products/bs6.jpg', 'uploads/products/bs6.jpg', '1', '6'), ('8', '8888', 'uploads/products/m1.jpg', 'uploads/products/m1.jpg', '1', '7'), ('9', '9999', 'uploads/products/m2.jpg', 'uploads/products/m2.jpg', '1', '8'), ('10', '101010', 'uploads/products/m3.jpg', 'uploads/products/m3.jpg', '1', '9'), ('11', '111122', 'uploads/products/m3.jpg', 'uploads/products/m3.jpg', '1', '10');
COMMIT;

-- ----------------------------
--  Table structure for `t_product_tag`
-- ----------------------------
DROP TABLE IF EXISTS `t_product_tag`;
CREATE TABLE `t_product_tag` (
  `prod_tag_id` int(11) NOT NULL AUTO_INCREMENT,
  `prod_id` int(11) DEFAULT NULL,
  `tag_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`prod_tag_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `t_product_tag`
-- ----------------------------
BEGIN;
INSERT INTO `t_product_tag` VALUES ('1', '3', '1'), ('2', '3', '2'), ('3', '5', '1'), ('4', '9', '1');
COMMIT;

-- ----------------------------
--  Table structure for `t_tag`
-- ----------------------------
DROP TABLE IF EXISTS `t_tag`;
CREATE TABLE `t_tag` (
  `tag_id` int(11) NOT NULL AUTO_INCREMENT,
  `tag_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`tag_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `t_tag`
-- ----------------------------
BEGIN;
INSERT INTO `t_tag` VALUES ('1', '潮人推荐'), ('2', '免税商品');
COMMIT;

-- ----------------------------
--  Table structure for `t_user`
-- ----------------------------
DROP TABLE IF EXISTS `t_user`;
CREATE TABLE `t_user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `tel` varchar(50) DEFAULT NULL,
  `portrait` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `t_user`
-- ----------------------------
BEGIN;
INSERT INTO `t_user` VALUES ('1', 'lisi', 'admin', 'lisi@163.com', '123456', null);
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
