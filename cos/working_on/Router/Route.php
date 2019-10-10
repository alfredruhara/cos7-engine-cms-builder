<?php

namespace Cos\Router {


    class Route
    {
        private $path;
        private $callable;

        /**
         * Route constructor.
         * @param $path
         * @param $callable
         */
        public function __construct($path, $callable)
        {
            $this->path = $path;
            $this->callable = $callable;
        }

        public function match($url){
            $url = trim($url, '/');
            $path = preg_replace('#:([\w]+)#', '([^\]+)', $this->path);

            var_dump($path);
            die();
        }
    }
}