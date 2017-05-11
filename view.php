<?php
require('includes/dbconn.php');
$page = "view";
ini_set('max_execution_time', 300);
if ( isset($_GET['id']) ){
	$newsID = $_GET['id'];
	$userID = $_SESSION['userID'];

	$result = $link->query('SELECT `newsID`, `title`, `post`, `link`, `image`, `category`, `timestamp` FROM `news` WHERE `newsID`='.$newsID) or die($link->error);
	$a = $link->query("SELECT COUNT(*) as quant FROM favourite WHERE newsID = '$newsID'") or die($link->error);
	$num1 = $a->fetch_assoc()['quant'];
	$a = $link->query("SELECT COUNT(*) as quant FROM favourite where newsID='$newsID' && userID = '$userID'") or die($link->error);
	$num2 = $a->fetch_assoc()['quant'];
	$a = $link->query("SELECT COUNT(*) as quant FROM comment WHERE newsID = '$newsID'") or die($link->error);
	$num3 = $a->fetch_assoc()['quant'];
	$found = 1;
	if($result->num_rows == 0){
		$_SESSION['MESSAGE'] = "Error! Item does not exist!";
		$_SESSION['MESSAGE_TYPE'] = "alert-warning";
		$found = 0;
	}
	$news = $result->fetch_assoc();
	$comments = $link->query("SELECT u.`username`, c.`comment`, c.`timestamp` FROM user u, comment c WHERE c.`newsID` = '$newsID' AND u.`userID` = c.`userID` ORDER BY c.`timestamp`") or die($link->error);
}

if($found){
echo '
</script>
<div class="modal-dialog modal-lg" role="document">
	<div class="modal-content">
		<div class="modal-body">
		<div class="row">
			<div class="col-sm-7">';
				echo '<div class="card card-inverse">';
					echo '<div class="card-header news-category">';
						echo '<small class="catclass">#'.ucfirst($news['category']).'</small>';
					echo '</div>';
					echo '<img class="card-img-top img-fluid" src="'.$news['image'].'" />';
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
						echo '<a class="btn btn-outline-success btn-sm" href=""><i class="fa fa-comment" data-newsid="'.$newsID.'"> '.$num3.'</i></a>';
						echo '</div>';
					echo '</div>';
				echo '</div>';
			echo'</div>
			<div class="col-sm-5">
				<button type="button" class="close" id="closebutton" data-dismiss="modal" aria-label="Close">
					<i class="fa fa-times text-white"></i>
				</button>
				<h4>Comments</h4>
				<div class="list-group commentclass" style="width: 430px;">';
				while($comment = $comments->fetch_assoc()){
					echo '<div class="list-group-item list-group-item-action flex-column align-items-start">
							<div class="d-flex w-100 justify-content-between">
								<h5 class="mb-1">'.$comment['username'].'</h5>
								<small>'.date('jS M Y H:i', strtotime($comment['timestamp'])).'</small>
							</div>
							<p class="mb-1">'.$comment['comment'].'</p>
						</div>';
				}
				echo'</div>
				<br><div class="input-group input-block-level style="position: absolute; right: 0; bottom: 0;">
				<input name="comment" id="commentBox" class="input-group-addon" style="width: 396px; text-align:left;" type="text" placeholder="Add comment...">
				<button type="submit" id="submit-comment" data-newsid="'.$newsID.'" class="btn btn-primary input-group-addon">Submit</button>
				</div>
			</div>
		</div>
		</div>
	</div>
</div>
';
}
?>