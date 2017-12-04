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
      <img class="uk-width-1-1" src="http://s3.amazonaws.com/mtv-main-assets/files/resources/large_mvi_retouched-web.jpg" />
      <p>Savor the flavors of early America at the <strong>Mount Vernon Inn Restaurant</strong>, located just footsteps from George Washington’s historic estate.</p>
      <p class="uk-text-meta">Open daily. Hours of operation vary based on day of the week, meal served, and reservations.</p>

      <script type='text/javascript' src='//www.opentable.com/widget/reservation/loader?rid=109627&domain=com&type=standard&theme=standard&lang=en-US&overlay=false&iframe=true'></script>

      <p class="uk-margin-bottom"><strong>Need something a little faster?</strong> Grab a quick bite from our Food Court which offers many options for breakfast, lunch, and snacks on the go, including salads, deli sandwiches, hamburgers, and fresh-baked cookies.</p>
    </div>

    <!-- Menu -->
    <?php include "includes/menu.php"; ?>
  </body>
</html>
