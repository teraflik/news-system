<?php
require('includes/dbconn.php');
include "includes/functions.php";
$page = "home"; 

$result = file_get_contents("https://api.nytimes.com/svc/topstories/v2/home.json?api-key=a2583d58b1ea4171a59955cbbf33dc77");


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
		 /*$result = $link->query('SELECT `newsID`, `title`, `post`, `timestamp` FROM `news` ORDER BY `newsID` DESC') or die($link->error);
		while($row = $result->fetch_assoc()){
			echo '<div class="col-sm-8 mx-auto">';
				echo '<h1><a href="view.php?id='.$row['newsID'].'">'.$row['title'].'</a></h1>';
				echo '<p>Posted on '.date('jS M Y H:i:s', strtotime($row['timestamp'])).'</p>';
				echo '<p>'.$row['post'].'</p>';                
				echo '<p><a class="btn btn-primary" role="button" href="viewpost.php?id='.$row['newsID'].'">Read More</a></p>';
			echo '</div>';
		}*/
		$data =  json_decode($result);
		if (count($data->results)) {
			// Open the table
			echo '<div class="col-sm-8 mx-auto">';

			// Cycle through the array
			foreach ($data->results as $idx => $stand) {

				// Output a row
				echo '<h1>'.$stand->title.'</h1>';
				echo '<p>Posted on '.$stand->published_date.'</p>';
				echo '<p>'.$stand->abstract.'</p>';                
				//echo '<p><a class="btn btn-primary" role="button" href="viewpost.php?id='.$stand->related_urls.'">Read More</a></p>';
			}

			// Close the table
			echo "</div>";
		}
		?>
		</div>
	</div>
	<?php include("includes/scripts.html"); ?>
</body>

</html>
