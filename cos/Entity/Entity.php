<?php
    namespace Cos\Entity;
      
    class Entity{
        
        # hasing sysyem 
        protected function sys_hash(string $value) : string 
        {
            return $value;
        }
        
        public function hash(string $key) : ?string
        {
            $value = \Web\System\Hash::getInstance(ROOT.'/web/config/hash.php');
            return $value->get($key);
        }
    
        protected function crypt_algorithm(int $id) : int 
        {
          
            //Encrypting process 
            $step_1 = $id * 47 ;
            $step_2 = $step_1 * 4;
            $step_3 = $step_2 + 56;

            return $step_3;
        }

        protected function crypt_id()
        {
            # $this->sys_hash("cos").
            $id= (int)$this->id;
            return str_replace(' ','-',trim($this->title)).'-'.$this->crypt_algorithm($id);
        }        

        public function __get($key)
        {
            $method = 'get'.ucfirst($key);
            $this->$key = $this->$method();
            return $this->$key;
        
        }

        public function getMedia_url()
        {
            $path = '../datas/';
            return $path.$this->media_file;
        }
 
    }

?>