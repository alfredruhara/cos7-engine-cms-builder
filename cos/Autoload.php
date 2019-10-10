<?php
namespace Cos {

    class Autoload
    {

        const DS = DIRECTORY_SEPARATOR;

        public static function register()
        {
            //  var_dump(__NAMESPACE__);
            spl_autoload_register([__CLASS__, 'autoload']);
        }

        /*
         * Inclue le fichier correspondant a la class
         * @param $class string . lee nom de la class a charger
         */
        public static function autoload($class)
        {

            if (strpos($class, __NAMESPACE__) === 0) {
                $class = str_replace(__NAMESPACE__ . self::DS, '', $class);
                $class = str_replace('\\', DIRECTORY_SEPARATOR , $class);
                //var_dump($class);
                //print(__DIR__.'/'.$class.'.php<br/>');
                require dirname(__DIR__).self::DS.$class.'.php';

            }
        }

    }

}
?>