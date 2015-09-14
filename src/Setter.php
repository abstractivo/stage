<?php

namespace Stage;

class Setter
{
  protected $_store;

  public function setStore( Set $store )
  {
    $this->_store = $store;
  }

  public function __set( $index, $value ) {
    $this->_store->offsetSet( $index, $value );
  }

  public function __get( $index )
  {
    return $this->_store->offsetGet( $index );
  }
  
}
