<?php
    $description = isset($_POST['desc']) ?  $_POST['desc']  : '';
   if( $description != '' )
     {
         $oky = $globalpoint_table->create(['description' => $description ]);
         $oky === true ? $flash->set('update','success') :  $flash->set('fatal_error','danger');
     }else{
         $flash->set('required','warning');
     }
?>