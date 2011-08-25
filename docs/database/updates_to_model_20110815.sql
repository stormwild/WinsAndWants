CREATE  TABLE IF NOT EXISTS `winsandwants`.`goal` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `goal` VARCHAR(140) NOT NULL ,
  `notes` VARCHAR(255) NULL DEFAULT NULL ,
  `goal_date` DATETIME NOT NULL ,
  `done` TINYINT(1) NOT NULL DEFAULT false ,
  `user_id` INT(11) NOT NULL ,
  `created` TIMESTAMP NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_goal_user` (`user_id` ASC) ,
  CONSTRAINT `fk_goal_user`
    FOREIGN KEY (`user_id` )
    REFERENCES `winsandwants`.`user` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8



CREATE  TABLE IF NOT EXISTS `winsandwants`.`shared_goal` (
  `id` INT NOT NULL ,
  `goal_id` INT(11) NOT NULL ,
  `user_id` INT(11) NOT NULL ,
  `friends_user_id` INT(11) NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_shared_goals_goal1` (`goal_id` ASC) ,
  INDEX `fk_shared_goals_user1` (`user_id` ASC) ,
  INDEX `fk_shared_goals_friends1` (`friends_user_id` ASC) ,
  CONSTRAINT `fk_shared_goals_goal1`
    FOREIGN KEY (`goal_id` )
    REFERENCES `winsandwants`.`goal` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_shared_goals_user1`
    FOREIGN KEY (`user_id` )
    REFERENCES `winsandwants`.`user` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_shared_goals_friends1`
    FOREIGN KEY (`friends_user_id` )
    REFERENCES `winsandwants`.`user` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB