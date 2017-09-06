CREATE TABLE `attendance` (
  `recnum` int(11) NOT NULL AUTO_INCREMENT,
  `empid` varchar(20) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `checkInOut` tinyint(1) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `lat` varchar(50) DEFAULT NULL,
  `lon` varchar(50) DEFAULT NULL,
  `status` char(50) DEFAULT NULL,
  `type` char(50) DEFAULT NULL,
  `link2user` int(11) DEFAULT NULL,
  `siteid` varchar(20) DEFAULT NULL,
  `start_hour` int(11) DEFAULT NULL,
  `start_min` int(11) DEFAULT NULL,
  `end_hour` int(11) DEFAULT NULL,
  `end_min` int(11) DEFAULT NULL,
  PRIMARY KEY (`recnum`)
) ENGINE=InnoDB


CREATE TABLE `attendance_monthly` (
  `recnum` int(11) NOT NULL AUTO_INCREMENT,
  `empid` varchar(20) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `days_come` int(11) DEFAULT NULL,
  `link2user` int(11) DEFAULT NULL,
  `status` char(50) DEFAULT NULL,
  `type` char(50) DEFAULT NULL,
  `siteid` varchar(20) DEFAULT NULL,
  `month` varchar(10) DEFAULT NULL,
  `year` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`recnum`)
) ENGINE=InnoDB

CREATE TABLE `employee_config` (
  `recnum` int(11) NOT NULL AUTO_INCREMENT,
  `shift` varchar(20) DEFAULT NULL,
  `start_hour` int(11) DEFAULT NULL,
  `start_min` int(11) DEFAULT NULL,
  `end_hour` int(11) DEFAULT NULL,
  `end_min` int(11) DEFAULT NULL,
  `link2company` int(11) DEFAULT NULL,
  `status` char(50) DEFAULT NULL,
  `created_date` date DEFAULT NULL,
  `modified_date` date DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `modified_by` varchar(50) DEFAULT NULL,
  `siteid` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`recnum`)
) ENGINE=InnoDB

alter table company add lat varchar(50);
alter table company add lon varchar(50);

alter table employee add shift_group varchar(50);
alter table employee add subscription_type varchar(50);