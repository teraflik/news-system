<nav class="navbar navbar-toggleable-sm navbar-inverse bg-primary">
	<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
	<a class="navbar-brand" href="#">News Group</a>
	<div class="collapse navbar-collapse" id="navbarNavDropdown">
		<ul class="navbar-nav ml-auto">
			<li class="nav-item <?php if($page=='home') echo 'active' ?>">
				<a class="nav-link" href="index.php">Home</a>
			</li>
			<li class="nav-item <?php if($page=='developers') echo 'active' ?>">
				<a class="nav-link" href="developers.php">Developers</a>
			</li>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">User Name</a>
				<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
					<a class="dropdown-item" href="#">Favourites</a>
					<a class="dropdown-item" href="#">Logout</a>
				</div>
			</li>
		</ul>
	</div>
</nav>