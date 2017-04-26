<?php

function getnews(){
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	$query = array(
	"api-key" => "a2583d58b1ea4171a59955cbbf33dc77"
	);
	curl_setopt($curl, CURLOPT_URL,
	"https://api.nytimes.com/svc/topstories/v2/home.json" . "?" . http_build_query($query)
	);
	$result = json_decode(curl_exec($curl));
	$json_string = json_encode(json_encode($result), JSON_PRETTY_PRINT);
	return $json_string;
}

function GetBlogPosts($inNewsID=null, $inCategoryID=null)
{
	if (!empty($inNewsID)){
		$query = "SELECT * FROM `news` WHERE `newsID`=" . $inNewsID . " ORDER BY `timestamp` DESC"; 
	}
	else if (!empty($inCategoryID)){
		$query = "SELECT `news`.* FROM `newsCategory` LEFT JOIN (`news`) ON (newsCategory.`newsID` = news.`newsID`) WHERE newsCategory.`categoryID` =" . $inCategoryID . " ORDER BY `news`.`timestamp` DESC";
	}
	else {
		$query = "SELECT * FROM `news` ORDER BY `timestamp` DESC";
	}
	$result = $link->query($query) or die($link->error());

	$newsArray = array();
	while ($row = $result->fetch_assoc() )
	{
		$myPost = new News($row["id"], $row['title'], $row['post'], $row["author_id"], $row['dateposted']);
		array_push($postArray, $myPost);
	}
	return $postArray;
}

function insert_rating($conn,$resid,$rating){
	
	$currdate = date('d-m-Y');
	$sql="INSERT INTO ratings(res_id,rating_val,rating_date)values($resid,$rating,NOW())";
	mysqli_query($conn,$sql);
	$sql2 = "SELECT Average,n FROM res where res_ID=$resid";
	$res = mysqli_query($conn,$sql2);
	if(mysqli_query($conn, $sql)){
	  echo "Selected.";
	}
	else{ 
	  echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
	}
	$result=mysqli_fetch_array($res);
	$n = $result['n'];
	$average = ($result['Average']*$n + $rating) / ($n+1);
	$n = $n+1;
	$sql = "UPDATE res SET Average=$average, n=$n where res_ID = $resid";
	mysqli_query($conn,$sql);
}

?>