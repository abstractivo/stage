<?php

namespace Stage\Ui;

use Stage\Unique;

class Layer extends Unique
{
  private $queue = array();

  public $outPut = '';

  public function add( $element, $priority = 0 )
  {
    $this->queue[$priority][] = $element;
    ksort( $this->queue );
  }

  public function remove( $index, $priority = 0 )
  {
    if( isset( $this->queue[$priority][$index] ) ) {
      unset( $this->queue[$priority][$index] );
    }
    ksort( $this->queue );
  }

  public function display()
  {
    if( empty( $this->queue ) ) return $this->outPut;

    foreach( $this->queue AS $priority => $elements )
    {

      $this->fire('before_render', $this );
      $this->outPut .= '<!-- Set prioridad #'. $priority ."-->\n";
      foreach( $elements as $index => $element ) {
      $this->outPut .= "\t<!-- Elemento index #". $index . "-->\n"
                . $element
                . "\n\n";
      }
    }

    return $this->outPut;
  }
}
