<?php
    
    namespace Web\Controller;
    use \Web;

    class EngineController extends \Web\System\SystemController{
      
        private $is_subcategory_active = false; 

        # Category 
        private $active_category;
        private $categories_list = [];
        # Sub Category
        private $subcategory_active_id;
        private $subcats = [];
        # Slider
        private $found_slides = [];
        # Posts
        private $posts  = [] ;

        public function __construct(){

            parent::__construct();
            
            $this->loadModel('category');
            $this->loadModel('subcategory');
            $this->loadModel('slider');
            $this->loadModel('article');

        }


        private function engine_category(int $active_menu)  : void {
            
            $categories_list =  $this->category->find($active_menu); # Sending a first request - total 2 - 
            if  ($categories_list != [] AND isset($_GET['tac']))
            {
                $returned_category_id = $this->System->extract_end($_GET['tac']);
                if ( $returned_category_id != null )
                {
                    foreach ($categories_list as $category_key)
                    {
                        if ( $returned_category_id === (int)$category_key->id ) {
                            $this->active_category = $returned_category_id;
                            $this->categories_list = $categories_list;
                            break;
                        };
                    }
                }
                      
            }else if ($categories_list != [])
            {
                $this->active_category  = $categories_list[0]->id ;
                $this->categories_list = $categories_list;
            }
         
        }

        private function engine_subcategory(array $categories_list, int $active_category) : void 
        {   
            $subcategories_list = $this->subcategory->fullFind(null,$active_category);
            # $this->System->debug($subcategories_list);

            if  ( $subcategories_list  != [] )
            {
                if  (isset($_GET['bus']))
                {
                    $returned_subcategory_id = $this->System->extract_end($_GET['bus']);

                    
                    if ($returned_subcategory_id != null) 
                    {
                        foreach ($subcategories_list as $subcategory_key)
                        {
                            # if extracted correspond to any eixsted sub category id then active it
                            if  ( $returned_subcategory_id === (int)$subcategory_key->id )
                            {
                                $active_subcategory = $returned_subcategory_id;
                            }                                   
                        }
                    }
                    if(!isset($active_subcategory)) $this->System->e404();
                }else
                {
                    # Active the first result of sub categories found of this category
                    $active_subcategory = $subcategories_list[0]->id;
                    }    
            } # end of sub categories block if found 
          
            foreach($categories_list as $cat)
            {
                $subcat = $this->subcategory->fullFind($cat->menu_id,$cat->id);
    
                if(isset($_GET['bus']))
                {
                    if(isset($active_subcategory))
                    {
                        $this->subcategory_active_id = $active_subcategory;
                    }
                }else{
                    
                    if( $subcat  != [])
                    {
                        if($this->is_subcategory_active === false)
                        {
                            $this->subcategory_active_id =  $subcat[0]->id;
                            $this->is_subcategory_active = true;
                        }
                                   
                    }
                }
                if( $subcat  != [])
                {
                  $this->subcats[$cat->id.$cat->title] = $subcat;
                }          
            }
        }

        private function engine_slider(int $active_menu) : void 
        {
            $found_slides =  $this->slider->findSlidesFor($active_menu);
            if($found_slides != []) {   $this->found_slides = $found_slides; }
        }

        private function  engine_article() :  void { 
                
            if( $this->active_menu && !$this->active_category) 
            {
                $this->posts =  $this->article->fetch($this->active_menu); 
        
            }else if ( $this->active_menu && $this->active_category && !$this->subcategory_active_id )
            {
                $this->posts =  $this->article->fetch($this->active_menu, $this->active_category); 
        
            }else if ( $this->active_menu && $this->active_category && $this->subcategory_active_id ) 
            {    
                $this->posts =  $this->article->fetch($this->active_menu, $this->active_category, $this->subcategory_active_id ); 
                
        }
            
        }

        public function index(){

            $this->engine_menu();
             
            if($this->active_menu) {

                $this->engine_category($this->active_menu);

                if($this->active_category){
                    $this->engine_subcategory($this->categories_list,$this->active_category);
                }
                
                $this->engine_slider($this->active_menu);
                $this->engine_article();

            }

            $this->set_variables_to_send([
                'active_menu'           => $this->active_menu, 
                'menu_list'             => $this->menu_list,
                'active_category'       => $this->active_category,
                'categories_list'       => $this->categories_list,
                'subcategory_active_id' => $this->subcategory_active_id,
                'subcats'               => $this->subcats,
                'found_slides'          => $this->found_slides,
                'posts'                 => $this->posts
            ]);
            $this->render('engine.index',  $this->variables);

        }

     
    }

?>