<?php
    namespace Office\System\Entity;

    class CategoryEntity  extends \Cos\Entity\Entity{

        protected  $table = 'category';

        public function getUrl(){

            $hashed_vl = $this->hash('category');

            return 'index.php?vl='. $hashed_vl .'&dif='. $this->crypt_id() ;
        }

        public function getUri(){

            $hashed_vl = $this->hash('index');
            $link  = 'index.php?vl='.$hashed_vl;
            $link .= '&unem='.$this->sys_hash($this->menu_title).$this->crypt_algorithm($this->menu_id);
            $link .= '&tac='.$this->sys_hash($this->title).$this->crypt_algorithm($this->id);
            
            return $link;
            //return 'index.php?vl='.$hashed_vl.'&unem='.$this->menu_id.'&tac='.$this->id;

        }

    }
?>