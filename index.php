<?php
// Carga el bootstrap
require_once __DIR__ .'/stage.bootstrap.php';

$stage->getPath('css:style.css');


$stage->page
  ->setTitle('Pagina de ejemplo')
  ->addCss('css:style.css')
  ->addJs('js:1.js')
  ->addJs('js:2.js')
;

echo $stage->engine->render( 'layout', $stage );
