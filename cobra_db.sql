-- MySQL Script generated by MySQL Workbench
-- Tue Mar 31 19:31:32 2015
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema cobra
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `cobra` ;

-- -----------------------------------------------------
-- Schema cobra
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `cobra` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
SHOW WARNINGS;
USE `cobra` ;

-- -----------------------------------------------------
-- Table `cobra`.`person_dim`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cobra`.`person_dim` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `cobra`.`person_dim` (
  `id_person_dim` INT NOT NULL AUTO_INCREMENT,
  `person_authority` VARCHAR(45) NULL,
  `surname` VARCHAR(45) NULL,
  `forename` VARCHAR(45) NULL,
  `name_title` VARCHAR(45) NULL,
  `name_role` VARCHAR(45) NULL,
  `anonymous` BOOL NULL, -- use true or false here?
  `alt_name` VARCHAR(45) NULL, -- if signed with a false name
  `birth_year` VARCHAR(45) NULL,
  `byear_source` VARCHAR(45) NULL,
  `grade` INT NULL,
  `race` VARCHAR(45) NULL,
  `ethnicity` VARCHAR(45) NULL,
  `sex` VARCHAR(45) NULL,
  `gender` VARCHAR(45) NULL,
  `occupation` VARCHAR(45) NULL,
  `occu_source` VARCHAR(45) NULL,
  PRIMARY KEY (`id_person_dim`))
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `cobra`.`location_dim`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cobra`.`location_dim` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `cobra`.`location_dim` (
  `id_location_dim` INT NOT NULL AUTO_INCREMENT,
  `street` VARCHAR(45) NULL,
  `city` VARCHAR(45) NULL,
  `state` VARCHAR(45) NULL,
  `country` VARCHAR(45) NULL,
  `zip_code` VARCHAR(45) NULL,
  PRIMARY KEY (`id_location_dim`))
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `cobra`.`letter_dim`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cobra`.`letter_dim` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `cobra`.`letter_dim` (
  `id_letter_dim` INT NOT NULL AUTO_INCREMENT,
  `letter_title` VARCHAR(45) NULL,
  `salutation` VARCHAR(45) NULL,
  `closing` VARCHAR(45) NULL,
  `letter_text` VARCHAR(255) NULL,
  `letter_pg_title` VARCHAR(45) NULL,
  PRIMARY KEY (`id_letter_dim`))
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `cobra`.`review_dim`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cobra`.`review_dim` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `cobra`.`review_dim` (
  `id_review_dim` INT NOT NULL AUTO_INCREMENT,
  `review_title` VARCHAR(45) NULL,
  `review_text` VARCHAR(255) NULL,
  PRIMARY KEY (`id_review_dim`))
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `cobra`.`contest_dim`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cobra`.`contest_dim` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `cobra`.`contest_dim` (
  `id_contest_dim` INT NOT NULL AUTO_INCREMENT,
  `contest_name` VARCHAR(45) NULL,
  `contest_desc` VARCHAR(45) NULL,
  `contest_affiliation` VARCHAR(45) NULL,
  PRIMARY KEY (`id_contest_dim`))
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `cobra`.`club_dim`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cobra`.`club_dim` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `cobra`.`club_dim` (
  `id_club_dim` INT NOT NULL AUTO_INCREMENT,
  `fan_club_name` VARCHAR(45) NULL,
  `fan_club_abbr` VARCHAR(45) NULL,
  `club_association` VARCHAR(45) NULL,
  PRIMARY KEY (`id_club_dim`))
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `cobra`.`meeting_dim`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cobra`.`meeting_dim` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `cobra`.`meeting_dim` (
  `id_meeting_dim` INT NOT NULL AUTO_INCREMENT,
  `mtg_name` VARCHAR(45) NULL,
  PRIMARY KEY (`id_meeting_dim`))
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `cobra`.`editorial_dim`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cobra`.`editorial_dim` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `cobra`.`editorial_dim` (
  `id_editorial_dim` INT NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id_editorial_dim`))
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `cobra`.`classified_dim`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cobra`.`classified_dim` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `cobra`.`classified_dim` (
  `id_classified_dim` INT NOT NULL AUTO_INCREMENT,
  `classified_title` VARCHAR(45) NULL,
  `classified_info` VARCHAR(45) NULL,
  PRIMARY KEY (`id_classified_dim`))
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `cobra`.`pen_pals_dim`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cobra`.`pen_pals_dim` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `cobra`.`pen_pals_dim` (
  `id_pen_pals_dim` INT NOT NULL AUTO_INCREMENT,
  `column_title` VARCHAR(45) NULL,
  `penpals_desc` VARCHAR(255) NULL,
  PRIMARY KEY (`id_pen_pals_dim`))
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `cobra`.`traces_dim`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cobra`.`traces_dim` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `cobra`.`traces_dim` (
  `id_traces_dim` INT NOT NULL AUTO_INCREMENT,
  `traces_col_title` VARCHAR(45) NULL,
  `traces_desc` VARCHAR(255) NULL, 
  PRIMARY KEY (`id_traces_dim`))
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `cobra`.`source_of_source_dim`
-- Not sure how this should be connected
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cobra`.`source_of_source` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `cobra`.`source_of_source` (
  `id_source_of_source` INT NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id_source_of_source`))
ENGINE = InnoDB;

SHOW WARNINGS;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `cobra`.`source_dim`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cobra`.`source_dim` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `cobra`.`source_dim` (
  `id_source_dim` INT NOT NULL AUTO_INCREMENT,
  `source_name` VARCHAR(45) NULL,
  `GCD_link` VARCHAR(45) NULL,
  `pub_date` VARCHAR(45) NULL,
  `issue_number` VARCHAR(45) NULL,
  `series_name` VARCHAR(45) NULL,
  `page_num` INT,
  `id_source_of_source` INT,
  PRIMARY KEY (`id_source_dim`),
  CONSTRAINT `fk_source_dim`
    FOREIGN KEY (`id_source_of_source`)
    REFERENCES `cobra`.`source_of_source` (`id_source_of_source`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `cobra`.`activity_fact`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cobra`.`activity_fact` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `cobra`.`activity_fact` (
  `id_activity_fact` INT NOT NULL AUTO_INCREMENT,
  `fact_person` INT,
  `fact_location` INT,
  `fact_letter` INT,
  `fact_review` INT,
  `fact_contest` INT,
  `fact_club` INT,
  `fact_meeting` INT,
  `fact_editorial` INT,
  `fact_classified` INT,
  `fact_pen_pals` INT,
  `fact_traces` INT,
  `fact_source` INT,
  PRIMARY KEY (`id_activity_fact`),
  INDEX `fk_activity_fact_person_dim_idx` (`fact_person` ASC),
  INDEX `fk_activity_fact_location_dim1_idx` (`fact_location` ASC),
  INDEX `fk_activity_fact_letter_dim1_idx` (`fact_letter` ASC),
  INDEX `fk_activity_fact_review_dim1_idx` (`fact_review` ASC),
  INDEX `fk_activity_fact_contest_dim1_idx` (`fact_contest` ASC),
  INDEX `fk_activity_fact_club_dim1_idx` (`fact_club` ASC),
  INDEX `fk_activity_fact_meeting_dim1_idx` (`fact_meeting` ASC),
  INDEX `fk_activity_fact_editorial_dim1_idx` (`fact_editorial` ASC),
  INDEX `fk_activity_fact_classified_dim1_idx` (`fact_classified` ASC),
  INDEX `fk_activity_fact_pen_pals_dim1_idx` (`fact_pen_pals` ASC),
  INDEX `fk_activity_fact_traces_dim1_idx` (`fact_traces` ASC),
  INDEX `fk_activity_fact_source_dim1_idx` (`fact_source` ASC),
  CONSTRAINT `fk_activity_fact_person_dim`
    FOREIGN KEY (`fact_person`)
    REFERENCES `cobra`.`person_dim` (`id_person_dim`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_activity_fact_location_dim1`
    FOREIGN KEY (`fact_location`)
    REFERENCES `cobra`.`location_dim` (`id_location_dim`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_activity_fact_letter_dim1`
    FOREIGN KEY (`fact_letter`)
    REFERENCES `cobra`.`letter_dim` (`id_letter_dim`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_activity_fact_review_dim1`
    FOREIGN KEY (`fact_review`)
    REFERENCES `cobra`.`review_dim` (`id_review_dim`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_activity_fact_contest_dim1`
    FOREIGN KEY (`fact_contest`)
    REFERENCES `cobra`.`contest_dim` (`id_contest_dim`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_activity_fact_club_dim1`
    FOREIGN KEY (`fact_club`)
    REFERENCES `cobra`.`club_dim` (`id_club_dim`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_activity_fact_meeting_dim1`
    FOREIGN KEY (`fact_meeting`)
    REFERENCES `cobra`.`meeting_dim` (`id_meeting_dim`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_activity_fact_editorial_dim1`
    FOREIGN KEY (`fact_editorial`)
    REFERENCES `cobra`.`editorial_dim` (`id_editorial_dim`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_activity_fact_classified_dim1`
    FOREIGN KEY (`fact_classified`)
    REFERENCES `cobra`.`classified_dim` (`id_classified_dim`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_activity_fact_pen_pals_dim1`
    FOREIGN KEY (`fact_pen_pals`)
    REFERENCES `cobra`.`pen_pals_dim` (`id_pen_pals_dim`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_activity_fact_traces_dim1`
    FOREIGN KEY (`fact_traces`)
    REFERENCES `cobra`.`traces_dim` (`id_traces_dim`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_activity_fact_source_dim1`
    FOREIGN KEY (`fact_source`)
    REFERENCES `cobra`.`source_dim` (`id_source_dim`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Insert statements
-- -----------------------------------------------------


INSERT INTO source_dim (source_name, pub_date, issue_number, series_name) VALUES ('issue', 'March 1962', '1', 'Fantastic 4');
INSERT INTO person_dim (surname, forename, gender) VALUES ('Weiss', 'Alan', 'male');
INSERT INTO location_dim (street, city, state, country) VALUES ('Pardee Place', 'Las Vegas', 'Nevada', 'United States of America');
INSERT INTO letter_dim (salutation, letter_text, letter_pg_title) VALUES ('Dear Editor', 'hello! this is a letter from Alan Weiss', 'Fantastic 4 Fan Page');

INSERT INTO activity_fact (fact_person, fact_location, fact_letter, fact_source) SELECT person_dim.id_person_dim, location_dim.id_location_dim, letter_dim.id_letter_dim, source_dim.id_source_dim FROM person_dim, location_dim, letter_dim, source_dim WHERE person_dim.surname = 'Weiss' AND person_dim.forename = 'Alan' AND location_dim.street = 'Pardee Place' AND letter_dim.salutation = 'Dear Editor' AND source_dim.pub_date = 'March 1962';


INSERT INTO person_dim (surname, forename, gender) VALUES ('Wood', 'Rick', 'male');
INSERT INTO activity_fact (fact_person, fact_location, fact_letter, fact_source) SELECT person_dim.id_person_dim, location_dim.id_location_dim, letter_dim.id_letter_dim, source_dim.id_source_dim FROM person_dim, location_dim, letter_dim, source_dim WHERE person_dim.surname = 'Wood' AND person_dim.forename = 'Rick' AND location_dim.street = 'Pardee Place' AND letter_dim.salutation = 'Dear Editor' AND source_dim.pub_date = 'March 1962';

-- unsigned
INSERT INTO person_dim (surname, forename, gender) VALUES ('Paul', 'George', 'male');
INSERT INTO person_dim (surname, forename, gender) VALUES ('Sarill', 'Bill', 'male');
INSERT INTO person_dim (surname, forename, gender) VALUES ('Brodsky', 'S', 'male');
INSERT INTO person_dim (surname, forename, gender) VALUES ('Blake', 'Len', 'male');
INSERT INTO person_dim (surname, forename, gender) VALUES ('Gonzales', 'Anthony', 'male');
INSERT INTO person_dim (surname, forename, gender) VALUES ('Goldberg', 'S', 'male');
INSERT INTO person_dim (surname, forename, gender) VALUES ('Howard', 'Shirley', 'female');
INSERT INTO person_dim (surname, forename, gender) VALUES ('Fogel', 'Bruce', 'male');
INSERT INTO person_dim (surname, forename, gender) VALUES ('Moony', 'Jim', 'male');

-- unsigned
INSERT INTO person_dim (surname, forename, gender) VALUES ('Thomas', 'Roy', 'male');
INSERT INTO person_dim (surname, forename, gender) VALUES ('Randall', 'Mike', 'male');
INSERT INTO person_dim (surname, forename, gender) VALUES ('McGuire', 'Rick', 'male');
INSERT INTO person_dim (surname, forename, gender) VALUES ('Smith', 'Scotty', 'male');
INSERT INTO person_dim (surname, forename, gender) VALUES ('Marcolongo', 'William J', 'male');
INSERT INTO person_dim (surname, forename, gender) VALUES ('Mann', 'Roger', 'male');
INSERT INTO person_dim (surname, forename, gender) VALUES ('McIntosh', 'Harold', 'male');
INSERT INTO person_dim (surname, forename, gender) VALUES ('Jiminez', 'Cruz', 'male');
INSERT INTO person_dim (surname, forename, gender) VALUES ('Frazier', 'William', 'male');



INSERT INTO location_dim (street, city, state, country) VALUES ('Ames St.', 'Cambridge', 'Massachusetts', 'United States of America');
INSERT INTO location_dim (city, state, country) VALUES ('Dallas', 'Texas', 'United States of America');
INSERT INTO location_dim (street, city, state, country) VALUES ('Park Ave', 'Hoboken', 'New Jersey', 'United States of America');
INSERT INTO location_dim (street, city, state, country) VALUES ('Colorado Street', 'Boston', 'Massachusetts', 'United States of America');
INSERT INTO location_dim (city, state, country) VALUES ('Brooklyn', 'New York', 'United States of America');
INSERT INTO location_dim (city, state, country) VALUES ('Los Angeles', 'California', 'United States of America');
INSERT INTO location_dim (city, country) VALUES ('Mexico City', 'Mexico');
INSERT INTO location_dim (city, state, country) VALUES ('Forest Hills', 'New York', 'United States of America');
INSERT INTO location_dim (city, state, country) VALUES ('Chicago', 'Illinois', 'United States of America');
INSERT INTO location_dim (city, state, country) VALUES ('Oak Park', 'Michigan', 'United States of America');
INSERT INTO location_dim (city, state, country) VALUES ('Hollywood', 'California', 'United States of America');
INSERT INTO location_dim (city, state, country) VALUES ('Fall River', 'Massachusetts', 'United States of America');
INSERT INTO location_dim (city, state, country) VALUES ('Sullivan', 'Missouri', 'United States of America');
INSERT INTO location_dim (city, state, country) VALUES ('Atchison', 'Kansas', 'United States of America');
INSERT INTO location_dim (city, state, country) VALUES ('Parsons', 'Kansas', 'United States of America');
INSERT INTO location_dim (city, state, country) VALUES ('Anchorage', 'Alaska', 'United States of America');
INSERT INTO location_dim (city, state, country) VALUES ('Philadelphia', 'Pennsylvania', 'United States of America');
INSERT INTO location_dim (city, state, country) VALUES ('Minneapolis', 'Minnesota', 'United States of America');
INSERT INTO location_dim (city, state, country) VALUES ('Marblehead', 'Massachusetts', 'United States of America');
INSERT INTO location_dim (city, state, country) VALUES ('Ft. Riley', 'Kansas', 'United States of America');
INSERT INTO location_dim (city, state, country) VALUES ('Mt. Sterling', 'Kentucky', 'United States of America');



INSERT INTO activity_fact (fact_person, fact_location, fact_letter, fact_source) SELECT person_dim.id_person_dim, location_dim.id_location_dim, letter_dim.id_letter_dim, source_dim.id_source_dim FROM person_dim, location_dim, letter_dim, source_dim WHERE person_dim.surname = 'Paul' AND person_dim.forename = 'George' AND location_dim.street = 'Park Ave.' AND letter_dim.salutation = 'Dear Editor' AND source_dim.pub_date = 'March 1962';










INSERT INTO activity_fact (fact_person, fact_location, fact_letter, fact_source) SELECT person_dim.id_person_dim, location_dim.id_location_dim, letter_dim.id_letter_dim, source_dim.id_source_dim FROM person_dim, location_dim, letter_dim, source_dim WHERE person_dim.surname = 'Sarill' AND person_dim.forename = 'Bill' AND location_dim.street = 'Colorado Street' AND letter_dim.salutation = 'Dear Editor' AND source_dim.pub_date = 'March 1962';
INSERT INTO activity_fact (fact_person, fact_location, fact_letter, fact_source) SELECT person_dim.id_person_dim, location_dim.id_location_dim, letter_dim.id_letter_dim, source_dim.id_source_dim FROM person_dim, location_dim, letter_dim, source_dim WHERE person_dim.surname = 'Brodsky' AND person_dim.forename = 'S' AND location_dim.city = 'Brooklyn' AND letter_dim.salutation = 'Dear Editor' AND source_dim.pub_date = 'March 1962';
INSERT INTO activity_fact (fact_person, fact_location, fact_letter, fact_source) SELECT person_dim.id_person_dim, location_dim.id_location_dim, letter_dim.id_letter_dim, source_dim.id_source_dim FROM person_dim, location_dim, letter_dim, source_dim WHERE person_dim.surname = 'Blake' AND person_dim.forename = 'Len' AND location_dim.city = 'Los Angeles' AND letter_dim.salutation = 'Dear Editor' AND source_dim.pub_date = 'March 1962';
INSERT INTO activity_fact (fact_person, fact_location, fact_letter, fact_source) SELECT person_dim.id_person_dim, location_dim.id_location_dim, letter_dim.id_letter_dim, source_dim.id_source_dim FROM person_dim, location_dim, letter_dim, source_dim WHERE person_dim.surname = 'Gonzales' AND person_dim.forename = 'Anthony' AND location_dim.city = 'Mexico City' AND letter_dim.salutation = 'Dear Editor' AND source_dim.pub_date = 'March 1962';
INSERT INTO activity_fact (fact_person, fact_location, fact_letter, fact_source) SELECT person_dim.id_person_dim, location_dim.id_location_dim, letter_dim.id_letter_dim, source_dim.id_source_dim FROM person_dim, location_dim, letter_dim, source_dim WHERE person_dim.surname = 'Goldberg' AND person_dim.forename = 'S' AND location_dim.city = 'Forest Hills' AND letter_dim.salutation = 'Dear Editor' AND source_dim.pub_date = 'March 1962';
INSERT INTO activity_fact (fact_person, fact_location, fact_letter, fact_source) SELECT person_dim.id_person_dim, location_dim.id_location_dim, letter_dim.id_letter_dim, source_dim.id_source_dim FROM person_dim, location_dim, letter_dim, source_dim WHERE person_dim.surname = 'Howard' AND person_dim.forename = 'Shirley' AND location_dim.city = 'Chicago' AND letter_dim.salutation = 'Dear Editor' AND source_dim.pub_date = 'March 1962';
INSERT INTO activity_fact (fact_person, fact_location, fact_letter, fact_source) SELECT person_dim.id_person_dim, location_dim.id_location_dim, letter_dim.id_letter_dim, source_dim.id_source_dim FROM person_dim, location_dim, letter_dim, source_dim WHERE person_dim.surname = 'Fogel' AND person_dim.forename = 'Bruce' AND location_dim.city = 'Oak Park' AND letter_dim.salutation = 'Dear Editor' AND source_dim.pub_date = 'March 1962';
INSERT INTO activity_fact (fact_person, fact_location, fact_letter, fact_source) SELECT person_dim.id_person_dim, location_dim.id_location_dim, letter_dim.id_letter_dim, source_dim.id_source_dim FROM person_dim, location_dim, letter_dim, source_dim WHERE person_dim.surname = 'Moony' AND person_dim.forename = 'Jim' AND location_dim.city = 'Hollywood' AND letter_dim.salutation = 'Dear Editor' AND source_dim.pub_date = 'March 1962';
INSERT INTO activity_fact (fact_person, fact_location, fact_letter, fact_source) SELECT person_dim.id_person_dim, location_dim.id_location_dim, letter_dim.id_letter_dim, source_dim.id_source_dim FROM person_dim, location_dim, letter_dim, source_dim WHERE person_dim.surname = 'Thomas' AND person_dim.forename = 'Roy' AND location_dim.city = 'Sullivan' AND letter_dim.salutation = 'Dear Editor' AND source_dim.pub_date = 'March 1962';
INSERT INTO activity_fact (fact_person, fact_location, fact_letter, fact_source) SELECT person_dim.id_person_dim, location_dim.id_location_dim, letter_dim.id_letter_dim, source_dim.id_source_dim FROM person_dim, location_dim, letter_dim, source_dim WHERE person_dim.surname = 'Randall' AND person_dim.forename = 'Mike' AND location_dim.city = 'Atchison' AND letter_dim.salutation = 'Dear Editor' AND source_dim.pub_date = 'March 1962';
INSERT INTO activity_fact (fact_person, fact_location, fact_letter, fact_source) SELECT person_dim.id_person_dim, location_dim.id_location_dim, letter_dim.id_letter_dim, source_dim.id_source_dim FROM person_dim, location_dim, letter_dim, source_dim WHERE person_dim.surname = 'McGuire' AND person_dim.forename = 'Rick' AND location_dim.city = 'Parsons' AND letter_dim.salutation = 'Dear Editor' AND source_dim.pub_date = 'March 1962';
INSERT INTO activity_fact (fact_person, fact_location, fact_letter, fact_source) SELECT person_dim.id_person_dim, location_dim.id_location_dim, letter_dim.id_letter_dim, source_dim.id_source_dim FROM person_dim, location_dim, letter_dim, source_dim WHERE person_dim.surname = 'Smith' AND person_dim.forename = 'Scotty' AND location_dim.city = 'Anchorage' AND letter_dim.salutation = 'Dear Editor' AND source_dim.pub_date = 'March 1962';
INSERT INTO activity_fact (fact_person, fact_location, fact_letter, fact_source) SELECT person_dim.id_person_dim, location_dim.id_location_dim, letter_dim.id_letter_dim, source_dim.id_source_dim FROM person_dim, location_dim, letter_dim, source_dim WHERE person_dim.surname = 'Marcolongo' AND person_dim.forename = 'William' AND location_dim.city = 'Philadelphia' AND letter_dim.salutation = 'Dear Editor' AND source_dim.pub_date = 'March 1962';
INSERT INTO activity_fact (fact_person, fact_location, fact_letter, fact_source) SELECT person_dim.id_person_dim, location_dim.id_location_dim, letter_dim.id_letter_dim, source_dim.id_source_dim FROM person_dim, location_dim, letter_dim, source_dim WHERE person_dim.surname = 'Mann' AND person_dim.forename = 'Roger' AND location_dim.city = 'Minneapolis' AND letter_dim.salutation = 'Dear Editor' AND source_dim.pub_date = 'March 1962';
INSERT INTO activity_fact (fact_person, fact_location, fact_letter, fact_source) SELECT person_dim.id_person_dim, location_dim.id_location_dim, letter_dim.id_letter_dim, source_dim.id_source_dim FROM person_dim, location_dim, letter_dim, source_dim WHERE person_dim.surname = 'McIntosh' AND person_dim.forename = 'Harold' AND location_dim.city = 'Marblehead' AND letter_dim.salutation = 'Dear Editor' AND source_dim.pub_date = 'March 1962';
INSERT INTO activity_fact (fact_person, fact_location, fact_letter, fact_source) SELECT person_dim.id_person_dim, location_dim.id_location_dim, letter_dim.id_letter_dim, source_dim.id_source_dim FROM person_dim, location_dim, letter_dim, source_dim WHERE person_dim.surname = 'Jiminez' AND person_dim.forename = 'Cruz' AND location_dim.city = 'Ft. Riley' AND letter_dim.salutation = 'Dear Editor' AND source_dim.pub_date = 'March 1962';
INSERT INTO activity_fact (fact_person, fact_location, fact_letter, fact_source) SELECT person_dim.id_person_dim, location_dim.id_location_dim, letter_dim.id_letter_dim, source_dim.id_source_dim FROM person_dim, location_dim, letter_dim, source_dim WHERE person_dim.surname = 'Frazier' AND person_dim.forename = 'William' AND location_dim.city = 'Mt. Sterling' AND letter_dim.salutation = 'Dear Editor' AND source_dim.pub_date = 'March 1962';






















