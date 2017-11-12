<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no, width=device-width">
    <meta name="HandheldFriendly" content="true" />
    <title>Explorer - Mount Vernon Explorer</title>
    <?php include "includes/head.php"; ?>
  </head>
  <body>
    <!-- Header -->
    <?php include "includes/logo.php"; ?>
    <div class="uk-container uk-padding-remove">
      <?php include "includes/nav.php"; ?>
      <div id="map"></div>
      <div id="info" class="uk-padding-remove">
        <p class="uk-text-uppercase uk-text-bold uk-padding-small uk-padding-remove-bottom uk-margin-remove-bottom">
          <span class="uk-margin-right">Nearby Items</span>
          <select id="explore-filter">
            <option value="" selected>Show All</option>
            <option value="structure">Building</option>
            <option value="restroom">Restrooms</option>
            <option value="retail">Food & Retail</option>
            <option value="transportation">Transportation</option>
            <option value="water">Water Fountains</option>
            <option value="service">Service Desks</option>
            <option value="project">Restoration Projects</option>
          </select>
          <a uk-icon="icon: question" class="uk-float-right"></a>
        </p>
        <div id="locations" class="uk-padding-small uk-padding-remove-top">
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
      <div id="location<?php echo $location["id"]?>" class="uk-modal-full" uk-modal>
          <div class="uk-modal-dialog" uk-height-viewport>
              <button class="uk-modal-close-full uk-close-large" type="button" uk-close></button>
              <div class="uk-padding-large">
                  <h3><?php echo $location["title"]?></h3>
                  <img src="<?php echo $location["image"]?>">
                  <p><?php echo $location["content"]?></p>
                  <a href="">Learn More</a>
              </div>
          </div>
      </div>
      <?php  } ?>
    </div>

    <!-- Menu -->
    <?php include "includes/menu.php"; ?>
    <script src="./js/script.js?v2.40"></script>
  </body>
</html>
