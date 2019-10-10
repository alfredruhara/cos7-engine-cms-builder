<?php
    namespace Web\System\Table;
   

    class ArticleTable  extends \Cos\Table\WebTable {
        
        protected $table = 'article';    

        # Main Queries : Used to fetch datas according to what have been passed as parameters ! @important
        public function fetch(int $menu_id = null, int $category_id = null, int $subcategory_id = null ){
             
            $contents = 'article.id , article.title , article.content, article.date ,article.menu_id,article.category_id,
                        article.sub_category_id,article.user_id,article.media_file,article.switch';
            $global_conditions = " article.menu_id = ?  AND article.switch = 'on' ";
             
            if($menu_id != null && $category_id == null && $subcategory_id == null )
            {
                return $this->query("SELECT  $contents  
                                     FROM article 
                                     WHERE $global_conditions 
                                     ORDER BY article.date  DESC", [$menu_id]);

            }else if ($menu_id != null && $category_id != null && $subcategory_id == null )
            {

                return $this->query("SELECT  $contents  
                                     FROM article  
                                     WHERE $global_conditions AND  article.category_id = ?  
                                     ORDER BY article.date DESC",[$menu_id,$category_id]);
 
            }else if ( $menu_id != null && $category_id != null && $subcategory_id != null)
            {
                return $this->query("SELECT  $contents 
                                     FROM article  
                                     WHERE $global_conditions AND  article.category_id = ? AND  article.sub_category_id = ? 
                                     ORDER BY article.date  DESC",[$menu_id,$category_id,$subcategory_id]);
            }


        }

         # Single - Uniqu posts fetch @param ->Post id
         public  function find(int $id){

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

                                WHERE article.id = ? AND article.switch = 'on' ORDER BY article.date DESC ", [$id], true );

        }
        # Query for Suggesting Posts
        public function alsoSeeFromSite(int $article_id){
            
                return  $this->query("SELECT  article.id , article.title, article.category_id,article.date ,  article.media_file,article.switch    
                                      FROM article
                                      WHERE article.id != ? AND   article.switch = 'on' ORDER BY RAND() LIMIT 0,4  ", [ $article_id]  );

        } 
        
    }


?>