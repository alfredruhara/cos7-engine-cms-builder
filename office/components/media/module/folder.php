<?php
    $systemFolder = System::getInstance();
    #Getting the instance of the Class MenuTable
    $menu_table   = $systemFolder->getTable('menu');
    $back = '?vl='.$systemFolder->cursor('media')['index']['out'];

    # The id of the menu passed as get value : $_GET['folder'] === menu->id
    if(isset($_GET['folder'])){
        #Force checking : making sure the value of $_GET[folder] it's range between 0-9
        if(preg_match("/^[0-9]*$/",$_GET['folder']) ) {
            #saving the menu id as folder id
            $folder_id = $systemFolder->formatInput($_GET['folder']);
        }
    }
    #If the folder were retrieve well from the $_GET['value']
    if(isset($folder_id)) {
        #Find that Id if its really exists in the database table menu
        $folder = $menu_table->find($folder_id);
    }else{
        #redirect if $folder_id was not set
       $systemFolder->cos_redirect($back);
    }
    #Folder referer to the Menu table () ? if the folder were not found meaning the passed id as $_GET['folder'] does not exist in the db : else redirect
     $folder === false ?$systemFolder->cos_redirect($back)  : '' ;


?>
<?php
     #storing the space used this folder (size) and count items : $folder->menu_dir (directory) . folderSize <- read function more explanation abt what it returned
     $root_size_count_items = explode(',',$systemFolder->folderSize('../datas/'.trim($folder->menu_dir).'/'));
     #formating the space used (size) in real format (units) : this save the size in B,KB,MB,GB,TB depends on the value passed ! 
     $used_size = $systemFolder->formatSize($root_size_count_items[0]);
    
?>

<?php
    #used the table article
    $article_table = $systemFolder->getTable('article');
    #select all image from article with $folder_id($menu->id)
    $images = $article_table->select_images($folder_id);
    #Index count 
    $index = 1;
?>

<?php
    #save settings changes ... saving the view of this folder
    if(isset($_POST['setview'])){
        #getting the option selected : 
        $view_media_of_this = isset($_POST['view']) ? $systemFolder->formatInput($_POST['view']) : 'table';
        #can only receive this two values : else error : the user is trying to insert unkown value
        if($view_media_of_this === "table" || $view_media_of_this === "card") {
            #Contacting the database : query sent 
            $kila_kitu_poa = $menu_table->update($folder->id,[
                'view_media_of_this' => $view_media_of_this
            ]);
            #date reched into the datable : sucess redirect
            if ($kila_kitu_poa){
                $systemFolder->cos_redirect('?vl='.$systemFolder->cursor("media")['folder']['out']."&folder=".$folder->id);
            }

        }
    }

?>

<!-- Output the header  -->
<div class="row cust_menu">
    <div class="col s10 pinned cust_menu " style='z-index:99; border-bottom:2px solid #292934;'>
           
           <div class="col s8">
                 
                 <!-- Folder title  -->
                 <h5><i class="fa fa-folder-open"></i> <?= ucfirst($folder->menu) ?>   </h5>
                  <!--Folder real path  -->
                 <i class="fa fa-server"></i> Real Path : <a href="?vl=<?= $systemFolder->cursor("media")['index']['out'] ?>">datas</a> / <?= trim($folder->menu_dir) ?> /
             
                <div>
                    <!-- Folder size  -->
                    <a href="#!" class='orange-text'> Folder size : <?= $used_size ?> </a> 
                    <!-- Folder items contains ref : images only --> 
                    <a href="#!" class='orange-text' style='margin-left:15px;'>  Contains : 
                        <?= $root_size_count_items[1] > 1 ? $root_size_count_items[1]." images" : $root_size_count_items[1]." image"; ?> 
                    </a>  
                    
                </div>

           </div>
          
           <!-- Location folder  -->
           <div class="col s4 right-align orange-text" style='margin-top:10px;'> 
                Location : Root / <?= ucfirst($folder->menu) ?>  /
               <!-- Form and views options of the folder  -->
                <form action="#" method='post' style='position:absolute;bottom:2px; right:15px'>
                    <p class='grey-text'> View : 
                        <input class="with-gap" name="view" type="radio" id="table" value='table'  <?= $folder->view_media_of_this === "table" ? 'checked' : '' ?>/>
                        <label for="table"> Table </label> 
                        <input class="with-gap" name="view" type="radio" id="card" value='card' <?= $folder->view_media_of_this === "card" ? 'checked' : '' ?> />
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

<!-- Display Details View if   -->
<?php if($folder->view_media_of_this === "table"): ?>

    <div class="col s12 cust_menu">
        <div class="col s12">
            <table class="striped highlight  responsive-table">
                <thead class='' style=''>
                    <tr >
                        <th  class="left-align"> Image </th>
                        <th  class="left-align">File name</th>
                        <th  class="left-align orange-text">Ref. Article</th>
                        <th  class="right-align">Size</th>
                        <th  class="right-align">Dimensions</th>
                        <th  class="right-align">Ext</th>
                    </tr>
                </thead>
                <tbody>

                    <!-- Making sure image retrieve from Article table did not send an empty result  -->
                    <?php if($images != []) : ?>
                        <!-- Looping through Image got -->
                        <?php foreach($images as $image): ?>
                        <!-- Making sure if the value is not empty an image were posted: ref : article cant have some time media :  -->
                        <?php if($image->media_file != null) : ?>
                                <tr>
                                    <!-- Output a small illustration of the image  --> 
                                    <td>   
                                        <div>
                                            <img src="<?= $image->media_url ?>" width="40" height="25"  class="materialboxed" />
                                        </div>
                                    </td>
                                    <!-- Image title + extendsions  -->
                                    <td  class="left-align">
                                        <?= str_replace($folder->menu_dir.'/','',$image->media_file )?>
                                    </td>  
                                    <!-- reference thto thee article where this image were attached   --> 
                                    <td  class="left-align orange-text">
                                    <a href="?vl=<?= $systemFolder->cursor('article')['index']['out'].'&search='.$image->id ?>" 
                                        style='text-decoration:underline;' > 
                                        <?= ucfirst($image->title)  ?> </a>
                                    </td>  
                                    <!-- Image size + Image dimensions  --> 
                                    <td class='right-align'> 
                                        <?php
                                            #getting the image size + dimensions ( Width+Height)
                                            $size_and_dimensions = $systemFolder->fileSize($image->media_url,true);
                                            #In case the method send a false value - meaning something happen
                                            if($size_and_dimensions !== false){
                                                #exploding the result get back (transforming string to [] )
                                                $size_width_height = explode(',', $size_and_dimensions);
                                                #the value at index 0 : is the image size
                                                $size = (int)$size_width_height[0];
                                                #print and formating that value to get normal syntax ( units like mbs,gb,kb,...)
                                                echo  $systemFolder->formatSize($size);
                                            }else{
                                                #error : just print 0B
                                                echo '0B';
                                            }
                                            
                                        ?>
                                    </td>  
                                    <!-- Image Dimensions -->                      
                                    <td class='right-align'> 
                                        <?php
                                            #In case the method send a false value - meaning something happen
                                            if( $size_and_dimensions !== false ){
                                                #the value at index 1 : is the image Width
                                                $width = $size_width_height[1];
                                                #the value at index 2 : is the image Heighy
                                                $heigh = $size_width_height[2];
                                                #Printing the image Width X Height as real dimensions
                                                echo $width.' x '.$heigh;  

                                            }else{
                                                #just print w=>0 x h=>0 -- 0x0
                                                echo "0x0";
                                            }
                                    
                                        ?>  
                                    </td>
                                    <!-- Image extensions -->
                                    <td  class="right-align">
                                        <?= strrchr($image->media_file,'.') ?>
                                    </td>                 
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        <!-- The folder is empty of use image -->
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

   <?php else: ?>

    <div class="col s12 ">  
        <div class="col s12"style="padding:0px">
        <br/>
            <?php if($images != []) : ?>
                    <?php foreach($images as $image): ?>
                            <?php if($image->media_file != null) : ?>
                            
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
                                            <i class="fa fa-image blue-text"></i>   <?= str_replace($folder->menu_dir.'/','',$image->media_file )?> 
                                                <br/>                                  
                                          <i class="fa fa-bitbucket blue-text"></i>  <?php
                                                    $size_and_dimensions = $systemFolder->fileSize($image->media_url,true);
                                                
                                                    if($size_and_dimensions !== false){
                                                        
                                                        $size_width_height = explode(',', $size_and_dimensions);
                                                        $size = (int)$size_width_height[0];
            
                                                        echo  $systemFolder->formatSize($size);
                                                    }else{
                                                        echo '0B';
                                                    }
                                                    
                                                ?>
                                            <br/>
                                            <i class="fa fa-expand blue-text"></i>  <?php
                                                
                                                    if( $size_and_dimensions !== false ){
                                                    
                                                        $width = $size_width_height[1];
                                                        $heigh = $size_width_height[2];

                                                        echo $width.' x '.$heigh;  

                                                    }else{
                                                        echo "0x0";
                                                    }
                                            
                                                ?>  
                                                <br/>
                                            <i class="fa fa-at orange-text "></i>  <a href="?vl=<?= $systemFolder->cursor('article')['index']['out'].'&search='.$image->id ?>" 
                                                style='text-decoration:underline; font-size:11px;' > 
                                                    <?= ucfirst($image->title)  ?>
                                                </a> 
                                            </p>

                                    </div> 
                                </div> 
                            <?php endif; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
        </div>
    </div>

<?php endif; ?>
<?php
    $path_folder = "../datas/".$folder->menu_dir."/";

   
    $gotten_files = $systemFolder->getFiles($path_folder);
    $index_lost= $index;
    $newImg = [];
    $unused_image_were_found  = false;

    foreach($images as $img){
        $newImg[] = str_replace($folder->menu_dir.'/','', $img->media_file);
    }

 
?>
<?php
    if(isset($_POST['unlike'])){
       $unlike_this_file = isset($_POST['file']) ? $systemFolder->formatInput($_POST['file']) : '';
      
       if( $unlike_this_file != ''){

            $allowed_extensions = ['.png','.jpg','.jpeg','.jfif'];
            $file_extension = strrchr($unlike_this_file,'.');
    
            if(in_array(strtolower($file_extension),$allowed_extensions)){
                
                $is_deleted = $systemFolder->unlikeFile($path_folder.$unlike_this_file);
                   
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
               
       $systemFolder->cos_redirect("?vl=".$systemFolder->cursor("media")['folder']['out']."&folder=".$folder->id);
    }
?>



















         
<div class="col s12 cust_menu" style='margin-top:20px;'>
    <div class="col s12">
    <br/>   <h5> <i class="fa fa-fire"></i> Broken references or Unused </h5> <br/>
    </div>

</div>



            <?php if($folder->view_media_of_this === "table"): ?>
            <div class="col s12">
                <div class="col s12">
              
                
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
                                            <?= $file ?> <br/> <br/>
                                            <div class="actions-hover">
                                                 <form action="#!" method="post" style="display:inline;">
                                                        <input type="hidden" name="file" value="<?= $file ?>" />
                                                        <button class=""  name='unlike' style="background-color:transparent; border:none;" type="submit">
                                                           <i class="orange-text fa fa-trash"></i> Delete
                                                        </button>
                                                </form>
                                            </div>   
                                        </td>                        
                                        <td class='right-align'> 
                                                <?php
                                                    $size_and_dimensions = $systemFolder->fileSize($path_folder.$file,true);
                                                
                                                    if($size_and_dimensions !== false){
                                                        
                                                        $size_width_height = explode(',', $size_and_dimensions);
                                                        $size = (int)$size_width_height[0];
            
                                                        echo  $systemFolder->formatSize($size);
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


            <?php else: ?>
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
                                                    <i class="fa fa-image blue-text"></i>  <?= $file ?>
                                                        <br/>                                  
                                                    <i class="fa fa-bitbucket blue-text"></i> <?php
                                                            $size_and_dimensions = $systemFolder->fileSize($path_folder.$file,true);
                                                        
                                                            if($size_and_dimensions !== false){
                                                                
                                                                $size_width_height = explode(',', $size_and_dimensions);
                                                                $size = (int)$size_width_height[0];
                    
                                                                echo  $systemFolder->formatSize($size);
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
