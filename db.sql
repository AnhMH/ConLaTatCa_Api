/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : anhmh

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2018-03-09 14:54:42
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='Admins master';

-- ----------------------------
-- Records of admins
-- ----------------------------
INSERT INTO `admins` VALUES ('1', 'Admin', 'admin@conlatatca.info', '12ncv_zdI0B5zqWb18bPmTUvgVs59uisBfLP50_Fj7i2j_T1UnyXxGcRCw8YlO_eWkQwdFMyMzFfQ3QxajdsVmdHX2d2SEhHMmpnZ1NlbDk3WGpIaE1jLWF0VQ', '1', '0', '1520407450', '1520410149');

-- ----------------------------
-- Table structure for articles
-- ----------------------------
DROP TABLE IF EXISTS `articles`;
CREATE TABLE `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8_unicode_ci,
  `cate_id` int(11) DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_default` tinyint(1) DEFAULT NULL,
  `disable` tinyint(1) DEFAULT '0',
  `created` int(11) DEFAULT NULL,
  `updated` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of articles
-- ----------------------------
INSERT INTO `articles` VALUES ('1', 'Đau bụng dưới bên trái khi mang thai: Nguyên nhân và cách đề phòng', 'Khi bầu bì, cơ thể mẹ sẽ có rất nhiều thay đổi khiến mẹ đặt dấu hỏi và đặc biệt là việc đau bụng dưới bên trái khi mang thai. Đây có thể là một dấu hiệu hết sức bình thường nhưng trong một vài trường hợp lại cực kỳ nguy hiểm. Hãy cùng conlatatca tìm hiểu thêm trong bài viết sau đây nhé!', 'Mẹ bầu biết gì về đau bụng dưới khi mang thai?\r\nMột số mẹ bầu thường cảm thấy đau bụng dưới trong vài tuần đầu tiên. Nguyên nhân của tình trạng này là do trứng thụ tinh tìm cách cấy vào tử cung. Nếu những cơn đau này kèm theo biểu hiện ốm nghén thì đây là điều hết sức bình thường. Sau những tuần đầu tiên, bạn sẽ thấy cơ thể dễ chịu hơn và cơn đau dần biến mất.\r\n\r\nNguyên nhân khiến mẹ bầu bị đau bụng dưới bên trái khi mang thai\r\nNguyên nhân thông thường\r\ndau-bung-duoi-ben-trai-khi-mang-thai-nguyen-nhan-va-cach-de-phong\r\nCác bài tập đau bụng nghiêng có thể hỗ trợ mẹ bầu trong việc giảm cơn đau bụng dưới bên trái.\r\n\r\nKhi mang thai những tuần đầu tiên, cơ thể mẹ bầu luôn có những sự thay đổi. Chỉ với sự thay đổi tư thế khi đứng lên ngồi xuống cũng khiến mẹ cảm thấy đau bụng. Tử cung của bạn sẽ mở rộng khi bào thai phát triển, khiến dây chằng bị kéo dãn ra để nâng đỡ thai nhi trong tử cung. Điều này có thể gây đau ngắn ở hai bên, nhất là trong tam cá nguyệt thứ 2.\r\n\r\nNếu đau ở bên trái, có thể là do tử cung của bạn nghiêng về phía bên phải, dây chằng bên phải được thư giãn trong khi dây chẳng bên trái lại bị kéo căng. Thậm chí, bạn có thể bị đau dây chằng đột ngột khi cười, ho, hắt hơi. Để giảm bớt cơn đau này, mẹ có thể từ từ thay đổi vị trí hoặc nghỉ ngơi. Mẹ cũng nhờ bác sĩ tư vấn các bài tập nghiêng để hỗ trợ cũng như giảm các cơn đau bụng dưới bên trái này.\r\n\r\nCơn đau vùng bụng dưới cũng có thể xuất hiện ở những tháng cuối của thai kỳ. Nguyên nhân của tình trạng này là do dịch vị trong dạ dày, tá tràng tăng lên. Với triệu chứng đau thông thường này, mẹ bầu không cần quá lo lắng, bởi nó là điều bình thường trong thai kỳ, và không ảnh hưởng gì đến sự phát triển của thai nhi.\r\n\r\nĐau bụng dưới bên trái khi mang thai do vấn đề tiêu hóa\r\nSự rối loạn nội tiết tố trong quá trình mang thai cũng làm ảnh hưởng đến hoạt động của hệ tiêu hóa dẫn đến chứng táo bón, đầy hơi và đau bụng bên trái. Ngoài ra, viêm tuyến tụy cũng là một trong những nguyên nhân gây nên tình trạng đau bụng dưới bên trái. Tuyến tụy nằm phía sau dạ dày và có thể bị viêm nếu bạn bị sỏi mật hoặc một tình trạng khác gây kích ứng tụy. Để hạn chế tình trạng này, mẹ bầu nên uống nhiều nước, ăn nhiều thực phẩm giàu chất xơ và thường xuyên tập thể dục. \r\n\r\nĐau bụng dưới bên trái khi mang thai khi nào thì nguy hiểm?\r\nNang buồng trứng\r\ndau-bung-duoi-ben-trai-khi-mang-thai-nguyen-nhan-va-cach-de-phong\r\nĐau bụng dưới khi mang thai nguy hiểm khi nó gây đau đớn và gây nhói ở bên bụng trái của bạn.\r\n\r\nKhi bạn có thai, phần còn lại của nang buồng trứng tạo ra quả trứng trở thành một cấu trúc được gọi là luteum thể vàng. Thể vàng này co lại sau tam cá nguyệt thứ nhất. Chúng vẫn tồn tại và sản xuất các hormone cần thiết cho những ngày đầu thai kỳ. Đôi khi thể vàng kéo dài hơn bình thường và chứa đầy chất lỏng, tạo thành một u nang. Các loại u nang buồng trứng cũng có thể xảy ra ở thời kỳ mang thai.\r\n\r\nCác mẹ có thể yên tâm vì hầu hết các u nang buồng trứng trong thời kỳ này đều biến mất mà không cần điều trị. Các bác sĩ khuyên chỉ cần theo dõi cùng với các xét nghiệm siêu âm định kỳ để nắm được tình hình phát triển và biến mất của chúng. Tuy nhiên, có một vài trường hợp buồng trứng bị xoắn hoặc nang bị vỡ gây đau dữ dội hoặc có thể có biến chứng. Trong tình huống này cần phải điều trị khẩn cấp, có thể sẽ phải phẫu thuật.\r\n\r\nMột số tình trạng nghiêm trọng khác\r\nHiện tượng mang thai ngoài tử cung có thể gây ra đau bụng dưới bên trái. Điều này sẽ đe dọa tính mạng của người mẹ nếu bị vỡ ống dẫn trứng. Trường hợp này có thể được phát hiện sớm khi siêu âm và điều trị bằng cách tiến hành phẫu thuật. Một số trường hợp đau bụng dưới khi mang thai kèm một số biểu hiện khác có thể gây ra tình trạng nguy hiểm khác như sinh non, sảy thai, sỏi thận và một số bệnh nhiễm trùng.', '1', 'https://lh4.googleusercontent.com/-9jpuN1bQ9Mc/UDS2POizrVI/AAAAAAAAAGs/e6hUyK2Rtkk/s1600-w640/', '1', '1', '1520412924', '1520580051');

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of authenticates
-- ----------------------------
INSERT INTO `authenticates` VALUES ('1', '1', '04adcd7c69328b7b2f2808bb1e34d41053ee2c3ccfa7a5a2f3ae1c064d7ce70c9e1d3cb46aab4def5baa41d5c6f872b0991df2bc2e1c184167ceaca5f432669d', '1523168654', 'admin', '1520410702');

-- ----------------------------
-- Table structure for cates
-- ----------------------------
DROP TABLE IF EXISTS `cates`;
CREATE TABLE `cates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `root_id` int(11) DEFAULT '0',
  `order` int(11) DEFAULT NULL,
  `disable` tinyint(1) DEFAULT '0',
  `created` int(11) DEFAULT NULL,
  `updated` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cate_id` (`id`) USING BTREE,
  KEY `cate_order` (`order`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of cates
-- ----------------------------
INSERT INTO `cates` VALUES ('1', 'Chuẩn bị mang thai', '0', '1', '0', '1520405432', '1520405432');

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
DROP TRIGGER IF EXISTS `before_insert_articles`;
DELIMITER ;;
CREATE TRIGGER `before_insert_articles` BEFORE INSERT ON `articles` FOR EACH ROW SET 
	new.created = UNIX_TIMESTAMP(),
	new.updated = UNIX_TIMESTAMP()
;;
DELIMITER ;
DROP TRIGGER IF EXISTS `before_update_articles`;
DELIMITER ;;
CREATE TRIGGER `before_update_articles` BEFORE UPDATE ON `articles` FOR EACH ROW SET 
             new.updated = UNIX_TIMESTAMP()
;;
DELIMITER ;
DROP TRIGGER IF EXISTS `before_insert_authenticates`;
DELIMITER ;;
CREATE TRIGGER `before_insert_authenticates` BEFORE INSERT ON `authenticates` FOR EACH ROW SET 

	new.created = UNIX_TIMESTAMP()
;;
DELIMITER ;
DROP TRIGGER IF EXISTS `before_insert_cates`;
DELIMITER ;;
CREATE TRIGGER `before_insert_cates` BEFORE INSERT ON `cates` FOR EACH ROW SET 
	new.created = UNIX_TIMESTAMP(),
	new.updated = UNIX_TIMESTAMP()
;;
DELIMITER ;
DROP TRIGGER IF EXISTS `before_update_cates`;
DELIMITER ;;
CREATE TRIGGER `before_update_cates` BEFORE UPDATE ON `cates` FOR EACH ROW SET 
             new.updated = UNIX_TIMESTAMP()
;;
DELIMITER ;
