<?php

namespace Cos\Database{
    
    trait __Connectable{
        
        protected $config;

        public function __construct()
        {
            $this->config = Config::getInstance(ROOT.'/office/config/config.php');
            
            if(is_null($this->db_instance))
            {
                    $this->db_instance = new MysqlDatabase(
                    $this->config->get('db_name'),
                    $this->config->get('db_user'), 
                    $this->config->get('db_pass'), 
                    $this->config->get('db_host')
                    ) ;
        
            }
            return $this->db_instance;
        }
        
        public function getDbCredentials(){
            $this->config = Config::getInstance(ROOT.'/office/config/config.php');
        }

    }

}

?>