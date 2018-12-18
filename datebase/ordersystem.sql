/*
Navicat MySQL Data Transfer

Source Server         : .
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : ordersystem

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2018-10-30 09:17:04
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `appraise`
-- ----------------------------
DROP TABLE IF EXISTS `appraise`;
CREATE TABLE `appraise` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `content` varchar(1024) DEFAULT NULL COMMENT '评价内容 评价内容',
  `id_appraise` varchar(1024) DEFAULT NULL COMMENT '评价人 评价人',
  `appraisedata` datetime DEFAULT NULL COMMENT '评价时间 评价时间',
  `f_id` varchar(1024) DEFAULT NULL COMMENT '菜品被评价 菜品被评价',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='菜品评价';

-- ----------------------------
-- Records of appraise
-- ----------------------------

-- ----------------------------
-- Table structure for `foodname`
-- ----------------------------
DROP TABLE IF EXISTS `foodname`;
CREATE TABLE `foodname` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `f_name` varchar(1024) DEFAULT NULL COMMENT '名称 名称',
  `f_price` varchar(1024) DEFAULT NULL COMMENT '价格 价格',
  `f_picture` varchar(1024) DEFAULT NULL COMMENT '图片 图片',
  `fs_id` int(11) DEFAULT NULL COMMENT '类别id 类别id',
  `fn_link` varchar(255) DEFAULT NULL,
  `state` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COMMENT='菜品名称';

-- ----------------------------
-- Records of foodname
-- ----------------------------
INSERT INTO `foodname` VALUES ('1', '小炒肉', '10.00', '2886b40a745361f1e170046ddcde1dda.jpg', '1', '/detailsp', null);
INSERT INTO `foodname` VALUES ('2', '竹笋肉丝', '10.00', 'd57ba37bf0da84c91276e05e31a30803.png', '1', '/detailsp', null);
INSERT INTO `foodname` VALUES ('3', '红烧肉', '12.00', '3aa1f10dfd167d9bbc817ae1a60da7a0.jpg', '1', '/detailsp', null);
INSERT INTO `foodname` VALUES ('4', '糖醋里脊', '12.00', '47dc128a8b8b685c107df2d95b391a89.jpg', '1', '/detailsp', null);
INSERT INTO `foodname` VALUES ('5', '蛋炒饭', '8.00', '033715519f3b0781c8384f95edec6cbc.jpg', '2', '/detailsp', null);
INSERT INTO `foodname` VALUES ('6', '牛肉炒饭', '12.00', '4e24ee6086fb58ff0415970574ee185d.jpg', '2', '/detailsp', null);
INSERT INTO `foodname` VALUES ('7', '酸菜肉丝炒饭', '10.00', '0a6d56a22745d28b8975c0eb52c0c054.jpg', '2', '/detailsp', null);
INSERT INTO `foodname` VALUES ('8', '胡萝卜肉丝炒饭', '10.00', '818629d1b00acfeb616c92ff989d350d.jpg', '2', '/detailsp', null);
INSERT INTO `foodname` VALUES ('9', '香辣干锅排骨', '48.00', '33c1d74143f7e7102192501787098198.png', '4', '/detailsp', null);
INSERT INTO `foodname` VALUES ('10', '干锅鸡', '48.00', '20fbad5914a851e57ec25091e785b1c5.jpg', '4', '/detailsp', null);
INSERT INTO `foodname` VALUES ('11', '干锅兔', '48.00', '19e481acb25c48ceef36b3a75b5dec53.jpg', '4', '/detailsp', null);
INSERT INTO `foodname` VALUES ('12', '干锅鱿鱼', '58.00', 'a28ebd52f292a7887f77e96c6146ad66.jpg', '4', '/detailsp', null);
INSERT INTO `foodname` VALUES ('13', '牛肉小火锅', '58.00', 'aca10f4796ae2220f81c5f43dd139dc5.jpg', '15', '/detailsp', null);
INSERT INTO `foodname` VALUES ('14', '鸡肉小火锅', '48.00', '2065fad6f674451e111a345479b886ec.jpg', '15', '/detailsp', null);
INSERT INTO `foodname` VALUES ('15', '鱿鱼小火锅', '58.00', '3618af871c32162c7b20f93746f5caaf.jpg', '15', '/detailsp', null);
INSERT INTO `foodname` VALUES ('16', '肥肠小火锅', '58.00', 'd5dccea8c821ffeac49d60fc670183f0.jpg', '15', '/detailsp', null);

-- ----------------------------
-- Table structure for `foodsort`
-- ----------------------------
DROP TABLE IF EXISTS `foodsort`;
CREATE TABLE `foodsort` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `foodname` varchar(1024) DEFAULT NULL COMMENT '菜品分类 菜品分类',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COMMENT='菜品类别';

-- ----------------------------
-- Records of foodsort
-- ----------------------------
INSERT INTO `foodsort` VALUES ('1', '盖饭');
INSERT INTO `foodsort` VALUES ('2', '炒饭');
INSERT INTO `foodsort` VALUES ('4', '干锅类');
INSERT INTO `foodsort` VALUES ('15', '小火锅');

-- ----------------------------
-- Table structure for `leave`
-- ----------------------------
DROP TABLE IF EXISTS `leave`;
CREATE TABLE `leave` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` varchar(1024) DEFAULT NULL,
  `leavedata` date DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of leave
-- ----------------------------
INSERT INTO `leave` VALUES ('12', 'asdfghjk', '2018-10-25', '1');
INSERT INTO `leave` VALUES ('15', 'waqderftgjhukl', '2018-10-25', '1');
INSERT INTO `leave` VALUES ('18', 'axds', '2018-10-30', '1');
INSERT INTO `leave` VALUES ('19', 'sawsdefrgtyjhukl\';lgdfrsfl;khfgd', '2018-10-30', '1');

-- ----------------------------
-- Table structure for `merchants`
-- ----------------------------
DROP TABLE IF EXISTS `merchants`;
CREATE TABLE `merchants` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `head` varchar(255) DEFAULT NULL,
  `tel` int(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `introduction` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of merchants
-- ----------------------------
INSERT INTO `merchants` VALUES ('1', '左岸', 'admin', '11', '重庆大足', '这是一个饭馆');

-- ----------------------------
-- Table structure for `order`
-- ----------------------------
DROP TABLE IF EXISTS `order`;
CREATE TABLE `order` (
  `order_id` varchar(255) NOT NULL DEFAULT '0',
  `order_userid` varchar(255) DEFAULT NULL,
  `order_list` varchar(255) DEFAULT NULL,
  `order_time` varchar(255) DEFAULT NULL,
  `order_money` varchar(255) DEFAULT NULL,
  `order_state` varchar(255) DEFAULT '1',
  `order_table` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of order
-- ----------------------------
INSERT INTO `order` VALUES ('5bd7a3b02ed4f', 'admin', null, '2018-10-30 08:20:20', '10.00', '1', '3');

-- ----------------------------
-- Table structure for `seat`
-- ----------------------------
DROP TABLE IF EXISTS `seat`;
CREATE TABLE `seat` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `state` int(11) NOT NULL DEFAULT '1',
  `work` int(255) DEFAULT NULL,
  `number` int(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of seat
-- ----------------------------
INSERT INTO `seat` VALUES ('1', '0', '1', '8');
INSERT INTO `seat` VALUES ('2', '0', '1', '8');
INSERT INTO `seat` VALUES ('3', '0', '1', '8');

-- ----------------------------
-- Table structure for `shopping`
-- ----------------------------
DROP TABLE IF EXISTS `shopping`;
CREATE TABLE `shopping` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sc_foodname` varchar(255) DEFAULT NULL,
  `sc_price` varchar(255) DEFAULT NULL,
  `sc_count` int(11) DEFAULT NULL,
  `sc_picture` varchar(255) DEFAULT NULL,
  `state` int(11) DEFAULT '1',
  `user_id` int(11) DEFAULT NULL,
  `sc_total` int(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=97 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shopping
-- ----------------------------
INSERT INTO `shopping` VALUES ('94', '干锅兔', '48.00', '1', '19e481acb25c48ceef36b3a75b5dec53.jpg', '1', '1', '48');
INSERT INTO `shopping` VALUES ('95', '牛肉炒饭', '12.00', '1', '4e24ee6086fb58ff0415970574ee185d.jpg', '1', '1', '12');
INSERT INTO `shopping` VALUES ('96', '酸菜肉丝炒饭', '10.00', '1', '0a6d56a22745d28b8975c0eb52c0c054.jpg', '1', '1', '10');

-- ----------------------------
-- Table structure for `user`
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `username` varchar(3120) DEFAULT NULL COMMENT '用户名 用户名',
  `password` varchar(3120) DEFAULT NULL COMMENT '密码 密码',
  `telephone` varchar(3120) DEFAULT NULL COMMENT '电话 电话',
  `address` varchar(3120) DEFAULT NULL COMMENT '收货地址 收货地址',
  `telphone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='用户表';

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'admin', 'aa', '15310515060', '金龙平湖路88号', '1531051506', '1979325052@qq.com', '1', '1');

-- ----------------------------
-- Table structure for `useraddress`
-- ----------------------------
DROP TABLE IF EXISTS `useraddress`;
CREATE TABLE `useraddress` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contactername` varchar(255) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `tephone` varchar(255) DEFAULT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of useraddress
-- ----------------------------
