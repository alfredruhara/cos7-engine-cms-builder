<?php
    $caption_align = end($_POST);
    if($caption_align != 'left' || $caption_align != 'center' )  $caption_align = 'left';   
    $slide_id = isset( $_POST['slideeditid'] ) ?  (int)$_POST['slideeditid'] : '';
        if(is_numeric($slide_id) && $slide_id > 0 )
        {
            #Knowing the passed id exist
            foreach($sliders as $slide)
            {
                if( (int)$slide->sid === $slide_id )
                {
                    $founded_id =  $slide->sid ;
                    break;
                }

            }
            if($founded_id)
            {
                $caption_title  = isset($_POST['caption_title'])  ?  trim($_POST['caption_title'])  : '' ;
                $caption_slogan = isset($_POST['caption_slogan'])  ? trim($_POST['caption_slogan']) : '';
                $image          = isset($_FILES['attach_update']) ? $_FILES['attach_update'] : 'unset';
                    #High Strict checking -> Force checking 
                    $scaption_attach = $systemSingleMenu->doUpload($image, '../datas/slides/');
                    if($scaption_attach != false)
                    {
                        $oky = $slider_table->update($founded_id,
                        [
                            'scaption_title'  => $caption_title,
                            'scaption_attach'  => $scaption_attach,
                            'scaption_slogan'  => $caption_slogan,
                            'scaption_align'  => $caption_align        
                        ]);
                    
                    }else
                    {
                        # $flash->set('upload_error','danger');
                        $oky = $slider_table->update($founded_id,
                        [    
                            'scaption_title'  => $caption_title,
                            'scaption_slogan'  => $caption_slogan,
                            'scaption_align'  => $caption_align    
                        ]);   
                    }
                    $oky === true ?  $flash->set('update','success') : $flash->set('fatal_error','danger');
            }else
            {
                $flash->set('id_error','danger');
            }
        }else
        {
            $flash->set('unxcepted','danger');
        }

?>