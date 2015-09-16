<?php
// Carga el bootstrap
require_once __DIR__ .'/../stage.bootstrap.php';

$stage->getPath('css:style.css');


$stage->page
  ->setTitle('Pagina de ejemplo')
  ->addCss('css:style.css')
;

echo $stage->engine->render( 'layout', $stage );
