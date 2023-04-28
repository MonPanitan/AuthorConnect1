-- -----------------------------------------------------
-- Schema authorconnect_test1
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `authorconnect_test1`;
USE `authorconnect_test1` ;

-- -----------------------------------------------------
-- Table `authorconnect_test1`.`Role`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS role (
    `roleID` INT NOT NULL,
    `roleName` VARCHAR(50) NULL,
    PRIMARY KEY (`roleID`)
    );


-- -----------------------------------------------------
-- Table `authorconnect_test1`.`User`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS User (
    `UserID` INT NOT NULL auto_increment,
    `roleID` INT NOT NULL,
    `EmpID` INT NULL,
    `Username` VARCHAR(50) NULL,
    `Password` VARCHAR(50) NULL,
    `image` VARCHAR(255) NULL,
    `firstname` VARCHAR(50) NULL,
    `lastname` VARCHAR(50) NULL,
    `Email` VARCHAR(50) NULL,
    `Phone_num` VARCHAR(50) NULL,
    `DOB` VARCHAR(50) NULL,
    `Verify_Status` bool,
    `Link` VARCHAR(255) NULL,
    PRIMARY KEY (`UserID`, `roleID`),
    CONSTRAINT `fk_User_role`
    FOREIGN KEY (`roleID`)
    REFERENCES role (`roleID`)
    );


-- -----------------------------------------------------
-- Table `authorconnect_test1`.`PostType`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS PostType (
    `postTypeID` INT NOT NULL,
    `postTypeName` VARCHAR(50) NULL,
    PRIMARY KEY (`postTypeID`)
    );


-- -----------------------------------------------------
-- Table `authorconnect_test1`.`Author_Action`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS Author_Action (
    `PostID` INT NOT NULL auto_increment,
    `UserID` INT NOT NULL,
    `roleID` INT NOT NULL,
    `postTypeID` INT NOT NULL,
    `Heading` VARCHAR(50) NULL,
    `description` VARCHAR(1000) NULL,
    `Date` VARCHAR(50) NULL,
    `Time` VARCHAR(50) NULL,
    `Place` VARCHAR(50) NULL,
    `Answer1` VARCHAR(50) NULL,
    `Answer2` VARCHAR(50) NULL,
    `Answer3` VARCHAR(50) NULL,

    PRIMARY KEY (`PostID`, `UserID`, `roleID`, `postTypeID`),
    CONSTRAINT `fk_Author_Action_User1`
    FOREIGN KEY (`UserID` , `roleID`)
    REFERENCES User (`UserID` , `roleID`),
    CONSTRAINT `fk_Author_Action_PostType1`
    FOREIGN KEY (`postTypeID`)
    REFERENCES PostType (`postTypeID`)
    );


-- -----------------------------------------------------
-- Table `authorconnect_test1`.`Genre`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `authorconnect_test1`.`Genre` (
    `genreID` INT NOT NULL,
    `genreName` VARCHAR(50) NULL,

    PRIMARY KEY (`genreID`)
    );


-- -----------------------------------------------------
-- Table `authorconnect_test1`.`Publish`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS Publish (
    `publishID` INT NOT NULL auto_increment,
    `UserID` INT NOT NULL,
    `roleID` INT NOT NULL,

    PRIMARY KEY (`publishID`, `UserID`, `roleID`),
    CONSTRAINT `fk_Publish_User1`
    FOREIGN KEY (`UserID` , `roleID`)
    REFERENCES User ( `UserID` , `roleID`)
    );

-- -----------------------------------------------------
-- Table `authorconnect_test1`.`Book`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS Book (
    `ISBN` VARCHAR(20) NOT NULL,
    `genreID` INT NOT NULL,
    `publishID` INT NOT NULL,
    `bookName` VARCHAR(50) NULL,
    `description` VARCHAR(1000) NULL,
    `image` VARCHAR(255) NULL,
    `rating` INT NULL,
    PRIMARY KEY (`ISBN`, `genreID`, `publishID`),
    CONSTRAINT `fk_Book_Genre1`
    FOREIGN KEY (`genreID`)
    REFERENCES Genre (`genreID`),

    CONSTRAINT `fk_Book_Publish1`
    FOREIGN KEY (`publishID`)
    REFERENCES Publish (`publishID`)
    );


-- -----------------------------------------------------
-- Table `authorconnect_test1`.`Review`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS Review (
    `ReviewID` INT NOT NULL auto_increment,
    `Book_ISBN` VARCHAR(20) NOT NULL,
    `Book_genreID` INT NOT NULL,
    `UserID` INT NOT NULL,
    `roleID` INT NOT NULL,
    `Date` VARCHAR(50) NULL,
    `Comment` VARCHAR(500) NULL,
    PRIMARY KEY (`ReviewID`, `Book_ISBN`, `Book_genreID`, `UserID`, `roleID`),
    CONSTRAINT `fk_Review_Book1`
    FOREIGN KEY (`Book_ISBN` , `Book_genreID`)
    REFERENCES Book (`ISBN` , `genreID`),

    CONSTRAINT `fk_Review_User1`
    FOREIGN KEY (`UserID` , `roleID`)
    REFERENCES User (`UserID` , `roleID`)
    );


-- -----------------------------------------------------
-- Table `authorconnect_test1`.`FavBook`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS FavBook (
    `favBookID` INT NOT NULL,
    `Book_ISBN` VARCHAR(20) NOT NULL,
    `UserID` INT NOT NULL,
    `roleID` INT NOT NULL,
    PRIMARY KEY (`favBookID`, `Book_ISBN`, `UserID`, `roleID`),
    CONSTRAINT `fk_FavBook_User1`
    FOREIGN KEY (`UserID` , `roleID`)
    REFERENCES User (`UserID` , `roleID`),

    CONSTRAINT `fk_FavBook_Book1`
    FOREIGN KEY (`Book_ISBN`)
    REFERENCES Book (`ISBN`)
    );

INSERT INTO `role` (`roleID`, `roleName`) VALUES ('1', 'Author'), ('2', 'Reader');

INSERT INTO `genre` (`genreID`, `genreName`) VALUES ('1', 'Horror'), ('2', 'Comedy'), ('3', 'Action');

INSERT INTO `posttype` (`postTypeID`, `postTypeName`) VALUES ('1', 'Announcement'), ('2', 'Event'), ('3', 'Survey');

ALTER TABLE `author_action` ADD `price` INT NULL AFTER `Answer3`;

ALTER TABLE `user` ADD `description` VARCHAR(1000) NULL AFTER `Link`;



