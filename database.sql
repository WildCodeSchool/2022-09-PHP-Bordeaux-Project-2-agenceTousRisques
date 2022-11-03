-- Création Base de Données nounouEntreNous --

CREATE DATABASE nounouEntreNous;

USE nounouEntreNous;

-- Création Tables User, Kid, Call, Avatar, Chat --

CREATE TABLE `User` (
                        `userID` INT  NOT NULL ,
                        `firstname` VARCHAR(255)  NOT NULL ,
                        `lastname` VARCHAR(255)  NOT NULL ,
                        `telephone` VARCHAR(10)  NOT NULL ,
                        `adress` VARCHAR(255)  NOT NULL ,
                        `email` VARCHAR(150)  NOT NULL ,
                        `avatar` INT NOT NULL ,
                        `activationCode` VARCHAR(10)  NOT NULL ,
                        `isAdmin` BOOL  NOT NULL ,
                        PRIMARY KEY (
                                     `userID`
                            )
);

CREATE TABLE `Kid` (
                       `kidID` INT  NOT NULL ,
                       `userID` INT  NOT NULL ,
                       `firstname` VARCHAR(255)  NOT NULL ,
                       `birthday` DATE  NOT NULL ,
                       `specs` TEXT  NOT NULL ,
                       PRIMARY KEY (
                                    `kidID`
                           )
);

CREATE TABLE `Call` (
                        `userID` INT  NOT NULL ,
                        `kidID` INT  NOT NULL ,
                        `startDate` DATETIME  NOT NULL ,
                        `endDate` DATETIME  NOT NULL ,
                        `context` TEXT  NOT NULL ,
                        `comment` TEXT  NOT NULL
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

-- Définitions des différentes clés étrangères --

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
