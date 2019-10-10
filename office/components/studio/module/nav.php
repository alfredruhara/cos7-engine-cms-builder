
<?php
    # System Nav instance and Nav Module mother oath
    $systemMenu = System::getInstance();
    $_path = ROOT.'/office/components/studio/module/nav';
    # Ini
    require($_path.'/nav.ini.php');
    # Request
    if (isset($_POST['menu'])) { include($_path.'/request/req_create_menu.php');   $systemMenu->cos_redirect($self);  }

    if (isset($_POST['category'])) {  include($_path.'/request/req_create_category.php'); $systemMenu->cos_redirect($self); }

    if (isset($_POST['slider'])) {  include($_path.'/request/req_create_slide.php');  $systemMenu->cos_redirect($self); }

    if (isset($_POST['display'])) { include($_path.'/request/req_update_display.php');  $systemMenu->cos_redirect($self);  }

    if ( isset($_POST['settings']))  {  include($_path.'/request/req_update_settings.php');   $systemMenu->cos_redirect($self);  }

    if (isset($_POST['createrestorepoint']))  {  include($_path.'/request/req_create_gloabal_restore_point.php'); $systemMenu->cos_redirect($self); }
?>
<!--- Display Bar tools -->
<?php include($_path.'/inc/inc_bar_menu.php'); ?>
<?php include($_path.'/inc/inc_bar_tool.php'); ?>
<!-- Display all tools of inc_bar_tool -->
<div class="row cust" style='padding:0px;'>
    <?php include($_path.'/inc/inc_tool_navigation.php'); ?>
    <?php include($_path.'/inc/inc_tool_display.php'); ?>
    <?php include($_path.'/inc/inc_tool_quick.php'); ?>
    <?php include($_path.'/inc/inc_tool_gloabl.php'); ?>
</div>
