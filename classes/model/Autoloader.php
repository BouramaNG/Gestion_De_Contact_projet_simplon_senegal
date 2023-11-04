<?php
namespace classes\model;

class Autoloader
{
    static function register()
    {
        spl_autoload_register([__CLASS__, "autoload"]);
    }

    static function autoload($class)
    {
     
        $class = str_replace(__NAMESPACE__.'\\', '', $class);
        $class = str_replace('\\', '/', $class);

      
        $classPath = __DIR__ . '/../../' . $class . '.php';

        if (file_exists($classPath)) {
            require_once $classPath;
        }
    }
}
