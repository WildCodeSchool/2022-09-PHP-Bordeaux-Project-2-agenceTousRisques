DROP DATABASE nounouEntreNous;

CREATE DATABASE nounouEntreNous;

USE nounouEntreNous;

CREATE TABLE `User` (
                        `userID` INT  NOT NULL AUTO_INCREMENT,
                        `firstname` VARCHAR(255)  ,
                        `lastname` VARCHAR(255)  ,
                        `telephone` VARCHAR(10)  ,
                        `address` VARCHAR(255)  ,
                        `email` VARCHAR(150)  UNIQUE NOT NULL ,
                        `password` VARCHAR(255),
                        `avatar` INT ,
                        `activationcode` VARCHAR(10)  NOT NULL ,
                        `isAdmin` BOOL ,
                        `isVisible` BOOL,
                        PRIMARY KEY (
                                     `userID`
                            )
);

CREATE TABLE `Kid` (
                       `kidID` INT  NOT NULL AUTO_INCREMENT,
                       `userID` INT  NOT NULL ,
                       `firstname` VARCHAR(255) ,
                       `birthday` DATE ,
                       `specs` TEXT  NOT NULL ,
                       PRIMARY KEY (
                                    `kidID`
                           )
);

CREATE TABLE `Call` (
                        `userID` INT  NOT NULL ,
                        `kidID` INT  NOT NULL ,
                        `startdate` DATETIME  NOT NULL ,
                        `enddate` DATETIME  NOT NULL ,
                        `context` TEXT ,
                        `comment` TEXT
);

CREATE TABLE `Avatar` (
                          `avatarID` INT  NOT NULL ,
                          `image` VARCHAR(100)  NOT NULL ,
                          PRIMARY KEY (
                                       `avatarID`
                              )
);

CREATE TABLE `Chat` (
                        `userID` INT  NOT NULL ,
                        `date` DATE  NOT NULL ,
                        `content` TEXT  NOT NULL
);

ALTER TABLE `User` ADD CONSTRAINT `fk_User_avatar` FOREIGN KEY(`avatar`)
    REFERENCES `Avatar` (`avatarID`);

ALTER TABLE `Kid` ADD CONSTRAINT `fk_Kid_userID` FOREIGN KEY(`userID`)
    REFERENCES `User` (`userID`);

ALTER TABLE `Call` ADD CONSTRAINT `fk_Call_userID` FOREIGN KEY(`userID`)
    REFERENCES `User` (`userID`);

ALTER TABLE `Call` ADD CONSTRAINT `fk_Call_kidID` FOREIGN KEY(`kidID`)
    REFERENCES `Kid` (`kidID`);

ALTER TABLE `Chat` ADD CONSTRAINT `fk_Chat_userID` FOREIGN KEY(`userID`)
    REFERENCES `User` (`userID`);

INSERT INTO Avatar (avatarID, image) VALUES (1,'assets/avatar1.png');
