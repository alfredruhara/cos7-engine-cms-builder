
<?php
    #System App instance initialize
    $systemCom = System::getInstance();
    #Comment Table Class Instance initialize
    $comment_table = $systemCom->getTable('comment');
    # If status filter was send
    if (isset($_GET['status'])){
        #Making sure its contains only a-z caracters
        if(preg_match('/^[a-z]*$/',$_GET['status'])) {
            #Status expected to receive
            $status_expected = ['all','approved','pending','spam','trash'];
             #Checking if we have received right value 
             if(in_array((string)$_GET['status'], $status_expected)){
                 #saving the filter status sent
                 $com_status_filter = $_GET['status'];
             } 
        }
    }
    if (isset($_POST['fire'])) {
        $excepted_actions = ['approve','unapprove','spam','notspam','restore','trash','delete'];

        isset($_POST['fireactions']) ? in_array($_POST['fireactions'], $excepted_actions) ?  $action = $_POST['fireactions'] : '' : '';
        isset($_POST['idCom']) ? is_array($_POST['idCom']) ? $ids = $_POST['idCom'] : '' : '';
        $status = false ;
      
        if(isset($action) && isset($ids)){
            
            foreach($ids as $id){
                if (preg_match('/^[0-9]*$/',$id))
                {
                    #Getting the comments
                    $comment = $comment_table->get_partials((int)$id);
                    #Comment found
                    if ($comment != false)
                    {
                        #Article table
                        $article_table = $systemCom->getTable('article');
                        # switch between actions to find one to perform
                        switch ($action)
                        {
                            case ($action == 'approve') :
                               # if the comment is not approved
                               if ($comment->pending == '1' && $comment->spam == '0' && $comment->moved_to_trash == '0' &&  $com_status_filter !== 'approve' && $com_status_filter !== 'spam' &&  $com_status_filter !=='trash' ) 
                               {
                                     $comment_table->update($id,['pending' => 0 ]);
                                     $article_table->update((int)$comment->post_id,['comment_count' => (int)$comment->comment_count + 1]);   
                               }
                               break;
    
                            case ($action == 'unapprove') :
                                if ($comment->pending == '0'  && $comment->spam == '0' && $comment->moved_to_trash == '0'  && $com_status_filter !== 'pending' &&  $com_status_filter !== 'spam' &&  $com_status_filter !=='trash') 
                                {
                                    $comment_table->update($id,['pending' => 1 ]);
                                    $article_table->update((int)$comment->post_id,[
                                        'comment_count' => (int)$comment->comment_count > 0 ? (int)$comment->comment_count - 1 : 0
                                    ]);   
                                }
                                break;

                            case ($action == 'spam') :
                                # Denied Spam,Trash Tabs to execute ... no way to bypass.
                                if($comment->spam == '0' &&  $com_status_filter !== 'spam' &&  $com_status_filter !=='trash' )
                                 {
                                    # Mark it as a spam
                                    $comment_table->update($id,['spam' => 1,'moved_to_trash' => 0]);

                                    # if comment is approved (online)
                                    if($comment->pending == '0'){
                                        # count down the article were this comment its attached becoz its already offline(declared as a spam)
                                        $article_table->update((int)$comment->post_id,[
                                            'comment_count' => (int)$comment->comment_count > 0 ? (int)$comment->comment_count - 1 : 0
                                        ]);   
                                    }
                                }
                                break;
                            
                            case ($action == 'notspam') :
                                # ... !important
                                if($comment->spam == '1' && $com_status_filter === 'spam')
                                {
                                    $sawa = $comment_table->update($comment->com_id,['spam' => 0,'moved_to_trash' => 0 ]);
                                    if ( $sawa  === true )
                                    {   # ... !important
                                        if($comment->pending == '0')
                                        {
                                            $article_table->update((int)$comment->post_id,['comment_count' => (int)$comment->comment_count + 1]); 
                                        }
                                    }
                                }
                                break;
    
                            case ($action == 'trash') :
                                # if comment is not in the trash
                                if($comment->moved_to_trash == '0' && $com_status_filter !== 'spam' &&  $com_status_filter !== 'trash' ){
                                    # Move it to the trash
                                    $comment_table->update($id,['moved_to_trash' => 1,'spam' => 0]);

                                    # if comment is approved (online)
                                    if($comment->pending == '0'){
                                     
                                        $article_table->update((int)$comment->post_id,[
                                            'comment_count' => (int)$comment->comment_count > 0 ? (int)$comment->comment_count - 1 : 0
                                        ]);     
                                    }
                                }
                                break;

                            case ($action == 'restore') :
                                 # ... !important
                                if ( $comment->moved_to_trash == '1' && $com_status_filter === 'trash' )
                                {
                                    $sawa = $comment_table->update($comment->com_id,['moved_to_trash' => 0 ]);
                                    if ( $sawa  === true )
                                    {
                                        # ... !important
                                        if ($comment->pending == '0' ) 
                                        {
                                            $article_table->update((int)$comment->post_id,['comment_count' => (int)$comment->comment_count + 1]);   
                                        }
                                    }
                                }
                                break;
    
                            case ($action == 'delete') :
                                $sawa = $comment_table->delete($comment->com_id);
                                if($comment->pending == '0')
                                 {
                                        $article_table->update((int)$comment->post_id,[
                                            'comment_count' => (int)$comment->comment_count > 0 ? (int)$comment->comment_count - 1 : 0
                                        ]);   
                                 }
                                
                            default:
                                $flash->set('unexcepted', 'danger');
                            break;
                        }
                        # flash system .. mecanique grave koz of the loop
                        $status = true ;
                    }else{
                        if($action == 'delete'){
                            $sawa = $comment_table->delete((int)$id);
                            $sawa == true ?  $status = true : ''; 
                        }
                    }
                   
                }else{
                    $flash->set('id_error','danger');
                }
            }
            if ($status) {
                $flash->set('success','success');
            } else {
                $flash->set('id_error','danger');
                $flash->set('com_ref_broken','danger');
            }
            
        }else{
            $flash->set('unexcepted', 'danger');
        }
        $systemCom->cos_redirect('?vl='.$systemCom->cursor('comment')['index']['out']);
   }
    #Checking if the filter was found other wise : use default : which all .
    if(isset($com_status_filter)){
        #Swich between case we have been expected
        switch ($com_status_filter){
          #Default case
          case ($com_status_filter === 'all') : 
                #Send a query a get all comments.
                $comments = $comment_table->comments('all'); 
                break;
          #Case where the filter value is pending 
          case ($com_status_filter === 'pending') : 
                #Send a query to get all pending comments (Awaiting validation comments)
                $comments = $comment_table->comments('pending');
                break;
          #Case where the filter value is pending 
          case ($com_status_filter === 'approved') : 
                #Send a query to get all approved comments. (Comments visible directly on the website)
                $comments = $comment_table->comments('approved');
                break;
          #Case where the filter value is pending 
          case ($com_status_filter === 'spam') : 
                #Send a query to get all declared comments as spam (virus , malicious comments)
                $comments = $comment_table->comments('spams');
                break;
          #Case where the filter value is pending 
          case ($com_status_filter === 'trash') : 
                #Send a query to get or retrieve all comment moved to  trash
                $comments = $comment_table->comments('trashes');
                break;

          default : 
               #If the switch fail make this as default state : get all comments
               $comments = $comment_table->comments();
               $com_status_filter = 'all';
               break;

        }

    }else{
        #else : status not found
        $comments = $comment_table->comments();
        $com_status_filter = 'all';
    }

    #Micro counts
    $stat_all     =  $comment_table->count_all();
    $stat_spams   =  $comment_table->count_spam();
    $stat_trashed = $comment_table->count_trash();
    
    $pending  = 0;
    $approved = 0;

    if($stat_all > 0 ){
    foreach($stat_all as $com){
        if($com->pending === '1'){
            $pending++;
        }else{
            $approved++;
        }

        }
    }
    
?>


<div class="row cust_menu">
    <div class="col s10 pinned cust_menu " style='z-index:99; border-bottom:10px solid #292934'>
        <!-- Left  -->
         <div class="col s12 ">
           
            <h5><i class="fa fa-comment"></i> Comments </h5>
           
         </div>
        
            <div class="nav-content" style=''>
                <ul class="tabs_cust  ">
                    <li class="tab_cust <?= $com_status_filter === 'all' || $com_status_filter === 'all' ? 'active' : '' ?>">

                        <a  class='white-text' href="?vl=<?= $systemCom->cursor('comment')['index']['out'] ?>&status=all"> 
                            All  (<?= isset($stat_all) ? count( $stat_all) : '0' ?>)
                        </a>

                    </li>
                    <li class="tab_cust <?= $com_status_filter === 'pending' ? 'active' : '' ?>">
                        <a  class=" orange-text" href="?vl=<?= $systemCom->cursor('comment')['index']['out'] ?>&status=pending"> 
                            <i class="fa fa-check"></i> Pending (<?= isset($pending) ? $pending : '0' ?>)  
                        </a>
                    </li>
                    <li class="tab_cust <?= $com_status_filter === 'approved' ? 'active' : '' ?>">
                        <a  class='green-text' href="?vl=<?= $systemCom->cursor('comment')['index']['out'] ?>&status=approved">
                            <i class="fa fa-check"></i> Approved (<?= isset($approved) ? $approved : '0' ?>)  
                        </a>
                    </li>
                    <li class="tab_cust <?= $com_status_filter === 'spam' ? 'active' : '' ?>">
                        <a  class='red-text' href="?vl=<?= $systemCom->cursor('comment')['index']['out'] ?>&status=spam">
                            <i class="fa fa-bug"></i>  Spam (<?= isset($stat_spams) ? $stat_spams : '0' ?>)
                    </a>
                    </li>
                    <li class="tab_cust <?= $com_status_filter === 'trash' ? 'active' : '' ?>">
                        <a  class='red-text' href="?vl=<?= $systemCom->cursor('comment')['index']['out'] ?>&status=trash"> 
                            <i class="fa fa-trash"></i>  Trash (<?= isset($stat_trashed) ? $stat_trashed : '0' ?>) 
                        </a>
                    </li>

                </ul>
            </div>
    </div>
</div> 
<br/><br/><br/><br/>

<form method='post'>

    <div class="col s12 ">
              <div class="col s6  " style='padding:0px; margin-top:15px;'>

                    <?php if($com_status_filter === 'pending') :?>
                      <h5 class='orange-text' ><i class="fa fa-check"></i> <?=  ucfirst($com_status_filter) ?>  Comments</h5>
                    <?php endif;?>

                    
                    <?php if($com_status_filter === 'approved') :?>
                      <h5 class='green-text' ><i class="fa fa-check"></i> <?=  ucfirst($com_status_filter) ?>  Comments</h5>
                    <?php endif;?>

                    
                    <?php if($com_status_filter === 'spam') :?>
                      <h5 class='red-text' ><i class="fa fa-bug"></i> <?=  ucfirst($com_status_filter) ?>  Comments</h5>
                    <?php endif;?>

                    
                    <?php if($com_status_filter === 'trash') :?>
                      <h5 class='red-text' ><i class="fa fa-trash"></i> <?=  ucfirst($com_status_filter) ?>  Comments</h5>
                    <?php endif;?>


              </div>
              <div class="col s2 " style='padding:0px;'>
                      <div class="col s12">
                      <label for="">Check for Spam comments</label>
                      </div>
                     <div class="col s12" style='margin-top:10px;'> 
                            <button class="btn z-depth-0 orange" type='submit' name='fire'>
                            <i class="fa fa-bug"></i>        Fire Check
                            </button>
                    </div>
              </div>
               <div class="col s4" style='padding:0px;'>
                    <div class="col s8">	
                        <label>Fire actions</label>
                        <select name="fireactions" id="">
                                
                                <?php if($com_status_filter == 'all' ): ?>
                                    <option value="approve">Approve</option>
                                    <option value="unapprove">Unapprove</option>
                                    <option value="spam">Mark as Spam</option>
                                    <option value="trash">Move to Trash</option>
                                <?php endif; ?>
                                
                                <?php if($com_status_filter === 'approved' ): ?>
                                     <option value="unapprove">Unapprove</option>
                                 <?php endif; ?>
                                 
                                 <?php if($com_status_filter === 'pending' ): ?>
                                     <option value="approve">Approve</option>
                                 <?php endif; ?>

                                <?php if($com_status_filter === 'spam' ): ?>
                                     <option value="notspam"> Not Spam </option>
                                 <?php endif; ?>

                                 <?php if($com_status_filter === 'trash' ): ?>
                                     <option value="restore"> Restore </option>
                                 <?php endif; ?>

                                <option value="delete">Delete</option>
                                
                        </select>
                    </div>
                    <div class="col s4 right-align" style='margin-top:32px;'> 
                            <button class="btn z-depth-0 orange" type='submit' name='fire'>Fire</button>
                    </div>
                </div>

                
    </div>

    <div class="col s12 cust_menu">
    <div class="col s12">
    <table class="striped highlight  responsive-table ">
                <thead class='' style=''>
                <tr >
                    
                    <th  class="left-align"> 
                        <p class="burn_all">
                            <input type="checkbox"  class=''  id='burn_all' onclick="checkAll(this.form, 'idCom[]')"/>
                            <label for="burn_all"></label> 
                        </p>
                    </th>

                    <th  class="left-align"> On </th>
                    <th  class="left-align" >By Author </th>
                    <th  class="left-align">Comment</th> 
                    <th  class="left-align orange-text">Ref. Article </th>
                   
                </tr>
                </thead>
        
                <tbody>
                    <?php if($comments != []) : ?>
                    <?php foreach($comments as $comment): ?>
                        <tr class='capture-hover  <?=  $comment->pending === '1' ?'unapproved-comment' : ''?>'  >
                           
                           <td> 
                                <input type="checkbox" name="idCom[]" id="comm<?= $comment->com_id ?>"  value='<?= $comment->com_id ?>' />
                                <label for="comm<?= $comment->com_id ?>" class='burn_action'></label>                
                            </td>
                           
                            <td  class="">
                                <?=  $comment->date ?>
                            </td>

                            <td  class="" >
                                <?= ucfirst( $comment->full_name ) ?>  <br/>
                                <?= ucfirst( $comment->email ) ?> 
                            </td>
                        
                            <td class='left-align capture-action' > 
                                 
                                 <?php if($comment->parent_id != null && $comment->parent_id != null ): ?>
                                       
                                        <?php
                                               
                                            $send_request = $comment_table->replied_com($comment->parent_id);
                                         
                                         ?>
                                         <?php  if( $send_request != [] AND $send_request != false ): ?>
                                             
                                                <i class="fa fa-reply orange-text"></i> Replied to 
                                                <a  style='text-decoration:underline;'
                                                    href="?vl=<?= $systemCom->cursor('comment')['reply']['out'] ?>&com_id=<?= $send_request->id ?>">
                                                    <?= $send_request->full_name ?>'comment </a> : <br/> <br/>
                                               
                                         <?php endif; ?>

                                 <?php endif; ?>


                                 <?= ucfirst($systemCom->sub_string($comment->comment,1000)) ?>  <br/> <br/>
                                
                                <div class="actions-hover">
                                   
                                     <?php if($com_status_filter != 'spam' AND $com_status_filter != 'trash'):?>

                                            <?php if($comment->pending === '0') : ?>
                                                <a href="?vl=<?= $systemCom->cursor('comment')['approve']['out'] ?>&com_id=<?= $comment->com_id ?>&unappr=1&pst=<?= $comment->post_id ?>" >
                                                    <span class='orange-text '> <i class=" fa fa-check"> </i>  Unapprove </span>
                                                </a>
                                                <?php else : ?>
                                                
                                                <a href="?vl=<?= $systemCom->cursor('comment')['approve']['out'] ?>&com_id=<?= $comment->com_id ?>&appr=0&pst=<?= $comment->post_id ?>" >
                                                <span class='green-text '> <i class="fa fa-check"> </i>  Approve </span>
                                                </a>

                                            <?php endif; ?>
                                            
                                            <a href="?vl=<?= $systemCom->cursor('comment')['reply']['out'] ?>&com_id=<?= $comment->com_id ?>" >
                                                <span> <i class="fa fa-reply"> </i> Reply</span>  
                                            </a>

                                            <a href="?vl=<?= $systemCom->cursor('comment')['edit']['out'] ?>&com_id=<?= $comment->com_id ?>" >
                                                <span> <i class="fa fa-edit"> </i>  Edit </span>  
                                            </a>

                                            <?php if($comment->pending === '1'): ?>

                                                    <a href="?vl=<?= $systemCom->cursor('comment')['spam']['out'] ?>&com_id=<?= $comment->com_id ?>&spam=1" >
                                                        <span> <i class="red-text fa fa-bug"> </i>  Spam </span> 
                                                    </a>
                                                    <a href="?vl=<?= $systemCom->cursor('comment')['trash']['out'] ?>&com_id=<?= $comment->com_id ?>&move=1" >
                                                        <span> <i class="red-text fa fa-trash"> </i>  Trash </span>  
                                                    </a>

                                                <?php else:?>
                                                
                                                    <a href="?vl=<?= $systemCom->cursor('comment')['spam']['out'] ?>&com_id=<?= $comment->com_id ?>&spam=1&pst=<?= $comment->post_id ?>" >
                                                        <span> <i class="red-text fa fa-bug"> </i>  Spam </span> 
                                                    </a>
                                                    
                                                    <a href="?vl=<?= $systemCom->cursor('comment')['trash']['out'] ?>&com_id=<?= $comment->com_id ?>&move=1&pst=<?= $comment->post_id ?>" >
                                                        <span> <i class="red-text fa fa-trash"> </i>  Trash </span>  
                                                    </a>

                                             <?php endif; ?>

                                           

                                    <?php else:?>

                                            <?php if($com_status_filter === 'spam'):?>

                                                <?php if($comment->pending === '1'): ?>

                                                            <a href="?vl=<?= $systemCom->cursor('comment')['spam']['out'] ?>&com_id=<?= $comment->com_id ?>&notspam=0" >
                                                                <span> <i class="orange-text fa fa-bug"> </i>  Not spam </span> 
                                                            </a>

                                                        <?php else:?> 

                                                            <a href="?vl=<?= $systemCom->cursor('comment')['spam']['out'] ?>&com_id=<?= $comment->com_id ?>&notspam=0&pst=<?= $comment->post_id ?>" >
                                                               <span> <i class="orange-text fa fa-bug"> </i>  Not spam </span> 
                                                            </a>

                                                <?php endif; ?>    

                                                <a href="?vl=<?= $systemCom->cursor('comment')['spam']['out'] ?>&com_id=<?= $comment->com_id ?>&delete=1&pst=<?= $comment->post_id ?>" >
                                                    <span> <i class="red-text fa fa-trash"> </i>  Delete </span> 
                                                </a>

                                                <a href="?vl=<?= $systemCom->cursor('comment')['spam']['out'] ?>&com_id=<?= $comment->com_id ?>&keep=1&pst=<?= $comment->post_id ?>" >
                                                    <span> <i class="black-text fa fa-save"> </i>  Keep in trash </span> 
                                                </a>


                                                <a href="?vl=<?= $systemCom->cursor('comment')['spam']['out'] ?>&com_id=<?= $comment->com_id ?>&spam=1" >
                                                    <span> <i class="black-text fa fa-at"> </i> Mail the sender </span> 
                                                </a>

                                            <?php else:?> 
                                                
                                                <a href="?vl=<?= $systemCom->cursor('comment')['trash']['out'] ?>&com_id=<?= $comment->com_id ?>&spam=1&pst=<?= $comment->post_id ?>" >
                                                    <span> <i class="red-text fa fa-bug"> </i>   Spam </span> 
                                                </a>
                                                
                                                <?php if($comment->pending === '1'): ?>
                                                            <a href="?vl=<?= $systemCom->cursor('comment')['trash']['out'] ?>&com_id=<?= $comment->com_id ?>&restore=0" >
                                                                <span> <i class="black-text fa fa-share"> </i>  Restore </span> 
                                                            </a>
                                                        <?php else:?>
                                                            <a href="?vl=<?= $systemCom->cursor('comment')['trash']['out'] ?>&com_id=<?= $comment->com_id ?>&restore=0&pst=<?= $comment->post_id ?>" >
                                                                <span> <i class="black-text fa fa-share"> </i>  Restore </span> 
                                                            </a>
    	                                        <?php endif; ?>    


                                                <a href="?vl=<?= $systemCom->cursor('comment')['trash']['out'] ?>&com_id=<?= $comment->com_id ?>&delete=1&pst=<?= $comment->post_id ?>" >
                                                    <span> <i class="red-text fa fa-trash"> </i>  Delete </span> 
                                                </a>


                                                <a href="?vl=<?= $systemCom->cursor('comment')['trash']['out'] ?>&com_id=<?= $comment->com_id ?>&spam=1" >
                                                    <span> <i class="black-text fa fa-at"> </i> Mail the sender </span> 
                                                </a>

                                            <?php endif;?>

                                     <?php endif;?>
                                </div>


                            </td>
                            <td class='left-align'>   
                                 <!-- Article title reference :  -->
                                  <?= $comment->title ?>   <br/>
                                  <i class="fa fa-comment"></i> <?= $comment->comment_count ?>
                            </td>
     
                            
                         
                        </tr>
                    <?php endforeach; ?>

                        <?php else: ?>
                        <tr>
                                <td colspan='7' class='orange-text'>
                                    No Comments  Found !
                                </td>
                        </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
        </div>
</form>