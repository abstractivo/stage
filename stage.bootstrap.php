<?php
// Debug activado mientras este en desarrollo
ini_set('display_errors', 1) ;
ini_set('error_reporting', E_ALL);

// Composer autoload
include_once __DIR__ .'/vendor/autoload.php';

// Instancia de Stage
$stage = Stage\Stage::getInstance();

// Cargar la configuracion
$stage->loadConfig( __DIR__.'/stage.config.php' );

// Setear el engine para renderizacion
$stage->engine = new \Mustache_Engine( array(
  "loader"          => new \Mustache_Loader_FilesystemLoader( $stage->config['paths']['template'] ),
  "partials_loader" => new Stage\Loader\AliasLoader( $stage->config['paths']['template'], array() )
) );

// Define la url base para los assets
$stage->setUrl( Stage\Stage::getBaseUrl( $_SERVER['SCRIPT_NAME'] ) );

// Setea el helper
$stage->page = new Stage\Ui\Page;
