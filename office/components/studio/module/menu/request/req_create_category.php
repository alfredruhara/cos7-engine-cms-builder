<?php
     $title  = isset($_POST['category_title']) ? strtolower(trim($_POST['category_title'])) : '' ;
     $switch = isset($_POST['category_switch']) ? 'on' : 'off' ;
     if($title != '')
     {
         $oky = $category_table->create(['title'=> $title, 'menu_id'=> $menu->id, 'switch_category' =>$switch ]);
         $oky === true ?   $flash->set('success','success') : $flash->set('fatal_error','danger');
     }else
     {
         $flash->set('required','warning');
     }

?>