<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no, width=device-width">

    <title>Today at Mount Vernon</title>
    <?php include "includes/head.php"; ?>
  </head>
  <body>
    <!-- Header -->
    <?php include "includes/logo.php"; ?>
    <div class="uk-container uk-padding-remove">
      <?php include "includes/nav.php"; ?>

      <h4 class="uk-text-uppercase uk-padding-small uk-padding-remove-bottom uk-padding-remove-top uk-margin-remove-top uk-margin-remove">Today's Events</h4>

    <table class="uk-table uk-table-divider uk-table-small uk-text-small">
      <thead>
          <tr>
              <th>Time</th>
              <th>Tour</th>
              <th>Location</th>
              <th></th>
          </tr>
      </thead>
    <tbody>
        <tr>
            <td>03:45PM</td>
            <td><strong>Premium Mansion Tour</strong>
            <span class="uk-label uk-label-warning">$</span></td>
            <td>Mansion Circle</td>
        </tr>
        <tr uk-toggle="target: #locationid">
            <td>04:00PM</td>
            <td><strong>Tribute at the Tombs</strong></td>
            <td>Tombs</td>
        </tr>

        <div id="locationid" class="uk-modal-full" uk-modal>
            <div class="uk-modal-dialog" uk-height-viewport>
                <button class="uk-modal-close-full uk-close-large" type="button" uk-close></button>
                <div class="uk-padding-large">
                    <h3>Tribute at the Tomb</h3>
                    <p>Pay your respect to George Washington by participating in a brief wreath-laying ceremony at the Washingtons' Tomb.</p>
                    <p class="uk-text-meta">Included with general admission, no ticket purchase is required.</p>
                </div>
            </div>
        </div>

        <tr>
            <td>04:30PM</td>
            <td><strong>Lives Bound Together</strong></td>
            <td>Museum</td>
        </tr>
        <tr>
            <td>05:00PM</td>
            <td><strong>Miller Time</strong></td>
            <td>Bar</td>
        </tr>
    </tbody>
</table>


    </div>

    <!-- Menu -->
    <?php include "includes/menu.php"; ?>
  </body>
</html>
