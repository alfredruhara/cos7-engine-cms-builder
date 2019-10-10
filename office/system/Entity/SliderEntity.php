<?php
    namespace Office\System\Entity;

    class SliderEntity  extends \Cos\Entity\Entity{

       
        
        public function getMedia_url(){
            $path = '../datas/slides/';
            
            return $path.$this->scaption_attach;
        }
 

    }
?>