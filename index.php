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
      <div id="map"></div>
      <div id="info">
        <p class="uk-text-uppercase uk-text-bold uk-padding-small uk-padding-remove-bottom">What's Nearby</h3>
        <div id="locations">
          <table class="uk-table uk-table-divider uk-table-small uk-table-justify uk-padding-remove-top">
            <tbody id="locations-list" class="uk-padding-small">
              <!-- Locations get populated here -->
            </tbody>
          </table>
        </div>
      </div>
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
    <script src="./js/script.js?v2.21"></script>
  </body>
</html>
