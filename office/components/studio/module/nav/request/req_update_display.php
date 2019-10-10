<?php
    if(isset($_POST['category_display']) AND isset($_POST['subcategory_display']))
    {  
        $category_display =  $systemMenu->formatInput($_POST['category_display']);
        $subcategory_display =  $systemMenu->formatInput($_POST['subcategory_display']);
        if($category_display == 'tab'|| $category_display == "dropdown")  $category = $category_display;
        if( $subcategory_display == 'dropdown' ||  $subcategory_display == 'card')  $subcategory =  $subcategory_display ;
        if(isset($category) AND isset($subcategory))
        {
            $oky = $display_table->update(1,[
                'category'     => $category,
                'subcategory'  => $subcategory
                ]);
            if($oky)
            {
                $flash->set('update','success');
            }else
            {
                #Id 1 not found 
                $oky = $display_table->create(['id' => 1,'category'=> $category,'subcategory' => $subcategory ]);
                $oky === true ? $flash->set('update','success') :  $flash->set('fatal_error','danger');
            }
        }else
        {
            $flash->set('unexcepted','danger');
        }
    }else{
        $flash->set('required','warning');
    }
?>