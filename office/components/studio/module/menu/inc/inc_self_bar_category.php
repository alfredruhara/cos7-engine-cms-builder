<ul class="cust_tabs " style='margin-top:-3px;' >
<?php if( $categories != []): ?>
    <!-- Looping trough categoies Found and printing out  -->
    <?php foreach($categories as $category): ?>
        <li class="cust_tab">
            <a href="?vl=<?= $systemSingleMenu->cursor('studio')['category']['out'] ?>&menu=<?= $menu->id ?>&cat=<?= $category->id ?>" class='category'>
                <?= $category->title ?> 
            </a>
        </li>
     <?php endforeach; ?>
         <!-- Modal Trigger -->
     <li class="cust_tab z-depth-2 cust_menu" >
            <a href="" class='category modal-trigger waves-effect z-depth-1' data-target="newcategory" >
              <b> <i class="fa fa-plus white-text"> Add </i>   </b>
            </a>
     </li>
    <?php else: ?>
    <li class="cust_tab z-depth-1 cust_menu" >
            <a href="" class='category modal-trigger waves-effect z-depth-0' data-target="newcategory" >
              <b> <i class="fa fa-plus white-text"> Add a first category  </i>   </b>
            </a>
     </li>
    <?php endif ?>
 </ul>
 
   <!-- Modal Structure -->
   <div id="newcategory" class="modal modal-fixed-footer cust z-depth-1" >
      <form action='#!' method='post' >
         <div class="modal-content" >
            <div class="row " style='padding:10px;'>
                <h5><i class="fa fa-plus white-text"></i> Add Category (Sub menu)</h5> 
                
                <p>
                  <i class="fa fa-info-circle white-text"></i>
                  Create a new sub menu on <?= $menu->menu ?> menu .  <br/>
                  <i class="fa fa-info-circle <?= $left_place_of_new_category === 0  ?  'red-text' : 'white-text' ?> "></i> 
                  You can only create <?=  $total_allowed_category_on_each_menu ?> categories , 
                  <?php
                      if($left_place_of_new_category === 0){
                          echo "<span class='red-text'> 0 place left . </span>";
                      }else if ($left_place_of_new_category === 1){
                          echo '1 place left for a new Category';
                      }else{
                          echo $left_place_of_new_category.' places left'; 
                      }

                  ?>
              </p>
               
                <div class="col s8 ">
                    <label for=""> Category title</label>
                    <input type='text' class='validate' name='category_title'  required/>
                </div>

                <div class="col s12">
                    <label for="">Category switch control</label> 
                    <p>
                    <i class="fa fa-info-circle white-text"></i>
                     If you switch off this category about to create , it will not appear on the website ! 
                     but you can change it states at any time ...!
                   </p>
                    <div class="switch"> <br/>
                    <label>
                            Off
                            <input type="checkbox" name="category_switch" checked>
                            <span class="lever"></span>
                            On
                        </label>
                    </div>
               </div>


            </div>
         </div>
         <div class="modal-stand cust"
              style='background-color:#292934; border-top:1px solid #555555'>

            <button class="btn btn-flat modal-action modal-close cust_nav white-text z-depth-0"
                    type='submit' 
                    name='addcategory'>
                Add Category
            </button>

         </div>
      </form>
  </div>
        