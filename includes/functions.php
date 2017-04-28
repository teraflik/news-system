<?php
ini_set('max_execution_time', 300);
function fetchNews($link, $category = null){
	$s =
	array("india" => array("the-hindu"),
			"world"  => array("bbc-news","associated-press"),
			"sports" => array("espn","espn-cric-info"),
			"technology" => array("techradar","hacker-news"),
			"entertainment" => array("buzzfeed","entertainment-weekly"),
			"business" => array("cnbc","the-economist"),
			"politics" => array("breitbart-news"),
			"gaming" => array("ign","polygon"),
			"music" => array("mtv-news"),
			"science" => array("national-geographic"),
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
?>