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

        $objects_data = file_get_contents("http://www.mountvernon.org/site/api/collections/withlocations");
        $objects = json_decode($objects_data, true);

        foreach($locations as $location){
      ?>
      <div id="location<?php echo $location["id"]?>" class="uk-modal-full" uk-modal>
          <div class="uk-modal-dialog" uk-height-viewport>
              <button class="uk-modal-close-full uk-close-large" type="button" uk-close></button>
              <div class="uk-padding-large">
                  <h3><?php echo $location["title"]?></h3>

                  <div class="uk-height-max-medium" style="height: 400px;">
                    <div class="uk-position-relative uk-visible-toggle uk-light uk-width-large uk-overflow-hidden uk-height-max-medium" style="height: 400px;" uk-slideshow="min-height: 300; max-height: 600; autoplay: true">
                        <ul class="uk-slideshow-items">
                            <li>
                              <div class="uk-position-cover uk-animation-kenburns uk-animation-reverse uk-transform-origin-center-left">
                                <img src="<?php echo $location["image"] ?>" alt="" uk-cover>
                              </div>
                            </li>
                              <?php
                                $gallery = json_decode($location["media"], true);
                                foreach ($gallery as $gimage){
                              ?>
                                <li>
                                  <div class="uk-position-cover uk-animation-kenburns uk-animation-reverse uk-transform-origin-center-left">
                                    <img src="<?php echo prefixURL($gimage["image"], "sml_")?>" alt="" uk-cover>
                                  </div>
                                </li>
                              <?php  } ?>

                        </ul>
                        <a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous uk-slideshow-item="previous"></a>
                        <a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next uk-slideshow-item="next"></a>
                    </div>
                  </div>
                  <p lat="<?=$location["latitude"]?>" long="<?=$location["longitude"]?>" class="directions uk-text-uppercase uk-text-bold"><span uk-icon="icon: plus-circle"></span> Get Directions</p>
                  <p><?php echo $location["description"]?></p>
                  <?php
                    unset($rooms);
                    $rooms = array();

                    foreach ($locations as $subloc){
                      if ($subloc["parent"] == $location["id"] && $subloc["type"] == "room"){
                        array_push($rooms, $subloc);
                      }
                    }
                    aasort($rooms,"floor");

                    if (!empty($rooms)) {
                  ?>
                  <p class="uk-text-uppercase uk-text-bold">Rooms</p>
                  <ul uk-accordion>
                      <li>
                          <h3 class="uk-accordion-title">First Floor</h3>
                          <div class="uk-accordion-content uk-padding-remove">
                            <table class="uk-table uk-table-small uk-padding-remove">
                                <tbody class="uk-padding-small">
                                  <?php foreach ($rooms as $subloc){
                                        if ($subloc["floor"] == "First"){
                                  ?>
                                    <tr class="uk-padding-remove">
                                        <td class="uk-padding-small uk-padding-remove-right  uk-padding-remove-left uk-padding-remove-top mv-list-image">
                                          <a href="#location<?php echo $subloc["id"]?>" uk-toggle><img src="<?php echo $subloc["image"]?>" class="uk-thumbnail-mini"></a>
                                        </td>
                                        <td class="uk-padding-small">
                                          <?php echo $subloc["title"]?>
                                        </td>
                                    </tr>
                                  <?php }} ?>
                                </tbody>
                            </table>
                          </div>
                      </li>
                      <li>
                          <h3 class="uk-accordion-title">Second Floor</h3>
                          <div class="uk-accordion-content uk-padding-remove">
                            <table class="uk-table uk-table-small uk-padding-remove">
                                <tbody class="uk-padding-small">
                                  <?php foreach ($rooms as $subloc){
                                        if ($subloc["floor"] == "Second"){
                                  ?>
                                    <tr class="uk-padding-remove">
                                        <td class="uk-padding-small uk-padding-remove-right  uk-padding-remove-left uk-padding-remove-top mv-list-image">
                                          <a href="#location<?php echo $subloc["id"]?>" uk-toggle><img src="<?php echo $subloc["image"]?>" class="uk-thumbnail-mini"></a>
                                        </td>
                                        <td class="uk-padding-small">
                                          <?php echo $subloc["title"]?>
                                        </td>
                                    </tr>
                                  <?php }} ?>
                                </tbody>
                            </table>
                          </div>
                      </li>
                      <li>
                          <h3 class="uk-accordion-title">Third Floor</h3>
                          <div class="uk-accordion-content uk-padding-remove">
                            <table class="uk-table uk-table-small uk-padding-remove">
                                <tbody class="uk-padding-small">
                                  <?php foreach ($rooms as $subloc){
                                        if ($subloc["floor"] == "Third"){
                                  ?>
                                    <tr class="uk-padding-remove">
                                        <td class="uk-padding-small uk-padding-remove-right  uk-padding-remove-left uk-padding-remove-top mv-list-image">
                                          <a href="#location<?php echo $subloc["id"]?>" uk-toggle><img src="<?php echo $subloc["image"]?>" class="uk-thumbnail-mini"></a>
                                        </td>
                                        <td class="uk-padding-small">
                                          <?php echo $subloc["title"]?>
                                        </td>
                                    </tr>
                                  <?php }} ?>
                                </tbody>
                            </table>
                          </div>
                      </li>
                  </ul>
                <?php } ?>
                <?php
                  unset($items);
                  $items = array();

                  foreach ($objects as $object){
                    if ($object["location"] == $location["id"]){
                      array_push($items, $object);
                    }
                  }

                  if (!empty($items)) {
                ?>
                  <p class="uk-text-uppercase uk-text-bold">Objects in this Location</p>
                  <ul>
                    <?php foreach ($items as $item){
                      echo "<li>".$item["title"]."</li>";
                    } ?>
                  </ul>
                <?php } ?>
              </div>
          </div>
      </div>
      <?php  } ?>
    </div>

    <!-- Menu -->
    <?php include "includes/menu.php"; ?>
    <script src="./js/script.js?v2.43"></script>
  </body>
</html>
