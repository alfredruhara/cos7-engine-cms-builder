<?php
 namespace Cos{
    
    class Request{

        public $url ; # Url called

        public function __construct(){
           $this->url = $_SERVER['PATH_INFO'];
        }

    }

 }
?>