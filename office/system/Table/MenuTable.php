<?php
    namespace Office\System\Table;
    use Cos\Table\Table;

    class MenuTable extends Table {
        

        protected $table = 'menu';

        
        public function menu(){
            return $this->query("SELECT id,menu,switch_menu,date_created,menu_dir FROM menu ORDER BY id  ");
        }

        public function extract($key, $value ){
            $records = $this->menu();
           // var_dump($records);
            $return = [];
    
            foreach($records as $v){
                $return[$v->$key] = $v->$value;
            }
          
            return $return ;
    
       }
       public function menuBuilder(){
        return $this->query("SELECT id,menu,switch_menu,date_created,menu_dir FROM menu ORDER BY id  ");
       }
       public  function find(int $id){
          return $this->query("SELECT * FROM menu WHERE id = ? ",[$id], true);
       }

       public function delete(int $id){
  
        return $this->query('DELETE FROM menu WHERE id = ? 
                             ', [$id] );
    
       }

       public function filterMenu(){
          return $this->query("SELECT id,menu FROM menu ORDER BY id  ");
       }

       public  function count_all_online(){
        return $this->db->counted("SELECT id FROM menu WHERE switch_menu = 'on' ");
       }
       /** Short */
       public function getAllMenu(){
           return $this->query('SELECT id,menu FROM menu');
       }

   

    }


?>