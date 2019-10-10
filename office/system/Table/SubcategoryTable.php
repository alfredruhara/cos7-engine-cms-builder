<?php
    namespace Office\System\Table;
    use Cos\Table\Table;

    class SubcategoryTable extends Table {
        

        protected $table = 'subcategory';

        public  function find(int $id){

            return $this->query("SELECT 
            subcategory.id,subcategory.title,subcategory.category_id,subcategory.date,  
            category.id as cat_id,category.menu_id    
            
            FROM subcategory 

            LEFT JOIN category
            ON subcategory.category_id = category.id
        
            WHERE subcategory.category_id = ? 
            ORDER BY subcategory.date
            DESC
            ", [$id]  );

        }

        public  function fullFind(int $menu_id = null, int $category_id){
            
            if($menu_id === null) { 

               return  $this->find($category_id);
                
            }else{
                return $this->query("SELECT 
                subcategory.id,subcategory.title,subcategory.category_id,subcategory.date,  
                menu.id as s_menu_id,menu.menu as menu_title ,category.id as cat_id,category.title as cat_title   
                
                FROM subcategory 
                
                LEFT JOIN menu
                on menu.id  = ? 
    
                LEFT JOIN category
                ON subcategory.category_id = category.id
            
                WHERE subcategory.category_id = ? 
                ORDER BY subcategory.date
                DESC
                ", [$menu_id,$category_id]  );
            }
           

        }

       /** used in back officel */
        public function getSubCategories(int $category_id){
            return $this->query("SELECT * FROM subcategory WHERE category_id = ? ",[$category_id]);
        }

        /** Update */
        public function update_cust($id,$category_id, $fields){
            $sq_parts   = [];
            $attributes = [];
    
            foreach ($fields as $k => $v) {
                 $sql_parts[] = "$k = ? ";
                 $attributes [] = $v;
            }
    
            $attributes[] =  $id;
            $attributes[] =  $category_id;
    
            $sql_part = implode(', ' ,$sql_parts);
    
            // var_dump(implode(', ' ,$sql_parts));
           // var_dump($attributes);
    
            return $this->query('UPDATE '.$this->table.' SET '.$sql_part.'  WHERE id = ? AND category_id = ?', $attributes , true);
        }

        public function delete_cust(int $id, int $category_id){

            return $this->query('DELETE FROM '.$this->table.' WHERE id = ? AND category_id = ? ', [$id,$category_id] , true);
        
        }

    }


?>