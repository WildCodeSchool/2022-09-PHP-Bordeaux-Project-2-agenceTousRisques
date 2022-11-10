DROP DATABASE nounouEntreNous;

CREATE DATABASE nounouEntreNous;

USE nounouEntreNous;

CREATE TABLE `User`
(
    `userID`         INT                 NOT NULL AUTO_INCREMENT,
    `firstname`      VARCHAR(255),
    `lastname`       VARCHAR(255),
    `telephone`      VARCHAR(10),
    `address`        VARCHAR(255),
    `email`          VARCHAR(150) UNIQUE NOT NULL,
    `password`       VARCHAR(255),
    `avatar`         INT,
    `activationcode` VARCHAR(10)         NOT NULL,
    `isAdmin`        BOOL,
    `isVisible`      BOOL,
    PRIMARY KEY (
                 `userID`
        )
);

CREATE TABLE `Kid`
(
    `kidID`     INT  NOT NULL AUTO_INCREMENT,
    `userID`    INT  NOT NULL,
    `firstname` VARCHAR(255),
    `birthday`  DATE,
    `specs`     TEXT NOT NULL,
    PRIMARY KEY (
                 `kidID`
        )
);

CREATE TABLE `Call` (
                        `callID` INT NOT NULL AUTO_INCREMENT,
                        `userID` INT  NOT NULL ,
                        `helperID` INT NULL,
                        `startdate` DATETIME  NOT NULL ,
                        `enddate` DATETIME  NOT NULL ,
                        `context` TEXT ,
                        `comment` TEXT ,
                        PRIMARY KEY (
                                     `callID`
                            )
);

CREATE TABLE Avatar (
                        avatarID INT  NOT NULL ,
                        image VARCHAR(100)  NOT NULL ,
                        PRIMARY KEY (
                                     avatarID
                            )
);

CREATE TABLE Chat (
                      userID INT  NOT NULL ,
                      date DATE  NOT NULL ,
                      content TEXT  NOT NULL
);

ALTER TABLE User ADD CONSTRAINT fk_User_avatar FOREIGN KEY(avatar)
    REFERENCES Avatar (avatarID);

ALTER TABLE Kid ADD CONSTRAINT fk_Kid_userID FOREIGN KEY(userID)
    REFERENCES User (userID);

ALTER TABLE `Call` ADD CONSTRAINT fk_Call_userID FOREIGN KEY(userID)
    REFERENCES User (userID);

ALTER TABLE Chat ADD CONSTRAINT fk_Chat_userID FOREIGN KEY(userID)
    REFERENCES User (userID);
ALTER TABLE `Call` ADD CONSTRAINT `fk_Call_helperID` FOREIGN KEY(`helperID`)
    REFERENCES `User` (`userID`);
);

INSERT INTO Avatar (avatarID, image)
VALUES (1, 'assets/images/avatar1.png'),
       (2, 'assets/images/avatar2.png'),
       (3, 'assets/images/avatar3.png'),
       (4, 'assets/images/avatar4.png'),
       (5, 'assets/images/avatar5.png'),
       (6, 'assets/images/avatar6.png'),
       (7, 'assets/images/avatar7.png'),
       (8, 'assets/images/avatar8.png'),
       (9, 'assets/images/avatar9.png'),
       (10, 'assets/images/avatar10.png');

INSERT INTO User (firstname, lastname, telephone, address, email, password, avatar, activationcode, isAdmin, isVisible)
VALUES ('Jean Le Grand', 'Bokassa', '0102030405', '171 Rue Lucien Faure 33000 Bordeaux',
        'jean-le-grand.bokassa@wildcodeschool.com', '$2y$10$Dwzao66hqTTPoRnIaHRaPuJppJlClGvxG67ds35hyYod4PNzOKN4G', 1,
        '0000001', 1, 1);


