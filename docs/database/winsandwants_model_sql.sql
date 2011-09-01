SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `capston4_wins` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ;
USE `capston4_wins` ;

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
AUTO_INCREMENT = 31
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `capston4_wins`.`goal`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `capston4_wins`.`goal` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `goal` VARCHAR(140) NOT NULL ,
  `notes` VARCHAR(255) NULL DEFAULT NULL ,
  `goal_date` DATETIME NOT NULL ,
  `done` TINYINT(1) NOT NULL DEFAULT '0' ,
  `user_id` INT(11) NOT NULL ,
  `created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_goal_user` (`user_id` ASC) ,
  CONSTRAINT `fk_goal_user`
    FOREIGN KEY (`user_id` )
    REFERENCES `capston4_wins`.`user` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


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
-- Table `capston4_wins`.`shared_goal`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `capston4_wins`.`shared_goal` (
  `id` INT(11) NOT NULL ,
  `goal_id` INT(11) NOT NULL ,
  `user_id` INT(11) NOT NULL ,
  `friend_user_id` INT(11) NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_shared_goals_goal1` (`goal_id` ASC) ,
  INDEX `fk_shared_goals_user1` (`user_id` ASC) ,
  INDEX `fk_shared_goals_friends1` (`friend_user_id` ASC) ,
  CONSTRAINT `fk_shared_goals_friends1`
    FOREIGN KEY (`friend_user_id` )
    REFERENCES `capston4_wins`.`user` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_shared_goals_goal1`
    FOREIGN KEY (`goal_id` )
    REFERENCES `capston4_wins`.`goal` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_shared_goals_user1`
    FOREIGN KEY (`user_id` )
    REFERENCES `capston4_wins`.`user` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
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
-- Table `capston4_wins`.`friend`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `capston4_wins`.`friend` (
  `id` INT(11) NOT NULL ,
  `user_id` INT(11) NOT NULL ,
  `friend_user_id` INT(11) NOT NULL ,
  `confirmed` TINYINT(1) NOT NULL DEFAULT 0 ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_friend_user` (`user_id` ASC) ,
  INDEX `fk_friend_user_id` (`friend_user_id` ASC) ,
  CONSTRAINT `fk_friend_user`
    FOREIGN KEY (`user_id` )
    REFERENCES `capston4_wins`.`user` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_friend_user_id`
    FOREIGN KEY (`friend_user_id` )
    REFERENCES `capston4_wins`.`user` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
