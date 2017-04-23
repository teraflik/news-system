<?php
$page = "home"; 
include "dbconn.php";

/*if(!isset($_SESSION['username'])){
	$_SESSION['MESSAGE'] = "Please Sign In.";
	$_SESSION['MESSAGE_TYPE'] = "alert-info";
	header("Location: login.php");
}*/
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<?php include("header.html"); ?>
	<title>News Group</title>
</head>

<body>
	<?php include("navbar.php"); ?>	
	<?php
	if (!empty($_SESSION['MESSAGE'])) {
		echo '<div class="container"> <div class="alert '; 
		if (!empty($_SESSION['MESSAGE_TYPE'])) {
			echo $_SESSION['MESSAGE_TYPE'];
			unset($_SESSION['MESSAGE_TYPE']);
		}
		else{
			echo '"alert-warning"';
		}
		echo '" role="alert">';
			if (!empty($_SESSION['MESSAGE'])) {
			echo $_SESSION['MESSAGE'];
			unset($_SESSION['MESSAGE']);
		}
		echo '</div></div>';
	}
	?>

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
