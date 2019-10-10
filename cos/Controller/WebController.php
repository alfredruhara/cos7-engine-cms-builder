<?php
    namespace Cos\Controller{

        class WebController{

            protected $viewPath;
            protected $template = DS.'materialize'.DS.'index';
        
            protected function render($view, $variabes = []){
              
        
              # var_dump($this->viewPath.str_replace('.', DS , $view). '.php');

              extract($variabes);
        
              ob_start();
              require($this->viewPath.str_replace('.', DS , $view). '.php');
              $layout = ob_get_clean();
              
              require($this->viewPath.'templates'.DS.$this->template.'.php');
             
            }

            protected  function notFound(){
                header("HTTP/1.0 404 Not found");
                header('location:index.php?p=post.e403');
            }
        
            protected function forbidden(){
            header("HTTP/1.0 403 Forbidden");
            // die("access denied");
            header('location:index.php?p=post.e403');
            }
        

        }

    }

?>