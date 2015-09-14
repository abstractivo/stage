<?php
ini_set('display_errors', 1) ;
ini_set('error_reporting', E_ALL);

include_once 'vendor/autoload.php';

$config = Stage\Config::getInstance();

$config->site = array(
  'title' => 'Sitio demo',
  'author' => 'Cortado Verde'
);

$config->template = array(
  "base_dir" => __DIR__ . '/' . 'templates'
);

$config->bind('dump', function(){
  $singletonConfig = Stage\Config::getInstance();
  echo '<pre>'. "\n";
  foreach( $singletonConfig AS $key => $value ) {
    echo $key . ': ' . print_r($value, true) . "\n";
  }
  echo '</pre>';
});


$config->fire('dump');


$template = new Stage\Template('home');

$template->widgets = array(
  'menu' => new Stage\Ui\Layer,
  'footer' => new Stage\Ui\Layer
);

$template->widgets['menu']->bind('before_render', function( $layer ) {
  $layer->outPut = '<b>Before Render</b>';
});


$itemsStore = new Stage\Set;
$itemsStore->items = array(
  'Item 1' => 'http://google.com.ar',
  'Item 2' => 'http://taringa.net'
);



$template->widgets['menu']->add( new Stage\Template('component/search') );
$template->widgets['menu']->add( new Stage\Template('component/menu', $itemsStore ) );



$template->articulo = array(
  'titulo' => 'Prueba',
  'contenido' => 'Hola mundo'
);

echo $template;
