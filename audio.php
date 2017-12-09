<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no, width=device-width">

    <title>Audio Tours</title>
    <?php include "includes/head.php"; ?>
  </head>
  <body>
    <!-- Header -->
    <?php include "includes/logo.php"; ?>
    <div class="uk-container uk-padding-remove">
      <?php include "includes/nav.php"; ?>

      <h4 class="uk-text-uppercase uk-padding-small uk-padding-remove-bottom uk-padding-remove-top uk-margin-remove-top uk-margin-remove">Audio Tours</h4>
      <table class="uk-table" id="locations">
          <tbody>
             <?php
                $json = file_get_contents("https://www.mountvernon.org/site/api/audio-tours");
                $tours = json_decode($json, true);
                foreach ($tours as $tour){
              ?>
              <tr class="uk-padding-small uk-padding-remove-bottom" uk-toggle="target: #tour<?php echo $tour["id"]?>">
                  <td class="uk-padding-small uk-padding-remove-right mv-list-image uk-padding-remove-bottom uk-width-small">
                    <img class="uk-thumbnail-mini" src="<?php echo prefixURL($tour["image"], "sml_")?>">
                  </td>
                  <td class="uk-text-bold uk-padding-small">
                    <?php echo $tour["name"]?>
                  </td>
                  <td class="uk-padding-small"><?php echo $tour["duration"]?> mins</td>
              </tr>
              <?php  } ?>
          </tbody>
      </table>

      <?php
         foreach ($tours as $tour){
       ?>
      <div id="tour<?php echo $tour["id"]?>" class="uk-modal-full" uk-modal>
          <div class="uk-modal-dialog" uk-height-viewport>
              <button class="uk-modal-close-full uk-close-large" type="button" uk-close></button>
              <div class="uk-padding-large">
                  <h3><?php echo $tour["name"]?></h3>

                  <div class="uk-position-relative uk-visible-toggle" uk-slideshow>

                    <div class="uk-padding-remove" uk-slideshow>

                      <a class="uk-slidenav" href="#" uk-slidenav-previous uk-slideshow-item="previous"></a>
                      <a class="uk-slidenav" href="#" uk-slidenav-next uk-slideshow-item="next"></a>
                      <span class="uk-text-uppercase uk-text-bold">Next Stop</span>
                      <hr class="uk-divider-icon uk-margin-small">
                      <ul class="uk-slideshow-items" uk-height-viewport="min-height: 800">
                        <?php
                           $audio_data = file_get_contents("https://www.mountvernon.org/site/api/audio-tours/".$tour["id"]);
                           $audio = json_decode($audio_data, true);

                           $locations_data = file_get_contents("http://www.mountvernon.org/site/api/locations");
                           $locations = json_decode($locations_data, true);

                           foreach ($audio as $clip){
                             if ($clip["alt_location"] == ""){
                               foreach ($locations as $loc){
                                 if ($loc["id"] == $clip["location"]){
                                   $clip["latitude"] = $loc["latitude"];
                                   $clip["longitude"] = $loc["longitude"];
                                 }
                               }
                             } else {
                               $loc = json_decode($clip["alt_location"], true);
                               $clip["latitude"] = $loc["latitude"];
                               $clip["longitude"] = $loc["longitude"];
                             }

                         ?>
                          <li>
                            <div class="uk-padding-remove">
                              <h4 class="uk-margin-small"><?php echo $clip["name"]?></h4>
                              <?php if ($clip["image"] != ""){ ?>
                                <p class="uk-margin-small"><img src="<?=$clip["image"]?>" class="uk-width-medium"></p>
                              <?php } ?>
                              <p id="directions<?php echo $clip["id"]?>" lat="<?=$clip["latitude"]?>" long="<?=$clip["longitude"]?>" class="directions uk-text-uppercase uk-text-bold uk-margin-small"><span uk-icon="icon: plus-circle"></span> Get Directions</p>

                              <audio controls src="<?php echo $clip["clip"]?>">
                                <a href="<?php echo $clip["clip"]?>"><?php echo $clip["name"]?></a>
                              </audio>
                                <div style="overflow: scroll;" class="uk-height-small uk-margin-small-top">

                                  <p><?php echo $clip["transcript"]?></p>
                                </div>

                            </div>
                          </li>
                        <?php  } ?>
                      </ul>


                  </div>

              </div>
          </div>
      </div>
      <?php  } ?>

    <!-- Menu -->
    <?php include "includes/menu.php"; ?>
    <script src="./js/script-audio.js?v1.44"></script>
  </body>
</html>
