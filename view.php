<?php
require('includes/dbconn.php');
include "includes/functions.php";
$page = "view";

if( !isset($_SESSION['username']) ){
	$_SESSION['MESSAGE'] = "Please Sign In.";
	$_SESSION['MESSAGE_TYPE'] = "alert-info";
	header("Location: login.php");
	exit();
}
if ( isset($_GET['id']) ){
	$newsID = $_GET['id'];
	$result = $link->query('SELECT `newsID`, `title`, `post`, `link`, `image`, `category`, `timestamp` FROM `news` WHERE `newsID`='.$newsID) or die($link->error);
	$found = 1;
	if($result->num_rows == 0){
		$_SESSION['MESSAGE'] = "Error! Item does not exist!";
		$_SESSION['MESSAGE_TYPE'] = "alert-warning";
		$found = 0;
	}
	$row = $result->fetch_assoc();
}
else{
	header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<?php include("includes/header.html"); ?>
	<title>News Group</title>
</head>

<body>
	<?php include("includes/navbar.php"); ?>    
	<div class="container">
		<?php include("includes/message.php"); ?>
		<?php
		if($found){
			echo '<div class="row">';
				echo '<div class="col">';
					echo '<h2>'.$row['title'].'</h2>';
					echo '<img class="img-fluid mx-auto d-block" src="'.$row['image'].'" height="400"/>';
					echo '<div class=""><p>Posted on '.date('jS M Y H:i', strtotime($row['timestamp'])).'</p></div>';
					echo '<div class=""><p>#'.$row['category'].'</p></div>';            
					echo '<p>'.$row['post'].'</p>';                
					echo '<p><a class="btn btn-primary" role="button" href="'.$row['link'].'">Read More</a></p>';
				echo '</div>';
			echo '</div>';
		}
		?>
	</div>
	<?php include("includes/scripts.html"); ?>
</body>

</html>
