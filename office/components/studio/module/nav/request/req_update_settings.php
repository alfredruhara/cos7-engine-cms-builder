<?php
     if(isset($_POST['sortby']) AND isset($_POST['orderby']))
     {     
         $sortby_setting  =  $systemMenu->formatInput($_POST['sortby']);
         $orderby_setting =  $systemMenu->formatInput($_POST['orderby']);
         if($sortby_setting === 'id'|| $sortby_setting === "date" || $sortby_setting = 'name')
         {
             $sortby = $sortby_setting;
         }
         if( $orderby_setting === 'asc' ||  $orderby_setting === 'desc')
         {
             $orderby =  $orderby_setting ;
         }
         if(isset($sortby) AND isset($orderby))
         {
             $bitu_sawa = $menusetting_table->update(1,['sort_by' => $sortby, 'use_order'=> $orderby]);
             $oky === true ? $flash->set('update','success') :  $flash->set('fatal_error','danger');
         }else
         {
             $flash->set('unexcepted','danger');
         }
     }
?>