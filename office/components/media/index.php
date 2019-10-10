
<?php
    $systemMedia = System::getInstance();
    $menu_table = $systemMedia->getTable('menu');
    $backofficeconfig;
    $root_path = '../datas/';

    //var_dump(scandir($root_path));
?>

<?php
    $menus = $menu_table->menuBuilder();
    /**
     * Postion  0 : its the size
     * Position 1 : Count 
     * 
     * $root_size_count_items $root_size_count_items[0] and $root_size_count_items[1]
     */
    $root_size_count_items = $systemMedia->getTotalSize($root_path);

    $used_size = $systemMedia->formatSize($root_size_count_items);

      /**
     * Postion  0 : file count
     * Position 1 : folder count 
     * 
     *  $contains[0] and  $contains[1]
     */
    $contains = explode(',',$systemMedia->countFile($root_path) );
  
   
?>

<div class="row cust_menu">
    <div class="col s10 pinned cust_menu " style='z-index:99; border-bottom:2px solid #292934;'>
           
           <div class="col s8">

                 <h5><i class="fa fa-folder"></i> Cosexp </h5>
                
                 <i class="fa fa-server"></i> Real Path : datas /

                <div>

                    <a href="#!"> Space used : <?= $used_size ?> </a>  
                    <a href="#!" style='margin-left:15px;'>  Contains : 
                        <?= $contains[0] > 1 ? $contains[0]." images" : $contains[0]." image"; ?>  and 
                        <?= $contains[1] > 1 ? $contains[1]." folders" : $contains[0]." folder"; ?> 
                    </a>  
                    
                </div>

           </div>

           <div class="col s4 right-align orange-text" style='margin-top:10px;'> 
                Location : Root /
           </div>


    </div>
</div>

<br/>
<br/>
<br/>
<br/>

<div class="col s12">
    <div class="col s12">
        <h1><i class="fa fa-folder-open"></i></h1>
    </div>
</div>

<div class="row">
    <div class="col s12">
        <?php if($menus != []): ?>
            <?php foreach($menus as $menu): ?>

               <?php
                    $folder_size_count_items = explode(',',$systemMedia->folderSize($root_path.trim($menu->menu_dir).'/'));
                    $used_size_of_this_folder = $systemMedia->formatSize($folder_size_count_items[0]);

                ?>
                <div class="col m4  " >
                    <a href="?vl=<?= $systemMedia->cursor('media')['folder']['out'] ?>&folder=<?= $menu->id ?>" class='black-text'>
                    <div class="card">
                            <div class=" col s5   center-align z-depth-0" style='padding:0px; ' >
                                    <h1 style='' > <i class="blue-text fa fa-folder">  </i>  </h1>
                                
                                </div>
                                <div class=" col s7   left-align z-depth-0" style='padding:0px; ' >
                                    <h5 syle='margin-top:70px;' class='blue-text '> <?= ucfirst($menu->menu) ?> </h5>
                                    <p><i class="fa fa-bitbucket blue-text"></i>  <?=  $used_size_of_this_folder ?></p>
                                    <p><i class="fa fa-image blue-text"></i>  <?= $folder_size_count_items[1] > 1 ? $folder_size_count_items[1]." images" : $folder_size_count_items[1]." image"; ?> </p>
                                </div>

                    </div>
                    </a>
                </div>
            <?php endforeach; ?>
                <?php
                    $folder_size_count_items = explode(',',$systemMedia->folderSize($root_path.'slides/'));
                    $used_size_of_this_folder = $systemMedia->formatSize($folder_size_count_items[0]);

                ?>

                <div class="col m4 " >
                    <a href="?vl=<?= $systemMedia->cursor('media')['slide']['out'] ?? '' ?>" class='black-text'>
                        <div class="card" >
                                <div class="col  s5 center-align z-depth-0" style='' >
                                        <h1 style='' > <i class="blue-text fa fa-folder">  </i>  </h1>
                                        <span class='blue-text' style='position:absolute;top:27px;'> <b>Global</b> </span>
                                 </div>
                                <div class=" col s7 ;  left-align z-depth-0" style=' ' >
                                        <h5 syle='margin-top:70px;' class='blue-text'> Slides </h5>
                                        <p><i class="fa fa-bitbucket blue-text"></i>  <?=  $used_size_of_this_folder ?></p>
                                        <p><i class="fa fa-image blue-text"></i>  <?= $folder_size_count_items[1] > 1 ? $folder_size_count_items[1]." images" : $folder_size_count_items[1]." image"; ?> </p>
                                </div>

                        </div>
                    </a>
                </div>

         <?php endif; ?>
    </div>
</div>


<?php  
    $files = $systemMedia->getFiles($root_path);
?>
<?php
    if(isset($_POST['unlike'])){
       $unlike_this_file = isset($_POST['file']) ? $systemMedia->formatInput($_POST['file']) : '';
      
       if( $unlike_this_file != ''){

            $allowed_extensions = ['.png','.jpg','.jpeg','.jfif'];
            $file_extension = strrchr($unlike_this_file,'.');
    
            if(in_array(strtolower($file_extension),$allowed_extensions)){
                
                $is_deleted = $systemMedia->unlikeFile($root_path.$unlike_this_file);
                
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
       $systemMedia->cos_redirect('?vl='.$systemMedia->cursor('media')['index']['out']);

    }
?>

<div class="col s12">
    <div class="col s12">
        <h1><i class="fa fa-image"></i></h1>
    </div>
</div>

<div class="col s12">

    <?php if($files != [] && $files > 0 ): ?>
        <?php foreach($files as $file): ?>
        <div class="col s4 " style=' margin-top:20px;' >  
                <div class="col s6 white" style='padding-left:0px; border-radius:2px 0px 0px 2px;'>
                        <img src="<?= $root_path.$file ?>" 
                            width="100%" 
                            height="129;"  
                            class="materialboxed"  
                            style='border-radius: 2px 0px 0px 2px;'/>
                </div>
                <div  class="col s6 white black-text" 
                        style="padding:0px; padding-right:2px; height:129px; border-radius:0px 2px 2px 0px; font-size:14px;">

                        <p>
                          <i class="fa fa-image blue-text"></i>  <?= $file ?> 
                            <br/>                                  
                       <i class="fa fa-bitbucket blue-text"></i> <?php
                                $size_and_dimensions = $systemMedia->fileSize($root_path.$file,true);
                            
                                if($size_and_dimensions !== false){
                                    
                                    $size_width_height = explode(',', $size_and_dimensions);
                                    $size = (int)$size_width_height[0];

                                    echo  $systemMedia->formatSize($size);
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
                        
                        </p>
                                                              
                        <form action="#!" method="post" class="right-align" style='margin-top:30px'>
                                <input type="hidden" name="file" value="<?= $file ?>" />
                                <button class="z-depth-0"  name='unlike' style="background-color:transparent; border:none;" type="submit"> <i class="red-text fa fa-trash"></i></button>
                        </form>

                </div> 
            </div> 
        <?php endforeach; ?>
    <?php endif; ?>

</div>