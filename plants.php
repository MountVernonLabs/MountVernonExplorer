<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<?php
  $json = file_get_contents('http://www.mountvernon.org/site/api/locations');
  $locations = json_decode($json, true);
  foreach ($locations as $location){
    $venue[$location["id"]] = $location["title"];
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

?>

<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no, width=device-width">

    <title>Plant Finder - Mount Vernon Explorer</title>
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
                  <div class="uk-height-max-medium" style="height: 400px;">
                    <div class="uk-position-relative uk-visible-toggle uk-light uk-width-large uk-overflow-hidden uk-height-max-medium" style="height: 400px;" uk-slideshow="min-height: 300; max-height: 600; autoplay: true">
                        <ul class="uk-slideshow-items">
                            <li>
                              <div class="uk-position-cover uk-animation-kenburns uk-animation-reverse uk-transform-origin-center-left">
                                <img src="<?=$plant["main_photo"]?>" alt="" uk-cover>
                              </div>
                            </li>
                              <?
                                $gallery = json_decode($plant["gallery"], true);
                                foreach ($gallery as $gimage){
                              ?>
                                <li>
                                  <div class="uk-position-cover uk-animation-kenburns uk-animation-reverse uk-transform-origin-center-left">
                                    <img src="<?=$gimage["image"]?>" alt="" uk-cover>
                                  </div>
                                </li>
                              <? } ?>

                        </ul>
                        <a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous uk-slideshow-item="previous"></a>
                        <a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next uk-slideshow-item="next"></a>
                    </div>
                  </div>


                  <? if ($plant["history"]) { ?>
                    <h4 class="uk-text-uppercase">History</h4>
                    <p><?=$plant["history"]?></p>
                  <? } ?>
                  <h4 class="uk-text-uppercase">Details</h4>
                  <? if ($plant["details"]) { ?>
                    <p><?=$plant["details"]?></p>
                  <? } ?>
                  <table class="uk-table uk-table-divider uk-padding-small">
                    <tbody>
                      <? if ($plant["latin_name"]) { ?>
                             <tr class="uk-padding-remove">
                                 <td class="uk-text-bold">Latin Name</td>
                                 <td><?=$plant["latin_name"]?></td>
                             </tr>
                      <? } ?>
                      <? if ($plant["family"]) { ?>
                             <tr class="uk-padding-remove">
                                 <td class="uk-text-bold">Family</td>
                                 <td><?=$plant["family"]?></td>
                             </tr>
                      <? } ?>
                      <? if ($plant["also_known_as"]) { ?>
                             <tr class="uk-padding-remove">
                                 <td class="uk-text-bold">Also Known As</td>
                                 <td><?=str_replace("\r\n","<br>",$plant["also_known_as"])?></td>
                             </tr>
                      <? } ?>
                      <? if ($plant["bloom_start_time"]) { ?>
                             <tr class="uk-padding-remove">
                                 <td class="uk-text-bold">Bloom Season</td>
                                 <td><?=date('F',strtotime($plant["bloom_start_time"]));?> - <?=date('F',strtotime($plant["bloom_end_time"]));?></td>
                             </tr>
                      <? } ?>
                      <? if ($plant["native_range"]) { ?>
                             <tr class="uk-padding-remove">
                                 <td class="uk-text-bold">Native Range</td>
                                 <td><?=$plant["native_range"]?></td>
                             </tr>
                      <? } ?>
                      <? if ($plant["max_height"]) { ?>
                             <tr class="uk-padding-remove">
                                 <td class="uk-text-bold">Max Height</td>
                                 <td><?=$plant["max_height"]?>'</td>
                             </tr>
                      <? } ?>
                      <? if ($plant["max_spread"]) { ?>
                             <tr class="uk-padding-remove">
                                 <td class="uk-text-bold">Max Spread</td>
                                 <td><?=$plant["max_spread"]?>'</td>
                             </tr>
                      <? } ?>
                      <? if ($plant["tollerances"]) { ?>
                             <tr class="uk-padding-remove">
                                 <td class="uk-text-bold">Tollerances</td>
                                 <td>
                                   <? foreach (bigtreeArray($plant["tollerances"]) as $tollerance){
                                        echo $p_tollerance[$tollerance]."<br>";
                                      }
                                   ?>
                                 </td>
                             </tr>
                      <? } ?>
                      <? if ($plant["uses"]) { ?>
                             <tr class="uk-padding-remove">
                                 <td class="uk-text-bold">Uses</td>
                                 <td>
                                   <? foreach (bigtreeArray($plant["uses"]) as $use){
                                        echo $p_uses[$use]."<br>";
                                      }
                                   ?>
                                 </td>
                             </tr>
                      <? } ?>
                    </tbody>

                  </table>

                  <? if ($plant["type"]){
                    foreach (bigtreeArray($plant["type"]) as $type){ ?>
          					<div class="uk-card uk-card-default uk-card-body uk-width-small uk-padding-small uk-float-left">
          						<img src="//mtv-main-assets.s3.amazonaws.com/files/plant-finder/icons/color/PF-icons-type-C/<?=$type?>.svg">
                      <div class="uk-padding-remove uk-card-footer"><span class="uk-text-bold">Type: </span><br><?=$p_type[$type]?></div>
                    </div>
          				<? }} ?>
                  <? if ($plant["sun"]){
                    foreach (bigtreeArray($plant["sun"]) as $sun){ ?>
          					<div class="uk-card uk-card-default uk-card-body uk-width-small uk-padding-small uk-float-left">
          						<img src="//mtv-main-assets.s3.amazonaws.com/files/plant-finder/icons/color/PF-icons-sun-C/<?=$sun?>.svg">
                      <div class="uk-padding-remove uk-card-footer"><span class="uk-text-bold">Sunlight: </span><br><?=$p_sun[$sun]?></div>
                    </div>
          				<? }} ?>
                  <? if ($plant["wildlife"]){
                    foreach (bigtreeArray($plant["wildlife"]) as $wildlife){ ?>
          					<div class="uk-card uk-card-default uk-card-body uk-width-small uk-padding-small uk-float-left">
          						<img src="//mtv-main-assets.s3.amazonaws.com/files/plant-finder/icons/color/PF-icons-wildlife-C/<?=$wildlife?>.svg">
                      <div class="uk-padding-remove uk-card-footer"><span class="uk-text-bold">Wildlife: </span><br><?=$p_wildlife[$wildlife]?></div>
                    </div>
          				<? }} ?>
                  <? if ($plant["toxicity"]){
                    foreach (bigtreeArray($plant["toxicity"]) as $toxic){ ?>
          					<div class="uk-card uk-card-default uk-card-body uk-width-small uk-padding-small uk-float-left">
          						<img src="//mtv-main-assets.s3.amazonaws.com/files/plant-finder/icons/color/PF-icons-toxicity-C/<?=$toxic?>.svg">
                      <div class="uk-padding-remove uk-card-footer"><span class="uk-text-bold">Toxicity: </span><br><?=$p_toxic[$toxic]?></div>
                    </div>
          				<? }} ?>
                  <? if ($plant["polinator"] == "on") { ?>
                    <div class="uk-card uk-card-default uk-card-body uk-width-small uk-padding-small uk-float-left">
          						<img src="//mtv-main-assets.s3.amazonaws.com/files/plant-finder/icons/color/PF-2-icons-pollinator-C.svg">
                      <div class="uk-padding-remove uk-card-footer">Polinator<br>&nbsp;</div>
                    </div>
                  <? } ?>
                  <? if ($plant["grown_by_washington"] == "on") { ?>
                    <div class="uk-card uk-card-default uk-card-body uk-width-small uk-padding-small uk-float-left">
          						<img src="//mtv-main-assets.s3.amazonaws.com/files/plant-finder/icons/color/PF-2-icons-GrownBy-C.svg">
                      <div class="uk-padding-remove uk-card-footer">Grown by Washington</div>
                    </div>
                  <? } ?>
                  <? if ($plant["sold_at_mv"] == "on") { ?>
                    <div class="uk-card uk-card-default uk-card-body uk-width-small uk-padding-small uk-float-left">
          						<img src="//mtv-main-assets.s3.amazonaws.com/files/plant-finder/icons/color/PF-2-icons-GrownBy-C.svg">
                      <div class="uk-padding-remove uk-card-footer">Sold at Mount Vernon</div>
                    </div>
                  <? } ?>
                  <div class="uk-clearfix"></div>
                  <h4 class="uk-text">Colors</h4>
                  <? foreach (bigtreeArray($plant["color"]) as $color){ ?>
                    <div style="width: 30px;height:30px;margin-right: 5px; margin-bottom: 5px; float: left; background: #<?=$colors[$color]?>"></div>
                  <? } ?>
                  <div style="clear:both"></div>
                  <h4 class="uk-text-uppercase">Planted at Mount Vernon</h4>
                  <div class="layered_image">
                    <img class="base" src="//mtv-main-assets.s3.amazonaws.com/files/plant-finder/map/PF_map_BG-desat.jpg">
          					<? foreach (bigtreeArray($plant["location"]) as $location){ ?>
          						<img src="//mtv-main-assets.s3.amazonaws.com/files/plant-finder/map/<?=$location?>.png">
          					<? } ?>
                </div>
                <h4 class="uk-text-uppercase">Hardiness Zones</h4>
                <div class="layered_image">
                  <img class="base" src="//mtv-main-assets.s3.amazonaws.com/files/plant-finder/zones/usmap-base.png">

                  <?
                    $min = preg_split('#(?<=\d)(?=[a-z])#i', ($plant["zone"]));
                    $max = preg_split('#(?<=\d)(?=[a-z])#i', ($plant["zone_max"]));

                    for($i = 1; $i<=10; $i++) {
                        if ($min[0] <= $i && $max[0] >= $i) {
                          if ($min[0] == $i && $min[1] == "a") {
                    ?>
                            <img src="//mtv-main-assets.s3.amazonaws.com/files/plant-finder/zones/USDA-hardiness-zones-overlays/<?=$i?>a.png">
                            <img src="//mtv-main-assets.s3.amazonaws.com/files/plant-finder/zones/USDA-hardiness-zones-overlays/<?=$i?>b.png">
                    <?	} elseif ($min[0] == $i && $min[1] == "b") { ?>
                            <img src="//mtv-main-assets.s3.amazonaws.com/files/plant-finder/zones/USDA-hardiness-zones-overlays/<?=$i?>b.png">
                    <?	} elseif ($max[0] == $i && $max[1] == "a") { ?>
                            <img src="//mtv-main-assets.s3.amazonaws.com/files/plant-finder/zones/USDA-hardiness-zones-overlays/<?=$i?>a.png">
                            <img src="//mtv-main-assets.s3.amazonaws.com/files/plant-finder/zones/USDA-hardiness-zones-overlays/<?=$i?>b.png">
                    <?	} elseif ($max[0] == $i && $max[1] == "a") { ?>
                            <img src="//mtv-main-assets.s3.amazonaws.com/files/plant-finder/zones/USDA-hardiness-zones-overlays/<?=$i?>b.png">
                    <?	} else { ?>
                      <img src="//mtv-main-assets.s3.amazonaws.com/files/plant-finder/zones/USDA-hardiness-zones-overlays/<?=$i?>a.png">
                      <img src="//mtv-main-assets.s3.amazonaws.com/files/plant-finder/zones/USDA-hardiness-zones-overlays/<?=$i?>b.png">
                    <?			}
                        }
                    }
                  ?>
                  <img src="//mtv-main-assets.s3.amazonaws.com/files/plant-finder/zones/usmap-overlay.png">
                </div>
              </div>
          </div>
      </div>
      <? } ?>
    </div>

    <!-- Menu -->
    <?php include "includes/menu.php"; ?>

  </body>
</html>
