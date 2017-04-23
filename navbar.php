<nav class="navbar navbar-toggleable-sm navbar-inverse bg-primary">
	<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
	<a class="navbar-brand" href="index.php"><h2>News Group</h2></a>
	<div class="collapse navbar-collapse" id="navbarNavDropdown">
		<ul class="navbar-nav ml-auto">
			<li class="nav-item <?php if($page=='home') echo 'active' ?>">
				<a class="nav-link" href="index.php">Home</a>
			</li>
			<li class="nav-item <?php if($page=='developers') echo 'active' ?>">
				<a class="nav-link" href="developers.php">Developers</a>
			</li>
			<?php 
				if( isset($_SESSION['username']) ){
			?>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['username']; ?></a>
				<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
					<a class="dropdown-item" href="favourites.php">Favourites</a>
					<a class="dropdown-item" href="logout.php">Logout</a>
				</div>
			</li>
			<?php
				}
				else {
					echo '
					<li class="nav-item '; if($page=="register") echo 'active'; echo'">
					<a class="nav-link" href="register.php">Register</a>
					</li>';
				}  
			?>
		</ul>
	</div>
</nav>

<?php
/*Only for debugging purposes.*/
if($DEBUG == 1){
	echo '
	<div class="alert alert-warning alert-dismissible fade show" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
		<h3>Log:</h3>
		<p>';
			if( isset($_SESSION['log']) ){
				echo $_SESSION['log'];
				unset($_SESSION['log']);
			}
	echo'
		</p>
	</div>';
}
?>