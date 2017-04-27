<?php

function fetchNews($link, $category = null){
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
				callNews($url, $key, $link);
			}
		}
	}
}			


function callNews($url, $category, $link){
	$result = file_get_contents($url);
	$data =  json_decode($result);
	if (count($data->articles)) {
		foreach ($data->articles as $idx => $article) {
			$title = $link->real_escape_string($article->title);
			$result = $link->query("SELECT COUNT(*) as quant FROM news WHERE title = '$title'") or die($link->error);

			$numrow = $result->fetch_assoc()['quant'];
			if($numrow > 0){
				continue;
			}
			$image = $link->real_escape_string($article->urlToImage);
			$timestamp = $link->real_escape_string($article->publishedAt);
			$post = $link->real_escape_string($article->description);                
			$url = $link->real_escape_string($article->url);

			$q = "INSERT INTO news(title, post, link, image, category, `timestamp`) VALUES ('$title', '$post', '$url', '$image', '$category', '$timestamp')";
			$link->query($q) or die($link->error);
		}
	}
}

function getNews($inNewsID=null, $inCategoryID=null)
{
	if (!empty($inNewsID)){
		$query = "SELECT * FROM `news` WHERE `newsID`=" . $inNewsID; 
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

?>