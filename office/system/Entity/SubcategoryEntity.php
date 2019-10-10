<?php
    namespace Office\System\Entity;

    class SubcategoryEntity  extends \Cos\Entity\Entity{

       

        public function getUrl(){
            /**
             * GET['vl'] = page to load - 
             * GET['dif']= id 
             */
           // $hashed_vl = $this->hash('index');
            //return 'index.php?vl='.$hashed_vl.'&unem='.$this->menu_id.'&tac='.$this->category_id.'&bus='.$this->id;

            $hashed_vl = $this->hash('index');
            $link  = 'index.php?vl='.$hashed_vl;
            $link .= '&unem='.$this->sys_hash($this->menu_title).$this->crypt_algorithm($this->s_menu_id);
            $link .= '&tac='.$this->sys_hash($this->cat_title).$this->crypt_algorithm($this->cat_id);
            $link .= '&bus='.$this->sys_hash($this->title).$this->crypt_algorithm($this->id);

            return $link;
            
        }
       

 

    }
?>