<?php
     $article_table = $systemSingleMenu->getTable('article');
     $oky = $article_table->deleteAllPost($menu->id);
     $oky === true ? $flash->set('success','success') : $flash->set('fatal_error','danger');
?>