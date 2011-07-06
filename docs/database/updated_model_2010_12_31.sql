SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `capston4_wins` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ;
USE `capston4_wins` ;

-- -----------------------------------------------------
-- Table `capston4_wins`.`role`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `capston4_wins`.`role` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(50) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `capston4_wins`.`user`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `capston4_wins`.`user` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(30) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL ,
  `password` VARCHAR(40) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL ,
  `email` VARCHAR(255) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL ,
  `created` DATETIME NOT NULL ,
  `confirmed` TINYINT(1) NOT NULL DEFAULT '0' ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `name_UNIQUE` (`name` ASC) ,
  UNIQUE INDEX `email_UNIQUE` (`email` ASC) )
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `capston4_wins`.`user_has_role`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `capston4_wins`.`user_has_role` (
  `user_id` INT(11) NOT NULL ,
  `role_id` INT(11) NOT NULL ,
  PRIMARY KEY (`user_id`, `role_id`) ,
  INDEX `fk_user_has_role_role1` (`role_id` ASC) ,
  CONSTRAINT `fk_user_has_role_role`
    FOREIGN KEY (`role_id` )
    REFERENCES `capston4_wins`.`role` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_has_role_user`
    FOREIGN KEY (`user_id` )
    REFERENCES `capston4_wins`.`user` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `capston4_wins`.`wins_and_wants`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `capston4_wins`.`wins_and_wants` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `created` DATE NULL DEFAULT NULL ,
  `wins_01` VARCHAR(140) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL ,
  `wins_02` VARCHAR(140) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL ,
  `wins_03` VARCHAR(140) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL ,
  `wins_04` VARCHAR(140) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL ,
  `wins_05` VARCHAR(140) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL ,
  `wants_01` VARCHAR(140) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL ,
  `wants_02` VARCHAR(140) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL ,
  `wants_03` VARCHAR(140) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL ,
  `wants_04` VARCHAR(140) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL ,
  `wants_05` VARCHAR(140) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL ,
  `user_id` INT(11) NOT NULL ,
  PRIMARY KEY (`id`, `user_id`) ,
  INDEX `fk_wins_and_wants_user1` (`user_id` ASC) ,
  CONSTRAINT `fk_wins_and_wants_user1`
    FOREIGN KEY (`user_id` )
    REFERENCES `capston4_wins`.`user` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `capston4_wins`.`share`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `capston4_wins`.`share` (
  `id` INT(11) NOT NULL AUTO_INCREMENT COMMENT '			' ,
  `wins_and_wants_id` INT(11) NOT NULL ,
  `wins_and_wants_user_id` INT(11) NOT NULL ,
  `shared_wins` VARCHAR(9) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL ,
  `shared_wants` VARCHAR(9) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL ,
  `shared_user_id` INT(11) NULL DEFAULT '0' ,
  PRIMARY KEY (`id`, `wins_and_wants_id`, `wins_and_wants_user_id`) ,
  INDEX `fk_shared_wins_and_wants1` (`wins_and_wants_id` ASC, `wins_and_wants_user_id` ASC) ,
  INDEX `fk_share_user_id` (`shared_user_id` ASC) ,
  CONSTRAINT `fk_shared_wins_and_wants1`
    FOREIGN KEY (`wins_and_wants_id` , `wins_and_wants_user_id` )
    REFERENCES `capston4_wins`.`wins_and_wants` (`id` , `user_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `capston4_wins`.`comment`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `capston4_wins`.`comment` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `share_id` INT(11) NOT NULL ,
  `share_wins_and_wants_id` INT(11) NOT NULL ,
  `share_wins_and_wants_user_id` INT(11) NOT NULL ,
  `shared_user_id` INT(11) NOT NULL ,
  `text` TEXT NULL ,
  `created` DATE NOT NULL ,
  `updated` DATETIME NOT NULL ,
  PRIMARY KEY (`id`, `share_id`, `share_wins_and_wants_id`, `share_wins_and_wants_user_id`, `shared_user_id`) ,
  INDEX `fk_comment_share1` (`share_id` ASC, `share_wins_and_wants_id` ASC, `share_wins_and_wants_user_id` ASC) ,
  INDEX `fk_comment_user1` (`shared_user_id` ASC) ,
  CONSTRAINT `fk_comment_share1`
    FOREIGN KEY (`share_id` , `share_wins_and_wants_id` , `share_wins_and_wants_user_id` )
    REFERENCES `capston4_wins`.`share` (`id` , `wins_and_wants_id` , `wins_and_wants_user_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_comment_user1`
    FOREIGN KEY (`shared_user_id` )
    REFERENCES `capston4_wins`.`user` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
