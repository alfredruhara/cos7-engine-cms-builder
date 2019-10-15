<?php
namespace Office\System;

class Autoload{

  const DS = DIRECTORY_SEPARATOR;
 
  public static function register() : void 
  {
     spl_autoload_register([__CLASS__, 'autoload']);
  }

  /*
   * Inlcude le fichier correspondant a la class
   * @param $class string
   */
   public static function autoload(string $class) : void 
   {

    if(strpos($class,__NAMESPACE__) === 0 ){
      $class = str_replace(__NAMESPACE__.self::DS, '', $class);
      $class = str_replace('\\', DIRECTORY_SEPARATOR , $class);
      
      // require dirname(__DIR__,2).self::DS.$class.'.php';  - Linux / unix
      require __DIR__.'/'.$class.'.php';
    }

   }

}

 ?>
