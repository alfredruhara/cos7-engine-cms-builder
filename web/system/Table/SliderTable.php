<?php
    namespace Web\System\Table;
    use Cos\Table\WebTable;

    class SliderTable extends WebTable {
        

        protected $table = 'slider';
  
        public function findSlidesFor(int $active_menu){
            return $this->query("SELECT *
                                  FROM slider
                                  WHERE smenu_id = ? AND switch = 'on'
                                  ORDER BY RAND() LIMIT 0,8 
                                 ",[$active_menu]);
         }
    
    }
    

    

?>