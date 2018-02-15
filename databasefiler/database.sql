-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 16, 2017 at 12:56 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `utested`
--
DROP DATABASE IF EXISTS utested;
CREATE DATABASE utested COLLATE utf8_general_ci;
USE utested;
-- --------------------------------------------------------


DROP TABLE IF EXISTS ticket;
DROP TABLE IF EXISTS event;
DROP TABLE IF EXISTS user;
DROP TABLE IF EXISTS seat;

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
    `EventID` int(20) NOT NULL,
    `Name` varchar(255) NOT NULL,
    `Date` date DEFAULT NULL,
    `Time` time DEFAULT NULL,
    `Comment` varchar(200) DEFAULT NULL,
    `Description` varchar(10000) DEFAULT NULL,
    `Producer` varchar(255) DEFAULT 'Eldøy Kulturpark',
    `Age` varchar(2) DEFAULT '18',
    `Fee` int(11) DEFAULT NULL,
    `Active` bool DEFAULT TRUE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Test data for `event`. Dette blir lagt inn slik at det allerede ligger eventer inne i db.
--


INSERT INTO `event` (`EventID`, `Name`, `Date`, `Time`,`Comment`, `Description`, `Producer`, `Fee`, `Age`, `Active`) VALUES
(1, 'Toto', '2017-05-05', '20:00:00', 'Toto er musikk alle liker.','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur massa urna, commodo at bibendum eu, suscipit pulvinar magna. Praesent a sapien ex. Nam rhoncus tortor ut lacus tincidunt, non rhoncus risus dignissim. Nam bibendum nulla a ipsum semper tincidunt. Nunc euismod turpis et dolor lacinia, vel ultrices felis fringilla. Aliquam vestibulum dolor sapien, vel porttitor ipsum tincidunt vel. Sed elit risus, pharetra ac sapien a, ultrices hendrerit magna. Nunc at turpis vel libero hendrerit sagittis. Donec at mauris orci. Duis id sapien ullamcorper mi tincidunt porta.', 'Eldøy Kulturpark', 159, '0', True),
(2, 'Oz Noy', '2017-05-06', '20:00:00', 'Israelsk fusion - fordi.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur massa urna, commodo at bibendum eu, suscipit pulvinar magna. Praesent a sapien ex. Nam rhoncus tortor ut lacus tincidunt, non rhoncus risus dignissim. Nam bibendum nulla a ipsum semper tincidunt. Nunc euismod turpis et dolor lacinia, vel ultrices felis fringilla. Aliquam vestibulum dolor sapien, vel porttitor ipsum tincidunt vel. Sed elit risus, pharetra ac sapien a, ultrices hendrerit magna. Nunc at turpis vel libero hendrerit sagittis. Donec at mauris orci. Duis id sapien ullamcorper mi tincidunt porta.', 'Eldøy Kulturpark', 150, '18', True),
(3, 'Mathias Eick Kvartett', '2017-05-12', '20:00:00', 'Norsk trompetjazz.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur massa urna, commodo at bibendum eu, suscipit pulvinar magna. Praesent a sapien ex. Nam rhoncus tortor ut lacus tincidunt, non rhoncus risus dignissim. Nam bibendum nulla a ipsum semper tincidunt. Nunc euismod turpis et dolor lacinia, vel ultrices felis fringilla. Aliquam vestibulum dolor sapien, vel porttitor ipsum tincidunt vel. Sed elit risus, pharetra ac sapien a, ultrices hendrerit magna. Nunc at turpis vel libero hendrerit sagittis. Donec at mauris orci. Duis id sapien ullamcorper mi tincidunt porta.', 'Eldøy Kulturpark', 250, '21', True),
(4, 'Tetsuo Sakurai', '2017-05-13', '13:45:00', 'Japansk flinkisfusion.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur massa urna, commodo at bibendum eu, suscipit pulvinar magna. Praesent a sapien ex. Nam rhoncus tortor ut lacus tincidunt, non rhoncus risus dignissim. Nam bibendum nulla a ipsum semper tincidunt. Nunc euismod turpis et dolor lacinia, vel ultrices felis fringilla. Aliquam vestibulum dolor sapien, vel porttitor ipsum tincidunt vel. Sed elit risus, pharetra ac sapien a, ultrices hendrerit magna. Nunc at turpis vel libero hendrerit sagittis. Donec at mauris orci. Duis id sapien ullamcorper mi tincidunt porta.', 'Eldøy Kulturpark', 150, '3', True),
(5, 'Snarky Puppy', '2017-05-19', '21:00:00', 'Amerikansk Berkleyjazz.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur massa urna, commodo at bibendum eu, suscipit pulvinar magna. Praesent a sapien ex. Nam rhoncus tortor ut lacus tincidunt, non rhoncus risus dignissim. Nam bibendum nulla a ipsum semper tincidunt. Nunc euismod turpis et dolor lacinia, vel ultrices felis fringilla. Aliquam vestibulum dolor sapien, vel porttitor ipsum tincidunt vel. Sed elit risus, pharetra ac sapien a, ultrices hendrerit magna. Nunc at turpis vel libero hendrerit sagittis. Donec at mauris orci. Duis id sapien ullamcorper mi tincidunt porta.', 'Eldøy Kulturpark', 150, '21', True),
(6, 'Pat Metheny', '2017-05-20', '19:00:00', 'Pat Metheny Group spiller hele White Album, til glede for nye lyttere.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur massa urna, commodo at bibendum eu, suscipit pulvinar magna. Praesent a sapien ex. Nam rhoncus tortor ut lacus tincidunt, non rhoncus risus dignissim. Nam bibendum nulla a ipsum semper tincidunt. Nunc euismod turpis et dolor lacinia, vel ultrices felis fringilla. Aliquam vestibulum dolor sapien, vel porttitor ipsum tincidunt vel. Sed elit risus, pharetra ac sapien a, ultrices hendrerit magna. Nunc at turpis vel libero hendrerit sagittis. Donec at mauris orci. Duis id sapien ullamcorper mi tincidunt porta.', 'Eldøy Kulturpark', 210, '18', True),
(7, 'Alex Argento', '2017-05-26', '18:00:00', 'Italiensk keyboardvirtuoso gjester kulturparken for første gang.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur massa urna, commodo at bibendum eu, suscipit pulvinar magna. Praesent a sapien ex. Nam rhoncus tortor ut lacus tincidunt, non rhoncus risus dignissim. Nam bibendum nulla a ipsum semper tincidunt. Nunc euismod turpis et dolor lacinia, vel ultrices felis fringilla. Aliquam vestibulum dolor sapien, vel porttitor ipsum tincidunt vel. Sed elit risus, pharetra ac sapien a, ultrices hendrerit magna. Nunc at turpis vel libero hendrerit sagittis. Donec at mauris orci. Duis id sapien ullamcorper mi tincidunt porta.', 'Eldøy Kulturpark', 175, '18', True),
(8, 'Cosmosquad', '2017-05-27', '20:00:00', 'Funky fusionband fra Ohio, med selveste Jeffrey Kollman i spissen.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur massa urna, commodo at bibendum eu, suscipit pulvinar magna. Praesent a sapien ex. Nam rhoncus tortor ut lacus tincidunt, non rhoncus risus dignissim. Nam bibendum nulla a ipsum semper tincidunt. Nunc euismod turpis et dolor lacinia, vel ultrices felis fringilla. Aliquam vestibulum dolor sapien, vel porttitor ipsum tincidunt vel. Sed elit risus, pharetra ac sapien a, ultrices hendrerit magna. Nunc at turpis vel libero hendrerit sagittis. Donec at mauris orci. Duis id sapien ullamcorper mi tincidunt porta.', 'Eldøy Kulturpark', 300, '16', True),
(9, 'Jaga Jazzist', '2017-06-02', '19:00:00', 'Norsk Jazz/electro/rock band har sluppet ny plate og kommer innom oss på sin turne!', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur massa urna, commodo at bibendum eu, suscipit pulvinar magna. Praesent a sapien ex. Nam rhoncus tortor ut lacus tincidunt, non rhoncus risus dignissim. Nam bibendum nulla a ipsum semper tincidunt. Nunc euismod turpis et dolor lacinia, vel ultrices felis fringilla. Aliquam vestibulum dolor sapien, vel porttitor ipsum tincidunt vel. Sed elit risus, pharetra ac sapien a, ultrices hendrerit magna. Nunc at turpis vel libero hendrerit sagittis. Donec at mauris orci. Duis id sapien ullamcorper mi tincidunt porta.', 'Eldøy Kulturpark', 250, '18', True);


-- --------------------------------------------------------

--
-- Table structure for table `seat`
--

CREATE TABLE `seat` (
    `SeatID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `seat`
--

INSERT INTO `seat` (`SeatID`) VALUES
(1),(2),(3),(4),(5),(6),(7),(8),
(9),(10),(11),(12),(13),(14),(15),(16),
(17),(18),(19),(20),(21),(22),(23),(24),
(25),(26),(27),(28),(29),(30),(31),(32),
(33),(34),(35),(36),(37),(38),(39),(40),
(41),(42),(43),(44),(45),(46),(47),(48),
(49),(50),(51),(52),(53),(54),(55),(56),
(57),(58),(59),(60),(61),(62),(63),(64),
(65),(66),(67),(68),(69),(70),(71),(72),
(73),(74),(75),(76),(77),(78),(79),(80),
(81),(82),(83),(84),(85),(86),(87),(88),
(89),(90),(91),(92),(93),(94),(95),(96),
(97),(98),(99),(100),
(101),(102),(103),(104),(105),(106),(107),(108),
(109),(110),(111),(112),(113),(114),(115),(116),
(117),(118),(119),(120),(121),(122),(123),(124),
(125),(126),(127),(128),(129),(130),(131),(132),
(133),(134),(135),(136),(137),(138),(139),(140),
(141),(142),(143),(144),(145),(146),(147),(148),
(149),(150),(151),(152),(153),(154),(155),(156),
(157),(158),(159),(160),(161),(162),(163),(164),
(165),(166),(167),(168),(169),(170),(171),(172),
(173),(174),(175),(176),(177),(178),(179),(180),
(181),(182),(183),(184),(185),(186),(187),(188),
(189),(190),(191),(192),(193),(194),(195),(196);

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE `ticket` (
    `TicketID` int(11) NOT NULL,
    `EventID` int(11) NOT NULL,
    `SeatID` int(11) NOT NULL,
    `UserID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ticket`
--


INSERT INTO `ticket` (`TicketID`, `EventID`, `SeatID`, `UserID`) VALUES
(1, 1, 1, 3),
(2, 1, 2, 4),
(3, 2, 2, 4),
(4, 2, 3, 1),
(5, 2, 4, 1),
(6, 3, 2, 3),
(7, 3, 3, 1),
(8, 3, 4, 3),
(9, 3, 5, 4),
(10, 4, 2, 3),
(11, 4, 3, 1),
(12, 5, 2, 3),
(13, 6, 2, 4);


-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
    `UserID` int(11) NOT NULL,
    `Username` varchar(255) NOT NULL,
    `Password` varchar(255) NOT NULL,
    `Email` varchar(255) NOT NULL,
    `IsAdmin` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`UserID`, `Username`, `Password`, `Email`, `IsAdmin`) VALUES
(1, 'guest', 'guest', 'guest@guest.com', 0),
(2, 'admin', 'admin', 'admin@admin.com', 1),
(3, 'bettan', 'bettan', 'elisabeth_trane@gmail.com', 0),
(4, 'firfisla', 'firfisla', 'hivertsoyem@online.no', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`EventID`),
  ADD UNIQUE KEY `ID_UNIQUE` (`EventID`);

--
-- Indexes for table `seat`
--
ALTER TABLE `seat`
  ADD PRIMARY KEY (`SeatID`);

--
-- Indexes for table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`EventID`,`SeatID`),
  ADD KEY (`TicketID`),
  ADD KEY `EventID_idx` (`EventID`),
  ADD KEY `SeatID_idx` (`SeatID`),
  ADD KEY `UserID_idx` (`UserID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `EventID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `seat`
--
ALTER TABLE `seat`
  MODIFY `SeatID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=197;
--
-- AUTO_INCREMENT for table `ticket`
--
ALTER TABLE `ticket`
  MODIFY `TicketID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `ticket`
--
ALTER TABLE `ticket`
  ADD CONSTRAINT `EventID` FOREIGN KEY (`EventID`) REFERENCES `event` (`eventID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `SeatID` FOREIGN KEY (`SeatID`) REFERENCES `seat` (`SeatID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `UserID` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- Trigger som sletter tickets til arrangement som slettes.
DELIMITER $$
DROP TRIGGER IF EXISTS event_e_del_trg $$

CREATE TRIGGER event_e_del_trg
    BEFORE DELETE ON event
    FOR EACH ROW
BEGIN
    DELETE FROM ticket
    WHERE ticket.EventID = OLD.EventID;
END $$

-- Trigger som hindrer admin å endre rettigheten sin.
DELIMITER $$
DROP TRIGGER IF EXISTS event_b_upd_trg $$

CREATE TRIGGER event_b_upd_trg
    BEFORE UPDATE ON user
    FOR EACH ROW
BEGIN
    IF OLD.UserID = 2 THEN
    SIGNAL SQLSTATE '80000'
    SET MESSAGE_TEXT = 'Kan ikke deaktivere admin!';
    END IF;
END $$

-- Rutine for å lage en ny bruker. 
DELIMITER $$

    DROP PROCEDURE IF EXISTS lagBruker $$
    CREATE PROCEDURE lagBruker(IN Username varchar(255),IN Password varchar(255),IN Email varchar(255),IN IsAdmin tinyint(1))
    BEGIN INSERT INTO user(Username, Password, Email, IsAdmin) VALUES(Username,Password, Email,IsAdmin);
    END
$$

-- Procedure der alle aktive arrangement vises.
DELIMITER $$

    DROP PROCEDURE IF EXISTS activeArr $$
    CREATE PROCEDURE activeArr()
    BEGIN SELECT *
    FROM event
    WHERE Active='1';
    END
$$ 
-- Procedure der de fire første arrangementene vises.
DELIMITER $$

    DROP PROCEDURE IF EXISTS topArr $$
    CREATE PROCEDURE topArr()
    BEGIN SELECT *
    FROM event
    WHERE event.Active = 1
    ORDER BY Date ASC
    LIMIT 4;
    END
$$ 

-- Procedure som viser info om hva som er solgt på hvert arrangement
DELIMITER $$

    DROP PROCEDURE IF EXISTS ticketSale $$
    CREATE PROCEDURE ticketSale()
    BEGIN SELECT ticket.EventID, event.Name, COUNT(*) * event.Fee AS Opptjent, COUNT(*) AS Antall 
    FROM ticket INNER JOIN event ON ticket.EventID = event.EventID
    WHERE event.Active = 1
    GROUP BY ticket.EventID 
    ORDER BY Antall;
    END
$$ 

-- Forretningsregel som hindrer bruker å kjøpe mer enn 10 billetter til samme event
DELIMITER $$  
DROP TRIGGER IF EXISTS ticketAmount_b_ins_trg $$

CREATE TRIGGER ticketAmount_b_ins_trg
  BEFORE INSERT ON ticket
  FOR EACH ROW
  BEGIN
  DECLARE ant integer;
  SELECT COUNT(*)
  FROM ticket
  WHERE UserID = NEW.UserID AND EventID = NEW.EventID
  INTO
  ant;
  IF (ant > 10) THEN
      SIGNAL SQLSTATE '80000'
      SET MESSAGE_TEXT = 'Ønsker du å reservere grupper på flere enn ti personer så ta gjerne kontakt med oss!';
      END IF;
END $$
DELIMITER ;

-- Forretningsregel som hindrer admin å oppdatere prisen mer eller mindre enn en bestemt mengde

DELIMITER $$
DROP TRIGGER IF EXISTS feeUpdate_b_upd_trg $$

CREATE TRIGGER feeUpdate_b_upd_trg
BEFORE UPDATE ON event
FOR EACH ROW
BEGIN
IF NEW.Fee > (OLD.Fee+100) THEN
    SIGNAL SQLSTATE '80000'
    SET MESSAGE_TEXT = 'Pris kan ikke økes med mer enn 100 kr!';
    END IF;
IF NEW.Fee < (OLD.Fee-100) THEN
    SIGNAL SQLSTATE '80000'
 SET MESSAGE_TEXT = 'Pris kan ikke senkes med mer enn 100kr!';
    END IF;
END $$
DELIMITER ;

-- Forretningsregel som hindrer admin å opprette et event mer enn 1 år frem i tid

DELIMITER $$
DROP TRIGGER IF EXISTS eventCreate_b_ins_trg $$

CREATE TRIGGER eventCreate_b_ins_trg
BEFORE INSERT ON event
FOR EACH ROW
BEGIN
IF NEW.Date > (NOW()+ INTERVAL 365 DAY) THEN
    SIGNAL SQLSTATE '80000'
    SET MESSAGE_TEXT = 'Arrangement kan ikke opprettes mer enn 1 år frem i tid!';
    END IF;
END $$
DELIMITER ;

