<?php

include_once 'vendor/autoload.php';

$object = new Stage\Object();

$object->bind('test', function(){
  echo 'hola mundo';
});

// $object->fire('test');
$object->invoke('fire', array('test'));
