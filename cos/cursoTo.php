<?php

namespace Cos {

    class CursoTo{

        private  $getCursors = [];
        private static $_instance ;


        public static function getInstance(string $file):CursoTO{
            if(self::$_instance === null){
                self::$_instance = new CursoTo($file);
            }
            return self::$_instance;
        }

        public function __construct(string $file){
            $this->getCursors = require($file);
        }

        public function get(string $key):array{
            if(!isset($this->getCursors[$key])){
                return [];
            }
            return $this->getCursors[$key];
        }
    }

}?>