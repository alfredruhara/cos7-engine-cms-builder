<?php
 $systemDestroy = System::getInstance();

 unset($_SESSION['chadauth']);
 session_destroy();
 
 $systemDestroy->cos_redirect('index.php?vl='.$systemDestroy->hash('login').'');

?>