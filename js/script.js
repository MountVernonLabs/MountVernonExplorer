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
    }),
    view: view
  });
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



    var mvloc;
    $.getJSON("https://www.mountvernon.org/site/api/locations", function(jsonloc){
          mvloc = jsonloc;
        });



    geolocation.on('change', function() {
      var pos = geolocation.getPosition();
      iconFeature.setGeometry(new ol.geom.Point(pos));
      view.setCenter(pos);
      var cord = ol.proj.transform([pos[0], pos[1]], 'EPSG:3857','EPSG:4326');

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

      for ( i = 0; i < mvloc.length; i++) {
              mvloc[i]["distance"] = calculateDistance(cord[1],cord[0],mvloc[i]["latitude"],mvloc[i]["longitude"],"K");
      }

      mvloc.sort(function(a, b) {
          return a.distance - b.distance;
        });

      $("#locations").html("");
      $.each(mvloc, function(i, field){
          $("#locations").append("<li>" + field.title + "</li>");
      });

    });
