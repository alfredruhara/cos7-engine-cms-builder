<?php
# PAckages ini
use Cos\HTML\MaterializeForm;
# # Checker
if(isset($_GET['id']) AND isset($_GET['vl']))
{
    if(is_numeric($_GET['id']) AND $_GET['id'] > 0)   $id = (int)$_GET['id'];
}
$back = '?vl='.$systemSingleMenu->cursor('studio')['nav']['out'];
if(!isset($id)) {
    $flash->set('id_error', 'danger');
    $systemSingleMenu->cos_redirect($back);
}
# Insatances ini
$form = new MaterializeForm();
# First Table ini and Requests
$menu_table = $systemSingleMenu->getTable('menu');
$menu = $menu_table->find($id); 
if ($menu === false ){
    $flash->set('id_error', 'danger');
    $systemSingleMenu->cos_redirect($back);
}
$point_table = $systemSingleMenu->getTable('point');
$restoration_points= $point_table->allPoint($menu->id); 
$category_table = $systemSingleMenu->getTable('category'); 
$categories = $category_table->find_cust($menu->id);
$slider_table = $systemSingleMenu->getTable('slider');
$sliders = $slider_table->findSlidesFor($menu->id); 
# Self Redirect link
$self = '?vl='.$systemSingleMenu->cursor('studio')['menu']['out'].'&id='.$menu->id;
# Some calculations
$total_allowed_category_on_each_menu = 8; 
$total_category_created = (int)count( $categories ) ;
if( $total_allowed_category_on_each_menu < $total_category_created )
{
     $total_allowed_category_on_each_menu  =  $total_category_created ;
}
$left_place_of_new_category = $total_allowed_category_on_each_menu - $total_category_created;
?>