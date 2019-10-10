<?php
  $oky =  $menu_table->delete($menu->id);
  $oky === true ? $flash->set('success','success') : $flash->set('fatal_error','danger');
?>