<?php
    namespace Web\System\Entity;

    class CategoryEntity  extends \Cos\Entity\Entity{

        protected  $table = 'category';

        public function getUrl(){

            $hashed_vl = $this->hash('category');

            return 'index.php?vl='. $hashed_vl .'&dif='. $this->crypt_id() ;
        }

        public function getUri(){

            //return 'hello';
            
            $hashed_vl = $this->hash('index');
            $link  = 'index.php?vl='.$hashed_vl;
            $link .= '&unem='.$this->menu_title.'-'.$this->crypt_algorithm($this->menu_id);
            $link .= '&tac='.$this->title.'-'.$this->crypt_algorithm($this->id);
            
            return $link;
            //return 'index.php?vl='.$hashed_vl.'&unem='.$this->menu_id.'&tac='.$this->id;

        }

    }
?>