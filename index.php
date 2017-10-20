<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no, width=device-width">

    <title>Mount Vernon Geolocation Prototype</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <link rel="stylesheet" href="./lib/uikit/css/uikit.min.css" />
    <link rel="stylesheet" href="./lib/ol/ol.css" type="text/css">
    <link rel="stylesheet" href="./css/style.css?v1.85" type="text/css">
    <script src="./lib/uikit/js/uikit.min.js"></script>
    <script src="./lib/uikit/js/uikit-icons.min.js"></script>
    <script src="./lib/ol/ol.js"></script>
  </head>
  <body>
    <!-- Header -->
    <div class="logo">
      <img src="./img/mv-logo-color.png">
    </div>
    <div class="uk-container uk-padding-remove">
      <div class="nav">
        <a href="#offcanvas-slide" uk-icon="icon: menu" uk-toggle class="uk-padding-small"></a>
      </div>
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
    <div id="offcanvas-slide" uk-offcanvas>
        <div class="uk-offcanvas-bar mv-nav">
            <ul class="uk-nav uk-nav-default">
                <li class="uk-active"><a href="#">Active</a></li>
                <li><a href="#">Item</a></li>
                <li class="uk-nav-header">Header</li>
                <li><a href="#">Item</a></li>
                <li><a href="#">Item</a></li>
                <li class="uk-nav-divider"></li>
                <li><a href="#">Item</a></li>
            </ul>
        </div>
    </div>
    <script src="./js/script.js?v2.21"></script>
  </body>
</html>
