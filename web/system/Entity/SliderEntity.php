<?php
    namespace Web\System\Entity;

    class SliderEntity  extends \Cos\Entity\Entity{

       
        
        public function getMedia_url(){
            $path = '../datas/slides/';
            
            #$path = DATAROOT.DS.'slides'.DS;
            
            return $path.$this->scaption_attach;
        }
 

    }
?>