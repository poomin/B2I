ALTER TABLE `b2i_user`
	ADD COLUMN `userremove` ENUM('n','y') NOT NULL DEFAULT 'n' AFTER `confirmemail`;
