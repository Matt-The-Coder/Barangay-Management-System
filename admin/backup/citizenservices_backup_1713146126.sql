# ABMS : MySQL database backup
#
# Generated: Monday 15. April 2024
# Hostname: localhost
# Database: citizenservices
# --------------------------------------------------------


#
# Delete any existing table `barangay_clearance`
#

DROP TABLE IF EXISTS `barangay_clearance`;


#
# Table structure of table `barangay_clearance`
#



CREATE TABLE `barangay_clearance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) NOT NULL,
  `purpose` varchar(255) NOT NULL,
  `pickup_date` date NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `reference_number` varchar(100) DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

INSERT INTO barangay_clearance VALUES("1","sadsa","dasdsad","sadsadsa","sadsadsa","2024-03-23","Cash","","2024-03-05 16:14:36");



#
# Delete any existing table `tbl_support`
#

DROP TABLE IF EXISTS `tbl_support`;


#
# Table structure of table `tbl_support`
#



CREATE TABLE `tbl_support` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(60) DEFAULT NULL,
  `number` varchar(20) DEFAULT NULL,
  `subject` varchar(100) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `date` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

INSERT INTO tbl_support VALUES("4","aS","juan@gmail.com","SDASD","Feedback","ASDASD","2024-03-06 11:14:17");



#
# Delete any existing table `tbl_users`
#

DROP TABLE IF EXISTS `tbl_users`;


#
# Table structure of table `tbl_users`
#



CREATE TABLE `tbl_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `user_type` varchar(20) DEFAULT NULL,
  `avatar` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

INSERT INTO tbl_users VALUES("10","staff","6ccb4b7c39a6e77f76ecfa935a855c6c46ad5611","staff","03052021043218icon.png","2023-02-20 10:32:18");
INSERT INTO tbl_users VALUES("11","admin","d033e22ae348aeb5660fc2140aec35850c4da997","administrator","1504202403544320201211_162254.jpg","2023-02-20 10:33:03");



#
# Delete any existing table `tblblotter`
#

DROP TABLE IF EXISTS `tblblotter`;


#
# Table structure of table `tblblotter`
#



CREATE TABLE `tblblotter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `complainant` varchar(100) DEFAULT NULL,
  `respondent` varchar(100) DEFAULT NULL,
  `victim` varchar(100) DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `time` time DEFAULT NULL,
  `details` varchar(10000) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4;




#
# Delete any existing table `tblbrgy_info`
#

DROP TABLE IF EXISTS `tblbrgy_info`;


#
# Table structure of table `tblbrgy_info`
#



CREATE TABLE `tblbrgy_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `province` varchar(100) DEFAULT NULL,
  `town` varchar(100) DEFAULT NULL,
  `brgy_name` varchar(50) DEFAULT NULL,
  `number` varchar(50) DEFAULT NULL,
  `text` text DEFAULT NULL,
  `image` varchar(200) DEFAULT NULL,
  `city_logo` varchar(100) DEFAULT NULL,
  `brgy_logo` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

INSERT INTO tblbrgy_info VALUES("1","Metro Manila","Valenzuela City","BRGY MAPULANG LUPA","09564612566","The barangay is named after the many trees that abound the hilly landscape of Canumay. Its fruit is said to be poisonous to fish. Every easter the residents celebrate their fiesta, alternating from east and west parts of the barangay every two years. Famous landmarks include Splash Corporation. About 28,192 residents live in the 296.8 square meters of Canumay.","22032023113937315596319_434405582200952_4256018686068222128_n.jpg","22032023115731photo_2023-03-22_18-44-41.jpg","21032023055407brgy-logo.png");



#
# Delete any existing table `tblchairmanship`
#

DROP TABLE IF EXISTS `tblchairmanship`;


#
# Table structure of table `tblchairmanship`
#



CREATE TABLE `tblchairmanship` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

INSERT INTO tblchairmanship VALUES("12","Committee on Rules");



#
# Delete any existing table `tbldocument`
#

DROP TABLE IF EXISTS `tbldocument`;


#
# Table structure of table `tbldocument`
#



CREATE TABLE `tbldocument` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(50) NOT NULL,
  `mname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `pickup` date NOT NULL,
  `payment` varchar(12) NOT NULL,
  `reference` varchar(30) NOT NULL,
  `purpose` text NOT NULL,
  `type` varchar(25) NOT NULL,
  `date_req` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `docstatus` varchar(25) NOT NULL,
  `tracking_code` varchar(30) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `number` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `bname` varchar(255) DEFAULT NULL,
  `tbusiness` varchar(255) DEFAULT NULL,
  `sbusiness` date DEFAULT NULL,
  `baddress` varchar(255) DEFAULT NULL,
  `bowner` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4;

INSERT INTO tbldocument VALUES("3","ASDASD","ASDASD","ASDASD","2024-03-29","Cash","","ASDASD","Certificate of Indigency","0000-00-00 00:00:00","Released","BMS65E7DC745C648","","","","","","","","");
INSERT INTO tbldocument VALUES("4","ASDASD","ASDASD","ASDASD","2024-03-19","Cash","","ASDASD","Barangay Clearance","0000-00-00 00:00:00","Released","BMS65E7DC817AEE3","","","","","","","","");
INSERT INTO tbldocument VALUES("5","asdas","dasdasd","asdasd","2024-03-23","Cash","","asdasd","Barangay Clearance","2024-03-06 00:00:00","Pending","BMS65E7DEB79C92C","","","","","","","","");
INSERT INTO tbldocument VALUES("6","asdasda","sdasd","asd","2024-03-27","Cash","","asdasd","Barangay Clearance","2024-03-06 00:00:00","Pending","BMS65E7DF0BC2021","","","","","","","","");
INSERT INTO tbldocument VALUES("7","asda","sdasdas","asdas","2024-03-14","Cash","","asdasd","Certificate of Indigency","0000-00-00 00:00:00","Processing","BMS65E7DF3900774","","","","","","","","");
INSERT INTO tbldocument VALUES("8","asdas","dasdsd","asdsd","2024-03-14","Cash","","asd","Certificate of Indigency","2024-03-06 00:00:00","Pending","BMS65E7E4F3BA250","","","","","","","","");
INSERT INTO tbldocument VALUES("9","asdasd","asdasd","asdsd","2024-03-28","Cash","","ghjghj","Certificate of Indigency","2024-03-14 00:00:00","Pending","BMS65F36AE5487AA","","","","","","","","");
INSERT INTO tbldocument VALUES("10","fdgd","hjgh","ghj","2024-03-29","Gcash","","ghjg","Certificate of Indigency","2024-03-14 00:00:00","Pending","BMS65F36AF5850E1","","","","","","","","");
INSERT INTO tbldocument VALUES("11","asdasd","asdasd","jhkhjk","2024-03-29","Cash","","hjkhjk","Business Permit","2024-03-14 00:00:00","Pending","BMS65F36BBD5E76C","","","","","","","","");
INSERT INTO tbldocument VALUES("12","hgjky","678","ryhd","2024-03-14","Cash","","dfgdfg","Barangay Clearance","2024-03-14 00:00:00","Pending","BMS65F36BC915C7F","","","","","","","","");
INSERT INTO tbldocument VALUES("13","blavk","","master","2024-03-21","Cash","","2dfsdf","Business Permit","2024-03-18 00:00:00","Pending","BMS65F7D0BC1BE1C","","","","","","","","");
INSERT INTO tbldocument VALUES("14","black`","","asdasd","2024-03-27","Cash","","24wsdv","Certificate of Indigency","2024-03-18 00:00:00","Pending","BMS65F7D0CEA54E3","","","","","","","","");
INSERT INTO tbldocument VALUES("15","w3edfsd","3sdsdf","sdf4gsd","2024-03-19","Cash","","asd3asdf","Barangay Clearance","2024-03-18 00:00:00","Pending","BMS65F7D0DB50A58","","","","","","","","");
INSERT INTO tbldocument VALUES("16","sdsda","asds","dsds","2024-03-27","Cash","","3243","Certificate of Indigency","2024-03-27 00:00:00","Pending","BMS66037B64C7C4A","","","","","","","","");
INSERT INTO tbldocument VALUES("17","sdsda","asds","dsds","2024-03-27","Cash","","3243","Certificate of Indigency","2024-03-27 00:00:00","Pending","BMS66037BA991A5C","","","","","","","","");
INSERT INTO tbldocument VALUES("18","sdfsdf","dsfsdf","sdfsdf","2024-04-04","Cash","","bsdfsdf","Certificate of Indigency","2024-03-27 00:00:00","Pending","BMS66037BB3B6FE4","","","","","","","","");
INSERT INTO tbldocument VALUES("19","bnmbnm","bnmbnm","bnmbnm","2024-03-27","Cash","","bnmbnm","Certificate of Indigency","2024-03-27 00:00:00","Pending","BMS66037C8CD863C","","","","","","","","");
INSERT INTO tbldocument VALUES("20","bnmghj","","ghj","2024-03-21","Cash","","ghjghj","Business Permit","2024-03-27 00:00:00","Pending","BMS66037C9ABCEAA","","","","","","","","");
INSERT INTO tbldocument VALUES("21","rty","rtyrty","rtyrt","2024-03-27","Cash","","rtyrt","Barangay Clearance","2024-03-27 00:00:00","Pending","BMS66037CA797718","","","","","","","","");
INSERT INTO tbldocument VALUES("22","Martis","john","doe","2024-04-19","Cash","","jmdasbf","Barangay Clearance","2024-04-05 00:00:00","Pending","BMS660F9B43B1B11","martis@yahoo.com","","skjdfbajskd","","","","","");
INSERT INTO tbldocument VALUES("23","Martis","john","doe","2024-04-19","Cash","","jmdasbf","Barangay Clearance","2024-04-05 00:00:00","Pending","BMS660F9B5B662BC","martis@yahoo.com","09123123123","skjdfbajskd","","","","","");
INSERT INTO tbldocument VALUES("24","Martis","john","doe","2024-04-19","Cash","","jmdasbf","Barangay Clearance","2024-04-05 00:00:00","Pending","BMS660F9B604E75D","martis@yahoo.com","09123123123","skjdfbajskd","","","","","");
INSERT INTO tbldocument VALUES("25","malkit","asjdbasd","asyd21","2024-04-19","Cash","","asjbdfuqs`","Barangay Clearance","2024-04-05 00:00:00","Pending","BMS660F9B80591E9","nasda@jsdsad","sdjbasd","idq3rn","","","","","");
INSERT INTO tbldocument VALUES("26","test","test","test","2024-04-19","Cash","","test","Certificate of Indigency","2024-04-05 00:00:00","Pending","BMS660F9CCEDC5FD","test@yahoo","0912312","ajbsdjasd","","","","","");
INSERT INTO tbldocument VALUES("27","testing","testing","testing","2024-04-17","Cash","","amlblds","Business Permit","2024-04-05 00:00:00","Pending","BMS660FA0B5165C3","testing@yahoo","23423413","asjldfaslkd","testing","testing","2024-04-10","testing","testing");
INSERT INTO tbldocument VALUES("28","jkl","jkl","jkl","2024-04-21","Cash","","jkljkl","Barangay Clearance","2024-04-05 00:00:00","Pending","BMS660FA9C49985D","","","","","","","","");
INSERT INTO tbldocument VALUES("29","zxcx","zxc","zxc","2024-04-30","Cash","zxc","zxc","Barangay Clearance","0000-00-00 00:00:00","Ready","BMS660FAFC8C9D57","zxcasd@","zxczxc","zxczxczxc","zxczxczx","czxczxczxc","2024-05-01","zxczxczxc","zczxczxc");
INSERT INTO tbldocument VALUES("30","lance","","lance","2024-04-25","Cash","","lance","Barangay Clearance","2024-04-06 00:00:00","Pending","BMS6611142FDF377","lance@lance","","","","","0000-00-00","","");
INSERT INTO tbldocument VALUES("31","sdsad","asdas","asdasda","2024-05-03","Cash","","asdasd","Business Permit","2024-04-06 00:00:00","Pending","BMS6611173D56BC4","asdasd@asdasd","1234234","asdasd","asdasd","asdasd","2024-04-23","asdasd","asdasd");
INSERT INTO tbldocument VALUES("32","Ralph","asdasdas","Manabat","2024-05-03","Cash","","asdasd","Barangay Clearance","2024-04-11 00:00:00","Pending","BMS66172940069D8","adjnaskd@asdas","0981238","sldmfbaksd","","","","","");
INSERT INTO tbldocument VALUES("33","test`","test","test","2024-04-25","Cash","","test","Barangay Clearance","2024-04-11 00:00:00","Pending","BMS66172A074C67E","test@test","test","test","","","","","");
INSERT INTO tbldocument VALUES("34","test","test","test","2024-04-25","Cash","","tesdt","Certificate of Indigency","2024-04-11 00:00:00","Pending","BMS66172A1F50C21","test@test","test","tesdt","","","","","");



#
# Delete any existing table `tblhousehold`
#

DROP TABLE IF EXISTS `tblhousehold`;


#
# Table structure of table `tblhousehold`
#



CREATE TABLE `tblhousehold` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `house_no` varchar(25) NOT NULL,
  `address` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

INSERT INTO tblhousehold VALUES("4","1001","sample address");
INSERT INTO tblhousehold VALUES("5","2001","sample address");



#
# Delete any existing table `tblofficials`
#

DROP TABLE IF EXISTS `tblofficials`;


#
# Table structure of table `tblofficials`
#



CREATE TABLE `tblofficials` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `chairmanship` varchar(50) DEFAULT NULL,
  `position` varchar(50) DEFAULT NULL,
  `termstart` date DEFAULT NULL,
  `termend` date DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;

INSERT INTO tblofficials VALUES("14","Cedric Kelly","12","4","2023-03-27","2027-07-08","Active");



#
# Delete any existing table `tblpayments`
#

DROP TABLE IF EXISTS `tblpayments`;


#
# Table structure of table `tblpayments`
#



CREATE TABLE `tblpayments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `details` varchar(100) DEFAULT NULL,
  `amounts` decimal(10,2) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `user` varchar(50) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;




#
# Delete any existing table `tblpermit`
#

DROP TABLE IF EXISTS `tblpermit`;


#
# Table structure of table `tblpermit`
#



CREATE TABLE `tblpermit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(80) DEFAULT NULL,
  `owner1` varchar(200) DEFAULT NULL,
  `owner2` varchar(80) DEFAULT NULL,
  `nature` varchar(220) DEFAULT NULL,
  `applied` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

INSERT INTO tblpermit VALUES("6","sdsad","asd","sdas","sadsd","2024-03-06");
INSERT INTO tblpermit VALUES("7","Kargada","Tizon","","Water","2024-04-04");



#
# Delete any existing table `tblposition`
#

DROP TABLE IF EXISTS `tblposition`;


#
# Table structure of table `tblposition`
#



CREATE TABLE `tblposition` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `position` varchar(50) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4;

INSERT INTO tblposition VALUES("4","Captain","1");
INSERT INTO tblposition VALUES("7","Councilor 1","2");
INSERT INTO tblposition VALUES("8","Councilor 2","3");
INSERT INTO tblposition VALUES("9","Councilor 3","4");
INSERT INTO tblposition VALUES("10","Councilor 4","5");
INSERT INTO tblposition VALUES("11","Councilor 5","6");
INSERT INTO tblposition VALUES("12","Councilor 6","7");
INSERT INTO tblposition VALUES("13","Councilor 7","8");
INSERT INTO tblposition VALUES("14","SK Chairman","9");
INSERT INTO tblposition VALUES("15","Secretary","10");
INSERT INTO tblposition VALUES("16","Treasurer","11");



#
# Delete any existing table `tblprecinct`
#

DROP TABLE IF EXISTS `tblprecinct`;


#
# Table structure of table `tblprecinct`
#



CREATE TABLE `tblprecinct` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `precinct` varchar(100) DEFAULT NULL,
  `details` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;




#
# Delete any existing table `tblpurok`
#

DROP TABLE IF EXISTS `tblpurok`;


#
# Table structure of table `tblpurok`
#



CREATE TABLE `tblpurok` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `details` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;

INSERT INTO tblpurok VALUES("13","Purok 1","sample");
INSERT INTO tblpurok VALUES("14","Purok 2","sample 2");



#
# Delete any existing table `tblresident`
#

DROP TABLE IF EXISTS `tblresident`;


#
# Table structure of table `tblresident`
#



CREATE TABLE `tblresident` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `national_id` varchar(100) DEFAULT NULL,
  `citizenship` varchar(50) DEFAULT NULL,
  `picture` text DEFAULT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `middlename` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `alias` varchar(20) DEFAULT NULL,
  `birthplace` varchar(80) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `civilstatus` varchar(20) DEFAULT NULL,
  `gender` varchar(20) DEFAULT NULL,
  `purok` varchar(50) DEFAULT NULL,
  `voterstatus` varchar(20) DEFAULT NULL,
  `household_id` int(11) NOT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `occupation` varchar(100) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `resident_type` int(11) DEFAULT 1,
  `remarks` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=187 DEFAULT CHARSET=utf8mb4;

INSERT INTO tblresident VALUES("183","asd123","asdasd","person.png","asdas","asdas","asdasd","dsds","asdasd","2024-03-13","123","Married","Female","12","Yes","50","123123","rm@yahgoo.com","123123","123123","1","");
INSERT INTO tblresident VALUES("185","21312312","fasdfas","person.png","Ralph","","Manabat","","diyan","2024-03-22","21","Single","Male","11","Yes","10","","","","asdasdasd","1","");
INSERT INTO tblresident VALUES("186","456546","asdasd","person.png","asd","zxc","zxc","12","zxc","2024-04-30","123","","Male","123","","123","","","","asdasd","1","");

