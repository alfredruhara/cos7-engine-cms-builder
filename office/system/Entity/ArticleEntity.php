<?php
    namespace Office\System\Entity;

    class ArticleEntity  extends \Cos\Entity\Entity {



        public function getUrl(){
            /**
             * GET['vl'] = page to load - 
             * GET['dif']= id 
             */
            $hashed_vl = $this->hash('single');
            return 'index.php?vl='.$hashed_vl.'&dif='.$this->crypt_id();
        }
       

        public function getExtrait(){
            $html = '<p>'.substr($this->content, 0, 150).'...</p>';
            $html .= '<p><a href="'.$this->getUrl().'"> read more </a> </p>';

            return $html;
        }
        
        private function custUrl(){
            
            $hashed_vl = $this->hash('index');
            
            // $hashed_vl = $this->hash('index');
            // $link  = 'index.php?vl='.$hashed_vl;
            // $link .= '&unem='.$this->sys_hash($this->menu_title).$this->crypt_algorithm($this->s_menu_id);
            // $link .= '&tac='.$this->sys_hash($this->cat_title).$this->crypt_algorithm($this->cat_id);
            // $link .= '&bus='.$this->sys_hash($this->title).$this->crypt_algorithm($this->id);



            if( $this->sub_category_id > 0 ){
                return 'index.php?vl='.$hashed_vl.'&unem='.$this->sys_hash($this->menu_title).$this->crypt_algorithm($this->menu_id).'&tac='.$this->sys_hash($this->cat_title).$this->crypt_algorithm($this->category_id).'&bus='.$this->sys_hash($this->subcat_title).$this->crypt_algorithm($this->subcat_id);
            }else if ( $this->category_id > 0 &&  $this->sub_category_id <= 0 ) {
                return 'index.php?vl='.$hashed_vl.'&unem='.$this->sys_hash($this->menu_title).$this->crypt_algorithm($this->menu_id).'&tac='.$this->sys_hash($this->cat_title).$this->crypt_algorithm($this->category_id);
            }else{
                return 'index.php?vl='.$hashed_vl.'&unem='.$this->sys_hash($this->menu_title).$this->crypt_algorithm($this->menu_id);
            }
          
               
            
           // return 'index.php?vl='.$hashed_vl.'&dif='.$this->crypt_id();
        }
        public function getAbout(){
            $html = '<span> Publish on <em>'. $this->date .'</em> </span> ';
            $html .= '<span> <a href="'.$this->custUrl().'">'.$this->menu_title.'  '.$this->cat_title.'  '.$this->subcat_title.'</a> </span>';
            $html .= '<span style=" margin-right:15px"> By <b> ';
            $html .= ucfirst($this->xfirst_name).' '.ucfirst($this->xlast_name).'</b></span>';
            //var_dump($this);
            return $html;
            
        }


    }
?>