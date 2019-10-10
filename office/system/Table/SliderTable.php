<?php
    namespace Office\System\Table;
    use Cos\Table\Table;

    class SliderTable extends Table {
        

        protected $table = 'slider';

        
        public function findSlidesFor(int $active_menu){
            return $this->query("SELECT *
                                  FROM slider
                                  WHERE smenu_id = ? AND switch = 'on'
                                  ORDER BY RAND() LIMIT 0,8 
                                 ",[$active_menu]);
         }

         public function delete(int $id){

            return $this->query('DELETE FROM slider WHERE sid = ?', [$id] , true);
        
        }

        /** Update */
        public function update($id, array $fields){
            $sq_parts   = [];
            $attributes = [];
    
            foreach ($fields as $k => $v) {
                    $sql_parts[] = "$k = ? ";
                    $attributes [] = $v;
            }
    
            $attributes[] =  $id;
    
            $sql_part = implode(', ' ,$sql_parts);
    
            // var_dump(implode(', ' ,$sql_parts));
            //var_dump($attributes);
    
            return $this->query('UPDATE '.$this->table.' SET '.$sql_part.'  WHERE sid = ?', $attributes , true);
        }
         
    
    
        public function sliders(){
            return $this->query('SELECT scaption_title as title, smenu_id as menu_id , scaption_attach  From slider');
        }
    
        public function sliders_filter_by_menu_id($menu_id ){
            return $this->query('SELECT scaption_title as title, smenu_id as menu_id , scaption_attach  
                                From slider where smenu_id = ?' ,[$menu_id]);
        }
    
    
    
    
    }
    

    

?>