<?php

use Cos\HTML\MaterializeForm;
$systemCategory = System::getInstance();
#Checking if everythings is oky 
if(isset($_GET['menu']) AND isset($_GET['vl']) && isset($_GET['cat']) )
{
  if(is_numeric($_GET['menu']) AND $_GET['menu'] > 0 AND  is_numeric($_GET['cat']) AND $_GET['cat'] > 0  )
  {
      $getMenuId = (int)$_GET['menu'];
      $getCatId = (int)$_GET['cat'];
  }
}
if(!isset($getCatId) AND !isset($getMenuId) ) $systemCategory->a404();
#Menu table
$menu_table = $systemCategory->getTable('menu');
$menu = $menu_table->find($getMenuId);
$menu === false ?   $systemCategory->a404() : '';
#Category Table
$category_table = $systemCategory->getTable('category'); 
$category = $category_table->uniq($getCatId, $menu->id);
$category === false ?   $systemCategory->a404() : '';
$self   =  '?vl='.$systemCategory->cursor('studio')['category']['out'].'&menu='.$menu->id.'&cat='.$category->id;
#Sub category table
$subcategory_table = $systemCategory->getTable('subcategory');
$subcategories = $subcategory_table->getSubCategories($category->id);
#SOME CALCULATIONs
$total_allowed_subcategory_on_each_menu = 5; 
$total_subcategory_created = (int)count( $subcategories ) ;
if( $total_allowed_subcategory_on_each_menu < $total_subcategory_created ) $total_allowed_subcategory_on_each_menu  =  $total_subcategory_created ;
$left_place_of_new_category = $total_allowed_subcategory_on_each_menu - $total_subcategory_created;
#Add sub category
if(isset($_POST['addsubcategory']) && $left_place_of_new_category > 0 )
{
    $title  = isset($_POST['sub_category_title']) ? $systemCategory->formatInput($_POST['sub_category_title']) : '' ;
    $switch = isset($_POST['sub_category_switch']) ? 'on' : 'off' ;   
    if($title != '')
    {
        $oky = $subcategory_table->create(['title'   => $title,'category_id' => $category->id, 'switch_subcategory' =>$switch ]);
        $oky === true ? $flash->set('success','success') : $flash->set('fatal_error','danger');
    }else
    {
        $flash->set('required','warning');
    }
    $systemCategory->cos_redirect($self);
}
if(isset($_POST['editcategory']) && !isset($_POST['addsubcategory']))
{
  $title  = isset($_POST['category_title']) ? $systemCategory->formatInput($_POST['category_title']) : '' ;
  $switch = isset($_POST['category_switch']) ? 'on' : 'off' ;
  if($title != '')
  {
    if($title != $category->title ||  $switch !=  $category->switch_category )
      {
           $oky = $category_table->update($category->id, ['title' => $title,'switch_category' =>$switch]);
           $oky === true ? $flash->set('update','success') : $flash->set('fatal_error','danger');
     }else
     {
          $flash->set('update','success');
    }      
  }else
  {
    $flash->set('required','warning');
  }
  $systemCategory->cos_redirect($self);
}
 # UPADTE A SUB CATEGORY
if( isset($_POST['updatesubcat'])  AND !isset($_POST['deletesubcat'])  ) 
{
    $subcategory_title  = isset($_POST['subcategory_title']) ? $systemCategory->formatInput($_POST['subcategory_title']) : '' ;
    $subcategory_switch = isset($_POST['switch_subcategory']) ? 'on' : 'off';
    $id = isset($_POST['subcat_id']) ? (int)$_POST['subcat_id'] : '';
    if(    $subcategory_title  != '' &&  $id != '' &&  $id > 0  ){
        #Making sure the passed id in  the hidden field reall y exist 
        foreach($subcategories as $item)
        {
            if( (int)$item->id === $id )
            {
                $id_found = $item->id ;
                break;
            }
        }
       #If not found , meaning the user z trying to bypass the security 
        if( isset($id_found) ) 
        {    
            $oky = $subcategory_table->update_cust($id_found , $category->id, ['title' => $subcategory_title,'switch_subcategory' => $subcategory_switch ]);   
            $oky === true ? $flash->set('update','success') : $flash->set('fatal_error','danger');
        }else
        {
            $flash->set('id_error','danger');
        }
    }else
    {
        $flash->set('id_error','danger');
    }
    $systemCategory->cos_redirect($self);
}
 #DELETE A SUB CATEGORY
if( isset($_POST['deletesubcat'])  AND !isset($_POST['updatesubcat'])  )
{
    $id = isset($_POST['subcat_id']) ? (int)$_POST['subcat_id'] : '';
    if( $id != '' &&  $id > 0  ){
        #Making sure the passed id in  the hidden field reall y exist
        foreach($subcategories as $item)
        {
            if( (int)$item->id === $id )
            {
                $id_found = $item->id ;
                break;
            }
        }
       #If not found , meaning the user z trying to bypass the security
        if( isset($id_found) ) 
        {    
            $oky = $subcategory_table->delete($id_found , $category->id);   
            $oky === true ? $flash->set('success','success') : $flash->set('fatal_error','danger');
        }else
        {
            $flash->set('id_error','danger');
        }
    }else{
        $flash->set('id_error','danger');
    }
    $systemCategory->cos_redirect($self);
}

$form = new MaterializeForm();
?>

<nav class="nav-extended cust_menu pinned z-depth-0" style='z-index:99'>
     <div class="nav-wrapper col s10"> 
       
        <a href="#!" class="brand-logo center">      <?= ucfirst($category->title) ?></a>
        <a href="?vl=<?= $systemCategory->cursor('studio')['menu']['out'].'&id='.$menu->id  ?>" class="brand-logo left " style=' margin-left:7px;'> 
            <i class="fa fa-arrow-left white-text" style='font-size:18px;' >  <?= ucfirst($menu->menu) ?> </i> 
        </a>
       <a href="#!" class="brand-logo right align" style='font-size:18px;'>  
            <span class='orange-text'>location : </span> 
            Menu / Category
        </a>
    </div>
</nav>
<br/> <br/> <br/>
<!-- sub Categories -->
<ul class="cust_tabs " style='margin-top:-3px;' >
<?php if( $subcategories != []): ?>
    <!-- Looping trough categoies Found and printing out  -->
    <?php foreach($subcategories as $subcategory): ?>
        <li class="cust_tab">

            <a href="#!" class='subcategory'>
                <?= $subcategory->title ?>  <sub> sub  </sub>
            </a>
        </li>
     <?php endforeach; ?>
         <!-- Modal Trigger -->
     <li class="cust_tab z-depth-2 cust_menu" >
            <a href="" class='category modal-trigger waves-effect z-depth-1' data-target="newsubcategory" >
              <b> <i class="fa fa-plus white-text"> Add </i>   </b>
            </a>
     </li>
    <?php else: ?>
    <li class="cust_tab  z-depth-1 cust_menu" >
            <a href="" class='category modal-trigger waves-effect  z-depth-0' data-target="newsubcategory" >
              <b> <i class="fa fa-plus white-text"> Add a first  sub category  </i>   </b>
            </a>
     </li>
<?php endif ?>

</ul>


  <!-- Modal Structure -->
  <div id="newsubcategory" class="modal modal-fixed-footer cust z-depth-1" >
      <form action='#!' method='post' >
         <div class="modal-content" >
            <div class="row " style='padding:10px;'>
                <h5><i class="fa fa-plus white-text"></i> Add Sub Category </h5> 
                
                <p>
                  <i class="fa fa-info-circle white-text"></i>
                  Create a new sub category on <?= $category->title ?> (sub menu of <?= ucfirst( $menu->menu) ?> ) .  <br/>
                  <i class="fa fa-info-circle <?= $left_place_of_new_category === 0  ?  'red-text' : 'white-text' ?> "></i> 
                  You can only create <?=  $total_allowed_subcategory_on_each_menu ?> sub categories , 
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
                    <label for=""> Sub Category title</label>
                    <input type='text' class='validate' name='sub_category_title'  required />
                </div>

                <div class="col s12">
                    <label for=""> Sub Category switch control</label> 
                    <p>
                    <i class="fa fa-info-circle white-text"></i>
                     If you switch off this sub category about to create , it will not appear on the website !  <br/>
                     but you can change it states at any time ...!;o
                   </p>
                    <div class="switch"> <br/>
                    <label>
                            Off
                            <input type="checkbox" name="sub_category_switch" checked>
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
                    name='addsubcategory'
                     >
                Add  Sub Category
            </button>

         </div>
      </form>
  </div>


<div class="row cust_menu center-align" style='padding:0px;'>
    </br>  <h5>   Action   </h5>   </br>
</div>
<div class="nav-content" style='border-bottom:1px solid #555555; margin-top:-20px;'>
    <ul class="tabs tabs-transparent white ">
        <li class="tab"><a  class='active black-text' href="#update"> <i class="fa fa-ellipsis-v"></i>  Category </a></li>
        <li class="tab"><a  class=" black-text"     href="#subcategories"> <i class="fa fa-magic"></i> Sub Categories </a></li>
        
    </ul>
</div>
<div class="row cust" style='padding:0px;'>
     
    <div id="update" class="col s12">
          

        <div class="col s12 ">
           <br/>  <h5><i class="fa fa-upload white-text"></i> Update </h5>  <br/>
       </div>

        <form method="post">
            
            <div class="col s4 center-align ">
                <label for=""> Category title</label>
                <input type='text' class='validate' name='category_title' value='<?= $category->title ?>' required  />
            </div>

            <div class="col s4 center-align ">
            <label for="">Category switch control</label> 
                <div class="switch"> <br/>
                <label>
                        Off
                        <input type="checkbox" name="category_switch" <?= $category->switch_category == 'on' ? 'checked' : '' ?> >
                        <span class="lever"></span>
                        On
                    </label>
                </div>
        </div>

            <div class="col s4 center-align ">
                <br/>
                <button class="btn cust_nav" type='submit' name='editcategory'>
                <i class="fa fa-upload white-text"></i>  Update
                </button>
                <br/><p></p>
            </div>
        
        </form>


    </div>



    <div id="subcategories" class="col s12">
       <div class="col s12 ">
           <br/>  <h5><i class="fa fa-minus white-text"></i> Sub Categories  </h5>  <br/>
       </div>


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
         <?php if($subcategories != [] ): ?>

             <?php foreach($subcategories as $item): ?>

               <form method='post'> 
                <tr>
                     <td  class="center-align">
                         <?= $item->id ?>
                         <input type='hidden' name='subcat_id' value='<?= $item->id ?>';
                     </td>
                     <td  class="center-align" >
                        <input type="text" name='subcategory_title' value='  <?= ucfirst($item->title) ?>'>
                     </td>

                     
                     <td class="center-align" style='display:flex; justify-content:space-around'>
                    
                        <div class="switch">
                           <label for="">
                           Control
                           </label> <br/>
                            <label>
                            Off
                            <input type="checkbox" <?= $item->switch_subcategory == 'on' ? 'checked' : '' ?>  name='switch_subcategory' >
                            <span class="lever"></span>
                            On
                            </label>
                      </div>

                     </td>

                     <td class="center-align">

                         <button class="btn "  style="background-color:transparent;" type='submit' name='updatesubcat' >
                            <i class="white-text fa fa-upload"></i>
                        </button>

                         <button class="btn "  style="background-color:transparent;" type='submit' name='deletesubcat' >
                            <i class="red-text fa fa-trash"></i>
                        </button>
              
                          
                     </td>
                 </tr>
                </form>
 
             <?php endforeach; ?>
                   <?php else : ?>

                    <tr >
                        <td colspan='4'>
                            <h6 class='center-align'>   
                                    <i class="white-text fa fa-info-circle"></i> 
                                    You haven't yet created a sub category on this category (sub menu) !  
                            </h6>
                        </td>  
                    </tr>

             <?php endif; ?>
         </tbody>
      </table>
    
    </div>
    

</div>
