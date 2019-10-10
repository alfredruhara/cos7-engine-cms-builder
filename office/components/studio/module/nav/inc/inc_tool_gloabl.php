
   <div id="global">
             <!-- Action -->
            <div class="row cust_menu center-align" style=';'>
               <br/>  <h5><i class="fa fa-server white-text"></i> Global  </h5> <br/>
            </div>

            <div class="nav-content" style='border-bottom:1px solid #555555; margin-top:-20px'>
                <ul class="tabs tabs-transparent white ">
                
                    <li class="tab"><a  class="active black-text" href="#buildrestore"> <i class="fa fa-magic"></i> Build Restore </a></li>
                    <li class="tab"><a  class='black-text' href="#createrestorepoint"><i class="fa fa-flag"></i> Create a restore Point </a></li>
                    <li class="tab"><a  class='black-text' href="#archive"><i class="fa fa-archive"></i> Archive</a></li>
                
                </ul>
            </div>
            <div class="row" style='padding:10px;'>
                
               <div id="buildrestore">
                    <!-- Clear fix tabs content this menu -->
                     <h5><i class="fa fa-magic red-text"></i> Restore Your build   </h5>

                     <div class="col s12">            
                            <p><i class="fa fa-info-circle white-text"></i>
                               You can undo build changes by reverting your website menus to a previous restore point . 
                               <br/>This can help to fix problem that might be making 
                               your website ( website menus ) run slowly or stop responding .

                               <br/> <br/> 
                               Build restore does not affect the back office settings,configurations,archives,administrator personal data, plugins ...
                               Only Recently menus( plus everything which belong to them ) created and articles might be deleted !
                               <i class="fa fa-fire white-text"></i> 
                            </p>

                            <p class='white-text' ><i class="fa fa-magic white-text"></i> Restore your build (website) to the states it was in before the selected  event</p>
                            <form  method="post">
                                <?php if($globalpoints != []): ?>
                                    <?php foreach($globalpoints as $point): ?>

                                        <p class='col s12 z-depth-0 cust_menu' style='padding:8px;'>
                                            <input name="basedpoint" type="radio"  id="point<?= $point->id ?>" value='<?= $point->id ?>' />
                                            <label for="point<?= $point->id ?>">
                                            Date created : <?= $point->date; ?>
                                            <br/>
                                            Description -: <?= $point->description; ?> 
                                            </label>   
                                                                            
                                        </p>


                                    <?php endforeach; ?>
                                   <p class='red-text' ><i class="fa fa-magic red-text"></i> Are you sure ? you can't undo this once click the restoration button </p>
                                    
                                    <button class="btn white black-text " type='submit' name='cleanmenu'> <i class="fa fa-magic "></i> Restore  </button>    
                                    
                                    <?php else: ?>
                                        <p> <i class="fa fa-fire white-text"></i> RESTORATION NOT FOUND , Create a restoration point in 
                                            <i class="fa fa-flag white-text"></i>  Point TAB </p>

                                    <button class="btn white black-text " type='submit' name='cleanmenu' disabled> <i class="fa fa-magic "></i> Restore  </button>    

                                <?php endif; ?>
                                </br>
                            
                            </form>
                            <br/>
                    </div>  <!-- end of second split div s6 -->

               </div> <!-- end of Build Restore-->
              
              <div id="createrestorepoint">
                     <!-- Archive this menu -->
                     <h5><i class="fa fa-flag white-text"></i> Create a build restore Point </h5>

                    <div class="col s12">
                            
                        <p><i class="fa fa-info-circle white-text"></i>
                           Think to create some restoration point of your build while building  menu and so one . 
                           <br/> This help to save the current runnig state of your menus (plus menu contents) . <i class="fa fa-flag white-text"></i> 
                        </p>

                        <form  method="post">

                        <p><i class="fa fa-info-circle white-text"></i>
                            Type a short description to help you identify the restore point. the current date and time are automatically added
                        </p>

                        <label for="">Description</label>
                        <input type='text' class='validate' name='desc' placeholder='type a short description...' required  />
                    
                        <button class="btn cust_nav " type='submit' name='createrestorepoint' > <i class="fa fa-flag "></i> Create </button>    
                        <br/> <p></p>
                        </form>

                    </div>

              </div><!-- end of Build Create a restore Point-->
             
             <div id="archive" class='center-align'>
                <h5 class='white-text'><i class="fa fa-info-circle "> </i> Unavailable feature ! </h5>                                  
             </div><!-- end of archive-->

              
            </div>  <!-- end of Global Conatiner Tabs-->                                      
    </div> <!-- end of Global -->






