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
	$result = $link->query("SELECT n.`newsID`, n.`title`, n.`post`, n.`link`, n.`image`, n.`category`, n.`timestamp` FROM `news` as n WHERE n.`newsID` IN (SELECT `favourite`.`newsID` FROM `favourite` WHERE `favourite`.`userID` = $userID)") or die($link->error);
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
		$nrows = $result->num_rows;
		$drows = $nrows % 3;
		if($nrows == 0) {
			echo '<h1 class="display-1">Seems lonely here!</h1><h1 class="display-4"><a href="index.php" style="text-decoration:none">Add some favourites...</a></h1>';
		}
		while($news = $result->fetch_assoc()){
			if($i%3==1) {
				echo '<div class="card-deck">';
			}
			$newsID = $news['newsID'];
			$a = $link->query("SELECT COUNT(*) as quant FROM favourite WHERE newsID = '$newsID'") or die($link->error);
			$num1 = $a->fetch_assoc()['quant'];
			$a = $link->query("SELECT COUNT(*) as quant FROM favourite where newsID='$newsID' && userID = '$userID'") or die($link->error);
			$num2 = $a->fetch_assoc()['quant'];
			$a = $link->query("SELECT COUNT(*) as quant FROM comment WHERE newsID = '$newsID'") or die($link->error);
			$num3 = $a->fetch_assoc()['quant'];
			echo '<div class="card card-inverse">';
				echo '<div class="card-header news-category">';
					echo '<small class="catclass">#'.ucfirst($news['category']).'</small>';
				echo '</div>';
				echo '<img class="card-img-top img-fluid card-imgclass" src="'.$news['image'].'" />';
				echo '<div class="card-block">';
					echo '<h4 class="card-title"><a href="#" class="modal-toggle" data-toggle="modal" data-target="#newsModal" data-id="'.$news['newsID'].'">'.$news['title'].'</a></h4>';
					echo '<small class="card-subtitle mb-2 text-muted text-right">'.date('jS M Y H:i', strtotime($news['timestamp'])).'</small>';
					echo '<p class="card-text">'.$news['post'].'</p>';
				echo '</div>';
				echo '<div class="card-footer text-right">';
					echo '<div class="btn-group" role="group">';
					echo '<a class="btn btn-outline-primary btn-sm" href="'.$news['link'].'" target="_blank"">Read More</a>';
					if($num2 == 0) {
						echo '<a href="#" class="btn btn-outline-danger btn-sm favourite" data-newsid="'.$news['newsID'].'"><i class="fa fa-star-o"></i> '.$num1.'</a>';						
					} else if($num2 == 1){
						echo '<a href="#" class="btn btn-outline-danger btn-sm favourite" data-newsid="'.$news['newsID'].'"><i class="fa fa-star"></i> '.$num1.'</a>';						
					}
					echo '<a class="btn btn-outline-success btn-sm" href="#"><i class="fa fa-comment"> '.$num3.'</i></a>';
					echo '</div>';
				echo '</div>';
			echo '</div>';
			if($drows == 1) {
				
				if($nrows == ($i)) {
					echo '<div class="card card-inverse">';
				echo '<div class="card-header news-category">';
					echo '<small class="catclass">#Empty</small>';
				echo '</div>';
				echo '<img class="card-img-top img-fluid card-imgclass" src="" />';
				echo '<div class="card-block">';
					echo '<h4 class="card-title"><a href="#" class="modal-toggle" data-toggle="modal" data-target="">Add more favourites!</a></h4>';
					echo '<small class="card-subtitle mb-2 text-muted text-right"></small>';
					echo '<p class="card-text">Add more favourites by clicking that find more below!</p>';
				echo '</div>';
				echo '<div class="card-footer text-right">';
					echo '<div class="btn-group" role="group">';
					echo '<a class="btn btn-outline-primary btn-sm" href="index.php" target="_blank"">Find More</a>';
					if($num2 == 0) {
						echo '<a href="#" class="btn btn-outline-danger btn-sm favourite" data-newsid=""><i class="fa fa-star-o"></i> </a>';						
					} else if($num2 == 1){
						echo '<a href="#" class="btn btn-outline-danger btn-sm favourite" data-newsid=""><i class="fa fa-star"></i></a>';						
					}
					echo '<a class="btn btn-outline-success btn-sm" href="#"><i class="fa fa-comment"></i></a>';
					echo '</div>';
				echo '</div>';
			echo '</div>';
			echo '<div class="card card-inverse">';
				echo '<div class="card-header news-category">';
					echo '<small class="catclass">#Empty</small>';
				echo '</div>';
				echo '<img class="card-img-top img-fluid card-imgclass" src="" />';
				echo '<div class="card-block">';
					echo '<h4 class="card-title"><a href="#" class="modal-toggle" data-toggle="modal" data-target="">Add more favourites!</a></h4>';
					echo '<small class="card-subtitle mb-2 text-muted text-right"></small>';
					echo '<p class="card-text">Add more favourites by clicking that find more below!</p>';
				echo '</div>';
				echo '<div class="card-footer text-right">';
					echo '<div class="btn-group" role="group">';
					echo '<a class="btn btn-outline-primary btn-sm" href="index.php" target="_blank"">Find More</a>';
					if($num2 == 0) {
						echo '<a href="#" class="btn btn-outline-danger btn-sm favourite" data-newsid=""><i class="fa fa-star-o"></i> </a>';						
					} else if($num2 == 1){
						echo '<a href="#" class="btn btn-outline-danger btn-sm favourite" data-newsid=""><i class="fa fa-star"></i></a>';						
					}
					echo '<a class="btn btn-outline-success btn-sm" href="#"><i class="fa fa-comment"></i></a>';
					echo '</div>';
				echo '</div>';
			echo '</div>';
				}
			} else if($drows == 2) {
				if($nrows == ($i)) {
					echo '<div class="card card-inverse">';
				echo '<div class="card-header news-category">';
					echo '<small class="catclass">#Empty</small>';
				echo '</div>';
				echo '<img class="card-img-top img-fluid card-imgclass" src="" />';
				echo '<div class="card-block">';
					echo '<h4 class="card-title"><a href="#" class="modal-toggle" data-toggle="modal" data-target="">Add more favourites!</a></h4>';
					echo '<small class="card-subtitle mb-2 text-muted text-right"></small>';
					echo '<p class="card-text">Add more favourites by clicking that find more below!</p>';
				echo '</div>';
				echo '<div class="card-footer text-right">';
					echo '<div class="btn-group" role="group">';
					echo '<a class="btn btn-outline-primary btn-sm" href="index.php" target="_blank"">Find More</a>';
					if($num2 == 0) {
						echo '<a href="#" class="btn btn-outline-danger btn-sm favourite" data-newsid=""><i class="fa fa-star-o"></i> </a>';						
					} else if($num2 == 1){
						echo '<a href="#" class="btn btn-outline-danger btn-sm favourite" data-newsid=""><i class="fa fa-star"></i></a>';						
					}
					echo '<a class="btn btn-outline-success btn-sm" href="#"><i class="fa fa-comment"></i></a>';
					echo '</div>';
				echo '</div>';
			echo '</div>';

				}
			}
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
