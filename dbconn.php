<?php
$DB_SERVER = "localhost";
$DB_USER = "root";
$DB_PASS = "";
$DB_NAME = "news";
$_SESSION['Message'] = "";
$DEBUG = 0;

/* Connect to MySQL database using above credentials. */
$link = new mysqli($DB_SERVER, $DB_USER, $DB_PASS);
if ($link->connect_errno) {
	printf("Connect failed: %s\n", $link->connect_error);
	exit();
}

if ( $link->select_db($DB_NAME) ){
	$_SESSION['Message'] .= "<strong>Message: </strong>Database Selected!";
}
else{
	$sql = 'CREATE DATABASE '.$DB_NAME;
	if ($link->query($sql) === TRUE) {
		$_SESSION['Message'] .= "<strong>Message: </strong>Database Created!";
	}
	else{
		$_SESSION['Message'] .= "<strong>Error: </strong>".$link->error;
	}
}

$tables = 
"
CREATE TABLE IF NOT EXISTS `news` (
	`newsID` INT(7) PRIMARY KEY,
	`news` TEXT NOT NULL
);
CREATE TABLE IF NOT EXISTS `user` (
	`userID` INT(7) PRIMARY KEY,
	`username` VARCHAR(255) NOT NULL,
	`password` VARCHAR(50) NOT NULL
); 
CREATE TABLE IF NOT EXISTS `comment` (
	`commentID` INT(7),
	`userID` INT(7) NOT NULL,
	`newsID` INT(7) NOT NULL,
	`comment` TEXT NOT NULL,
	FOREIGN KEY (`userID`) REFERENCES `user`(`userID`) ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY (`newsID`) REFERENCES `news`(`newsID`) ON UPDATE CASCADE ON DELETE CASCADE,
	PRIMARY KEY(`commentID`)
);
CREATE TABLE `rating` (
	`userID` INT(7),
	`newsID` INT(7),
	`rating` TINYINT(4),
	`timestamp` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	FOREIGN KEY (`userID`) REFERENCES `user`(`userID`) ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY (`newsID`) REFERENCES `news`(`newsID`) ON UPDATE CASCADE ON DELETE CASCADE,
	PRIMARY KEY  (`userID`,`newsID`)
);
CREATE TABLE IF NOT EXISTS `favourite` (
	`userID` INT(7),
	`newsID` INT(7),
	FOREIGN KEY (`userID`) REFERENCES `user`(`userID`) ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY (`newsID`) REFERENCES `news`(`newsID`) ON UPDATE CASCADE ON DELETE CASCADE,
	PRIMARY KEY  (`userID`,`newsID`)
);
CREATE TABLE IF NOT EXISTS `category` (
	`categoryID` INT(7) PRIMARY KEY,
	`name` CHAR(50)
);
CREATE TABLE IF NOT EXISTS `newsCategory` (
	`newsID` INT(7),
	`categoryID` INT(7),
	FOREIGN KEY (`newsID`) REFERENCES `news`(`newsID`) ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY (`categoryID`) REFERENCES `category`(`categoryID`) ON UPDATE CASCADE ON DELETE CASCADE,
	PRIMARY KEY  (`newsID`,`categoryID`)
);
";

if ($link->multi_query($tables)) {
	$_SESSION['Message'] .= "<br><strong>Message: </strong>Tables Created!";
	while ($link->next_result()) {;}
}
else{
	$_SESSION['Message'] .= "<br><strong>Error: </strong>".mysqli_error($link);
}

?>