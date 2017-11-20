<?php

function prefixURL($url,$prefix){
  $path = parse_url($url, PHP_URL_PATH);
  $expand = explode("/",$path);
  $file = end($expand);
  $base = str_replace($file,"",$url);
  return $base.$prefix.$file;
}

function bigtreeArray($var){
  $var = str_replace(']','',str_replace('[','',str_replace('"','',$var)));
  $var = explode(",",$var);
  return $var;
}

function aasort (&$array, $key) {
    $sorter=array();
    $ret=array();
    reset($array);
    foreach ($array as $ii => $va) {
        $sorter[$ii]=$va[$key];
    }
    asort($sorter);
    foreach ($sorter as $ii => $va) {
        $ret[$ii]=$array[$ii];
    }
    $array=$ret;
}

 ?>
