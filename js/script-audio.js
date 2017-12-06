$(function(){
    $("audio").on("play", function() {
        $("audio").not(this).each(function(index, audio) {
            audio.pause();
        });
    });
});




$(".uk-close-large").bind( "click", function() {
  $("audio").each(function(index, audio) {
      audio.pause();
  });
});

function showDirections(id,slat,slong,elat,elong){
  $("#"+id).html( '<p class="uk-text-bold uk-text-uppercase">Directions</p><iframe src="//www.mountvernon.org/site/turn-by-turn/?slat='+slat+'&slong='+slong+'&elat='+elat+'&elong='+elong+'" width="100%; height="250"></iframe>');
}


$( ".directions" ).bind( "click", function() {
    var id = $(this).attr("id");
    var elat = $(this).attr("lat");
    var elong = $(this).attr("long");
    navigator.geolocation.getCurrentPosition(function(location) {
      showDirections(id,location.coords.latitude,location.coords.longitude,elat,elong);
    })
});
