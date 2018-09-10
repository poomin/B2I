ALTER TABLE `b2i_school`
	ADD COLUMN `address` VARCHAR(255) NULL AFTER `school_name`,
	ADD COLUMN `subdistrict` VARCHAR(255) NULL AFTER `address`,
	ADD COLUMN `district` VARCHAR(255) NULL AFTER `subdistrict`,
	ADD COLUMN `province` VARCHAR(255) NULL AFTER `district`,
	ADD COLUMN `code` VARCHAR(255) NULL AFTER `province`;