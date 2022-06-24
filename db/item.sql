/*
 Navicat Premium Data Transfer

 Source Server         : local mysql
 Source Server Type    : MySQL
 Source Server Version : 100418
 Source Host           : 127.0.0.1:3306
 Source Schema         : warehouse-db

 Target Server Type    : MySQL
 Target Server Version : 100418
 File Encoding         : 65001

 Date: 24/06/2022 22:36:21
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for item
-- ----------------------------
DROP TABLE IF EXISTS `item`;
CREATE TABLE `item`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `cat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 50 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of item
-- ----------------------------
INSERT INTO `item` VALUES (1, 'Chrome Bright', 'PET SB50 (A) - P1069 - 11LLY', 'RML');
INSERT INTO `item` VALUES (2, 'Chromo Backing Putih', 'LP.CC/GL P-A \"CAMEL\"', 'RML');
INSERT INTO `item` VALUES (3, 'DT 500 STANDARD', 'DT 500 ', 'DT');
INSERT INTO `item` VALUES (7, 'DT 5000NS STANDARD', 'DT 5000NS ', 'DT');
INSERT INTO `item` VALUES (11, 'DT 501K STANDARD', 'DT 501K ', 'DT');
INSERT INTO `item` VALUES (15, 'DT GA808 STANDARD', 'DT GA808 ', 'DT');
INSERT INTO `item` VALUES (20, 'DT TESA 60999', 'DT TESA 60999 ', 'DT');
INSERT INTO `item` VALUES (21, 'HVS Backing Kuning', 'LP.HVS-A/RLY-B \"CAMEL\"', 'RML');
INSERT INTO `item` VALUES (22, 'HVS Backing Putih', 'LP.HVS-A/GL-PA \"CAMEL\"', 'RML');
INSERT INTO `item` VALUES (23, 'Liner Backing Kuning', 'RL.RBY-A 1/S \"CAMEL\"', 'RML');
INSERT INTO `item` VALUES (24, 'Liner Backing Putih', 'RL.GL.P-A 1/S \" CAMEL\"', 'RML');
INSERT INTO `item` VALUES (25, 'Marvel 4001A  ', 'Marvel 4001A  ', 'DT');
INSERT INTO `item` VALUES (30, 'Pet Silver Bright Backing Kuning', 'PETSB 50(A) P-1069 11 LLY', 'RMP');
INSERT INTO `item` VALUES (31, 'Plastik Film', 'PF ', 'RMP');
INSERT INTO `item` VALUES (33, 'PolyCarbonate', 'PC ', 'RMP');
INSERT INTO `item` VALUES (36, 'Polyethylene Terephthalate', 'PET ', 'RMP');
INSERT INTO `item` VALUES (37, 'PolyVinylCarbonate', 'PVC ', 'RMP');
INSERT INTO `item` VALUES (38, 'PPNG Top Pearlize', 'BW0174 PPNG Top Pearlized/S692N/BG 40 WH IMP', 'RML');
INSERT INTO `item` VALUES (39, 'PPNG Top Trans', 'BW0062N PPNG TopTrans/S692N/BG40Wh(imp) ', 'RML');
INSERT INTO `item` VALUES (40, 'Semicoat Backing Biru', 'LP.ART-B/GL.BM \"CAMEL\"', 'RML');
INSERT INTO `item` VALUES (41, 'Semicoat Backing Kuning', 'RL.RBY-A 1/S \"CAMEL\"', 'RML');
INSERT INTO `item` VALUES (42, 'Semicoat Backing Putih', 'LP.ART-B/GL P-E \"CAMEL\"', 'RML');
INSERT INTO `item` VALUES (43, 'Silver Matt', 'Silver Matt', 'RML');
INSERT INTO `item` VALUES (44, 'Silver Matt Backing Biru', 'PET SM 50N-PAT1-8K', 'RML');
INSERT INTO `item` VALUES (45, 'Superstick Transparant', 'PVCTB 80 NPL 11LLY', 'RMP');
INSERT INTO `item` VALUES (46, 'Thermal Backing Putih', 'LP Thermal / GL - PA \" CAMEL\"', 'RML');
INSERT INTO `item` VALUES (47, 'Vinyl White', 'Vinyl White', 'RML');
INSERT INTO `item` VALUES (48, 'Yupo Backing Biru', 'YUPO 80 (TTR) PW7 8K ', 'RML');
INSERT INTO `item` VALUES (49, 'Yupo Backing Putih', 'YUPO 80 (TTR) PW7 6K ', 'RML');

SET FOREIGN_KEY_CHECKS = 1;
