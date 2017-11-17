function filterPlants() {
  $(".plant-card").hide();
  var filters = "";
  $( ".filter-checkbox" ).each(function( index ) {
    if ($(this).is(":checked")){
      filters = filters+"."+$( this ).attr("id");
    }
  });
  $(filters).show();
  $(".clear-filter").show();
}

function clearFilter(){
  $(".plant-card").show();
  $( ".filter-checkbox" ).each(function( index ) {
    $(this).attr('checked', false);
  });
  $(".clear-filter").hide();
}

$( ".filter-checkbox" ).bind( "click", function() {
  filterPlants();
});

$( ".clear-filter" ).bind( "click", function() {
  clearFilter();
});

$("#sponsor").delay(6400).fadeOut(800);
