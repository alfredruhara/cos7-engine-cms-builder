<?php
    namespace Web\System\Table;
    use Cos\Table\Table;

    class BackofficeconfigTable extends WebTable {
        
        protected $table = 'backofficeconfig';

        public function getSliderTableViewConfig(string $table_name){
            return $this->query('SELECT table_name,view FROM backofficeconfig WHERE table_name = ? ',[$table_name],true);
        }

        public function getListArticleTableViewConfig(string $table_name){
            return $this->query('SELECT table_name,view FROM backofficeconfig WHERE table_name = ? ',[$table_name],true);
        }


    }


?>