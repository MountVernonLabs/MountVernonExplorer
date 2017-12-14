<!DOCTYPE html>
<html style="height: 100%;">
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no, width=device-width">

    <title>Link - Mount Vernon Explorer</title>
    <?php include "includes/head.php"; ?>
  </head>
  <body style="height: 100%;">
    <!-- Header -->
    <?php include "includes/logo.php"; ?>
    <div class="uk-container uk-padding-remove-top" style="height: 100%;">
      <?php include "includes/nav.php"; ?>
      <iframe style="width:100%;height:100%;" src="<?php echo $_GET["url"]?>"></iframe>
    </div>

    <!-- Menu -->
    <?php include "includes/menu.php"; ?>
  </body>
</html>
