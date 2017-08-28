/*
Navicat MySQL Data Transfer

Source Server         : tue
Source Server Version : 50141
Source Host           : localhost:3306
Source Database       : vietagar

Target Server Type    : MYSQL
Target Server Version : 50141
File Encoding         : 65001

Date: 2014-08-01 10:49:53
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `core_actions`
-- ----------------------------
DROP TABLE IF EXISTS `core_actions`;
CREATE TABLE `core_actions` (
  `id` int(11) NOT NULL,
  `id_module` int(11) DEFAULT NULL,
  `module_name` varchar(150) DEFAULT NULL,
  `controller_name` varchar(150) DEFAULT NULL,
  `action_name` varchar(150) DEFAULT NULL,
  `is_public` tinyint(1) DEFAULT NULL,
  `layout_type` varchar(50) DEFAULT NULL,
  `page_title` varchar(150) DEFAULT NULL,
  `page_subtitle` varchar(255) DEFAULT NULL,
  `menu_item_title` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_module` (`id_module`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of core_actions
-- ----------------------------
INSERT INTO core_actions VALUES ('0', '8', 'admin', 'slide', 'index', '1', 'admin', 'VietAgar', null, null);
INSERT INTO core_actions VALUES ('1', '1', 'admin', 'action', 'index', '1', 'admin', 'VietAgar', 'Danh sách', null);
INSERT INTO core_actions VALUES ('2', '1', 'admin', 'index', 'index', '1', 'admin', 'VietAgar', 'Thêm mới', null);
INSERT INTO core_actions VALUES ('3', '1', 'admin', 'us', 'index', '1', 'admin', 'VietAgar', 'Hiệu chỉnh', null);
INSERT INTO core_actions VALUES ('4', '1', 'admin', 'us', 'save', '1', 'admin', 'VietAgar', null, null);
INSERT INTO core_actions VALUES ('5', '1', 'admin', 'menu', 'index', '1', 'admin', 'VietAgar', 'Xóa Cache', null);
INSERT INTO core_actions VALUES ('6', '1', 'admin', 'index', 'login', '1', 'admin', 'VietAgar', 'Danh sách', null);
INSERT INTO core_actions VALUES ('7', '1', 'admin', 'index', 'logout', '1', 'admin', 'VietAgar', 'Thêm mới', null);
INSERT INTO core_actions VALUES ('8', '1', 'admin', 'resource', 'index', '1', 'admin', 'VietAgar', 'Hiệu chỉnh', null);
INSERT INTO core_actions VALUES ('9', '1', 'admin', 'resource', 'save', '1', 'admin', 'VietAgar', 'Move up', null);
INSERT INTO core_actions VALUES ('10', '1', 'admin', 'header', 'index', '1', 'admin', 'VietAgar', 'Move down', null);
INSERT INTO core_actions VALUES ('12', '3', 'cn', 'index', 'index', '1', 'index_cn', 'VietAgar', 'Danh sách', null);
INSERT INTO core_actions VALUES ('13', '3', 'cn', 'lienhe', 'index', '1', 'index_cn', 'VietAgar', 'Thêm mới', null);
INSERT INTO core_actions VALUES ('14', '3', 'cn', 'index', 'detailnext', '1', 'index_cn', 'VietAgar', 'Hiệu chỉnh', null);
INSERT INTO core_actions VALUES ('15', '3', 'en', 'index', 'detail', '0', 'index_en', 'VietAgar', 'Xóa', null);
INSERT INTO core_actions VALUES ('16', '3', 'en', 'index', 'detailnext', '0', 'index_en', 'VietAgar', 'ckeditor', null);
INSERT INTO core_actions VALUES ('17', '3', 'en', 'index', 'search', '0', 'index_en', 'VietAgar', 'Danh sách', null);
INSERT INTO core_actions VALUES ('18', '3', 'news', 'content', 'create', '0', 'backend', 'VietAgar', 'Thêm mới', null);
INSERT INTO core_actions VALUES ('19', '3', 'news', 'content', 'update', '0', 'backend', 'VietAgar', 'Hiệu chỉnh', null);
INSERT INTO core_actions VALUES ('20', '3', 'news', 'content', 'delete', '0', 'backend', 'VietAgar', 'Xóa', null);
INSERT INTO core_actions VALUES ('21', '3', 'news', 'content', 'state', '0', 'backend', 'VietAgar', 'Trạng thái', null);
INSERT INTO core_actions VALUES ('22', '3', 'news', 'content', 'frontpage', '0', 'backend', 'VietAgar', 'Set trang chủ', null);
INSERT INTO core_actions VALUES ('24', '4', 'default', 'index', 'search', '1', 'index', 'VietAgar', '', null);
INSERT INTO core_actions VALUES ('26', '4', 'default', 'index', 'index', '1', 'index', 'VietAgar', null, null);
INSERT INTO core_actions VALUES ('33', '4', 'default', 'index', 'search', '1', 'index', 'VietAgar', null, null);
INSERT INTO core_actions VALUES ('34', '4', 'default', 'lienhe', 'index', '1', 'index', 'VietAgar', null, null);
INSERT INTO core_actions VALUES ('38', '1', 'default', 'us', 'index', '1', 'index', 'VietAgar', null, 'Bán hàng');
INSERT INTO core_actions VALUES ('39', '1', 'cn', 'us', 'index', '1', 'index_cn', 'VietAgar', null, 'Bán hàng');
INSERT INTO core_actions VALUES ('40', '1', 'en', 'us', 'index', '1', 'index_en', 'VietAgar', null, 'Bán hàng');
INSERT INTO core_actions VALUES ('41', '1', 'default', 'resource', 'index', '1', 'index', 'VietAgar', null, 'Bán hàng');
INSERT INTO core_actions VALUES ('42', '1', 'cn', 'resource', 'index', '1', 'index_cn', 'VietAgar', null, 'Bán hàng');
INSERT INTO core_actions VALUES ('43', '1', 'en', 'resource', 'index', '1', 'index_en', 'VietAgar', null, 'Bán hàng');
INSERT INTO core_actions VALUES ('44', '1', 'en', 'lienhe', 'index', '1', 'index_en', 'VietAgar', null, 'Đặt hàng');
INSERT INTO core_actions VALUES ('45', '1', 'admin', 'news', 'index', '1', 'admin', 'VietAgar', null, 'Đặt hàng');
INSERT INTO core_actions VALUES ('46', '1', 'admin', 'news', 'save', '1', 'admin', 'VietAgar', null, 'Lịch sử đặt hàng');
INSERT INTO core_actions VALUES ('47', '1', 'admin', 'hinhnen', 'save', '1', 'admin', 'VietAgar', null, 'Hình nền');
INSERT INTO core_actions VALUES ('48', '1', 'admin', 'hinhnen', 'index', '1', 'admin', 'VietAgar', null, 'Hình nền');
INSERT INTO core_actions VALUES ('50', '1', 'admin', 'khachhangoffline', 'index', '1', 'admin', 'VietAgar', null, 'Khách hàng');
INSERT INTO core_actions VALUES ('51', '1', 'admin', 'khachhangoffline', 'add', '1', 'admin', 'VietAgar', null, 'Khách hàng');
INSERT INTO core_actions VALUES ('52', '1', 'admin', 'khachhangoffline', 'edit', '1', 'admin', 'VietAgar', null, 'Khách hàng');
INSERT INTO core_actions VALUES ('53', '1', 'admin', 'khachhangoffline', 'delete', '1', 'admin', 'VietAgar', null, 'Khách hàng');
INSERT INTO core_actions VALUES ('54', '1', 'admin', 'lichsubanhang', 'index', '1', 'admin', 'VietAgar', null, 'Lịch sử bán hàng');
INSERT INTO core_actions VALUES ('55', '1', 'admin', 'lienhe', 'save', '1', 'admin', 'VietAgar', null, 'Liên hệ');
INSERT INTO core_actions VALUES ('56', '1', 'admin', 'lienhe', 'index', '1', 'admin', 'VietAgar', null, 'Liên hệ');
INSERT INTO core_actions VALUES ('57', '1', 'admin', 'language', 'index', '1', 'admin', 'VietAgar', null, 'Loại mặt hàng');
INSERT INTO core_actions VALUES ('58', '1', 'admin', 'loaimathang', 'edit', '1', 'admin', 'VietAgar', null, 'Loại mặt hàng');
INSERT INTO core_actions VALUES ('59', '1', 'admin', 'loaimathang', 'add', '1', 'admin', 'VietAgar', null, 'Loại mặt hàng');
INSERT INTO core_actions VALUES ('60', '1', 'admin', 'mathang', 'addchild', '1', 'admin', 'VietAgar', null, 'Loại mặt hàng');
INSERT INTO core_actions VALUES ('61', '1', 'admin', 'logo', 'index', '1', 'admin', 'VietAgar', null, 'Logo');
INSERT INTO core_actions VALUES ('62', '1', 'admin', 'logo', 'save', '1', 'admin', 'VietAgar', null, 'Logo');
INSERT INTO core_actions VALUES ('63', '1', 'admin', 'mathang', 'index', '1', 'admin', 'VietAgar', null, 'Mặt hàng');
INSERT INTO core_actions VALUES ('64', '1', 'admin', 'mathang', 'edit', '1', 'admin', 'VietAgar', null, 'Mặt hàng');
INSERT INTO core_actions VALUES ('65', '1', 'admin', 'mathang', 'add', '1', 'admin', 'VietAgar', null, 'Mặt hàng');
INSERT INTO core_actions VALUES ('66', '1', 'admin', 'mathang', 'delete', '1', 'admin', 'VietAgar', null, 'Mặt hàng');
INSERT INTO core_actions VALUES ('68', '1', 'admin', 'slide', 'add', '1', 'admin', 'VietAgar', null, null);
INSERT INTO core_actions VALUES ('69', '1', 'admin', 'slide', 'edit', '1', 'admin', 'VietAgar', null, null);
INSERT INTO core_actions VALUES ('70', '1', 'admin', null, null, '1', 'admin', 'VietAgar', null, null);
INSERT INTO core_actions VALUES ('71', '1', 'admin', null, null, '1', 'admin', 'VietAgar', null, null);
INSERT INTO core_actions VALUES ('72', '1', 'admin', null, null, '1', 'admin', 'VietAgar', null, null);
INSERT INTO core_actions VALUES ('73', '8', 'cn', 'news', 'index', '1', 'index_cn', 'VietAgar', null, null);
INSERT INTO core_actions VALUES ('74', '8', 'en', 'news', 'index', '1', 'index_en', 'VietAgar', null, null);
INSERT INTO core_actions VALUES ('75', '1', 'default', 'news', 'index', '1', 'index', 'VietAgar', null, null);
INSERT INTO core_actions VALUES ('76', '3', 'en', 'index', 'autocomplete', '1', 'index_en', 'VietAgar', null, null);
INSERT INTO core_actions VALUES ('77', '3', 'cn', 'index', 'autocomplete', '1', 'index_cn', 'VietAgar', null, null);
INSERT INTO core_actions VALUES ('78', '4', 'default', 'index', 'autocomplete', '1', 'index', 'VietAgar', null, null);
INSERT INTO core_actions VALUES ('79', '1', 'default', 'index', 'detail', '1', 'index', 'VietAgar', null, null);
INSERT INTO core_actions VALUES ('80', '1', 'default', 'index', 'detailnext', '1', 'index', 'VietAgar', null, null);
INSERT INTO core_actions VALUES ('83', '8', 'en', 'index', 'index', '1', 'index_en', 'VietAgar', '', '');
INSERT INTO core_actions VALUES ('89', '8', 'en', 'index', 'search', '1', 'index_en', 'VietAgar', '', '');
INSERT INTO core_actions VALUES ('90', '8', 'en', 'index', 'index', '1', 'index_en', 'VietAgar', '', '');
INSERT INTO core_actions VALUES ('91', '8', 'cn', 'index', 'index', '1', 'index_cn', 'VietAgar', '', '');
INSERT INTO core_actions VALUES ('92', '8', 'cn', 'index', 'search', '1', 'index_cn', 'VietAgar', '', '');
INSERT INTO core_actions VALUES ('93', '8', 'cn', 'index', 'detail', '1', 'index_cn', 'VietAgar', '', '');

-- ----------------------------
-- Table structure for `core_blocks`
-- ----------------------------
DROP TABLE IF EXISTS `core_blocks`;
CREATE TABLE `core_blocks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `orders` int(11) DEFAULT '99',
  `position` varchar(20) NOT NULL,
  `access` tinyint(4) DEFAULT '0',
  `show_title` tinyint(4) DEFAULT '0',
  `params` tinytext,
  `class_name` varchar(150) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  `is_core` tinyint(4) NOT NULL DEFAULT '0',
  `content` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of core_blocks
-- ----------------------------
INSERT INTO core_blocks VALUES ('1', 'test', '99', 'left', '0', '1', 'a:1:{s:10:\"notemplate\";s:1:\"1\";}', 'xhtml', '0', '0', '');
INSERT INTO core_blocks VALUES ('2', 'slider', '5', 'slider', '0', '0', 'a:4:{s:10:\"notemplate\";s:1:\"1\";s:6:\"id_cat\";s:1:\"3\";s:5:\"width\";s:3:\"970\";s:6:\"height\";s:3:\"370\";}', 'slider', '1', '0', '');
INSERT INTO core_blocks VALUES ('3', 'Middle - new', '99', 'user1', '0', '0', 'a:1:{s:10:\"notemplate\";s:1:\"1\";}', 'xhtml', '1', '0', '<!-- ITEM 1 : begin -->\r\n<div class=\"span2 image\">\r\n	<div>\r\n		<img alt=\"\" src=\"/assets/dummies/thumb_170x140_01.jpg\" title=\"BROWSE\" /></div>\r\n</div>\r\n<div class=\"span2 text\">\r\n	<h3>\r\n		EI NEMORE</h3>\r\n	<p>\r\n		<em>Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio.</em></p>\r\n</div>\r\n<!-- ITEM 1 : end --><!-- ITEM 2 : begin -->\r\n<div class=\"span2 image\">\r\n	<div>\r\n		<img alt=\"\" src=\"/assets/dummies/thumb_170x140_02.jpg\" title=\"PURCHASE\" /></div>\r\n</div>\r\n<div class=\"span2 text\">\r\n	<h3>\r\n		MEL EQUIDEM</h3>\r\n	<p>\r\n		<em>Pri ut neglegentur ullamcorper. In sit nonumes graecis. Ei nemore nihil.</em></p>\r\n</div>\r\n<!-- ITEM 2 : end --><!-- ITEM 3 : begin -->\r\n<div class=\"span2 image\">\r\n	<div>\r\n		<img alt=\"\" src=\"/assets/dummies/thumb_170x140_03.jpg\" title=\"DOWNLOAD\" /></div>\r\n</div>\r\n<div class=\"span2 text\">\r\n	<h3>\r\n		EUM AD IMPEDIT</h3>\r\n	<p>\r\n		<em>Nec solum virtute cu, sed no aperiri offendit accusata. Sit ea error timeam, tota.</em></p>\r\n</div>\r\n<!-- ITEM 3 : end -->');
INSERT INTO core_blocks VALUES ('4', 'news breadcrumb', '1', 'topbar', '0', '0', 'a:1:{s:10:\"notemplate\";s:1:\"1\";}', 'newsbreadcrumb', '1', '0', null);
INSERT INTO core_blocks VALUES ('5', 'Footer Main', '99', 'footermain', '0', '0', 'a:1:{s:10:\"notemplate\";s:1:\"1\";}', 'footermain', '1', '0', '');
INSERT INTO core_blocks VALUES ('6', 'News list', '99', 'user3', '0', '0', 'a:4:{s:10:\"notemplate\";s:1:\"1\";s:6:\"id_cat\";s:3:\"1,3\";s:5:\"width\";s:3:\"170\";s:6:\"height\";s:3:\"140\";}', 'newslist', '1', '0', '');

-- ----------------------------
-- Table structure for `core_cache`
-- ----------------------------
DROP TABLE IF EXISTS `core_cache`;
CREATE TABLE `core_cache` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `lifetime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of core_cache
-- ----------------------------

-- ----------------------------
-- Table structure for `core_config_field`
-- ----------------------------
DROP TABLE IF EXISTS `core_config_field`;
CREATE TABLE `core_config_field` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lvl` tinyint(2) NOT NULL,
  `path` varchar(150) NOT NULL,
  `title` varchar(150) NOT NULL,
  `model` varchar(150) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `translation_module` varchar(150) DEFAULT NULL,
  `type` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of core_config_field
-- ----------------------------
INSERT INTO core_config_field VALUES ('1', '1', 'core', 'Core', null, null, 'Core', null);
INSERT INTO core_config_field VALUES ('2', '2', 'core/cache', 'Cache', null, null, null, null);
INSERT INTO core_config_field VALUES ('3', '3', 'core/cache/default_lifetime', 'Default life Time', null, null, null, 'text');

-- ----------------------------
-- Table structure for `core_config_value`
-- ----------------------------
DROP TABLE IF EXISTS `core_config_value`;
CREATE TABLE `core_config_value` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `config_field_id` int(11) NOT NULL,
  `value` varchar(150) DEFAULT NULL,
  `path` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of core_config_value
-- ----------------------------
INSERT INTO core_config_value VALUES ('1', '3', '86400', 'core/cache');

-- ----------------------------
-- Table structure for `core_fk_block_action`
-- ----------------------------
DROP TABLE IF EXISTS `core_fk_block_action`;
CREATE TABLE `core_fk_block_action` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_block` int(11) NOT NULL,
  `id_action` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of core_fk_block_action
-- ----------------------------
INSERT INTO core_fk_block_action VALUES ('2', '3', '11');
INSERT INTO core_fk_block_action VALUES ('3', '4', '24');
INSERT INTO core_fk_block_action VALUES ('4', '5', null);
INSERT INTO core_fk_block_action VALUES ('5', '1', '11');
INSERT INTO core_fk_block_action VALUES ('8', '6', '11');
INSERT INTO core_fk_block_action VALUES ('9', '2', '11');

-- ----------------------------
-- Table structure for `core_fk_group_action`
-- ----------------------------
DROP TABLE IF EXISTS `core_fk_group_action`;
CREATE TABLE `core_fk_group_action` (
  `id_group` int(11) NOT NULL,
  `id_action` int(11) NOT NULL,
  PRIMARY KEY (`id_group`,`id_action`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of core_fk_group_action
-- ----------------------------
INSERT INTO core_fk_group_action VALUES ('1', '1');
INSERT INTO core_fk_group_action VALUES ('1', '2');
INSERT INTO core_fk_group_action VALUES ('1', '3');
INSERT INTO core_fk_group_action VALUES ('1', '4');
INSERT INTO core_fk_group_action VALUES ('1', '5');
INSERT INTO core_fk_group_action VALUES ('1', '6');
INSERT INTO core_fk_group_action VALUES ('1', '7');
INSERT INTO core_fk_group_action VALUES ('1', '8');
INSERT INTO core_fk_group_action VALUES ('1', '9');
INSERT INTO core_fk_group_action VALUES ('1', '10');

-- ----------------------------
-- Table structure for `core_fk_user_action`
-- ----------------------------
DROP TABLE IF EXISTS `core_fk_user_action`;
CREATE TABLE `core_fk_user_action` (
  `id_user` int(11) NOT NULL,
  `id_action` int(11) NOT NULL,
  PRIMARY KEY (`id_user`,`id_action`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of core_fk_user_action
-- ----------------------------

-- ----------------------------
-- Table structure for `core_fk_user_group`
-- ----------------------------
DROP TABLE IF EXISTS `core_fk_user_group`;
CREATE TABLE `core_fk_user_group` (
  `id_user` int(11) NOT NULL,
  `id_group` int(11) NOT NULL,
  PRIMARY KEY (`id_user`,`id_group`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of core_fk_user_group
-- ----------------------------
INSERT INTO core_fk_user_group VALUES ('1', '1');

-- ----------------------------
-- Table structure for `core_groups`
-- ----------------------------
DROP TABLE IF EXISTS `core_groups`;
CREATE TABLE `core_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `code` varchar(150) NOT NULL,
  `status` tinyint(4) DEFAULT '1',
  `orders` tinyint(4) DEFAULT '99',
  `permission` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of core_groups
-- ----------------------------
INSERT INTO core_groups VALUES ('1', 'Quản trị hệ thống', 'ADMIN', '1', '1', '1');

-- ----------------------------
-- Table structure for `core_menu`
-- ----------------------------
DROP TABLE IF EXISTS `core_menu`;
CREATE TABLE `core_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_parent` int(11) DEFAULT NULL,
  `name` varchar(150) NOT NULL,
  `popup` tinyint(4) DEFAULT '0',
  `link` varchar(250) NOT NULL,
  `icon` varchar(250) DEFAULT NULL,
  `params` text,
  `level` int(11) NOT NULL,
  `lft` int(11) NOT NULL,
  `rgt` int(11) NOT NULL,
  `menutype` varchar(20) NOT NULL,
  `status` tinyint(4) DEFAULT '1',
  `access` tinyint(4) DEFAULT '0',
  `is_system` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of core_menu
-- ----------------------------
INSERT INTO core_menu VALUES ('1', null, 'Root', '0', '', null, null, '1', '1', '46', 'mainmenu', '1', '0', '1');
INSERT INTO core_menu VALUES ('4', '1', 'Hệ thống', '0', '/admin/index/index', null, null, '2', '2', '13', 'adminmenu', '1', '1', '1');
INSERT INTO core_menu VALUES ('5', '1', 'Menu', '0', '/admin/menu/index', null, null, '2', '14', '15', 'adminmenu', '1', '1', '1');
INSERT INTO core_menu VALUES ('6', '1', 'Tiện ích', '0', '#', null, null, '2', '16', '21', 'adminmenu', '1', '1', '0');
INSERT INTO core_menu VALUES ('7', '6', 'Xóa Cache', '0', '/admin/tool/clearcache', null, null, '3', '17', '18', 'adminmenu', '1', '1', '1');
INSERT INTO core_menu VALUES ('8', '4', 'Cấu hình chung', '0', '#', null, null, '3', '3', '10', 'adminmenu', '1', '1', '0');
INSERT INTO core_menu VALUES ('9', '8', 'Tham số hệ thống', '0', '/admin/configfield/index', null, null, '4', '4', '5', 'adminmenu', '1', '1', '0');
INSERT INTO core_menu VALUES ('10', '8', 'Module', '0', '/admin/module/index', null, null, '4', '6', '7', 'adminmenu', '1', '1', '0');
INSERT INTO core_menu VALUES ('11', '8', 'Action', '0', '/admin/action/index', null, null, '4', '8', '9', 'adminmenu', '1', '1', '0');
INSERT INTO core_menu VALUES ('12', '4', 'Block', '0', '/admin/block/index', null, null, '3', '11', '12', 'adminmenu', '1', '1', '0');
INSERT INTO core_menu VALUES ('13', '1', 'Người dùng', '0', '#', null, null, '2', '22', '27', 'adminmenu', '1', '1', '0');
INSERT INTO core_menu VALUES ('14', '13', 'User', '0', '/admin/user/index', null, null, '3', '23', '24', 'adminmenu', '1', '1', '0');
INSERT INTO core_menu VALUES ('15', '13', 'Group', '0', '/admin/group/index', null, null, '3', '25', '26', 'adminmenu', '1', '1', '0');
INSERT INTO core_menu VALUES ('16', '1', 'Tin tức', '0', '#', null, null, '2', '28', '33', 'adminmenu', '1', '1', '0');
INSERT INTO core_menu VALUES ('17', '16', 'Chủ đề', '0', '/news/categories/index', null, null, '3', '29', '30', 'adminmenu', '1', '1', '0');
INSERT INTO core_menu VALUES ('18', '16', 'Nội dung', '0', '/news/content/index', null, null, '3', '31', '32', 'adminmenu', '1', '0', '0');
INSERT INTO core_menu VALUES ('19', '1', 'TRANG CHỦ', '0', '/default/index/index', null, null, '2', '34', '35', 'mainmenu', '1', '0', '0');
INSERT INTO core_menu VALUES ('20', '1', 'DỊCH VỤ', '0', '#', null, null, '2', '38', '43', 'mainmenu', '1', '0', '0');
INSERT INTO core_menu VALUES ('21', '1', 'GIỚI THIỆU', '0', '#', null, null, '2', '36', '37', 'mainmenu', '1', '0', '0');
INSERT INTO core_menu VALUES ('22', '20', 'DỊCH VỤ', '0', '#', null, null, '3', '39', '40', 'mainmenu', '1', '0', '0');
INSERT INTO core_menu VALUES ('23', '20', 'Menu 1.1.1', '0', '#', null, null, '3', '41', '42', 'mainmenu', '1', '0', '0');
INSERT INTO core_menu VALUES ('24', '1', 'LIÊN HỆ', '0', '#', null, null, '2', '44', '45', 'mainmenu', '1', '0', '0');
INSERT INTO core_menu VALUES ('25', '6', 'Thông tin hệ thống', '0', '/admin/tool/info', null, null, '3', '19', '20', 'adminmenu', '1', '1', '0');

-- ----------------------------
-- Table structure for `core_menu_types`
-- ----------------------------
DROP TABLE IF EXISTS `core_menu_types`;
CREATE TABLE `core_menu_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `alias` varchar(20) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of core_menu_types
-- ----------------------------
INSERT INTO core_menu_types VALUES ('1', 'Main menu', 'mainmenu', '1');
INSERT INTO core_menu_types VALUES ('2', 'Admin menu', 'adminmenu', '1');

-- ----------------------------
-- Table structure for `core_modules`
-- ----------------------------
DROP TABLE IF EXISTS `core_modules`;
CREATE TABLE `core_modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `package` varchar(50) NOT NULL,
  `code` varchar(50) NOT NULL,
  `name` varchar(255) NOT NULL,
  `version` varchar(10) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of core_modules
-- ----------------------------
INSERT INTO core_modules VALUES ('1', 'admin', 'admin', 'Hệ thống', '0.1', '1');
INSERT INTO core_modules VALUES ('2', 'default', 'default', 'Default', '0.1', '1');
INSERT INTO core_modules VALUES ('3', 'news', 'news', 'News', '0.1', '1');
INSERT INTO core_modules VALUES ('4', 'default1', 'default1', 'Default1', '0.1', '1');
INSERT INTO core_modules VALUES ('5', 'muahang', 'muahang', 'Muahang', '0.1', '1');
INSERT INTO core_modules VALUES ('7', 'admin1', 'admin1', 'admin1', '0.1', '1');
INSERT INTO core_modules VALUES ('8', 'en', 'en', 'En', '0.1', '1');
INSERT INTO core_modules VALUES ('9', 'cn', 'cn', 'Cn', '0.1', '1');

-- ----------------------------
-- Table structure for `core_users`
-- ----------------------------
DROP TABLE IF EXISTS `core_users`;
CREATE TABLE `core_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(150) NOT NULL,
  `username` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL,
  `createdate` datetime NOT NULL,
  `lastvisetdate` datetime DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of core_users
-- ----------------------------
INSERT INTO core_users VALUES ('1', 'Nguyễn Hữu Thanh', 'administrator', 'huuthanh3108@yahoo.com', 'e99a18c428cb38d5f260853678922e03', '2012-12-04 11:11:06', null, '0914005969', '1');

-- ----------------------------
-- Table structure for `header_text`
-- ----------------------------
DROP TABLE IF EXISTS `header_text`;
CREATE TABLE `header_text` (
  `text_vi` varchar(255) NOT NULL,
  `text_en` varchar(255) NOT NULL,
  `text_cn` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of header_text
-- ----------------------------
INSERT INTO header_text VALUES ('Công ty TNHH VietAgar', 'Limited liability company VietAgar', '有限责任公司VietAgar');

-- ----------------------------
-- Table structure for `header_text_dynamic`
-- ----------------------------
DROP TABLE IF EXISTS `header_text_dynamic`;
CREATE TABLE `header_text_dynamic` (
  `dynamic` int(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of header_text_dynamic
-- ----------------------------
INSERT INTO header_text_dynamic VALUES ('0');

-- ----------------------------
-- Table structure for `hinh_nen`
-- ----------------------------
DROP TABLE IF EXISTS `hinh_nen`;
CREATE TABLE `hinh_nen` (
  `file_name` varchar(1000) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hinh_nen
-- ----------------------------
INSERT INTO hinh_nen VALUES ('/images/database/background/stock-photo-glass-shelf-on-abstract-metal-background-96806422.jpg');

-- ----------------------------
-- Table structure for `language`
-- ----------------------------
DROP TABLE IF EXISTS `language`;
CREATE TABLE `language` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text_cn` varchar(255) NOT NULL,
  `text_en` varchar(255) NOT NULL,
  `text_vi` varchar(255) NOT NULL,
  `order` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of language
-- ----------------------------
INSERT INTO language VALUES ('5', '越南人', 'Vietnamese', 'Tiếng Việt', '1');
INSERT INTO language VALUES ('6', '简体中文', 'English', 'English', '3');
INSERT INTO language VALUES ('7', '英语', 'Chinese', 'Tiếng Trung', '2');

-- ----------------------------
-- Table structure for `lienhe`
-- ----------------------------
DROP TABLE IF EXISTS `lienhe`;
CREATE TABLE `lienhe` (
  `noidung_vi` longtext,
  `noidung_en` longtext,
  `noidung_cn` longtext
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of lienhe
-- ----------------------------
INSERT INTO lienhe VALUES ('<p style=\"text-align:center\"><span style=\"font-size:16px\"><span style=\"font-family:georgia,serif\"><img alt=\"\" src=\"/images/database/ckeditor/2000242_20140520171054_1.jpg\" style=\"height:266px; width:150px\" />tue</span></span></p>\r\n\r\n<ol>\r\n	<li>dsfdsfds\r\n	<ul>\r\n		<li>sadsa</li>\r\n	</ul>\r\n	</li>\r\n	<li>sadsadasdsfsdss</li>\r\n	<li>dsfss</li>\r\n	<li>sdfdsf</li>\r\n	<li>sdfds</li>\r\n	<li>sdfds</li>\r\n	<li>sdfdsf</li>\r\n	<li>sdfds</li>\r\n	<li>fdds</li>\r\n	<li>dfdsf</li>\r\n	<li>dsfds</li>\r\n	<li>dsfds</li>\r\n	<li>dsfds</li>\r\n	<li>dsfds</li>\r\n	<li>dfds</li>\r\n	<li>dfds</li>\r\n	<li>sdfds</li>\r\n	<li>dfds</li>\r\n	<li>dsfds</li>\r\n	<li>dsfds</li>\r\n	<li>dsfds</li>\r\n	<li>dfsds</li>\r\n	<li>dfds</li>\r\n	<li>dfds</li>\r\n	<li>dfds</li>\r\n	<li>dfds</li>\r\n	<li>dsf</li>\r\n	<li>dsdfd</li>\r\n	<li>sdf</li>\r\n	<li>ddfds</li>\r\n	<li>dfds</li>\r\n	<li>fds</li>\r\n	<li>dfds</li>\r\n	<li>dfds</li>\r\n	<li>fdds</li>\r\n	<li>sdfds</li>\r\n	<li>sdfds</li>\r\n	<li>sdfds</li>\r\n	<li>dsfds</li>\r\n	<li>sdf</li>\r\n	<li>&nbsp;</li>\r\n</ol>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n', '<p><u>anh</u></p>\r\n', '<p><span style=\"background-color:#daa520\">trung</span></p>\r\n');

-- ----------------------------
-- Table structure for `logo`
-- ----------------------------
DROP TABLE IF EXISTS `logo`;
CREATE TABLE `logo` (
  `file_name` varchar(1000) NOT NULL,
  `dynamic` int(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of logo
-- ----------------------------
INSERT INTO logo VALUES ('/images/database/logo/_9b3a987fedc92f651a104c29ae07280d53c1fb3ee41502.44663779.jpg', '0');

-- ----------------------------
-- Table structure for `mat_hang`
-- ----------------------------
DROP TABLE IF EXISTS `mat_hang`;
CREATE TABLE `mat_hang` (
  `id` bigint(15) NOT NULL AUTO_INCREMENT,
  `title_vi` varchar(255) DEFAULT NULL,
  `title_en` varchar(255) DEFAULT NULL,
  `title_cn` varchar(255) DEFAULT NULL,
  `loi_gioi_thieu_vi` varchar(255) DEFAULT NULL,
  `loi_gioi_thieu_en` varchar(255) DEFAULT NULL,
  `loi_gioi_thieu_cn` varchar(255) DEFAULT NULL,
  `ten_mat_hang_vi` varchar(255) DEFAULT NULL,
  `ten_mat_hang_en` varchar(255) DEFAULT NULL,
  `ten_mat_hang_cn` varchar(255) DEFAULT NULL,
  `logo` varchar(250) DEFAULT NULL,
  `mo_ta_vi` text,
  `mo_ta_en` text,
  `mo_ta_cn` text,
  `gia` bigint(20) DEFAULT '0',
  `public_gia` binary(1) DEFAULT '1',
  `parent_id` bigint(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=117 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mat_hang
-- ----------------------------
INSERT INTO mat_hang VALUES ('72', null, null, null, null, null, null, 'Tượng trầm để xe hơi', 'Tượng trầm để xe hơi', 'Tượng trầm để xe hơi', '/images/database/_eaef8ab2fc200a7875206f24f0aef74b53c8f1601a2d04.70821456.jpg', '*** THÀNH PHẦN ***\r\n- Làm từ thân cây trầm cao cấp nhất được chọn lọc khắt khe nhất, chế tác thành những tác phẩm điêu khắc hoặc những biểu tượng tôn giáo một cách tinh xảo dưới bàn tay điêu luyện của những thợ chạm khắc lành nghề.\r\n*** CÔNG DỤNG ***\r\n- Sử dụng trong tôn giáo, gia tăng thêm sự tôn nghiêm, thành kính.\r\n- Chế tác theo sự mong muốn của khách hàng để sử dụng tùy theo mục đích.', '*** THÀNH PHẦN ***\r\n- Làm từ thân cây trầm cao cấp nhất được chọn lọc khắt khe nhất, chế tác thành những tác phẩm điêu khắc hoặc những biểu tượng tôn giáo một cách tinh xảo dưới bàn tay điêu luyện của những thợ chạm khắc lành nghề.\r\n \r\n*** CÔNG DỤNG ***\r\n- Sử dụng trong tôn giáo, gia tăng thêm sự tôn nghiêm, thành kính.\r\n- Chế tác theo sự mong muốn của khách hàng để sử dụng tùy theo mục đích.', '*** THÀNH PHẦN ***\r\n- Làm từ thân cây trầm cao cấp nhất được chọn lọc khắt khe nhất, chế tác thành những tác phẩm điêu khắc hoặc những biểu tượng tôn giáo một cách tinh xảo dưới bàn tay điêu luyện của những thợ chạm khắc lành nghề.\r\n \r\n*** CÔNG DỤNG ***\r\n- Sử dụng trong tôn giáo, gia tăng thêm sự tôn nghiêm, thành kính.\r\n- Chế tác theo sự mong muốn của khách hàng để sử dụng tùy theo mục đích.', '0', 0x31, '96');
INSERT INTO mat_hang VALUES ('77', 'Trà Hòa Tan', '', '', null, null, null, 'Trà Hòa Tan', '', '', '/images/database/_50324f77bef7815bfc275243aa24e2a053c5511a85b6c5.81696541.jpg', '- NGUỒN TINH TÚY ĐẤT TRỜI\r\n\r\n- 100% lá tự nhiên mà lựa chọn cẩn thận từ \" Cây của Chúa\". Một loại trà giải độc , làm sạch và cân bằng hệ thống cơ thể của bạn, giúp mang lại một cuộc sống lành mạnh.\r\nHƯỚNG DẪN SỬ DỤNG:\r\n\r\n- Cho bột trà trầm hương vào ly.\r\n\r\n- Thêm 150 ml nước đun sôi và khuấy đều.\r\n\r\n- Hít vào mùi thơm sâu để thư giãn và được chuẩn bị để thưởng thức loại trà tốt nhất thế giới .\r\nCÔNG DỤNG:\r\n• Giảm Cholesterol\r\n• Giảm đường huyết\r\n• Giảm huyết áp\r\n• Tăng cường tim\r\n• Giảm Acid Uric\r\n• Cải thiện giấc ngủ\r\n• Giảm cân\r\n• Loại bỏ táo bón\r\n• Điều trị rối loạn chức năng tình dục\r\n• Loại bỏ tình trang say rượu\r\n• Loại bỏ mỡ.\r\n• Tốt Aphorodisiac\r\n• Loại bỏ Đầy hơi\r\n• Loại bỏ hen suyễn\r\n• Cải thiện hệ thống tiêu hóa\r\n• cơ thể giải độc\r\n• Giảm lão hóa sớm', '', '', '0', 0x31, '70');
INSERT INTO mat_hang VALUES ('78', 'Trà túi lọc', '', '', null, null, null, 'Trà túi lọc', '', '', '/images/database/_09b3a42907669a5baa0a918d817313aa53c55190c139e0.82367493.jpg', '*** THÀNH PHẦN ***- Trà trầm hương là một sản phẩm mà thiên nhiên kỳ diệu dành tặng cho con người, với phương pháp thu hoạch thủ công và chế biến trên công nghệ hiện đại, không chất bảo quản tổng hợp, không chứa các phụ  gia hóa học.\r\n- Trà trầm đã được chứng nhận là một sản phẩm an toàn và tốt đối với sức khỏe con người. Với thành phần chính 100% là lá cây dó bầu nhiễm trầm, trà trầm tự hào là một sản phẩm hoàn toàn tự nhiên và thân thiện với cuộc sống của con người.\r\n*** CÔNG DỤNG ***\r\n- Giảm cholesterol.\r\n- Giảm Axít Uríc.\r\n- Giảm mỡ máu / đường trong máu.\r\n- Cải thiện làn da / Chống lão hóa.\r\n- Cải thiện giấc ngủ tự nhiên.\r\n- Giải độc.\r\n*** HƯỚNG DẪN SỬ DỤNG ***\r\n- Đun nóng nước cho sôi.\r\n- Cho một lượng trà thích hợp (Tùy thuộc vào khẩu vị của mỗi người) vào ấm trà, thông thường là 1.5g/100ml nước.\r\n- Rót nước vừa ngập trà trong bình, lắc nhẹ ấm và đổ  nước ra.\r\n- Rót nước cao bằng lượng trà, hãm trà trong vòng 20 giây (Làm như vậy giúp trà ngấm nước, nở và lưu lại được tinh chất).\r\n- Rót nước đầy vào bình hãm trà trong vòng 5-7 phút, đổ ra ly và thưởng thức.\r\n- Nên dùng nước lọc tinh khiết hoặc nước giếng có hàm lượng ion kim loại thấp để pha trà.', '', '', '0', 0x31, '70');
INSERT INTO mat_hang VALUES ('93', 'Trầm hương chìm', null, 'Trầm hương chìm', null, null, null, 'Trầm hương chìm loại 1', 'Trầm hương chìm loại 1', 'Trầm hương chìm loại 1', '/images/database/_d4c2da7d41c336bc2bc3af4e4556509f53c8f5b6b615b8.95896251.jpg', '- Làm sạch không khí.\r\n- Giảm stress, giúp ngủ ngon giấc.\r\n- Khử mùi hôi, ẩm móc, thuốc lá.\r\n- Nhiều người còn mua trầm về để đốt trước khi vào nhà mới để lấy may và đặc biệt để khử độc do sơn ở nhà mới.\r\n- Làm chất định hương trong công nghiệp sản xuất nước hoa và mỹ phẩm cao cấp.\r\n- Xoa bóp, đặc biệt hiệu quả với các trường hợp đau nhức cơ, dây thần kinh.\r\n- Sát khuẩn, tiệt trùng.\r\n- Bôi muỗi đốt, côn trùng cắn, làm dịu vết bỏng, nốt ngứa.\r\n- Để trong xe ô tô, giúp làm sạch không khí trong xe.', '- Làm sạch không khí.\r\n- Giảm stress, giúp ngủ ngon giấc.\r\n- Khử mùi hôi, ẩm móc, thuốc lá.\r\n- Nhiều người còn mua trầm về để đốt trước khi vào nhà mới để lấy may và đặc biệt để khử độc do sơn ở nhà mới.\r\n- Làm chất định hương trong công nghiệp sản xuất nước hoa và mỹ phẩm cao cấp.\r\n- Xoa bóp, đặc biệt hiệu quả với các trường hợp đau nhức cơ, dây thần kinh.\r\n- Sát khuẩn, tiệt trùng.\r\n- Bôi muỗi đốt, côn trùng cắn, làm dịu vết bỏng, nốt ngứa.\r\n- Để trong xe ô tô, giúp làm sạch không khí trong xe.', '- Làm sạch không khí.\r\n- Giảm stress, giúp ngủ ngon giấc.\r\n- Khử mùi hôi, ẩm móc, thuốc lá.\r\n- Nhiều người còn mua trầm về để đốt trước khi vào nhà mới để lấy may và đặc biệt để khử độc do sơn ở nhà mới.\r\n- Làm chất định hương trong công nghiệp sản xuất nước hoa và mỹ phẩm cao cấp.\r\n- Xoa bóp, đặc biệt hiệu quả với các trường hợp đau nhức cơ, dây thần kinh.\r\n- Sát khuẩn, tiệt trùng.\r\n- Bôi muỗi đốt, côn trùng cắn, làm dịu vết bỏng, nốt ngứa.\r\n- Để trong xe ô tô, giúp làm sạch không khí trong xe.', '0', 0x31, '95');
INSERT INTO mat_hang VALUES ('98', null, null, null, null, null, null, 'Trầm hương chìm loại 2', 'Trầm hương chìm loại 2', 'Trầm hương chìm loại 2', '/images/database/_2ffb79612d54fd55b9be04aaca763a8253c94fdba9d498.90833729.jpg', '- Làm sạch không khí.\r\n- Giảm stress, giúp ngủ ngon giấc.\r\n- Khử mùi hôi, ẩm móc, thuốc lá.\r\n- Nhiều người còn mua trầm về để đốt trước khi vào nhà mới để lấy may và đặc biệt để khử độc do sơn ở nhà mới.\r\n- Làm chất định hương trong công nghiệp sản xuất nước hoa và mỹ phẩm cao cấp.\r\n- Xoa bóp, đặc biệt hiệu quả với các trường hợp đau nhức cơ, dây thần kinh.\r\n- Sát khuẩn, tiệt trùng.\r\n- Bôi muỗi đốt, côn trùng cắn, làm dịu vết bỏng, nốt ngứa.\r\n- Để trong xe ô tô, giúp làm sạch không khí trong xe.', '- Làm sạch không khí.\r\n- Giảm stress, giúp ngủ ngon giấc.\r\n- Khử mùi hôi, ẩm móc, thuốc lá.\r\n- Nhiều người còn mua trầm về để đốt trước khi vào nhà mới để lấy may và đặc biệt để khử độc do sơn ở nhà mới.\r\n- Làm chất định hương trong công nghiệp sản xuất nước hoa và mỹ phẩm cao cấp.\r\n- Xoa bóp, đặc biệt hiệu quả với các trường hợp đau nhức cơ, dây thần kinh.\r\n- Sát khuẩn, tiệt trùng.\r\n- Bôi muỗi đốt, côn trùng cắn, làm dịu vết bỏng, nốt ngứa.\r\n- Để trong xe ô tô, giúp làm sạch không khí trong xe.', '- Làm sạch không khí.\r\n- Giảm stress, giúp ngủ ngon giấc.\r\n- Khử mùi hôi, ẩm móc, thuốc lá.\r\n- Nhiều người còn mua trầm về để đốt trước khi vào nhà mới để lấy may và đặc biệt để khử độc do sơn ở nhà mới.\r\n- Làm chất định hương trong công nghiệp sản xuất nước hoa và mỹ phẩm cao cấp.\r\n- Xoa bóp, đặc biệt hiệu quả với các trường hợp đau nhức cơ, dây thần kinh.\r\n- Sát khuẩn, tiệt trùng.\r\n- Bôi muỗi đốt, côn trùng cắn, làm dịu vết bỏng, nốt ngứa.\r\n- Để trong xe ô tô, giúp làm sạch không khí trong xe.', '0', 0x31, '95');
INSERT INTO mat_hang VALUES ('99', null, null, null, null, null, null, 'Trầm hương chìm Việt Nam loại 1', 'Trầm hương chìm Việt Nam loại 1', 'Trầm hương chìm Việt Nam loại 1', '/images/database/_70fadb59187be6526d0754aacd9e54ff53c9504b35f4b6.74535330.jpg', '- Làm sạch không khí.\r\n- Giảm stress, giúp ngủ ngon giấc.\r\n- Khử mùi hôi, ẩm móc, thuốc lá.\r\n- Nhiều người còn mua trầm về để đốt trước khi vào nhà mới để lấy may và đặc biệt để khử độc do sơn ở nhà mới.\r\n- Làm chất định hương trong công nghiệp sản xuất nước hoa và mỹ phẩm cao cấp.\r\n- Xoa bóp, đặc biệt hiệu quả với các trường hợp đau nhức cơ, dây thần kinh.\r\n- Sát khuẩn, tiệt trùng.\r\n- Bôi muỗi đốt, côn trùng cắn, làm dịu vết bỏng, nốt ngứa.\r\n- Để trong xe ô tô, giúp làm sạch không khí trong xe.', '- Làm sạch không khí.\r\n- Giảm stress, giúp ngủ ngon giấc.\r\n- Khử mùi hôi, ẩm móc, thuốc lá.\r\n- Nhiều người còn mua trầm về để đốt trước khi vào nhà mới để lấy may và đặc biệt để khử độc do sơn ở nhà mới.\r\n- Làm chất định hương trong công nghiệp sản xuất nước hoa và mỹ phẩm cao cấp.\r\n- Xoa bóp, đặc biệt hiệu quả với các trường hợp đau nhức cơ, dây thần kinh.\r\n- Sát khuẩn, tiệt trùng.\r\n- Bôi muỗi đốt, côn trùng cắn, làm dịu vết bỏng, nốt ngứa.\r\n- Để trong xe ô tô, giúp làm sạch không khí trong xe.', '- Làm sạch không khí.\r\n- Giảm stress, giúp ngủ ngon giấc.\r\n- Khử mùi hôi, ẩm móc, thuốc lá.\r\n- Nhiều người còn mua trầm về để đốt trước khi vào nhà mới để lấy may và đặc biệt để khử độc do sơn ở nhà mới.\r\n- Làm chất định hương trong công nghiệp sản xuất nước hoa và mỹ phẩm cao cấp.\r\n- Xoa bóp, đặc biệt hiệu quả với các trường hợp đau nhức cơ, dây thần kinh.\r\n- Sát khuẩn, tiệt trùng.\r\n- Bôi muỗi đốt, côn trùng cắn, làm dịu vết bỏng, nốt ngứa.\r\n- Để trong xe ô tô, giúp làm sạch không khí trong xe.', '0', 0x31, '95');
INSERT INTO mat_hang VALUES ('95', 'Trầm hương chìm', 'Trầm hương chìm', 'Trầm hương chìm', 'jdshfjdkshfdsdsf', null, null, null, null, null, '/images/database/_b90f7066bdd0bd7fa0a7ceba862b0c2553c9243b96bcf2.94570375.jpg', 'mô tả trầm hương chìm sdfdsfsd  sfds dsf sdf sd dsf sdf dsf sdf dsf dsf ds fds f dsf ds f sdf sd fsd f sdf sd f sdf ds f sd fsd f dsf sd f \r\nsd fsd f sd fs df sd f sdf sd fsd f sd f sdf sd fs df sd f sd fs df sd f sdf sd f sd f sdf ds f sd f sd ', 'mô tả trầm hương chìm', 'mô tả trầm hương chìm', '0', 0x31, null);
INSERT INTO mat_hang VALUES ('96', 'Tượng Phật trầm', 'Tượng Phật trầm', 'Tượng Phật trầm', null, null, null, null, null, null, '/images/database/_f983bcf10646eb5c1df7781edb00213953c924e4000365.90144807.jpg', 'mô tả thủ công mỹ nghệfdf \r\nádsa dfsa  adsadsa\r\nsa\r\ndsa\r\ndsa\r\ndsa\r\n', 'mô tả thủ công mỹ nghệ', 'mô tả thủ công mỹ nghệ', '0', 0x31, null);
INSERT INTO mat_hang VALUES ('100', 'Vòng đeo tay', 'Vòng đeo tay', 'Vòng đeo tay', null, null, null, null, null, null, '/images/database/_3f509c5c08413f76f13234c34bbd78c953c95ab4e51e98.31658928.jpg', null, null, null, '0', 0x31, null);
INSERT INTO mat_hang VALUES ('101', null, null, null, null, null, null, 'Vòng đeo tay 1', 'Vòng đeo tay 1', 'Vòng đeo tay 1', '/images/database/_c9782610030e41804e4719e14401385453c95aecd7fc13.60769760.jpg', null, null, null, '0', 0x31, '100');
INSERT INTO mat_hang VALUES ('102', null, null, null, null, null, null, 'Vòng đeo tay 2', 'Vòng đeo tay 2', 'Vòng đeo tay 2', '/images/database/_1bc66df3f6f73d6b8a4def104333986853c95b03910342.66725872.jpg', null, null, null, '0', 0x31, '100');
INSERT INTO mat_hang VALUES ('103', null, null, null, null, null, null, 'Vòng đeo tay 3', 'Vòng đeo tay 3', 'Vòng đeo tay 3', '/images/database/_5844e7ac90b69f9ced0302d0e6004a2853c95b214ec716.32785461.jpg', null, null, null, '0', 0x31, '100');
INSERT INTO mat_hang VALUES ('104', null, null, null, null, null, null, 'Vòng đeo tay 4', 'Vòng đeo tay 4', 'Vòng đeo tay 4', '/images/database/_60a653148b55ab9772d09acd4a78563b53c95b44263f98.19536369.jpg', null, null, null, '0', 0x31, '100');
INSERT INTO mat_hang VALUES ('105', 'Trầm miếng', 'Trầm miếng', 'Trầm miếng', null, null, null, null, null, null, '/images/database/_d7b600761ef83e277422ca162be76e0c53c95be5c405d3.72115871.jpg', null, null, null, '0', 0x31, null);
INSERT INTO mat_hang VALUES ('106', null, null, null, null, null, null, 'Trầm hương miếng 1', 'Trầm hương miếng 1', 'Trầm hương miếng 1', '/images/database/_fa9977d1f9e0872d93ecee793d54a85753c95c0bb66482.15299535.jpg', null, null, null, '0', 0x31, '105');
INSERT INTO mat_hang VALUES ('107', null, null, null, null, null, null, 'Trầm hương miếng 2', 'Trầm hương miếng 2', 'Trầm hương miếng 2', '/images/database/_accd2875ff458adf80b5b4d99c0bd53c53c95c209cce47.54256416.jpg', null, null, null, '0', 0x31, '105');
INSERT INTO mat_hang VALUES ('108', 'Trầm hương cảnh', 'Trầm hương cảnh', 'Trầm hương cảnh', null, null, null, null, null, null, '/images/database/_5ec4cca73f9b75f79e3142ac88233e7c53c95c578d75a9.75079637.jpg', null, null, null, '0', 0x31, null);
INSERT INTO mat_hang VALUES ('109', null, null, null, null, null, null, 'Trầm hương cảnh dáng cá', 'Trầm hương cảnh dáng cá', 'Trầm hương cảnh dáng cá', '/images/database/_f21c686d4d562a0e87136854381c017253c95c71e11449.18580601.jpg', null, null, null, '0', 0x31, '108');

-- ----------------------------
-- Table structure for `menu`
-- ----------------------------
DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text_vi` varchar(100) NOT NULL,
  `text_en` varchar(100) NOT NULL,
  `text_cn` varchar(100) NOT NULL,
  `link` varchar(100) NOT NULL,
  `order` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `is_product` tinyint(1) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of menu
-- ----------------------------
INSERT INTO menu VALUES ('5', 'Trang chủ', 'Home', '家', '/', '1', null, null, '1');
INSERT INTO menu VALUES ('6', 'Giới thiệu', 'Introduction', '介绍 ', '/', '2', null, null, '1');
INSERT INTO menu VALUES ('7', 'Trầm hương', 'Frankincense', 'Trầm hương', '/', '3', null, null, null);
INSERT INTO menu VALUES ('8', 'Sản phẩm', 'Products', 'Sản phẩm', '/', '4', null, '1', '1');
INSERT INTO menu VALUES ('9', 'Liên hệ', 'Contact Us', 'Liên hệ', '/lienhe', '5', null, null, '1');
INSERT INTO menu VALUES ('10', 'Con người', 'Human', '人的', '/resource', '6', '6', null, '1');
INSERT INTO menu VALUES ('11', 'Giá trị của chúng tôi', 'Our Values', '我们的价值观', '/us', '7', '6', null, '1');
INSERT INTO menu VALUES ('12', 'Tin tức', 'News', '新闻', '/news', '8', '6', null, '1');

-- ----------------------------
-- Table structure for `news`
-- ----------------------------
DROP TABLE IF EXISTS `news`;
CREATE TABLE `news` (
  `news_vi` longtext,
  `news_en` longtext,
  `news_cn` longtext
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of news
-- ----------------------------
INSERT INTO news VALUES ('<p>tin tuc Viet</p>\r\n', '<p>tin tuc anh</p>\r\n', '<p>tin tuc trung</p>\r\n');

-- ----------------------------
-- Table structure for `resource`
-- ----------------------------
DROP TABLE IF EXISTS `resource`;
CREATE TABLE `resource` (
  `resource_vi` longtext,
  `resource_en` longtext,
  `resource_cn` longtext
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of resource
-- ----------------------------
INSERT INTO resource VALUES ('<p>con guoi viet1</p>\r\n\r\n<p><img alt=\"\" src=\"/images/17814_1299465389_cobehotran.gif\" style=\"height:13px; width:15px\" /></p>\r\n', '<p>con nguoi anh1</p>\r\n', '<p>con nguoi trung1</p>\r\n');

-- ----------------------------
-- Table structure for `slide_text`
-- ----------------------------
DROP TABLE IF EXISTS `slide_text`;
CREATE TABLE `slide_text` (
  `id` bigint(15) NOT NULL AUTO_INCREMENT,
  `title_vi` varchar(255) DEFAULT NULL,
  `title_en` varchar(255) DEFAULT NULL,
  `title_cn` varchar(255) DEFAULT NULL,
  `mo_ta_vi` text,
  `mo_ta_en` text,
  `mo_ta_cn` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=121 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of slide_text
-- ----------------------------
INSERT INTO slide_text VALUES ('110', 'PHÁT TRIỂN LÂU DÀI', 'PHÁT TRIỂN LÂU DÀI', 'PHÁT TRIỂN LÂU DÀI', 'Hơn ai hết, chúng tôi hiểu rõ sự lý tưởng về điều kiện tự nhiên của đất nước và làm thế nào để cho nuôi trồng rừng cây Gió Bầu trong điều kiện hoàn hảo nhất, chúng tôi mong muốn cho cây Gió Bầu vươn xa khắp lãnh thổ rừng núi Việt Nam để nguồn tài nguyên quý giá này của đất nước được sống lại và ngày càng trù phú.', 'Hơn ai hết, chúng tôi hiểu rõ sự lý tưởng về điều kiện tự nhiên của đất nước và làm thế nào để cho nuôi trồng rừng cây Gió Bầu trong điều kiện hoàn hảo nhất, chúng tôi mong muốn cho cây Gió Bầu vươn xa khắp lãnh thổ rừng núi Việt Nam để nguồn tài nguyên quý giá này của đất nước được sống lại và ngày càng trù phú.', 'Hơn ai hết, chúng tôi hiểu rõ sự lý tưởng về điều kiện tự nhiên của đất nước và làm thế nào để cho nuôi trồng rừng cây Gió Bầu trong điều kiện hoàn hảo nhất, chúng tôi mong muốn cho cây Gió Bầu vươn xa khắp lãnh thổ rừng núi Việt Nam để nguồn tài nguyên quý giá này của đất nước được sống lại và ngày càng trù phú.');
INSERT INTO slide_text VALUES ('114', 'Tầm nhìn và chiến lược', 'Tầm nhìn và chiến lược', 'Tầm nhìn và chiến lược', 'Mục tiêu của chúng tôi là trở thành công ty đi đầu về sản xuất & xuất khẩu các sản phẩm Trầm Hương cao cấp mang ra thị trường thế giới như Nhật Bản, Trung Quốc, Ấn Độ và Trung Đông.. Từng bước đi của Agarvina không chỉ là sự cẩn trọng trong đầu tư cho các chuyên gia, thợ lành nghề, xưởng sản xuất, hơn thế nữa còn là sự tỉ mỉ, tâm huyết trong từng kế hoạch hội chợ, quảng bá quốc tế mà chúng tôi tham dự. Mong muốn cháy bỏng là làm sao mang được thương hiệu Trầm Việt Nam ra thị trường thế giới thành công, để Trầm hương được đánh giá đúng tầm với chất lượng cao mà Agarvina tự tin cung cấp.', 'Mục tiêu của chúng tôi là trở thành công ty đi đầu về sản xuất & xuất khẩu các sản phẩm Trầm Hương cao cấp mang ra thị trường thế giới như Nhật Bản, Trung Quốc, Ấn Độ và Trung Đông.. Từng bước đi của Agarvina không chỉ là sự cẩn trọng trong đầu tư cho các chuyên gia, thợ lành nghề, xưởng sản xuất, hơn thế nữa còn là sự tỉ mỉ, tâm huyết trong từng kế hoạch hội chợ, quảng bá quốc tế mà chúng tôi tham dự. Mong muốn cháy bỏng là làm sao mang được thương hiệu Trầm Việt Nam ra thị trường thế giới thành công, để Trầm hương được đánh giá đúng tầm với chất lượng cao mà Agarvina tự tin cung cấp.', 'Mục tiêu của chúng tôi là trở thành công ty đi đầu về sản xuất & xuất khẩu các sản phẩm Trầm Hương cao cấp mang ra thị trường thế giới như Nhật Bản, Trung Quốc, Ấn Độ và Trung Đông.. Từng bước đi của Agarvina không chỉ là sự cẩn trọng trong đầu tư cho các chuyên gia, thợ lành nghề, xưởng sản xuất, hơn thế nữa còn là sự tỉ mỉ, tâm huyết trong từng kế hoạch hội chợ, quảng bá quốc tế mà chúng tôi tham dự. Mong muốn cháy bỏng là làm sao mang được thương hiệu Trầm Việt Nam ra thị trường thế giới thành công, để Trầm hương được đánh giá đúng tầm với chất lượng cao mà Agarvina tự tin cung cấp.');
INSERT INTO slide_text VALUES ('118', '20 NĂM TRỒNG VÀ PHÁT TRIỂN RỪNG TRẦM HƯƠNG', '20 NĂM TRỒNG VÀ PHÁT TRIỂN RỪNG TRẦM HƯƠNG', '20 NĂM TRỒNG VÀ PHÁT TRIỂN RỪNG TRẦM HƯƠNG', 'Với tổng diện tích hiện tại là 300 hécta, trong số 300.000 rừng cây Gió của chúng tôi đã có hơn 50.000 cây tạo Trầm. Hơn thế nữa, Agarvina đã xây dựng được hàng loạt các xưởng chế biến và gia công rộng trên khắp các tỉnh miền Trung Nam Việt Nam như Bình Phước, Quảng Nam và mở nhiều showroom trong nước và quốc tế.', 'Với tổng diện tích hiện tại là 300 hécta, trong số 300.000 rừng cây Gió của chúng tôi đã có hơn 50.000 cây tạo Trầm. Hơn thế nữa, Agarvina đã xây dựng được hàng loạt các xưởng chế biến và gia công rộng trên khắp các tỉnh miền Trung Nam Việt Nam như Bình Phước, Quảng Nam và mở nhiều showroom trong nước và quốc tế.', 'Với tổng diện tích hiện tại là 300 hécta, trong số 300.000 rừng cây Gió của chúng tôi đã có hơn 50.000 cây tạo Trầm. Hơn thế nữa, Agarvina đã xây dựng được hàng loạt các xưởng chế biến và gia công rộng trên khắp các tỉnh miền Trung Nam Việt Nam như Bình Phước, Quảng Nam và mở nhiều showroom trong nước và quốc tế.');

-- ----------------------------
-- Table structure for `us`
-- ----------------------------
DROP TABLE IF EXISTS `us`;
CREATE TABLE `us` (
  `us_vi` longtext,
  `us_en` longtext,
  `us_cn` longtext
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of us
-- ----------------------------
INSERT INTO us VALUES ('<p>\r\n	chung toi viet1</p>\r\n', '<p>\r\n	chung toi anh1</p>\r\n', '<p>\r\n	chung toi trung1</p>\r\n');

-- ----------------------------
-- Table structure for `user`
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id_user` bigint(20) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `first_name` varchar(12) DEFAULT NULL,
  `last_name` varchar(12) DEFAULT NULL,
  `middle_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO user VALUES ('1', 'leminhnhut', 'leminhnhut', 'Lê', 'Nhật', 'Minh');

-- ----------------------------
-- Table structure for `us_copy`
-- ----------------------------
DROP TABLE IF EXISTS `us_copy`;
CREATE TABLE `us_copy` (
  `us_vi` longtext,
  `us_en` longtext,
  `us_cn` longtext
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of us_copy
-- ----------------------------
INSERT INTO us_copy VALUES ('<p>\r\n	chung toi viet1</p>\r\n', '<p>\r\n	chung toi anh1</p>\r\n', '<p>\r\n	chung toi trung1</p>\r\n');
