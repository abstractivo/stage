<?php

namespace Stage;

class Template extends Setter
{
  protected $_store;

  protected $baseDir;

  public $template;

  protected $ext = '.php';

  public function __construct( $template = null, Set $store = null )
  {
    if ( is_null( $store ) ) {
      $store = new Set();
    }

    $this->setStore( $store );

    $this->template = $template;

    $config = Config::getInstance();

    if( isset( $config['template']['base_dir'] ) ) {
      $this->setBase( $config['template']['base_dir'] );
    }

  }

  public function setBase( $base )
  {
    $this->baseDir = $base;
    return $this;
  }

  private function getPathTemplate( $template = null )
  {
    if( $template == null && $this->template == null )
      throw new Exception\Template ( "Debe definir el template para poder renderizar", 1);

    return rtrim( $this->baseDir , '/' ) . '/' . $this->getNameFile( $template ) . $this->ext;
  }

  private function getNameFile( $template )
  {
    $tpl = is_null( $template ) ? $this->template : $template;
    $pos = strrpos( $tpl , $this->ext );
    if( $pos !== false ) {
      $tpl = substr_replace( $tpl, '', $pos, strlen($this->ext));
    }
    return $tpl;
  }

  public function render( $template = null, $data = false, $merge = false )
  {
    $file = $this->getPathTemplate( $template );
    if( ! file_exists ( $file ) ) {
      throw new Exception\Template ("No existe el archivo: ". $file , 2);
    }

    if( !in_array( "ob_gzhandler", ob_list_handlers() ) ) {
      ob_start("ob_gzhandler");
    } else {
      ob_start();
    }

    $extract = ! $data ? $this->_store->getStore() : ( $merge == false ? $data : array_merge( $this->_store->getStore(), $data ) );
    $extract['__data__'] = $extract;

    extract( $extract );
    include $file;
    return ob_get_clean();
  }

  public function __toString()
  {
    try {
      return $this->render();
    }catch( Exception\Template $e ) {
      return $e->getMessage();
    }catch( \Exception $e ) {
      return $e->getMessage();
    }
  }

}
