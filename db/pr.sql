CREATE TABLE `warehouse-db`.`pr`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `pr` varchar(255) NULL,
  `pr_date` datetime NULL,
  `spk_date` datetime NULL,
  `category` varchar(255) NULL,
  `status_id` int NULL,
  `status` varchar(255) NULL,
  PRIMARY KEY (`id`)
);