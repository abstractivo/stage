<?php

namespace Stage\Loader;

/**
 * Loader para mustache, permite tener alias en los templates
 * ejemplo
 * {{> Content }}
 * (new AliasLoader)->set('Content', 'pathToFile' )
 */
class AliasLoader extends \Mustache_Loader_FilesystemLoader
{
  // Coleccion de alias que se utilizaran para evaluar la expresion de los partials
  private $aliases = null;

  // Setea los alias y construye el loader de Mustache
  public function __construct( $baseDir, $alias = array(), $options = array() )
  {
    $this->setAliases( $alias );
    parent::__construct( $baseDir, $options );
  }

  // Devuelve la vista parcial ( partial mustache )
  public function load( $name )
  {
    if( $this->aliases == null) {
      return parent::load( $name );
    }

    if( array_key_exists( $name,  $this->aliases ) ) {
      $name = $this->aliases[$name];
    }

    return parent::load( $name );
  }

  // Crea una nueva regla de alias para el loader
  public function set( $name , $realPath, $overwrite = true )
  {
    if( ! $overwrite && array_key_exists( $name, $realPath ) )  return;

    $this->aliases[$name] = $realPath;
  }


  // Define todos los alias, con la opcion merge ( segundo parametro, permite adicionar a los previamente seteados )
  public function setAliases( array $aliases, $merge = false )
  {
      if( $merge ) {
        $aliases = array_merge( (array) $this->aliases, (array) $aliases );
      }
      $this->aliases = $aliases;
  }


}
