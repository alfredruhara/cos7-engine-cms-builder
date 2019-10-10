<?php
#Getting the instance of the system App
$systemApprove = System::getInstance();
$back = '?vl='.$systemApprove->cursor('comment')['index']['out'];
#chechikng 
if(isset($_GET['com_id']) && isset($_GET['pst']) ) {
    #Checking if the comment its a number range or contain only numeric values
    if(preg_match('/^[0-9]*$/',$_GET['com_id']) && preg_match('/^[0-9]*$/',$_GET['pst'])) {
        #Oky : now Saving the com_id && post _id 
        $comment_id = $_GET['com_id'];
        $post_id    = $_GET['pst'];
    }
}

if( !isset($comment_id) ) $systemApprove->cos_redirect($back);
$comment_table = $systemApprove->getTable('comment');

# ... !important
$comment = $comment_table->get_partials((int)$comment_id);

if( $comment === false )
{
    $flash->set('com_ref_broken','danger');
    $systemApprove->cos_redirect($back);
}
$article_table = $systemApprove->getTable('article');


# checking ->else redirect
if( isset($_GET['appr']) && !isset($_GET['unappr']) ) {
    #case of to approve unapproved comment ... !important
    if( $comment->pending == '1' && $comment->spam == '0' && $comment->moved_to_trash == '0' )
    {
        $sawa = $comment_table->update($comment_id,['pending' => 0 ]);
        if ( $sawa === true )
        {
            $article_table->update((int)$comment->post_id,['comment_count' => (int)$comment->comment_count + 1]);
            $flash->set('success', 'success');
        }else
        {
            $flash->set('fatal_error', 'danger');
        }
    }else{
        $flash->set('not', 'warning');
    }
    $systemApprove->cos_redirect($back);
}else if ( isset($_GET['unappr']) && !isset($_GET['appr']) )
{
    #case of to unprove approved comment ... !important
    if( $comment->pending == '0' && $comment->spam == '0' && $comment->moved_to_trash == '0' )
    {
        $sawa = $comment_table->update($comment_id,['pending' => 1 ]);
        if ($sawa === true)
        {
            $article_table->update((int)$comment->post_id,[
                'comment_count' => (int)$comment->comment_count > 0 ? (int)$comment->comment_count - 1 : 0
            ]);   
            $flash->set('success', 'success');
        }else
        {
            $flash->set('fatal_error', 'danger');
        }
    }else{
        $flash->set('not', 'warning');
    }
    $systemApprove->cos_redirect($back);
}else
{
    $flash->set('unexcepted','danger');
}
# Never stay on this page
$systemApprove->cos_redirect($back);

?>