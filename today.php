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

      <h3 class="uk-text-uppercase uk-text-bold uk-padding-small uk-padding-remove-bottom">Today's Events</h3>

    <table class="uk-table uk-table-divider uk-table-small">
      <thead>
          <tr>
              <th>Time</th>
              <th>Tour</th>
              <th>Location</th>
              <th>Fee</th>
          </tr>
      </thead>
    <tbody>
        <tr>
            <td><strong>03:45 PM</strong><br />
              <span class="uk-label">in 1 hrs 0 min</span></td>
            <td><strong>Premium Mansion Tour</strong></td>
            <td>Mansion Circle</td>
            <td><span class="uk-label uk-label-warning">$</span></td>
        </tr>
    </tbody>
</table>


    </div>

    <!-- Menu -->
    <?php include "includes/menu.php"; ?>
  </body>
</html>
