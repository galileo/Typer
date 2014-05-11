
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

#-----------------------------------------------------------------------------
#-- typy_turniej
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `typy_turniej`;


CREATE TABLE `typy_turniej`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`nazwa` VARCHAR(50),
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- typy_mecz
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `typy_mecz`;


CREATE TABLE `typy_mecz`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`turniej_id` INTEGER,
	`zespol1` VARCHAR(20)  NOT NULL,
	`zespol2` VARCHAR(20)  NOT NULL,
	`gole1` INTEGER(2),
	`gole2` INTEGER(2),
	`data` DATETIME,
	`aktywny` INTEGER,
	`rozegrany` INTEGER,
	`status` INTEGER(2),
	`typy_ilosc` INTEGER,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `typy_mecz_FI_1` (`turniej_id`),
	CONSTRAINT `typy_mecz_FK_1`
		FOREIGN KEY (`turniej_id`)
		REFERENCES `typy_turniej` (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- typy_komentarze
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `typy_komentarze`;


CREATE TABLE `typy_komentarze`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`user_id` INTEGER  NOT NULL,
	`tytul` VARCHAR(255),
	`tresc` TEXT,
	`created_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `typy_komentarze_FI_1` (`user_id`),
	CONSTRAINT `typy_komentarze_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `sf_guard_user` (`id`)
		ON DELETE CASCADE
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- typy_typ
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `typy_typ`;


CREATE TABLE `typy_typ`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`user_id` INTEGER  NOT NULL,
	`mecz_id` INTEGER,
	`gole1` INTEGER(2),
	`gole2` INTEGER(2),
	`status` INTEGER(1),
	`punkty` INTEGER(3),
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `typy_typ_FI_1` (`user_id`),
	CONSTRAINT `typy_typ_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `sf_guard_user` (`id`)
		ON DELETE CASCADE,
	INDEX `typy_typ_FI_2` (`mecz_id`),
	CONSTRAINT `typy_typ_FK_2`
		FOREIGN KEY (`mecz_id`)
		REFERENCES `typy_mecz` (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- typy_punkty
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `typy_punkty`;


CREATE TABLE `typy_punkty`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`punkty` INTEGER(5),
	`turniej_id` INTEGER,
	`user_id` INTEGER  NOT NULL,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `typy_punkty_FI_1` (`turniej_id`),
	CONSTRAINT `typy_punkty_FK_1`
		FOREIGN KEY (`turniej_id`)
		REFERENCES `typy_turniej` (`id`),
	INDEX `typy_punkty_FI_2` (`user_id`),
	CONSTRAINT `typy_punkty_FK_2`
		FOREIGN KEY (`user_id`)
		REFERENCES `sf_guard_user` (`id`)
		ON DELETE CASCADE
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- sf_guard_user_profile
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `sf_guard_user_profile`;


CREATE TABLE `sf_guard_user_profile`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`user_id` INTEGER  NOT NULL,
	`first_name` VARCHAR(20),
	`last_name` VARCHAR(20),
	`email` VARCHAR(32),
	`aktywny` INTEGER(1),
	`birthday` DATE,
	`pieniadze` INTEGER(2),
	PRIMARY KEY (`id`),
	INDEX `sf_guard_user_profile_FI_1` (`user_id`),
	CONSTRAINT `sf_guard_user_profile_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `sf_guard_user` (`id`)
		ON DELETE CASCADE
)Type=MyISAM;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
