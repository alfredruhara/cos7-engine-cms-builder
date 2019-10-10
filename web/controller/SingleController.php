<?php
    
    namespace Web\Controller;
    use Cos\HTML\MaterializeForm;

    class SingleController extends \Web\System\SystemController{
      
        private $article_id  = null ;
        private $post;
        private $coms = [];
        private $more_posts = [];
        
        # Setters
        private $com_switch;
        private $title;
        protected $active_menu;

        public function __construct(){

            parent::__construct();
            $this->loadModel('comment');
            $this->loadModel('article');

        }


        private function extractor(string $get_string) {

            $expl = explode('-',$get_string);
            $retrieved_int_crypt = end($expl);

            if ( !preg_match('/^[0-9]*$/',$retrieved_int_crypt) ) 
            {
               return null ; 
            }   

            $article_id =  $this->System->id_decrypt('',(int)$retrieved_int_crypt,true);
            if ($article_id === null )  {
                return null;
            } 

            $this->article_id = $article_id;

        }

        private function get_article(int $article_id){
             # First Query
             $post = $this->article->find($article_id);
             if ($post === false ) {
                 return null ;
             }
             $this->post = $post;
        }

        private function setters($article){

            $this->com_switch  = $article->switch_comment;
            $this->title       = $article->title;
            $this->active_menu = $article->menu_id;
            
        }

        private function get_comments($article_id){

            $this->coms =  $this->comment->find($article_id);
        }

        private function more_posts($article_id){
            $this->more_posts =  $this->article->alsoSeeFromSite($article_id);
        }

        # Render to view 
        public function index(string $uri_id){
    
            if($this->extractor($uri_id) === null){

            }
            if($this->get_article($this->article_id)){

            }
            $this->engine_menu();

            $this->setters($this->post);
            $this->get_comments($this->post->id);
            $this->more_posts($this->post->id);
            

            $this->set_variables_to_send([
                'active_menu' => $this->active_menu, 
                'menu_list'   => $this->menu_list,
                'article_id'  => $this->article_id, 
                'post'        => $this->post,
                'coms'        => $this->coms,
                'more_posts'  => $this->more_posts,
                'com_switch'  => $this->com_switch,
                'title'       => $this->title,
                'active_menu' => $this->active_menu
            ]);
            $this->render('single.index',  $this->variables);
        }
        # Comment proces 
        public function comment_validation(){
            
            $errors = false ;

            if(isset($_POST)){
                $email = isset($_POST['email']) ? $this->Sysem->formatInput($_POST['email']) : '';
                $fullname = isset($_POST['fullname']) ?  $this->Sysem->formatInput($_POST['fullname']): '';
                $com = isset($_POST['com']) ?  $this->Sysem->formatInput($_POST['com']): '';
                
                if($email != '' && $fullname != '' && $com != '')
                {
                    if (preg_match("/^[a-zA-Z0-9]*$/",$fullname))
                    {
                        if (filter_var($email, FILTER_VALIDATE_EMAIL))
                        {
                            $oky = $this->comment->create([
                                'post_id'=> $post->id,
                                'email' =>$email,
                                'full_name' =>$fullname,
                                'comment' =>$com
                            ]);
                            if ( $oky )
                            {                  
                                $oky_count =  $this->article->update($post->id,['comment_count' => (int)$post->comment_count + 1 ]);
                            }else{
                                $errors = true ;
                            }
                        }else{
                            $errors = true ;
                        }
                    }else{
                        $errors = true ;
                    }
                }else{
                    $errors = true ;
                }
            }
            
            $form = new \Web\System\HTML\MaterializeForm();
            $this->render('single.index', compact('form','errors') );

        }

    }

?>