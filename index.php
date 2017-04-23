<?php
$page = "home"; 
include "dbconn.php";

if( !isset($_SESSION['username']) ){
	$_SESSION['MESSAGE'] = "Please Sign In.";
	$_SESSION['MESSAGE_TYPE'] = "alert-info";
	header("Location: login.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<?php include("header.html"); ?>
	<title>News Group</title>
</head>

<body>
	<?php include("navbar.php"); ?>	
	<?php include("message.php"); ?>

	<div class="container-fluid">
		<div class="row">
			<div class="col">
				This here is the Main section.
			</div>
			<div class="col-lg-3">
				This is the sidebar here.
			</div>
		</div>
	</div>
	<?php include("scripts.html"); ?>
</body>

</html>
