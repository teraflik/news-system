<?php
$page = "login";
include "dbconn.php";
if (isset($_POST['username'])){
    $username = stripslashes($_REQUEST['username']);
    $username = $link->real_escape_string($username);
    $password = stripslashes($_REQUEST['password']);
    $password = $link->real_escape_string($password);
    $query = "SELECT * FROM `user` WHERE `username`='$username' and `password`='$password'";
    $result = $link->query($query) or die($link->error());
    $rows = $result->num_rows;
    if($rows == 1){
        session_start();
        $_SESSION['username'] = $username;
        header("Location: index.php");
    }
    else{
        $_SESSION['MESSAGE'] = "Invalid Username or Password";
	    $_SESSION['MESSAGE_TYPE'] = "alert-info";
    }
}
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
        <?php
            echo '<div class="alert '; 
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
            echo '</div>';
        ?>
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