<?php 
require('includes/dbconn.php'); 
$page="view";

//if post does not exists redirect user

?>
<!DOCTYPE html>
<html lang="en">
<head>
   
</head>
<body>

    <div id="wrapper">

        <h1>Blog</h1>
        <hr />
        <p><a href="./">Blog Index</a></p>


        <?php    
            echo '<div>';
                echo '<h1>'.$row['postTitle'].'</h1>';
                echo '<p>Posted on '.date('jS M Y', strtotime($row['postDate'])).'</p>';
                echo '<p>'.$row['postCont'].'</p>';                
            echo '</div>';
        ?>

    </div>


</body>
</html>