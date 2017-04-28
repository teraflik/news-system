<?php
require('includes/dbconn.php');
$page = "register"; 

if( isset($_SESSION['username']) ){
    header("Location: index.php");
    exit();
}

if (isset($_POST['username'])){
	$username = stripslashes($_POST['username']);
	$username = $link->real_escape_string($username);
	$password = stripslashes($_POST['password']);
	$password = $link->real_escape_string($password);
	$confirmPassword = stripslashes($_POST['confirm_password']);
	$confirmPassword = $link->real_escape_string($confirmPassword);
	if($password != $confirmPassword){
		$_SESSION['MESSAGE'] = "Passwords do not match!";
		$_SESSION['MESSAGE_TYPE'] = "alert-warning";
	}
	else{
		$query = "INSERT into `user` (`username`, `password`) VALUES ('$username', '$password')";
		if( $link->query($query) ){
			$_SESSION['MESSAGE'] = "Successfully Registered! Now login here!";
			$_SESSION['MESSAGE_TYPE'] = "alert-success";
			header("Location: login.php");
			exit();
 		}
		else{
			$_SESSION['MESSAGE'] = "Error: ".$link->error." !";
			$_SESSION['MESSAGE_TYPE'] = "alert-danger";
		}
	}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<?php include("includes/header.html"); ?>
    <link rel="stylesheet" href="css/login.css">
	<title>Register - News Group</title>
</head>

<body>
	<?php include("includes/navbar.php"); ?>
	<div class="wrapper">
		<div class="container form-signin">
			<?php include("includes/message.php"); ?>

			<form method="post" action="register.php">
				<h2 class="form-signin-heading text-white">Register</h2>

				<label for="id_username" class="sr-only">Username</label>
				<input type="text" name="username" id="id_username" class="form-control" maxlength="254" placeholder="Username" required autofocus>

				<label for="id_password" class="sr-only">Password</label>
				<input type="password" name="password" id="id_password" class="form-control" placeholder="Password" required>

				<label for="id_confirm_password" class="sr-only">Confirm Password</label>
				<input type="password" name="confirm_password" id="id_confirm_password" class="form-control" placeholder="Confirm Password" required>

				<button class="btn btn-lg btn-primary btn-block" type="submit">Submit</button>
			</form>
			<div align="right"><a href="login.php">Already have an account? Login Here</a></div>
		</div>

	</div>
	<?php include("includes/scripts.html"); ?>
</body>

</html>