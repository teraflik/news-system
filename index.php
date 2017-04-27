<?php
require('includes/dbconn.php');
include "includes/functions.php";
//getNews($link);
$page = "home"; 

if( !isset($_SESSION['username']) ){
	$_SESSION['MESSAGE'] = "Please Sign In.";
	$_SESSION['MESSAGE_TYPE'] = "alert-info";
	header("Location: login.php");
	exit();
}
$result = $link->query('SELECT `newsID`, `title`, `post`, `link`, `image`, `category`, `timestamp` FROM `news` ORDER BY `timestamp` DESC') or die($link->error);
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
	<div class="row">
	<div class="col-sm-2">
	</div>
	<div class="col-sm-10">
		<?php include("includes/message.php"); ?>
		<div class="card-columns">
		<?php
		while($row = $result->fetch_assoc()){
			echo '<div class="card">';
				echo '<div class="card-header">';
					echo '<small class="text-muted">'.ucfirst($row['category']).'</small>';
				echo '</div>';
				echo '<img class="card-img-top img-fluid" src="'.$row['image'].'" />';
				echo '<div class="card-block">';
					echo '<h4 class="card-title"><a href="view.php?id='.$row['newsID'].'">'.$row['title'].'</a></h4>';
					echo '<p class="card-subtitle mb-2 text-muted">Posted on '.date('jS M Y H:i', strtotime($row['timestamp'])).'</p>';
					echo '<p class="card-text">'.$row['post'].'</p>';
				echo '</div>';
				echo '<div class="card-block text-right">';
					echo '<div class="btn-group" role="group">';
					echo '<a class="btn btn-outline-primary btn-sm" href="'.$row['link'].'">Read More</a>';
					echo '<a class="btn btn-outline-danger btn-sm" href="'.$row['link'].'"><i class="fa fa-star-o"></i></a>';
					echo '<a class="btn btn-outline-success btn-sm" href="#"><i class="fa fa-share-alt"></i></a>';
					echo '</div>';
				echo '</div>';
			echo '</div>';
		}
		?>
		</div>
	</div>
	<?php include("includes/scripts.html"); ?>
</body>

</html>
