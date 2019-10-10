<?php
$systemSpam = System::getInstance();
$back = '?vl='.$systemSpam->cursor('comment')['index']['out'];
#chechikng 
if(isset($_GET['com_id']) ) {
    #Checking if the comment its a number range or contain only numeric values
    if(preg_match('/^[0-9]*$/',$_GET['com_id'])) {
        #Oky : now Saving the com_id && post _id 
        $comment_id = $_GET['com_id'];
    }
}

if( !isset($comment_id) ) $systemSpam->cos_redirect($back);
$comment_table = $systemSpam->getTable('comment');

# ... !important
$comment = $comment_table->get_partials((int)$comment_id);

if( $comment === false ) {
    if(!isset($_GET['delete']) ){
        $flash->set('com_ref_broken','danger');
        $systemSpam->cos_redirect($back);
    }else{
        $try_delete_id = (int)$comment_id; 
    }
   
}
$article_table = $systemSpam->getTable('article');

if( isset($_GET['spam']) AND !isset($_GET['notspam'])  AND !isset($_GET['delete']) AND !isset($_GET['keep']) )
{
    # ... !important
    if($comment->spam == '0')
    {
        $sawa = $comment_table->update($comment->com_id,['spam' => 1,'moved_to_trash' => 0 ]);
        if ( $sawa  === true )
        {   # ... !important
            if($comment->pending == '0')
            {
                $article_table->update((int)$comment->post_id,[
                    'comment_count' => (int)$comment->comment_count > 0 ? (int)$comment->comment_count - 1 : 0
                ]);   
            }

            $flash->set('mark_spam','success');
        }else
        {
            $flash->set('fatal_error','danger');
        }
    }
    $systemSpam->cos_redirect($back);

}else if ( isset($_GET['notspam']) AND !isset($_GET['spam']) AND !isset($_GET['delete']) AND !isset($_GET['keep']) )
{
     # ... !important
     if($comment->spam == '1')
     {
        # ... unset as spam
        $sawa = $comment_table->update($comment->com_id,['spam' => 0 ]);
    
        if ( $sawa  === true ) {
            # ... !important
            if ($comment->pending == '0' ) 
            {
                  $article_table->update((int)$comment->post_id,['comment_count' => (int)$comment->comment_count + 1]);   
            }
            $flash->set('restore_from_spam','success');
        }else{
            $flash->set('fatal_error','danger');
        }
    }
    $systemSpam->cos_redirect($back);

}else if ( isset($_GET['keep']) AND !isset($_GET['delete']) AND !isset($_GET['notspam']) AND !isset($_GET['spam']) )
{
    # ... !important
    if($comment->spam == '1')
    {
        $sawa = $comment_table->update($comment->com_id,[
            'spam' => 0,
            'moved_to_trash' =>1 
        ]);
       $sawa === true ? $flash->set('move_to_trash','success') : $flash->set('fatal_error','danger');
    }
    $systemSpam->cos_redirect($back);

}else if ( isset($_GET['delete']) AND !isset($_GET['notspam']) AND !isset($_GET['spam']) AND !isset($_GET['keep']) )
{
    #Delete a comment
    if(isset($try_delete_id)){
        $sawa = $comment_table->delete($try_delete_id);
        $sawa === true ? $flash->set('success','success') :  $flash->set('fatal_error','danger') ;
        $systemSpam->cos_redirect($back);
    }else{
        $sawa = $comment_table->delete($comment->com_id);
    }
   
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
    $systemSpam->cos_redirect($back);

}else
{
    $flash->set('unexcepted','danger');
}
#never stay on this page !
$systemSpam->cos_redirect($back);

?>