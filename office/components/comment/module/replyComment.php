<?php
  $systemReply = System::getInstance(); 
  $back = '?vl='.$systemReply->cursor('comment')['index']['out'];;

  if(isset($_GET['com_id'])){
    if(preg_match("/^[0-9]*$/",$_GET['com_id']) ) {
        $get_id_of_comments = $_GET['com_id'];
    }
  }
  isset($get_id_of_comments) ? '' : $systemReply->cos_redirect($back);
  
  $comment_table = $systemReply->getTable('comment');
  $comment = $comment_table->findCom($get_id_of_comments);
  $comment === [] || $comment === false ?  $systemReply->cos_redirect($back) : '' ;
 

?>

<?php
    if(isset($_POST['comment'])) {
       
       $comment_value = isset($_POST['com']) ? $systemReply->formatInput($_POST['com']) : '';

       if ( $comment_value != '' ){
            $mambo_yote_sawa = $comment_table->create([
                'parent_id' => $comment->com_id,
                'post_id'   => $comment->post_id,
                'email'     => 'chada@email.com',
                'full_name' => 'Alfred Default',
                'comment'   => $comment_value
            ]);
           $mambo_yote_sawa === true ? $flash->set('success') : $flash->set('fatal_error');   
       }else{
           $flash->set('required');
       }
       $systemReply->cos_redirect($back);
    }

?>
<div class="row cust_menu">
    <div class="col s10 pinned cust_menu " style='z-index:99; border-bottom:10px solid #292934'>
        <!-- Left  -->
        
         <div class="col s8 ">
            <h5><i class="fa fa-reply"></i> Reply To <?= ucfirst($comment->full_name ) ?>'s comment </h5>
           <a href="?vl=<?= $systemReply->cursor('comment')['index']['out']; ?>" style='font-size:18px;' class='white-text'>
             <i class="fa fa-comment"></i> Comments </a>
            <div>
               
               
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
        <h5> Reference article : <?= $comment->title ?> </h5>
        <blockquote style='border-left-color:grey;'>
           <span class="orange-text"> Comment </span> - Subimitted on <?= $comment->date ?>   <br/>
            <?= nl2br($comment->comment) ?>
        </blockquote>

        <div class="col s12">
            <p><i class="fa fa-reply"></i> Reply </p>

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