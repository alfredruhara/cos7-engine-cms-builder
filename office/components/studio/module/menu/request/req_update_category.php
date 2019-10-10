<?php
    $category_title  = isset($_POST['category_title']) ? strtolower(trim($_POST['category_title'])) : '' ;
    $switch_category = isset($_POST['switch_category']) ? 'on' : 'off';
    $id = isset($_POST['cat_id']) ? (int)$_POST['cat_id'] : '';
    if($category_title  != '' &&  $id != '' &&  $id > 0  )
    {
        #Making sure the passed id in  the hidden field reall y exist
        foreach($categories as $item)
        {
            if( (int)$item->id === $id )
            {
                $id_found = $item->id ;
                break;
            }
        }
        #If not found , meaning the user z trying to bypass the security  
        if( isset($id_found) )
        {
            $oky = $category_table->update_cust($id_found , $menu->id, [ 'title' => $category_title,'switch_category' => $switch_category]);
            $oky === true ? $flash->set('update','success') : $flash->set('fatal_error','danger');
        }else
        {
            $flash->set('id_error','danger');
        }
    }else
    {
        $flash->set('required','warning');
        $flash->set('id_error','danger');
    }
?>