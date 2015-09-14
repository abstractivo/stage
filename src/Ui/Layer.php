<?php

namespace Stage\Ui;

use Stage\Unique;

class Layer extends Unique
{
  private $queue = array();

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
    $strOut = '';
    if( empty( $this->queue ) ) return $strOut;

    foreach( $this->queue AS $priority => $elements )
    {
      $strOut .= '<!-- Set prioridad #'. $priority ."-->\n";
      foreach( $elements as $index => $element ) {
        $strOut .= "\t<!-- Elemento index #". $index . "-->\n"
                . $element
                . "\n\n";

      }
    }

    return $strOut;
  }
}
