<?php
require('includes/dbconn.php');
include "includes/functions.php";
//getNews($link);
$page = "home"; 

$result = file_get_contents("https://newsapi.org/v1/articles?source=the-times-of-india&sortBy=top&apiKey=892ae8c57aea43208cc1042d8d44b72d");


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
		<div class="">
		<?php
		 $result = $link->query('SELECT `newsID`, `title`, `post`, `link`, `image`, `category`, `timestamp` FROM `news` ORDER BY `timestamp` DESC') or die($link->error);
		while($row = $result->fetch_assoc()){
			echo '<div class="col-sm-8 mx-auto newsclass">';
				echo '<h1><a href="'.$row['link'].'">'.$row['title'].'</a></h1>';
				echo '<img class="img-responsive img-rounded imgclass" src="'.$row['image'].'" />';
				echo '<div class="pull-right post"><p>Posted on '.date('jS M Y H:i', strtotime($row['timestamp'])).'</p></div>';
				echo '<div class="post-left"><p>#'.$row['category'].'</p></div>';
				
				echo '<p>'.$row['post'].'</p>';                
				echo '<p><a class="btn btn-primary" role="button" href="'.$row['link'].'">Read More</a></p>';
			echo '</div>';
		}

		?>
		</div>
	</div>
	<?php include("includes/scripts.html"); ?>
</body>

</html>
