<?php
    namespace Web\System\Table;
    use Cos\Table\WebTable;

    class MenuTable extends WebTable {
        

        protected $table = 'menu';

        
        public function menu(){
            return $this->query("SELECT id,menu,switch_menu,date_created,menu_dir FROM menu WHERE  switch_menu = 'on' ORDER BY id  ");
        }
   

    }


?>