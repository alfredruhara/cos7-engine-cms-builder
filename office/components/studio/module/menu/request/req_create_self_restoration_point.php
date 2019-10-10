<?php
     $description = isset($_POST['desc']) ?  $_POST['desc']  : '';
     if( $description != '' )
     {
         $oky = $point_table->create(['menu_id'     => $menu->id,'description' => $description]);
         $oky === true ? $flash->set('success','success') : $flash->set('fatal_error','danger');
     }else
     {
         $flash->set('required','warning');
     }
?>