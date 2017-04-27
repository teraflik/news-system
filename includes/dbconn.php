<?php
session_start();
define('DB_SERVER','localhost');
define('DB_USER','root');
define('DB_PASS','');
define('DB_NAME','news');
$DEBUG = 0;
$sl = "";
date_default_timezone_set('Asia/Kolkata');

/* Connect to MySQL database using above credentials. */
$link = new mysqli(DB_SERVER, DB_USER, DB_PASS);
if ($link->connect_errno) {
	printf("Connect failed: %s\n", $link->connect_error);
	exit();
}

if ( $link->select_db(DB_NAME) ){
	$sl .= "<strong>Message: </strong>Database Selected!<br>";
}
else{
	$sql = 'CREATE DATABASE '.DB_NAME;
	if ($link->query($sql) === TRUE) {
		$sl .= "<strong>Message: </strong>Database Created!<br>";
		if ( $link->select_db(DB_NAME) ){
			$sl .= "<strong>Message: </strong>Database Selected!<br>";
		}
		else{
			$sl .= "<strong>Error: </strong><br>".$link->error;
		}
	}
	else{
		$sl .= "<strong>Error: </strong><br>".$link->error;
	}
}

$tables = 
"
CREATE TABLE IF NOT EXISTS `news` (
	`newsID` INT(7) AUTO_INCREMENT,
	`title` VARCHAR(255),
	`post` TEXT,
	`link` TEXT,
	`image` TEXT,
	`category` VARCHAR(200),
	`timestamp` DATETIME DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY(`newsID`)
);
CREATE TABLE IF NOT EXISTS `user` (
	`userID` INT(7) AUTO_INCREMENT,
	`username` VARCHAR(255) UNIQUE NOT NULL,
	`password` VARCHAR(50) NOT NULL,
	 PRIMARY KEY(`userID`)
); 
CREATE TABLE IF NOT EXISTS `comment` (
	`commentID` INT(7) AUTO_INCREMENT,
	`userID` INT(7) NOT NULL,
	`newsID` INT(7) NOT NULL,
	`comment` TEXT NOT NULL,
	`timestamp` DATETIME DEFAULT CURRENT_TIMESTAMP,
	FOREIGN KEY (`userID`) REFERENCES `user`(`userID`) ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY (`newsID`) REFERENCES `news`(`newsID`) ON UPDATE CASCADE ON DELETE CASCADE,
	PRIMARY KEY(`commentID`)
);
CREATE TABLE IF NOT EXISTS `favourite` (
	`userID` INT(7),
	`newsID` INT(7),
	FOREIGN KEY (`userID`) REFERENCES `user`(`userID`) ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY (`newsID`) REFERENCES `news`(`newsID`) ON UPDATE CASCADE ON DELETE CASCADE,
	PRIMARY KEY  (`userID`,`newsID`)
);
";

if ($link->multi_query($tables)) {
	$sl .= "<strong>Message: </strong>Tables Created!<br>";
	while ($link->next_result()) {;}
}
else{
	$sl .= "<strong>Error: </strong><br>".mysqli_error($link);
}

?>