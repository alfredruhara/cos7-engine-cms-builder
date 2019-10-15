<?php
# COS Builder Php System - Date de debut le 01 Juillet 2018 Ecript Par Alfred Chada 

define('TIME',microtime(true));

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(__DIR__));
define('WEBROOT', dirname(__DIR__).DS.'web');

require ROOT.'/web/system/System.php';
System::run();
$system = System::getInstance();

$uri = $_SERVER['REQUEST_URI'];

$vl = $_GET['vl'] ??  $vl = $system->hash('index');

switch($vl) {
    case ($vl === $system->hash('index'))  :  
         $controller = new \Web\Controller\EngineController();
         $controller->index();
         #require ROOT.'/web/layout/engine.php'; 
    break;

    case ($vl === $system->hash('single'))  :
        
         $controller = new \Web\Controller\SingleController();   
         $uri = explode('dif=',$uri);
         $controller->index($uri[1]);  
         #require ROOT.'/web/layout/single_engine.php'; 
    break;
}

?>