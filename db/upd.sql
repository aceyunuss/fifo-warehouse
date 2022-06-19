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

 Date: 19/06/2022 20:19:16
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

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
) ENGINE = InnoDB AUTO_INCREMENT = 40 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

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

 Date: 19/06/2022 20:19:31
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

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
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

SET FOREIGN_KEY_CHECKS = 1;


ALTER TABLE `warehouse-db`.`item_stock` 
ADD COLUMN `code` varchar(255) NULL AFTER `item_id`;


CREATE OR REPLACE ALGORITHM = UNDEFINED DEFINER = `root`@`localhost` SQL SECURITY DEFINER VIEW `warehouse-db`.`todo_v` AS select `x`.`id` AS `id`,`x`.`status_id` AS `status_id`,`x`.`no` AS `no`,`x`.`dt` AS `dt`,`x`.`typ` AS `typ`,`x`.`lk` AS `lk` from (select `warehouse-db`.`inbound`.`id` AS `id`,`warehouse-db`.`inbound`.`status_id` AS `status_id`,`warehouse-db`.`inbound`.`bpb` AS `no`,`warehouse-db`.`inbound`.`bpb_date` AS `dt`,'Bukti Penerimaan Barang' AS `typ`,concat('inbound/process/',`warehouse-db`.`inbound`.`id`) AS `lk` from `warehouse-db`.`inbound` union select `warehouse-db`.`request`.`id` AS `id`,`warehouse-db`.`request`.`status_id` AS `status_id`,`warehouse-db`.`request`.`spb` AS `no`,`warehouse-db`.`request`.`spb_date` AS `dt`,'Permintaan Barang' AS `typ`,concat('req/process/',`warehouse-db`.`request`.`id`) AS `lk` from `warehouse-db`.`request` union select `warehouse-db`.`outbound`.`id` AS `id`,`warehouse-db`.`outbound`.`status_id` AS `status_id`,`warehouse-db`.`outbound`.`stb` AS `no`,`warehouse-db`.`outbound`.`stb_date` AS `dt`,'Barang Keluar' AS `typ`,concat('outbound/process/',`warehouse-db`.`outbound`.`id`) AS `lk` from `warehouse-db`.`outbound`) `x` ;