<?php
    namespace Office\System\Table;
    use Cos\Table\Table;

    class PointTable extends Table {
        
        protected $table = 'point';

        public function allPoint(int $id){
            return $this->query('SELECT * FROM '.$this->table.' where menu_id = ? ' , [$id] ) ;
        }

      
    }


?>