<?php
    $create_directory = $systemMenu->makeDir('../datas/');
    $menu_title = isset($_POST['menu_title']) ? $systemMenu->formatInput($_POST['menu_title']) : '' ;
    if ( $create_directory != false )
    {
        $menu_dir = $create_directory ;
    }
    if(isset ($menu_dir))
    {
        if(!empty($menu_title) )
        {
            $oky = $menu_table->create(['menu'=> $menu_title,'menu_dir' => $menu_dir]);
            $oky === true ? $flash->set('success','success') :  $flash->set('fatal_error','danger');
        }else
        {
            $flash->set('required','warning');
        }
    }else{
        $flash->set('dir_error','danger');
    }

?>