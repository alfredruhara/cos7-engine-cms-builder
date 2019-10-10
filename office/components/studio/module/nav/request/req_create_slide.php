<?php
    $menu_id = isset($_POST['menu_id']) ? $systemMenu->formatInput($_POST['menu_id']) : '';
    $caption_title =  isset($_POST['caption_title']) ? $systemMenu->formatInput($_POST['caption_title']) : '';
    $caption_slogan = isset($_POST['caption_slogan']) ? $systemMenu->formatInput($_POST['caption_slogan']) : '';
    $caption_align = isset($_POST['caption_align']) ? $systemMenu->formatInput($_POST['caption_align']) : '';   
    if(is_numeric($menu_id) )
    {
        $scaption_attach = $systemMenu->doUpload($_FILES['attach'], '../datas/slides/');
        if($scaption_attach === false)
        {
            $flash->set('upload_error','danger');
        }else
        {    
            $oky = $slider_table->create([
                'smenu_id'    => $menu_id,
                'scaption_title'  => $caption_title,
                'scaption_attach'  => $scaption_attach,
                'scaption_slogan'  => $caption_slogan,
                'scaption_align'  => $caption_align
                
            ]);
            $oky === true ? $flash->set('success','success') :  $flash->set('fatal_error','danger');
        }
    }else
    {
        $flash->set('id_error','danger');
    }
?>