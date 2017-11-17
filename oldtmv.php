<html class=" js flexbox flexboxlegacy no-touch history rgba multiplebgs backgroundsize cssanimations csscolumns cssgradients csstransforms csstransforms3d csstransitions generatedcontent video audio svg">
  <head>
    <link rel="stylesheet" type="text/css" href="/css/site.css">
    <link rel="stylesheet" href="//cloud.typography.com/6282272/802984/css/fonts.css" media="all">
    <style>
      td .subtext { color: #6C6054; font-style: italic; font-size: 0.875rem; font-family: "Mercury Text G1 A", "Mercury Text G1 B", Georgia, serif; font-weight: normal; margin:0px;}

      td .upcharge { color: #6C6054; font-size: 0.875rem; font-weight: normal; margin:0px;}

    </style>
  </head>
  <body class="gridlock shifter ui_red wallpaper-inititalized">
    <div class="shifter-page" style="min-height: 1024px;">
      <div class="shim">
        <div class="page">
          <div class="row">
            <div class="mobile-full tablet-full desktop-12 page_content">
              <h2>Today's Events</h2>
              <p class="subtext">Tickets for speciality tours ($) are available at the Guest Services desk</p>
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
                          "time" => $event["start_time"]
                        );
                array_push($all, $item);

                $extra_times = json_decode($event["extra_times"], true);
                foreach ($extra_times as $times){
                  $item = array(
                            "title" => $event["title"],
                            "ticket_link" => $event["ticket_link"],
                            "description" => strip_tags($event["description"]),
                            "location" => $venue[$event["location"]],
                            "time" => $times["start_time"]
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
              <table>
                <thead>
                  <td style="width:140px;">Time</td>
                  <td>Event</td>
                  <td>Fee</td>
                  <td>Location</td>
                </thead>

                <?
                // Print out newly sorted array
                while (list($key, $event) = each($all)) {
                    $future_date = new DateTime(date('Y-m-d h:i a', strtotime(date('Y-m-d')." ".$event["time"])));
                    $interval = $future_date->diff($now);

                  if ($event["ticket_link"] != ""){
                    $upcharge = "$";
                  } else {
                    $upcharge = "FREE";
                  }

                  if ($future_date >= $now){
                      echo "<tr>";
                      echo "<td>".date('h:i a', strtotime($event["time"]))."<p class=\"subtext\">".$interval->format("in %h hrs\n %i min")."</p></td>";
                      echo "<td>".$event["title"]."<p class=\"subtext\">".$event["description"]."</p></td>";
                      echo "<td><span class=\"upcharge\">".$upcharge."</span>";
                      echo "<td>".$event["location"]."</td>";
                      echo "</tr>";
                    }

                }
                ?>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
