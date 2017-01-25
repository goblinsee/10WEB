/*
Navicat MySQL Data Transfer

Source Server         : 本地数据库连接
Source Server Version : 50711
Source Host           : localhost:3306
Source Database       : e0webdatabase

Target Server Type    : MYSQL
Target Server Version : 50711
File Encoding         : 65001

Date: 2016-11-10 17:41:11
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `e0_archives`
-- ----------------------------
DROP TABLE IF EXISTS `e0_archives`;
CREATE TABLE `e0_archives` (
  `ID` varchar(20) NOT NULL,
  `SortRank` int(11) DEFAULT '1',
  `IsCommend` smallint(6) DEFAULT '1',
  `ArcRank` smallint(6) DEFAULT NULL,
  `Click` int(10) DEFAULT NULL,
  `Title` varchar(30) NOT NULL,
  `Writer` varchar(10) NOT NULL,
  `Source` varchar(50) DEFAULT NULL,
  `RedirectUrl` varchar(100) DEFAULT NULL,
  `LitPic` varchar(100) DEFAULT NULL,
  `PubDate` datetime DEFAULT NULL,
  `ModiDate` datetime DEFAULT NULL,
  `Tag` int(11) DEFAULT NULL,
  `Mid` varchar(20) DEFAULT NULL,
  `State` smallint(6) DEFAULT NULL,
  `Keyword` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ID`,`Title`),
  KEY `ID` (`ID`),
  KEY `Mid` (`Mid`),
  KEY `Tag` (`Tag`),
  CONSTRAINT `e0_archives_ibfk_1` FOREIGN KEY (`Mid`) REFERENCES `e0_user` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `e0_archives_ibfk_2` FOREIGN KEY (`Tag`) REFERENCES `e0_tag` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of e0_archives
-- ----------------------------

-- ----------------------------
-- Table structure for `e0_msg`
-- ----------------------------
DROP TABLE IF EXISTS `e0_msg`;
CREATE TABLE `e0_msg` (
  `ID` varchar(20) NOT NULL,
  `Sender` varchar(20) NOT NULL,
  `Receiver` varchar(20) NOT NULL,
  `Content` varchar(255) DEFAULT NULL,
  `Type` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`ID`,`Sender`,`Receiver`),
  KEY `Sender` (`Sender`),
  KEY `Receiver` (`Receiver`),
  CONSTRAINT `e0_msg_ibfk_1` FOREIGN KEY (`Sender`) REFERENCES `e0_user` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `e0_msg_ibfk_2` FOREIGN KEY (`Receiver`) REFERENCES `e0_user` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of e0_msg
-- ----------------------------

-- ----------------------------
-- Table structure for `e0_tag`
-- ----------------------------
DROP TABLE IF EXISTS `e0_tag`;
CREATE TABLE `e0_tag` (
  `ID` int(10) NOT NULL,
  `Name` varchar(20) NOT NULL,
  PRIMARY KEY (`ID`,`Name`),
  KEY `ID` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of e0_tag
-- ----------------------------

-- ----------------------------
-- Table structure for `e0_user`
-- ----------------------------
DROP TABLE IF EXISTS `e0_user`;
CREATE TABLE `e0_user` (
  `ID` varchar(20) NOT NULL,
  `Account` varchar(20) NOT NULL,
  `Password` varchar(20) NOT NULL,
  `Profile` text,
  `Permission` int(10) NOT NULL DEFAULT '0',
  `TokenID` varchar(20) DEFAULT NULL,
  `LoginTime` datetime(6) NOT NULL,
  `LoginIP` varchar(20) DEFAULT NULL,
  `HeadIcon` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`ID`,`Account`,`Password`,`Permission`),
  KEY `ID` (`ID`),
  KEY `ID_2` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of e0_user
-- ----------------------------

-- ----------------------------
-- Table structure for `e0_userarchives`
-- ----------------------------
DROP TABLE IF EXISTS `e0_userarchives`;
CREATE TABLE `e0_userarchives` (
  `UserID` varchar(20) NOT NULL,
  `ArchiveID` varchar(20) NOT NULL,
  `OpType` int(10) NOT NULL,
  PRIMARY KEY (`UserID`,`ArchiveID`,`OpType`),
  KEY `ArchiveID` (`ArchiveID`),
  CONSTRAINT `e0_userarchives_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `e0_user` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `e0_userarchives_ibfk_2` FOREIGN KEY (`ArchiveID`) REFERENCES `e0_archives` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of e0_userarchives
-- ----------------------------

-- ----------------------------
-- Table structure for `e0_useruser`
-- ----------------------------
DROP TABLE IF EXISTS `e0_useruser`;
CREATE TABLE `e0_useruser` (
  `FUserID` varchar(20) NOT NULL,
  `TUserID` varchar(20) NOT NULL,
  `Type` smallint(6) NOT NULL,
  PRIMARY KEY (`FUserID`,`TUserID`,`Type`),
  KEY `TUserID` (`TUserID`),
  CONSTRAINT `e0_useruser_ibfk_1` FOREIGN KEY (`FUserID`) REFERENCES `e0_user` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `e0_useruser_ibfk_2` FOREIGN KEY (`TUserID`) REFERENCES `e0_user` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of e0_useruser
-- ----------------------------
