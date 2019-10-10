<?php
    namespace Office\System\Table;
    use Cos\Table\Table;

    class BackofficeconfigTable extends Table {
        
        protected $table = 'backofficeconfig';

        public function getSliderTableViewConfig(string $table_name){
            return $this->query('SELECT table_name,view FROM backofficeconfig WHERE table_name = ? ',[$table_name],true);
        }

        public function getListArticleTableViewConfig(string $table_name){
            return $this->query('SELECT table_name,view FROM backofficeconfig WHERE table_name = ? ',[$table_name],true);
        }

        /** Update */
        public function update($table_name, array $fields){
            $sq_parts   = [];
            $attributes = [];
    
            foreach ($fields as $k => $v) {
                    $sql_parts[] = "$k = ? ";
                    $attributes [] = $v;
            }
    
            $attributes[] =  $table_name;
    
            $sql_part = implode(', ' ,$sql_parts);
    
            // var_dump(implode(', ' ,$sql_parts));
            //var_dump($attributes);
    
            return $this->query('UPDATE '.$this->table.' SET '.$sql_part.'  WHERE table_name = ?', $attributes , true);
        }





    }


?>