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

# INSERT INTO User (firstname, lastname, telephone, address, email, password, avatar, activationcode, isAdmin, isVisible)
# VALUES ('Jean Le Grand', 'Bokassa', '0102030405', '171 Rue Lucien Faure 33000 Bordeaux',
#         'jean-le-grand.bokassa@wildcodeschool.com', '$2y$10$Dwzao66hqTTPoRnIaHRaPuJppJlClGvxG67ds35hyYod4PNzOKN4G', 1,
#         '0000001', 1, 1),
#        ('Naomie', 'Wilder', '0102030405', '171 Rue Lucien Faure 33000 Bordeaux',
#         'naomie@wildcodeschool.com', '$2y$10$Dwzao66hqTTPoRnIaHRaPuJppJlClGvxG67ds35hyYod4PNzOKN4G', 2,
#         '0000002', 0, 1),
#        ('Yazid', 'Wilder', '0102030405', '171 Rue Lucien Faure 33000 Bordeaux',
#         'yazid@wildcodeschool.com', '$2y$10$Dwzao66hqTTPoRnIaHRaPuJppJlClGvxG67ds35hyYod4PNzOKN4G', 3,
#         '0000003', 0, 1),
#        ('Jordan', 'Wilder', '0102030405', '171 Rue Lucien Faure 33000 Bordeaux',
#         'jordan@wildcodeschool.com', '$2y$10$Dwzao66hqTTPoRnIaHRaPuJppJlClGvxG67ds35hyYod4PNzOKN4G', 4,
#         '00000011', 0, 1),
#        ('Johann', 'Wilder', '0102030405', '171 Rue Lucien Faure 33000 Bordeaux',
#         'johann@wildcodeschool.com', '$2y$10$Dwzao66hqTTPoRnIaHRaPuJppJlClGvxG67ds35hyYod4PNzOKN4G', 5,
#         '0000004', 0, 1),
#        ('Pierre', 'Wilder', '0102030405', '171 Rue Lucien Faure 33000 Bordeaux',
#         'pierre@wildcodeschool.com', '$2y$10$Dwzao66hqTTPoRnIaHRaPuJppJlClGvxG67ds35hyYod4PNzOKN4G', 6,
#         '0000005', 0, 1),
#        ('Alexis', 'Wilder', '0102030405', '171 Rue Lucien Faure 33000 Bordeaux',
#         'alexis@wildcodeschool.com', '$2y$10$Dwzao66hqTTPoRnIaHRaPuJppJlClGvxG67ds35hyYod4PNzOKN4G', 7,
#         '0000006', 0, 1),
#        ('Helène', 'Wilder', '0102030405', '171 Rue Lucien Faure 33000 Bordeaux',
#         'helene@wildcodeschool.com', '$2y$10$Dwzao66hqTTPoRnIaHRaPuJppJlClGvxG67ds35hyYod4PNzOKN4G', 8,
#         '0000007', 0, 1),
#        ('Anthony', 'Wilder', '0102030405', '171 Rue Lucien Faure 33000 Bordeaux',
#         'anthony@wildcodeschool.com', '$2y$10$Dwzao66hqTTPoRnIaHRaPuJppJlClGvxG67ds35hyYod4PNzOKN4G', 9,
#         '0000008', 0, 1),
#        ('Killian', 'Wilder', '0102030405', '171 Rue Lucien Faure 33000 Bordeaux',
#         'killian@wildcodeschool.com', '$2y$10$Dwzao66hqTTPoRnIaHRaPuJppJlClGvxG67ds35hyYod4PNzOKN4G', 10,
#         '0000009', 0, 1);

INSERT INTO Kid (userID, firstname, birthday, specs)
VALUES (1, 'Michel', '2020-04-11', 'Rien de particulier'),
       (2, 'Jules', '2021-12-31', 'Asthmatique'),
       (3, 'Noah', '2021-11-28', 'Rien'),
       (4, 'Céline', '2020-02-12', 'Jumeaux'),
       (4, 'Julien', '2020-02-12', 'Jumeaux'),
       (5, 'Marie', '2021-02-01', 'Rien'),
       (6, 'Mickaël', '2020-05-04', 'Diabète'),
       (7, 'Pierre', '2021-04-27', 'Rien'),
       (8, 'Antony', '2021-08-15', 'Anxieux'),
       (9, 'Sophie', '2020-07-17', 'Nothing'),
       (10, 'Guenièvre', '2020-01-06', 'Reine'),
       (10, 'Arthur', '2020-01-06', 'Roi');

INSERT INTO `Call` (userID, helperID, startdate, enddate, context, comment)
VALUES (1, null, '2022-11-12 09:00', '2022-11-13 09:00', 'Absence Parents', 'Rien de particulier'),
       (8, 4, '2022-11-12 09:00', '2022-11-12 09:00', 'Absence Parents', 'Rien de particulier'),
       (8, null, '2022-11-17 09:00', '2022-11-18 09:00', 'Absence Parents', 'Rien de particulier'),
       (8, null, '2022-11-22 09:00', '2022-11-22 09:00', 'Absence Parents', 'Rien de particulier'),
       (8, 4, '2022-11-22 09:00', '2022-11-22 18:00', 'Absence Parents', 'Rien de particulier'),
       (2, null, '2022-11-15 09:00', '2022-11-15 11:00', 'Rendez-vous', 'Rien de particulier'),
       (3, 5, '2022-11-19 09:00', '2022-11-20 09:00', 'Absence Parents', 'Rien de particulier'),
       (5, 3, '2022-11-16 09:00', '2022-11-19 09:00', 'Absence Parents', 'Rien de particulier'),
       (10, null, '2022-12-04 09:00', '2022-12-04 11:00', 'Absence Parents', 'Rien de particulier'),
       (9, null, '2022-11-19 09:00', '2022-11-19 15:00', 'Absence Parents', 'Rien de particulier'),
       (6, 1, '2022-11-14 09:00', '2022-11-14 09:45', 'Rendez-vous', 'Rien de particulier'),
       (6, null, '2022-11-23 09:00', '2022-11-23 09:00', 'Absence Parents', 'Hackathon');
