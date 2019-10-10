<?php
    namespace Web\System\Entity;

    class MenuEntity  extends \Cos\Entity\Entity{

        public function getUrl(){
             $hashed_vl = $this->hash('index');
             return 'index.php?vl='.$hashed_vl.'&unem='.$this->menu.'-'.$this->crypt_algorithm($this->id);
        }
        
    }
?>