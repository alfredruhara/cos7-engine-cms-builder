<?php
    $menu_id = isset($_POST['menu_id']) ? $systemMenu->formatInput($_POST['menu_id']) : '';
    $category_title = isset($_POST['category_title']) ? $systemMenu->formatInput($_POST['category_title']) : '';
    if(is_numeric($menu_id) AND !empty($category_title))
    {
        $oky = $category_table->create(['title'=>$category_title,'menu_id' =>$menu_id]);
        $oky === true ? $flash->set('success','success') :  $flash->set('fatal_error','danger');
    }else
    {
        $flash->set('required','warning');
        $flash->set('id_error','danger');
    }
?>