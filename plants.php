<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no, width=device-width">

    <title>Mount Vernon Geolocation Prototype</title>
    <?php include "includes/head.php"; ?>
  </head>
  <body>
    <!-- Header -->
    <?php include "includes/logo.php"; ?>
    <div class="uk-container uk-padding-remove">
      <?php include "includes/nav.php"; ?>
    </div>

    <!-- This is the modal -->
    <div id="mv-location-more">

      <?php
        $locations_data = file_get_contents("http://www.mountvernon.org/site/api/locations");
        $locations = json_decode($locations_data, true);
        foreach($locations as $location){
      ?>
      <div id="location<?=$location["id"]?>" class="uk-modal-full" uk-modal>
          <div class="uk-modal-dialog" uk-height-viewport>
              <button class="uk-modal-close-full uk-close-large" type="button" uk-close></button>
              <div class="uk-padding-large">
                  <h3><?=$location["title"]?></h3>
                  <img src="<?=$location["image"]?>">
                  <p><?=$location["content"]?></p>
                  <a href="">Learn More</a>
              </div>
          </div>
      </div>
      <? } ?>
    </div>

    <!-- Menu -->
    <?php include "includes/menu.php"; ?>

  </body>
</html>
