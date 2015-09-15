<?php

namespace Stage;

class Stage extends Unique
{

  public function loadConfig( $pathFile )
  {
    if( ! file_exists( $pathFile ) )
      throw new Exception\Stage( "No se puede cargar la configuracion del sistema ({$pathFile})", 1);

    $config = require_once( $pathFile );

    if( !is_array( $config ) )
      throw new Exception\Stage( "Error al procesar el archivo de configuración, debe ser un array valido", 2);

    $this->config = $config;

    return $this;  


  }

}
