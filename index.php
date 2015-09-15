<?php
ini_set('display_errors', 1) ;
ini_set('error_reporting', E_ALL);

include_once 'vendor/autoload.php';

$stage = Stage\Stage::getInstance();

$stage->loadConfig(__DIR__.'/stage.config.php');

$stage->engine = new \Mustache_Engine( array(
  "loader" => new \Mustache_Loader_FilesystemLoader( $stage->config['paths']['template'] ),
  "partials_loader" => new Stage\Loader\AliasLoader( $stage->config['paths']['template'], array() )
) );

$stage->page = new Stage\Ui\Page;

$stage->page
  ->setTitle('Pagina de ejemplo')                // title = Pagina de ejemplo
  ->setTitle('Seccion 1', true, ' > ');          // title = Pagina de ejemplo > Seccion 1

$stage->page
  ->setTitle('Pagina de ejemplo')                // title = Pagina de ejemplo
  ->setTitle('Seccion 1', true, ' > ', false );  // title = Seccion 1 > Pagina de ejemplo

echo $stage->engine->render( 'layout', $stage );
