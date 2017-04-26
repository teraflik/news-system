<?php

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