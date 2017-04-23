<?php
$page = "register"; 
include "dbconn.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include("header.html"); ?>
    <link rel="stylesheet" href="css/login.css">
	<title>Register - News Group</title>
</head>

<body>
	<?php include("navbar.php"); ?>
	<div class="wrapper">
	<div class="container form-signin">
	
		<form method="post" action="register.php">
			<h2 class="form-signin-heading">Register</h2>

			<label for="id_username" class="sr-only">Username</label>
			<input type="text" name="username" id="id_username" class="form-control" maxlength="254" placeholder="Username" required autofocus>

			<label for="id_password" class="sr-only">Password</label>
			<input type="password" name="password" id="id_password" class="form-control" placeholder="Password" required>

			<label for="id_confirm_password" class="sr-only">Confirm Password</label>
			<input type="password" name="confirm_password" id="id_confirm_password" class="form-control" placeholder="Confirm Password" required>

			<button class="btn btn-lg btn-primary btn-block" type="submit">Submit</button>

		</form>
	</div>
	</div>
	<?php include("scripts.html"); ?>
</body>

</html>