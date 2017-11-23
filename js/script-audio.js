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
