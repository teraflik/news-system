<?php
require('includes/dbconn.php');
$page = "developers";
?>
	<!DOCTYPE html>
	<html>

	<head>
		<title>Developers</title>
		<?php include("includes/header.html"); ?>
		<link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900'>
		<link rel="stylesheet" href="css/developers.css">
	</head>

	<body>
		<?php include("includes/navbar.php"); ?>
		<div class="container">
			<div class="at-section">
				<div class="at-section__title">Our Team</div>
			</div>
			<div class="at-grid" data-column="4">
				<div class="at-column">
					<div class="at-user">
						<div class="at-user__avatar"><img src="resources/p.jpg" /></div>
						<div class="at-user__name">Piyush Arora</div>
						<div class="at-user__title">Full Stack Developer</div>
						<div class="at-social">
							<li class="at-social__item">
								<a href="https://www.facebook.com/PiyushA01">
									<i class="fa fa-facebook-official" aria-hidden="true"></i></a>
							</li>
							<li class="at-social__item">
								<a href="https://twitter.com/PiyushArora01">
									<i class="fa fa-twitter" aria-hidden="true"></i></a>
							</li>
							<li class="at-social__item">
								<a href="https://www.linkedin.com/in/piyush-arora/">
									<i class="fa fa-linkedin-square" aria-hidden="true"></i></a>
							</li>
							<li class="at-social__item">
								<a href="https://github.com/PiyushArora01/">
									<i class="fa fa-github" aria-hidden="true"></i></a>
							</li>
						</div>
					</div>
				</div>
				<div class="at-column">
					<div class="at-user">
						<div class="at-user__avatar"><img src="resources/r.jpg" /></div>
						<div class="at-user__name">Raghav Khandelwal</div>
						<div class="at-user__title">Full Stack Developer</div>
						<div class="at-social">
							<li class="at-social__item">
								<a href="https://www.facebook.com/raghavthecyberdude">
									<i class="fa fa-facebook-official" aria-hidden="true"></i></a>
							</li>
							<li class="at-social__item">
								<a href="https://twitter.com/gr8raghav">
									<i class="fa fa-twitter" aria-hidden="true"></i></a>
							</li>
							<li class="at-social__item">
								<a href="https://www.linkedin.com/in/raghavthecyberdude">
									<i class="fa fa-linkedin-square" aria-hidden="true"></i></a>
							</li>
						</div>
					</div>
				</div>
				<div class="at-column">
					<div class="at-user">
						<div class="at-user__avatar"><img src="resources/h.jpg" /></div>
						<div class="at-user__name">Harpahul Singh</div>
						<div class="at-user__title">Back-end Developer</div>
						<div class="at-social">
							<li class="at-social__item">
								<a href="https://www.facebook.com/kirihack13">
									<i class="fa fa-facebook-official" aria-hidden="true"></i></a>
								<li class="at-social__item">
									<a href="https://twitter.com/harpahulsingh">
										<i class="fa fa-twitter" aria-hidden="true"></i></a>
								</li>
								<li class="at-social__item">
									<a href="https://www.linkedin.com/in/harpahul-bhatia-9235b5115">
										<i class="fa fa-linkedin-square" aria-hidden="true"></i></a>
								</li>
						</div>
					</div>
				</div>
				<div class="at-column">
					<div class="at-user">
						<div class="at-user__avatar"><img src="resources/n.jpg" /></div>
						<div class="at-user__name">Nikunj Sharma</div>
						<div class="at-user__title">Database Developer</div>
						<div class="at-social">
							<li class="at-social__item">
								<a href="https://www.facebook.com/nikunj.sharma.08">
									<i class="fa fa-facebook-official" aria-hidden="true"></i></a>
							</li>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php include("includes/scripts.html"); ?>
	</body>

	</html>
