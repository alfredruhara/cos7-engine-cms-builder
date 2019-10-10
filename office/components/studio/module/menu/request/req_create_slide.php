<?php
    $caption_title  = isset($_POST['caption_title'])  ?  trim($_POST['caption_title'])  : '' ;
    $caption_slogan = isset($_POST['caption_slogan'])  ? trim($_POST['caption_slogan']) : '';
    $caption_align  = isset($_POST['caption_align'])  ? trim($_POST['caption_align'])   : '';
    $image          = isset($_FILES['attach']) ? $_FILES['attach'] : 'unset';    
    #High Strict checking -> Force checking 
    if( ( $image != 'unset' && !empty($caption_align) )  &&  ( $caption_align === 'left' ||  $caption_align ==='center') )
        {
        $scaption_attach = $systemSingleMenu->doUpload($image, '../datas/slides/');
        if($scaption_attach === false)
        {
            $flash->set('upload_error','danger');  $systemSingleMenu->cos_redirect($self);
        }  
        $oky = $slider_table->create([
            'smenu_id'    => $menu->id,
            'scaption_title'  => $caption_title,
            'scaption_attach'  => $scaption_attach,
            'scaption_slogan'  => $caption_slogan,
            'scaption_align'  => $caption_align       
        ]);
        $oky === true ?  $flash->set('success','success') :  $flash->set('fatal_error','danger'); 

    }else
    {
        $flash->set('unexcepted','danger');
    } 
?>