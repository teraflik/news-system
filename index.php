<?php
$page = "home"; 
include "dbconn.php"; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include("header.html"); ?>
	<title>News Group</title>
</head>

<body>
	<?php include("navbar.php"); ?>
	<div class="container-fluid">
		<div class="row">
			<div class="col alert alert-warning alert-dismissible fade show" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<?php
					if( isset($_SESSION['Message']) ){
	        			echo $_SESSION['Message'];
	        			unset($_SESSION['Message']);
					}
					?>
			</div>
		</div>

		<div class="row">
			<div class="col">
				This here is the Main section.
			</div>
			<div class="col-lg-3">
				This is the sidebar here.
			</div>
		</div>
	</div>
	<?php include("scripts.html"); ?>
</body>

</html>
