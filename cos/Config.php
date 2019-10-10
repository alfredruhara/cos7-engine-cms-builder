<?php
namespace Cos {

    class Config {

        private $settings = [];

        private static $_instance;

        /**  $file : configuration file which return an associative Array  ; SINGLETON */
        public static function getInstance($file){

            if(self::$_instance === null){

                self::$_instance = new Config($file);
            }
            return self::$_instance;

        }
        /** File configuration  */
        public function __construct($file){
            $this->settings = require($file);
        }

        public function get($key){
            if(!isset($this->settings[$key])){
                return null;
            }
            return $this->settings[$key];
        }
    }

}?>