<?php
    $systemFolderslides = System::getInstance();
    $menu_table   = $systemFolderslides->getTable('menu');
    $slides_table = $systemFolderslides->getTable('slider');
    $backofficeconfig_table = $systemFolderslides->getTable('backofficeconfig');
    $back = '?vl='.$systemFolderslides->cursor('media')['index']['out'];
    $slider_view_config = $backofficeconfig_table->getSliderTableViewConfig("slider");

   

    if ( $slider_view_config === false || $slider_view_config === [] ) {
        
        $backofficeconfig_table->create([
            'table_name' => 'slider',
        ]);

        $view_media_of_this = 'table';

    }else{
        $view_media_of_this = $slider_view_config->view;
    }



    if (isset($_GET['filter']) ) {

        if ($_GET['filter'] != '' && preg_match("/^[0-9]*$/",$_GET['filter']) ) {

            $images = $slides_table->sliders_filter_by_menu_id($_GET['filter']);

        }else{

            $images = $slides_table->sliders();
        }

    }else{
        $images = $slides_table->sliders();
    }
   
?>

<?php

     $root_size_count_items = explode(',',$systemFolderslides->folderSize('../datas/slides/'));
     $used_size = $systemFolderslides->formatSize($root_size_count_items[0]);
    
?>

<?php
     $menus = $menu_table->menuBuilder();
     $index = 1;
?>
<?php

     if(isset($_POST['filter'])){
        
        $query = isset($_POST['filter_menu']) ? $systemFolderslides->formatInput($_POST['filter_menu']) : '' ;
        
        if (preg_match("/^[0-9]*$/",$query)) {
            $systemFolder->cos_redirect('?vl='.$systemFolderslides->cursor('media')['slide']['out'].'&filter='.$query);
        }else{
            $systemFolder->cos_redirect('?vl='.$systemFolderslides->cursor('media')['slide']['out']);
        }


    }


?>

<?php
    if(isset($_POST['setview'])){
       
        $view_media_of_this_catch = isset($_POST['view']) ? $systemFolderslides->formatInput($_POST['view']) : 'table';
        
        if($view_media_of_this_catch === "table" || $view_media_of_this_catch === "card") {
            $kila_kitu_poa = $backofficeconfig_table->update("slider",[
                'view' => $view_media_of_this_catch
            ]);

            if (!$kila_kitu_poa){
              $flash->set('not','warning');
            }
            $systemFolderslides->cos_redirect("?vl=".$systemFolderslides->cursor("media")['slide']['out']);

        }
    }

?>

<div class="row cust_menu">
    <div class="col s10 pinned cust_menu " style='z-index:99; border-bottom:2px solid #292934;'>
           
           <div class="col s8">

                 <h5><i class="fa fa-folder-open"></i> Slides <span style='font-size:14px;;'> - Global to all menu</span>   </h5>
                
                 <i class="fa fa-server"></i> Real Path : <a href="<?= $back ?>">datas</a> / slides /

                <div>

                    <a href="#!" class='orange-text'> Folder size : <?= $used_size ?> </a>  
                    <a href="#!" class='orange-text' style='margin-left:15px;'>  Contains : 
                        <?= $root_size_count_items[1] > 1 ? $root_size_count_items[1]." images" : $root_size_count_items[1]." image"; ?> 
                    </a>  
                    
                </div>

           </div>

           <div class="col s4 right-align orange-text" style='margin-top:10px;'> 
                Location : Root / slides  /


                <form action="#" method='post' style='position:absolute;bottom:2px; right:15px'>
                    <p class='grey-text'> View : 
                        <input class="with-gap" name="view" type="radio" id="table" value='table'  <?= $view_media_of_this === "table" ? 'checked' : '' ?>/>
                        <label for="table"> Table </label> 
                        <input class="with-gap" name="view" type="radio" id="card" value='card' <?= $view_media_of_this === "card" ? 'checked' : '' ?> />
                        <label for="card"> Card </label>
                        <button name='setview' type='submit' class='blue white-text' style=" margin-left:10px; ;border:none; border-radius:2px;"  >ok</button>
                    </p>
                </form>

           </div>


    </div>
</div>

<br/>
<br/>
<br/>
<br/>

 <!-- Right -->
 <div class="col s12 " style='padding:0px;'>
           

            
            <div class="col s7 " style='margin-top:5px; color:;'>
                <div class="col s12">
                <h5> <i class="fa fa-image"></i> Images </h5>
                </div>
            </div>


            <div class="col s5 right-align " >
                <form action="#!" method='post'>
                            <select name="filter_menu" id="" class='col s8 right-align'>
                                <option value="none"> All menu </option>
                                <?php if ($menus != []) : ?>  
                                    <?php foreach($menus as $menu): ?>
                                        <option value="<?= $menu->id ?>" 
                                                <?php 
                                                  if(isset($_GET['filter'])){
                                                     if (  $_GET['filter'] === $menu->id ) {
                                                         echo 'selected';
                                                     }
                                                  }
                                                
                                                ?> > <?= ucfirst($menu->menu) ?> </option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                            <div class="col s4 right-align"> 
                                    <button type='submit' name='filter' class="btn blue z-depth-0" style='margin-top:10px;'> Filter </button>
                            </div>
                    </form>
            </div>
           
</div>




<?php if($view_media_of_this === 'table'): ?>

        <div class="col s12 cust_menu">
            <div class="col s12">
                <table class="striped highlight  responsive-table">
                    <thead class='' style=''>
                        <tr >
                            <th  class="left-align"> Index </th>
                            <th  class="left-align"> Image </th>
                            <th  class="left-align">File name</th>
                            <th  class="left-align orange-text">Ref Caption Title</th>
                            <th  class="left-align orange-text">Ref. Menu</th>
                            <th  class="right-align">Size</th>
                            <th  class="right-align">Dimensions</th>
                        
                            <th  class="right-align">Ext</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if($images != []) : ?>
                            <?php foreach($images as $image): ?>
                            <?php if($image->scaption_attach != null) : ?>
                                    <tr>
                                        <td  class="left-align"> <?= $index++ ?> </td>
                                        <td>    
                                            <div>
                                                <img src="<?= $image->media_url ?>" width="40" height="25"  class="materialboxed" />
                                            </div>
                                        </td>
                                        <td  class="left-align">
                                            <?= str_replace('/','',$image->scaption_attach )?>
                                        </td>  

                                        <td>
                                            <?= ucfirst( $image->title) ?>
                                        </td>

                                        <td  class="left-align orange-text">
                                        <a href="?vl=<?= $systemFolderslides->cursor('article')['index']['out'].'&search='.$image->menu_id ?>" 
                                            style='text-decoration:underline;' > 
                                                <?php if($menus != []): ?>
                                                    <?php foreach ($menus as $menu): ?>
                                                        <?php if ($menu->id === $image->menu_id):?>
                                                            <?= ucfirst($menu->menu) ?>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?> 
                                                    <?php else: ?>
                                                        <?= "Menu not found " ?>
                                                <?php endif; ?>
                                            </a>
                                        </td>  

                                    
                                    
                                    <td class='right-align'> 
                                            <?php
                                                $size_and_dimensions = $systemFolderslides->fileSize($image->media_url,true);
                                            
                                                if($size_and_dimensions !== false){
                                                    
                                                    $size_width_height = explode(',', $size_and_dimensions);
                                                    $size = (int)$size_width_height[0];
        
                                                    echo  $systemFolderslides->formatSize($size);
                                                }else{
                                                    echo '0B';
                                                }
                                                
                                            ?>
                                    </td>
                                    
                                
                                    <td class='right-align'> 
                                        <?php
                                        
                                            if( $size_and_dimensions != false ){
                                            
                                                $width = $size_width_height[1];
                                                $heigh = $size_width_height[2];

                                                echo $width.' x '.$heigh;  

                                            }else{
                                                echo "0x0";
                                            }
                                    
                                        ?>  
                                    </td>
                                    
                                    <td  class="right-align">
                                        <?= strrchr($image->scaption_attach,'.') ?>
                                    </td>                 
                                    </tr>
                                <?php endif; ?>
                            <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan='7' class='orange-text'>
                                        Empty ...!
                                    </td>
                                </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
<?php endif; ?>

<?php if($view_media_of_this === 'card'): ?>

    <div class="col s12 ">  
        <div class="col s12"style="padding:0px">
        <br/>
            <?php if($images != []) : ?>
                    <?php foreach($images as $image): ?>
                            <?php if($image->scaption_attach != null) : ?>
                            
                                <div class="col s4 " style=' margin-top:20px;' >  
                                    <div class="col s6 white" style='padding-left:0px; border-radius:2px 0px 0px 2px;'>
                                            <img src="<?= $image->media_url ?>" 
                                                width="100%" 
                                                height="129;"  
                                                class="materialboxed"  
                                                style='border-radius: 2px 0px 0px 2px;'/>
                                    </div>
                                    <div  class="col s6 white black-text" 
                                            style="padding:0px; padding-right:2px; height:129px; border-radius:0px 2px 2px 0px; font-size:14px;">

                                            <p>
                                            <i class="fa fa-image blue-text"></i> <?= str_replace('/','',$image->scaption_attach )?>
                                                <br/>                                  
                                         <i class="fa fa-bitbucket blue-text"></i> <?php
                                                    $size_and_dimensions = $systemFolderslides->fileSize($image->media_url,true);
                                                
                                                    if($size_and_dimensions !== false){
                                                        
                                                        $size_width_height = explode(',', $size_and_dimensions);
                                                        $size = (int)$size_width_height[0];
            
                                                        echo  $systemFolderslides->formatSize($size);
                                                    }else{
                                                        echo '0B';
                                                    }
                                                    
                                                ?>
                                            <br/>
                                            <i class="fa fa-expand blue-text"></i> <?php
                                                
                                                    if( $size_and_dimensions !== false ){
                                                    
                                                        $width = $size_width_height[1];
                                                        $heigh = $size_width_height[2];

                                                        echo $width.' x '.$heigh;  

                                                    }else{
                                                        echo "0x0";
                                                    }
                                            
                                                ?>  
                                                <br/>

                                                <i class="fa fa-at orange-text"></i>
                                               <a href="?vl=<?= $systemFolderslides->cursor('article')['index']['out'].'&search='.$image->menu_id ?>" 
                                                     style='text-decoration:underline;' > 
                                                    <?php if($menus != []): ?>
                                                        <?php foreach ($menus as $menu): ?>
                                                            <?php if ($menu->id === $image->menu_id):?>
                                                                <?= ucfirst($menu->menu) ?>
                                                            <?php endif; ?>
                                                        <?php endforeach; ?> 
                                                        <?php else: ?>
                                                            <?= "Menu not found " ?>
                                                    <?php endif; ?>
                                                </a>

                                            </p>

                                    </div> 
                                </div> 
                            <?php endif; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
        </div>
    </div>
<?php endif ?>






































<?php
    $path_folder = "../datas/slides/";
    $gotten_files = $systemFolderslides->getFiles($path_folder);
    $index_lost= $index;
    $newImg = [];
    $unused_image_were_found = false;

    
    if (isset($_GET['filter']) ) {
        if ($_GET['filter'] != '' && preg_match("/^[0-9]*$/",$_GET['filter']) ) {
            $images = $slides_table->sliders();
        }
    }
    
    foreach($images as $img){
        $newImg[] = $img->scaption_attach;
    }

 
?>
<?php
    if(isset($_POST['unlike'])){
       $unlike_this_file = isset($_POST['file']) ? $systemFolderslides->formatInput($_POST['file']) : '';
      
       if( $unlike_this_file != ''){

            $allowed_extensions = ['.png','.jpg','.jpeg','.jfif'];
            $file_extension = strrchr($unlike_this_file,'.');
    
            if(in_array(strtolower($file_extension),$allowed_extensions)){
                
                $is_deleted = $systemFolderslides->unlikeFile($path_folder.$unlike_this_file);
                
                if($is_deleted != false) {
                    $flash->set('success','success');
                }else{
                    $flash->set('not','warning');
                }

            }else{
                $flash->set('not','warning');
            }

       }else{
             $flash->set('required','warning');
       }
       $systemFolderslides->cos_redirect('?vl='.$systemFolderslides->cursor('media')['slide']['out']);
    }
?>



<div class="col s12 cust_menu" style='margin-top:20px;'>
    <div class="col s12"> <br/>
        <h5> <i class="fa fa-fire"></i> Broken references or Unused </h5> <br/>
    </div>

</div>




<?php if($view_media_of_this === 'table'): ?>

        <div class="col s12">
            <div class="col s12">
            <br/>
            <table class="striped highlight  responsive-table">
                    <thead class='' style=''>
                        <tr >
                            <th  class="left-align"> Index </th>
                            <th  class="left-align"> Image </th>
                            <th  class="left-align">File name</th>
                        
                            <th  class="right-align">Size</th>
                
                            <th  class="right-align">Dimensions</th>
                            <th  class="right-align">Ext</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if($gotten_files > 0  || $gotten_files != [] ) : ?>
                        <?php foreach($gotten_files as $file): ?>
                                <?php if( !in_array($file, $newImg) ): ?>
                                
                                <?php $unused_image_were_found = true; ?>
                                <tr class='capture-hover'>
                                    <td class='left-align'><?= $index_lost++ ?></td>

                                    <td>                                         
                                        <div>
                                            <img src="<?= $path_folder.$file ?>" width="40" height="25"  class="materialboxed" />
                                        </div>
                                    </td>
                                    <td class='left-align capture-action'> 
                                       <?= $file ?>  <br/> <br/>
                                       <div class="actions-hover ">
                                            <form action="#!" method="post" style="display:inline;">
                                                <input type="hidden" name="file" value="<?= $file ?>" />
                                                <button class=" "  
                                                        name='unlike' 
                                                        style="background-color:transparent; border:none" type="submit"> 
                                                     <i class="red-text fa fa-trash">  </i> Delete
                                                </button>
                                           </form>
                                        </div>
                                     </td>                        
                                    <td class='right-align'> 
                                            <?php
                                                $size_and_dimensions = $systemFolderslides->fileSize($path_folder.$file,true);
                                            
                                                if($size_and_dimensions !== false){
                                                    
                                                    $size_width_height = explode(',', $size_and_dimensions);
                                                    $size = (int)$size_width_height[0];
        
                                                    echo  $systemFolderslides->formatSize($size);
                                                }else{
                                                    echo '0B';
                                                }
                                                
                                            ?>
                                    </td>
                                    
                                
                                    <td class='right-align'> 
                                        <?php
                                        
                                            if( $size_and_dimensions != false ){
                                            
                                                $width = $size_width_height[1];
                                                $heigh = $size_width_height[2];

                                                echo $width.' x '.$heigh;  

                                            }else{
                                                echo "0x0";
                                            }
                                    
                                        ?>  
                                    </td>

                                    <td class='right-align'>  <?= strrchr($file, '.') ?>  </td>

                                    </tr>             
                                <?php endif; ?>
                        <?php endforeach; ?>

                        <?php  if ($unused_image_were_found === false): ?>
                                <tr>
                                    <td colspan='7' class='orange-text'>
                                        Lost images not found or Unlink image were not found ! Folder Clear !
                                    </td>
                                </tr>
                        <?php endif; ?>

                        <?php else: ?>
                                <tr>
                                    <td colspan='7' class='orange-text'>
                                        Folder is Empty
                                    </td>
                                </tr>
                        <?php endif; ?>
                    </tbody>
                </table>

            </div>
     </div>

<?php endif; ?>




<?php if($view_media_of_this === 'card'): ?>

    <div class="col s12 ">  
                <div class="col s12"style="padding:0px">
                <br/>
                    <?php if($gotten_files > 0  || $gotten_files != [] ) : ?>
                        <?php foreach($gotten_files as $file): ?>
                                <?php if( !in_array($file, $newImg) ): ?>
                                
                                    <?php $unused_image_were_found = true; ?>
                                    
                                        <div class="col s4 " style=' margin-top:20px;' >  
                                            <div class="col s6 white" style='padding-left:0px; border-radius:2px 0px 0px 2px;'>
                                                    <img src="<?= $path_folder.$file ?>" 
                                                        width="100%" 
                                                        height="129;"  
                                                        class="materialboxed"  
                                                        style='border-radius: 2px 0px 0px 2px;'/>
                                            </div>
                                            <div  class="col s6 white black-text" 
                                                    style="padding:0px; padding-right:2px; height:129px; border-radius:0px 2px 2px 0px; font-size:14px;">

                                                    <p>
                                                    <i class="fa fa-image blue-text"></i> <?= $file ?>
                                                        <br/>                                  
                                                     <i class="fa fa-bitbucket blue-text"></i> <?php
                                                            $size_and_dimensions = $systemFolderslides->fileSize($path_folder.$file,true);
                                                        
                                                            if($size_and_dimensions !== false){
                                                                
                                                                $size_width_height = explode(',', $size_and_dimensions);
                                                                $size = (int)$size_width_height[0];
                    
                                                                echo  $systemFolderslides->formatSize($size);
                                                            }else{
                                                                echo '0B';
                                                            }
                                                            
                                                        ?>
                                                    <br/>
                                                    <i class="fa fa-expand blue-text"></i> <?php
                                                        
                                                            if( $size_and_dimensions !== false ){
                                                            
                                                                $width = $size_width_height[1];
                                                                $heigh = $size_width_height[2];

                                                                echo $width.' x '.$heigh;  

                                                            }else{
                                                                echo "0x0";
                                                            }
                                                    
                                                        ?>  
                                                        <br/>
                                                    
                                                       <form action="#!" method="post" class="right-align" style='margin-top:30px'>
                                                           <input type="hidden" name="file" value="<?= $file ?>" />
                                                            <button class="z-depth-0"  name='unlike' style="background-color:transparent; border:none;" type="submit"> <i class="red-text fa fa-trash"></i></button>
                                                        </form>
                                                    
                                                    </p>

                                            </div> 
                                        </div> 
                                    <?php endif; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                </div>
            </div>

<?php endif; ?>