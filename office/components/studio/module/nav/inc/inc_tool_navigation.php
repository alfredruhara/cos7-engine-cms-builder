<div id="navigationbar" class="col s12" style='padding:0px;'>      
        <div class="row cust " style='padding:10px;'>
            <br/>
            <div id="addmenu" class="col s12">

               <div class="col s6" style='padding:0px;'>
                    <div class="col s12" >
                        <ul class="collapsible white-text"  style='border:none;' data-collapsible="accordion">
                            <li class=''>
                                <div class="collapsible-header active cust_menu" >
                                    <i class="fa fa-plus"></i>Add a slide
                                </div>
                                <div class="collapsible-body " style='padding:10px;'> <br/>
                                    <div class="row" style='padding:0px;'>
                                          <form method='post' class="row" id='form' enctype="multipart/form-data" >            
                                                <div class="">
                                                    <div class="col s12">
                                                        <i class="fa fa-info-circle orange-text"></i>  Select the menu where to add this slide ! 
                                                    </div>
                                                         <?= $form->select('menu_id', 'Select Menu ', $menu_select) ?>
                                                    </div>
                                                   <div class="slider"> 
                                                        <ul class="slides" style='border-radius:10px;'  >
                                                            <li class='cust ' id='slide_trigger' style='border-radius:10px;' >
                                                                <img src="" id='disp_slide' >                       
                                                                    <div class="caption left-align" style='background:rgba(0,0,0,0.3); padding:10px; border-radius:10px;' >                                                                    
                                                                        <div class="file-field input-field">
                                                                            <div class="btn z-depth-0 bordered-btn-cust" style='background:transparent; '>
                                                                                <span><i class="white-text fa fa-image "></i>  Image </span>
                                                                                <input type="file" name='attach' id='attach_trigger' required>
                                                                            </div>
                                                                            <div class="file-path-wrapper">
                                                                                <input class="file-path validate" type="text" style='border:none; border-bottom:1px solid grey'>
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        
                                                                        <input type="text" 
                                                                            placeholder='Caption Title' 
                                                                            name='caption_title' 
                                                                            style='font-size:30px; border:none; border-bottom:1px solid grey'>
                                                                        
                                                                        <input type="text" 
                                                                                class="light grey-text text-lighten-3" 
                                                                                placeholder='Caption Slogan'
                                                                                name='caption_slogan'
                                                                                style='font-size:22px; border:none; border-bottom:1px solid grey'>
                                                                            
                                                                        <p class='col s6'>
                                                                            <input name="caption_align" type="radio" id="left_align"  value='left' checked />
                                                                            <label for="left_align">Align  Left </label>
                                                                        </p>
                                                                        <p class='col s6' >
                                                                            <input name="caption_align" type="radio" id="up_align"  value='center' />
                                                                            <label for="up_align">Align Up</label>
                                                                        </p>
                                                                        
                                                                        <div class="col s12 right-align">
                                                                        <br/>
                                                                            <button class="btn cust_nav z-depth-0" type='submit' name='slider' ><i class="fa fa-plus white-text"></i> Add Slider</button>
                                                                        </div>
                                                                                    
                                                             </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </li>   
                            </ul>
                     </div>
               </div>

                <div class="col s6" style='padding:0px;'>

                    <div class="col s12">
                        <ul class="collapsible white-text"  style='border:none;' data-collapsible="accordion">
                            <li class=''>
                                <div class="collapsible-header active cust_menu" >
                                    <i class="white-text fa fa-plus"></i> Menu 
                                </div>
                                <div class="collapsible-body " style='padding:10px;'> <br/>
                                    <div class="row " >
                                        <form method="post">
                                            <div class='row'>
                                                <div class="col s12">
                                                   <i class="fa fa-info-circle orange-text"></i>  Add a menu to the navigation bar of the web site. 
                                                </div>    
                                                <div class='input-filed col s12'>   
                                                    <label for=""> Title </label>
                                                    <input type="text" name='menu_title' placeholder='Titled the menu...'>
                                                </div>
                                                <div class='input-filed col s12 left-align'>
                                                    <?= $form->validate('menu','Create Menu', 'btn cust_nav z-depth-0')?>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </li>   
                        </ul>
                    </div>

                    <div class="col s12">

                            <ul class="collapsible white-text"  style='border:none;' data-collapsible="accordion">
                                <li class=''>
                                    <div class="collapsible-header active cust_menu" >
                                        <i class="white-text fa fa-plus"></i> Category ( sub menu ) 
                                    </div>
                                    <div class="collapsible-body " style='padding:10px;'> <br/>
                                        <div class="row">
                                            <form method="post">
                                                <div class='row'>
                                                    <div class="col s12">
                                                    <i class="fa fa-info-circle orange-text"></i>  Add a sub menu or category on the selected menu
                                                    </div>    
                                                    <div class="col s12" style='padding:0px;'>
                                                        <?= $form->select('menu_id', 'Select Menu ', $menu_select) ?>
                                                    </div>
                                                    <div class="col s12">
                                                        <label for=""> title </label>
                                                        <input type="text" name='category_title' placeholder='Titled the Category...'>
                                                    </div>
                                                    <div class="col s12"> 
                                                        <br/> 
                                                        <?= $form->validate('category','Add Category', 'btn cust_nav z-depth-0')?>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </li>   
                            </ul>
                            
                    </div>
                
                </div>
            </div>

        </div>
 
 </div>
