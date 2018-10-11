ALTER TABLE `b2i_project_confirm_member`
	ADD COLUMN `name_title` VARCHAR(255) NULL DEFAULT NULL AFTER `classroom`,
	ADD COLUMN `name_thai` VARCHAR(255) NULL DEFAULT NULL AFTER `name_title`,
	ADD COLUMN `surname_thai` VARCHAR(255) NULL DEFAULT NULL AFTER `name_thai`;
