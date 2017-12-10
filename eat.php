<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no, width=device-width">

    <title>Where to Eat - Mount Vernon Explorer</title>
    <?php include "includes/head.php"; ?>
  </head>
  <body>
    <!-- Header -->
    <?php include "includes/logo.php"; ?>
    <div class="uk-container uk-padding-remove-top">
      <?php include "includes/nav.php"; ?>

      <h3 class="uk-padding-remove-top uk-margin-remove-top">Where to Eat</h3>

      <div class="uk-inline">
          <img src="//s3.amazonaws.com/mtv-main-assets/files/pages/shrimp-grits-web-4.jpg" alt="">
          <div class="uk-overlay-primary uk-position-cover"></div>
            <div class="uk-overlay uk-position-center uk-light">
            <h3 class="uk-padding-remove-top uk-margin-remove-top">Mount Vernon Inn</h3>
            <p>Savor the flavors of early America with a sitdown meal at the Mount Vernon Inn Restaurant, just footsteps from George Washington’s historic estate.</p>
            <a class="uk-button uk-button-default" href="https://www.opentable.com/mount-vernon-inn-restaurant-reservations-mount-vernon?restref=109627&lang=en-US">OpenTable reservation</a>
            </div>
      </div>

      <div class="uk-inline uk-margin-top uk-margin-bottom">
          <img src="//s3.amazonaws.com/mtv-main-assets/files/pages/veggiepattielandscape.jpg" alt="">
          <div class="uk-overlay-primary uk-position-cover"></div>
            <div class="uk-overlay uk-position-center uk-light">
            <h3 class="uk-padding-remove-top uk-margin-remove-top">Food Court Pavillion</h3>
            <p>Need something a little faster? Grab a quick bite from our Food Court which offers many options for breakfast, lunch, and snacks on the go.</p>
            </div>
      </div>
    </div>

    <!-- Menu -->
    <?php include "includes/menu.php"; ?>
  </body>
</html>
