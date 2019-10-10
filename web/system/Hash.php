<?php

  namespace Web\System;

  class Hash{

    private  $unhashed = [];
    private static $_instance ;


    public static function getInstance($file){
        if(self::$_instance === null){
            self::$_instance = new Hash($file);
        }
        return self::$_instance;
    }

    public function __construct($file){
        $this->unhashed = require($file);
    }

    public function get($key){
        if(!isset($this->unhashed[$key])){
           return null;
        }
        return $this->unhashed[$key];
    }
  }


?>