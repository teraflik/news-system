<?php

function getNews($link, $category = null){
	$s = array("india" => array("the-times-of-india", "the-hindu"),
			"world"  => array("bbc-news"),
			"sports" => array("espn"),
			"technology" => array("techradar"),
			"entertainment" => array("buzzfeed")
			);

	if(empty($category)){
		foreach($s as $key =>$src){
			foreach($src as $id){
				$url = "https://newsapi.org/v1/articles?source=".$id."&sortBy=top&apiKey=892ae8c57aea43208cc1042d8d44b72d";
				//echo $url."<br>";
				callNews($url, $key, $link);
			}
		}
	}
}			


function callNews($url, $category, $link){
/*	session_start();
	define('DB_SERVER','localhost');
	define('DB_USER','root');
	define('DB_PASS','');
	define('DB_NAME','news');
	$link = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
*/
	$result = file_get_contents($url);
	$data =  json_decode($result);
	if (count($data->articles)) {
		foreach ($data->articles as $idx => $stand) {
			$title = $link->real_escape_string($stand->title);
			$result = $link->query("SELECT COUNT(*) as quant FROM news WHERE title = '$title'") or die($link->error);
			
			//echo $title."<br>";
			$numrow = $result->fetch_assoc()['quant'];
			if($numrow > 0){
				//echo $numrow.'W<br>';
				continue;
			}
			$image = $link->real_escape_string($stand->urlToImage);
			$publishedAt = $link->real_escape_string($stand->publishedAt);
			$post = $link->real_escape_string($stand->description);                
			$url = $link->real_escape_string($stand->url);

			while ($link->next_result()) {;}
			$q = "INSERT INTO news(title, post, link, image, category, `timestamp`) VALUES ('$title', '$post', '$url', '$image', '$category', '$publishedAt')";
			$link->query($q) or die($link->error);

		}
	}
}
/*
function getNews($inNewsID=null, $inCategoryID=null)
{
	if (!empty($inNewsID)){
		$query = "SELECT * FROM `news` WHERE `newsID`=" . $inNewsID"; 
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
	$link->query($conn,$sql);
	$sql2 = "SELECT Average,n FROM res where res_ID=$resid";
	$res = $link->query($conn,$sql2);
	if($link->query($conn, $sql)){
	  echo "Selected.";
	}
	else{ 
	  echo "ERROR: Could not able to execute $sql. " . $link->error($conn);
	}
	$result=$link->fetch_array($res);
	$n = $result['n'];
	$average = ($result['Average']*$n + $rating) / ($n+1);
	$n = $n+1;
	$sql = "UPDATE res SET Average=$average, n=$n where res_ID = $resid";
	$link->query($conn,$sql);
}
*/
?>