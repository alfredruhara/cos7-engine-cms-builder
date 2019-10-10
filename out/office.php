<?php
# COS 7 Php System  | Date de debut le 08 Juillet 2018 |  Ecrit Par Alfred Chada 
# Php  7.1 or greater 

# Defining the root path and importing the system Class
define('TIME',microtime(true));
define('ROOT', dirname(__DIR__));
require ROOT.'/office/system/System.php';

# Excuting the System (Autoloads have been initialized) and Save the Instance of the System as $systemAdmin
System::run();
$systemAdmin = System::getInstance();


# 1-Session and 2-Alert Message Settings ON.
# 3-Saving the http Get Request of the file to load in $Vl. 4-Check if the user is authentified .
$session =  $systemAdmin->__session();
$flash   =  $systemAdmin->__flash($session);

$vl = $_GET['vl'] ??  $vl = $systemAdmin->cursor('office')['index']['out'] ?? '';
$_SESSION['chadauth'] = 1;
if(!$session->exist('chadauth')) $systemAdmin->forbidden();


# Executing out the requested page . default -> Index : first case in the switch statements bellow
ob_start();

switch($vl){

    case ($vl === $systemAdmin->cursor('office')['index']['out'] ) : require ROOT.$systemAdmin->cursor('office')['index']['dir']; break;

    case ($vl === $systemAdmin->cursor('studio')['index']['out'] ) :  require ROOT.$systemAdmin->cursor('studio')['index']['dir']; break;
    case ($vl === $systemAdmin->cursor('studio')['nav']['out'] ) :  require ROOT.$systemAdmin->cursor('studio')['nav']['dir']; break;
    case ($vl === $systemAdmin->cursor('studio')['menu']['out'] ) :  require ROOT.$systemAdmin->cursor('studio')['menu']['dir']; break;
    case ($vl === $systemAdmin->cursor('studio')['category']['out'] ) :  require ROOT.$systemAdmin->cursor('studio')['category']['dir']; break;
    case ($vl === $systemAdmin->cursor('studio')['footer']['out'] ) :  require ROOT.$systemAdmin->cursor('studio')['footer']['dir']; break;

    case ($vl === $systemAdmin->cursor('article')['index']['out'] ) : require ROOT.$systemAdmin->cursor('article')['index']['dir']; break;
    case ($vl === $systemAdmin->cursor('article')['new']['out'] ) : require ROOT.$systemAdmin->cursor('article')['new']['dir']; break;
    case ($vl === $systemAdmin->cursor('article')['comment']['out'] ) : require ROOT.$systemAdmin->cursor('article')['comment']['dir']; break;
    case ($vl === $systemAdmin->cursor('article')['delete']['out'] ) : require ROOT.$systemAdmin->cursor('article')['delete']['dir']; break;

    case ($vl === $systemAdmin->cursor('comment')['index']['out'] ) : require ROOT.$systemAdmin->cursor('comment')['index']['dir']; break;
    case ($vl === $systemAdmin->cursor('comment')['approve']['out'] ) : require ROOT.$systemAdmin->cursor('comment')['approve']['dir']; break;
    case ($vl === $systemAdmin->cursor('comment')['edit']['out'] ) : require ROOT.$systemAdmin->cursor('comment')['edit']['dir']; break;
    case ($vl === $systemAdmin->cursor('comment')['reply']['out'] ) : require ROOT.$systemAdmin->cursor('comment')['reply']['dir']; break;
    case ($vl === $systemAdmin->cursor('comment')['spam']['out'] ) : require ROOT.$systemAdmin->cursor('comment')['spam']['dir']; break;
    case ($vl === $systemAdmin->cursor('comment')['trash']['out'] ) : require ROOT.$systemAdmin->cursor('comment')['trash']['dir']; break;

    case ($vl === $systemAdmin->cursor('media')['index']['out'] ) : require ROOT.$systemAdmin->cursor('media')['index']['dir']; break;
    case ($vl === $systemAdmin->cursor('media')['folder']['out'] ) : require ROOT.$systemAdmin->cursor('media')['folder']['dir']; break;
    case ($vl === $systemAdmin->cursor('media')['slide']['out'] ) : require ROOT.$systemAdmin->cursor('media')['slide']['dir']; break;

    case ($vl === $systemAdmin->cursor('user')['index']['out'] ) : require ROOT.$systemAdmin->cursor('user')['index']['dir']; break;
    case ($vl === $systemAdmin->cursor('user')['destroy']['out'] ) : require ROOT.$systemAdmin->cursor('user')['destroy']['dir']; break;
    case ($vl === $systemAdmin->cursor('user')['firechange']['out'] ) : require ROOT.$systemAdmin->cursor('user')['firechange']['dir']; break;
    case ($vl === $systemAdmin->cursor('user')['new']['out'] ) : require ROOT.$systemAdmin->cursor('user')['new']['dir']; break;
    case ($vl === $systemAdmin->cursor('user')['profile']['out'] ) : require ROOT.$systemAdmin->cursor('user')['profile']['dir']; break;

    default :  break;
}

$layout = ob_get_clean();
# Print out the page 
require ROOT.'/office/templates/default.php';

# This page end it executions without opening the database connexion . , however loaded requested files will open 
# the database connexion for retrieving needed datas!
     
?>




















