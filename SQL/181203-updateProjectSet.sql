ALTER TABLE `b2i_projectsetup`
	ADD COLUMN `image` TEXT NULL AFTER `detail`;

ALTER TABLE `b2i_projectsetup`
	CHANGE COLUMN `active` `active` ENUM('Y','N') NOT NULL DEFAULT 'N' AFTER `image`;