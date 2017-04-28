<?php
require('includes/dbconn.php');
$page = "view";

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
	$comments = $link->query('SELECT user.`username`, comment.`comment`, comment.`timestamp` FROM user, comment JOIN news ON news.`newsID` = comment.`newsID` WHERE news.newsID ='.$newsID) or die($link->error);
}

if($found){
echo '
<div class="modal-dialog modal-lg" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title">'.$row['title'].'</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<div class="modal-body">
			<div class="container-fluid">
				<div class="row">
					<div class="col-7">
						<img class="img-fluid" src="'.$row['image'].'" height="400"/>
						<div class=""><p>Posted on '.date('jS M Y H:i', strtotime($row['timestamp'])).'</p></div>
						<div class=""><p>'.$row['category'].'</p></div>
						<p>'.$row['post'].'</p>
					</div>
					<div class="col-5">
						<h3> Comments </h3>';
						if($comments->num_rows){
							while($comment = $comments->fetch_assoc()){
								echo '<p><b>'.$comment['username'].'</b>: '.$comment['comment'].'</p>';
							}
						}
						else{
							echo 'No Comments!';
						}
	echo'					<form class="form-inline" method="post" action="view.php">
							<div class="input-group">
								
								<textarea name="comment" class="form-control" placeholder="Say something..."></textarea>
								<button type="submit" class="btn btn-primary">Submit</button>

							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			<a class="btn btn-primary" target="_blank" role="button" href="'.$row['link'].'">Read More</a>
		</div>
	</div>
</div>';
}
?>


