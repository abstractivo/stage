<?php

namespace Stage\Exception;

/**
 * Define la excepcion Root de la abstracción, desde el punto de control
 * principal que podemos hacer desde que ingresa la solicitud del usuario
 */
class Stage extends \Exception {

  /**
   * Devuelve una cadena con el nombre de la clase instanciada que arroja el error_log
   * el codigo de mensaje y el mensaje
   * @return string
   */
  public function __toString() {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
  }

}
