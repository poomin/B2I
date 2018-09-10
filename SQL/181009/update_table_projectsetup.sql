ALTER TABLE `b2i_projectsetup`
	ADD COLUMN `phase1confirm` ENUM('close','process','wait') NOT NULL DEFAULT 'close' AFTER `phase1detail`,
	ADD COLUMN `phase1confirmdetail` TEXT NULL AFTER `phase1confirm`,
	ADD COLUMN `phase2confirm` ENUM('close','process','wait') NOT NULL DEFAULT 'close' AFTER `phase2detail`,
	ADD COLUMN `phase2confirmdetail` TEXT NULL AFTER `phase2confirm`,
	ADD COLUMN `phase3confirm` ENUM('close','process','wait') NOT NULL DEFAULT 'close' AFTER `phase3detail`,
	ADD COLUMN `phase3confirmdetail` TEXT NULL AFTER `phase3confirm`;