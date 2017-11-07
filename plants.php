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
    <div class="uk-container uk-padding-medium">
        <ul class="uk-iconnav">
            <span class="uk-text-small uk-text-bold uk-text-uppercase">Filter By:</span>
            <li><a href="#" uk-icon="icon: location"></a></li>
            <li><a href="#" uk-icon="icon: paint-bucket"></a></li>
            <li><a href="#" uk-icon="icon: calendar"></a></li>
        </ul>
    </div>
    <div class="uk-container uk-padding-small">

      <div class="uk-grid-small uk-text-center" uk-grid>
        <?php
          $plants_data = file_get_contents("http://www.mountvernon.org/site/api/plants");
          $plants = json_decode($plants_data, true);

          foreach($plants as $plant){ ?>
            <div>
                <div class="uk-card uk-card-default uk-card-body uk-width-small mv-plant-image uk-text-small uk-padding-small">
                  <a href="#plant<?=$plant["id"]?>" uk-toggle><img src="<?=prefixURL($plant["main_photo"],'sml_')?>"></a>
                  <p class="uk-padding-remove"><?=$plant["comon_name"]?></p>
                </div>
            </div>
        <? } ?>
      </div>
    </div>
    <!-- This is the modal -->
    <div id="mv-plants-more">
      <?php  foreach($plants as $plant){ ?>
      <div id="plant<?=$plant["id"]?>" class="uk-modal-full" uk-modal>
          <div class="uk-modal-dialog" uk-height-viewport>
              <button class="uk-modal-close-full uk-close-large" type="button" uk-close></button>
              <div class="uk-padding-large">
                  <h3><?=$plant["comon_name"]?></h3>
                  <img src="<?=$plant["main_photo"]?>">
                  <p><?=$plant["details"]?></p>
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
