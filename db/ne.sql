ALTER TABLE `warehouse-db`.`item_lot` 
ADD COLUMN `updated_date` datetime NULL AFTER `incoming`;

ALTER TABLE `warehouse-db`.`item_lot` 
ADD COLUMN `act` int NULL AFTER `updated_date`;

ALTER TABLE `warehouse-db`.`item_lot` 
ADD COLUMN `note` varchar(255) NULL AFTER `act`;