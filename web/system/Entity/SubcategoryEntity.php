<?php
    namespace Web\System\Entity;

    class SubcategoryEntity  extends \Cos\Entity\Entity{
        public function getUrl(){
            
            $hashed_vl = $this->hash('index');
            $link  = 'index.php?vl='.$hashed_vl;
            $link .= '&unem='.$this->menu_title.'-'.$this->crypt_algorithm($this->s_menu_id);
            $link .= '&tac='.$this->cat_title.'-'.$this->crypt_algorithm($this->cat_id);
            $link .= '&bus='.$this->title.'-'.$this->crypt_algorithm($this->id);

            return $link;   
        }
    }
?>