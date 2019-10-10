<?php
     $title  = isset($_POST['menu_title']) ? strtolower(trim($_POST['menu_title'])) : '' ;
     $switch = isset($_POST['menu_switch']) ? 'on' : 'off' ;     
     if($title != '')
     {
         if($title != $menu->menu ||  $switch !=  $menu->switch_menu )
         {
               $oky = $menu_table->update($menu->id, [ 'menu' => $title,'switch_menu' =>$switch]);
               $oky === true ?  $flash->set('update','success') : $flash->set('fatal_error','danger');
         }else
         {
             $flash->set('update','success');
         }
     }else
     {
          $flash->set('required','waring');
     }

?>