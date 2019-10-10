<?php
     $slide_id = isset($_POST['slideid']) ? (int)$_POST['slideid'] : '';
     if($slide_id != '' && is_numeric($slide_id))
     {    
         if($slide_id > 0)
         {
             foreach($sliders as $slide)
             {
                 if( (int)$slide->sid === $slide_id )
                 {
                     $founded_id =  $slide->sid ;
                     break;
                 }
             }
             if(isset( $founded_id))
             {     
                 $oky = $slider_table ->delete($founded_id);
                 $oky === true ? $flash->set('success','success') : $flash->set('fatal_error','danger');
             }else{
                 $flash->set('id_error','danger');
             }
         }else
         {
             $flash->set('id_error','danger');
         }
     }else
     {
        $flash->set('id_error','danger');
     }

?>