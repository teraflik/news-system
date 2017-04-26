<?php

class News
{
	public $id;
	public $title;
	public $post;
	public $categories;
	public $timestamp;
	public $comments;

	function __construct($inId=null, $inTitle=null, $inPost=null, $inAuthorId=null, $inDatePosted=null)
	{
		if (!empty($inId)){
			$this->id = $inId;
		}
		if (!empty($inTitle)){
			$this->title = $inTitle;
		}
		if (!empty($inPost)){
			$this->post = $inPost;
		}
		if (!empty($inDatePosted)){
			$this->timestamp = date('jS M Y H:i:s', strtotime($inDatePosted));
		}

		$postCategories = "No Categories";
		if (!empty($inId)) {
			$result = $link->query("SELECT category.* FROM `newsCategory` LEFT JOIN (category) ON (`newsCategory`.`categoryID` = `category`.`categoryID`) WHERE `newsCategory`.`newsID` = " . $inId);
			$categoryArray = array();
			$categoryIDArray = array();
			while($row = $result->fetch_assoc()) {
				array_push($categoryArray, $row["name"]);
				array_push($categoryIDArray, $row["categoryID"]);
			}
			if (sizeof($categoryArray) > 0)	{
				foreach ($categoryArray as $category) {
					if ($postCategories == "No Categories"){
						$postCategories = $category;
					}
					else {
						$postCategories .= ", " . $category;
					}
				}
			}
		}
		$this->categories = $postCategories;

		$comments = "No comments";
		if(!empty($inID)){
			$result = $link->query("SELECT `user`.`username`,`comment`.`comment` FROM `comment`, `user` WHERE `comment`.`newsID` = " . $inId);
			$userArray = array();
			$commentArray = array();
			while($row = $result->fetch_assoc()) {
				array_push($userArray, $row["user.username"]);
				array_push($commentArray, $row["comment.comment"]);
			}
			if (sizeof($commentArray) > 0)	{
				foreach ($categoryArray as $category) {
					if ($postCategories == "No Categories"){
						$postCategories = $category;
					}
					else {
						$postCategories .= ", " . $category;
					}
				}
			}

		}
	}
 }
?>