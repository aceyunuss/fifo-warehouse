ALTER TABLE `warehouse-db`.`spk` 
ADD COLUMN `qty_req` int NULL AFTER `supplier`;

ALTER TABLE `warehouse-db`.`inbound` 
ADD COLUMN `pict` varchar(255) NULL AFTER `status`;