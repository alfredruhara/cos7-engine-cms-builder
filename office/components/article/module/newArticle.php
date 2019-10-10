<?php
    $systemArt = System::getInstance();
    $menu_table = $systemArt->getTable('menu');
    $category_table = $systemArt->getTable('category');
    $subcategory_table = $systemArt->getTable('subcategory');
    #Retrieve data from those tables
    $menus          = $menu_table->menu();
    $categories     = $category_table->all();
    $subcategories  = $subcategory_table->all();
    $article_table = $systemArt->getTable('article');
    #Edit an exesting article
    if(isset($_GET['id']))
    {
       if(preg_match("/^[0-9]*$/",$_GET['id']) ) 
       {     
         $post_edit = $article_table->find_cust($_GET['id']); 
         $post_edit === false ? $active_menu = $menus[0]->id :  $active_menu = $post_edit->menu_id ;   
       }
    }else
    {
        $active_menu = $menus[0]->id;
    }
    if(isset($_POST['publish']))
    {    
        #Required Fields
        $article_title = isset($_POST['article_title']) ? $systemArt->formatInput($_POST['article_title']) : '' ;
        $article_content = isset($_POST['article_content']) ? $systemArt->formatInput($_POST['article_content']) : '' ;
        $menu_id = isset($_POST['menu']) ? $systemArt->formatInput($_POST['menu']) : '' ;
        # Optional fields
        # Some have default states
        $cat_id = isset($_POST['cat']) ? $systemArt->formatInput($_POST['cat']) : '' ;
        $subcat_id = isset($_POST['subcat']) ? $systemArt->formatInput($_POST['subcat']) : '' ;
        #Attachments : no default state
        $article_attach = isset($_FILES['article_attach']) && ( !empty( $_FILES['article_attach']['name'] ) ) ? $_FILES['article_attach'] : '' ;
        $article_youtube_video_link = isset($_POST['article_youtube_video_link']) ? $systemArt->formatInput($_POST['article_youtube_video_link']) : '' ;
        $article_button_link = isset($_POST['article_button_link']) ? $systemArt->formatInput($_POST['article_button_link']) : '' ;
        #Switches : have default state
        $article_switch = isset($_POST['article_switch']) ? 'on' : 'off' ;
        $article_switch_comment = isset($_POST['article_switch_comment']) ? 'on' : 'off' ;
        $article_switch_attach = isset($_POST['article_switch_attach']) ? 'image' : 'video' ;
        #Date time : if not defined -> default date time will be saved 
        $article_date = isset($_POST['article_date']) && ( !empty($_POST['article_date']) ) ? $systemArt->formatInput($_POST['article_date']) : date("Y-m-d") ;
        $article_time = isset($_POST['article_time']) && ( !empty($_POST['article_time']) ) ? $systemArt->formatInput($_POST['article_time']) : date("H:i:s") ;
        #Tags : no default state 
        $article_tags = isset($_POST['article_tags']) ? $systemArt->formatInput($_POST['article_tags']) : '' ;
        $article_title_tag_contents = isset($_POST['article_title_tag_contents']) ? $systemArt->formatInput($_POST['article_title_tag_contents']) : '' ;
        #Meta tag : no default state
        $article_description_meta_tag_content = isset($_POST['article_description_meta_tag_content']) ? $systemArt->formatInput($_POST['article_description_meta_tag_content']) : '' ;
        $article_keywords_meta_tag_content = isset($_POST['article_keywords_meta_tag_content']) ? $systemArt->formatInput($_POST['article_keywords_meta_tag_content']) : '' ;
        #Force checking if three were filled and if the send id really exist in the database
        if ($menu_id != '' && $article_title != '' && $article_content != '') 
        {
            foreach ( $menus as $menu )
            {
                if ( $menu->id == $menu_id )
                {
                    $menu_id_found = $menu->id;
                    $menu_directory = $menu->menu_dir;
                    break;
                }
            }
        }else
        {
           $flash->set('required','warning');
        }
        #Doing this because value were injected in field values . the user may change values and send unexcepted values
        if( isset ( $menu_id_found ) &&  $cat_id != '' )
        { 
            foreach ( $categories as $cat) 
            {
                #Checking if the send cat_id exist and its a  category of the menu_id_found 
                if ( $cat->id == $cat_id && $cat->menu_id == $menu_id_found ) 
                {
                    $cat_id_found = $cat->id; 
                    break;
                }
            }
        }
        if ( isset ( $cat_id_found ) && $subcat_id !=  '' ) 
        { 
            foreach ( $subcategories as $subcat) 
            {
                if ( $subcat->id == $subcat_id && $subcat->category_id == $cat_id_found ) 
                {
                    $subcat_id_found = $subcat->id; 
                    break;
                }
            }
        }
        if ( isset($menu_id_found)  ) 
        { 
            #Image upload process
            if( $article_attach != '') 
            {
                $upload_process = $systemArt->doUpload($article_attach, '../datas/'.$menu_directory.'/');
                $upload_process != false ? $upload_file_name = $menu_directory.'/'.$upload_process : $flash->set('upload_error','danger');
            }
            $posting = $article_table->create([
                'title'                         => $article_title,
                'content'                       => $article_content,
                'date'                          => $article_date.' '.$article_time,
                'menu_id'                       => $menu_id_found,
                'category_id'                   => isset($cat_id_found) ? $cat_id_found : null ,
                'sub_category_id'               => isset($subcat_id_found) && isset($cat_id_found) ? $subcat_id_found : null ,
                'user_id'                       => isset($user_id_found) ? $user_id_found : 1 ,
                'media_file'                    => isset($upload_file_name) ?  $upload_file_name : null ,
                'youtube_video_link '           => $article_youtube_video_link != '' ? $article_youtube_video_link : null,
                'button_link '                  => $article_button_link != ''  ? $article_button_link : null ,
                'switch'                        => $article_switch,
                'switch_comment'                => $article_switch_comment,
                'switch_attach '                => $article_switch_attach,
                'tags '                         => $article_tags != ''  ? $article_tags : '' ,
                'title_tag_contents '           => $article_title_tag_contents != ''  ? $article_title_tag_contents : '' ,
                'desc_meta_tag_content'         => $article_description_meta_tag_content != ''  ? $article_description_meta_tag_content : '' ,
                'keyword_meta_tag_content'      => $article_keywords_meta_tag_content != ''  ? $article_keywords_meta_tag_content : '' 

             ]);
             $posting === true ? $flash->set('success','success') : $flash->set('fatal_error','danger');
            
         } else if (  !isset($menu_id_found) && $article_title != '' && $article_content != ''  ) 
         {
            $flash->set('id_error','danger');
         }
         $systemArt->cos_redirect('?vl='.$systemArt->cursor('article')['new']['out']);
    }
?>
<form action="#" method='post' enctype="multipart/form-data" >
<div class="row cust_menu">
    <div class="col s10 pinned cust_menu" style='z-index:99;'>
          <div class="col s8 ">
        
           <?php if(!isset($post_edit)): ?>
 
            <h5><i class="fa fa-edit"></i> New Article</h5>
            <a href="?vl=<?= $systemArt->cursor('article')['index']['out']?>" style='font-size:18px;' class='orange-text'> <i class="fa fa-arrow-left"></i> Articles </a>
       
                
                <div style='margin:10px 0px 10px 0px; '>
                    <button type='submit' name='preview' class="btn blue z-depth-0"> Prewiew </button>
                    <button type='submit' name='draft' class="btn blue z-depth-0"> Save Draft </button>
                    <button type='submit' name='publish' class="btn blue z-depth-0"> Publish </button>
                </div>
                <?php else: ?>
                  
                  <h5><i class="fa fa-edit"></i> Edit Article</h5>
                  <a href="?vl=<?= $systemArt->cursor('article')['new']['out'] ?>" style='font-size:18px;' class='white-text'> <i class="fa fa-edit"></i> New article </a>

                         <div style='margin:10px 0px 10px 0px; '>
                            <button type='submit' name='preview' class="btn blue z-depth-0"> Prewiew </button>
                            <button type='submit' name='draft' class="btn blue z-depth-0"> Save Changes </button>
                            <button type='submit' name='publish' class="btn red z-depth-0"> Delete </button>
                        </div>

            <?php endif; ?>
        </div> 

        <div class="col s4 right-align orange-text" style='margin-top:10px;'> 
             <?php if(!isset($post_edit)): ?>
                    <h6> Composing mode </h6>
                <?php else: ?>
                    <h6> Editing mode </h6>
            <?php endif; ?>
        </div>

    </div>
</div> 
<br/><br/><br/><br/><br/>

<div class="row">

    <div class="col s8 ">
         
        
       
        <p> Article Title </p> 
        
    
        <?php if(isset($post_edit)): ?>

            <input type="text" class='cust_input white-text' name='article_title' value='<?= $post_edit->title ?>' style=''  /> 
            <?php else: ?>
                    <input type="text" class='cust_input' name='article_title' placeholder=' write the article title ... ' style=''  />
        <?php endif ;?>


        <p> Content ( HTML Allowed ) </p> 
        
        <?php if(isset($post_edit)): ?>
        <textarea name="article_content" style=' width:100%; height:500px;  border:none; border:1px solid grey; padding:10px; resize: vertical;'   >
                <?= nl2br($post_edit->content) ?>
        </textarea>
        <?php else: ?>
            
            <textarea name="article_content" style=' width:100%; height:500px;  border:none; border:1px solid grey; padding:10px; resize: vertical;' placeholder='write...'  ></textarea>
        
        <?php endif ;?>

         <br/>
         <p> Image Attach ( Optional ) </p> 
       
         <?php if(isset($post_edit)): ?>
                    <div class="parallax-container z-depth-1"> 
                        <div class="parallax">
                            <img src="<?= $post_edit->media_url ?>"/>
                        </div>
                        <div style='position:absolute; bottom:0px; width:100%' class='cust' >
                                <div class="file-field input-field col s8">
                                <div class="btn z-depth-0 bordered-btn-cust" style='background:transparent; '>
                                    <span><i class="white-text fa fa-image "></i>  Change </span>
                                    <input type="file" name='article_attach' id='attach_trigger'>
                                </div>
                                <div class="file-path-wrapper">
                                    <input class="file-path validate" type="text" style='border:none; border-bottom:1px solid grey'>
                                </div>
                            </div>
                        
                            <div class="col s4 right-align">
                            <br/>
                                <div class="btn z-depth-0 blue " style='background:transparent; '>
                                        <span><i class="white-text fa fa-eye "></i>  Preview  </span>
                                </div>
                            </div>

                        </div>
                    </div>
               <?php else: ?>
                                      
                    <div class="file-field input-field col s8">
                        <div class="btn z-depth-0 bordered-btn-cust" style='background:transparent; '>
                            <span><i class="white-text fa fa-image "></i>  Image </span>
                            <input type="file" name='article_attach' id='attach_trigger'>
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" type="text" style='border:none; border-bottom:1px solid grey'>
                        </div>
                    </div>
                    <div class="col s4 right-align">
                    <br/>
                        <div class="btn z-depth-0 blue " style='background:transparent; '>
                                <span><i class="white-text fa fa-eye "></i>  Preview  </span>
                        </div>
                    </div>

        <?php endif ;?>

    

        <div class="row"></div>    
       
        <p> Youtube Video Link (Optional) : <i class="fa fa-info-circle orange-text"></i>  Attach an article with a youtube video (iframe) </p> 
        
        <?php if(isset($post_edit)): ?>
            <input type="url" name='article_youtube_video_link' class='cust_input' value='<?= $post_edit->youtube_video_link ?>' style=''  />       
        <?php else: ?>
            <input type="url" name='article_youtube_video_link' class='cust_input' placeholder=' ' style=''  />
        <?php endif ;?>


        <p> Button Link (Optional) : <i class="fa fa-info-circle orange-text"></i>  Can be use to provide a download link or something else  </p> 
       
        <?php if(isset($post_edit)): ?>
            <input type="url" name='article_button_link' class='cust_input' value='<?= $post_edit->button_link ?>' style=''  />
            <?php if($post_edit->button_link != null || $post_edit->button_link != ''): ?>
                    <a href="<?= $post_edit->button_link ?>"  target="_blank" >
                      Click
                    </a>
            <?php endif;?>
        <?php else: ?>
            <input type="url" name='article_button_link' class='cust_input' placeholder=' eg: https://www.dropbox.com/?file=wwe ' style=''  />
        <?php endif ;?>


       
        
  
        <br/><br/>

        <p> In  ( Menu - Category - Sub Category ) : <i class="fa fa-info-circle orange-text"></i> Select where to post this Article </p>
        
        <div class='col s12 z-depth-1 cust_menu' style='padding-bottom:10px;'>
        
        <div class="col s4">
        
         
        <p>  Menu  ? </p>
           <?php foreach($menus as $menu): ?>
                
               
                <p class='menu_trigger <?= $menu->id ?>'>
                    <input class="with-gap" name="menu" value='<?= $menu->id ?>' type="radio" id="menu<?= $menu->id ?>"  
                            <?= $active_menu == $menu->id ? 'checked' : ''?> />
                    <label for="menu<?= $menu->id ?>"><?=  ucfirst($menu->menu) ?></label>
                </p>

                 <?php 
                    /** Foot print */
                    if ( isset($post_edit) ) {
                        
                        if(  $active_menu == $menu->id ) {
                           $were_in_menu =  $menu->menu;
                        }
                    }

                  ?>
            
            <?php endforeach; ?>

        </div>  <!--- End of Menus Section Divs--> 

         <div class="col s4">  
          
            <!-- Categoires : Logic - Nested loop -->
            <?php foreach($menus as $menu): ?>

                <div id="category<?=  $menu->id ?>" class='menu_category <?= $active_menu == $menu->id ? 'active' : '' ?>'>
                    <p >
                        <?=  ucfirst($menu->menu) ?>
                    </p>

                    <p>
                        <input class="with-gap reset_cat uncategorize" name="cat" type="radio" id="uncategorize<?= $menu->id ?>" value='0' />
                        <label for="uncategorize<?= $menu->id ?>"> Uncategorize </label>  
                    </p>
                    <?php foreach($categories as $cat): ?>
                        <?php if($menu->id == $cat->menu_id) :?>
                      
                        <p class='category_trigger <?= $cat->id ?>'>
                            <input class="with-gap reset_cat" name="cat" type="radio" id="cat<?= $cat->id ?>"  value='<?= $cat->id ?>'
                            <?php
                                if(isset($post_edit)){
                                    if($post_edit->category_id === $cat->id){
                                        echo 'checked';
                                    }
                                }
                            ?>
                             />
                            <label for="cat<?= $cat->id ?>"><?=  ucfirst($cat->title) ?></label>  
                        </p>

                        <?php 
                            /** Foot print */
                            if ( isset($post_edit) ) {   
                                if( $post_edit->category_id === $cat->id ) {
                                   $were_in_category = $cat->title;
                                }
                            }
                        ?>
                        
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>

            <?php endforeach; ?>        
       </div>  <!--- End  Category Section Div--> 

       <!-- Sub Categories -->
       <div class="col s4">
            
            <?php foreach($categories as $cat): ?>
            <div id="subcategory<?=  $cat->id ?>" class='menu_subcategory 
                   <?php
                        if(isset($post_edit)){
                            if($post_edit->category_id === $cat->id){
                                echo 'active';
                                
                            }
                        }
                    ?>'>
                    <p>
                        <?=  ucfirst($cat->title) ?>
                    </p>

                    <p>
                        <input class="with-gap reset_subcat" name="subcat" type="radio" id="unsubcategorize<?= $cat->id ?>" value='0'
                         />
                        <label for="unsubcategorize<?= $cat->id ?>"> Unsub-categorize </label>  
                    </p>
                    <?php foreach($subcategories as $subcat): ?>
                        <?php if($cat->id == $subcat->category_id) :?>
                      
                        <p>
                            <input class="with-gap reset_subcat" name="subcat" type="radio" id="subcat<?= $subcat->id ?>"  value='<?= $subcat->id ?>' 
                            <?php
                                if(isset($post_edit)){
                                    if($post_edit->sub_category_id === $subcat->id){
                                        echo 'checked';
                                    }
                                }
                            ?> />
                            <label for="subcat<?= $subcat->id ?>"><?=  ucfirst($subcat->title) ?></label>  
                        </p>
                        
                        <?php 
                            /** Foot print */
                            if ( isset($post_edit) ) {   
                                if( $post_edit->sub_category_id === $subcat->id ) {
                                   $were_in_subcategory = $subcat->title;
                                }
                            }
                        ?>

                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>  
     
       </div>  <!--- End  Sub categories section div --> 
        <?php if(isset($post_edit)) : ?>
            <div class="col s12 orange-text" style='padding:10px; border-top:1px solid '>
                    <div class="col s4">
                        <?=  isset($were_in_menu) ? ucfirst($were_in_menu) : '' ?>     
                    </div>
                    <div class="col s4">
                        <?=  isset($were_in_category) ? ucfirst($were_in_category) : '' ?>     
                    </div>
                    <div class="col s4">
                        <?=  isset($were_in_subcategory) ? ucfirst($were_in_subcategory) : '' ?>     
                    </div>
            </div>
        <?php endif; ?> 
     </div> <!-- End Container of Menu - Category - sub category Div-->

                                                    
    </div>

    <!-- Right Side -->

    <div class="col s4 ">
      <div class="col s12 orange-text">
      <?php if(!isset($post_edit)) : ?>
        <p>Status : Draft </p>
        <?php else : ?>

         <?php if($post_edit->switch === 'on'): ?>
              <p>Status : Published </p>
             <?php else : ?>
             <p>Status : Draft </p>
         <?php endif ?>

     <?php endif; ?> 
      
      </div>
      <div class="col s6">
        <p> Article switch  </p>
            <div class="switch">
                <label>
                Draft
                <input type="checkbox" name='article_switch' 
                <?php
                    if(isset($post_edit)){
                        if($post_edit->switch === 'on'){
                            echo 'checked';
                        }
                    }
                ?>
                >
                <span class="lever"></span>
                On
                </label>
            </div>
      </div>

      <div class="col s6">
        <p> Allow comment  </p>
            <div class="switch">
                <label>
                No
                <input type="checkbox" name='article_switch_comment' 
                
                <?php
                    if(isset($post_edit)){
                        if($post_edit->switch_comment === 'on'){
                            echo 'checked';
                        }
                    }else{
                        echo 'checked';
                    }
                ?>
                 >
                <span class="lever"></span>
                Yes
                </label>
            </div>
      </div>
      
       <div class="col s12">
       <br/>
        <p> Article Attach  </p>
            <div class="switch">
                <label>
                Youtube Video Link
                <input type="checkbox" name='article_switch_attach'   
                 <?php
                    if(isset($post_edit)){
                        if($post_edit->switch_attach === 'image'){
                            echo 'checked';
                        }
                    }else{
                        echo 'checked';
                    }
                ?> >
                <span class="lever"></span>
                Image
                </label>
            </div>
            <br/>
      </div>
     
     <div class="col s6">
           
            <p> Date  </p> 
           
       </div>
       <div class="col s6">
           
            <p> Time  </p> 
             
       </div>
       
        <div class="col s12">
            <i class="fa fa-info-circle orange-text"></i>  Leave date or time to set default
        </div>
       
       <div class="col s6">

            <?php if(isset($post_edit)): ?>
                        <input type="date" name='article_date' class='cust_input datepicker' value='<?= date('Y-m-d', strtotime($post_edit->date)) ?>' style=''  />
                    <?php else: ?>
                        <input type="date" name='article_date' class='cust_input datepicker' placeholder=' ' style=''  />
            <?php endif ?>
           
       </div>

       <div class="col s6">      
            <?php if(isset($post_edit)): ?>
                    <input type="time"  name='article_time' class='cust_input datepicker' value='<?= date('H:m:s', strtotime($post_edit->date)) ?>'  style=''  />
                    <?php else: ?>
                    <input type="time"  name='article_time' class='cust_input datepicker' placeholder=' ' style=''  />
            <?php endif ?>

       </div>



       <div class="col s12">
            <br/>
            <p> Tags : <i class="fa fa-info-circle orange-text"></i> Used on search bar and Google </p> 
            <?php if(isset($post_edit)): ?>
                    <input type="text" name='article_tags'  class='cust_input' value='<?= $post_edit->tags ?>' style=''   />
                  <?php else: ?>
                     <input type="text" name='article_tags'  class='cust_input' placeholder=' ' style=''   />
           <?php endif ?>
          
       </div>

       

       <div class="col s12">
            <br/>
            <p> Title tag contents (Optional)  </p> 
            <?php if(isset($post_edit)): ?>
                    <input type="text" name='article_title_tag_contents'  class='cust_input' value='<?= $post_edit->title_tag_contents ?>' style=''   />
                  <?php else: ?>
                     <input type="text" name='article_title_tag_contents'  class='cust_input' placeholder=' ' style=''   />
           <?php endif ?>
           
       </div>

       <div class="col s12">
            <br/>
            <p> Description Meta tag Content (Optional)  </p> 
            <?php if(isset($post_edit)): ?>
                    <input type="text" name='article_description_meta_tag_content'  class='cust_input' value='<?= $post_edit->desc_meta_tag_content ?>' style=''   />
                  <?php else: ?>
                     <input type="text" name='article_description_meta_tag_content'  class='cust_input' placeholder=' ' style=''   />
           <?php endif ?>

       </div>

       <div class="col s12">
            <br/>
            <p> Keywords Meta tag content (Optional)   </p> 
            <?php if(isset($post_edit)): ?>
                    <input type="text" name='article_keywords_meta_tag_content'  class='cust_input' value='<?= $post_edit->keyword_meta_tag_content ?>' style=''   />
                  <?php else: ?>
                     <input type="text" name='article_keywords_meta_tag_content'  class='cust_input' placeholder=' ' style=''   />
           <?php endif ?>
           
       </div>

  

    </div>


</div>
</form>