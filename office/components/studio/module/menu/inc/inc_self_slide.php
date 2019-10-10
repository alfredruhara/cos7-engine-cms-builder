<div class="slider" > 
            <ul class="slides" >

             <!-- Adding a new slider to the menu  -->
            <li class='cust' >

               <form method='post' class="row" id='form' enctype="multipart/form-data" >

                  <img src="" id='disp'>
                 
                  <div class="caption left-align" >
                    
                    <div class="file-field input-field">
                        <div class="btn z-depth-0 bordered-btn-cust" style='background:transparent; '>
                            <span><i class="white-text fa fa-image "></i>  Image </span>
                            <input type="file" name='attach' id='attach' required>
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" type="text" style='border:none; border-bottom:1px solid grey;'>
                        </div>
                    </div>
                    
                     
                    <input type="text"
                           placeholder='Caption Title' 
                           name='caption_title' 
                           style='font-size:30px; border:none; border-bottom:1px solid grey;'>
                    
                    <input type="text" 
                            class="light grey-text text-lighten-3" 
                            placeholder='Caption Slogan'
                            name='caption_slogan'
                            style='font-size:22px; border:none; border-bottom:1px solid grey;'>
                        
                    <p class='col s6'>
                        <input name="caption_align" type="radio" id="left_align"  value='left' checked />
                        <label for="left_align">Align Caption on Left side </label>
                    </p>
                    <p class='col s6' >
                        <input name="caption_align" type="radio" id="up_align"  value='center' />
                        <label for="up_align">Align Caption to the Up side</label>
                    </p>
                   
                    <div class="col s12 right-align">
                    <br/>
                         <button class="btn cust_nav z-depth-0" type='submit' name='addslider' ><i class="fa fa-plus white-text"></i> Add Slider</button>
                    </div>
                  
                  </div>
               </form>

            </li>
            <?php if( $sliders != []) : ?>
                <?php foreach($sliders as $slide): ?>
                <li >
                        <form method='post' style='position:absolute; padding:5px; border-radius:5px; bottom:10px; right:10px; background:rgba(0,0,0,0.6)' >
                         
                            <input type="hidden" value='<?=  $slide->sid?>' name='slideid' >
                             <i class="fa fa-trash red-text" style='font-size:19px;' > </i> 
                             <input type='submit' 
                                    style='background:transparent;font-size:19px; border:none; '
                                    class='red-text'
                                    value ='delete'
                                    name='deleteslide'
                                    />
                               
                           
                        </form>
                     

                         
                        <img src="<?= $slide->media_url ?>">

                        <form  method="post" enctype="multipart/form-data" >
                            <input type='hidden' value='<?= $slide->sid;?>' name='slideeditid' />     

                            <div class="caption <?= trim($slide->scaption_align) ?>-align" style='background:rgba(0,0,0,0.6);padding:10px; border-radius:10px;' >

                                <div class="file-field input-field">
                                    <div class="btn z-depth-0 bordered-btn-cust" style='background:transparent; '>
                                        <span><i class="white-text fa fa-image "></i> Change Cover </span>
                                        <input type="file" name='attach_update' id='attach' >
                                    </div>
                                    <div class="file-path-wrapper">
                                        <input class="file-path validate" type="text" style='border:none; border-bottom:1px solid grey;'>
                                    </div>
                                </div>
                                
                              

                                <input type="text" 
                                    <?= $slide->scaption_title !='' ? "value='$slide->scaption_title'"  : "    placeholder='Title the caption'" ?>               
                                    name='caption_title' 
                                    style='font-size:30px; border:none; border-bottom:1px solid grey;'>
                                
                                <input type="text" 
                                        class="light grey-text text-lighten-3" 
                                        <?= $slide->scaption_slogan !='' ? "value='$slide->scaption_slogan'"  : "    placeholder='add caption Slogan'" ?>             
                                        name='caption_slogan'
                                        style='font-size:22px; border:none; border-bottom:1px solid grey;'>
                                    
                                        <div class="col s12 right-align" style='position:absolute; bottom:10px; right:2px;' >
                                        <button class="btn cust_nav z-dept h-0" type='submit' name='editslider' ><i class="fa fa-edit white-text"></i> Save changes</button>
                               </div> 

                                <p class='col s6'>
                                    <input name="caption_align_<?= $slide->sid ?>" 
                                        type="radio" id="left_align_<?= $slide->sid ?>"  
                                        value='left' 
                                        <?= $slide->scaption_align === 'left' ? 'checked'  : ''; ?>
                                        />
                                    <label for="left_align_<?= $slide->sid ?>">Align Caption on Left side </label>
                                </p>

                                <p class='col s6' >
                                    <input name="caption_align_<?= $slide->sid ?>" 
                                        type="radio"
                                        id="up_align_<?= $slide->sid ?>"  
                                        value='center'
                                        <?= $slide->scaption_align === 'center' ? 'checked'  : ''; ?>
                                        />

                                    <label for="up_align_<?= $slide->sid ?>">Align Caption to the Up side</label>
                                </p>
                               <div class="row"></div>
                               <div class="row"></div>
                            </div>
                        </form>
                    </li>
                <?php endforeach; ?>
                <?php endif; ?>

            </ul>
        </div>
<br/>