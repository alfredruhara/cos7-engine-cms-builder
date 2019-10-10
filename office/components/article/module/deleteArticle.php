
<?php
 $systemDelete= System::getInstance(); 
 $arttable =$systemDelete->getTable('article');

 isset($_GET['id']) ? preg_match('/^[0-9]*$/',$_GET['id']) ? $int_id = $_GET['id'] : '' : '';
 if(isset($int_id))
 {
     $oky = $arttable->delete($int_id);     
     $oky === true ? $flash->set('success','success') : $flash->set('fatal_error','danger');
 }else
 {
     $flash->set('id_error','danger');
 }

 $systemDelete->cos_redirect('?vl='.$systemDelete->cursor('article')['index']['out']);
 ?>
 
 
 
 