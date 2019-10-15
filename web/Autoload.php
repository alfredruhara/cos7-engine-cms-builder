<?php
namespace Web;

class Autoload{

  const DS = DIRECTORY_SEPARATOR;
 
  public static function register(){
     spl_autoload_register([__CLASS__, 'autoload']);
  }

  public static function autoload($class){

    if(strpos($class,__NAMESPACE__) === 0 )
    {
        $class = str_replace(__NAMESPACE__.self::DS, '', $class);
        $class = str_replace('\\', self::DS , $class);
        
        //require dirname(__DIR__).self::DS.$class.'.php';  - Linux/ Unix 
        require __DIR__.'/'.$class.'.php';
              
    }

  }

}

?>