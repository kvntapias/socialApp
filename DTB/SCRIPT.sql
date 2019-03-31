-- MySQL Script generated by MySQL Workbench
-- Sun Mar 31 18:51:18 2019
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema socialApp
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema socialApp
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `socialApp` DEFAULT CHARACTER SET utf8 ;
USE `socialApp` ;

-- -----------------------------------------------------
-- Table `socialApp`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `socialApp`.`users` (
  `id` INT(255) NOT NULL,
  `name` VARCHAR(100) NOT NULL,
  `surname` VARCHAR(200) NOT NULL,
  `nick` VARCHAR(100) CHARACTER SET 'utf8mb4' NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `created_at` DATETIME NOT NULL,
  `updated_at` DATETIME NULL,
  `remember_token` VARCHAR(255) NULL,
  `image` VARCHAR(255) NULL,
  `role` VARCHAR(20) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `socialApp`.`images`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `socialApp`.`images` (
  `id` INT(255) NOT NULL,
  `user_id` INT(255) NOT NULL,
  `image_path` VARCHAR(255) NOT NULL,
  `description` TEXT(5000) NULL,
  `created_at` DATETIME NOT NULL,
  `udpated_at` DATETIME NULL,
  PRIMARY KEY (`id`),
  INDEX `image_user_idx` (`user_id` ASC) ,
  CONSTRAINT `image_user`
    FOREIGN KEY (`user_id`)
    REFERENCES `socialApp`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `socialApp`.`comments`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `socialApp`.`comments` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `user_id` INT NOT NULL,
  `image_id` INT NOT NULL,
  `content` TEXT(5000) NOT NULL,
  `created_at` DATETIME NOT NULL,
  `udpated_at` DATETIME NULL,
  PRIMARY KEY (`id`),
  INDEX `comments_users_idx` (`user_id` ASC) ,
  INDEX `comments_images_idx` (`image_id` ASC) ,
  CONSTRAINT `comments_users`
    FOREIGN KEY (`user_id`)
    REFERENCES `socialApp`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `comments_images`
    FOREIGN KEY (`image_id`)
    REFERENCES `socialApp`.`images` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `socialApp`.`likes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `socialApp`.`likes` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `user_id` INT NOT NULL,
  `image_id` INT NULL,
  `created_at` VARCHAR(45) NULL,
  `updated_at` VARCHAR(45) NULL,
  PRIMARY KEY (`id`),
  INDEX `likes_users_idx` (`user_id` ASC) ,
  INDEX `likes_images_idx` (`image_id` ASC) ,
  CONSTRAINT `likes_users`
    FOREIGN KEY (`user_id`)
    REFERENCES `socialApp`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `likes_images`
    FOREIGN KEY (`image_id`)
    REFERENCES `socialApp`.`images` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
