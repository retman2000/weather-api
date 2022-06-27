--
-- Database: `myapi`
--

-- --------------------------------------------------------
CREATE DATABASE IF NOT EXISTS `myapi`;

--
-- Table structure for table `tokens`
--
CREATE TABLE `myapi`.`tokens` (
    `Token` VARCHAR(255) NOT NULL ,
    `UsageCount` INT NOT NULL DEFAULT '0' ,
    `LastUsedOn` DATETIME on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
    PRIMARY KEY (`Token`)
) ENGINE = InnoDB;


--
-- Insert 2 Api Tokens into table `tokens`
--
INSERT INTO `tokens` (`Token`, `UsageCount`, `LastUsedOn`) VALUES
  ('QkgAVGXuebE9beJEV6iaMKRWf4eDAtALwi9FibuXvR37HYqEJuQKmVdv9eUEyx88', '0', CURRENT_TIMESTAMP),
  ('3o2fQgpAfxmQhPDsvhDThhyDMZZ7bRh7VcUGAn24UYJWnjVFDtnfZk77Go6NxB62', '0', CURRENT_TIMESTAMP);