<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<?php
  $json = file_get_contents('http://www.mountvernon.org/site/api/plants/locations');
  $locations = json_decode($json, true);
  foreach ($locations as $location){
    $venue[$location["id"]] = $location["name"];
  }

  $json = file_get_contents('http://www.mountvernon.org/site/api/plants/colors');
  $plant_colors = json_decode($json, true);
  foreach ($plant_colors as $plant_color){
    $colors[$plant_color["id"]] = $plant_color["hex"];
  }

  $json = file_get_contents('http://www.mountvernon.org/site/api/plants/types');
  $plant_types = json_decode($json, true);
  foreach ($plant_types as $plant_type){
    $p_type[$plant_type["id"]] = $plant_type["name"];
  }

  $json = file_get_contents('http://www.mountvernon.org/site/api/plants/sun');
  $plant_sunlight = json_decode($json, true);
  foreach ($plant_sunlight as $plant_sun){
    $p_sun[$plant_sun["id"]] = $plant_sun["name"];
  }

  $json = file_get_contents('http://www.mountvernon.org/site/api/plants/wildlife');
  $plant_wild = json_decode($json, true);
  foreach ($plant_wild as $plant_wildlife){
    $p_wildlife[$plant_wildlife["id"]] = $plant_wildlife["name"];
  }

  $json = file_get_contents('http://www.mountvernon.org/site/api/plants/toxicity');
  $plant_toxicity = json_decode($json, true);
  foreach ($plant_toxicity as $plant_toxic){
    $p_toxic[$plant_toxic["id"]] = $plant_toxic["name"];
  }

  $json = file_get_contents('http://www.mountvernon.org/site/api/plants/tollerances');
  $plant_tollerances = json_decode($json, true);
  foreach ($plant_tollerances as $plant_tollerance){
    $p_tollerance[$plant_tollerance["id"]] = $plant_tollerance["name"];
  }

  $json = file_get_contents('http://www.mountvernon.org/site/api/plants/uses');
  $plant_uses = json_decode($json, true);
  foreach ($plant_uses as $plant_use){
    $p_uses[$plant_use["id"]] = $plant_use["name"];
  }

  $json = file_get_contents('http://www.mountvernon.org/site/api/plants/seasons');
  $plant_seasons = json_decode($json, true);
  foreach ($plant_seasons as $plant_season){
    $p_season[$plant_season["id"]] = $plant_season["name"];
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no, width=device-width">

    <title>Plant Finder - Mount Vernon Explorer</title>
    <?php include "includes/head.php"; ?>
  </head>
  <body>
    <div id="sponsor" class="uk-cover-container" uk-height-viewport>
        <img src="https://static.pexels.com/photos/36753/flower-purple-lical-blosso.jpg" alt="" uk-cover>
    </div>
    <!-- Header -->
    <?php include "includes/logo.php"; ?>
    <div class="uk-container uk-padding-remove">
      <?php include "includes/nav.php"; ?>
    </div>
    <div class="uk-offcanvas-content">
      <div class="uk-container uk-padding-medium">
          <ul class="uk-iconnav">
              <span class="uk-text-small uk-text-bold uk-text-uppercase">Filter By:</span>
              <li><a uk-icon="icon: location" uk-toggle="target: #plantfinder-filter"></a></li>
              <li><a uk-icon="icon: paint-bucket" uk-toggle="target: #plantfinder-filter"></a></li>
              <li><a uk-icon="icon: calendar" uk-toggle="target: #plantfinder-filter"></a></li>
              <li><a uk-icon="icon: refresh" class="uk-margin-left clear-filter" style="display: none;"></a></li>
              <span class="uk-text-small uk-text-uppercase clear-filter" style="display: none;">Show All</span>
          </ul>
          <div id="plantfinder-filter" uk-offcanvas="flip: true; overlay: true; mode: push">
              <div class="uk-offcanvas-bar uk-padding-small">
                  <button class="uk-offcanvas-close" type="button" uk-close></button>
                  <p class="uk-padding-remove-top uk-text-bold uk-text-uppercase uk-margin-remove-bottom">Type of Plant</p>
                  <?php foreach ($plant_types as $type){ ?>
                    <div class="uk-width-small uk-float-left">
                      <input type="checkbox" id="type-<?=$type["id"]?>" class="filter-checkbox"><label><?=$type["name"]?></label>
                    </div>
                  <?php } ?>
                  <div class="uk-clearfix"></div>
                  <p class="uk-text-bold uk-text-uppercase uk-margin-remove-bottom">Primary Color</p>
                  <?php foreach ($plant_colors as $color){ ?>
                    <div class="uk-width-small uk-float-left">
                      <input type="checkbox" id="color-<?=$color["id"]?>" class="filter-checkbox"><label><?=$color["name"]?></label>
                    </div>
                  <?php } ?>
                  <div class="uk-clearfix"></div>
                  <p class="uk-text-bold uk-text-uppercase uk-margin-remove-bottom">Location</p>
                  <?php foreach ($locations as $location){ ?>
                    <div class="uk-width-medium uk-float-left">
                      <input type="checkbox" id="location-<?=$location["id"]?>" class="filter-checkbox"><label><?=$location["name"]?></label>
                    </div>
                  <?php } ?>
                  <div class="uk-clearfix"></div>
                  <p class="uk-text-bold uk-text-uppercase uk-margin-remove-bottom">Season</p>
                  <?php foreach ($plant_seasons as $season){ ?>
                    <div class="uk-width-small uk-float-left">
                      <input type="checkbox" id="season-<?=$season["id"]?>" class="filter-checkbox"><label><?=$season["name"]?></label>
                    </div>
                  <?php } ?>
              </div>
          </div>
      </div>
    </div>
    <div class="uk-container uk-padding-small">

      <div class="uk-grid-small uk-text-center" uk-grid>
        <?php
          $plants_data = file_get_contents("http://www.mountvernon.org/site/api/plants");
          $plants = json_decode($plants_data, true);


          foreach($plants as $plant){
            $class_type = "";
            $class_location = "";
            $class_color = "";
            $class_season = "";
            foreach (bigtreeArray($plant["type"]) as $type) {
              $class_type = $class_type."type-".$type." ";
            }
            foreach (bigtreeArray($plant["location"]) as $location) {
              $class_location = $class_location."location-".$location." ";
            }
            foreach (bigtreeArray($plant["color"]) as $color) {
              $class_color = $class_color."color-".$color." ";
            }
            foreach (bigtreeArray($plant["season"]) as $season) {
              $class_season = $class_season."season-".$season." ";
            }
        ?>
            <div class="plant-card <?=$class_type?> <?=$class_location?> <?=$class_color?> <?=$class_season?>">
                <div class="uk-card uk-card-default uk-card-body uk-width-small mv-plant-image uk-text-small uk-padding-small">
                  <a href="#plant<?php echo $plant["id"]?>" uk-toggle><img src="<?php echo prefixURL($plant["main_photo"],'sml_')?>"></a>
                  <p class="uk-padding-remove"><?php echo $plant["comon_name"]?></p>
                </div>
            </div>
        <?php  } ?>
      </div>
    </div>
    <!-- This is the modal -->
    <div id="mv-plants-more">
      <?php  foreach($plants as $plant){ ?>
      <div id="plant<?php echo $plant["id"]?>" class="uk-modal-full" uk-modal>
          <div class="uk-modal-dialog" uk-height-viewport>
              <button class="uk-modal-close-full uk-close-large" type="button" uk-close></button>
              <div class="uk-padding-large">
                  <h3><?php echo $plant["comon_name"]?></h3>
                  <div class="uk-height-max-medium" style="height: 400px;">
                    <div class="uk-position-relative uk-visible-toggle uk-light uk-width-large uk-overflow-hidden uk-height-max-medium" style="height: 400px;" uk-slideshow="min-height: 300; max-height: 600; autoplay: true">
                        <ul class="uk-slideshow-items">
                            <li>
                              <div class="uk-position-cover uk-animation-kenburns uk-animation-reverse uk-transform-origin-center-left">
                                <img src="<?php echo $plant["main_photo"]?>" alt="" uk-cover>
                              </div>
                            </li>
                              <?php
                                $gallery = json_decode($plant["gallery"], true);
                                foreach ($gallery as $gimage){
                              ?>
                                <li>
                                  <div class="uk-position-cover uk-animation-kenburns uk-animation-reverse uk-transform-origin-center-left">
                                    <img src="<?php echo $gimage["image"]?>" alt="" uk-cover>
                                  </div>
                                </li>
                              <?php  } ?>

                        </ul>
                        <a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous uk-slideshow-item="previous"></a>
                        <a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next uk-slideshow-item="next"></a>
                    </div>
                  </div>


                  <?php  if ($plant["history"]) { ?>
                    <h4 class="uk-text-uppercase">History</h4>
                    <p><?php echo $plant["history"]?></p>
                  <?php  } ?>
                  <h4 class="uk-text-uppercase">Details</h4>
                  <?php  if ($plant["details"]) { ?>
                    <p><?php echo $plant["details"]?></p>
                  <?php  } ?>
                  <table class="uk-table uk-table-divider uk-padding-small">
                    <tbody>
                      <?php  if ($plant["latin_name"]) { ?>
                             <tr class="uk-padding-remove">
                                 <td class="uk-text-bold">Latin Name</td>
                                 <td><?php echo $plant["latin_name"]?></td>
                             </tr>
                      <?php  } ?>
                      <?php  if ($plant["family"]) { ?>
                             <tr class="uk-padding-remove">
                                 <td class="uk-text-bold">Family</td>
                                 <td><?php echo $plant["family"]?></td>
                             </tr>
                      <?php  } ?>
                      <?php  if ($plant["also_known_as"]) { ?>
                             <tr class="uk-padding-remove">
                                 <td class="uk-text-bold">Also Known As</td>
                                 <td><?php echo str_replace("\r\n","<br>",$plant["also_known_as"])?></td>
                             </tr>
                      <?php  } ?>
                      <?php  if ($plant["bloom_start_time"]) { ?>
                             <tr class="uk-padding-remove">
                                 <td class="uk-text-bold">Bloom Season</td>
                                 <td><?php echo date('F',strtotime($plant["bloom_start_time"]));?> - <?php echo date('F',strtotime($plant["bloom_end_time"]));?></td>
                             </tr>
                      <?php  } ?>
                      <?php  if ($plant["native_range"]) { ?>
                             <tr class="uk-padding-remove">
                                 <td class="uk-text-bold">Native Range</td>
                                 <td><?php echo $plant["native_range"]?></td>
                             </tr>
                      <?php  } ?>
                      <?php  if ($plant["max_height"]) { ?>
                             <tr class="uk-padding-remove">
                                 <td class="uk-text-bold">Max Height</td>
                                 <td><?php echo $plant["max_height"]?>'</td>
                             </tr>
                      <?php  } ?>
                      <?php  if ($plant["max_spread"]) { ?>
                             <tr class="uk-padding-remove">
                                 <td class="uk-text-bold">Max Spread</td>
                                 <td><?php echo $plant["max_spread"]?>'</td>
                             </tr>
                      <?php  } ?>
                      <?php  if ($plant["tollerances"]) { ?>
                             <tr class="uk-padding-remove">
                                 <td class="uk-text-bold">Tollerances</td>
                                 <td>
                                   <?php  foreach (bigtreeArray($plant["tollerances"]) as $tollerance){
                                        echo $p_tollerance[$tollerance]."<br>";
                                      }
                                   ?>
                                 </td>
                             </tr>
                      <?php  } ?>
                      <?php  if ($plant["uses"]) { ?>
                             <tr class="uk-padding-remove">
                                 <td class="uk-text-bold">Uses</td>
                                 <td>
                                   <?php  foreach (bigtreeArray($plant["uses"]) as $use){
                                        echo $p_uses[$use]."<br>";
                                      }
                                   ?>
                                 </td>
                             </tr>
                      <?php  } ?>
                    </tbody>

                  </table>

                  <?php  if ($plant["type"]){
                    foreach (bigtreeArray($plant["type"]) as $type){ ?>
          					<div class="uk-card uk-card-default uk-card-body uk-width-small uk-padding-small uk-float-left">
          						<img src="//mtv-main-assets.s3.amazonaws.com/files/plant-finder/icons/color/PF-icons-type-C/<?php echo $type?>.svg">
                      <div class="uk-padding-remove uk-card-footer"><span class="uk-text-bold">Type: </span><br><?php echo $p_type[$type]?></div>
                    </div>
          				<?php  }} ?>
                  <?php  if ($plant["sun"]){
                    foreach (bigtreeArray($plant["sun"]) as $sun){ ?>
          					<div class="uk-card uk-card-default uk-card-body uk-width-small uk-padding-small uk-float-left">
          						<img src="//mtv-main-assets.s3.amazonaws.com/files/plant-finder/icons/color/PF-icons-sun-C/<?php echo $sun?>.svg">
                      <div class="uk-padding-remove uk-card-footer"><span class="uk-text-bold">Sunlight: </span><br><?php echo $p_sun[$sun]?></div>
                    </div>
          				<?php  }} ?>
                  <?php  if ($plant["wildlife"]){
                    foreach (bigtreeArray($plant["wildlife"]) as $wildlife){ ?>
          					<div class="uk-card uk-card-default uk-card-body uk-width-small uk-padding-small uk-float-left">
          						<img src="//mtv-main-assets.s3.amazonaws.com/files/plant-finder/icons/color/PF-icons-wildlife-C/<?php echo $wildlife?>.svg">
                      <div class="uk-padding-remove uk-card-footer"><span class="uk-text-bold">Wildlife: </span><br><?php echo $p_wildlife[$wildlife]?></div>
                    </div>
          				<?php  }} ?>
                  <?php  if ($plant["toxicity"]){
                    foreach (bigtreeArray($plant["toxicity"]) as $toxic){ ?>
          					<div class="uk-card uk-card-default uk-card-body uk-width-small uk-padding-small uk-float-left">
          						<img src="//mtv-main-assets.s3.amazonaws.com/files/plant-finder/icons/color/PF-icons-toxicity-C/<?php echo $toxic?>.svg">
                      <div class="uk-padding-remove uk-card-footer"><span class="uk-text-bold">Toxicity: </span><br><?php echo $p_toxic[$toxic]?></div>
                    </div>
          				<?php  }} ?>
                  <?php  if ($plant["polinator"] == "on") { ?>
                    <div class="uk-card uk-card-default uk-card-body uk-width-small uk-padding-small uk-float-left">
          						<img src="//mtv-main-assets.s3.amazonaws.com/files/plant-finder/icons/color/PF-2-icons-pollinator-C.svg">
                      <div class="uk-padding-remove uk-card-footer">Polinator<br>&nbsp;</div>
                    </div>
                  <?php  } ?>
                  <?php  if ($plant["grown_by_washington"] == "on") { ?>
                    <div class="uk-card uk-card-default uk-card-body uk-width-small uk-padding-small uk-float-left">
          						<img src="//mtv-main-assets.s3.amazonaws.com/files/plant-finder/icons/color/PF-2-icons-GrownBy-C.svg">
                      <div class="uk-padding-remove uk-card-footer">Grown by Washington</div>
                    </div>
                  <?php  } ?>
                  <?php  if ($plant["sold_at_mv"] == "on") { ?>
                    <div class="uk-card uk-card-default uk-card-body uk-width-small uk-padding-small uk-float-left">
          						<img src="//mtv-main-assets.s3.amazonaws.com/files/plant-finder/icons/color/PF-2-icons-GrownBy-C.svg">
                      <div class="uk-padding-remove uk-card-footer">Sold at Mount Vernon</div>
                    </div>
                  <?php  } ?>
                  <div class="uk-clearfix"></div>
                  <h4 class="uk-text">Colors</h4>
                  <?php  foreach (bigtreeArray($plant["color"]) as $color){ ?>
                    <div style="width: 30px;height:30px;margin-right: 5px; margin-bottom: 5px; float: left; background: #<?php echo $colors[$color]?>"></div>
                  <?php  } ?>
                  <div style="clear:both"></div>
                  <h4 class="uk-text-uppercase">Planted at Mount Vernon</h4>
                  <div class="layered_image">
                    <img class="base" src="//mtv-main-assets.s3.amazonaws.com/files/plant-finder/map/PF_map_BG-desat.jpg">
          					<?php  foreach (bigtreeArray($plant["location"]) as $location){ ?>
          						<img src="//mtv-main-assets.s3.amazonaws.com/files/plant-finder/map/<?php echo $location?>.png">
          					<?php  } ?>
                </div>
                <h4 class="uk-text-uppercase">Hardiness Zones</h4>
                <div class="layered_image">
                  <img class="base" src="//mtv-main-assets.s3.amazonaws.com/files/plant-finder/zones/usmap-base.png">

                  <?php
                    $min = preg_split('#(?<=\d)(?=[a-z])#i', ($plant["zone"]));
                    $max = preg_split('#(?<=\d)(?=[a-z])#i', ($plant["zone_max"]));

                    for($i = 1; $i<=10; $i++) {
                        if ($min[0] <= $i && $max[0] >= $i) {
                          if ($min[0] == $i && $min[1] == "a") {
                    ?>
                            <img src="//mtv-main-assets.s3.amazonaws.com/files/plant-finder/zones/USDA-hardiness-zones-overlays/<?php echo $i?>a.png">
                            <img src="//mtv-main-assets.s3.amazonaws.com/files/plant-finder/zones/USDA-hardiness-zones-overlays/<?php echo $i?>b.png">
                    <?php 	} elseif ($min[0] == $i && $min[1] == "b") { ?>
                            <img src="//mtv-main-assets.s3.amazonaws.com/files/plant-finder/zones/USDA-hardiness-zones-overlays/<?php echo $i?>b.png">
                    <?php 	} elseif ($max[0] == $i && $max[1] == "a") { ?>
                            <img src="//mtv-main-assets.s3.amazonaws.com/files/plant-finder/zones/USDA-hardiness-zones-overlays/<?php echo $i?>a.png">
                            <img src="//mtv-main-assets.s3.amazonaws.com/files/plant-finder/zones/USDA-hardiness-zones-overlays/<?php echo $i?>b.png">
                    <?php 	} elseif ($max[0] == $i && $max[1] == "a") { ?>
                            <img src="//mtv-main-assets.s3.amazonaws.com/files/plant-finder/zones/USDA-hardiness-zones-overlays/<?php echo $i?>b.png">
                    <?php 	} else { ?>
                      <img src="//mtv-main-assets.s3.amazonaws.com/files/plant-finder/zones/USDA-hardiness-zones-overlays/<?php echo $i?>a.png">
                      <img src="//mtv-main-assets.s3.amazonaws.com/files/plant-finder/zones/USDA-hardiness-zones-overlays/<?php echo $i?>b.png">
                    <?php 			}
                        }
                    }
                  ?>
                  <img src="//mtv-main-assets.s3.amazonaws.com/files/plant-finder/zones/usmap-overlay.png">
                </div>
              </div>
          </div>
      </div>
      <?php  } ?>
    </div>

    <!-- Menu -->
    <?php include "includes/menu.php"; ?>
    <script src="./js/script-plants.js?v1.0"></script>
  </body>
</html>
