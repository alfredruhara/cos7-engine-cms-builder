<?php

    namespace Cos\Interfaces;

    interface sessionInterface {

        public function get(string $key) ;

        public function set(string $key, $value) : void ;

        public function delete(string $key) : void ; 

        public function exist(string $key) : ? string; 
        
    }

?>