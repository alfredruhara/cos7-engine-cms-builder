
<div class="navbar-fixed">
    <nav class="nav-extended cust">
        <div class="container">
            <div class="nav-wrapper">
                <a href="?vl=<?php  #$system->hash('index') ?>" class="brand-logo " style='margin-left:10px'> Site Name</a>
                <!-- <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a> -->
                <ul id="nav-mobile" class="right hide-on-med-and-down">
                <?php foreach($menu_list as $menu): ?>
                        <li class='<?= $menu->id == $active_menu ? 'z-depth-1' : ''; ?> '><a href="<?= $menu->url ?>" class=''> <?= $menu->menu.'-'.$menu->id ?>  </a></li>
                <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </nav>
</div>
<?php if( $categories_list != [] ) : ?>
<div class="" style='position:fixed; width:100%; z-index:888;'>
    <div class="white">
        <div class="">
            <ul class="cust_tabs ">
                <!-- Looping trough categoies Found and printing out  -->
                <?php foreach($categories_list as $category_menu): ?>
                    <li class="cust_tab suitof<?= $category_menu->id ?>">
                        <a href="<?= $category_menu->uri ?>" class='category <?= $active_category == $category_menu->id ? 'on_active' : ''; ?> '>
                            <?= $category_menu->title.'-'.$category_menu->id ?> 
                        </a>
                    </li>
                  
                            
                        <?php if( $subcats  != [] ) : ?>

                           <?php if(isset($subcats[$category_menu->id.$category_menu->title])): ?>
                            <div   id='suitof<?= $category_menu->id ?>' style='z-index:888'
                                    class="sub_cat row <?= $active_category == $category_menu->id ? 'active_category' : ''; ?> suitof<?= $category_menu->id ?>">
                                
                                <div class="popUpSubCategories cust z-depth-1" style='z-index:888' >
                                    <h4 class="center-align "  id='co73' style='cursor:pointer;'> <?= ucfirst($category_menu->title) ?>   </h4>   
                                        <?php foreach($subcats[$category_menu->id.$category_menu->title]  as $item ): ?>      
                                            <p class='li'> 
                                                <a href="<?= $item->url ?>" class='cust_cat  <?= $subcategory_active_id == $item->id ? 'z-depth-1' : ''; ?> '>
                                                    <?= $item->title.'-'. $item->id ?>
                                                </a> 
                                            </p>
                                        <?php endforeach; ?>
                                   
                                </div>
                            </div>
                            <?php endif ; ?>

                        <?php endif ; ?>

                <?php endforeach; ?>
            </ul>
        </div>
    </div>    
</div>
<?php endif ; ?>

 <?php if( $found_slides != [] ) : ?>
    <div class="slider">
        <ul class="slides">
            <?php foreach($found_slides as $slide): ?>
                <li>
                    <img src="<?= $slide->media_url ?>">
                    <div class="caption <?= trim($slide->scaption_align) ?>-align">
                        <h3>
                            <?= $slide->scaption_title ?>
                        </h3>
                        <h5 class="light grey-text text-lighten-3">
                            <?= $slide->scaption_slogan ?>
                        </h5>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
 <?php endif; ?>

 <div class="row" style='margin-top:4%;'>
    <div class="col m12 s12 l12">
        <div class="container">
            <?php  if(isset($posts)): ?>
                <?php  if($posts != []): ?>
                    <div class="row">
                  

                        <?php foreach ($posts as $post): ?>
                            <div class="col m4 s4 l4">
                                <div class="card">
                                    <div class="" style='padding-left:10px;'>
                                        <h5 ><a href="<?= $post->url ?>" class='cust-text cust_title' > <?= $post->title ?> </a></h5>
                                    </div>
                                
                                    <div class="attachImgOnBg" style="background-image:url(<?= $post->media_url ?>) ;" ></div>

                                    <div class="card-content" style='height:180px'>
                                        <p><?= $post->extrait ?></p>
                                    </div>
                                </div>
                            </div>
                         <?php endforeach; ?>
                    </div>
                <?php else:  ?>
                    <div class="row " style=''>
                        <div class="col m5 s6 l12 center-align ">    
                            <div class="card z-depth-0" style='background:transparent; border-bottom:1px solid white;'>
                                <p> Content not found !! Maybe deleted or switched off  
                                    <button class="btn white z-depth-0 black-text"  style='margin-left:10px; text-transform:none'>
                                            Report as unworking link
                                    </button>  
                                </p>
                            </div>
                        </div>
                        <h4>Content Suggested </h4>
                    </div>
                <?php endif;  ?>
            <?php else:  ?>
                <div class="row " style=''>
                    <div class="col m5 s6 l12 center-align ">
                        
                        <div class="card z-depth-0" style='background:transparent; border-bottom:1px solid red;'>
                            <h4 class='red-text'> Nothing to show </h4>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
