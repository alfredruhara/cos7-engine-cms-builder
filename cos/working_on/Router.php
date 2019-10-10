<?php
 namespace Cos{
    
    class Router{

       public static function parse($url, $request){

           $url = trim($url, '/');
           $params = explode('/', $url);

           $request->controller = $params[0];
           $request->action     = $params[1] ?? 'index';
           $request->params     = array_slice($params,2);  
           return true;
       }

    }

 }
?>