<?php
    namespace Web\System\Table;

    class CommentTable extends \Cos\Table\WebTable{


        public  function find(int $id):array{

            return  $this->query("SELECT 
                                comment.post_id,comment.full_name,comment.date,comment.comment,comment.spam
                                FROM comment 
                                WHERE comment.post_id = ? 
                                AND comment.spam = '0' AND comment.moved_to_trash = '0' AND comment.pending = '0'
                                ORDER BY comment.date
                                DESC
                                ", [$id] );

        }
         # Insert query -Create
        public function create(array $fields)
        {
            $sq_parts   = [];
            $attributes = [];
        
            foreach ($fields as $k => $v) {
                    $sql_parts[] = "$k = ? ";
                    $attributes [] = $v;
            }
            $sql_part = implode(', ' ,$sql_parts);
        
            return $this->query('INSERT INTO '.$this->table.' SET '.$sql_part.' ', $attributes , true);
        }
    
         

   }


?>