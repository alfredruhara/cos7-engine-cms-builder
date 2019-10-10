<?php
    # Base
    $_path = ROOT.'/office/components/studio/module/menu';
    $systemSingleMenu = System::getInstance();
    # Ini
    require($_path.'/menu.ini.php');
    # Requests
    if (isset($_POST['addcategory']) && $left_place_of_new_category > 0  )  { include($_path.'/request/req_create_category.php'); $systemSingleMenu->cos_redirect($self);   }
   
    if (isset($_POST['editmenu'])) {  include($_path.'/request/req_update_menu.php');  $systemSingleMenu->cos_redirect($self);  }
    
    if(isset($_POST['addslider']) ) { include($_path.'/request/req_create_slide.php');  $systemSingleMenu->cos_redirect($self);  }

    if(isset($_POST['editslider'])) {  include($_path.'/request/req_update_slide.php');  $systemSingleMenu->cos_redirect($self);  }
   
    if(isset($_POST['deleteslide']))  { include($_path.'/request/req_delete_slide.php');   $systemSingleMenu->cos_redirect($self);  }

    if(isset($_POST['simpleclear'])) { include($_path.'/request/req_delete_clear_content.php'); $systemSingleMenu->cos_redirect($self);  }
 
    if(isset($_POST['createrestorepoint'])) { include($_path.'/request/req_create_self_restoration_point.php'); $systemSingleMenu->cos_redirect($self);  }
   
    if(isset($_POST['deletemenu'])) { include($_path.'/request/req_delete_menu.php'); $systemSingleMenu->cos_redirect('?vl='.$systemSingleMenu->cursor('studio')['nav']['out']); }
    
    if( isset($_POST['updatecat'])  AND !isset($_POST['deletecat'])  ) { include($_path.'/request/req_update_category.php'); $systemSingleMenu->cos_redirect($self); }

    if( isset($_POST['deletecat'])  AND !isset($_POST['updatecat'])) { include($_path.'/request/req_delete_category.php'); $systemSingleMenu->cos_redirect($self); }

?>
<!-- Display -->
    <?php include($_path.'/inc/inc_self_menu.php'); ?>
    <?php include($_path.'/inc/inc_self_bar_category.php'); ?>
    <?php include($_path.'/inc/inc_self_slide.php'); ?>
    <?php include($_path.'/inc/inc_slef_local_workspace.php'); ?>
