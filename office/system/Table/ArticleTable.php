<?php
    namespace Office\System\Table;
   

    class ArticleTable  extends \Cos\Table\Table {
        
        protected $table = 'article';
       
        /**
         * Count Query
         * @return int
         */
        public  function counted(int $id = null ){

            if(is_null($id)){
                  return $this->db->counted("SELECT id FROM article ");
            }else{
               
                // return  $this->db->counted("SELECT category_id FROM article WHERE  category_id = ? ", [$id] );
                return  $this->db->counted("SELECT category_id FROM article WHERE  category_id = ? ", [$id] );
            }
 
         }

        public function deleteAllPost(int $id){
            return $this->query('DELETE FROM article WHERE menu_id = ? 
            ', [$id] );
       }

       public  function all_cust(){
        //var_dump($id);
        return  $this->query("SELECT 
            article.id , article.title , article.content, article.date ,
            article.menu_id,article.category_id,article.sub_category_id,article.user_id,
            article.media_file,article.switch,article.switch_comment,article.comment_count,
            menu.id AS menu_id,menu.menu AS menu_title,
            category.id AS cat_id,category.title AS cat_title,
            subcategory.id AS subcat_id,subcategory.title AS subcat_title,
            user.xid,user.xfirst_name,user.xlast_name
            
            FROM article

            LEFT JOIN menu
            On article.menu_id = menu.id

            LEFT JOIN category
            ON article.category_id = category.id

            LEFT JOIN subcategory
            On article.sub_category_id = subcategory.id

            LEFT JOIN user
            ON article.user_id = user.xid

        
            ORDER BY article.date
            DESC
            " );

    }
    public  function all_cust_by_query(string $query){
        //var_dump($id);
        return  $this->query("SELECT 
            article.id , article.title , article.content, article.date ,
            article.menu_id,article.category_id,article.sub_category_id,article.user_id,
            article.media_file,article.switch,article.switch_comment,article.comment_count,
            menu.id AS menu_id,menu.menu AS menu_title,
            category.id AS cat_id,category.title AS cat_title,
            subcategory.id AS subcat_id,subcategory.title AS subcat_title,
            user.xid,user.xfirst_name,user.xlast_name
            
            FROM article

            LEFT JOIN menu
            On article.menu_id = menu.id

            LEFT JOIN category
            ON article.category_id = category.id

            LEFT JOIN subcategory
            On article.sub_category_id = subcategory.id

            LEFT JOIN user
            ON article.user_id = user.xid

            WHERE article.id LIKE ? || article.title LIKE ? 

            ORDER BY article.date
            DESC
            ",['%'.$query.'%','%'.$query.'%']);

    }
    public  function all_cust_by_filter_menu(string $query){
        //var_dump($id);
        return  $this->query("SELECT 
            article.id , article.title , article.content, article.date ,
            article.menu_id,article.category_id,article.sub_category_id,article.user_id,
            article.media_file,article.switch,article.switch_comment,article.comment_count,
            menu.id AS menu_id,menu.menu AS menu_title,
            category.id AS cat_id,category.title AS cat_title,
            subcategory.id AS subcat_id,subcategory.title AS subcat_title,
            user.xid,user.xfirst_name,user.xlast_name
            
            FROM article

            LEFT JOIN menu
            On article.menu_id = menu.id

            LEFT JOIN category
            ON article.category_id = category.id

            LEFT JOIN subcategory
            On article.sub_category_id = subcategory.id

            LEFT JOIN user
            ON article.user_id = user.xid

            WHERE article.menu_id = ?

            ORDER BY article.date
            DESC
            ",[$query]);

       }

       public  function find_cust(int $id)
       {
        return  $this->query("SELECT  *  FROM article WHERE id = ? ", [$id], true );
       }

       public  function select_images(int $folder_id)
       {
         return  $this->query("SELECT id,title,menu_id,media_file FROM article WHERE menu_id = ? ", [$folder_id] );
       }

       public function short_article(int $id)
       {
          return $this->query('SELECT id,title,content FROM article WHERE id = ? ', [$id] , true );
       }
 
       public function getCommentCount(int $post_id)
       {
         return $this->query('SELECT id,comment_count FROM article WHERE id = ? ',[$post_id], true);
       }

       public  function count_all_online() : string 
       {
          return $this->db->counted("SELECT id FROM article where switch = 'on' ");
       }

       public  function get_published_article()
       {
          return $this->query('SELECT title,comment_count,date from article where switch = "on" ORDER BY date DESC LIMIT 0,7 ');
       }



     
    }


?>