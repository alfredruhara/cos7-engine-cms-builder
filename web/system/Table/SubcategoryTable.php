<?php
    namespace Web\System\Table;
    use Cos\Table\WebTable;

    class SubcategoryTable extends WebTable {
        

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

    }


?>