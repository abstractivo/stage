<?php

namespace Stage\Ui;

class Page extends \Stage\Unique
{


  public $assets = array('css' => array(), 'js' => array());

  public $title = 'Hola mundo';

  public function setTitle( $newTitle, $append = false, $delimitador = ' : ', $after = true ) {
    $this->title =
      ! $append
        ?
          $newTitle
        : (
          ! $after
            ?
              $newTitle . $delimitador . $this->title
            :
              $this->title . $delimitador . $newTitle
        )
    ;

    return $this;

  }


  public function addCss( $path, $options = false )
  {
    $realPath = \Stage\Stage::getUrl( \Stage\Stage::getPath( $path ) );
    $this->assets['css'][] = array(
      'src' => $realPath,
      'attrs' => $options
    );
    return $this;
  }

  public function addJs( $path, $append = true )
  {
    $realPath = \Stage\Stage::getUrl( \Stage\Stage::getPath( $path ) );
    $data = array(
      'src' => $realPath
    );

    if( $append )
      array_push( $this->assets['js'], $data);
    else
      array_unshift( $this->assets['js'], $data );

    return $this;
  }

}
