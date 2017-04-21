<?php
function showres($conn){
	$Per_Page=1;
	$sql="SELECT COUNT(*) AS Total FROM res WHERE category='C'";
	$sql_result=mysqli_query($conn, $sql);
	$result_array=mysqli_fetch_array($sql_result);
	$Total=$result_array['Total'];
	// 	Create a new SELECT Query with the
	// 	ORDER BY clause and without the COUNT(*)
	$sql="Select * FROM res WHERE category='C' order by res_id";
	
	// 	Append a LIMIT clause to the sql statement
	if(empty($_GET['Result_Set'])) {
		$Result_Set=0;
		$sql.=" LIMIT $Result_Set, $Per_Page";
	}
	
	else
	{
		$Result_Set=$_GET['Result_Set'];
		$sql.=" LIMIT $Result_Set, $Per_Page";
	}
	
	// 	Run The Query With a Limit to get result
	$sql_result=mysqli_query($conn, $sql);
	$sql_rows=mysqli_num_rows($sql_result);
	
	// 	Display Results using a for loop
	for ($a=0; $a < $sql_rows; $a++) {
		$sql_array=mysqli_fetch_array($sql_result);
		$rID=$sql_array['res_ID'];
		$descr=$sql_array['description'];
		$res_name=$sql_array['res_name'];
		echo '<table border="0">';
		echo '<tr>';
		echo '<td><b>'.$res_name.'</b><br><br><i>'.$descr.'</i></td>';
		echo '</tr>';
		echo '</table>';
	}
	
	echo "<br>";
	
	// 	Create Next / Prev Links and $Result_Set Value
	if($Total>0)
	{
		
		if($Result_Set<$Total&& $Result_Set>0) {
			$Res1=$Result_Set-$Per_Page;
			echo '<A HREF="' .$_SERVER['PHP_SELF']. '?Result_Set='.$Res1.'"><< Previous Res</A> ';
		}
		
		// Calculate and Display Page # Links
		$Pages=$Total / $Per_Page;
		
		if ($Pages>1) {
			for ($b=0,$c=1; $b < $Pages; $b++,$c++) {
				$Res1=$Per_Page * $b;
				//echo '<A HREF="' .$_SERVER['PHP_SELF']. '?Result_Set='.$Res1.'"> '.$c.'</A> ';
			}
			
		}
		
		if ($Result_Set>=0 && $Result_Set<$Total) {
			$Res1=$Result_Set+$Per_Page;
			if ($Res1<$Total) {	
				echo '<A HREF="' .$_SERVER['PHP_SELF']. '?Result_Set='.$Res1.'"> Next Res >></A>';	
			}	
		}
	}
	
	return $rID;
	
}


function showbox($aID){
echo '<form id="form1" name="form1" method="post" action="' .$_SERVER['PHP_SELF']. '">
<table width="90%" border="0">
  <tr>
    <td bgcolor="#CCCCCC">Please select a rating </td>
  </tr>
  <tr>
    <td><label>
      <input name="radiobutton" type="radio" value="5" />
      5 - Excellent</label></td>
  </tr>
  <tr>
    <td><label>
      <input name="radiobutton" type="radio" value="4" />
      4 - 
      Very Good</label></td>
  </tr>
  <tr>
    <td>
      <input name="radiobutton" type="radio" value="3" />
      3 - Good</td>
  </tr>
  <tr>
    <td><label>
      <input name="radiobutton" type="radio" value="2" />
      2 - Between Good and Bad</label></td>
  </tr>
  <tr>
    <td><label>
      <input name="radiobutton" type="radio" value="1" />
      1 - Bad</label></td>
  </tr>
  <tr>
    <td><label>
      <input type="submit" name="submit" value="submit" />
      <input type="hidden" name="id" value="'.$aID.'" />
    </label></td>
  </tr>
</table>
</form>';
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

function insert_res_details($res_name,$description){
	
	$sql="INSERT INTO res(res_name,description)values($res_name,$description)";
	mysql_query($sql);
	
}

function rankings($conn, $cat){
	
	$sql="SELECT res_name, category, description, Average FROM res WHERE category='$cat' ORDER BY Average DESC";
	$res=mysqli_query($conn, $sql);
	$i=0;
	$color=array('Red',"Light-Blue","Green",'Purple','Deep-Purple','Indigo',"Blue","Cyan","Teal","Light-Green","Lime","Yellow","Amber","Orange","Deep-Orange","Brown","Blue-Grey",'Pink');
	if($res){
		
		while($row=mysqli_fetch_array($res)){	
			if($i%2==0){$ch="c.png";}
			else{ $ch = "c1.png";}
			if($cat == 'Java'){$ch="java.png";}
			if($cat == 'Python'){$ch="python.png";}
			echo '<div class="col-md-4 col-sm-6 col-xs-12">
			<article class="material-card '.$color[$i].'">
			<h2><span>'.$row['res_name'].'</span><strong>
                        <i class="fa fa-fw fa-star"></i>'.$cat.' Programming</strong></h2> 
				<div class="mc-content">
				 <div class="img-container">
				 <img class="img-responsive" src="media/'.$ch.'">
				 </div><div class="mc-description">'.$row['description'].'<br><br><h4>Links:</h4><h3><a class="fa fa-fw fa-youtube"></a> <a class="fa fa-fw fa-globe"></a></h3></h4></div></div>
                <a class="mc-btn-action">
                    <i class="fa fa-bars"></i>
                </a>
                <div class="mc-footer">
                    <h4>
                    </h4>
                    <h3>Rating: '.$row['Average'].'/5</h3>
                </div>
            </article>
        </div> 
				<!--<span class="rating">'.$row['Average'].'</span> </div>-->';
				$i = $i+1;
		}	
		
	}	
}

?>