<?php
 namespace Cos{
    
    class Dispatcher{

        var $request ;

        public function __construct(){
           
           $this->request = new Request();
           Router::parse($this->request->url, $this->request);
           $controller = $this->loadController();
           
          if ( !in_array ($this->request->action, array_diff (get_class_methods($controller), get_class_methods(get_parent_class($controller)) ) ) )
          {
            $this->error('Controller '.ucfirst($this->request->controller). ' does not have the method '. $this->request->action);
          }

           call_user_func_array(array($controller, $this->request->action) ,$this->request->params);
           $controller->render($this->request->action);

        }

        public function error($message){
            header('HTTP/1.0 404 COS : NOT FOUND ');
            $controller = new Controller($this->request);
            $controller->set('message', $message);
            $controller->render(DS.'/header'.DS.'e404');
            die();
        }
        public function loadController(){

            $name = ucfirst($this->request->controller).'Controller';
            $file = WEBROOT.DS.'controller'.DS.$name.'.php';
            require_once $file;
            $class = '\\Web\\Controller\\'.$name;

            return new $class($this->request);

        }
    }

 }
?>