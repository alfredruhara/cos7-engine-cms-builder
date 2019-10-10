<?php
    
    namespace Web\System;
    use \System;

    class SystemController extends \Cos\Controller\WebController{

        protected $viewPath ;
        protected $System ;
        protected $variables = [];

        # Menu
        protected $active_menu ;
        protected $menu_list = [];

        public function __construct(){
           
            $this->System =  System::getInstance();
            $this->viewPath = WEBROOT.DS.'view'.DS;
            $this->loadModel('menu');
        }

        protected function loadModel($model_name){

            $this->$model_name =$this->System->getTable($model_name);
           
        }

        protected function engine_menu() : void {
            
            $menu_list = $this->menu->menu();
            
            if($menu_list  != [] AND !isset($_GET['unem']) )
            {
                $this->active_menu  = $menu_list[0]->id ;
                $this->menu_list    = $menu_list; 

            }else if ( $menu_list  != [] AND isset($_GET['unem'])  )
            {
                $returned_menu_id = $this->System->extract_end($_GET['unem']);
                if ( $returned_menu_id ) {
                    foreach ($menu_list as $menu_key)
                    { 
                        if ( $returned_menu_id === (int)$menu_key->id) {
                            $this->active_menu = $returned_menu_id;
                            $this->menu_list    = $menu_list; 
                            break;
                        }
                    }
                }
            }

        }


        public function set_variables_to_send($key, $val = null){
            if(is_array($key)){
                $this->variables += $key;
            }else{
                $this->variables[$key] = $val;
            }
        }
    
    }


?>