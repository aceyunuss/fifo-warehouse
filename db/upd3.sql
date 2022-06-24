ALTER TABLE `warehouse-db`.`inbound_item` 
ADD COLUMN `incoming` datetime(6) NULL AFTER `width`;

ALTER TABLE `warehouse-db`.`item_lot` 
ADD COLUMN `incoming` datetime(6) NULL AFTER `qty`;

ALTER TABLE `warehouse-db`.`item` 
ADD COLUMN `cat` varchar(255) NULL AFTER `name`;

ALTER TABLE `warehouse-db`.`item_stock` 
ADD COLUMN `supp` varchar(255) NULL AFTER `wd`;