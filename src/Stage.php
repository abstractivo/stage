<?php

namespace Stage;

class Stage extends Unique
{

  public function loadConfig( $pathFile )
  {
    if( ! file_exists( $pathFile ) )
      throw new Exception\Config( "No se puede cargar la configuracion del sistema ({$pathFile})", 1);

    $config = require_once( $pathFile );

    if( !is_array( $config ) )
      throw new Exception\Config( "Error al procesar el archivo de configuración, debe ser un array valido", 2);

    $this->config = $config;

    return $this;


  }

  public static function getBaseUrl( $path )
  {
    $b = dirname( $path );
    if( strlen( $b ) == '1' ) return '';
    return $b;
  }

  public function setUrl( $url )
  {
    $this->base = $url;
    return $this;
  }


  public static function getPath( $path )
  {
    // template:loquesea
    // css:loquesea
    // js:loquesea
    $stage = self::getInstance();

    $newPath = $path;
    if( ( $pos = strpos($path, ':')) !== false ) {
      $index = substr($path, 0, $pos);
      if( isset( $stage->config['paths'][$index] ) ) {
        $newPath = $stage->config['paths'][$index] . '/' . substr( $path, $pos +1 , strlen($path) );
      }
    }
    return $newPath;
  }

  public static function getUrl( $path )
  {
    $stage = self::getInstance();
    return str_replace( $stage->config['__DIR__'], $stage->base , $path );
  }

}
