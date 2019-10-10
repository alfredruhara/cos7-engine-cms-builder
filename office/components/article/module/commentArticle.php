<?php
  $systemComArticle = System::getInstance();
  $self = '?vl='.$systemComArticle->cursor('article')['index']['out'] ;
  if(isset($_GET['post_id']))
  {
    if(preg_match("/^[0-9]*$/",$_GET['post_id']) ) 
    {
        $get_id_of_post = $_GET['post_id'];
    }
  }
  isset($get_id_of_post) ? '' : header($self);
  $article_table_com_sys = $systemComArticle->getTable('article');
  $article = $article_table_com_sys->short_article((int)$get_id_of_post);
  if($article === [] || $article === false )  $systemComArticle->cos_redirect($self) ;
?>
<?php
    if(isset($_POST['comment'])) 
    {   
       $comment_value = isset($_POST['com']) ? $systemComArticle->formatInput($_POST['com']) : '';
       if ( $comment_value != '' )
       {
            $comment_table = $systemComArticle->getTable('comment'); 
            $mambo_yote_sawa = $comment_table->create([
                'post_id'   => $article->id,
                'email'     => 'chada@email.com',
                'full_name' => 'Alfred Default',
                'comment'   => $comment_value
            ]);
            $mambo_yote_sawa === true ? $flash->set('success','success') : $flash->set('fatal_error','danger');
       }
       $systemComArticle->cos_redirect($self);
    }
?>
<div class="row cust_menu">
    <div class="col s10 pinned cust_menu " style='z-index:99; border-bottom:10px solid #292934'>
        <!-- Left  -->
        
         <div class="col s8 ">
             <h5><i class="fa fa-comment"></i> Comment <?= ucfirst($article->title) ?>'s article </h5>
             
             <a href="?vl=<?= $systemComArticle->cursor('article')['index']['out'] ?>" style='font-size:18px;' class='white-text'>
                 <i class="fa fa-arrow-left"></i> Article
             </a>

            <div>
                <a href="#!"> <i class="white-text fa fa-eye"></i>  Full view </a>  
                <a href="?vl=<?= $systemComArticle->cursor('article')['new']['out'] ?>&id=<?= $article->id ?>" style='margin-left:10px;' > <i class="white-text fa fa-edit"></i>  Edit </a>  
                <a href="?vl=<?= $systemComArticle->cursor('article')['delete']['out'] ?>&id=<?= $article->id ?>" style='margin-left:10px;' > <i class="red-text fa fa-trash"></i>  Delete </a>  
             
               
               
            </div>
         </div>
         <div class="col s4 right-align orange-text" style='margin-top:10px;'> 
            <h6> Commenting mode</h6>
        </div>
       


    </div>
</div> 
<br/><br/><br/><br/>

<div class="col s12">
    <div class="col s12"> 
        <h5> Title : <?= $article->title ?> </h5>
        <blockquote style='border-left-color:grey;'>
            <?= nl2br($systemComArticle->sub_string($article->content,1400)) ?>
        </blockquote>

        <div class="col s12">
            <p><i class="fa fa-comment"></i> Comment </p>

            <form action="#!" method='post'> 
                <div class="col s12">
                   
                    <textarea name='com' class="materialize-textarea" placeholder='Write...' required></textarea>
                </div>
                <div class="col s12">
                  <button class="btn blue z-depth-0" type='submit' name='comment'> Comment </button>
                </div>

           </form>
            
        </div>
       
    </div>
</div>