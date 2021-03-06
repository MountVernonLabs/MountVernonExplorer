// functions
function filterExplorer(){
  if ($("#explore-filter").val() != ""){
    $(".type-all").hide();
    $(".type-"+$("#explore-filter").val()).show();
  } else {
    $(".type-all").show();
  }
}

$("#explore-filter").on('change',function(){
   filterExplorer();
});

$( ".directions" ).bind( "click", function() {
  $(this).html( '<p class="uk-text-bold uk-text-uppercase">Directions</p><iframe src="//www.mountvernon.org/site/turn-by-turn/?slat='+window.latitude+'&slong='+window.longitude+'&elat='+$(this).attr("lat")+'&elong='+$(this).attr("long")+'" width="100%; height="250"></iframe>');
});

function prefixURL(url,prefix){
  var filename = url.substring(url.lastIndexOf('/')+1);
  var newurl = url.slice(0, -filename.length) + prefix + filename;
  return newurl;
}

// Setup the Open Street Map Viz
var projection = ol.proj.get('EPSG:3857');
var view = new ol.View({
  center: [0, 0],
  projection: projection,
  extent: projection.getExtent(),
  zoom: 18
});

  var map = new ol.Map({
    layers: [
      new ol.layer.Tile({
        source: new ol.source.OSM()
      })
    ],
    target: 'map',
    controls: ol.control.defaults({
      attributionOptions: /** @type {olx.control.AttributionOptions} */ ({
        collapsible: false
      })
    }).extend([
      new ol.control.FullScreen()
    ]),
    view: view
  });

  // Enable geolocation tracking
  var geolocation = new ol.Geolocation({
      projection: map.getView().getProjection(),
      tracking: true,
      trackingOptions: {
        enableHighAccuracy: true,
        maximumAge: 500
      }
    });

    var iconStyle = new ol.style.Style({
      image: new ol.style.Icon({
        anchor: [22, 22],
        anchorXUnits: 'pixels',
        anchorYUnits: 'pixels',
        opacity: 1.0,
        src: './img/geolocation_marker.png'
         })
        });

  // add an empty iconFeature to the source of the layer
    var iconFeature = new ol.Feature();
    var iconSource = new ol.source.Vector({
      features: [iconFeature]
    });
    var iconLayer = new ol.layer.Vector({
      source: iconSource,
      style : iconStyle
    });
    map.addLayer(iconLayer);


    // Grab Mount Vernon Locations API data
    var mvloc;
    $.getJSON("https://www.mountvernon.org/site/api/locations", function(jsonloc){
          mvloc = jsonloc;
        });


    // When location changes perform these functions
    geolocation.on('change', function() {
      var pos = geolocation.getPosition();
      iconFeature.setGeometry(new ol.geom.Point(pos));
      view.setCenter(pos);
      var cord = ol.proj.transform([pos[0], pos[1]], 'EPSG:3857','EPSG:4326');

      // Calculates distnace from one lat/long
      function calculateDistance(lat1, lon1, lat2, lon2, unit) {
              var radlat1 = Math.PI * lat1/180
              var radlat2 = Math.PI * lat2/180
              var radlon1 = Math.PI * lon1/180
              var radlon2 = Math.PI * lon2/180
              var theta = lon1-lon2
              var radtheta = Math.PI * theta/180
              var dist = Math.sin(radlat1) * Math.sin(radlat2) + Math.cos(radlat1) * Math.cos(radlat2) * Math.cos(radtheta);
              dist = Math.acos(dist)
              dist = dist * 180/Math.PI
              dist = dist * 60 * 1.1515
              if (unit=="K") { dist = dist * 1.609344 }
              if (unit=="N") { dist = dist * 0.8684 }
              return dist
          }

      // Go through all of the locations API returned data and calcualte disntace from current position
      for ( i = 0; i < mvloc.length; i++) {
              mvloc[i]["distance"] = calculateDistance(cord[1],cord[0],mvloc[i]["latitude"],mvloc[i]["longitude"],"N");
      }

      window.longitude = cord[0];
      window.latitude = cord[1];
      // calculate distance from Mount Vernon and if you are more than 4 miles out show a welcome splash screen
      var distanceaway = calculateDistance(cord[1],cord[0],38.71028,-77.08623,"N");
      //$('#miles').text("You are currently "+Math.round(distanceaway * 10) / 10+" miles from Mount Vernon.");

      //if (distanceaway < 3){
        //$('#miles').text("Welcome");
        //$('#bounds').delay( 1000 ).fadeOut("slow");
      //}

      // Sort locations array data based on new calculated positions
      mvloc.sort(function(a, b) {
          return a.distance - b.distance;
        });

      // Display nearby locations in the UI
      $("#locations-list").html("");
      $("#loading").hide();
      $.each(mvloc, function(i, field){
          if (field.type != "room" && field.type != "gallery") {
            // Populate the list
            var thisitem = "<tr uk-toggle=\"target: #location"+field.id+"\" class=\"uk-padding-remove type-all type-"+field.type+"\">";
            thisitem = thisitem+"<td class=\"uk-padding-small uk-padding-remove-right mv-list-image\"><a href=\"#location"+field.id+"\" uk-toggle><img class=\"uk-thumbnail-mini\" src=\"" + prefixURL(field.image,"sml_") + "\"></a></td>";
            thisitem = thisitem+"<td class=\"uk-text-bold uk-padding-small\">"+field.title+"</td>";
            if (field.distance > 1){
              thisitem = thisitem+"<td class=\"uk-text-small uk-text-center\"><span class=\"uk-text-bold\">"+Math.round(field.distance * 10) / 10+"</span><br>miles</td>";
            } else {
              thisitem = thisitem+"<td class=\"uk-text-small uk-text-center\"><span class=\"uk-text-bold\">"+Math.round(field.distance*5280)+"</span><br>feet</td>";
            }
            thisitem = thisitem+"</tr>";
            $("#locations-list").append(thisitem);
          }
      });
      filterExplorer();


    });
