CREATE TABLE `devices` (
  `recnum` int(11) NOT NULL AUTO_INCREMENT,
  `DeviceId` varchar(50),
  `DeviceToken` varchar(255),
  `Link2User` int(11),
  `Mobile` varchar(15),
  `Status` varchar(10),
  PRIMARY KEY (`recnum`)
) ENGINE=InnoDB