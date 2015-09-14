<?php

namespace Stage;

/**
 * Singleton class
 */
class Unique extends Object
{
  // Coleccion de instancias
  private static $_instances = array();

  // Genera la instancia del objeto
  public static function getInstance()
  {
    $class = get_called_class();

    if( array_key_exists( $class, self::$_instances ) === false ) {
      try {
        self::$_instances[$class] = new $class;
      } catch ( \Exception $e ) {
        throw new Exception\Unique("No se puede cargar la clase " . $class, 1);        
      }
    }

    return self::$_instances[$class];
  }
}
