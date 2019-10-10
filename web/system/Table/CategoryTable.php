<?php
    namespace Web\System\Table;
    use  Web\System\System;

    class CategoryTable extends \Cos\Table\WebTable {

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

    }



    ?>