<?php
require('includes/dbconn.php');
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
	<?php include("includes/header.html"); ?>
	<title>News Group</title>
</head>

<body>
	<?php include("includes/navbar.php"); ?>    
	<div class="container">
		<?php include("includes/message.php"); ?>
		<div class="jumbotron">
		<?php
		 $result = $link->query('SELECT `newsID`, `title`, `post`, `timestamp` FROM `news` ORDER BY `newsID` DESC') or die($link->error);
		while($row = $result->fetch_assoc()){
			echo '<div class="col-sm-8 mx-auto">';
				echo '<h1><a href="view.php?id='.$row['newsID'].'">'.$row['title'].'</a></h1>';
				echo '<p>Posted on '.date('jS M Y H:i:s', strtotime($row['timestamp'])).'</p>';
				echo '<p>'.$row['post'].'</p>';                
				echo '<p><a class="btn btn-primary" role="button" href="viewpost.php?id='.$row['newsID'].'">Read More</a></p>';                
			echo '</div>';
		}
		?>
		</div>
	</div>
	<?php include("includes/scripts.html"); ?>
</body>

</html>
