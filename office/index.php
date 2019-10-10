<?php
    $systemDashboard = System::getInstance();
    $article_table      = $systemDashboard->getTable('article');
    $comment_table   = $systemDashboard->getTable('comment');
    $menu_table     = $systemDashboard->getTable('menu');

    $article_online_count     = $article_table->count_all_online();
    $comments_online_count    = $comment_table->count_all_online();
    $menu_online_count       = $menu_table->count_all_online();

    $last_published_articles  = $article_table->get_published_article();
    $recent_comments          = $comment_table->get_recent_comments();

    // $flash->set('Test : Flash enabled ','green');
    // $flash->set('Test : Url rewriting enabled ','red');
    // $flash->set('Test : Php script error not found ','black');
    // $flash->set('Test : Safe mode running','green');

    // $flashes = $flash->get();

    // foreach($flashes as $flash){
    //     echo  $flash['message'].'<br/>';
    // }



?>


<div class="row cust_menu">
    <div class="col s10 pinned cust_menu " style='z-index:99; border-bottom:10px solid #292934'>
        <!-- Left  -->
         <div class="col s12 ">
           
            <h5><i class="fa fa-desktop"></i> Cosdesk </h5>
           
         </div>
        
            <div class="nav-content" style=''>
                <ul class="tabs_cust  ">
                    <li class="tab_cust">

                        <a  class='white-text' href=""> 
                            Support forum
                        </a>

                    </li>
                    <li class="tab_cust ">
                        <a  class="" href=""> 
                           Event at Cos
                        </a>
                    </li>
                    <li class="tab_cust">
                        <a  class='green-text' href="">
                            System Update
                        </a>
                    </li>
                    <li class="tab_cust ">
                        <a  class='' href="">
                           System log errors
                         </a>
                    </li>
                    <li class="tab_cust">
                        <a  class='' href=""> 
                           Site  Maintenance
                        </a>
                    </li>
                </ul>
            </div>
    </div>
</div> 
<br/><br/><br/><br/>

<div class="col s12">
    <ul class="collapsible  "  style='border:none;'   data-collapsible="accordion">
        <li class=''>

            <div class="collapsible-header active cust_menu"> <i class="fa fa-reply"> </i> Shortcuts </div>
            
            <div class="collapsible-body white-text " style='padding:20px;'> 
            
                    <div class="row">
                            <div class="col s4">
                                <h4><?= date('H:m:s A')?> </h4>
                                Time to look on your design <br/><br/>
                                <button class="btn"> <i class='fa fa-paint-brush '></i> Paint your site</button> 
                                <button class="btn"> <i class='fa fa-expand '>  </i> Rulers </button> 
                            </div>
                            <div class="col s3">
                                <h4> <i class="fa fa-flash"></i> Quick  </h4>
                                <br/>
                                    <a href="" class=' white-text'> <i class="fa fa-edit"></i> Write an article </a> <br/>
                                    <a href="" class=' white-text'>  <i class="fa fa-plus"></i>  Add About page </a> <br/>
                                    <a href="" class=' white-text'> <i class="fa fa-at">  </i> Add Contact page </a> <br/>
                                    <a href="" class=' white-text'> <i class="fa fa-search">  </i> Set up a blog  </a> <br/>
                                    
                            </div>
                            <div class="col s3">
                                <h4> Dynamic  </h4>
                                <br/>
                                <a href="" class=' white-text'> <i class="fa fa-list"></i> Navigation bar </a> <br/>
                                <a href="" class=' white-text'> <i class="fa fa-flag"></i>  Footer bar </a> <br/>
                                <a href="" class=' white-text'> <i class="fa fa-list"> </i>  create menu </a> <br/>
                            </div>

                            <div class="col s2">
                                <h4> More...  </h4>
                                 <br/>
                                <a href="" class=' white-text'> <i class="fa fa-comment"></i>  Manage comments </a> <br/>
                                <a href="" class=' white-text'> <i class="fa fa-cog"> </i>  Discussion  setttings </a> <br/>
                            </div>
                    </div>

            </div>
        </li>
    </ul>
</div>

<div class="col s6"  style='padding:0px;'>

    <div class="col s12"> 
            <ul class="collapsible "  style='border:none;'  data-collapsible="accordion">
                <li class=''>
                    <div class="collapsible-header active cust_menu"><i class="fa fa-reply"></i> Recents </div>
                    
                    <div class="collapsible-body white-text " style='padding:20px;'> <br/>
                        <i class="fa fa-feed"></i> Last Published  <br/>
                        <table class='highlight  responsive-table'>
                            <thead>
                            </thead>
                            <tbody>
                               <?php if($last_published_articles != []): ?> 
                                    <?php foreach($last_published_articles as $post): ?>
                                        <tr>
                                            <td  style='padding:5px;' > <?= date('Y-m-d',strtotime($post->date)) ?></td>
                                            <td  style='padding:5px;' > <?=  $post->title ?></td>
                                            <td class='right-align' style='padding:5px;' ><i class="fa fa-comment"></i> <?= $post->comment_count?> </td>
                                        </tr>
                                    <?php endforeach; ?>
                               <?php else: ?>
                                    <tr>
                                        <td colspan='3' style='padding:5px;'  > Notthing to show </td>
                                    </tr>
                                 <?php endif;?> 
                            </tbody>
                        </table>
                        
                        <br/> <i class="fa fa-comment"></i> Recent Comments  <br/><br/>

                        <table class='highlight responsive-table striped'>
                            <tbody>
                               <?php if($recent_comments != []): ?> 
                                        <?php foreach($recent_comments as $comment): ?>
                                            <tr class='capture-hover  <?=  $comment->pending === '1' ?'unapproved-comment' : ''?>'>  
                                                <td  style='padding:5px;' > <?=  $comment->full_name ?></td>  
                                                
                                                <td  style='padding:5px;' class='capture-action' >
                                                    <?php if($comment->parent_id != null && $comment->parent_id != null ): ?>
                                                    
                                                    <?php 
                                                        $send_request = $comment_table->replied_com($comment->parent_id);
                                                        ?>
                                                        <?php  if( $send_request != [] AND $send_request != false ): ?>
                                                            
                                                            <i class="fa fa-reply orange-text"></i> In Reply to
                                                            <a  style='text-decoration:underline;'
                                                                href="?vl=<?= 'comment.reply' ?>&com_id=<?= $send_request->id ?>">
                                                                <?= $send_request->full_name ?>'comment </a> : <br/> <br/>
                                                            
                                                        <?php endif; ?>

                                                    <?php endif; ?>
                                                    <?=  $systemDashboard->sub_string($comment->comment,100 ) ?>
                                                    <div class="actions-hover">
                                                        <a href="?vl=<?= 'comment.reply' ?>&com_id=<?= $comment->id ?>" >
                                                            <span> <i class="fa fa-reply"> </i> Reply</span>  
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan='2' style='padding:5px;' > Notthing to show </td>
                                            </tr>
                                 <?php endif;?>
                             </tbody>
                        </table>
                        <br/>
                    </div>

                </li>
                
            </ul>
    </div>

    


</div>


<div class="col s6"  style='padding:0px;'>

     <div class="col s12"> 
        <ul class="collapsible " style='border:none;' data-collapsible="accordion">
            <li class=''>
                <div class="collapsible-header active cust_menu"><i class="orange-text fa fa-flag"></i> Stats </div>
                
                <div class="collapsible-body white-text" style='padding:20px;'> <br/>

                    <div class="col s6"  style='padding:10px; '>
                          <i class="fa fa-flag orange-text">  </i>
                        <?= $article_online_count  ?>  
                        <?= $article_online_count > 1 ? 'Posts' : 'Post'  ?> Online  
                    </div>

                    <div class="col s6"  style='padding:10px; '>
                        <i class="fa fa-list orange-text">  </i>
                        <?= $menu_online_count  ?>  Menu active <br/>
                    </div>
                    
                   <p style='padding:10px; '>
                    <i class="fa fa-comment orange-text">  </i>
                        <?= $comments_online_count  ?>  
                        <?= $comments_online_count > 1 ? 'Comments' : 'Comment'  ?> Online  
                   </p>
                    <br/>
                   

                </div>
            </li>
            
        </ul>
    </div>

    <div class="col s12"> 
        <ul class="collapsible " style='border:none;' data-collapsible="accordion">
            <li class=''>
                <div class="collapsible-header active cust_menu"><i class="blue-text fa fa-flag"></i> Site Web & User Monitor</div>
                <div class="collapsible-body white-text" style='padding:20px;'> <br/>
                    <i class="blue-text fa fa-flag"></i> Site Adress :  <?= $_SERVER['HTTP_HOST'] ?> <br/>
                    <i class="blue-text fa fa-cog"></i> Cos version : Beta 0.001 <br/>
                    <i class="blue-text fa fa-user"></i> User Agent :  <?= $_SERVER['HTTP_USER_AGENT'] ?>     
                    <blockquote style='border-left-color:#2196f3;'>
                        User Ip Adress :  <?= $_SERVER['REMOTE_ADDR'] ?><br/>
                        User runing On Port :  <?= $_SERVER['REMOTE_PORT'] ?>   <br/>                          
                        Connected user : Demonstrate     <br/>                      
                        SSL certificate not installed       
                    </blockquote>
                </div>
            </li>
            
        </ul>
    </div>

    <div class="col s12"> 
        <ul class="collapsible "  style='border:none;'  data-collapsible="accordion">
            <li class=''>
                <div class="collapsible-header active cust_menu"><i class="green-text fa fa-server"></i> Server Monitor</div>
                
                <div class="collapsible-body white-text" style='padding:20px;'> <br/>
                
                    <i class="green-text fa fa-tv"></i> Os <?= $systemDashboard->sub_string(php_uname(), 10); ?><br/>
                    <i class="green-text fa fa-user"></i> Server Running on Computer user : <?= get_current_user(); ?><br/>
                    <i class="green-text fa fa-cog"></i> Php version :  <?= phpversion() ?><br/>
                    <i class="green-text fa fa-server"></i> Server Software infos :
                        <?= isset($_SERVER['SERVER_SOFTWARE']) ? $_SERVER['SERVER_SOFTWARE'] : getenv('SERVER_SOFTWARE') ?>
        
                        <blockquote style='border-left-color:#4caf50;'>
                            Server Name :  <?= $_SERVER['SERVER_NAME'] ?><br/>
                            Server Ip Adress :  <?= $_SERVER['SERVER_ADDR'] ?><br/>
                            Server Runing On Port :  <?= $_SERVER['SERVER_PORT'] ?><br/>
                            Server Protocol :  <?= $_SERVER['SERVER_PROTOCOL'] ?>
                        </blockquote>    
                  
                </div>

            </li>
            
        </ul>
    </div>


</div>
