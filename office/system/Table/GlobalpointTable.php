<?php
    namespace Office\System\Table;
    use Cos\Table\Table;

    class GlobalpointTable extends Table {
        
        protected $table = 'globalpoint';

        public function allPoint(){
            return $this->query('SELECT * FROM '.$this->table.'');
        }

      
    }


?>