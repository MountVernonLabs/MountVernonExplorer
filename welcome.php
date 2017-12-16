<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no, width=device-width">
    <meta name="HandheldFriendly" content="true" />
    <title>Welcome - Mount Vernon Explorer</title>
    <?php include "includes/head.php"; ?>
  </head>
  <body>
    <!-- Header -->
    <?php include "includes/logo.php"; ?>
    <div class="uk-container uk-padding-remove">
      <?php include "includes/nav.php"; ?>
    </div>
    <div class="uk-container uk-padding-small uk-margin-remove-top">
      <h3 class="uk-margin-remove-vertical">Mount Vernon Explorer</h3>
      <img src="img/welcome.jpg" class="uk-margin-top-medium">
      <p>Mount Vernon Explorer is your digital guide to exploring the home of George Washington.  As you traverse the grounds we show you what's nearby and provide highlights from our curatorial staff.</p>
      <a class="uk-button uk-button-primary uk-align-center uk-margin-right uk-margin-left" href="<?php echo $base_url?>/"><span uk-icon="icon: location"></span> Get Started</a>
      <p class="uk-text-meta">PLEASE NOTE: Mount Vernon explorer requires you to enable location tracking in your device.</p>
    </div>
    <!-- Menu -->
    <?php include "includes/menu.php"; ?>
  </body>
</html>
