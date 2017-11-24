<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no, width=device-width">

    <title>Contact Us - Mount Vernon Explorer</title>
    <?php include "includes/head.php"; ?>
  </head>
  <body>
    <!-- Header -->
    <?php include "includes/logo.php"; ?>
    <div class="uk-container uk-padding-remove-top">
      <?php include "includes/nav.php"; ?>

      <h3 class="uk-padding-remove-top uk-margin-remove-top">Contact Us</h3>
      <p>
        <span uk-icon="icon: mail" class="uk-margin-right"></span><a href="mailto:tickets@mountvernon.org">Email Us</a>
      </p>
      <p>
        <span uk-icon="icon: phone" class="uk-margin-right"></span><a href="tel:17037802000">Call Us</a>
      </p>
      <p>
        <span uk-icon="icon: location" class="uk-margin-right"></span>3200 Mount Vernon Memorial Highway, Mount Vernon, Virginia 22121
      </p>
      <p>
        <iframe src="https://www.mountvernon.org/site/turn-by-turn/point/?slat=38.71028&slong=-77.08623" width="100%;" height="250"></iframe>
        <a href="https://www.google.com/maps/dir//George+Washington's+Mount+Vernon,+3200+Mt+Vernon+Memorial+Hwy,+Alexandria,+VA+22309/@38.707982,-77.086175,15z/data=!3m1!5s0x89b7ae966f0dbe89:0x12ec16b8bd7780f0!4m12!1m3!3m2!1s0x89b7ae9150022d97:0xa6efd58f6ac89b01!2sGeorge+Washington's+Mount+Vernon!4m7!1m0!1m5!1m1!1s0x89b7ae9150022d97:0xa6efd58f6ac89b01!2m2!1d-77.086175!2d38.707982?hl=en-US" target="_blank">Get Directions</a>
      </p>
    </div>

    <!-- Menu -->
    <?php include "includes/menu.php"; ?>
  </body>
</html>
