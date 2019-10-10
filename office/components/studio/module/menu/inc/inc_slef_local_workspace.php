
<!-- Action -->
<div class="row" style='padding-left:10px;'>
    <h4><i class="fa fa-server white-text"></i> Local  </h4>
</div>

<div class="nav-content" style='border-bottom:1px solid #555555'>
    <ul class="tabs tabs-transparent cust ">
        <li class="tab"><a  class='white-text active' href="#update"> <i class="fa fa-minus"></i>  Action </a></li>
        <li class="tab"><a  class="white-text" href="#clear"> <i class="fa fa-magic"></i> Clear </a></li>
        <li class="tab"><a  class='white-text' href="#point"><i class="fa fa-flag"></i> Point </a></li>
        <li class="tab"><a  class='white-text' href="#archive"><i class="fa fa-archive"></i> Archive</a></li>
      
    </ul>
</div>
<div class="row cust" style='padding:0px;'>
     
   
    <div id="update" class="col s12 cust_menu" style='padding:0px;'>

         
       <br/>
            <div class="center-align ">
                <h5> Action </h5>                      
            </div>
       <br/>
 

        <div class="nav-content" >
            <ul class="tabs tabs-transparent white " >
                <li class="tab"><a  class='black-text active' href="#menu_action"> <i class="fa fa-list"></i>  Menu </a></li>
                <li class="tab"><a  class="black-text" href="#category_action"> <i class="fa fa-minus"></i> Categories (Sub Menu) </a></li>
            </ul>
        </div>

         <div id="menu_action" class="col s12 cust" style='padding:0px;'>
                <br/>
                <div class="nav-content" style='border-bottom:1px solid #555555' >
                    <ul class="tabs tabs-transparent cust ">
                        <li class="tab"><a  class='white-text active' href="#menu_action_update"> <i class="fa fa-upload"></i>  Update </a></li>
                        <li class="tab"><a  class="red-text" href="#menu_action_delete"> <i class="fa fa-trash"></i> Delete </a></li>
                    </ul>
                </div>


                 <div id="menu_action_update" class="col s12">
                      <br/>
                       <div class="col s12">
                            <h5><i class="fa fa-upload white-text"></i> Update </h5>    <br/> 
                       </div>
                    
                        <form method="post" class=''>
                            
                            <div class="col s4 ">
                                <label for=""> Menu title</label>
                                <input type='text' class='validate' name='menu_title' value='<?= $menu->menu ?>' required  />
                            </div>

                            <div class="col s4 center-align ">
                                   <label for="">Menu switch control</label> 
                                    <div class="switch"> <br/>
                                        <label>
                                            Off
                                            <input type="checkbox" name="menu_switch" <?= $menu->switch_menu == 'on' ? 'checked' : '' ?> >
                                            <span class="lever"></span>
                                            On
                                        </label>
                                    </div>
                            </div>

                            <div class="col s4 center-align ">
                                <br/>
                                <button class="btn cust_nav" type='submit' name='editmenu'>
                                       Update
                                </button>
                                <br/><p></p>
                            </div>
                        
                        </form>
                      
                 </div>

                <div id="menu_action_delete" class="col s12">
                      <br/>
                        <div class="col s12">
                                    <div class="col s12">
                                        <h5><i class="fa fa-trash "></i> Delete </h5>
                                    </div>

                                    <div class="col s6">
                                            <blockquote class='z-depth-1' style='border-color:white; padding:10px; border-radius:0px 10px 10px 0px'>
                                                action which will delete this menu + all data related to it , such as : articles , slides , categories , sub categories
                                                , comments etc. This action can't be undone <i class="fa fa-fire white-text"></i> 
                                            
                                            </blockquote>
                                    </div> 
                                    <form  method="post" class='col s6 center-align'> 
                                           <p class='center-align'> Are you sure ? </p>
                                            <input type="hidden" name='id_menu'>
                                            <button class="btn red" type='submit' name='deletemenu'> <i class="fa fa-trash white-text"></i> Delete</button>  
                                            <br/>  <p></p>
                                    </form>
                        </div>
                </div>
                  
         </div>

        <!-- Action on Categories -->
          <div id="category_action" class="col s12 cust">
            
            <br/>       
            <h5><i class="fa fa-ellipsis-v white-text"></i>  Categories </h5>
            <br/>       

            <table class="striped highlight responsive-table">
                    <thead>
                    <tr >
                        <th  class="center-align">Id</th>
                        <th  class="center-align" >Title</th>
                        <th  class="center-align" >Switch</th>
                        <th  class="center-align">Submit</th>
                    </tr>
                    </thead>
            
                    <tbody>
                    <?php if($categories != []) : ?>
                        <?php foreach($categories as $item): ?>

                        <form method='post'> 
                            <tr>
                                <td  class="center-align">
                                    <?= $item->id ?>
                                    <input type='hidden' name='cat_id' value='<?= $item->id ?>';
                                </td>
                                <td  class="center-align" >
                                    <input type="text" name='category_title' value='  <?= ucfirst($item->title) ?>'>
                                </td>

                                
                                <td class="center-align" style='display:flex; justify-content:space-around'>
                                
                                    <div class="switch">
                                    <label for="">
                                    Control
                                    </label> <br/>
                                        <label>
                                        Off
                                        <input type="checkbox" <?= $item->switch_category == 'on' ? 'checked' : '' ?>  name='switch_category' >
                                        <span class="lever"></span>
                                        On
                                        </label>
                                </div>

                                </td>

                                <td class="center-align">

                                    <button class="btn "  style="background-color:transparent;" type='submit' name='updatecat' >
                                        <i class="white-text fa fa-upload"></i>
                                    </button>

                                    <button class="btn "  style="background-color:transparent;" type='submit' name='deletecat' >
                                        <i class="red-text fa fa-trash"></i>
                                    </button>
                        
                                    
                                </td>
                            </tr>
                            </form>
            
                        <?php endforeach; ?>

                            <?php else : ?>
                              <tr  >
                                <td colspan='4'>
                                    <h6 class='center-align'>   
                                            <i class="white-text fa fa-info-circle"></i> 
                                           You haven't yet created a category on this menu !  
                                    </h6>
                                </td>  
                              </tr>
                        <?php endif; ?>

                    </tbody>
                </table>
         </div>


        




    </div>


    <!--   Clear tabs-->

    <div id="clear" class="col s12">
            
        <div class="col s12">
            <!-- Archive this menu -->
            <h5><i class="fa fa-magic red-text"></i> Clear </h5>

            <div class="col s6">
                <p><i class="fa fa-info-circle red-text"></i>
                    use this to clear all posts with their comments which are in this menu . categories, 
                    sub categories and slides will not be deleted.
                    This action can't be undone <i class="fa fa-fire red-text"></i> 
                </p>
                <form  method="post">
                      
                        <button class="btn white  black-text" type='submit' name='simpleclear'> <i class="fa fa-fire red-text"></i> Clear </button>    
                </form>
                <br/>
            </div>

            <div class="col s6">            
                <p><i class="fa fa-info-circle white-text"></i>
                    You can also clear by restore point to erase all data ( categories , sub categories , posts , slides , etc ) 
                    which came after that Point.
                    This action can't be undone <i class="fa fa-fire white-text"></i> 
                </p>


                <form  method="post">
                    <?php if($restoration_points != []): ?>
                        <?php foreach($restoration_points as $point): ?>

                             <p class='col s12 z-depth-1' >
                                  <input name="basedpoint" type="radio"  id="point<?= $point->id ?>" value='<?= $point->id ?>' />
                                  <label for="point<?= $point->id ?>">
                                   Date created : <?= $point->date_point; ?>
                                   <br/>
                                   Description -: <?= $point->description; ?> 
                                  </label>   
                                                                  
                              </p>


                        <?php endforeach; ?>

                         <button class="btn white black-text " type='submit' name='cleanmenu'> <i class="fa fa-magic "></i> Clear By Point </button>    
                        
                        <?php else: ?>
                            <p> <i class="fa fa-fire white-text"></i> RESTORATION NOT FOUND , Create a restoration point in 
                                <i class="fa fa-flag white-text"></i>  Point TAB </p>

                         <button class="btn white black-text " type='submit' name='cleanmenu' disabled> <i class="fa fa-magic "></i> Clear By Point </button>    

                    <?php endif; ?>
                    </br>
                   
                </form>
                <br/>
            </div>

   
         </div>
    </div>

    <div id="point" class="col s12">
         <div class="col s12">
             <!-- Archive this menu -->
            <h5><i class="fa fa-flag white-text"></i> Restore point </h5>

            <div class="col s12">
                      
                <p><i class="fa fa-info-circle white-text"></i>
                    Create a restore point of this menu , you can back on this point in the clear option . <i class="fa fa-flag white-text"></i> 
                </p>

                <form  method="post">

                   <p><i class="fa fa-info-circle white-text"></i>
                      Type a short description to help you identify the restore point. the current date and time are automatically added
                  </p>

                  <label for="">Description</label>
                  <input type='text' class='validate' name='desc'  required  />
               
                   <input type="hidden" name='id_menu'>
                   <button class="btn cust_nav " type='submit' name='createrestorepoint'> <i class="fa fa-flag "></i> Create </button>    
                   <br/> <p></p>
                </form>
            </div>

         
         </div>
    </div>
    <div id="archive" class="col s12 center-align">
                <h5 class='white-text'><i class="fa fa-info-circle "> </i> Unavailable feature ! </h5>
    </div>


</div>