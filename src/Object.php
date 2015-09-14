<?php

namespace Stage;

/**
 * Un objeto es la principal abstraccion que da vida al sistema,
 * todo va a extender de Object y obtendra las propiedades y motodos
 * que permitan interactuar con otros objetos.
 *
 * Los objectos gestionan eventos y callbacks que pueden ser invocados en distintos
 * puntos del tiempo de ejecucion
 */
class Object
{

  /**
   * Callbacks reservados, no se puede reescribir su definicion
   */
  protected $_reservedObjectMethods = array( 'setCallback', 'bind', 'unbind', 'bindOne', 'fire' );

  protected $callbacks = array();

  protected $_events = array();

  public function __construct()
  {
    $ref = $this;

    $this->callbacks = array(
        // Agrega un callback a la lista de procesador del objeto
        // por ejemplo
        // $obj->setCallback('test', 'fn' ) | $obj->test() => invoke( $obj->callbacks['test']() )
        'setCallback' => function( $name = null, $callback = null ) use ( $ref ) {
            if( is_null( $name ) )
              throw new Exception\Object("No se definio un nombre para el callback", 1);

            if ( ! in_array( $name, $ref->_reservedObjectMethods ) ) {
              $ref->callbacks[$name] = $callback;
            }
        },

        // Listener de eventos
        'bind' => function( $name = null, $callback = null, $order = 0 ) use ( $ref ) {
          if( $name === null )
            throw new Exception\Object("No se definio un evento", 2);

          $ref->_events[$name][$order] = $callback;

        },

        // Ejecutar evento
        'fire' => function( $name = null ) use ( $ref ) {
          if( $name === null )
            throw new Exception\Object ("No se ha definido un nombre para ejecutar un disparador", 3);

          if( isset( $ref->_events[$name] ) ) {
            $args = func_get_args();
            array_shift($args); // Quitar el primer argumento ( $name );
            ksort($ref->_events[$name]);

            foreach( $ref->_events[$name] AS $order => $callback ) {
              call_user_func_array( $callback, $args );
            }
          }
        }


    );

  }

  /**
   * Ejectua un callback definido por el usuario
   */
  public function invoke ( $name, $args = array() )
  {

    // Probamos si el metodo se puede invocar
    // mediante la clase Reflection
    try {
      $method = new \ReflectionMethod ( get_called_class(), $name );
      $method->setAccesible(true);
      $method->invokeArgs($this, $args);
    } catch( \ReflectionException $eR ) {
      if ( isset( $this->callbacks ) && is_array( $this->callbacks ) && isset ( $this->callbacks[$name] ) ) {

        try {
          call_user_func_array( $this->callbacks[$name] , $args );
        } catch ( \Exception $e ) {
          throw new Exception\Object("No se puede ejecutar el metodo:" . $name, 4);
        }
      } else {
        throw new Exception\Object('El metodo ' . $name . ' no pude ser invocado', 5);
      }
    } catch ( Exception\Object $e ) {
      throw new Exception\Object('El metodo ' . $name . ' no pude ser invocado', 6);
    } catch ( \Exception $e ) {
      throw new Exception\Object('No se puede invocar ' . $name , 7);
    }

  }


  /**
   * Metodo magico
   *
   * Invoca un callback previamente definido
   */
  public function __call( $name, $arguments )
  {
    try {
      $this->invoke($name, $arguments);
    } catch ( Exception\Object $e ) {
      echo $e;
    }
  }




}
