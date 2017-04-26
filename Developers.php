<?php
require('includes/dbconn.php');
$page = "developers";

?>
<!DOCTYPE html>
<html>
  <head>
    <?php include("includes/header.html"); ?>
    <title>Developers</title>
    <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900'>
    <link rel="stylesheet" href="css/developers.css">
  </head>
<body>
<?php include("includes/navbar.php"); ?>

<main class="at-wrapper">
  <div class="at-section">
    <div class="at-section__title">Developers</div>
  </div>
  <div data-column='3' class="at-grid">
    <div class="at-column">
      <div class="at-user">
        <div class="at-user__avatar"><img src="resources/p.jpg"/></div>
        <div class="at-user__name">Piyush Arora</div>
        <div class="at-user__title">Front-End Developer</div>
        <ul class="at-social">
          <li class="at-social__item"><a href="https://www.facebook.com/PiyushA01">
              <i class="fa fa-facebook-official" aria-hidden="true"></i></a></li>
          <li class="at-social__item"><a href="https://twitter.com/PiyushArora01">
               <i class="fa fa-twitter" aria-hidden="true"></i></a></li>
          <li class="at-social__item"><a href="https://www.linkedin.com/in/piyush-arora-091b92125">
              <i class="fa fa-linkedin-square" aria-hidden="true"></i></a></li>
        </ul>
      </div>
    </div>
    <div class="at-column">
      <div class="at-user">
        <div class="at-user__avatar"><img src="resources/r.jpg"/></div>
        <div class="at-user__name">Raghav Khandelwal</div>
        <div class="at-user__title">Useless Fella</div>
        <ul class="at-social">
          <li class="at-social__item"><a href="https://www.facebook.com/raghavthecyberdude">
              <i class="fa fa-facebook-official" aria-hidden="true"></i></a></li>
          <li class="at-social__item"><a href="https://twitter.com/gr8raghav">
              <i class="fa fa-twitter" aria-hidden="true"></i></a></li>
          <li class="at-social__item"><a href="https://www.linkedin.com/in/raghavthecyberdude">
              <i class="fa fa-linkedin-square" aria-hidden="true"></i></a></li>
        </ul>
      </div>
    </div>
    <div class="at-column">
      <div class="at-user">
        <div class="at-user__avatar"><img src="resources/h.jpg"/></div>
        <div class="at-user__name">Harpahul Singh</div>
        <div class="at-user__title">Back-end Developer</div>
        <ul class="at-social">
          <li class="at-social__item"><a href="https://www.facebook.com/kirihack13">
              <i class="fa fa-facebook-official" aria-hidden="true"></i></a>
          <li class="at-social__item"><a href="https://twitter.com/harpahulsingh">
              <i class="fa fa-twitter" aria-hidden="true"></i></a></li>
          <li class="at-social__item"><a href="https://www.linkedin.com/in/harpahul-bhatia-9235b5115">
              <i class="fa fa-linkedin-square" aria-hidden="true"></i></a></li>
        </ul>
      </div>
      </div>
      <div class="at-column mx-auto">
      <div class="at-user">
        <div class="at-user__avatar"><img src="resources/n.jpg"/></div>
        <div class="at-user__name">Nikunj Sharma</div>
        <div class="at-user__title">MySQL Developer</div>
        <ul class="at-social">
          <li class="at-social__item"><a href="https://www.facebook.com/nikunjsharma008">
              <i class="fa fa-facebook-official" aria-hidden="true"></i></a></li>
        </ul>
      </div>
      </div>
    </main>
    <?php include("includes/scripts.html"); ?>
    </body>
</html>
