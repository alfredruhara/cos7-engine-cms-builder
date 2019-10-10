<?php
$id = isset($_POST['cat_id']) ? (int)$_POST['cat_id'] : '';
if(  $id != '' &&  $id > 0  )
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
        $oky = $category_table->delete_cust($id_found , $menu->id );
        $oky === true ? $flash->set('success','success') : $flash->set('fatal_error','danger');
    }else
    {
        $flash->set('id_error','danger');
    }
}else
{
    $flash->set('id_error','danger');
}
?>