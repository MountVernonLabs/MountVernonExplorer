<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<link rel="stylesheet" href="./lib/uikit/css/uikit.min.css" />
<link rel="stylesheet" href="./lib/ol/ol.css" type="text/css">
<link rel="stylesheet" href="./css/style.css?v1.85" type="text/css">
<script src="./lib/uikit/js/uikit.min.js"></script>
<script src="./lib/uikit/js/uikit-icons.min.js"></script>
<script src="./lib/ol/ol.js"></script>

<?php

function prefixURL($url,$prefix){
  $path = parse_url($url, PHP_URL_PATH);
  $expand = explode("/",$path);
  $file = end($expand);
  $base = str_replace($file,"",$url);
  return $base.$prefix.$file;
}

 ?>
