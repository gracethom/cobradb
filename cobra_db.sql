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
  `person_auth` VARCHAR(45) NULL,
  `surname` VARCHAR(45) NULL,
  `forename` VARCHAR(45) NULL,
  `person_title` VARCHAR(45) NULL,
  `person_role` VARCHAR(45) NULL,
  `alt_name` VARCHAR(45) NULL, -- if signed with a false name
  `birth_year` VARCHAR(45) NULL,
  `byear_source` VARCHAR(45) NULL,
  `m_f` VARCHAR(45) NULL,
  `gender_note` VARCHAR(255) NULL,
  `race` VARCHAR(45) NULL,
  `race_note` VARCHAR(255) NULL,
  `ethnicity` VARCHAR(45) NULL,
  `ethnicity_note` VARCHAR(255) NULL,
  PRIMARY KEY (`id_person_dim`))
ENGINE = InnoDB;

SHOW WARNINGS;


-- -----------------------------------------------------
-- MUTABLE ATTRIBUTES IN SEPARATE TABLES RELATING TO PERSON
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Table `cobra`.`occu_dim`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cobra`.`occu_dim` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `cobra`.`occu_dim` (
  `id_occu_dim` INT NOT NULL AUTO_INCREMENT,
  `occupation` VARCHAR(45) NULL,
  PRIMARY KEY (`id_occu_dim`))
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `cobra`.`person_occu`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cobra`.`person_occu` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `cobra`.`person_occu` (
  `id_person_occu` INT NOT NULL AUTO_INCREMENT,
  `id_person_dim` INT NOT NULL,
  `id_occu_dim` INT NOT NULL,
  `occu_note` VARCHAR(255) NULL,
  PRIMARY KEY (`id_person_occu`),
  CONSTRAINT `fk_occu_dim`
    FOREIGN KEY (`id_occu_dim`)
    REFERENCES `cobra`.`occu_dim` (`id_occu_dim`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_person_occu_dim`
    FOREIGN KEY (`id_person_dim`)
    REFERENCES `cobra`.`person_dim` (`id_person_dim`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

SHOW WARNINGS;



-- -----------------------------------------------------
-- Table `cobra`.`grade_dim`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cobra`.`grade_dim` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `cobra`.`grade_dim` (
  `id_grade_dim` INT NOT NULL AUTO_INCREMENT,
  `grade` VARCHAR(45) NULL,
  PRIMARY KEY (`id_grade_dim`))
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `cobra`.`person_grade`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cobra`.`person_grade` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `cobra`.`person_grade` (
  `id_person_grade` INT NOT NULL AUTO_INCREMENT,
  `id_person_dim` INT NOT NULL,
  `id_grade_dim` INT NOT NULL,
  `grade_note` VARCHAR(255) NULL,
  PRIMARY KEY (`id_person_grade`),
  CONSTRAINT `fk_grade_dim`
    FOREIGN KEY (`id_grade_dim`)
    REFERENCES `cobra`.`grade_dim` (`id_grade_dim`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_person_grade_dim`
    FOREIGN KEY (`id_person_dim`)
    REFERENCES `cobra`.`person_dim` (`id_person_dim`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- END OF MUTABLE ATTRIBUTES
-- -----------------------------------------------------




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
  `postal_code` VARCHAR(45) NULL,
  PRIMARY KEY (`id_location_dim`))
ENGINE = InnoDB;

SHOW WARNINGS;


-- -----------------------------------------------------
-- Table `cobra`.`phys_loc_dim`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cobra`.`phys_loc_dim` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `cobra`.`phys_loc_dim` (
  `id_phys_loc_dim` INT NOT NULL AUTO_INCREMENT,
  `phys_loc_name` VARCHAR(45) NULL,
  `phone` VARCHAR(45) NULL,
  `repository` VARCHAR(45) NULL,
  `coll_name` VARCHAR(45) NULL,
  `coll_num` VARCHAR(45) NULL,
  `id_location_dim`INT NOT NULL,
  PRIMARY KEY (`id_phys_loc_dim`),
  CONSTRAINT `fk_phys_loc_dim`
    FOREIGN KEY (`id_location_dim`)
    REFERENCES `cobra`.`location_dim` (`id_location_dim`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

SHOW WARNINGS;





-- -----------------------------------------------------
-- Table `cobra`.`source_dim`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cobra`.`source_dim` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `cobra`.`source_dim` (
  `id_source_dim` INT NOT NULL AUTO_INCREMENT,
  `source_type` VARCHAR(45) NULL,
  `gcd_link` VARCHAR(45) NULL,
  `series_title` VARCHAR(45) NULL,
  `issue_number` VARCHAR(45) NULL,
  `pub_date` VARCHAR(45) NULL,
  `page_num` VARCHAR(45) NULL,
  PRIMARY KEY (`id_source_dim`))
ENGINE = InnoDB;

SHOW WARNINGS;






-- -----------------------------------------------------
-- Table `cobra`.`letter_dim`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cobra`.`letter_dim` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `cobra`.`letter_dim` (
  `id_letter_dim` INT NOT NULL AUTO_INCREMENT,
  `letter_pg_title` VARCHAR(45) NULL,
  `letter_text` VARCHAR(255) NULL,
  `letter_note` VARCHAR(255) NULL,
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
  `review_note` VARCHAR(255) NULL,
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
  `contest_assoc` VARCHAR(45) NULL,
  `contest_notes` VARCHAR(45) NULL,
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
  `fan_club_assoc` VARCHAR(45) NULL,
  `fan_club_notes` VARCHAR(255) NULL,
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
  `mtg_start` VARCHAR(45) NULL,
  `mtg_end` VARCHAR(45) NULL,
  `mtg_notes` VARCHAR(255) NULL,
  PRIMARY KEY (`id_meeting_dim`))
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `cobra`.`mention_dim`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cobra`.`mention_dim` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `cobra`.`mention_dim` (
  `id_mention_dim` INT NOT NULL AUTO_INCREMENT,
  `mention_col_title` VARCHAR(45) NULL,
  `mention_desc` VARCHAR(255) NULL,
  `mention_notes` VARCHAR(255) NULL,
  PRIMARY KEY (`id_mention_dim`))
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
  `classified_notes` VARCHAR(255) NULL,
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
  `penpals_title` VARCHAR(45) NULL,
  `penpals_notes` VARCHAR(255) NULL,
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
  `traces_notes` VARCHAR(255) NULL, 
  PRIMARY KEY (`id_traces_dim`))
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
  `fact_occu` INT,
  `fact_person_occu` INT,
  `fact_grade` INT,
  `fact_person_grade` INT,
  `fact_gender` INT,
  `fact_person_gender` INT,
  `fact_location` INT,
  `fact_phys_loc` INT,
  `fact_letter` INT,
  `fact_review` INT,
  `fact_contest` INT,
  `fact_club` INT,
  `fact_meeting` INT,
  `fact_mention` INT,
  `fact_classified` INT,
  `fact_pen_pals` INT,
  `fact_traces` INT,
  `fact_source` INT,
  PRIMARY KEY (`id_activity_fact`),
  INDEX `fk_activity_fact_person_dim_idx` (`fact_person` ASC),
  INDEX `fk_activity_fact_occu_idx` (`fact_occu` ASC),
  INDEX `fk_activity_fact_person_occu_idx` (`fact_person_occu` ASC),
  INDEX `fk_activity_fact_grade_idx` (`fact_grade` ASC),
  INDEX `fk_activity_fact_person_grade_idx` (`fact_person_grade` ASC),
  INDEX `fk_activity_fact_gender_idx` (`fact_gender` ASC),
  INDEX `fk_activity_fact_person_gender_idx` (`fact_person_gender` ASC),
  INDEX `fk_activity_fact_location_dim1_idx` (`fact_location` ASC),
  INDEX `fk_activity_fact_phys_loc_dim1_idx` (`fact_phys_loc` ASC),
  INDEX `fk_activity_fact_letter_dim1_idx` (`fact_letter` ASC),
  INDEX `fk_activity_fact_review_dim1_idx` (`fact_review` ASC),
  INDEX `fk_activity_fact_contest_dim1_idx` (`fact_contest` ASC),
  INDEX `fk_activity_fact_club_dim1_idx` (`fact_club` ASC),
  INDEX `fk_activity_fact_meeting_dim1_idx` (`fact_meeting` ASC),
  INDEX `fk_activity_fact_mention_dim1_idx` (`fact_mention` ASC),
  INDEX `fk_activity_fact_classified_dim1_idx` (`fact_classified` ASC),
  INDEX `fk_activity_fact_pen_pals_dim1_idx` (`fact_pen_pals` ASC),
  INDEX `fk_activity_fact_traces_dim1_idx` (`fact_traces` ASC),
  INDEX `fk_activity_fact_source_dim1_idx` (`fact_source` ASC),
  CONSTRAINT `fk_activity_fact_person_dim`
    FOREIGN KEY (`fact_person`)
    REFERENCES `cobra`.`person_dim` (`id_person_dim`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_activity_fact_occu`
    FOREIGN KEY (`fact_occu`)
    REFERENCES `cobra`.`occu_dim` (`id_occu_dim`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_activity_fact_person_occu`
    FOREIGN KEY (`fact_person_occu`)
    REFERENCES `cobra`.`person_occu` (`id_person_occu`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_activity_fact_grade`
    FOREIGN KEY (`fact_grade`)
    REFERENCES `cobra`.`grade_dim` (`id_grade_dim`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_activity_fact_person_grade`
    FOREIGN KEY (`fact_person_grade`)
    REFERENCES `cobra`.`person_grade` (`id_person_grade`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_activity_fact_gender`
    FOREIGN KEY (`fact_gender`)
    REFERENCES `cobra`.`gender_dim` (`id_gender_dim`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_activity_fact_person_gender`
    FOREIGN KEY (`fact_person_gender`)
    REFERENCES `cobra`.`person_gender` (`id_person_gender`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_activity_fact_location_dim1`
    FOREIGN KEY (`fact_location`)
    REFERENCES `cobra`.`location_dim` (`id_location_dim`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_activity_fact_phys_loc_dim1`
    FOREIGN KEY (`fact_phys_loc`)
    REFERENCES `cobra`.`phys_loc_dim` (`id_phys_loc_dim`)
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
  CONSTRAINT `fk_activity_fact_mention_dim1`
    FOREIGN KEY (`fact_mention`)
    REFERENCES `cobra`.`mention_dim` (`id_mention_dim`)
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


INSERT INTO source_dim (source_type, pub_date, issue_number, series_title) VALUES ('issue', 'July 1962', '5', 'Fantastic Four');
INSERT INTO person_dim (surname, forename) VALUES ('Weiss', 'Alan');
INSERT INTO location_dim (street, city, state, country) VALUES ('Pardee Place', 'Las Vegas', 'Nevada', 'United States of America');
INSERT INTO letter_dim (letter_text, letter_pg_title) VALUES ('hello! this is a letter from Alan Weiss', 'Fantastic Four Fan Page');

INSERT INTO activity_fact (fact_person, fact_location, fact_letter, fact_source) SELECT person_dim.id_person_dim, location_dim.id_location_dim, letter_dim.id_letter_dim, source_dim.id_source_dim FROM person_dim, location_dim, letter_dim, source_dim WHERE person_dim.surname = 'Weiss' AND person_dim.forename = 'Alan' AND location_dim.street = 'Pardee Place' AND letter_dim.letter_text = 'hello! this is a letter from Alan Weiss' AND source_dim.pub_date = 'July 1962';


INSERT INTO person_dim (surname, forename) VALUES ('Wood', 'Rick');
INSERT INTO activity_fact (fact_person, fact_location, fact_letter, fact_source) SELECT person_dim.id_person_dim, location_dim.id_location_dim, letter_dim.id_letter_dim, source_dim.id_source_dim FROM person_dim, location_dim, letter_dim, source_dim WHERE person_dim.surname = 'Wood' AND person_dim.forename = 'Rick' AND location_dim.street = 'Pardee Place' AND letter_dim.letter_text = 'hello! this is a letter from Alan Weiss' AND source_dim.pub_date = 'July 1962';

-- unsigned
INSERT INTO person_dim (surname, forename) VALUES ('Paul', 'George');
INSERT INTO person_dim (surname, forename) VALUES ('Sarill', 'Bill');
INSERT INTO person_dim (surname, forename) VALUES ('Brodsky', 'S');
INSERT INTO person_dim (surname, forename) VALUES ('Blake', 'Len');
INSERT INTO person_dim (surname, forename) VALUES ('Gonzales', 'Anthony');
INSERT INTO person_dim (surname, forename) VALUES ('Goldberg', 'S');
INSERT INTO person_dim (surname, forename) VALUES ('Howard', 'Shirley');
INSERT INTO person_dim (surname, forename) VALUES ('Fogel', 'Bruce');
INSERT INTO person_dim (surname, forename) VALUES ('Moony', 'Jim');

-- unsigned
INSERT INTO person_dim (surname, forename) VALUES ('Thomas', 'Roy');
INSERT INTO person_dim (surname, forename) VALUES ('Randall', 'Mike');
INSERT INTO person_dim (surname, forename) VALUES ('McGuire', 'Rick');
INSERT INTO person_dim (surname, forename) VALUES ('Smith', 'Scotty');
INSERT INTO person_dim (surname, forename) VALUES ('Marcolongo', 'William J');
INSERT INTO person_dim (surname, forename) VALUES ('Mann', 'Roger');
INSERT INTO person_dim (surname, forename) VALUES ('McIntosh', 'Harold');
INSERT INTO person_dim (surname, forename) VALUES ('Jiminez', 'Cruz');
INSERT INTO person_dim (surname, forename) VALUES ('Frazier', 'William');
INSERT INTO person_dim (surname, forename) VALUES ('Test', 'Testy');



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

INSERT INTO location_dim (city, state, country) VALUES ('East Lansing', 'Michigan', 'United States of America');
INSERT INTO phys_loc_dim (phys_loc_name, repository, coll_name, id_location_dim) VALUES ('Michigan State University', 'Michigan State University Libraries', 'Comics Collection', (SELECT id_location_dim FROM location_dim WHERE city = 'East Lansing'));



INSERT INTO activity_fact (fact_person, fact_location, fact_letter, fact_source) SELECT person_dim.id_person_dim, location_dim.id_location_dim, letter_dim.id_letter_dim, source_dim.id_source_dim FROM person_dim, location_dim, letter_dim, source_dim WHERE person_dim.surname = 'Paul' AND person_dim.forename = 'George' AND location_dim.street = 'Park Ave.' AND letter_dim.letter_text = 'hello! this is a letter from Alan Weiss' AND source_dim.pub_date = 'July 1962';










INSERT INTO activity_fact (fact_person, fact_location, fact_letter, fact_source) SELECT person_dim.id_person_dim, location_dim.id_location_dim, letter_dim.id_letter_dim, source_dim.id_source_dim FROM person_dim, location_dim, letter_dim, source_dim WHERE person_dim.surname = 'Sarill' AND person_dim.forename = 'Bill' AND location_dim.street = 'Colorado Street' AND letter_dim.letter_text = 'hello! this is a letter from Alan Weiss' AND source_dim.pub_date = 'July 1962';
INSERT INTO activity_fact (fact_person, fact_location, fact_letter, fact_source) SELECT person_dim.id_person_dim, location_dim.id_location_dim, letter_dim.id_letter_dim, source_dim.id_source_dim FROM person_dim, location_dim, letter_dim, source_dim WHERE person_dim.surname = 'Brodsky' AND person_dim.forename = 'S' AND location_dim.city = 'Brooklyn' AND letter_dim.letter_text = 'hello! this is a letter from Alan Weiss' AND source_dim.pub_date = 'July 1962';
INSERT INTO activity_fact (fact_person, fact_location, fact_letter, fact_source) SELECT person_dim.id_person_dim, location_dim.id_location_dim, letter_dim.id_letter_dim, source_dim.id_source_dim FROM person_dim, location_dim, letter_dim, source_dim WHERE person_dim.surname = 'Blake' AND person_dim.forename = 'Len' AND location_dim.city = 'Los Angeles' AND letter_dim.letter_text = 'hello! this is a letter from Alan Weiss' AND source_dim.pub_date = 'July 1962';
INSERT INTO activity_fact (fact_person, fact_location, fact_letter, fact_source) SELECT person_dim.id_person_dim, location_dim.id_location_dim, letter_dim.id_letter_dim, source_dim.id_source_dim FROM person_dim, location_dim, letter_dim, source_dim WHERE person_dim.surname = 'Gonzales' AND person_dim.forename = 'Anthony' AND location_dim.city = 'Mexico City' AND letter_dim.letter_text = 'hello! this is a letter from Alan Weiss' AND source_dim.pub_date = 'July 1962';
INSERT INTO activity_fact (fact_person, fact_location, fact_letter, fact_source) SELECT person_dim.id_person_dim, location_dim.id_location_dim, letter_dim.id_letter_dim, source_dim.id_source_dim FROM person_dim, location_dim, letter_dim, source_dim WHERE person_dim.surname = 'Goldberg' AND person_dim.forename = 'S' AND location_dim.city = 'Forest Hills' AND letter_dim.letter_text = 'hello! this is a letter from Alan Weiss' AND source_dim.pub_date = 'July 1962';
INSERT INTO activity_fact (fact_person, fact_location, fact_letter, fact_source) SELECT person_dim.id_person_dim, location_dim.id_location_dim, letter_dim.id_letter_dim, source_dim.id_source_dim FROM person_dim, location_dim, letter_dim, source_dim WHERE person_dim.surname = 'Howard' AND person_dim.forename = 'Shirley' AND location_dim.city = 'Chicago' AND letter_dim.letter_text = 'hello! this is a letter from Alan Weiss' AND source_dim.pub_date = 'July 1962';
INSERT INTO activity_fact (fact_person, fact_location, fact_letter, fact_source) SELECT person_dim.id_person_dim, location_dim.id_location_dim, letter_dim.id_letter_dim, source_dim.id_source_dim FROM person_dim, location_dim, letter_dim, source_dim WHERE person_dim.surname = 'Fogel' AND person_dim.forename = 'Bruce' AND location_dim.city = 'Oak Park' AND letter_dim.letter_text = 'hello! this is a letter from Alan Weiss' AND source_dim.pub_date = 'July 1962';
INSERT INTO activity_fact (fact_person, fact_location, fact_letter, fact_source) SELECT person_dim.id_person_dim, location_dim.id_location_dim, letter_dim.id_letter_dim, source_dim.id_source_dim FROM person_dim, location_dim, letter_dim, source_dim WHERE person_dim.surname = 'Moony' AND person_dim.forename = 'Jim' AND location_dim.city = 'Hollywood' AND letter_dim.letter_text = 'hello! this is a letter from Alan Weiss' AND source_dim.pub_date = 'July 1962';
INSERT INTO activity_fact (fact_person, fact_location, fact_letter, fact_source) SELECT person_dim.id_person_dim, location_dim.id_location_dim, letter_dim.id_letter_dim, source_dim.id_source_dim FROM person_dim, location_dim, letter_dim, source_dim WHERE person_dim.surname = 'Thomas' AND person_dim.forename = 'Roy' AND location_dim.city = 'Sullivan' AND letter_dim.letter_text = 'hello! this is a letter from Alan Weiss' AND source_dim.pub_date = 'July 1962';
INSERT INTO activity_fact (fact_person, fact_location, fact_letter, fact_source) SELECT person_dim.id_person_dim, location_dim.id_location_dim, letter_dim.id_letter_dim, source_dim.id_source_dim FROM person_dim, location_dim, letter_dim, source_dim WHERE person_dim.surname = 'Randall' AND person_dim.forename = 'Mike' AND location_dim.city = 'Atchison' AND letter_dim.letter_text = 'hello! this is a letter from Alan Weiss' AND source_dim.pub_date = 'July 1962';
INSERT INTO activity_fact (fact_person, fact_location, fact_letter, fact_source) SELECT person_dim.id_person_dim, location_dim.id_location_dim, letter_dim.id_letter_dim, source_dim.id_source_dim FROM person_dim, location_dim, letter_dim, source_dim WHERE person_dim.surname = 'McGuire' AND person_dim.forename = 'Rick' AND location_dim.city = 'Parsons' AND letter_dim.letter_text = 'hello! this is a letter from Alan Weiss' AND source_dim.pub_date = 'July 1962';
INSERT INTO activity_fact (fact_person, fact_location, fact_letter, fact_source) SELECT person_dim.id_person_dim, location_dim.id_location_dim, letter_dim.id_letter_dim, source_dim.id_source_dim FROM person_dim, location_dim, letter_dim, source_dim WHERE person_dim.surname = 'Smith' AND person_dim.forename = 'Scotty' AND location_dim.city = 'Anchorage' AND letter_dim.letter_text = 'hello! this is a letter from Alan Weiss' AND source_dim.pub_date = 'July 1962';
INSERT INTO activity_fact (fact_person, fact_location, fact_letter, fact_source) SELECT person_dim.id_person_dim, location_dim.id_location_dim, letter_dim.id_letter_dim, source_dim.id_source_dim FROM person_dim, location_dim, letter_dim, source_dim WHERE person_dim.surname = 'Marcolongo' AND person_dim.forename = 'William' AND location_dim.city = 'Philadelphia' AND letter_dim.letter_text = 'hello! this is a letter from Alan Weiss' AND source_dim.pub_date = 'July 1962';
INSERT INTO activity_fact (fact_person, fact_location, fact_letter, fact_source) SELECT person_dim.id_person_dim, location_dim.id_location_dim, letter_dim.id_letter_dim, source_dim.id_source_dim FROM person_dim, location_dim, letter_dim, source_dim WHERE person_dim.surname = 'Mann' AND person_dim.forename = 'Roger' AND location_dim.city = 'Minneapolis' AND letter_dim.letter_text = 'hello! this is a letter from Alan Weiss' AND source_dim.pub_date = 'July 1962';
INSERT INTO activity_fact (fact_person, fact_location, fact_letter, fact_source) SELECT person_dim.id_person_dim, location_dim.id_location_dim, letter_dim.id_letter_dim, source_dim.id_source_dim FROM person_dim, location_dim, letter_dim, source_dim WHERE person_dim.surname = 'McIntosh' AND person_dim.forename = 'Harold' AND location_dim.city = 'Marblehead' AND letter_dim.letter_text = 'hello! this is a letter from Alan Weiss' AND source_dim.pub_date = 'July 1962';
INSERT INTO activity_fact (fact_person, fact_location, fact_letter, fact_source) SELECT person_dim.id_person_dim, location_dim.id_location_dim, letter_dim.id_letter_dim, source_dim.id_source_dim FROM person_dim, location_dim, letter_dim, source_dim WHERE person_dim.surname = 'Jiminez' AND person_dim.forename = 'Cruz' AND location_dim.city = 'Ft. Riley' AND letter_dim.letter_text = 'hello! this is a letter from Alan Weiss' AND source_dim.pub_date = 'July 1962';
INSERT INTO activity_fact (fact_person, fact_location, fact_letter, fact_source) SELECT person_dim.id_person_dim, location_dim.id_location_dim, letter_dim.id_letter_dim, source_dim.id_source_dim FROM person_dim, location_dim, letter_dim, source_dim WHERE person_dim.surname = 'Frazier' AND person_dim.forename = 'William' AND location_dim.city = 'Mt. Sterling' AND letter_dim.letter_text = 'hello! this is a letter from Alan Weiss' AND source_dim.pub_date = 'July 1962';






















