<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no, width=device-width">

    <title>Social Media - Mount Vernon Explorer</title>
    <?php include "includes/head.php"; ?>
  </head>
  <body>
    <!-- Header -->
    <?php include "includes/logo.php"; ?>
    <div class="uk-container uk-padding-remove-top">
      <?php include "includes/nav.php"; ?>
      <span class="uk-badge uk-float-right uk-margin-top">#mtvernon</span>
      <h3 class="uk-padding-remove-top uk-margin-remove-top">Follow Us</h3>
      <div class="uk-card uk-card-default uk-card-body uk-align-center">
        <a target="_blank" class="uk-margin-right" uk-icon="icon: facebook; ratio: 2" src="https://www.facebook.com/HistoricMountVernon"></a>
        <a target="_blank" class="uk-margin-right" uk-icon="icon: twitter; ratio: 2" src="https://twitter.com/intent/follow?source=followbutton&variant=1.0&screen_name=mountvernon"></a>
        <a target="_blank" class="uk-margin-right" uk-icon="icon: instagram; ratio: 2" src="https://www.instagram.com/mount_vernon/"></a>
        <a target="_blank" class="uk-margin-right" uk-icon="icon: youtube; ratio: 2" src="https://www.youtube.com/user/HistoricMountVernon?sub_confirmation=1"></a>
      </div>
      <h3 class="uk-padding-remove-top">Latest Posts</h3>

      <ul class="uk-subnav uk-subnav-pill" uk-switcher>
          <li><a href="#">Facebook</a></li>
          <li><a href="#">Twitter</a></li>
      </ul>
      <ul class="uk-switcher uk-margin">
          <li>
            <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FHistoricMountVernon%2F&tabs=timeline&width=340&height=600&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId=56104033920" width="340" height="600" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe>
          </li>
          <li>
            <a class="twitter-timeline" href="https://twitter.com/MountVernon?ref_src=twsrc%5Etfw">Tweets by MountVernon</a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
          </li>
      </ul>

    </div>

    <!-- Menu -->
    <?php include "includes/menu.php"; ?>
  </body>
</html>
