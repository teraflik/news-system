<?php
require('includes/dbconn.php');
$page = "login";

if( isset($_SESSION['username']) ){
    header("Location: index.php");
    exit();
}

if ( isset($_POST['username']) ){
    $username = stripslashes($_POST['username']);
    $username = $link->real_escape_string($username);
    $password = stripslashes($_POST['password']);
    $password = $link->real_escape_string($password);
    $query = "SELECT * FROM `user` WHERE `username`='$username' and `password`='$password'";
    $result = $link->query($query) or die($link->error());
    $rows = $result->num_rows;
    $some = $result->fetch_assoc();
    if($rows == 1){
        $_SESSION['username'] = $username;
        $_SESSION['userID'] = $some['userID'];
        header("Location: index.php");
        exit();
    }
    else{
        $_SESSION['MESSAGE'] = "Invalid Username or Password!";
        $_SESSION['MESSAGE_TYPE'] = "alert-danger";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include("includes/header.html"); ?>
    <link rel="stylesheet" href="css/login.css">
    <title>News Group</title>
</head>

<body>
    <?php include("includes/navbar.php"); ?>
    <div class="wrapper">
        <div class="container form-signin">
            <?php include("includes/message.php"); ?>
            <form method="post" action="login.php">
                <h2 class="form-signin-heading text-white">Sign In</h2>

                <label for="id_username" class="sr-only">Username</label>
                <input type="text" name="username" id="id_username" class="form-control" maxlength="254" placeholder="Username" required autofocus>

                <label for="id_password" class="sr-only">Password</label>
                <input type="password" name="password" id="id_password" class="form-control" placeholder="Password" required>

                <button class="btn btn-lg btn-primary btn-block" type="submit">Submit</button>
            </form>
            <div align="right"><a href="register.php">New User? Register Here</a></div>
        </div>
    </div>
    <?php include("includes/scripts.html"); ?>
</body>

</html>