<?php
 # 12 / 02 / 2019 :  This feature has been already being in used in the system  - chada

 namespace Cos{
    
    class Controller{
        
        public $request;
        public $variables = [];
        private $is_rendered = false ;

        public function __construct($request){
            $this->request = $request;
        }

        public function set($key, $val = null){
            if(is_array($key)){
                $this->variables += $key;
            }else{
                $this->variables[$key] = $val;
            }
        }
        public function render($view){  

            if($this->is_rendered){
                return false;
            }
            extract($this->variables);
            
            if (strpos($view, ''.DS.'') === 0){
                $view = WEBROOT.DS.'view'.DS.$view.'.php';
            }else{
                $view = WEBROOT.DS.'view'.DS.$this->request->controller.DS.$view.'.php';
            }
            
            ob_start();
            require $view;
            $layout = ob_get_clean();

            require WEBROOT.DS.'view'.DS.'templates'.DS.'materialize'.DS.'index.php';
            $this->is_rendered = true;

        }
            
    }

 }
?>