SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;

USE `mydb`;

CREATE  TABLE IF NOT EXISTS `mydb`.`users` (
  `iduser` INT(11) NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(255) NULL DEFAULT NULL ,
  `email` VARCHAR(255) NULL DEFAULT NULL ,
  `password` VARCHAR(255) NULL DEFAULT NULL ,
  `direccion` VARCHAR(255) NULL DEFAULT NULL ,
  `descripcion` TEXT NULL DEFAULT NULL ,
  `pets` VARCHAR(45) NULL DEFAULT NULL ,
  `photo` VARCHAR(255) NULL DEFAULT NULL ,
  `genders_idgender` INT(11) NOT NULL ,
  `cities_idcity` INT(11) NOT NULL ,
  PRIMARY KEY (`iduser`) ,
  INDEX `fk_users_genders_idx` (`genders_idgender` ASC) ,
  INDEX `fk_users_cities1_idx` (`cities_idcity` ASC) ,
  CONSTRAINT `fk_users_genders`
    FOREIGN KEY (`genders_idgender` )
    REFERENCES `mydb`.`genders` (`idgender` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_cities1`
    FOREIGN KEY (`cities_idcity` )
    REFERENCES `mydb`.`cities` (`idcity` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

CREATE  TABLE IF NOT EXISTS `mydb`.`genders` (
  `idgender` INT(11) NOT NULL AUTO_INCREMENT ,
  `gender` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`idgender`) ,
  UNIQUE INDEX `gender_UNIQUE` (`gender` ASC) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

CREATE  TABLE IF NOT EXISTS `mydb`.`cities` (
  `idcity` INT(11) NOT NULL AUTO_INCREMENT ,
  `city` VARCHAR(255) NULL DEFAULT NULL ,
  PRIMARY KEY (`idcity`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

CREATE  TABLE IF NOT EXISTS `mydb`.`sports` (
  `idsport` INT(11) NOT NULL AUTO_INCREMENT ,
  `sport` VARCHAR(255) NULL DEFAULT NULL ,
  PRIMARY KEY (`idsport`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

CREATE  TABLE IF NOT EXISTS `mydb`.`users_has_sports` (
  `users_iduser` INT(11) NOT NULL ,
  `sports_idsport` INT(11) NOT NULL ,
  PRIMARY KEY (`users_iduser`, `sports_idsport`) ,
  INDEX `fk_users_has_sports_sports1_idx` (`sports_idsport` ASC) ,
  INDEX `fk_users_has_sports_users1_idx` (`users_iduser` ASC) ,
  CONSTRAINT `fk_users_has_sports_users1`
    FOREIGN KEY (`users_iduser` )
    REFERENCES `mydb`.`users` (`iduser` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_has_sports_sports1`
    FOREIGN KEY (`sports_idsport` )
    REFERENCES `mydb`.`sports` (`idsport` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

CREATE  TABLE IF NOT EXISTS `mydb`.`pets` (
  `idpet` INT(11) NOT NULL ,
  `pet` VARCHAR(255) NULL DEFAULT NULL ,
  PRIMARY KEY (`idpet`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
