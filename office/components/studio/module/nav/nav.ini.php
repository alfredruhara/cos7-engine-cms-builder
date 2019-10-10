<?php
    # Packages ini
    use Cos\HTML\MaterializeForm;
    # Instances ini
    $form              = new MaterializeForm();
    # Self Redirection link ini 
    $self              = '?vl='.$systemMenu->cursor('studio')['nav']['out'] ;
    # Tables ini
    $menu_table        =  $systemMenu->getTable('menu');
    $category_table    =  $systemMenu->getTable('category');
    $slider_table      =  $systemMenu->getTable('slider');
    $display_table     =  $systemMenu->getTable('display');
    $menusetting_table =  $systemMenu->getTable('menusetting');
    $globalpoint_table =  $systemMenu->getTable('globalpoint');    
    # Default requests ini
    $menu_list         = $menu_table->menuBuilder();
    $menu_select       = $menu_table->extract('id','menu');
    $globalpoints      =  $globalpoint_table->allPoint();
    $displayConfig     = $display_table->getConfig();
    # Colors ini used to coloreful menus
    $colors            = ['white','orange','blue','green','red'];
?>