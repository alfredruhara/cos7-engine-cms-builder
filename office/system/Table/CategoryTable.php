<?php
    namespace Office\System\Table;
    use  Office\System\System;

    class CategoryTable extends \Cos\Table\Table {

        protected  $table = 'category';


        
        public  function find(int $id){

            return $this->query("SELECT category.id,category.menu_id,category.title, category.switch_category,category.date,
                                         menu.id as menu_id,menu.menu as menu_title         
                                FROM ".$this->table."
                                LEFT JOIN menu
                                ON menu.id = category.menu_id
                                WHERE category.menu_id = ? 
                                ORDER BY category.date
                                ASC
                                ", [$id]  );

        }
    
        /** Cust :  use in Back Office */

        public function uniq(int $category_id, int $menu_id){
            return $this->query("SELECT * FROM category WHERE id = ? AND menu_id = ? ", [$category_id, $menu_id], true );
        }

           
        public  function find_cust(int $id){

            return $this->query("SELECT *
                                FROM ".$this->table."
                                WHERE menu_id = ?
                                ORDER BY date
                                ASC
                                ", [$id]  );

        }

         /** Update */
         public function update_cust(int $id,int $menu_id, array $fields){
            $sq_parts   = [];
            $attributes = [];
    
            foreach ($fields as $k => $v) {
                 $sql_parts[] = "$k = ? ";
                 $attributes [] = $v;
            }
    
            $attributes[] =  $id;
            $attributes[] =  $menu_id;
    
            $sql_part = implode(', ' ,$sql_parts);
    
            // var_dump(implode(', ' ,$sql_parts));
           // var_dump($attributes);
    
            return $this->query('UPDATE '.$this->table.' SET '.$sql_part.'  WHERE id = ? AND menu_id = ?', $attributes , true);
        }

        public function delete_cust(int $id, int $menu_id){

            return $this->query('DELETE FROM '.$this->table.' WHERE id = ? AND menu_id = ? ', [$id,$menu_id] , true);
        
        }
        

    }



    ?>