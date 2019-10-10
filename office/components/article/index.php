<?php
    //int $var = 1;

    $systemListArt = System::getInstance();
    $article_table = $systemListArt->getTable('article');
    $menu_table = $systemListArt->getTable('menu');
    $menus = $menu_table->filterMenu();
    $active_menu_id = 1997;
    $self  = '?vl='.$systemListArt->cursor('article')['index']['out'] ?? '';
    
    if(isset($_GET['search']))
    {
        if ($_GET['search'] != '')
        {
            $posts = $article_table->all_cust_by_query(strtolower($systemListArt->formatInput($_GET['search'])));
        }else
        {
            $posts = $article_table->all_cust();
        }
    }else if (isset($_GET['filter']) )
    {
        if ($_GET['filter'] != '' && preg_match("/^[0-9]*$/",$_GET['filter']) )
        {
            $posts = $article_table->all_cust_by_filter_menu($_GET['filter']);
        }else
        {

            $posts = $article_table->all_cust();

        }
    }
    else
    {
        $posts = $article_table->all_cust();
    }
    $backofficeconfig_table = $systemListArt->getTable('backofficeconfig');
    $slider_view_config = $backofficeconfig_table->getListArticleTableViewConfig("listarticle");
    if ( $slider_view_config === false || $slider_view_config === [] ) 
    {    
        $backofficeconfig_table->create([
            'table_name' => 'listarticle',
        ]);
        $view_media_of_this = 'table';
    }else
    {
        $view_media_of_this = $slider_view_config->view;
    }
    if(isset($_POST['search']))
    {
        $query = isset($_POST['search_query']) ? $systemListArt->formatInput($_POST['search_query']) : '';
        $query != '' ?  $systemListArt->cos_redirect($self.'&search='.$query) : $flash->set('required');
        $systemListArt->cos_redirect($self);
    }

    if(isset($_POST['filter']))
    {    
        $query = isset($_POST['filter_menu']) ? $systemListArt->formatInput($_POST['filter_menu']) : '' ;   
        preg_match("/^[0-9]*$/",$query) ?  $systemListArt->cos_redirect($self.'&filter='.$query) : $flash->set('id_error');
        $systemListArt->cos_redirect($self);
    }

    if(isset($_POST['setview']))
    {   
        $view_media_of_this_catch = isset($_POST['view']) ? $systemListArt->formatInput($_POST['view']) : 'table';   
        if($view_media_of_this_catch === "table" || $view_media_of_this_catch === "card")
        {
            $kila_kitu_poa = $backofficeconfig_table->update("listarticle",['view' => $view_media_of_this_catch ]);
            $kila_kitu_poa === true ? '' : $flash->set('fatal_error');
        }else{
            $flash->set('unexcepted');
        }
        $systemListArt->cos_redirect($self);
    }
   if(isset($_POST['deleteArticle'])  AND !isset($_POST['setview']) ){
        isset($_POST['delart']) ? preg_match('/^[0-9]*$/',$_POST['delart']) ? $int_id = $_POST['delart'] : '' : '';
        if(isset($int_id))
        {
            $oky = $article_table->delete($int_id);     
            $oky === true ? $flash->set('success') : $flash->set('fatal_error');
            var_dump($oky,$int_id);
        }else
        {
            $flash->set('id_error');
        }
        
       # $systemListArt->cos_redirect($self);
   }
   if (isset($_POST['fire'])) {
        $excepted_actions = ['draft','undraft','delete'];

        isset($_POST['fireactions']) ? in_array($_POST['fireactions'], $excepted_actions) ?  $action = $_POST['fireactions'] : '' : '';
        isset($_POST['idPost']) ? is_array($_POST['idPost']) ? $ids = $_POST['idPost'] : '' : '';
        $status = false ;
      
        if(isset($action) && isset($ids)){
            
            foreach($ids as $id){
                if (preg_match('/^[0-9]*$/',$id)) {

                    switch ($action) {
                        case ($action == 'draft') :
                            $article_table->update($id,['switch' => 'off']);
                            break;

                        case ($action == 'undraft') :
                            $article_table->update($id,['switch' => 'on'  ]);
                            break;

                        case ($action == 'delete') :
                            $article_table->delete($id);
                        break;

                        default:
                            $flash->set('unexcepted', 'danger');
                        break;
                    }
                    $status = true ;
                }else{
                    $flash->set('id_error','danger');
                }
            }
            if ($status) {
                $flash->set('success','success');
            }
            
        }else{
            $flash->set('unexcepted', 'danger');
        }
        $systemListArt->cos_redirect($self);
   }
?>
<div class="row cust_menu">
    <div class="col s10 pinned cust_menu " style='z-index:99; border-bottom:10px solid #292934'>
        <!-- Left  -->
         <div class="col s12">
              <h5><i class="fa fa-list"></i> Articles </h5>
             
             <div class="col s8" style='padding:0px; margin-top:-10px;'>
                <a href="?vl=<?= $systemListArt->cursor('article')['new']['out'] ?>" style='font-size:18px;' class='orange-text'>
                        <i class="fa fa-edit"></i> New article 
                </a>
             </div>
             <div class="col s4 orange-text " style='margin-top:-26px; padding:0px; '> 
            
                <form action="#" method='post' class=''>
                    <p class='grey-text right-align' > View : 
                        <input class="with-gap" name="view" type="radio" id="table" value='table'  <?= $view_media_of_this === "table" ? 'checked' : '' ?>/>
                        <label for="table"> Table </label> 
                        <input class="with-gap" name="view" type="radio" id="card" value='card' <?= $view_media_of_this === "card" ? 'checked' : '' ?> />
                        <label for="card"> Card </label>
                        <button name='setview' type='submit' class='blue white-text' style=" margin-left:10px; ;border:none; border-radius:2px;"  >ok</button>
                    </p>
                </form>


            </div>

             <div class="nav-content" style=''>
                    <ul class="tabs_cust  ">  

                        <li class="tab_cust <?= !isset($_GET['filter']) ? 'active' : '' ?>"> 
                            <a  class='white-text' href="?vl=<?= $systemListArt->cursor('article')['index']['out'] ?>"> All </a>
                        </li>
                        <?php foreach ($menus as $menu) : ?>
                            <li class="tab_cust  <?= isset($_GET['filter']) ? $_GET['filter'] === $menu->id ?  'active' : '' : ''  ?>">
                                <a  class='white-text' href="?vl=<?= $systemListArt->cursor('article')['index']['out'].'&filter='.$menu->id ?>"> 
                                    <?= ucfirst($menu->menu) ?>
                                </a>
                            </li>
                        <?php endforeach;?>
                    </ul>
            </div>
           
         </div>
    


    </div>
</div> 
<br/><br/><br/><br/><br/>
 <!-- Right -->
 <form action="#!" method='post'>
    <div class="col s12 " style='padding:0px;'>
                <div class="col s8" >
                        
                        <select name="fireactions" id="" class='col s4'>
                            <option value="draft">Draft</option>
                            <option value="undraft">Undraft (Publish)</option>
                            <option value="delete">Delete</option>
                        </select>
                        <div class="col s4 left-align"> 
                                <button type='submit' name='fire' class="btn orange z-depth-0" style='margin-top:10px;'> Fire </button>
                        </div>
                        
                </div>

                
                <div class="col s4 right-align" style='margin-top:5px'>
                
                        <div class="col s7 ">
                            <input type="text" name='search_query' style='height:35px; ' 
                                value="<?= $_GET['search'] ??  '' ?>" 
                                placeholder=' Article id or title' >
                        </div>

                        <div class="col s5  "> 
                            <button type='submit' name='search' class="btn blue z-depth-0" style='margin-top:px;'> Search </button>
                    </div>
                
                </div>
            
            
    </div>


    <?php if($view_media_of_this === "table") :?>
            <div class="col s12 cust_menu">
            <div class="col s12">
            <table class="striped highlight  responsive-table">
                    <thead class='' style=''>
                    <tr >
                        <th  class="left-align">
                            <p class="burn_all">
                                <input type="checkbox"  class=''  id='burn_all' onclick="checkAll(this.form, 'idPost[]')"/>
                                <label for="burn_all"></label> 
                            </p>
                        </th>

                        <th  class="left-align">Id</th>
                        <th  class="left-align">Date</th>
                        <th  class="left-align" >Title</th>
                        <th  class="right-align">Menu</th>
                        <th  class="right-align">Category</th>
                        <th  class="right-align">Sub Category</th>
                        <th  class="right-align"> <i class="fa fa-comment"></i></th>
                    
                    </tr>
                    </thead>
            
                    <tbody>
                        <?php if($posts != []) : ?>
                        <?php foreach($posts as $post): ?>
                            <tr class='capture-hover' >
                                
                            <td> 
                                    <input type="checkbox" name="idPost[]" id="post<?= $post->id ?>"  value='<?= $post->id ?>' />
                                    <label for="post<?= $post->id ?>" class='burn_action'></label>                
                                </td>
                        
                                <td  class="orange-text">
                                    <?= $post->id ?>
                                </td>
                                <td  class="">
                                    <?= date("Y-m-d", strtotime($post->date)) ?>
                                </td>

                                <td  class=" capture-action " >
                                    <?= ucfirst( $post->title ) ?> <?= $post->switch === 'on' ? '' :  '<b class="orange-text">- Draft </b>' ?> <br/> <br/>

                                    <div class="actions-hover">
                                    
                                    <a href="?vl=<?= $systemListArt->cursor('article')['comment']['out'].'&post_id='.$post->id ?>" ><span> <i class="fa fa-comment"> </i> Comment </span>   </a>
                                    <a href="" ><span> <i class="fa fa-eye"> </i> View</span>   </a>


                                        <a href="?vl=<?= $systemListArt->cursor('article')['new']['out'] ?>&id=<?= $post->id ?>"  >
                                            <i class="fa fa-edit"></i> Edit
                                        </a>
                                    
                                       
                                        <a href="?vl=<?= $systemListArt->cursor('article')['delete']['out'] ?>&id=<?= $post->id ?>"  >
                                            <i class="fa fa-trash"></i> Delete
                                        </a>
                                      

                                    
                                    </div>

                                </td>
                                <td class='right-align'>   <?= ucfirst($post->menu_title) ?>    </td>
                                <td class='right-align'>   <?= $post->cat_title != null ? ucfirst($post->cat_title) : 'Uncategorized' ?>     </td>
                                <td class='right-align'>   <?= $post->subcat_title != null ? ucfirst( $post->subcat_title) : 'Unsubcategorized'  ?>  </td>
                                <td class='right-align'>   <?= $post->comment_count ?>  <i class="fa fa-comment"></i>  </td>
                        
                            </tr>
                        <?php endforeach; ?>

                            <?php else: ?>
                            <tr>
                                    <td colspan='7' class='orange-text'>
                                        Articles not Found !
                                    </td>
                            </tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
            </div>

    <?php endif;?>




    <?php if($view_media_of_this === "card") :?>
        <div class="col s12">
            <?php if($posts != []) : ?>
                <?php foreach($posts as $post): ?>
                    <div class="col s4 capture-card-hover" style='height:200px; margin-top:25px;' >

                    <div class="col s5 z-depth-1" style='padding:0px;height:100px; border-radius:2px 0px 0px 0px;'>
                        <?php if($post->media_file != ''): ?>
                                <div class="" style='height:100px; padding:0px; ' >
                                    <img src="<?= $post->media_url ?>" width="100%" height="100px"  class="materialboxed"   style="border-radius:2px 0px 0px 0px;" >
                                </div>
                                <?php else : ?>
                                <div class="center-align" style='height:100px; padding:0px;border-radius:2px 0px 0px 0px;'  >
                                <p> No image<br/>
                                    <i class="fa fa-image"></i>
                                    </p>
                                </div>
                            <?php endif; ?>      
                    </div>
                    <div class="col s7 white" style='height:100px; position:relative; color:black; border-bottom:1px solid grey; border-radius:0px 2px 0px 0px;'>
                        <span style='position:absolute;right:5px;top:0p; color:black;'>ID: <?= $post->id ?> </span>
                        <p>
                            <span class="blue-text"> Title: </span> <?= $systemListArt->sub_string($post->title,12) ?> <br/>
                            <span class="blue-text"> Date : </span> <?= date('Y-m-d', strtotime($post->date)) ?> <br/>
                            <span class="blue-text"> Status: </span> <?= $post->switch === 'on' ? '<b class="orange-text"> Published </b>' :  '<b class="orange-text"> Draft </b>' ?>
                        </p>
                    </div>                   
                        <div class="col s12 white black-text card-action" style='height:100px; border-radius:0px 0px 2px 2px; position:relative;' > 
                            <p>
                            <span class="blue-text"> Menu : </span> <?= ucfirst($post->menu_title) ?>  <br/>
                            <span class="blue-text"> Category : </span> <?= $post->cat_title != null ? ucfirst($post->cat_title) : 'Uncategorized' ?> <br/>
                            <span class="blue-text"> Sub Category : </span> <?= $post->subcat_title != null ? ucfirst( $post->subcat_title) : 'Unsubcategorized'  ?> <br/>
                            </p>
                            <div class="actions-hover">
                                
                                    <a  style="background-color:transparent; position:absolute;bootm:0px;top:-3px; right:4px; font-size:20px;" 
                                        href="?vl=<?= $systemListArt->cursor('article.comment') ?>&post_id=<?= $post->id ?>">
                                        <i class="black-text fa fa-comment"></i>
                                    </a>
                                    
                                    <a  style="background-color:transparent; position:absolute;bootm:0px;top:20px; right:4px; font-size:20px;" 
                                        href="?vl=<?= $systemListArt->cursor('article.new') ?>&id=<?= $post->id ?>">
                                        <i class="black-text fa fa-eye"></i>
                                    </a>
            
                                
                                    <a  style="background-color:transparent; position:absolute;bootm:0px;top:45px; right:4px; font-size:20px;" 
                                        href="?vl=<?= $systemListArt->cursor('article.new') ?>&id=<?= $post->id ?>">
                                        <i class="black-text fa fa-edit"></i>
                                    </a>
            
                                    <form action="?vl=<?= $systemListArt->cursor('article.delete') ?>" method="post" style="position:absolute;bottom:0; right:0px; font-size:20px;">
                                            <input type="hidden" name="id" value="<?=  $post->id ?>" />
                                            <button class="z-depth-0"   style="background-color:transparent; border:none;" type="submit"> <i class="red-text fa fa-trash"></i></button>
                                            
                                    </form>
                            </div>
                        </div>

                        
                    </div>

                <?php endforeach;?>
            <?php endif; ?>
        </div>

    <?php endif; ?>

</form>