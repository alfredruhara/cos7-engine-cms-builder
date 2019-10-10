<?php
$systemTrash = System::getInstance();
$back = '?vl='.$systemTrash->cursor('comment')['index']['out'];
#chechikng zzssssbajsaas
if(isset($_GET['com_id']) ) {
    #Checking if the comment its a number range or contain only numeric values
    if(preg_match('/^[0-9]*$/',$_GET['com_id'])) {
        #Oky : now Saving the com_id && post _id 
        $comment_id = $_GET['com_id'];
    }
}

if( !isset($comment_id) ) $systemTrash->cos_redirect($back);
$comment_table = $systemTrash->getTable('comment');

# ... !important
$comment = $comment_table->get_partials((int)$comment_id);

if( $comment === false )
{
 
    if(!isset($_GET['delete']) ){
        $flash->set('com_ref_broken','danger');
        $systemTrash->cos_redirect($back);
    }else{
        $try_delete_id = (int)$comment_id; 
    }

}
$article_table = $systemTrash->getTable('article');

if( isset($_GET['spam']) AND !isset($_GET['move'])  AND !isset($_GET['restore']) AND !isset($_GET['delete']) )
{
    # ... !important
    if ( $comment->spam == '0' )
    {
        $sawa = $comment_table->update($comment->com_id,['moved_to_trash' => 0,'spam' => 1]);
        $sawa === true ? $flash->set('mark_spam','success') : $flash->set('fatal_error','danger');
    }else
    {
        $flash->set('not','warning');
    }
    $systemTrash->cos_redirect($back);
}else if ( isset($_GET['move']) AND !isset($_GET['restore']) AND !isset($_GET['spam']) AND !isset($_GET['delete'])  )
{
    # ... !important
    if ( $comment->moved_to_trash == '0' )
    {
        $sawa = $comment_table->update($comment->com_id,['moved_to_trash' => 1,'spam' => 0]);
        if ( $sawa  === true )
        {
            # ... !important
            if($comment->pending == '0')
            {
                $article_table->update((int)$comment->post_id,[
                    'comment_count' => (int)$comment->comment_count > 0 ? (int)$comment->comment_count - 1 : 0
                ]);   
            }
            $flash->set('move_to_trash', 'success');
        }else
        {
            $flash->set('fatal_error', 'danger');
        }
    }else{
        $flash->set('not','warning');
    }
    $systemTrash->cos_redirect($back);
}else if ( isset($_GET['restore']) AND !isset($_GET['move'])  AND !isset($_GET['spam']) AND !isset($_GET['delete']) )
{   
    # ... !important
    if ( $comment->moved_to_trash == '1' )
    {
        $sawa = $comment_table->update($comment->com_id,['moved_to_trash' => 0 ]);
        if ( $sawa  === true )
        {
             # ... !important
             if ($comment->pending == '0' ) 
             {
                   $article_table->update((int)$comment->post_id,['comment_count' => (int)$comment->comment_count + 1]);   
             }
            $flash->set('restore_from_trash','success');
        }else
        {
            $flash->set('fatal_error','danger');
        }
    }else
    {
        $flash->set('not','warning');
    }
    $systemTrash->cos_redirect($back);
}else if (isset($_GET['delete']) AND !isset($_GET['restore']) AND !isset($_GET['move']) AND !isset($_GET['spam']))
{
      #Delete a comment
      if(isset($try_delete_id))
      {
        $sawa = $comment_table->delete($try_delete_id);
        $sawa === true ? $flash->set('success','success') :  $flash->set('fatal_error','danger') ;
        $systemTrash->cos_redirect($back);
      }else
      {
            $sawa = $comment_table->delete($comment->com_id);
      }

      $sawa = $comment_table->delete($comment->com_id);
      if ( $sawa  === true ) {
          if($comment->pending == '0')
          {
              $article_table->update((int)$comment->post_id,[
                  'comment_count' => (int)$comment->comment_count > 0 ? (int)$comment->comment_count - 1 : 0
              ]);   
          }
          $flash->set('comment_delete','success');
      } else {
          $flash->set('fatal_error','danger');
      }
    $systemTrash->cos_redirect($back);
}else{
    $flash->set('unexcepted','danger');
}
# Never stay on this page 
$systemTrash->cos_redirect($back);


?>