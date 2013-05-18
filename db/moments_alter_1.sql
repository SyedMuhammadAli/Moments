ALTER TABLE `moments_db`.`media` CHANGE COLUMN `media_id` `media_id` INT(11) NOT NULL  , CHANGE COLUMN `name` `artistName` VARCHAR(64) NOT NULL  , CHANGE COLUMN `path` `previewUrl` VARCHAR(256) NULL DEFAULT NULL  , ADD COLUMN `trackName` VARCHAR(64) NULL  AFTER `previewUrl` , ADD COLUMN `artworkUrl` VARCHAR(128) NULL  AFTER `trackName` ;

