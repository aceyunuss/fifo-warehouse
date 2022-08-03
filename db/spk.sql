CREATE TABLE `warehouse-db`.`spk`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `spk` varchar(255) NULL,
  `description` varchar(255) NULL,
  `spk_date` datetime NULL,
  `category` varchar(255) NULL,
  `status_id` int NULL,
  `status` varchar(255) NULL,
  PRIMARY KEY (`id`)
);