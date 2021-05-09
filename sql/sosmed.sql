/*
 Navicat Premium Data Transfer

 Source Server         : Localhost
 Source Server Type    : MySQL
 Source Server Version : 50719
 Source Host           : localhost:3306
 Source Schema         : sosmed

 Target Server Type    : MySQL
 Target Server Version : 50719
 File Encoding         : 65001

 Date: 09/05/2021 20:01:48
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for post
-- ----------------------------
DROP TABLE IF EXISTS `post`;
CREATE TABLE `post`  (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `content` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `created_at` datetime(0) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `user_id`(`user_id`) USING BTREE,
  CONSTRAINT `post_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of post
-- ----------------------------
INSERT INTO `post` VALUES (1, 1, 'Aldan', '2021-04-07 19:57:00');
INSERT INTO `post` VALUES (2, 1, 'Ea', '2021-04-07 19:57:08');
INSERT INTO `post` VALUES (3, 1, '', '2021-04-07 20:20:15');
INSERT INTO `post` VALUES (4, 1, '', '2021-04-07 20:20:18');
INSERT INTO `post` VALUES (6, 1, '', '2021-04-07 20:21:35');
INSERT INTO `post` VALUES (7, 1, 'hi\r\n', '2021-04-07 20:21:38');
INSERT INTO `post` VALUES (9, 1, 'test', '2021-04-07 20:43:53');
INSERT INTO `post` VALUES (11, 1, 'Test', '2021-05-06 19:40:28');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `role` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `username` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `email` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `password` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `avatar` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES (1, 'admin', 'inialdan', 'projectarizki@gmail.com', '$2y$10$krlHvNV09bBAl2UUfpOe9eQt/FZdhBFRkDpfzyv7QXkIWbvfVV4ga', '6093ec7cdc707.png');

SET FOREIGN_KEY_CHECKS = 1;
