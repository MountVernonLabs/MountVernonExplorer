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

      <?php
      $all = array();
      $now = new DateTime();
      date_default_timezone_set('America/New_York');
      // Use the line below to test other times
      //$now = new DateTime('2017-08-14 10:00:00');

      // Read today's events from the API
      $json = file_get_contents('http://www.mountvernon.org/site/api/events-today');
      $data = json_decode($json, true);

      // Store a list of locations
      $json = file_get_contents('http://www.mountvernon.org/site/api/locations');
      $locations = json_decode($json, true);
      foreach ($locations as $location){
        $venue[$location["id"]] = $location["title"];
      }

      // Compile an array of all of the times of the day
      foreach ($data as $event){
        $item = array(
                  "title" => $event["title"],
                  "ticket_link" => $event["ticket_link"],
                  "description" => strip_tags($event["description"]),
                  "location" => $venue[$event["location"]],
                  "time" => $event["start_time"],
                  "route" => $event["route"],
                );
        array_push($all, $item);

        $extra_times = json_decode($event["extra_times"], true);
        foreach ($extra_times as $times){
          $item = array(
                    "title" => $event["title"],
                    "ticket_link" => $event["ticket_link"],
                    "description" => strip_tags($event["description"]),
                    "location" => $venue[$event["location"]],
                    "time" => $times["start_time"],
                    "route" => $event["route"],
                  );
          array_push($all, $item);
        }

      }

      // Sort the array by time of day
      function cmp($a, $b)
      {
          return strcmp($a["time"], $b["time"]);
      }
      usort($all, "cmp");

      ?>
      <table class="uk-table uk-table-striped uk-table-small uk-text-small">
        <thead>
            <tr>
                <th>Time</th>
                <th>Tour</th>
                <th></th>
            </tr>
        </thead>
      <tbody>

        <?
        // Print out newly sorted array
        while (list($key, $event) = each($all)) {
            $future_date = new DateTime(date('Y-m-d h:i a', strtotime(date('Y-m-d')." ".$event["time"])));
            $interval = $future_date->diff($now);

          if ($event["ticket_link"] != ""){
            $upcharge = " <span class=\"uk-label uk-label-primary\">$</span>";
            $ticketinfo = "<p class=\"uk-text-meta\">This tour requires a ticket in addition to general admission. <a href=\"http://www.mountvernon.org/plan-your-visit/tours-activities/".$event["route"]."\"></p><button class=\"uk-button uk-button-primary\">BUY TICKETS</button></a>";
          } else {
            $upcharge = " ";
            $ticketinfo = "<p class=\"uk-text-meta\">Included with general admission, no ticket purchase is required.</p>";
          }

          if ($future_date >= $now){
              echo "<tr uk-toggle=\"target: #".$event["route"]."\">";
              echo "<td class=\"uk-text-nowrap\">".date('h:i a', strtotime($event["time"]))."</td>";
              echo "<td><span class=\"uk-text-bold\">".$event["title"]."</span><span class=\"upcharge\">".$upcharge."</span><br>".$event["description"]."</td>";
              echo "<td><span uk-icon=\"icon: info\"></span></td>";
              echo "</tr>";
              echo "<div id=\"".$event["route"]."\" class=\"uk-modal-full\" uk-modal>";
              echo "<div class=\"uk-modal-dialog\" uk-height-viewport>";
              echo "<button class=\"uk-modal-close-full uk-close-large\" type=\"button\" uk-close></button>";
              echo "<div class=\"uk-padding-large\">";
              echo "<h3>".$event["title"]."</h3>";
              echo "<p class=\"uk-text-uppercase\">Location: <strong>".$event["location"]."</strong></p>";
              echo "<p class=\"subtext\">".$event["description"]."</p>";
              echo "$ticketinfo";
              echo "</div></div></div>";
            }

        }
        ?>
      </tbody>
      </table>
    </div>

    <a href="http://www.mountvernon.org/calendar" target="_blank"><button class="uk-button uk-margin-top uk-margin-small-left uk-button-primary">VIEW FULL CALENDAR</button></a>

    <!-- Menu -->
    <?php include "includes/menu.php"; ?>
  </body>
</html>
