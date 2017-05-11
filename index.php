<?php
require('includes/dbconn.php');
include "includes/functions.php";

ini_set('max_execution_time', 300);
$page = "home"; 

if( !isset($_SESSION['username']) ){
	$_SESSION['MESSAGE'] = "Please Sign In.";
	$_SESSION['MESSAGE_TYPE'] = "alert-info";
	header("Location: login.php");
	exit();
}
if(isset($_POST['action'])){
	if($_POST['action'] == "refresh"){
		fetchNews($link);
	}
}
if(isset($_GET['cat'])) {
	$category = $_GET['cat'];
	$q = "SELECT `newsID`, `title`, `post`, `link`, `image`, `category`, `timestamp` FROM `news` WHERE `category` = LCASE('$category') ORDER BY `timestamp` DESC";
}
else{
	$q = 'SELECT `newsID`, `title`, `post`, `link`, `image`, `category`, `timestamp` FROM `news` ORDER BY `timestamp` DESC';
}
$result = $link->query($q) or die($link->error);
$userID = $_SESSION['userID'];
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
	<div class="news">
	<div class="col-sm-0">
	</div>
	<div class="col-sm-12 divclass">
		<?php include("includes/message.php"); ?>
		
		<?php
		$i = 1;
		while(($news = $result->fetch_assoc()) && ($i<37)){
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
						echo '<a href="" class="btn btn-outline-danger btn-sm favourite" data-newsid="'.$news['newsID'].'"><i class="fa fa-star-o"></i> '.$num1.'</a>';						
					} else if($num2 == 1){
						echo '<a href="" class="btn btn-outline-danger btn-sm favourite" data-newsid="'.$news['newsID'].'"><i class="fa fa-star"></i> '.$num1.'</a>';						
					}
					echo '<a class="btn btn-outline-success btn-sm" href="#"><i class="fa fa-comment"> '.$num3.'</i></a>';
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
	<div class="right-corder-container">
    <button class="right-corder-container-button">
        <span class="short-text"><i class="fa fa-refresh" aria-hidden="true"></i></span>
        <span class="long-text">Refresh</span>
    </button>
	</div>
	<div class="footer-gradient"></div>
	<footer class="footer">
      <div class="container footer-div">
      	<span class="text-muted"><a href="index.php">Latest</a></span>
        <span class="text-muted"><a href="index.php?cat=India">India</a></span>
		<span class="text-muted"><a href="index.php?cat=World">World</a></span>
		<span class="text-muted"><a href="index.php?cat=Sports">Sports</a></span>
		<span class="text-muted"><a href="index.php?cat=Technology">Technology</a></span>
		<span class="text-muted"><a href="index.php?cat=Entertainment">Entertainment</a></span>
		<span class="text-muted"><a href="index.php?cat=Business">Business</a></span>
		<span class="text-muted"><a href="index.php?cat=Politics">Politics</a></span>
		<span class="text-muted"><a href="index.php?cat=Gaming">Gaming</a></span>
		<span class="text-muted"><a href="index.php?cat=Music">Music</a></span>
		<span class="text-muted"><a href="index.php?cat=Science">Science</a></span>
      </div>
    </footer>

</body>

</html>
