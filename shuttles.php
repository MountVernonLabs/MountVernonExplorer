<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no, width=device-width">

    <title>Shuttle Services at Mount Vernon</title>
    <?php include "includes/head.php"; ?>
  </head>
  <body>
    <!-- Header -->
    <?php include "includes/logo.php"; ?>
    <div class="uk-container uk-padding-remove">
      <?php include "includes/nav.php"; ?>

      <ul class="uk-subnav uk-subnav-pill uk-margin-remove-top" uk-switcher>
        <li><a href="#" onclick="document.getElementById('dg').src += ''">Distillery & Gristmill</a></li>
        <li><a href="#" onclick="document.getElementById('pfw').src += ''">Wharf</a></li>
      </ul>

    <ul class="uk-switcher uk-margin-remove" style="font-size: 1px !important;">
      <li><iframe id="dg" class="shuttle t_iframe uk-width-1-1 uk-height-large" src="https://www.mountvernon.org/site/shuttle-tracker/distillery-gristmill/" scrolling="no"></iframe>
      </li>
      <li><iframe id="pfw" class="shuttle t_iframe uk-width-1-1 uk-height-large" src="https://www.mountvernon.org/site/shuttle-tracker/wharf/" scrolling="no"></iframe>
      </li>
    </ul>
    </div>

    <!-- Menu -->
    <?php include "includes/menu.php"; ?>
  </body>
</html>
