<?php

namespace Stage;

class Set extends Unique implements \IteratorAggregate, \ArrayAccess, \Countable
{
  protected $_store = array();

  public function __set( $index, $value ) {
    $this->offsetSet( $index, $value );
  }

  public function __get( $index )
  {
    return $this->offsetGet( $index );
  }

  // Implementacion IteratorAggregate
  public function getIterator()
  {
    return new \ArrayIterator( $this->_store ) ;
  }

  // Implementacion ArrayAccess
  public function offsetExists( $index )
  {
    return array_key_exists( $index, $this->_store );
  }

  // Implementacion ArrayAccess
  public function offsetGet( $index )
  {
    if( $this->offsetExists( $index ) ) {
      return $this->_store[$index];
    }
  }

  // Implementacion ArrayAccess
  public function offsetSet( $index, $value )
  {
     $this->_store[$index] = $value;
  }

  // Implementacion ArrayAccess
  public function offsetUnset( $index )
  {
      if( $this->offsetExists( $index ) ) {
        unset( $this->_store[$index] );
      }
  }

  // Implementacion Countable
  public function count()
  {
    return count( $this->_store );
  }

  public function getStore()
  {
    return $this->_store;
  }
}
