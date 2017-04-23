<?php
include "dbconn.php";
$page = "home"; 

if( !isset($_SESSION['username']) ){
	$_SESSION['MESSAGE'] = "Please Sign In.";
	$_SESSION['MESSAGE_TYPE'] = "alert-info";
	header("Location: login.php");
	exit();
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
	<div class="container">
		<?php include("message.php"); ?>
		<div class="jumbotron">
			<div class="col-sm-8 mx-auto">
				<h1>Navbar examples</h1>
				<p>This example is a quick exercise to illustrate how the navbar and its contents work. Some navbars extend the width of the viewport, others are confined within a <code>.container</code>. For positioning of navbars, checkout the <a href="../navbar-top/">top</a> and <a href="../navbar-top-fixed/">fixed top</a> examples.</p>
				<p>At the smallest breakpoint, the collapse plugin is used to hide the links and show a menu button to toggle the collapsed content.</p>
				<p>
				<a class="btn btn-primary" href="../../components/navbar/" role="button">View navbar docs &raquo;</a>
				</p>
			</div>
		</div>
	</div>
	<?php include("scripts.html"); ?>
</body>

</html>
