<?php
require('includes/dbconn.php');
$page = "favourites";

if( !isset($_SESSION['username']) ){
	$_SESSION['MESSAGE'] = "Please Sign In.";
	$_SESSION['MESSAGE_TYPE'] = "alert-info";
	header("Location: login.php");
	exit();
}
$userID = $_SESSION['userID'];

if (isset($_POST['newsid']) ){
	$newsID = $_POST['newsid'];
	$action = $_POST['action'];
	if($action == "add"){
		$q = "INSERT INTO favourite VALUES ($userID, $newsID)";
	}
	else if($action == "remove"){
		$q = "DELETE FROM favourite WHERE userID=$userID AND newsID=$newsID";
	}
	$link->query($q) or die($link->error);
}
else{
	$result = $link->query("SELECT n.`newsID`, n.`title`, n.`post`, n.`link`, n.`image`, n.`category`, n.`timestamp` FROM `news` as n WHERE n.`newsID` IN (SELECT `favourite`.`newsID` FROM `favourite` WHERE `favourite`.`userID` = $userID") or die($link->error);
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
					echo '<button class="btn btn-outline-primary btn-sm href="'.$row['link'].'">Read More</a>';
					echo '<button class="btn btn-outline-danger btn-sm favourite" data-newsid="'.$row['newsID'].'"><i class="fa fa-star-o"></i></a>';
					echo '<button class="btn btn-outline-success btn-sm" href="#"><i class="fa fa-share-alt"></i></a>';
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
