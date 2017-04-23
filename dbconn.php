<?php
$DB_SERVER = "localhost";
$DB_USER = "root";
$DB_PASS = "G0ne9128";
$DB_NAME = "news";

// Connect to MySQL
$link = mysqli_connect($DB_SERVER, $DB_USER, $DB_PASS);
if (mysqli_connect_errno()) {
	printf("Connect failed: %s\n", mysqli_connect_error());
	exit();
}

$db_selected = mysqli_select_db($link, $DB_NAME);

if ($db_selected){
	$_SESSION['Message'] = "<strong>Message: </strong>Database Selected!";
}
else{
	$sql = 'CREATE DATABASE '.$DB_NAME;
	if (!mysqli_query($link, $sql)) {
		$_SESSION['Message'] = "<strong>Error: </strong>".mysqli_error($link);
	}
	else{
		$_SESSION['Message'] = "<strong>Message: </strong>Database Created!";
	}
}

$tables = 
"
CREATE TABLE IF NOT EXISTS `news` (
`newsID` INT(5) PRIMARY KEY,
`news` TEXT NOT NULL
);
CREATE TABLE IF NOT EXISTS `user` (
`userID` INT(5) PRIMARY KEY,
`username` VARCHAR(255) NOT NULL,
`password` VARCHAR(50) NOT NULL
); 
CREATE TABLE IF NOT EXISTS `rating` (
`userID` INT(5),
`newsID` CHAR(5),
`rating` TINYINT(4),
`timestamp` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
PRIMARY KEY  ('userID','newsID')
);
CREATE TABLE IF NOT EXISTS `favourite` (
`userID` INT(5),
`newsID` CHAR(5),
PRIMARY KEY  ('userID','newsID')
);
";

if (!mysqli_multi_query($link, $tables)) {
	$_SESSION['Message'] .= "<br><strong>Error: </strong>".mysqli_error($link);
}
else{
	$_SESSION['Message'] .= "<br><strong>Message: </strong>Tables Created!";
}
?>