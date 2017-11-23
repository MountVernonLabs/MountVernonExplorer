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
      <table class="uk-table">
          <tbody>
             <?php
                $json = file_get_contents("https://www.mountvernon.org/site/api/audio-tours");
                $tours = json_decode($json, true);
                foreach ($tours as $tour){
              ?>
              <tr class="uk-padding-small">
                  <td class="uk-text-bold uk-padding-small">
                    <a href="#tour<?php echo $tour["id"]?>" uk-toggle><?php echo $tour["name"]?></a>
                  </td>
                  <td class="uk-padding-small"><?php echo $tour["duration"]?> minutes</td>
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

                  <div class="uk-position-relative uk-visible-toggle uk-height-large" uk-slideshow>

                    <div class="uk-padding-remove" uk-slideshow>

                      <a class="uk-slidenav" href="#" uk-slidenav-previous uk-slideshow-item="previous"></a>
                      <a class="uk-slidenav" href="#" uk-slidenav-next uk-slideshow-item="next"></a>
                      <span class="uk-text-uppercase uk-text-bold">Next Stop</span>
                      <ul class="uk-slideshow-items uk-padding-small">
                        <?php
                           $media = file_get_contents("https://www.mountvernon.org/site/api/audio-tours/".$tour["id"]);
                           $audio = json_decode($media, true);
                           foreach ($audio as $clip){
                         ?>
                          <li>
                            <div class="uk-card uk-card-default uk-card-body">
                              <h4><?php echo $clip["name"]?></h4>
                              <audio controls src="<?php echo $clip["clip"]?>">
                                <a href="<?php echo $clip["clip"]?>"><?php echo $clip["name"]?></a>
                              </audio>
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
    <script src="./js/script-audio.js?v1.2"></script>
  </body>
</html>
