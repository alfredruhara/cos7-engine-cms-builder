<?php
    namespace Office\System\Table;
    use Cos\Table\Table;

    class DisplayTable extends Table {
        
        protected $table = 'display';

        public function getConfig(){
            return $this->query('SELECT category,subcategory FROM display',[],true);
        }
      
    }


?>