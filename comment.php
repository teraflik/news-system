<?php
require('includes/dbconn.php');
ini_set('max_execution_time', 300);
if (isset($_GET['id']) and isset($_POST['comment']) ){
	$newsID = $_GET['id'];
	$userID = $_SESSION['userID'];
	$username = $_SESSION['username']; 
	$comment = stripslashes($_POST['comment']);
	$comment = $link->real_escape_string($comment);
	$link->query("INSERT into `comment` (`userID`, `newsID`, `comment`) VALUES ($userID, $newsID, '$comment')") or die($link->error);
	$a = $link->query("SELECT `timestamp` FROM comment WHERE newsID = $newsID and userID = $userID");
	$time = $a->fetch_assoc()['timestamp'];

	echo'
	<div class="list-group-item list-group-item-action flex-column align-items-start">
		<div class="d-flex w-100 justify-content-between">
			<h5 class="mb-1">'.$username.'</h5>
			<small>'.date('jS M Y H:i', strtotime($time)).'</small>
		</div>
		<p class="mb-1">'.$comment.'</p>
	</div>';
}
else{
	header("HTTP/1.0 404 Not Found");
	echo "Error!\n";
	die();
}
?>