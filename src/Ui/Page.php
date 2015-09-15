<?php

namespace Stage\Ui;

class Page extends \Stage\Unique
{


  public $assets;

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

}
