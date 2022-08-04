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

 Date: 05/08/2022 06:00:17
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for inbound
-- ----------------------------
DROP TABLE IF EXISTS `inbound`;
CREATE TABLE `inbound`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `supp_id` int NULL DEFAULT NULL,
  `do` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `do_date` datetime NULL DEFAULT NULL,
  `po` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `bpb` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `bpb_date` datetime NULL DEFAULT NULL,
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `status_id` int NULL DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 17 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for inbound_item
-- ----------------------------
DROP TABLE IF EXISTS `inbound_item`;
CREATE TABLE `inbound_item`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `inbound_id` int NULL DEFAULT NULL,
  `item_id` int NULL DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `category` varchar(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `qty` int NULL DEFAULT NULL,
  `length` int NULL DEFAULT NULL,
  `width` int NULL DEFAULT NULL,
  `incominsg` datetime(6) NULL DEFAULT NULL,
  `incoming` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for item
-- ----------------------------
DROP TABLE IF EXISTS `item`;
CREATE TABLE `item`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `cat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `supplier_id` int NULL DEFAULT NULL,
  `width` int NULL DEFAULT NULL,
  `length` int NULL DEFAULT NULL,
  `code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `lot` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `qty` int NULL DEFAULT NULL,
  `act` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `updated` datetime NULL DEFAULT NULL,
  `note` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 79 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for item_lot
-- ----------------------------
DROP TABLE IF EXISTS `item_lot`;
CREATE TABLE `item_lot`  (
  `lot_id` int NOT NULL AUTO_INCREMENT,
  `stock_id` int NULL DEFAULT NULL,
  `lot` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `qty` int NULL DEFAULT NULL,
  `incoming` datetime NULL DEFAULT NULL,
  `updated_date` datetime NULL DEFAULT NULL,
  `act` int NULL DEFAULT NULL,
  `note` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`lot_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 22 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for item_stock
-- ----------------------------
DROP TABLE IF EXISTS `item_stock`;
CREATE TABLE `item_stock`  (
  `stock_id` int NOT NULL AUTO_INCREMENT,
  `item_id` int NOT NULL,
  `code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `nm` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `dsc` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `cat` varchar(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `lg` int NULL DEFAULT NULL,
  `wd` int NULL DEFAULT NULL,
  `supp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`stock_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 21 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for outbound
-- ----------------------------
DROP TABLE IF EXISTS `outbound`;
CREATE TABLE `outbound`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `stb` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `stb_date` datetime NULL DEFAULT NULL,
  `division` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `spb` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `status_id` int NULL DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 41 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for outbound_item
-- ----------------------------
DROP TABLE IF EXISTS `outbound_item`;
CREATE TABLE `outbound_item`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `outbound_id` int NULL DEFAULT NULL,
  `stock_id` int NULL DEFAULT NULL,
  `code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `qty` int NULL DEFAULT NULL,
  `length` int NULL DEFAULT NULL,
  `width` int NULL DEFAULT NULL,
  `lot` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for po
-- ----------------------------
DROP TABLE IF EXISTS `po`;
CREATE TABLE `po`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `po` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `po_date` datetime NULL DEFAULT NULL,
  `pr` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `status_id` int NULL DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for po_item
-- ----------------------------
DROP TABLE IF EXISTS `po_item`;
CREATE TABLE `po_item`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `pr` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `po_id` int NULL DEFAULT NULL,
  `supplier` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `item_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `width` int NULL DEFAULT NULL,
  `length` int NULL DEFAULT NULL,
  `qty` int NULL DEFAULT NULL,
  `acc` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for pr
-- ----------------------------
DROP TABLE IF EXISTS `pr`;
CREATE TABLE `pr`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `pr` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `pr_date` datetime NULL DEFAULT NULL,
  `spk_date` datetime NULL DEFAULT NULL,
  `category` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `status_id` int NULL DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for pr_item
-- ----------------------------
DROP TABLE IF EXISTS `pr_item`;
CREATE TABLE `pr_item`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `spk` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `pr_id` int NULL DEFAULT NULL,
  `supplier` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `item_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `width` int NULL DEFAULT NULL,
  `length` int NULL DEFAULT NULL,
  `qty` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for request
-- ----------------------------
DROP TABLE IF EXISTS `request`;
CREATE TABLE `request`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `spb` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `spb_date` datetime NULL DEFAULT NULL,
  `div` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `spk` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `category` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `status_id` int NULL DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for request_item
-- ----------------------------
DROP TABLE IF EXISTS `request_item`;
CREATE TABLE `request_item`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `req_id` int NULL DEFAULT NULL,
  `stock_id` int NULL DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `category` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `qty` int NULL DEFAULT NULL,
  `length` int NULL DEFAULT NULL,
  `width` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for spk
-- ----------------------------
DROP TABLE IF EXISTS `spk`;
CREATE TABLE `spk`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `spk` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `spk_date` datetime NULL DEFAULT NULL,
  `category` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `status_id` int NULL DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `item_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `width` int NULL DEFAULT NULL,
  `length` int NULL DEFAULT NULL,
  `qty` int NULL DEFAULT NULL,
  `item_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `supplier` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for supplier
-- ----------------------------
DROP TABLE IF EXISTS `supplier`;
CREATE TABLE `supplier`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `code` varchar(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `supp_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `product` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 68 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `complete_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `phone` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `position` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `birthdate` datetime NULL DEFAULT NULL,
  `birth` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- View structure for todo_v
-- ----------------------------
DROP VIEW IF EXISTS `todo_v`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `todo_v` AS select `x`.`id` AS `id`,`x`.`status_id` AS `status_id`,`x`.`no` AS `no`,`x`.`dt` AS `dt`,`x`.`typ` AS `typ`,`x`.`lk` AS `lk` from (select `warehouse-db`.`inbound`.`id` AS `id`,`warehouse-db`.`inbound`.`status_id` AS `status_id`,`warehouse-db`.`inbound`.`bpb` AS `no`,`warehouse-db`.`inbound`.`bpb_date` AS `dt`,'Bukti Penerimaan Barang' AS `typ`,concat('inbound/process/',`warehouse-db`.`inbound`.`id`) AS `lk` from `warehouse-db`.`inbound` union select `warehouse-db`.`request`.`id` AS `id`,`warehouse-db`.`request`.`status_id` AS `status_id`,`warehouse-db`.`request`.`spb` AS `no`,`warehouse-db`.`request`.`spb_date` AS `dt`,'Permintaan Barang' AS `typ`,concat('req/process/',`warehouse-db`.`request`.`id`) AS `lk` from `warehouse-db`.`request` union select `warehouse-db`.`outbound`.`id` AS `id`,`warehouse-db`.`outbound`.`status_id` AS `status_id`,`warehouse-db`.`outbound`.`stb` AS `no`,`warehouse-db`.`outbound`.`stb_date` AS `dt`,'Barang Keluar' AS `typ`,concat('outbound/process/',`warehouse-db`.`outbound`.`id`) AS `lk` from `warehouse-db`.`outbound`) `x`;

SET FOREIGN_KEY_CHECKS = 1;
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

 Date: 05/08/2022 06:00:50
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
  `supplier_id` int NULL DEFAULT NULL,
  `width` int NULL DEFAULT NULL,
  `length` int NULL DEFAULT NULL,
  `code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `lot` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `qty` int NULL DEFAULT NULL,
  `act` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `updated` datetime NULL DEFAULT NULL,
  `note` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 79 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of item
-- ----------------------------
INSERT INTO `item` VALUES (1, 'Chrome Bright', 'PET SB50 (A) - P1069 - 11LLY', 'RML', 7, 20, 10000, NULL, NULL, 0, '0', NULL, NULL);
INSERT INTO `item` VALUES (2, 'Chromo Backing Putih', 'LP.CC/GL P-A \"CAMEL\"', 'RML', 1, 20, 10000, NULL, NULL, 0, '0', NULL, NULL);
INSERT INTO `item` VALUES (3, 'DT 500 STANDARD', 'DT 500 ', 'DT', 3, 20, 10000, NULL, NULL, 0, '0', NULL, NULL);
INSERT INTO `item` VALUES (7, 'DT 5000NS STANDARD', 'DT 5000NS ', 'DT', 3, 20, 10000, NULL, NULL, 0, '0', NULL, NULL);
INSERT INTO `item` VALUES (11, 'DT 501K STANDARD', 'DT 501K ', 'DT', 3, 20, 10000, NULL, NULL, 0, '0', NULL, NULL);
INSERT INTO `item` VALUES (15, 'DT GA808 STANDARD', 'DT GA808 ', 'DT', 3, 20, 10000, NULL, NULL, 0, '0', NULL, NULL);
INSERT INTO `item` VALUES (20, 'DT TESA 60999', 'DT TESA 60999 ', 'DT', 9, 20, 10000, NULL, NULL, 0, '0', NULL, NULL);
INSERT INTO `item` VALUES (21, 'HVS Backing Kuning', 'LP.HVS-A/RLY-B \"CAMEL\"', 'RML', 1, 20, 10000, NULL, NULL, 0, '0', NULL, NULL);
INSERT INTO `item` VALUES (22, 'HVS Backing Putih', 'LP.HVS-A/GL-PA \"CAMEL\"', 'RML', 1, 20, 10000, NULL, NULL, 0, '0', NULL, NULL);
INSERT INTO `item` VALUES (23, 'Liner Backing Kuning', 'RL.RBY-A 1/S \"CAMEL\"', 'RML', 1, 20, 10000, NULL, NULL, 0, '0', NULL, NULL);
INSERT INTO `item` VALUES (24, 'Liner Backing Putih', 'RL.GL.P-A 1/S \" CAMEL\"', 'RML', 1, 20, 10000, NULL, NULL, 0, '0', NULL, NULL);
INSERT INTO `item` VALUES (25, 'Marvel 4001A  ', 'Marvel 4001A  ', 'DT', 10, 20, 10000, NULL, NULL, 0, '0', NULL, NULL);
INSERT INTO `item` VALUES (30, 'Pet Silver Bright Backing Kuning', 'PETSB 50(A) P-1069 11 LLY', 'RMP', 4, 20, 10000, NULL, NULL, 0, '0', NULL, NULL);
INSERT INTO `item` VALUES (31, 'Plastik Film', 'PF ', 'RMP', 5, 20, 10000, NULL, NULL, 46, '46', NULL, NULL);
INSERT INTO `item` VALUES (33, 'PolyCarbonate', 'PC ', 'RMP', 3, 20, 10000, NULL, NULL, 0, '0', NULL, NULL);
INSERT INTO `item` VALUES (36, 'Polyethylene Terephthalate', 'PET ', 'RMP', 7, 20, 10000, NULL, NULL, 0, '0', NULL, NULL);
INSERT INTO `item` VALUES (37, 'PolyVinylCarbonate', 'PVC ', 'RMP', 6, 20, 10000, NULL, NULL, 0, '0', NULL, NULL);
INSERT INTO `item` VALUES (38, 'PPNG Top Pearlize', 'BW0174 PPNG Top Pearlized/S692N/BG 40 WH IMP', 'RML', 8, 20, 10000, NULL, NULL, 0, '0', NULL, NULL);
INSERT INTO `item` VALUES (39, 'PPNG Top Trans', 'BW0062N PPNG TopTrans/S692N/BG40Wh(imp) ', 'RML', 8, 20, 10000, NULL, NULL, 0, '0', NULL, NULL);
INSERT INTO `item` VALUES (40, 'Semicoat Backing Biru', 'LP.ART-B/GL.BM \"CAMEL\"', 'RML', 4, 20, 10000, NULL, NULL, 0, '0', NULL, NULL);
INSERT INTO `item` VALUES (41, 'Semicoat Backing Kuning', 'RL.RBY-A 1/S \"CAMEL\"', 'RML', 4, 20, 10000, NULL, NULL, 0, '0', NULL, NULL);
INSERT INTO `item` VALUES (42, 'Semicoat Backing Putih', 'LP.ART-B/GL P-E \"CAMEL\"', 'RML', 4, 20, 10000, NULL, NULL, 0, '0', NULL, NULL);
INSERT INTO `item` VALUES (43, 'Silver Matt', 'Silver Matt', 'RML', 4, 20, 10000, NULL, NULL, 0, '0', NULL, NULL);
INSERT INTO `item` VALUES (44, 'Silver Matt Backing Biru', 'PET SM 50N-PAT1-8K', 'RML', 4, 20, 10000, NULL, NULL, 0, '0', NULL, NULL);
INSERT INTO `item` VALUES (45, 'Superstick Transparant', 'PVCTB 80 NPL 11LLY', 'RMP', 4, 20, 10000, NULL, NULL, 0, '0', NULL, NULL);
INSERT INTO `item` VALUES (46, 'Thermal Backing Putih', 'LP Thermal / GL - PA \" CAMEL\"', 'RML', 7, 20, 10000, NULL, NULL, 0, '0', NULL, NULL);
INSERT INTO `item` VALUES (47, 'Vinyl White', 'Vinyl White', 'RML', 7, 20, 10000, NULL, NULL, 0, '0', NULL, NULL);
INSERT INTO `item` VALUES (48, 'Yupo Backing Biru', 'YUPO 80 (TTR) PW7 8K ', 'RML', 7, 20, 10000, NULL, NULL, 0, '0', NULL, NULL);
INSERT INTO `item` VALUES (49, 'Yupo Backing Putih', 'YUPO 80 (TTR) PW7 6K ', 'RML', 7, 20, 10000, NULL, NULL, 0, '0', NULL, NULL);
INSERT INTO `item` VALUES (50, 'Chrome Bright', 'PET SB50 (A) - P1069 - 11LLY', 'RML', 7, 30, 10000, NULL, NULL, 0, '0', NULL, NULL);
INSERT INTO `item` VALUES (51, 'Chromo Backing Putih', 'LP.CC/GL P-A \"CAMEL\"', 'RML', 1, 30, 10000, NULL, NULL, 0, '0', NULL, NULL);
INSERT INTO `item` VALUES (52, 'DT 500 STANDARD', 'DT 500 ', 'DT', 3, 30, 10000, NULL, NULL, 0, '0', NULL, NULL);
INSERT INTO `item` VALUES (53, 'DT 5000NS STANDARD', 'DT 5000NS ', 'DT', 3, 30, 10000, NULL, NULL, 0, '0', NULL, NULL);
INSERT INTO `item` VALUES (54, 'DT 501K STANDARD', 'DT 501K ', 'DT', 3, 30, 10000, NULL, NULL, 0, '0', NULL, NULL);
INSERT INTO `item` VALUES (55, 'DT GA808 STANDARD', 'DT GA808 ', 'DT', 3, 30, 10000, NULL, NULL, 0, '0', NULL, NULL);
INSERT INTO `item` VALUES (56, 'DT TESA 60999', 'DT TESA 60999 ', 'DT', 9, 30, 10000, NULL, NULL, 0, '0', NULL, NULL);
INSERT INTO `item` VALUES (57, 'HVS Backing Kuning', 'LP.HVS-A/RLY-B \"CAMEL\"', 'RML', 1, 30, 10000, NULL, NULL, 0, '0', NULL, NULL);
INSERT INTO `item` VALUES (58, 'HVS Backing Putih', 'LP.HVS-A/GL-PA \"CAMEL\"', 'RML', 1, 30, 10000, NULL, NULL, 0, '0', NULL, NULL);
INSERT INTO `item` VALUES (59, 'Liner Backing Kuning', 'RL.RBY-A 1/S \"CAMEL\"', 'RML', 1, 30, 10000, NULL, NULL, 0, '0', NULL, NULL);
INSERT INTO `item` VALUES (60, 'Liner Backing Putih', 'RL.GL.P-A 1/S \" CAMEL\"', 'RML', 1, 30, 10000, NULL, NULL, 0, '0', NULL, NULL);
INSERT INTO `item` VALUES (61, 'Marvel 4001A  ', 'Marvel 4001A  ', 'DT', 10, 30, 10000, NULL, NULL, 0, '0', NULL, NULL);
INSERT INTO `item` VALUES (62, 'Pet Silver Bright Backing Kuning', 'PETSB 50(A) P-1069 11 LLY', 'RMP', 4, 30, 10000, NULL, NULL, 0, '0', NULL, NULL);
INSERT INTO `item` VALUES (63, 'Plastik Film', 'PF ', 'RMP', 5, 30, 10000, NULL, NULL, 3, '3', NULL, NULL);
INSERT INTO `item` VALUES (64, 'PolyCarbonate', 'PC ', 'RMP', 3, 30, 10000, NULL, NULL, 0, '0', NULL, NULL);
INSERT INTO `item` VALUES (65, 'Polyethylene Terephthalate', 'PET ', 'RMP', 7, 30, 10000, NULL, NULL, 0, '0', NULL, NULL);
INSERT INTO `item` VALUES (66, 'PolyVinylCarbonate', 'PVC ', 'RMP', 6, 30, 10000, NULL, NULL, 0, '0', NULL, NULL);
INSERT INTO `item` VALUES (67, 'PPNG Top Pearlize', 'BW0174 PPNG Top Pearlized/S692N/BG 40 WH IMP', 'RML', 8, 30, 10000, NULL, NULL, 0, '0', NULL, NULL);
INSERT INTO `item` VALUES (68, 'PPNG Top Trans', 'BW0062N PPNG TopTrans/S692N/BG40Wh(imp) ', 'RML', 8, 30, 10000, NULL, NULL, 0, '0', NULL, NULL);
INSERT INTO `item` VALUES (69, 'Semicoat Backing Biru', 'LP.ART-B/GL.BM \"CAMEL\"', 'RML', 4, 30, 10000, NULL, NULL, 0, '0', NULL, NULL);
INSERT INTO `item` VALUES (70, 'Semicoat Backing Kuning', 'RL.RBY-A 1/S \"CAMEL\"', 'RML', 4, 30, 10000, NULL, NULL, 0, '0', NULL, NULL);
INSERT INTO `item` VALUES (71, 'Semicoat Backing Putih', 'LP.ART-B/GL P-E \"CAMEL\"', 'RML', 4, 30, 10000, NULL, NULL, 0, '0', NULL, NULL);
INSERT INTO `item` VALUES (72, 'Silver Matt', 'Silver Matt', 'RML', 4, 30, 10000, NULL, NULL, 0, '0', NULL, NULL);
INSERT INTO `item` VALUES (73, 'Silver Matt Backing Biru', 'PET SM 50N-PAT1-8K', 'RML', 4, 30, 10000, NULL, NULL, 0, '0', NULL, NULL);
INSERT INTO `item` VALUES (74, 'Superstick Transparant', 'PVCTB 80 NPL 11LLY', 'RMP', 4, 30, 10000, NULL, NULL, 0, '0', NULL, NULL);
INSERT INTO `item` VALUES (75, 'Thermal Backing Putih', 'LP Thermal / GL - PA \" CAMEL\"', 'RML', 7, 30, 10000, NULL, NULL, 0, '0', NULL, NULL);
INSERT INTO `item` VALUES (76, 'Vinyl White', 'Vinyl White', 'RML', 7, 30, 10000, NULL, NULL, 0, '0', NULL, NULL);
INSERT INTO `item` VALUES (77, 'Yupo Backing Biru', 'YUPO 80 (TTR) PW7 8K ', 'RML', 7, 30, 10000, NULL, NULL, 0, '0', NULL, NULL);
INSERT INTO `item` VALUES (78, 'Yupo Backing Putih', 'YUPO 80 (TTR) PW7 6K ', 'RML', 7, 30, 10000, NULL, NULL, 0, '0', NULL, NULL);

SET FOREIGN_KEY_CHECKS = 1;
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

 Date: 05/08/2022 06:01:08
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for supplier
-- ----------------------------
DROP TABLE IF EXISTS `supplier`;
CREATE TABLE `supplier`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `code` varchar(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `supp_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `product` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 68 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of supplier
-- ----------------------------
INSERT INTO `supplier` VALUES (1, 'S01', 'BUSAN LASER INDONESIA', 'DIE CUT');
INSERT INTO `supplier` VALUES (2, 'S02', 'UNICODE PRATAMA', 'MESIN BARCODE');
INSERT INTO `supplier` VALUES (3, 'S03', 'TOKO LARIS', 'NPI');
INSERT INTO `supplier` VALUES (4, 'S04', 'USAHA JAYA', 'NPI');
INSERT INTO `supplier` VALUES (5, 'S05', 'GEMILANG PERSADA', 'NPI');
INSERT INTO `supplier` VALUES (6, 'S06', 'BINA MULIA', 'NPI');
INSERT INTO `supplier` VALUES (7, 'S07', 'RICOH THERNAL MEDIA EAST ASIA PACIFIC', 'RIBBON');
INSERT INTO `supplier` VALUES (8, 'S08', 'R2 GENERAL RIBBON', 'RIBBON');
INSERT INTO `supplier` VALUES (9, 'S09', 'TAGEN LABELINDO', 'RIBBON');
INSERT INTO `supplier` VALUES (10, 'S10', 'SUKARDI', 'RIBBON');
INSERT INTO `supplier` VALUES (11, 'S11', 'MANOV TRENGGANA SUMAPALA', 'RIBBON');
INSERT INTO `supplier` VALUES (12, 'S12', 'KAHAR DUTA SARANA', 'RIBBON');
INSERT INTO `supplier` VALUES (13, 'S13', 'KARYA TERANG SEDATI', 'RAW MATERIAL');
INSERT INTO `supplier` VALUES (14, 'S14', 'NITTO MATERIALS INDONESIA', 'DOUBLETAPE');
INSERT INTO `supplier` VALUES (15, 'S15', 'SBP INDONESIA', 'RAW MATERIAL');
INSERT INTO `supplier` VALUES (16, 'S16', 'MULTIYASA SWADAYA', 'RAW MATERIAL');
INSERT INTO `supplier` VALUES (17, 'S17', 'SINAR CAHAYA', 'RAW MATERIAL');
INSERT INTO `supplier` VALUES (18, 'S18', 'MAJU PERKASA', 'RAW MATERIAL');
INSERT INTO `supplier` VALUES (19, 'S19', 'KUMLA', 'RAW MATERIAL');
INSERT INTO `supplier` VALUES (20, 'S20', 'IDO', 'RAW MATERIAL');
INSERT INTO `supplier` VALUES (21, 'S21', 'PUTRA MANDIRI ABADI', 'RAW MATERIAL');
INSERT INTO `supplier` VALUES (22, 'S22', 'GALERINDO GRAFIKA ADIPURA', 'RAW MATERIAL');
INSERT INTO `supplier` VALUES (23, 'S23', 'CAHAYA PRIMA', 'RAW MATERIAL');
INSERT INTO `supplier` VALUES (24, 'S24', 'OTANI PREMIUM PAPER INDUSTRY', 'RAW MATERIAL');
INSERT INTO `supplier` VALUES (25, 'S25', 'GRAFINDO JAYA PACIFIC', 'SUBCONT');
INSERT INTO `supplier` VALUES (26, 'S26', 'ASA SEJAHTERA', 'SUBCONT');
INSERT INTO `supplier` VALUES (27, 'S28', 'IDO', 'SUBCONT');
INSERT INTO `supplier` VALUES (28, 'S29', 'ACTAVIS INDONESIA', 'SUBCONT');
INSERT INTO `supplier` VALUES (29, 'S30', 'INTERCELL', 'TINTA');
INSERT INTO `supplier` VALUES (30, 'S31', 'CITRA UNION INKS', 'TINTA');
INSERT INTO `supplier` VALUES (31, 'S32', 'TINTA MAS', 'TINTA');
INSERT INTO `supplier` VALUES (32, 'S33', 'CENTRAL SATRYA PERDANA', 'TINTA');
INSERT INTO `supplier` VALUES (33, 'S34', 'WADAH MAKMUR ABADI', 'TINTA');
INSERT INTO `supplier` VALUES (34, 'S35', 'ROYAL GUARD', 'TINTA');
INSERT INTO `supplier` VALUES (35, 'S36', 'SUMBER ALAM', 'TINTA');
INSERT INTO `supplier` VALUES (36, 'S37', 'WARNA JAYA ANUGRAH', 'TINTA');
INSERT INTO `supplier` VALUES (37, 'S38', 'SARANA SEJAHTERA KURNIA', 'TINTA');
INSERT INTO `supplier` VALUES (38, 'S39', 'KARYA SARI MURNI', 'TINTA');
INSERT INTO `supplier` VALUES (39, 'S40', 'INKOTE INDONESIA', 'TINTA');
INSERT INTO `supplier` VALUES (40, 'S41', 'INK CHINA', 'TINTA');
INSERT INTO `supplier` VALUES (41, 'S42', 'SINAR BARU', 'RAW MATERIAL');
INSERT INTO `supplier` VALUES (42, 'S43', 'WARGA DJAJA', 'RAW MATERIAL');
INSERT INTO `supplier` VALUES (43, 'S44', 'AVERY DENNISON', 'RAW MATERIAL');
INSERT INTO `supplier` VALUES (44, 'S45', 'EKASURYA INOUT INDONESIA', 'RAW MATERIAL');
INSERT INTO `supplier` VALUES (45, 'S46', 'SHURE KARYA INDONESIA', 'DOUBLETAPE');
INSERT INTO `supplier` VALUES (46, 'S47', 'RITRAINDO LABEL INTERNATIONAL', 'RAW MATERIAL');
INSERT INTO `supplier` VALUES (47, 'S48', 'BERKAH JAYA', 'DIE CUT');
INSERT INTO `supplier` VALUES (48, 'S49', 'CIPTA DATA TEKNOLOGI', 'SUBCONT');
INSERT INTO `supplier` VALUES (49, 'S50', 'DWI INDAH', 'RAW MATERIAL');
INSERT INTO `supplier` VALUES (50, 'S51', 'ESECODHARMA PERMAI', 'NPI');
INSERT INTO `supplier` VALUES (51, 'S52', 'GARUDA GEMILANG', 'RAW MATERIAL');
INSERT INTO `supplier` VALUES (52, 'S53', 'KUMALA MOTOR', 'RAW MATERIAL');
INSERT INTO `supplier` VALUES (53, 'S54', 'KURNIADI', 'NPI');
INSERT INTO `supplier` VALUES (54, 'S55', 'MEL LESTARI', 'RAW MATERIAL');
INSERT INTO `supplier` VALUES (55, 'S56', 'SUMBER REJEKI', 'RAW MATERIAL');
INSERT INTO `supplier` VALUES (56, 'S57', 'SURYA ABADI PRINTING', 'RAW MATERIAL');
INSERT INTO `supplier` VALUES (57, 'S58', 'PUSAT PLASTIK', 'RAW MATERIAL');
INSERT INTO `supplier` VALUES (58, 'S59', 'TUNAS DUNIA KERTASINDO', 'RIBBON');
INSERT INTO `supplier` VALUES (59, 'S60', 'GLOBAL REJEKI', 'DIE CUT');
INSERT INTO `supplier` VALUES (60, 'S61', 'CEMANI TOKA ', 'TINTA');
INSERT INTO `supplier` VALUES (61, 'S62', 'AGUNG BARU', 'DIE CUT');
INSERT INTO `supplier` VALUES (62, 'S63', 'WISNU POTONG BAHAN', 'SUBCONT');
INSERT INTO `supplier` VALUES (63, 'S64', 'CIPTA BERKAH', 'DIE CUT');
INSERT INTO `supplier` VALUES (64, 'S65', 'KARYA MANDIRI GUNA', 'RAW MATERIAL');
INSERT INTO `supplier` VALUES (65, 'S66', 'JUJO CHEMICAL', 'TINTA');
INSERT INTO `supplier` VALUES (66, 'S67', 'SINAR SURYA MAS', 'RAW MATERIAL');
INSERT INTO `supplier` VALUES (67, 'S68', 'CIMEILING', 'RAW MATERIAL');

SET FOREIGN_KEY_CHECKS = 1;
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

 Date: 05/08/2022 06:01:18
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `complete_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `phone` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `position` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `birthdate` datetime NULL DEFAULT NULL,
  `birth` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES (1, 'admin1', 'Admin', '08293892389', 'Admin Gudang', '2021-07-01 00:00:00', 'jakarta', '4297f44b13955235245b2497399d7a93');

SET FOREIGN_KEY_CHECKS = 1;
