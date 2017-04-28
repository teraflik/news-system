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
	<div class="col-sm-0">
	</div>
	<div class="col-sm-12 divclass">
		<?php include("includes/message.php"); ?>
		
		<?php
		$i = 1;
		while($row = $result->fetch_assoc()){
			if($i%3==1) {
				echo '<div class="card-deck">';
			}
			echo '<div class="card card-inverse">';
				echo '<div class="card-header news-category">';
					echo '<small class="catclass">#'.ucfirst($row['category']).'</small>';
				echo '</div>';
				echo '<img class="card-img-top img-fluid card-imgclass" src="'.$row['image'].'" />';
				echo '<div class="card-block">';
					echo '<h4 class="card-title"><a href="#" class="modal-toggle" data-toggle="modal" data-target="#newsModal" data-id="'.$row['newsID'].'">'.$row['title'].'</a></h4>';
					echo '<small class="card-subtitle mb-2 text-muted text-right">'.date('jS M Y H:i', strtotime($row['timestamp'])).'</small>';
					echo '<p class="card-text">'.$row['post'].'</p>';
				echo '</div>';
				echo '<div class="card-footer text-right">';
					echo '<div class="btn-group" role="group">';
					echo '<a class="btn btn-outline-primary btn-sm aclass" href="'.$row['link'].'">Read More</a>';
					echo '<a class="btn btn-outline-danger btn-sm" href="'.$row['link'].'"><i class="fa fa-star-o"></i></a>';
					echo '<a class="btn btn-outline-success btn-sm" href="#"><i class="fa fa-share-alt"></i></a>';
					echo '</div>';
				echo '</div>';
			echo '</div>';
			if($i%3==0) {
				echo '</div><br>';
			}
			$i++;
		}
		?>
		
	</div>
	<?php include("includes/scripts.html"); ?>
</body>

</html>
