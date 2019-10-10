<?php
    namespace Office\System\Table;

    class CommentTable extends \Cos\Table\Table{

         /** Administrator */

        public function comments(string $filter=null):array{
            
            if($filter === null){
                $where_is = "comment.moved_to_trash = '0' AND comment.spam = '0'";
            }else if ($filter === 'pending'){
                $where_is = "comment.pending = '1' AND comment.moved_to_trash = '0' AND comment.spam = '0' ";
            }else if ($filter === 'approved'){
                $where_is = "comment.pending = '0' AND comment.moved_to_trash = '0' AND comment.spam = '0' ";
            }
            else if ($filter === 'spams'){
                $where_is = "comment.spam = '1' ";
            }else if ($filter === 'trashes'){
                $where_is = "comment.moved_to_trash = '1' ";
            }else{
                $where_is = "comment.moved_to_trash = '0' AND comment.spam = '0'";
            }

            return $this->query("SELECT comment.id as com_id,comment.parent_id, comment.post_id,comment.email,comment.full_name,
                                        comment.date,comment.comment,comment.pending,comment.moved_to_trash as trash,comment.spam,
                                        article.id,article.title,article.comment_count
                                 FROM comment
                                 LEFT JOIN article
                                 ON comment.post_id = article.id
                                 WHERE $where_is
                                 ORDER BY comment.date DESC
                                 ");
         }
   
        public function findCom(int $com_id){
            return $this->query("SELECT comment.id as com_id, comment.post_id,comment.email,comment.full_name,comment.date,comment.comment,
                                        comment.spam,article.id,article.title 
                                 FROM comment
                                 LEFT JOIN article
                                 ON comment.post_id = article.id
                                 WHERE comment.id = ?
                                 ",[$com_id],true);
         }
         

         /***
         *Miro Queries 
         *Short request
         */


         public function replied_com(int $com_id){
             return $this->query('SELECT id,full_name 
                                  FROM comment 
                                  WHERE id = ? ',[$com_id] , true );
         }

         /**
          * Micro
         * Count queries
         * @return int
         */
        public  function count_all(){
             return $this->query("SELECT id,pending 
                                  FROM comment 
                                  WHERE moved_to_trash = '0' AND spam = '0' ");
        }
        public  function count_spam(){
            return $this->db->counted("SELECT id 
                                       FROM comment 
                                       WHERE spam = '1' ");
        }
        public  function count_trash(){
            return $this->db->counted("SELECT id 
                                       FROM comment 
                                       WHERE moved_to_trash = '1' ");
        }

        public  function count_all_online(){
            return $this->db->counted("SELECT id 
                                       FROM comment 
                                       WHERE pending = '0' AND moved_to_trash = '0' AND spam = '0' ");
       }

        public function get_recent_comments(){

            return $this->query('SELECT id,parent_id,comment,full_name,pending 
                                 FROM comment 
                                 WHERE comment.moved_to_trash = "0" AND comment.spam = "0" 
                                 ORDER BY date LIMIT 0,5 ');
        }

        public function get_partials(int $id){
            return $this->query('SELECT comment.id as com_id,comment.pending,comment.moved_to_trash,comment.spam,comment.post_id,article.comment_count
                                  FROM comment
                                  JOIN article 
                                  ON article.id = comment.post_id
                                  WHERE comment.id = ? ',[$id],true);
        }
   }


?>