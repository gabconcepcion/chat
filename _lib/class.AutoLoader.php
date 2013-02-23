<?php

class AutoLoader {    
    public static function load($class) {

    	$path = str_replace('_', '/', $class);
        if(file_exists("Models/".$path .".php")) {  
        	
            require_once("Models/".$path .".php");
            //echo "Model/class.".$class .".php\n";
        }        
    }
}

spl_autoload_register(array('AutoLoader', 'load'));