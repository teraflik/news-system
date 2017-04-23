<?php
$page = "login"; 
include "dbconn.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include("header.html"); ?>
    <link rel="stylesheet" href="css/login.css">
	<title>News Group</title>
</head>

<body>
	<?php include("navbar.php"); ?>
    <div class="wrapper">
	<div class="container form-signin">
		<div class="alert alert-danger" role="alert">
	        Your username and password didn't match. Please try again.
		</div>
	
        <form method="post" action="login.php">
            <h2 class="form-signin-heading">Sign In</h2>

            <label for="id_username" class="sr-only">Username</label>
            <input type="text" name="username" id="id_username" class="form-control" maxlength="254" placeholder="Username" required autofocus>

            <label for="id_password" class="sr-only">Password</label>
            <input type="password" name="password" id="id_password" class="form-control" placeholder="Password" required>

            <button class="btn btn-lg btn-primary btn-block" type="submit">Submit</button>
        </form>

    </div>
    </div>
	<?php include("scripts.html"); ?>
</body>

</html>